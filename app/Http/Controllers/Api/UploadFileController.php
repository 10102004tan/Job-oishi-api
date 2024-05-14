<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lấy dữ liệu từ yêu cầu
        $userId = $request->input('user_id'); // Lấy giá trị user_id từ yêu cầu
        $file = $request->file('name'); // Lấy tệp PDF từ yêu cầu

        // Xử lý tệp PDF ở đây
        $path = $file->store('pdfs');

        // Trả về phản hồi thành công hoặc thông tin khác
        return response()->json([
            'message' => 'File uploaded successfully',
            'name' => $file
        ]);
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
