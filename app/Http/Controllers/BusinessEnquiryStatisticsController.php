<?php

namespace App\Http\Controllers;

use App\Models\BusinessEnquiryStatistics;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class BusinessEnquiryStatisticsController extends Controller
{
    public function getAllBusinessEnquiryStatistics(Request $request)
    {
        if ($request->ajax()) {
            $fromDate = ($request->has('from_date') && $request->from_date != null) ? Carbon::parse($request->from_date)->format('Y-m-d') : null;
            $toDate = ($request->has('to_date') && $request->to_date != null) ? Carbon::parse($request->to_date)->format('Y-m-d') : null;

            $record = BusinessEnquiryStatistics::with('users')->get();

            if ($fromDate && $toDate) {
                $record = $record->filter(function ($item) use ($fromDate, $toDate) {
                    $clickDates = json_decode($item->click_dates, true);
                    $filteredDates = array_filter($clickDates, function ($date) use ($fromDate, $toDate) {
                        return $date >= $fromDate && $date <= $toDate;
                    });

                    $item->click_dates = json_encode(array_values($filteredDates));

                    return count($filteredDates) > 0;
                });
            }

            $flattenedRecords = $record->map(function ($item) {
                $user = $item->users;
                $clickDates = json_decode($item->click_dates, true);

                return collect($clickDates)->map(function ($date) use ($item, $user) {
                    return [
                        'first_name' => $user ? $user->first_name : 'NA',
                        'last_name' => $user ? $user->last_name : 'NA',
                        'phone_number' => $user ? $user->phone_number : 'NA',
                        'click_date' => $date,
                    ];
                });
            })->flatten(1)->sortByDesc('click_date')->values();

            $totalClickCount = $flattenedRecords->count();
            $totalUserCount = $flattenedRecords->pluck('phone_number')->unique()->count();

            return DataTables::of($flattenedRecords)
                ->with('totalClickCount', $totalClickCount)
                ->with('totalUserCount', $totalUserCount)
                ->make(true);
        }

        $totalClickCount = BusinessEnquiryStatistics::sum('click_count');
        $totalUserCount = BusinessEnquiryStatistics::count();

        return view('business_enquiry_statistics.all', compact('totalClickCount', 'totalUserCount'));
    }

}
