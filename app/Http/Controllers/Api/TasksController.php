<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CorridorDisinfection;
use App\Models\RoomDisinfection;
use App\Models\User;
use Illuminate\Http\Request;


class TasksController extends Controller {

    public function insertCorridorDisinfectionTask(Request $request) {
        $this->checkAuthentication();
        $this->validateCorridorTask($request);

        $result = CorridorDisinfection::create([
            'unit' => $request->unit,
            'floor' => $request->floor,
            'corridor_number' => $request->corridor_number,
            'duration' => $request->duration,
            'spots_count' => $request->spots_count,
            'is_completed' => !empty($request->is_completed) ? 0 : $request->is_completed,
            'robot_serial' => $request->robot_serial,
            'date' => $request->date,
            'created_at' => time()
        ]);
        return $this->response($result);
    }

    public function insertRoomDisinfectionTask(Request $request) {
        $this->checkAuthentication();
        $this->validateRoomTask($request);

        $result = RoomDisinfection::create($this->mapReceivedRoomDisinfectionTask($request));
        return $this->response($result);
    }

    public function insertTasks(Request $request) {
        $this->checkAuthentication();
        $insertedTasksCount = 0;
        if (!empty($request->room_disinfection)) {
            $roomTasks = json_decode($request->room_disinfection);
            foreach ($roomTasks as $task) {
                $this->validateRoomTask($task);
                RoomDisinfection::insert($this->mapReceivedRoomDisinfectionTask($task));
                $insertedTasksCount++;
            }
        }

        if (!empty($request->corridor_disinfection)) {
            $corridorTasks = json_decode($request->corridor_disinfection);
            foreach ($corridorTasks as $task) {
                $this->validateCorridorTask($task);
                CorridorDisinfection::insert($this->mapReceivedCorridorDisinfectionTask($task));
                $insertedTasksCount++;
            }
        }
        return $this->response($insertedTasksCount);
    }

    public function getRoomDisinfectionInfo(Request $request) {
        $this->checkAuthentication();

        $query = RoomDisinfection::select("*");
        if ($request->unit != null) $query->where("unit", "=", $request->unit);
        if ($request->floor != null) $query->where("floor", "=", $request->floor);
        if ($request->room != null) $query->where("room", "=", $request->room);
        if ($request->spots_count != null) $query->where("spots_count", "=", $request->spots_count);
        if ($request->date != null) $query->whereRaw('DATEDIFF("' . $request->date . '", date) = ?', 0);
        if ($request->duration != null) $query->where("duration", "=", $request->duration);
        if ($request->robot_serial != null) $query->where("robot_serial", "=", $request->robot_serial);
        if ($request->is_completed != null) $query->where("is_completed", "=", $request->is_completed);
        $result = $query->get();
        return $this->response($result);
    }

    public function getCorridorDisinfectionInfo(Request $request) {
        $this->checkAuthentication();

        $query = CorridorDisinfection::select("*");
        if ($request->unit != null) $query->where("unit", "=", $request->unit);
        if ($request->floor != null) $query->where("floor", "=", $request->floor);
        if ($request->corridor_number != null) $query->where("corridor_number", "=", $request->corridor_number);
        if ($request->spots_count != null) $query->where("spots_count", "=", $request->spots_count);
        if ($request->date != null) $query->whereRaw('DATEDIFF("' . $request->date . '", date) = ?', 0);
        if ($request->duration != null) $query->where("duration", "=", $request->duration);
        if ($request->is_completed != null) $query->where("is_completed", "=", $request->is_completed);
        if ($request->robot_serial != null) $query->where("robot_serial", "=", $request->robot_serial);
        $result = $query->get();
        return $this->response($result);
    }

    public function getAllUserTasks(Request $request) {
        $this->checkAuthentication();

        $user_id = auth()->user()->id;

        $corridorTasks = array();
        $roomTasks = array();

        $userData = User::with("robots")->find($user_id);
        foreach ($userData->robots as $robot) {
            foreach ($robot->corridorDisinfection as $task) {
                $data = $task->getAttributes();
                $data["robot_info"] = $robot->getAttributes();
                $corridorTasks[] = $data;
            }
            foreach ($robot->roomDisinfection as $task) {
                $data = $task->getAttributes();
                $data["robot_info"] = $robot->getAttributes();
                $roomTasks[] = $data;
            }
        }
        $result = [
            "room_tasks" => $roomTasks,
            "corridor_tasks" => $corridorTasks,
        ];
        return $this->response($result);
    }


    private function validateCorridorTask($task) {
        if (!isset($task->robot_serial)) $this->dieError('-2', trans('main.enter_robot_serial'));
        if (!isset($task->unit)) $this->dieError('-2', trans('main.enter_unit'));
        if (!isset($task->floor)) $this->dieError('-2', trans('main.enter_floor'));
        if (!isset($task->corridor_number)) $this->dieError('-2', trans('main.enter_corridor_number'));
        if (!isset($task->spots_count)) $this->dieError('-2', trans('main.enter_spots_count'));
        if (!isset($task->duration)) $this->dieError('-2', trans('main.enter_duration'));
        if (!isset($task->date)) $this->dieError('-2', trans('main.enter_date'));
    }

    private function validateRoomTask($task) {
        if (!isset($task->robot_serial)) $this->dieError('-2', trans('main.enter_robot_serial'));
        if (!isset($task->unit)) $this->dieError('-2', trans('main.enter_unit'));
        if (!isset($task->floor)) $this->dieError('-2', trans('main.enter_floor'));
        if (!isset($task->room_number)) $this->dieError('-2', trans('main.enter_room_number'));
        if (!isset($task->spots_count)) $this->dieError('-2', trans('main.enter_spots_count'));
        if (!isset($task->duration)) $this->dieError('-2', trans('main.enter_duration'));
        if (!isset($task->date)) $this->dieError('-2', trans('main.enter_date'));
    }

    private function mapReceivedRoomDisinfectionTask($task): array {
        return [
            'unit' => $task->unit,
            'floor' => $task->floor,
            'room' => $task->room_number,
            'duration' => $task->duration,
            'spots_count' => $task->spots_count,
            'is_completed' => $task->is_completed == null ? 0 : $task->is_completed,
            'robot_serial' => $task->robot_serial,
            'date' => $task->date,
        ];
    }

    private function mapReceivedCorridorDisinfectionTask($task): array {
        return [
            'unit' => $task->unit,
            'floor' => $task->floor,
            'corridor_number' => $task->corridor_number,
            'duration' => $task->duration,
            'spots_count' => $task->spots_count,
            'is_completed' => $task->is_completed == null ? 0 : $task->is_completed,
            'robot_serial' => $task->robot_serial,
            'date' => $task->date,
        ];
    }
}
