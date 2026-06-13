<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MarketingUser;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalUsers = User::count();
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $totalMarketing = MarketingUser::count();
        
        $totalTransactions = Transaction::count();
        $totalPemasukan = Transaction::where('jenis', 'masuk')->where('status', 'berhasil')->sum('nominal');
        $totalPengeluaran = Transaction::where('jenis', 'keluar')->where('status', 'berhasil')->sum('nominal');
        
        // For recent activities
        $recentTransactions = Transaction::latest()->take(5)->get();

        // Calculate monthly stats for the current year
        $currentYear = Carbon::now()->year;
        $stats = Transaction::selectRaw('MONTH(tanggal) as month, jenis, SUM(nominal) as total')
            ->whereYear('tanggal', $currentYear)
            ->where('status', 'berhasil')
            ->groupBy('month', 'jenis')
            ->get();
            
        $monthlyPemasukan = array_fill(0, 12, 0);
        $monthlyPengeluaran = array_fill(0, 12, 0);
        
        foreach ($stats as $stat) {
            $index = $stat->month - 1;
            if ($stat->jenis == 'masuk') {
                $monthlyPemasukan[$index] = (float) $stat->total;
            } else {
                $monthlyPengeluaran[$index] = (float) $stat->total;
            }
        }

        return view('dashboard', compact(
            'totalUsers', 
            'newUsersThisMonth', 
            'totalMarketing', 
            'totalTransactions',
            'totalPemasukan',
            'totalPengeluaran',
            'recentTransactions',
            'monthlyPemasukan',
            'monthlyPengeluaran',
            'currentYear'
        ));
    }
}
