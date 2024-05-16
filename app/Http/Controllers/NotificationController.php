<?php

namespace App\Http\Controllers;

use App\Models\FcmNotification;
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

        $fcmTokens = ['cVunXsWqR1G6UgT1X2jsZ7:APA91bGQtgF5wWl32_VvZk46eEKh3tcOA3_4xLOYm9v8q_HudGaQnfJTb9YKjZXb5cplOggQrXHa7BMbbsfhR_dYJmkVBg5BrfTnvG3JmC2IUTkPCKjlCbvVT3K4zivRaqRXiBjHLn39',
        'csGT20CvSPm72tuF361miK:APA91bHB7BzcYFuTn6L3QDiwIWrcke5ZTm2-gTT8j4Yh3KvnY2_v2S9FIXFn-miXdfu4d-RjsCt5C1DsGyUc4zHtSbCY8vZKkePSQMKHYC7RRUtroXeYLZpSAklAHOJiZZeZNJpXsuOK'
        ];

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
