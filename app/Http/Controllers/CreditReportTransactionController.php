<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CreditReportTransactionService;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class CreditReportTransactionController extends Controller
{
    protected $CreditReportTransactionService;

    public function __construct()
    {
        $this->CreditReportTransactionService = new CreditReportTransactionService();
    }

    public function getAllCreditReportTransactions(Request $request)
    {
        $users = User::where('role_id', 2)->get();

        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->CreditReportTransactionService->fetchRecord($data);

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

            return DataTables::of($record)->make(true);
        }

        return view('credit_report_transactions.all', compact('users'));
    }
}
