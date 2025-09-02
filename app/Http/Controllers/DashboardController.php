<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Run one query to get all counts
        $counts = DB::selectOne("
            SELECT 
                (SELECT COUNT(*) FROM notifications) AS notificationsCount,
                (SELECT COUNT(*) FROM performances) AS performanceCount,
                (SELECT COUNT(*) FROM events) AS eventsCount,
                (SELECT COUNT(*) FROM participations WHERE attendance = 1) AS attendanceCount,
                (SELECT COUNT(*) FROM athletes WHERE status = 'active') AS athletesCount
        ");

        // Extract values
        $notificationsCount = $counts->notificationsCount;
        $performanceCount   = $counts->performanceCount;
        $eventsCount        = $counts->eventsCount;
        $attendanceCount    = $counts->attendanceCount;
        $athletesCount      = $counts->athletesCount;

        // Chart Data (Donut + Bar)
        $donutData = [
            'athletes'     => $athletesCount,
            'performance'  => $performanceCount,
            'events'       => $eventsCount,
            'attendance'   => $attendanceCount,
        ];

        $barData = [
            'athletes'     => $athletesCount * 0.8, // Example scaling
            'performance'  => $performanceCount * 1.2,
            'events'       => $eventsCount,
            'attendance'   => $attendanceCount,
        ];

        return view('athlete.dashboard', compact(
            'notificationsCount',
            'performanceCount',
            'eventsCount',
            'attendanceCount',
            'donutData',
            'barData'
        ));
    }
}
