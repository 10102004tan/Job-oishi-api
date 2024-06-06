<?php

namespace App\Http\Controllers;

use App\Models\FcmNotification;
use App\Models\Notification as ModelsNotification;
use App\Models\User;
use App\Models\UserFcm;
use App\Notifications\FirebasePushNotification;
use App\Notifications\MyFcmNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('notification.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('notification.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $title = $request->input('title');
        $body = $request->input('body');
        $fcmTokens = [];

        $notification = new ModelsNotification();
            $notification->title = $title;
            $notification->content = $body;
            $notification->save();

        if ($request->type == '1'){

        }
        else if ($request->type == '2'){
            //insert notification for all users
            $users = User::all();
            foreach ($users as $user) {
                $user->notifications()->attach($notification->id);
            }

            $fcmTokens = UserFcm::where('is_active', 1)->pluck('fcm_token')->toArray();
        }
        else if ($request->type == '3'){
            $userIds = $request->input('users');
            $users = User::whereIn('id', $userIds)->get();
            foreach ($users as $user) {
                $user->notifications()->attach($notification->id);
            }
            $fcmTokens = UserFcm::whereIn('id', $userIds)
            ->where('is_active', 1)
            ->pluck('fcm_token')
            ->toArray();
        }
        foreach ($fcmTokens as $token) {
            Notification::route('fcm', $token)
                ->notify(new FirebasePushNotification($title, $body));
        }

        // Gửi thông báo
        return redirect()->route('notifications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //function get all notification
    public function getAllNotification()
    {
        $notifications = ModelsNotification::all();
        if ($notifications->isEmpty()){
            return response()->json([]);
        }
        return $notifications;
    }

    public function getAllNotficationByUserId(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        if (!$user){
            return response()->json([]);
        }
        $notifications = $user->notifications()->get(['title', 'content', 'user_notification.is_read','notifications.created_at','id']);
        $unreadCount = $user->notifications()->wherePivot('is_read', 0)->count();
        if ($notifications->isEmpty()){
            return [];
        }
        return [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ];
    }

    //function update read status
    public function updateReadStatus(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $userId = $request->input('user_id');
        $user = User::find($userId);
        if (!$user){
            return response()->json([]);
        }
        $user->notifications()->updateExistingPivot($notificationId, ['is_read' => 1]);
        return response()->json(['message' => 'success']);
    }
}
