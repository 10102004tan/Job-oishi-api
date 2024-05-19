<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

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
        $file = new File();
        $userId = $request->input('user_id'); // Lấy giá trị user_id từ yêu cầu
        $pdfFile = $request->file('pdf');
        $uniquePdfFileName = "user_" . $userId . "_" . uniqid() . '.' . "pdf";
        $pdfPath = $pdfFile->storeAs('public/pdfs', $uniquePdfFileName);
        
        // Tạo URL đầy đủ cho tệp PDF
        $fullPdfUrl = url(Storage::url($pdfPath));
        $file->user_id = $userId;
        $file->url = $fullPdfUrl;
        $file->save();



        // Trả về phản hồi thành công hoặc thông tin khác
        return response()->json([
            'message' => 'File uploaded successfully',
            'name' => $fullPdfUrl,
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
