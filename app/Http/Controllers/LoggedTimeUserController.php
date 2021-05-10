<?php

namespace App\Http\Controllers;

use App\Models\LoggedTimeUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoggedTimeUserController extends Controller
{
    public function get(Request $request)
    {
        $query = LoggedTimeUser::selectRaw(
                'users.name, users.email, '.
                'sec_to_time(SUM(time_to_sec(TIMEDIFF(loggedtime_users.updated_at, loggedtime_users.created_at)))) as log_time, '.
                'date(loggedtime_users.created_at) as log_date'
            )
            ->join('users', 'loggedtime_users.user_id', '=', 'users.id')
            ->groupBy([DB::raw('date(loggedtime_users.created_at)'), 'users.name', 'users.email']);

        if ($request->has('search'))
        {
            $query = $query->where(function ($query) use ($request){
                    $query->where('users.name', 'like', '%'.$request->search.'%')
                        ->orWhere('users.email', 'like', '%'.$request->search.'%');
                });
        }

        if ($request->has('start_date'))
        {
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay();
            $end_date = $start_date->copy()->addDay(1);

            if ($request->has('end_date')){
                $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->addDay(1);
            }
            
            $query = $query->where(function ($query) use ($request, $start_date, $end_date){
                    $query->where('loggedtime_users.created_at', '>=', $start_date->toDateString())
                        ->where('loggedtime_users.updated_at', '<', $end_date->toDateString());
                });
        }
        
        if ($request->has('order_by'))
        {
            switch ($request->order_by) {
                case 'name':
                    $termQuery = $query->orderBy('users.name', 'asc');
                    break;
                case 'email':
                    $termQuery = $query->orderBy('users.email', 'asc');
                    break;
                case 'date':
                    $termQuery = $query->orderBy('loggedtime_users.created_at', 'asc');
                    break;
                case 'time':
                    $termQuery = $query->orderBy('log_time', 'asc');
                    break;
            }
        }

        $loggedTimeUsers = $query->get();
        //$loggedTimeUsers = Str::replaceArray('?', $query->getBindings(), $query->toSql());
        return response()->json($loggedTimeUsers, 200);
    }
}
