<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function track(Request $request)
    {
        $validated = $request->validate([
            'visitor_id' => 'required|string|max:64',
            'page' => 'nullable|string|max:500',
            'referrer' => 'nullable|string|max:500',
            'is_new_visitor' => 'required|boolean',
        ]);

        $alreadyVisitedToday = Visitor::where('visitor_id', $validated['visitor_id'])
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadyVisitedToday) {
            return response()->json(['status' => 'already_tracked']);
        }

        Visitor::create([
            'visitor_id' => $validated['visitor_id'],
            'ip_address' => $request->ip(),
            'page' => $validated['page'] ?? '/',
            'user_agent' => substr($request->userAgent() ?? '', 0, 500),
            'referrer' => $validated['referrer'] ?? null,
            'is_new_visitor' => $validated['is_new_visitor'],
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function stats(Request $request)
    {
        $totalVisits = Visitor::count();
        $uniqueVisitors = Visitor::distinct('visitor_id')->count('visitor_id');

        $todayVisits = Visitor::whereDate('created_at', today())->count();
        $todayUnique = Visitor::whereDate('created_at', today())
            ->distinct('visitor_id')
            ->count('visitor_id');

        $last7DaysVisits = Visitor::where('created_at', '>=', now()->subDays(7))->count();
        $last7DaysUnique = Visitor::where('created_at', '>=', now()->subDays(7))
            ->distinct('visitor_id')
            ->count('visitor_id');

        $last30DaysVisits = Visitor::where('created_at', '>=', now()->subDays(30))->count();
        $last30DaysUnique = Visitor::where('created_at', '>=', now()->subDays(30))
            ->distinct('visitor_id')
            ->count('visitor_id');

        $dailyStats = Visitor::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_visits'),
                DB::raw('COUNT(DISTINCT visitor_id) as unique_visitors')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'total_visits' => $totalVisits,
            'unique_visitors' => $uniqueVisitors,
            'today' => [
                'visits' => $todayVisits,
                'unique' => $todayUnique,
            ],
            'last_7_days' => [
                'visits' => $last7DaysVisits,
                'unique' => $last7DaysUnique,
            ],
            'last_30_days' => [
                'visits' => $last30DaysVisits,
                'unique' => $last30DaysUnique,
            ],
            'daily' => $dailyStats,
        ]);
    }
}
