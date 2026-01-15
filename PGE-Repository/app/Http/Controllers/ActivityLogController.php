<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Aktivitas::with(['user', 'dokumen']);

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('nama', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('dokumen', function($docQuery) use ($search) {
                    $docQuery->where('judul', 'like', "%{$search}%");
                });
            });
        }

        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter by action type
        if ($request->has('action_type') && $request->action_type) {
            $query->where('action', $request->action_type);
        }

        // Statistics
        $totalActivities = Aktivitas::count();
        $downloads = Aktivitas::where('action', 'downloaded')->count();
        $uploads = Aktivitas::where('action', 'uploaded')->count();
        $views = Aktivitas::where('action', 'viewed')->count();
        $edits = Aktivitas::where('action', 'edited')->count();

        // Get paginated results
        $activities = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.activity-logs', compact('activities', 'totalActivities', 'downloads', 'uploads', 'views', 'edits'));
    }

    public function export(Request $request)
    {
        $query = Aktivitas::with(['user', 'dokumen']);

        // Apply same filters as index
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('nama', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('dokumen', function($docQuery) use ($search) {
                    $docQuery->where('judul', 'like', "%{$search}%");
                });
            });
        }

        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->has('action_type') && $request->action_type) {
            $query->where('action', $request->action_type);
        }

        $activities = $query->orderBy('created_at', 'desc')->get();

        $filename = 'activity_logs_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($activities) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['User', 'Email', 'Action', 'Document', 'Timestamp', 'IP Address']);
            
            // Data
            foreach ($activities as $activity) {
                fputcsv($file, [
                    $activity->user->nama ?? '-',
                    $activity->user->email ?? '-',
                    $activity->action,
                    $activity->dokumen->judul ?? '-',
                    $activity->created_at->format('Y-m-d H:i:s'),
                    $activity->ip_address ?? '-',
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getNotifications()
    {
        $notifications = Aktivitas::with(['user', 'dokumen'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($activity) {
                return [
                    'id' => $activity->id_aktivitas,
                    'user' => $activity->user->nama ?? 'Unknown',
                    'action' => $activity->action,
                    'document' => $activity->dokumen->judul ?? 'Unknown Document',
                    'time' => $activity->created_at->diffForHumans(),
                    'timestamp' => $activity->created_at->toIso8601String(),
                ];
            });

        $unreadCount = Aktivitas::where('created_at', '>', now()->subHours(24))->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount > 0 ? $unreadCount : 0,
        ]);
    }
}

