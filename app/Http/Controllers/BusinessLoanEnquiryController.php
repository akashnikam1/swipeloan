<?php

namespace App\Http\Controllers;

use App\Services\BusinessLoanEnquiryService;
use DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BusinessLoanEnquiryController extends Controller
{
    protected $BusinessLoanEnquiryService;

    public function __construct()
    {
        $this->BusinessLoanEnquiryService = new BusinessLoanEnquiryService();
    }

    public function getAllBusinessLoanEnquiries(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->BusinessLoanEnquiryService->fetchRecord($data);

            if ($request->has('from_date') && $request->has('to_date')) {
                $fromDate = $request->from_date;
                $toDate = Carbon::parse($request->to_date)->endOfDay();

                if ($fromDate && $toDate) {
                    $record = $record->whereBetween('created_at', [$fromDate, $toDate]);
                }
            }

            return DataTables::of($record)->make(true);
        }
        return view('businessLoanEnquiry.all');
    }
}
