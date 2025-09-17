<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        // Pending users (selain admin)
        $pendingUsers = User::where('status', 'pending')
            ->where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        // Approved + Inactive users (selain admin)
        $approvedUsers = User::where('status', 'active')
            ->where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('pendingUsers', 'approvedUsers'));
    }


    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->route('admin.users')->with('success', "Akses untuk {$user->name} telah disetujui ✅");
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', "Pengajuan akses untuk {$user->name} telah ditolak ❌");
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->status === 'active') {
            $user->status = 'pending'; // Suspend akun
        } elseif ($user->status === 'pending') {
            $user->status = 'active'; // Aktifkan kembali
        }

        $user->save();

        return back()->with('success', "Status akun {$user->name} berhasil diubah menjadi {$user->status}");
    }
}
