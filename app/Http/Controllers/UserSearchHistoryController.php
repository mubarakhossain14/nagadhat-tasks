<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSearchHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSearchHistoryController extends Controller
{
    public function index()
    {
        $search_histories = json_encode(UserSearchHistory::query()->latest()->take(10)->get()->toArray());

        $searchKeywords = UserSearchHistory::query()
            ->selectRaw('search_keyword, COUNT(*) as keyword_count')
            ->groupBy('search_keyword')
            ->orderBy('keyword_count', 'desc')
            ->get();

        $users = User::all();

        return view('user-search-history', compact('search_histories', 'searchKeywords','users') );
    }

    public function getFilteredData(Request $request): JsonResponse
    {
        $query = UserSearchHistory::query();

        if ($request->selectedKeywords) {
            $query->whereIn('search_keyword', $request->selectedKeywords);
        }

        if ($request->selectedUsers) {
            $query->whereIn('user_id', $request->selectedUsers);
        }

        if ($request->selectedTimeRange) {
            $now = now();

            $query->where(function ($query) use ($request, $now) {
                if (in_array('yesterday', $request->selectedTimeRange)) {
                    $query->orWhereDate('search_time', $now->subDays(1)->toDateString());
                }
                if (in_array('last_week', $request->selectedTimeRange)) {
                    $query->orWhereDate('search_time', '>=', $now->subWeek()->toDateString());
                }
                if (in_array('last_month', $request->selectedTimeRange)) {
                    $query->orWhereDate('search_time', '>=', $now->subMonth()->toDateString());
                }
            });
        }


        if ($request->startDate && $request->endDate) {
            $query->whereBetween('search_time', [$request->startDate, $request->endDate]);
        }


        $filteredResults = $query->with('user')
            ->orderBy('search_time', 'desc')
            ->get();

        return response()->json($filteredResults);
    }


}
