<?php

namespace App\Http\Controllers\Api;

use http\Url;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ApiHospitalMapController extends Controller
{

    public function __construct()
    {
        
    }

    /**
     * Get hospital map data.
     *
     * @param  
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function hospitalMap(Request $request){
        if (auth()->check()) {
            $user = auth()->user();
            $user_id = $user->id;
            $unit_list = DB::table('hospital_rooms_table')
                ->selectRaw('hospital_rooms_table.unit')
                ->where("hospital_rooms_table.user_id", "=", $user_id)
                ->groupBy('hospital_rooms_table.unit')
                ->get();
            // $query = DB::table('hospital_rooms_table')
            //     ->selectRaw("hospital_rooms_table.*")
            //     ->orderBy('hospital_rooms_table.floor', 'desc');
            // $room_list = $query->get();
            // $room_map_list = array();
            // foreach($unit_list as $row_u){
            //     $room_map_list[$row_u->unit] = array();
            //     foreach($room_list as $row_f){
            //         if($row_u->unit == $row_f->unit){
            //             $room_map_list[$row_u->unit][$row_f->floor] = array();
            //             foreach($room_list as $row_r){
            //                 if($row_f->unit == $row_r->unit && $row_f->floor == $row_r->floor){
            //                     $room_map_list[$row_u->unit][$row_f->floor][] = $row_r->room_number;
            //                 }                            
            //             }
            //         }
            //     }
            // }
            $map_data = array();
            foreach($unit_list as $row_u){
                $r_unit = array();
                $r_unit['id'] = $row_u->unit;
                $r_unit['floor_data'] = array();

                $floor_list = DB::table('hospital_rooms_table')
                    ->selectRaw("floor")
                    ->whereRaw("unit='".$row_u->unit."'")
                    ->where("user_id", "=", $user_id)
                    ->groupBy('floor')
                    ->orderBy('floor', 'desc')
                    ->get();

                foreach($floor_list as $row_f){
                    $r_floor = array();
                    $r_floor['id'] = $row_f->floor;
                    $r_floor['room_data'] = array();

                    $rooms_list = DB::table('hospital_rooms_table')
                        ->selectRaw("room_number")
                        ->whereRaw("unit='".$row_u->unit."' AND floor='".$row_f->floor."'")
                        ->where("user_id", "=", $user_id)
                        ->orderBy('room_number', 'asc')->get();
                    
                    foreach($rooms_list as $row_r){
                        $r_room = array();
                        $r_room['id'] = $row_r->room_number;
                        $r_floor['room_data'][] = $r_room;
                    }
                        
                    $r_unit['floor_data'][] = $r_floor;
                }
                $map_data[] = $r_unit;
            }
            // print_r($map_data);
            return $this->response($map_data);
        }else{
            return $this->error(-1,trans('main.please_login'));
        }
    }
}
