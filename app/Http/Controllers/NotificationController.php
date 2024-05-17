<?php

namespace App\Http\Controllers;

use App\Models\FcmNotification;
use App\Models\User;
use App\Models\UserFcm;
use App\Notifications\MyFcmNotification;
use Illuminate\Http\Request;
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
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $title = $request->input('title');
        $body = $request->input('body');
        $fcmTokens= UserFcm::where('is_active',1)->pluck('fcm_token')->toArray();
        $notifiables = array_map(function($fcmToken) {
            return new FcmNotification($fcmToken);
        }, $fcmTokens);
    
        Notification::send($notifiables, new MyFcmNotification($title, $body));
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
}
