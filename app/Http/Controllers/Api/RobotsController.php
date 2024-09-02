<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotInfo;
use Illuminate\Http\Request;


class RobotsController extends Controller
{

    public function getRobotInfo(Request $request)
    {
        if (!auth()->check()) return $this->error(-1, trans('main.please_login'));
        $user_id = auth()->user()->id;
        $robot_infos = RobotInfo::where("user_id", "=", $user_id)->get();
        return $this->response($robot_infos);
    }

    public function robotRegister(Request $request)
    {
        if (!auth()->check()) return $this->error(-1, trans('main.please_login'));

        $user = auth()->user();
        $user_id = $user->id;

        if (empty($request->serial)) {
            return $this->error('-2', trans('main.enter_robot_serial'));
        }

        if (empty($request->name)) {
            return $this->error('-2', trans('main.enter_robot_name'));
        }

        if (empty($request->password)) {
            return $this->error('-2', trans('main.pass_confirmation_same'));
        }

        if (empty($request->number)) {
            return $this->error('-2', trans('main.enter_robot_number'));
        }

        $duplicateSerial = RobotInfo::where('robot_serial', $request->serial)->first();
        if ($duplicateSerial) {
            return $this->error(-2, trans('main.robot_exists'));
        }

        $newRobot = [
            'robot_serial' => $request->serial,
            'robot_name' => $request->name,
            'robot_password' => $request->password,
            'robot_number' => $request->number,
            'user_id' => $user_id,
            'created_at' => time()
        ];

        RobotInfo::create($newRobot);

        return $this->response(['message' => trans('main.thanks_reg')]);
    }

    public function robotDelete(Request $request)
    {
        if (!auth()->check()) return $this->error(-1, trans('main.please_login'));

        $user = auth()->user();
        $user_id = $user->id;

        if (empty($request->serial)) {
            return $this->error('-2', trans('main.enter_robot_serial'));
        }

        $robot = RobotInfo::select("*")
            ->where("user_id", "=", $user_id)
            ->where("robot_serial", "=", $request->serial)
            ->first();

        if (!$robot) return $this->error(-2, trans('main.robot_not_exist'));

        $result = RobotInfo::where("robot_serial", "=", $robot->robot_serial)->delete();
        return $this->response(boolval($result));
    }
}
