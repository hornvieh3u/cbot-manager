<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HospitalRooms;
use Exception;
use Illuminate\Http\Request;


class HospitalRoomsController extends Controller {

    public function getHospitalRooms(Request $request) {
        $this->checkAuthentication();

        $user_id = auth()->user()->id;

        $query = HospitalRooms::select("*")
            ->where("user_id", "=", $user_id);
        if (isset($request->unit)) $query->where("unit", "=", $request->unit);
        if (isset($request->floor)) $query->where("floor", "=", $request->floor);
        if (isset($request->room)) $query->where("room_number", "=", $request->room);
        if (isset($request->room_size)) $query->where("room_size", "=", $request->room_size);
        $result = $query->get();
        return $this->response($result);
    }

    public function insert_hospital_room(Request $request) {
        $this->checkAuthentication();
        $user_id = auth()->user()->id;

        $this->validateHospitalRoom($request);

        $checkExist = $this->checkHospitalRoomExists($user_id, $request);
        if ($checkExist) return $this->error(-2, trans('main.hospital_room_exists'));

        $result = HospitalRooms::insert($this->mapReceivedHospitalRoom($user_id, $request));
        return $this->response($result);
    }

    public function insert_multiple_hospital_rooms(Request $request) {
        $this->checkAuthentication();
        $user = auth()->user();
        $user_id = $user->id;

        if (empty($request->rooms)) {
            return $this->error('-2', trans('main.enter_rooms'));
        }

        try {
            $rooms = json_decode($request->rooms);
            $insertedRoomsCount = 0;
            foreach ($rooms as $room) {
                if ($this->validateHospitalRoom($room) != null) continue;
                if (!$this->checkHospitalRoomExists($user_id, $room)) {
                    HospitalRooms::insert($this->mapReceivedHospitalRoom($user_id, $room));
                    $insertedRoomsCount++;
                }
            }
        } catch (Exception $e) {
            return $this->error('-2', trans('main.malformed_data'));
        }
        return $this->response($insertedRoomsCount);
    }

    public function update_hospital_room(Request $request) {
        $this->checkAuthentication();

        $user = auth()->user();
        $user_id = $user->id;

        if ($request->old_room == null) return $this->error('-2', trans('main.enter_old_room'));
        if ($request->new_room == null) return $this->error('-2', trans('main.enter_new_room'));

        $oldRoom = json_decode($request->old_room);
        $newRoom = json_decode($request->new_room);

        $validation = $this->validateHospitalRoom($oldRoom);
        if ($validation != null) return $validation;
        $validation = $this->validateHospitalRoom($newRoom);
        if ($validation != null) return $validation;

        $checkOldExist = $this->checkHospitalRoomExists($user_id, $oldRoom);
        if (!$checkOldExist) return $this->error(-2, trans('main.hospital_room_not_found'));

        $checkNewExist = $this->checkHospitalRoomExists($user_id, $newRoom);
        if ($checkNewExist) return $this->error(-2, trans('main.hospital_room_exists'));

        $result = HospitalRooms::where("id", "=", $checkOldExist->id)
            ->update([
                'unit' => $newRoom->unit,
                'floor' => $newRoom->floor,
                'room_number' => $newRoom->room_number,
                'room_size' => $newRoom->room_size,
                'last_edit_date' => date('Y-m-d H:i:s'),
            ]);
        return $this->response(boolval($result));
    }

    public function delete_hospital_room(Request $request) {
        $this->checkAuthentication();
        $this->validateHospitalRoom($request);
        $user_id = auth()->user()->id;

        $checkExist = $this->checkHospitalRoomExists($user_id, $request);
        if (!$checkExist) return $this->error(-2, trans('main.hospital_room_not_found'));

        $result = HospitalRooms::where("id", "=", $checkExist->id)->delete();
        return $this->response(boolval($result));
    }


    private function validateHospitalRoom($room) {
        if ($room->unit == null) $this->dieError('-2', trans('main.enter_unit'));
        if ($room->floor == null) $this->dieError('-2', trans('main.enter_floor'));
        if ($room->room_number == null) $this->dieError('-2', trans('main.enter_room_number'));
        if ($room->room_size == null) $this->dieError('-2', trans('main.enter_room_size'));
    }

    private function checkHospitalRoomExists($user_id, $room) {
        return HospitalRooms::select("*")
            ->where("user_id", "=", $user_id)
            ->where("unit", "=", $room->unit)
            ->where("floor", "=", $room->floor)
            ->where("room_number", "=", $room->room_number)
            ->first();
    }

    private function mapReceivedHospitalRoom($user_id, $room): array {
        $creationDate = $room->creation_date == null ? date('Y-m-d H:i:s') : $room->creation_date;
        $last_edit_date = $room->last_edit_date == null ? date('Y-m-d H:i:s') : $room->last_edit_date;
        return [
            'unit' => $room->unit,
            'floor' => $room->floor,
            'room_number' => $room->room_number,
            'room_size' => $room->room_size,
            'user_id' => $user_id,
            'creation_date' => $creationDate,
            'last_edit_date' => $last_edit_date,
        ];
    }
}
