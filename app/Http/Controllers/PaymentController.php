<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Services\PaymentService;
use Carbon\Carbon;

class PaymentController extends Controller
{
    protected $PaymentService;

    public function __construct()
    {
        $this->PaymentService = new PaymentService();
    }

    public function getAllPayments(Request $request)
    {
        $users = User::where('role_id', 2)->get();

        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->PaymentService->fetchRecord($data);

            if ($request->has('from_date') && $request->has('to_date')) {
                $fromDate = $request->from_date;
                $toDate = Carbon::parse($request->to_date)->endOfDay();

                if ($fromDate && $toDate) {
                    $record = $record->whereBetween('payment_date', [$fromDate, $toDate]);
                }
            }

            if ($request->has('user_id') && $request->user_id != "null") {
                $userId = $request->user_id;
                $record = $record->where('user_id', $userId);
            }

            return DataTables::of($record)
            ->editColumn('payment_completed_date', function ($record) {
                if (!empty($record->payment_completed_date)) {
                    try {
                        return Carbon::parse($record->payment_completed_date)->format('d-m-Y H:i:s');
                    } catch (\Exception $e) {
                        return $record->payment_completed_date;
                    }
                } else {
                    return 'NA';
                }
            })
            ->addColumn('extra_charges', function ($rec) {
                $enach_charges = $rec->enach_charges;
                $gst_on_enach_charges = $rec->gst_on_enach_charges;
                $bounce_charges = $rec->bounce_charges;
                return $enach_charges + $gst_on_enach_charges + $bounce_charges;
            })
            ->rawColumns(['extra_charges'])->make(true);
        }
        return view('payments.all', compact('users'));
    }
}