<?php

namespace App\Http\Controllers;

use App\Models\Nbfc;
use App\Models\NbfcTransaction;
use App\Services\NbfcService;
use DataTables;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

class NbfcController extends Controller
{
    protected $NbfcService;

    public function __construct()
    {
        $this->NbfcService = new NbfcService();
    }

    public function getAllNbfcs(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->NbfcService->fetchRecord($data);

            return DataTables::of($record)
                ->addColumn('is_active', function ($rec) {
                    if ($rec->is_active == 1) {
                        return '<div><span class="tb-status text-success" onclick="changeStatus(' . $rec->id . ',0)">Active</span></div>';
                    } else {
                        return '<div><span class="tb-status text-danger" onclick="changeStatus(' . $rec->id . ',1)">Inactive</span></div>';
                    }
                })
                ->addColumn('action', function ($rec) {
                    $actions = '<ul class="nk-tb-actions gx-1 my-n1">
                    <li class="me-n1">
                        <div class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="' . url('nbfc/edit') . '/' . $rec->id . '"><em class="icon ni ni-edit"></em><span>Edit NBFC</span></a></li>
                            <li><a href="javascript:void(0)" onclick="deleteRecord(' . $rec->id . ')"><em class="icon ni ni-trash"></em><span>Delete NBFC</span></a></li>
                        </ul>
                    </div>
                    </div>
                    </li>
                </ul>';
                    return $actions;
                })->rawColumns(['action', 'is_active'])->make(true);
        }
        return view('nbfc.all');
    }

    public function getAddNbfc()
    {
        return view('nbfc.add');
    }

    public function addNbfc(Request $request)
    {
        $request->validate([
            'nbfc_name' => 'required',
            'payment_limit' => 'required|numeric|min:0',
            'razorpay_key' => 'required',
            'razorpay_secret' => 'required',
            'razorpayX_key' => 'required',
        ], [
            'nbfc_name.required' => 'The nbfc name field is required.',
            'payment_limit.required' => 'The payment limit field is required.',
            'payment_limit.numeric' => 'The payment limit must be a valid number.',
            'payment_limit.min' => 'The payment limit must be at least 0.',
            'razorpay_key.required' => 'The razorpay key field is required.',
            'razorpay_secret.required' => 'The razorpay secret field is required.',
            'razorpayX_key.required' => 'The razorpayX key field is required.',
        ]);

        $data = $request->all();
        $response = $this->NbfcService->addNbfc($data);
        if ($response) {
            return redirect('nbfc/all')->with('success', 'NBFC added successfully.');
        }
        return redirect('nbfc/all')->with('error', 'Something went wrong');
    }

    public function getEditNbfc($id, Request $request)
    {
        $data = $this->NbfcService->fetch($id);

        if ($data) {
            $nbfcTransaction = NbfcTransaction::where('nbfc_id', $id)->get();

            if ($request->ajax()) {
                return DataTables::of($nbfcTransaction)->make(true);
            }

            return view('nbfc.edit', compact('data'));
        }
        return redirect('nbfc/all')->with('error', 'Something went wrong');
    }

    public function updateNbfc(Request $request, $id)
    {
        $request->validate([
            'nbfc_name' => 'required',
            'razorpay_key' => 'required',
            'razorpay_secret' => 'required',
            'razorpayX_key' => 'required',
        ], [
            'nbfc_name.required' => 'The nbfc name field is required.',
            'razorpay_key.required' => 'The razorpay key field is required.',
            'razorpay_secret.required' => 'The razorpay secret field is required.',
            'razorpayX_key.required' => 'The razorpayX key field is required.',
        ]);

        $data = $request->all();
        $data['id'] = $request->id;
        $response = $this->NbfcService->editNbfc($data);

        if ($response) {
            return redirect('nbfc/all')->with('success', 'NBFC details updated successfully.');
        }
        return redirect('nbfc/all')->with('error', 'Something went wrong');
    }

    public function deleteNbfc(Request $request)
    {
        $id = $request->id;

        if (!empty($id)) {
            $record = Nbfc::find($id);

            if ($record) {
                $record->delete();
                $message = "NBFC deleted successfully.";
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Error, while deleting NBFC details.']);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if (!empty($id)) {
            $response = Nbfc::where('id', $id)->update([
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

    public function updateTransaction(Request $request)
    {
        $request->validate([
            'nbfc_id' => 'required|exists:nbfcs,id',
            'amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:ADD,DEDUCT',
        ], [
            'nbfc_id.required' => 'The NBFC ID field is required.',
            'nbfc_id.exists' => 'The selected NBFC ID is invalid.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a valid number.',
            'amount.min' => 'The amount must be at least 0.',
            'transaction_type.required' => 'The transaction type field is required.',
            'transaction_type.in' => 'The transaction type must be either ADD or DEDUCT.',
        ]);

        $nbfcId = $request->nbfc_id;
        $amount = $request->amount;
        $transactionType = $request->transaction_type;

        $nbfc = $this->NbfcService->fetch($nbfcId);

        if ($nbfc) {
            if ($transactionType == 'ADD') {
                $newPaymentLimit = $nbfc->payment_limit + $amount;
            } elseif ($transactionType == 'DEDUCT') {
                $newPaymentLimit = $nbfc->payment_limit - $amount;

                if ($newPaymentLimit < 0) {
                    return redirect('nbfc/all')->with('error', 'Insufficient payment limit');
                }
            }

            $nbfc->payment_limit = $newPaymentLimit;
            $nbfc->save();

            NbfcTransaction::create([
                'nbfc_id' => $nbfcId,
                'amount' => $amount,
                'transaction_type' => $transactionType,
            ]);

            $transactionMessage = ($transactionType == 'ADD') ? 'Amount added successfully.' : 'Amount deducted successfully.';
            return redirect('nbfc/edit/' . $nbfcId)->with('success', $transactionMessage);
        }

        return redirect('nbfc/edit/' . $nbfcId)->with('error', 'Something went wrong');
    }

    public function convertToWords(Request $request)
    {
        $request->validate([
            'payment_limit' => 'required',
        ], [
            'payment_limit.required' => 'The payment limit field is required.',
        ]);

        $number = $request->payment_limit;

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');

        $inWords = ucfirst($numberTransformer->toWords($number)) . '.';

        return response()->json([
            'number' => $number,
            'in_words' => $inWords,
        ]);
    }
}
