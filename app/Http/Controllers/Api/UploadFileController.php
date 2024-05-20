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
        $userId = $request->input('user_id');
        $fileName =$request->input('file_name');
        $fileSize = $request->input('file_size');
        $upload_at = $request->input('upload_at');

        $pdfFile = $request->file('pdf');
       
        $uniquePdfFileName = "user_" . $userId . "_" . uniqid() . '.' . "pdf";
        $pdfPath = $pdfFile->storeAs('public/pdfs', $uniquePdfFileName);
        
        // Tạo URL đầy đủ cho tệp PDF
        $fullPdfUrl = url(Storage::url($pdfPath));

        $file->user_id = $userId;
        $file->url = $fullPdfUrl;
        $file->file_name = $fileName;
        $file->file_size = $fileSize;
        $file->upload_at = $upload_at;
        $file->save();



        // Trả về phản hồi thành công hoặc thông tin khác
        return response()->json([
            'message' => 'File uploaded successfully',
            'name' => $file->file_name  . " " . $file->file_size,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        $file = File::where('user_id', $userId)->firstOrFail();
        return $file;
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
    public function destroy(string $userId)
    {
        $file = File::where('user_id', $userId)->firstOrFail();

        $fullFilePath = $file->url;

    // Loại bỏ phần đầu /storage để có đường dẫn tương đối
    $relativeFilePath = ltrim(parse_url($fullFilePath, PHP_URL_PATH), '/');

    // Điều chỉnh đường dẫn để tương thích với hệ thống file của Laravel
    $storagePath = str_replace('storage/', 'public/', $relativeFilePath);

    // Xóa file từ hệ thống file nếu nó tồn tại
    if (Storage::exists($storagePath)) {
        Storage::delete($storagePath);
    }

        $file->delete();
        return response()->json([
            'message' => 'File deleted successfully',
            'name' => $relativeFilePath  . " " .  $storagePath,
        ]);
    }
}