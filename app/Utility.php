<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Utility
{
    public function createSlug($table, $title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title, '-');
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($table, $slug, $id);
        // If we haven't used it before then we are all good.
        if(!$allSlugs->contains('slug', $slug))
        {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for($i = 1; $i <= 100; $i++)
        {
            $newSlug = $slug . '-' . $i;
            if(!$allSlugs->contains('slug', $newSlug))
            {
                return $newSlug;
            }
        }
        throw new \Exception(__('Can not create a unique slug'));
    }

    protected function getRelatedSlugs($table, $slug, $id = 0)
    {
        return DB::table($table)->select()->where('slug', 'like', $slug . '%')->where('id', '<>', $id)->get();
    }

    public static function getWorkspaceBySlug($slug)
    {
        $objUser = Auth::user();

        if($objUser && $objUser->currant_workspace)
        {
            if($objUser->getGuard() == 'client')
            {
                $rs = Workspace::select(['workspaces.*'])->join('client_workspaces', 'workspaces.id', '=', 'client_workspaces.workspace_id')->where('workspaces.id', '=', $objUser->currant_workspace)->where('client_id', '=', $objUser->id)->first();
            }
            else
            {
                $rs = Workspace::select(
                    [
                        'workspaces.*',
                        'user_workspaces.permission',
                    ]
                )->join('user_workspaces', 'workspaces.id', '=', 'user_workspaces.workspace_id')->where('workspaces.id', '=', $objUser->currant_workspace)->where('user_id', '=', $objUser->id)->first();
            }
        }
        elseif($objUser && !empty($slug))
        {
            if($objUser->getGuard() == 'client')
            {
                $rs = Workspace::select(['workspaces.*'])->join('client_workspaces', 'workspaces.id', '=', 'client_workspaces.workspace_id')->where('slug', '=', $slug)->where('client_id', '=', $objUser->id)->first();
            }
            else
            {
                $rs = Workspace::select(
                    [
                        'workspaces.*',
                        'user_workspaces.permission',
                    ]
                )->join('user_workspaces', 'workspaces.id', '=', 'user_workspaces.workspace_id')->where('slug', '=', $slug)->where('user_id', '=', $objUser->id)->first();
            }
        }
        elseif($objUser)
        {
            if($objUser->getGuard() == 'client')
            {
                $rs                         = Workspace::select(['workspaces.*'])->join('client_workspaces', 'workspaces.id', '=', 'client_workspaces.workspace_id')->where('client_id', '=', $objUser->id)->orderBy('workspaces.id', 'desc')->limit(1)->first();
                $objUser->currant_workspace = $rs->id;
                $objUser->save();
            }
            else
            {
                $rs = Workspace::select(
                    [
                        'workspaces.*',
                        'user_workspaces.permission',
                    ]
                )->join('user_workspaces', 'workspaces.id', '=', 'user_workspaces.workspace_id')->where('user_id', '=', $objUser->id)->orderBy('workspaces.id', 'desc')->limit(1)->first();
            }
        }
        else
        {
            $rs = Workspace::select(['workspaces.*'])->where('slug', '=', $slug)->limit(1)->first();
        }
        if($rs)
        {
            Utility::setLang($rs);

            return $rs;
        }
    }

    public static function setLang($Workspace)
    {

        $dir = base_path() . '/resources/lang/' . $Workspace->id . "/";
        if(is_dir($dir))
        {
            $lang = $Workspace->id . "/" . $Workspace->lang;
        }
        else
        {
            $lang = $Workspace->lang;
        }

        Date::setLocale(basename($lang));
        \App::setLocale($lang);
    }

    public static function get_timeago($ptime)
    {
        $estimate_time = time() - $ptime;

        $ago = true;

        if($estimate_time < 1)
        {
            $ago           = false;
            $estimate_time = abs($estimate_time);
        }

        $condition = [
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second',
        ];

        foreach($condition as $secs => $str)
        {
            $d = $estimate_time / $secs;

            if($d >= 1)
            {
                $r   = round($d);
                $str = $str . ($r > 1 ? 's' : '');

                return $r . ' ' . __($str) . ($ago ? ' ' . __('ago') : '');
            }
        }

        return $estimate_time;
    }

    public static function formatBytes($size, $precision = 2)
    {
        if($size > 0)
        {
            $size     = (int)$size;
            $base     = log($size) / log(1024);
            $suffixes = [
                ' bytes',
                ' KB',
                ' MB',
                ' GB',
                ' TB',
            ];

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }
        else
        {
            return $size;
        }
    }

    public static function invoiceNumberFormat($number)
    {
        return '#INV' . sprintf("%05d", $number);
    }

    public static function dateFormat($date)
    {
        $lang = \App::getLocale();
        \App::setLocale(basename($lang));
        $date = Date::parse($date)->format('d M Y');

        return $date;
    }

    public static function sendNotification($type, $currentWorkspace, $user_id, $obj)
    {

        if(is_array($user_id))
        {
            foreach($user_id as $id)
            {
                $notification = Notification::create(
                    [
                        'workspace_id' => $currentWorkspace->id,
                        'user_id' => $id,
                        'type' => $type,
                        'data' => json_encode($obj),
                        'is_read' => 0,
                    ]
                );

                // Push Notification
                $options         = array(
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'useTLS' => true,
                );
                $pusher          = new Pusher(
                    env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options
                );
                $data            = [];
                $data['html']    = $notification->toHtml();
                $data['user_id'] = $notification->user_id;
                // sending from and to user id when pressed enter
                $pusher->trigger($currentWorkspace->slug, 'notification', $data);

                // End Push Notification
            }
        }
        else
        {
            $notification = Notification::create(
                [
                    'workspace_id' => $currentWorkspace->id,
                    'user_id' => $user_id,
                    'type' => $type,
                    'data' => json_encode($obj),
                    'is_read' => 0,
                ]
            );

            // Push Notification
            $options         = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            );
            $pusher          = new Pusher(
                env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options
            );
            $data            = [];
            $data['html']    = $notification->toHtml();
            $data['user_id'] = $notification->user_id;
            // sending from and to user id when pressed enter
            $pusher->trigger($currentWorkspace->slug, 'notification', $data);

            // End Push Notification
        }
    }

    public static function getFirstSeventhWeekDay($week = null)
    {
        $first_day = $seventh_day = null;

        if(isset($week))
        {
            $first_day   = Carbon::now()->addWeeks($week)->startOfWeek();
            $seventh_day = Carbon::now()->addWeeks($week)->endOfWeek();
        }

        $dateCollection['first_day']   = $first_day;
        $dateCollection['seventh_day'] = $seventh_day;

        $period = CarbonPeriod::create($first_day, $seventh_day);

        foreach($period as $key => $dateobj)
        {
            $dateCollection['datePeriod'][$key] = $dateobj;
        }

        return $dateCollection;
    }

    public static function calculateTimesheetHours($times)
    {
        $minutes = 0;

        foreach($times as $time)
        {
            list($hour, $minute) = explode(':', $time);
            $minutes += $hour * 60;
            $minutes += $minute;
        }

        $hours   = floor($minutes / 60);
        $minutes -= $hours * 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public static function delete_directory($dir)
    {
        if(!file_exists($dir))
        {
            return true;
        }
        if(!is_dir($dir))
        {
            return unlink($dir);
        }
        foreach(scandir($dir) as $item)
        {
            if($item == '.' || $item == '..')
            {
                continue;
            }
            if(!self::delete_directory($dir . DIRECTORY_SEPARATOR . $item))
            {
                return false;
            }
        }

        return rmdir($dir);
    }

    // get font-color code accourding to bg-color
    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if(strlen($hex) == 3)
        {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        }
        else
        {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = [
            $r,
            $g,
            $b,
        ];

        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    public static function getFontColor($color_code)
    {
        $rgb = self::hex2rgb($color_code);
        $R   = $G = $B = $C = $L = $color = '';
        $R   = (floor($rgb[0]));
        $G   = (floor($rgb[1]));
        $B   = (floor($rgb[2]));
        $C   = [
            $R / 255,
            $G / 255,
            $B / 255,
        ];
        for($i = 0; $i < count($C); ++$i)
        {
            if($C[$i] <= 0.03928)
            {
                $C[$i] = $C[$i] / 12.92;
            }
            else
            {
                $C[$i] = pow(($C[$i] + 0.055) / 1.055, 2.4);
            }
        }
        $L = 0.2126 * $C[0] + 0.7152 * $C[1] + 0.0722 * $C[2];

        $color = $L > 0.179 ? 'black' : 'white';

        return $color;
    }

    public static function get_messenger_packages_migration()
    {
        $totalMigration = 0;
        $messengerPath  = glob(base_path() . '/vendor/munafio/chatify/database/migrations' . DIRECTORY_SEPARATOR . '*.php');
        if(!empty($messengerPath))
        {
            $messengerMigration = str_replace('.php', '', $messengerPath);
            $totalMigration     = count($messengerMigration);
        }
        return $totalMigration;
    }


    public static function getAllPermission() {
        return [
            "create milestone",
            "edit milestone",
            "delete milestone",
            "show milestone",
            "create task",
            "edit task",
            "delete task",
            "show task",
            "move task",
            "show activity",
            "show uploading",
            "show timesheet",
            "show bug report",
            "create bug report",
            "edit bug report",
            "delete bug report",
            "move bug report",
            "show gantt"
        ];
    }

}
