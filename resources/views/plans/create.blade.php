<form class="px-3" method="post" action="{{ route('plans.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-control-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" required/>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="custom-control custom-switch mt-5">
                <input type="checkbox" class="custom-control-input" name="status" id="status" checked="checked">
                <label class="custom-control-label form-control-label" for="status">{{ __('Status') }}</label>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="monthly_price" class="form-control-label">{{ __('Monthly Price') }}</label>
            <div class="form-icon-user">
                <span class="currency-icon">{{ (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') }}</span>
                <input class="form-control" type="number" min="0" id="monthly_price" name="monthly_price" placeholder="{{ __('Enter Monthly Price') }}">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="annual_price" class="form-control-label">{{ __('Annual Price') }}</label>
            <div class="form-icon-user">
                <span class="currency-icon">{{ (env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$') }}</span>
                <input class="form-control" type="number" min="0" id="annual_price" name="annual_price" placeholder="{{ __('Enter Monthly Price') }}">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="image" class="form-control-label">{{ __('Image') }}</label>
            <div class="choose-file">
                <label for="landing-logo">
                    <div>{{ __('Choose file here') }}</div>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                </label>
            </div>
            <span class="d-inline-block"><small>{{__('Please upload a valid image file. Size of image should not be more than 2MB.')}}</small></span>
        </div>
        <div class="form-group col-md-6">
            <label for="duration" class="form-control-label">{{ __('Trial Days') }} *</label>
            <input type="number" class="form-control mb-0" id="trial_days" name="trial_days" required/>
            <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
        </div>
        <div class="form-group col-md-6">
            <label for="max_workspaces" class="form-control-label">{{ __('Maximum Workspaces') }} *</label>
            <input type="number" class="form-control mb-0" id="max_workspaces" name="max_workspaces" required/>
            <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
        </div>
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="max_users" class="form-control-label">{{ __('Maximum Users Per Workspace') }} *</label>
                <input type="number" class="form-control mb-0" id="max_users" name="max_users" required/>
                <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="max_clients" class="form-control-label">{{ __('Maximum Clients Per Workspace') }} *</label>
            <input type="number" class="form-control mb-0" id="max_clients" name="max_clients" required/>
            <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
        </div>
        <div class="form-group col-md-6">
            <label for="max_projects" class="form-control-label">{{ __('Maximum Projects Per Workspace') }} *</label>
            <input type="number" class="form-control mb-0" id="max_projects" name="max_projects" required/>
            <span><small>{{__("Note: '-1' for Unlimited")}}</small></span>
        </div>
        <div class="form-group col-md-12 mb-0">
            <div class="form-group">
                <label for="description" class="form-control-label">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="description">{{$plan->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn-create badge-blue" value="{{ __('Save') }}">
        <input type="button" class="btn-create bg-gray" data-dismiss="modal" value="{{ __('Cancel') }}">
    </div>
</form>
