<?php

namespace App\Http\Controllers;

use App\Models\Domba;
use Illuminate\Http\Request;
use App\Models\DombaPertumbuhan;
use Illuminate\Support\Facades\Storage;

class DombaPertumbuhanController extends Controller
{
    public function index(Domba $domba)
    {
        $pertumbuhan = DombaPertumbuhan::where('domba_id', $domba->id)->orderBy('bulan_ke')->get();
        return view('pages.pertumbuhan.index', compact('domba', 'pertumbuhan'));
    }

    public function store(Request $request, Domba $domba)
    {
        $validated = $request->validate([
            'bulan_ke' => 'required|integer|min:1',
            'berat_badan' => 'required|numeric|min:0',
            'video' => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg|max:20480', // max 20MB
        ]);

        $videoUrl = null;
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos/pertumbuhan', 'public');
            $videoUrl = Storage::url($path);
        }

        DombaPertumbuhan::create([
            'domba_id' => $domba->id,
            'bulan_ke' => $validated['bulan_ke'],
            'berat_badan' => $validated['berat_badan'],
            'video_url' => $videoUrl,
        ]);

        return redirect()->route('pertumbuhan.index', $domba->id)
            ->with('success', 'Data pertumbuhan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pertumbuhan = DombaPertumbuhan::findOrFail($id);
        $validated = $request->validate([
            'bulan_ke' => 'required|integer|min:1',
            'berat_badan' => 'required|numeric|min:0',
            'video' => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg|max:20480',
        ]);

        if ($request->hasFile('video')) {
            if ($pertumbuhan->video_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $pertumbuhan->video_url));
            }
            $path = $request->file('video')->store('videos/pertumbuhan', 'public');
            $pertumbuhan->video_url = Storage::url($path);
        }

        $pertumbuhan->update([
            'bulan_ke' => $validated['bulan_ke'],
            'berat_badan' => $validated['berat_badan'],
        ]);

        return redirect()->back()->with('success', 'Data pertumbuhan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pertumbuhan = DombaPertumbuhan::findOrFail($id);
        if ($pertumbuhan->video_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $pertumbuhan->video_url));
        }
        $pertumbuhan->delete();

        return redirect()->back()->with('success', 'Data pertumbuhan berhasil dihapus.');
    }
}
