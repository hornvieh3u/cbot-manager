<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDashboardController extends Controller
{

    /**
     * Get dashboard data.
     *
     * @param
     *
     * @return JsonResponse
     */
    public function dashboard(Request $request){
        if (auth()->check()) {
            $user = auth()->user();
            $user_id = $user->id;
            $dashboard_info = array();

            $robot_serial = 0;
            if(!empty($request->robot_serial)){
                $robot_serial = $request->robot_serial;
            }

            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $unit = 0;
            if(!empty($request->unit)){
                $unit = $request->unit;
            }
            $floor = 0;
            if(!empty($request->floor)){
                $floor = $request->floor;
            }
            $room = 0;
            if(!empty($request->room)){
                $room = $request->room;
            }

            $robot_infos = DB::table('robots_info_table')
                ->selectRaw("robots_info_table.robot_serial,robots_info_table.robot_name")
                ->where("robots_info_table.user_id", "=", $user_id)
                ->get();
            $robot_list = array();
            $row = array();
            $row['value'] = '0';
            $row['text'] = trans('main.all_robot');
            $robot_list[] = $row;
            foreach($robot_infos as $robot){
                $row = array();
                $row['value'] = $robot->robot_serial;
                $row['text'] = $robot->robot_name;
                $robot_list[] = $row;
            }

            if(!empty($start_date) && !empty($end_date)){
                if(!empty($robot_serial)){
                    $robot_info = $this->getRobotInfo($robot_serial);
                }else{
                    $robot_info = array();
                }
                $total_info = $this->getTotalInfo($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id);
                $performed_task_info = $this->getPerformedTask($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id);
                $performed_task_day_info = $this->getPerformedTasksByDay($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id);
                $performed_task_unit_info = $this->getPerformedTasksByUnit($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id);
            } else {
                $robot_info = array();
                $total_info = array();
                $performed_task_info = array();
                $performed_task_day_info = array();
                $performed_task_unit_info = array();
            }
            $dashboard_info['robot_list'] = $robot_list;
            $dashboard_info['robot_info'] = $robot_info;
            $dashboard_info['total_info'] = $total_info;
            $dashboard_info['performed_task_info'] = $performed_task_info;
            $dashboard_info['performed_task_day_info'] = $performed_task_day_info;
            $dashboard_info['performed_task_unit_info'] = $performed_task_unit_info;
            // print_r($dashboard_info);
            return $this->response($dashboard_info);
        }else{
            return $this->error(-1,trans('main.please_login'));
        }
    }

    public function getRobotsList(){
        if (auth()->check()) {
            $user = auth()->user();
            $user_id = $user->id;
            $robot_list = DB::table('robots_info_table')
                ->selectRaw("robots_info_table.robot_serial,robots_info_table.robot_name")
                ->where("robots_info_table.user_id", "=", $user_id)
                ->get();
            $result = array();
            $row = array();
            $row['value'] = '0';
            $row['text'] = trans('main.all_robot');
            $result[] = $row;
            foreach($robot_list as $robot){
                $row = array();
                $row['value'] = $robot->robot_serial;
                $row['text'] = $robot->robot_name;
                $result[] = $row;
            }
            return $this->response($result);
        }else{
            return $this->error(-1,trans('main.please_login'));
        }
    }

    public function getRobotInfo($robot_serial){
        $query = DB::table('robots_info_table')
            ->selectRaw("robots_info_table.*")
            ->where("robots_info_table.robot_serial", "=", $robot_serial);
        $robot_info = $query->first();
        // print_r($robot_info);
        return $robot_info;
    }

    public function getTotalInfo($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id){
        // get total_info in room_disinfection_table -------------------
        $query1 = DB::table('room_disinfection_table')
            ->selectRaw("SUM(room_disinfection_table.duration) AS total_duration
                        , COUNT(*) AS total_cnt")
            ->whereRaw('DATEDIFF("'.$start_date.'", room_disinfection_table.date) <= ?', 0)
            ->whereRaw('DATEDIFF(room_disinfection_table.date, "'.$end_date.'") <= ?', 0);
        if(!empty($robot_serial)){
            $query1->where("room_disinfection_table.robot_serial", "=", $robot_serial);
        }else{
            $query1->join('robots_info_table', 'room_disinfection_table.robot_serial', '=', 'robots_info_table.robot_serial');
            $query1->where("robots_info_table.user_id","=",$user_id);
        }
        if(!empty($unit)){
            $query1->where("room_disinfection_table.unit", "=", $unit);
        }
        if(!empty($floor)){
            $query1->where("room_disinfection_table.floor", "=", $floor);
        }
        if(!empty($room)){
            $query1->where("room_disinfection_table.room", "=", $room);
        }
        $room_total_info = $query1->first();

        // get total_info in corridor_disinfection_table ---------------
        if(empty($room)){
            $query2 = DB::table('corridor_disinfection_table')
                ->selectRaw("SUM(corridor_disinfection_table.duration) AS total_duration
                            , COUNT(*) AS total_cnt")
                ->whereRaw('DATEDIFF("'.$start_date.'", corridor_disinfection_table.date) <= ?', 0)
                ->whereRaw('DATEDIFF(corridor_disinfection_table.date, "'.$end_date.'") <= ?', 0);
            if(!empty($robot_serial)){
                $query2->where("corridor_disinfection_table.robot_serial", "=", $robot_serial);
            }else{
                $query2->join('robots_info_table', 'corridor_disinfection_table.robot_serial', '=', 'robots_info_table.robot_serial');
                $query2->where("robots_info_table.user_id","=",$user_id);
            }
            $corridor_total_info = $query2->first();
        }else{
            $corridor_total_info = array();
        }

        // get completed task in room_disinfection_table -------------------
        $query3 = DB::table('room_disinfection_table')
            ->selectRaw("COUNT(*) AS completed_cnt")
            ->where("room_disinfection_table.is_completed", "=", 1)
            ->whereRaw('DATEDIFF("'.$start_date.'", room_disinfection_table.date) <= ?', 0)
            ->whereRaw('DATEDIFF(room_disinfection_table.date, "'.$end_date.'") <= ?', 0);
        if(!empty($robot_serial)){
            $query3->where("room_disinfection_table.robot_serial", "=", $robot_serial);
        }else{
            $query3->join('robots_info_table', 'room_disinfection_table.robot_serial', '=', 'robots_info_table.robot_serial');
            $query3->where("robots_info_table.user_id","=",$user_id);
        }
        if(!empty($unit)){
            $query3->where("room_disinfection_table.unit", "=", $unit);
        }
        if(!empty($floor)){
            $query3->where("room_disinfection_table.floor", "=", $floor);
        }
        if(!empty($room)){
            $query3->where("room_disinfection_table.room", "=", $room);
        }
        $room_completed = $query3->first();

        // get completed task in corridor_disinfection_table -------------------
        if(empty($room)){
            $query4 = DB::table('corridor_disinfection_table')
                ->selectRaw("COUNT(*) AS completed_cnt")
                ->where("corridor_disinfection_table.is_completed", "=", 1)
                ->whereRaw('DATEDIFF("'.$start_date.'", corridor_disinfection_table.date) <= ?', 0)
                ->whereRaw('DATEDIFF(corridor_disinfection_table.date, "'.$end_date.'") <= ?', 0);
            if(!empty($robot_serial)){
                $query4->where("corridor_disinfection_table.robot_serial", "=", $robot_serial);
            }else{
                $query4->join('robots_info_table', 'corridor_disinfection_table.robot_serial', '=', 'robots_info_table.robot_serial');
                $query4->where("robots_info_table.user_id","=",$user_id);
            }
            $corridor_completed = $query4->first();
        }else{
            $corridor_completed = array();
        }

        $total_useage_time = 0;
        $average_useage_duration = 0;
        $room_total_useage = 0;
        $corridor_total_useage = 0;
        if(!empty($room_total_info->total_duration)){
            $room_total_useage = $room_total_info->total_duration;
        }
        if(!empty($corridor_total_info) && !empty($corridor_total_info->total_duration)){
            $corridor_total_useage = $corridor_total_info->total_duration;
        }

        $total_useage = $room_total_useage + $corridor_total_useage;
        $total_useage = floor($total_useage/1000); //milisecond -> second
        $total_hour = floor($total_useage/3600);
        $total_minute = floor(($total_useage%3600)/60);
        $total_sec = $total_useage % 60;
        $total_useage_time = $total_hour." ".trans('main.hours')." ".$total_minute." ".trans('main.minutes');

        $date1=date_create($start_date);
        $date2=date_create($end_date);
        $diff=date_diff($date1,$date2);
        $total_days = $diff->format("%a")+1;
        $average_duration = round($total_useage/$total_days);
        $average_hour = floor($average_duration/3600);
        $average_minute = floor(($average_duration%3600)/60);
        $average_sec = $average_duration % 60;
        $average_useage_duration = $average_hour." ".trans('main.hours')." ".$average_minute." ".trans('main.minutes');

        $rooms_count = 0;
        $corridor_count = 0;
        if(!empty($room_total_info->total_cnt)){
            $rooms_count = $room_total_info->total_cnt;
        }
        if(!empty($corridor_total_info->total_cnt)){
            $corridor_count = $corridor_total_info->total_cnt;
        }

        $room_completed_count = 0;
        $corridor_completed_count = 0;
        $total_completed_count = 0;
        $completed_tasks = 0;

        if(!empty($room_completed->completed_cnt)){
            $room_completed_count = $room_completed->completed_cnt;
        }
        if(!empty($corridor_completed) && !empty($corridor_completed->completed_cnt)){
            $corridor_completed_count = $corridor_completed->completed_cnt;
        }
        $total_completed_count = $room_completed_count + $corridor_completed_count;
        if($rooms_count>0 || $corridor_count>0){
            $completed_tasks = floor($total_completed_count/($rooms_count+$corridor_count)*100);
        }

        $total_info = array();
        $total_info['total_useage_time'] = $total_useage_time;
        $total_info['average_useage_duration'] = $average_useage_duration;
        // $total_info['rooms_disinfected_count'] = $room_completed_count;
        // $total_info['corridor_disinfected_count'] = $corridor_completed_count;
        $total_info['rooms_disinfected_count'] = $rooms_count;
        $total_info['corridor_disinfected_count'] = $corridor_count;
        $total_info['completed_tasks'] = $completed_tasks;
        // print_r($total_info);
        return $total_info;
    }

    public function getPerformedTask($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id){
        if(empty($room)){
            $query = DB::table(function ($sub) {
                    $corridor_sql = DB::table('corridor_disinfection_table')
                        ->selectRaw("corridor_disinfection_table.unit,corridor_disinfection_table.floor
                            ,corridor_disinfection_table.duration,corridor_disinfection_table.date
                            ,corridor_disinfection_table.robot_serial,corridor_disinfection_table.is_completed");

                    $sub->from('room_disinfection_table')
                        ->selectRaw("room_disinfection_table.unit,room_disinfection_table.floor
                            ,room_disinfection_table.duration,room_disinfection_table.date
                            ,room_disinfection_table.robot_serial,room_disinfection_table.is_completed")
                        ->unionAll($corridor_sql);
                }, 'a')
                ->selectRaw("a.*")
                // ->where("a.is_completed", "=", 1)
                ->whereRaw('DATEDIFF("'.$start_date.'", a.date) <= ?', 0)
                ->whereRaw('DATEDIFF(a.date, "'.$end_date.'") <= ?', 0)
                ->orderBy('a.date', 'desc')
                ->limit(8);
            if(!empty($robot_serial)){
                $query->where("a.robot_serial", "=", $robot_serial);
            }else{
                $query->join('robots_info_table', 'a.robot_serial', '=', 'robots_info_table.robot_serial');
                $query->where("robots_info_table.user_id","=",$user_id);
            }
            $performed_task_info = $query->get();
        }else{
            $query = DB::table('room_disinfection_table')
                ->selectRaw("room_disinfection_table.unit,room_disinfection_table.floor
                    ,room_disinfection_table.duration,room_disinfection_table.date
                    ,room_disinfection_table.robot_serial")
                // ->where("room_disinfection_table.is_completed", "=", 1)
                ->whereRaw('DATEDIFF("'.$start_date.'", room_disinfection_table.date) <= ?', 0)
                ->whereRaw('DATEDIFF(room_disinfection_table.date, "'.$end_date.'") <= ?', 0)
                ->where("room_disinfection_table.unit", "=", $unit)
                ->where("room_disinfection_table.floor", "=", $floor)
                ->where("room_disinfection_table.room", "=", $room)
                ->orderBy('room_disinfection_table.date', 'desc')
                ->limit(8);
            if(!empty($robot_serial)){
                $query->where("room_disinfection_table.robot_serial", "=", $robot_serial);
            }else{
                $query->join('robots_info_table', 'room_disinfection_table.robot_serial', '=', 'robots_info_table.robot_serial');
                $query->where("robots_info_table.user_id","=",$user_id);
            }
            $performed_task_info = $query->get();
        }

        $result = array();
        foreach ($performed_task_info as $performed_task) {
            $row = array();
            $row['unit'] = $performed_task->unit;
            $row['floor'] = $performed_task->floor;
            $task_duration = floor($performed_task->duration/1000);
            $minute = floor($task_duration/60);
            $second = $task_duration % 60;
            if(strlen($second) == 1){
                $second = "0".$second;
            }
            $duration = $minute.":".$second;
            $row['duration'] = $duration;
            $c_date = date_create($performed_task->date);
            $date = date_format($c_date, 'd/m/Y H:i');
            $row['date'] = $date;
            $result[] = $row;
        }
        // print_r($result);
        return $result;
    }

    public function getPerformedTasksByDay($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id){
        if(empty($room)){
            $query = DB::table(function ($sub) {
                    $corridor_sql = DB::table('corridor_disinfection_table')
                        ->selectRaw("corridor_disinfection_table.spots_count
                            ,DATE_FORMAT(corridor_disinfection_table.date, '%Y-%m-%d') AS d_date
                            ,corridor_disinfection_table.robot_serial
                            ,corridor_disinfection_table.is_completed");

                    $sub->from('room_disinfection_table')
                        ->selectRaw("room_disinfection_table.spots_count
                            ,DATE_FORMAT(room_disinfection_table.date, '%Y-%m-%d') AS d_date
                            ,room_disinfection_table.robot_serial
                            ,room_disinfection_table.is_completed")
                        ->unionAll($corridor_sql);
                }, 'a')
                // ->selectRaw("SUM(a.spots_count) AS d_cnt,a.d_date")
                ->selectRaw("COUNT(*) AS d_cnt,a.d_date")
                ->whereRaw('DATEDIFF("'.$start_date.'", a.d_date) <= ?', 0)
                ->whereRaw('DATEDIFF(a.d_date, "'.$end_date.'") <= ?', 0)
                // ->where("a.is_completed", "=", 1)
                ->groupBy('a.d_date')
                ->orderBy('a.d_date', 'ASC');
            if(!empty($robot_serial)){
                $query->where("a.robot_serial", "=", $robot_serial);
            }else{
                $query->join('robots_info_table', 'a.robot_serial', '=', 'robots_info_table.robot_serial');
                $query->where("robots_info_table.user_id","=",$user_id);
            }
            $performed_task_info = $query->get();
        }else{
            $query = DB::table(function ($sub) {
                    $sub->from('room_disinfection_table')
                        ->selectRaw("room_disinfection_table.spots_count
                            ,DATE_FORMAT(room_disinfection_table.date, '%Y-%m-%d') AS d_date
                            ,room_disinfection_table.robot_serial
                            ,room_disinfection_table.unit
                            ,room_disinfection_table.floor
                            ,room_disinfection_table.room
                            ,room_disinfection_table.is_completed");
                }, 'a')
                // ->selectRaw("SUM(a.spots_count) AS d_cnt,a.d_date")
                ->selectRaw("COUNT(a.spots_count) AS d_cnt,a.d_date")
                ->whereRaw('DATEDIFF("'.$start_date.'", a.d_date) <= ?', 0)
                ->whereRaw('DATEDIFF(a.d_date, "'.$end_date.'") <= ?', 0)
                ->where("a.unit", "=", $unit)
                ->where("a.floor", "=", $floor)
                ->where("a.room", "=", $room)
                // ->where("a.is_completed", "=", 1)
                ->groupBy('a.d_date')
                ->orderBy('a.d_date', 'ASC');
            if(!empty($robot_serial)){
                $query->where("a.robot_serial", "=", $robot_serial);
            }else{
                $query->join('robots_info_table', 'a.robot_serial', '=', 'robots_info_table.robot_serial');
                $query->where("robots_info_table.user_id","=",$user_id);
            }
            $performed_task_info = $query->get();
        }
        // print_r($performed_task_info);
        $result = array();
        $date_range = $this->createDateRangeArray($start_date,$end_date);
        foreach($date_range as $row_date){
            $exist_flg = 0;
            foreach($performed_task_info as $task){
                $date1=date_create($row_date);
                $date2=date_create($task->d_date);
                $diff=date_diff($date1,$date2);
                $diff_day = $diff->format("%a");
                if($diff_day == 0){
                    $exist_flg = 1;
                    $row = array();
                    $row['d_cnt'] = $task->d_cnt;
                    $c_date = date_create($task->d_date);
                    $d_date = date_format($c_date, 'd/m/Y');
                    $row['d_date'] = $d_date;
                    $result[] = $row;
                    break;
                }
            }
            if($exist_flg == 0){
                $row = array();
                $row['d_cnt'] = 0;
                $c_date = date_create($row_date);
                $d_date = date_format($c_date, 'd/m/Y');
                $row['d_date'] = $d_date;
                $result[] = $row;
            }
        }
        // print_r($result);
        return $result;
    }

    public function createDateRangeArray($strDateFrom,$strDateTo) {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }

    public function getPerformedTasksByUnit($robot_serial,$start_date,$end_date,$unit,$floor,$room,$user_id){
        $query = "";
        $query .= " SELECT DISTINCT bb.unit ";
        $query .= " ,IFNULL(aa.d_cnt,0) AS u_cnt ";
        $query .= " FROM hospital_rooms_table bb";
        $query .= " LEFT JOIN ( ";
            // $query .= " SELECT SUM(a.spots_count) AS d_cnt,a.unit ";
            $query .= " SELECT COUNT(*) AS d_cnt,a.unit ";
            $query .= " FROM ( ";
                $query .= " SELECT room_disinfection_table.spots_count ";
                $query .= " ,room_disinfection_table.date ";
                $query .= " ,room_disinfection_table.robot_serial ";
                $query .= " ,room_disinfection_table.unit ";
                $query .= " ,room_disinfection_table.is_completed ";
                if(!empty($room)){
                    $query .= " ,room_disinfection_table.floor ";
                    $query .= " ,room_disinfection_table.room ";
                }
                $query .= " FROM room_disinfection_table ";
                if(empty($room)){
                    $query .= " UNION ALL";
                    $query .= " SELECT corridor_disinfection_table.spots_count ";
                    $query .= " ,corridor_disinfection_table.date ";
                    $query .= " ,corridor_disinfection_table.robot_serial ";
                    $query .= " ,corridor_disinfection_table.unit ";
                    $query .= " ,corridor_disinfection_table.is_completed ";
                    $query .= " FROM corridor_disinfection_table ";
                }
            $query .= " ) a ";
            if(empty($robot_serial)){
                $query .= " INNER JOIN robots_info_table ON a.robot_serial=robots_info_table.robot_serial ";
            }
            $query .= " WHERE DATEDIFF('".$start_date."', a.date) <= 0 ";
            $query .= " AND DATEDIFF(a.date, '".$end_date."') <= 0 ";
            if(!empty($robot_serial)){
                $query .= " AND a.robot_serial = '".$robot_serial."' ";
            }else{
                $query .= " AND robots_info_table.user_id = '".$user_id."' ";
            }
            if(!empty($room)){
                $query .= " AND a.unit = '".$unit."' ";
                $query .= " AND a.floor = '".$floor."' ";
                $query .= " AND a.room = '".$room."' ";
            }
            // $query .= " AND a.is_completed = 1";
            $query .= " GROUP BY a.unit ";
            $query .= " ORDER BY a.unit ASC ";
        $query .= " ) aa ON  bb.unit = aa.unit ";
        $query .= " WHERE bb.user_id = '".$user_id."' ";

        $performed_task_info = DB::select($query);
        // print_r($performed_task_info);
        return $performed_task_info;
    }
}
