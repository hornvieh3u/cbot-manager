<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'user'], function () {
    Route::post('register', 'Api\ApiAuthController@userRegister');
    Route::post('login', 'Api\ApiAuthController@userLogin');
    Route::post('logout', 'Api\ApiAuthController@userLogout');
    Route::post('all_users_list', 'Api\ApiAuthController@getUsersList');
    Route::post('change_user_status', 'Api\ApiAuthController@changeUserStatus');
    Route::post('change_user_password', 'Api\ApiAuthController@changeUserPassword');
    Route::post('robots_list', 'Api\ApiDashboardController@getRobotsList');
    Route::post('dashboard', 'Api\ApiDashboardController@dashboard');
    Route::post('hospital_map', 'Api\ApiHospitalMapController@hospitalMap');
});

Route::group(['middleware' => 'api', 'prefix' => 'robot'], function () {
    Route::post('robot_register', 'Api\RobotsController@robotRegister');
    Route::post('robots_info', 'Api\RobotsController@getRobotInfo');
    Route::post('robots_delete', 'Api\RobotsController@robotDelete');
});

Route::group(['middleware' => 'api', 'prefix' => 'hospital_room'], function () {
    Route::post('hospital_rooms_info', 'Api\HospitalRoomsController@getHospitalRooms');
    Route::post('insert_hospital_room', 'Api\HospitalRoomsController@insert_hospital_room');
    Route::post('insert_multiple_hospital_rooms', 'Api\HospitalRoomsController@insert_multiple_hospital_rooms');
    Route::post('update_hospital_room', 'Api\HospitalRoomsController@update_hospital_room');
    Route::post('delete_hospital_room', 'Api\HospitalRoomsController@delete_hospital_room');
});

Route::group(['middleware' => 'api', 'prefix' => 'task'], function () {
    Route::post('insertCorridorDisinfectionTask', 'Api\TasksController@insertCorridorDisinfectionTask');
    Route::post('insertRoomDisinfectionTask', 'Api\TasksController@insertRoomDisinfectionTask');
    Route::post('insert_tasks', 'Api\TasksController@insertTasks');
    Route::post('room_disinfection_info', 'Api\TasksController@getRoomDisinfectionInfo');
    Route::post('corridor_disinfection_info', 'Api\TasksController@getCorridorDisinfectionInfo');
    Route::post('all_tasks', 'Api\TasksController@getAllUserTasks');
});
