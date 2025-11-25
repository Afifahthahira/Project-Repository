<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDocuments = Dokumen::count();
        $totalUsers = User::count();
        $totalKategori = Kategori::count();
        $totalRak = Rak::count();

        // fitur belum ada → default
        $totalDownloads = 0;
        $totalViews = 0;

        // DATA CHART DOWNLOAD (dummy)
        $monthlyDownloads = [
            'Jan' => 12,
            'Feb' => 30,
            'Mar' => 22,
            'Apr' => 15,
            'May' => 50,
            'Jun' => 5,
        ];

        // POPULAR DOCUMENTS (dummy, dibuat jadi object biar ->title & ->downloads bisa dipakai)
        $popularDocuments = collect([
            (object)['title' => 'Document SOP Keamanan', 'downloads' => 120],
            (object)['title' => 'Panduan Operasional', 'downloads' => 95],
            (object)['title' => 'Prosedur Kerja', 'downloads' => 80],
        ]);

        // RECENT ACTIVITY (dummy)
        $recentActivities = collect([
            (object)[
                'user' => (object)['name' => 'Admin'],
                'action' => 'Uploaded Document',
                'document' => (object)['title' => 'SOP Keamanan'],
                'created_at' => now()->subMinutes(10)
            ],
            (object)[
                'user' => (object)['name' => 'User A'],
                'action' => 'Downloaded',
                'document' => (object)['title' => 'Panduan Operasional'],
                'created_at' => now()->subHours(1)
            ],
        ]);

        return view('admin.dashboard', compact(
            'totalDocuments',
            'totalUsers',
            'totalDownloads',
            'totalKategori',
            'totalRak',
            'totalViews',
            'monthlyDownloads',
            'popularDocuments',
            'recentActivities'
        ));
    }
}
