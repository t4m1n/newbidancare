<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity; // <-- Import model Activity

class ActivityLogController extends Controller
{
    public function index()
    {
        // Ambil data log, urutkan dari yang terbaru, dan paginasi
        // Eager load relasi 'causer' (user pelaku) dan 'subject' (objek yang diubah)
        $activities = Activity::with('causer', 'subject')
            ->latest()
            ->paginate(10);

        return view('admin.audit-logs.index', compact('activities'));
    }
}
