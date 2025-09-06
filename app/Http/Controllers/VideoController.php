<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('sheep')->latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function store(Request $request, GoogleDriveService $drive)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi|max:200000',
            'sheep_id' => 'required|exists:sheep,id'
        ]);

        $file = $request->file('video');
        $localPath = $file->getPathname();
        $fileName = 'domba_' . time() . '.' . $file->getClientOriginalExtension();

        $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
        $uploaded = $drive->uploadVideo($localPath, $fileName, $folderId);

        Video::create([
            'sheep_id' => $request->sheep_id,
            'user_id' => Auth::id(),
            'title' => $fileName,
            'drive_file_id' => $uploaded->id,
            'drive_link' => $uploaded->webViewLink,
        ]);

        return back()->with('success', 'Video berhasil diupload!');
    }

    public function destroy(Video $video, GoogleDriveService $drive)
    {
        $drive->deleteVideo($video->drive_file_id);
        $video->delete();

        return back()->with('success', 'Video berhasil dihapus!');
    }
}
