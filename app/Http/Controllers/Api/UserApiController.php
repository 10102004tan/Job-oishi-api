<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFcm;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        if ($validated) {
            // Create user information
            $user = User::create($validated);

            // Create job criteria of user
            $user->jobCriteria()->create([
                'user_id' => $user->id
            ]);
            return $user;
        }else {
            return array("status" => 500, "message" => "Error while creating user");
        }
    }

    /**
     * Get job criteria of user
    */

    public function getJobCriteria($id) {
        $user = User::find($id);
        if ($user) {
            return $user->jobCriteria;
        }else {
            return array("status" => 404, "message" => "User not found");
        }
    }

    /**
     * Update user job criteria
    */
    public function updateJobCriteria(Request $request) {
        $user = User::find($request->user_id);
        if ($user) {
            $user->jobCriteria()->update($request->all());
            return $user->jobCriteria;
        }else {
            return array("status" => 404, "message" => "User not found");
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->photo_url = asset("storage/images/$user->photo_url");
            return $user;
        }else {
            return array("status" => 404, "message" => "User not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if ($request->hasFile('photo_url')) {
            $image = $request->file('photo_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $user->photo_url = $imageName;
        }
        $user->update($request->all());
        $user->photo_url = asset("storage/images/$user->photo_url");
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return array("status" => 200, "message" => "User deleted");
        }else {
            return array("status" => 404, "message" => "User not found");
        }
    }


    // Hàm lưu fcm token của user
    public function saveFcmToken(Request $request) {
        // Dữ liệu nhận về bao gồm user_id và fcm_token
        $user_id = $request->user_id;
        $fcm_token = $request->fcm_token;

        // Tìm user_fcm theo user_id và fcm_token
        $userFcm = UserFcm::where('user_id', $user_id)->where('fcm_token', $fcm_token)->first();

        // Nếu không tìm thấy thì tạo mới
        if (!$userFcm) {
            UserFcm::create([
                'user_id' => $user_id,
                'fcm_token' => $fcm_token
        ]);
        // Nếu tìm thấy thì mà is_active = false thì cập nhật lại is_active = true
        }else {
            if ($userFcm->is_active == false) {
                $userFcm->is_active = true;
                $userFcm->save();
            }
        }
        // Nếu tìm thấy mà is_active = true thì không làm gì cả
        return array("status" => 200, "message" => "Fcm token saved");
        // Trả về thông báo
    }
}
