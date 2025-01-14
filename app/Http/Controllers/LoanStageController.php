<?php

namespace App\Http\Controllers;

use App\Services\LoanStageService;
use DataTables;
use App\Models\LoanStage;
use Illuminate\Http\Request;

class LoanStageController extends Controller
{
    protected $LoanStageService;

    public function __construct()
    {
        $this->LoanStageService = new LoanStageService();
    }

    public function getAllLoanStages(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->LoanStageService->fetchRecord($data);

            return DataTables::of($record)
                ->addColumn('is_active', function ($rec) {
                    if ($rec->is_active == 1) {
                        return '<div><span class="tb-status text-success" onclick="changeStatus(' . $rec->id . ',0)">Active</span></div>';
                    } else {
                        return '<div><span class="tb-status text-danger" onclick="changeStatus(' . $rec->id . ',1)">Inactive</span></div>';
                    }
                })->rawColumns(['is_active'])->make(true);
        }
        return view('loan_stages.all');
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if (!empty($id)) {
            $response = LoanStage::where('id', $id)->update([
                'is_active' => $status,
            ]);
            if ($response) {
                $message = "Inactive status change successfully";
                if ($status == 1) {
                    $message = "Active status change successfully";
                }
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Invalid Data']);
    }
}
