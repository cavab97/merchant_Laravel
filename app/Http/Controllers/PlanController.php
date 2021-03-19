<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Order;
use App\Plan;
use App\Project;
use App\User;
use App\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentWorkspace = Utility::getWorkspaceBySlug('');

        if(\Auth::user()->type == 'admin')
        {
            $plans            = Plan::get();
            return view('plans.admin', compact('plans', 'currentWorkspace'));
        }
        elseif($currentWorkspace->creater->id == \Auth::user()->id)
        {
            $plans            = Plan::where('status', '1')->get();
            return view('plans.company', compact('plans', 'currentWorkspace'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan();
        return view('plans.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))
        {
            $validation                   = [];
            $validation['name']           = 'required|unique:plans';
            $validation['monthly_price']  = 'required|numeric|min:0';
            $validation['annual_price']   = 'required|numeric|min:0';
            $validation['trial_days']     = 'required|numeric';
            $validation['max_workspaces'] = 'required|numeric';
            $validation['max_users']      = 'required|numeric';
            $validation['max_clients']    = 'required|numeric';
            $validation['max_projects']   = 'required|numeric';
            if($request->image)
            {
                $validation['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:204800';
            }
            $request->validate($validation);
            $post           = $request->all();
            $post['status'] = $request->has('status') ? 1 : 0;
            if($request->image)
            {
                $avatarName = 'plan_' . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->storeAs('plans', $avatarName);
                $post['image'] = $avatarName;
            }
            if(Plan::create($post))
            {
                return redirect()->back()->with('success', __('Plan created Successfully!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Please set stripe/paypal api key & secret key for add new plan'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($planID)
    {
        $plan = Plan::find($planID);

        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function update($planID, Request $request)
    {
        if((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))
        {
            $plan = Plan::find($planID);
            if($plan)
            {
                $validation                   = [];
                $validation['name']           = 'required|unique:plans,name,' . $planID;
                $validation['monthly_price']  = 'required|numeric|min:0';
                $validation['annual_price']   = 'required|numeric|min:0';
                $validation['trial_days']     = 'required|numeric';
                $validation['max_workspaces'] = 'required|numeric';
                $validation['max_users']      = 'required|numeric';
                $validation['max_clients']    = 'required|numeric';
                $validation['max_projects']   = 'required|numeric';
                if($request->image)
                {
                    $validation['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:204800';
                }
                $request->validate($validation);

                $post           = $request->all();
                $post['status'] = $request->has('status') ? 1 : 0;
                if($request->image)
                {
                    $avatarName = 'plan_' . time() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->storeAs('plans', $avatarName);
                    $post['image'] = $avatarName;
                }
                if($plan->update($post))
                {
                    return redirect()->back()->with('success', __('Plan updated Successfully!'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Something is wrong'));
                }
            }
            else
            {
                return redirect()->back()->with('error', __('Plan not found'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Please set stripe/paypal api key & secret key for add new plan'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Plan $plan
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($planID)
    {

    }

    public function userPlan(Request $request)
    {
        $objUser = \Auth::user();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->code);
        $plan    = Plan::find($planID);
        if($plan)
        {
            if($plan->monthly_price <= 0)
            {
                $objUser->assignPlan($plan->id);

                return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Plan not found'));
        }
    }

    public function payment(Request $request, $frequency, $code)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug('');
        $planID           = \Illuminate\Support\Facades\Crypt::decrypt($code);
        $plan             = Plan::find($planID);
        if($plan)
        {
            $plan->price = (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') . $plan->{$frequency . '_price'};
            return view('plans.payment', compact('plan', 'frequency', 'currentWorkspace'));
        }
        else
        {
            return redirect()->back()->with('error', __('Plan is deleted.'));
        }
    }

    public function preparePayment(Request $request, $slug)
    {
        $plan_id = \Illuminate\Support\Facades\Crypt::decrypt($request->code);
        $plan    = Plan::find($plan_id);

        $authuser = Auth::user();

        $stripe_session = '';

        if($plan)
        {
            /* Check for code usage */
            $plan->discounted_price = false;

            $payment_frequency = $request->payment_frequency;

            $price = $plan->{$payment_frequency . '_price'};

            if(isset($request->coupon) && !empty($request->coupon))
            {
                $request->coupon = trim($request->coupon);
                $coupons         = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                if(!empty($coupons))
                {
                    $usedCoupun             = $coupons->used_coupon();
                    $discount_value         = ($plan->{$payment_frequency . '_price'} / 100) * $coupons->discount;
                    $plan->discounted_price = $price = $plan->{$payment_frequency . '_price'} - $discount_value;

                    if($usedCoupun >= $coupons->limit)
                    {
                        return redirect()->back()->with('error', __('This coupon code has expired.'));
                    }
                }
                else
                {
                    return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                }
            }

            if($price <= 0)
            {
                $assignPlan = $authuser->assignPlan($plan->id, $payment_frequency);

                if($assignPlan['is_success'] == true && !empty($plan))
                {
                    if(!empty($authuser->payment_subscription_id) && $authuser->payment_subscription_id != '')
                    {
                        try
                        {
                            $authuser->cancel_subscription($authuser->id);
                        }
                        catch(\Exception $exception)
                        {
                            \Log::debug($exception->getMessage());
                        }
                    }

                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    Order::create([
                            'order_id' => $orderID,
                            'name' => null,
                            'email' => null,
                            'card_number' => null,
                            'card_exp_month' => null,
                            'card_exp_year' => null,
                            'plan_name' => $plan->name,
                            'plan_id' => $plan->id,
                            'price' => $price,
                            'price_currency' => !empty(env('CURRENCY_CODE')) ? env('CURRENCY_CODE') : 'USD',
                            'txn_id' => '',
                            'payment_type' => __('Zero Price'),
                            'payment_status' => 'succeeded',
                            'receipt' => null,
                            'user_id' => $authuser->id,
                        ]);

                    return redirect()->route('home')->with('success', __('Plan successfully upgraded.'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                }
            }

            switch($request->payment_processor)
            {
                case 'paypal':

                    if((env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY')))) {
                        $result = app('App\Http\Controllers\PaypalController')->paypalCreate($request, $slug, $plan);
                    }
                    break;

                case 'stripe':

                    if((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET')))) {
                        $stripe_session = app('App\Http\Controllers\StripePaymentController')->stripeCreate($request, $slug, $plan);
                    }
                    break;
            }

            return redirect()->route('payment', [$payment_frequency, $request->code])->with(['stripe_session' => $stripe_session]);
        }
        else
        {
            return redirect()->back()->with('error', __('Plan not found'));
        }
    }

    public function takeAPlanTrial(Request $request, $plan_id)
    {
        $plan = Plan::find($plan_id);
        $user = Auth::user();
        if($plan && $user->type == 'user' && $user->is_trial_done == 0)
        {
            $assignPlan = $user->assignPlan($plan->id);
            if($assignPlan['is_success'])
            {
                $days = $plan->trial_days == '-1' ? '36500' : $plan->trial_days;
                $user->is_trial_done = 1;
                $user->plan = $plan->id;
                $user->plan_expire_date = Carbon::now()->addDays($days)->isoFormat('YYYY-MM-DD');
                $user->save();
                return redirect()->route('home')->with('success', __('Your trial has been started'));
            } else {
                return redirect()->route('home')->with('error', __('Your trial can not be started'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
