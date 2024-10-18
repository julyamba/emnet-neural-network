<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class VideoUploadController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return Inertia::render('VideoUpload', ['videos' => $videos]);
    }

    public function uploadChunk(Request $request)
    {
        // dd($request->input('name'));
        $request->validate([
            'file' => 'required|file',
            'chunk' => 'required|integer',
            'totalChunks' => 'required|integer',
        ]);

        $file = $request->file('file');
        $chunk = $request->input('chunk');
        $totalChunks = $request->input('totalChunks');

        $filename = $request->input('name');
        $chunkFilename = "chunk_{$chunk}_{$filename}";

        Storage::disk('local')->putFileAs('tmp_chunks', $file, $chunkFilename);

        if ($chunk == $totalChunks - 1) {
            // All chunks received, merge the file
            $this->mergeChunks($filename, $totalChunks);
            return response()->json(['message' => 'File uploaded successfully']);
        }

        // return response()->json(['message' => 'Chunk uploaded successfully']);
    }

    private function mergeChunks($filename, $totalChunks)
    {
        $finalPath = storage_path("app/public/videos/{$filename}");
        $out = fopen($finalPath, "wb");

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkFilename = "chunk_{$i}_{$filename}";
            $in = fopen(storage_path("app/tmp_chunks/{$chunkFilename}"), "rb");
            stream_copy_to_stream($in, $out);
            fclose($in);
            unlink(storage_path("app/tmp_chunks/{$chunkFilename}"));
        }

        fclose($out);

        // Create video record in database
        Video::create([
            'title' => pathinfo($filename, PATHINFO_FILENAME),
            'filename' => $filename,
            'path' => "videos/{$filename}",
            'mime_type' => mime_content_type($finalPath),
            'size' => filesize($finalPath),
        ]);
    }
}