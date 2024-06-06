<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\UserFcm;
use GPBMetadata\Google\Api\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        } else {
            return array("status" => 500, "message" => "Error while creating user");
        }
    }

    /**
     * Get job criteria of user
     */

    public function getJobCriteria($id)
    {
        $user = User::find($id);
        if ($user) {
            return $user->jobCriteria;
        } else {
            return array("status" => 404, "message" => "User not found");
        }
    }

    /**
     * Update user job criteria
     */
    public function updateJobCriteria(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->jobCriteria()->update($request->all());
            return $user->jobCriteria;
        } else {
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
        } else {
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
        } else {
            return array("status" => 404, "message" => "User not found");
        }
    }


    // Hàm lưu fcm token của user
    public function saveFcmToken(Request $request)
    {
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
        } else {
            if ($userFcm->is_active == false) {
                $userFcm->is_active = true;
                $userFcm->save();
            }
        }
        // Nếu tìm thấy mà is_active = true thì không làm gì cả
        return array("status" => 200, "message" => "Fcm token saved");
        // Trả về thông báo
    }
    /**
     * User login
     */

    public function login(Request $request)
    {
        if (!$request->has(['email', 'password'])) {
            return response()->json([
                "status" => 400,
                "message" => "Email and password are required"
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User not found or incorrect password"
            ], 404);
        }
    }


    // Forgot password
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Random token 6 number
            $token = rand(100000, 999999);

            $user->verify_token_code = $token;
            $user->save();

            // Send token to user email with php mailer
            return $this->sendMail($user->email, $token);
        }
    }

    // Check verify token with email and token
    public function checkVerifyToken(Request $request)
    {
        $user = User::where('email', $request->email)->where('verify_token_code', $request->token)->first();
        if ($user) {
            return array("status" => 200, "message" => "Token is correct");
        } else {
            return array("status" => 404, "message" => "Token is incorrect");
        }
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return array("status" => 200, "message" => "Password reset successfully");
        } else {
            return array("status" => 404, "message" => "id is incorrect");
        }
    }

    // Send mail
    public function sendMail($mail, $token)
    {
        $response = NULL;
        try {
            Mail::to($mail)->send(new VerifyEmail($token));
            $response =  array("status" => 200, "message" => "Token sent to your email");
        } catch (\Exception $e) {
            $response = array("status" => 400, "message" => "Error");
        }

        return $response;
    }
}
