<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    protected $PartnerService;

    public function __construct()
    {
        $this->PartnerService = new PartnerService();
    }

    public function getAllPartners(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->PartnerService->fetchRecord($data);

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
                            <li><a href="' . url('partners/edit') . '/' . $rec->id . '"><em class="icon ni ni-edit"></em><span>Edit Partner</span></a></li>
                            <li><a href="javascript:void(0)" onclick="deleteRecord(' . $rec->id . ')"><em class="icon ni ni-trash"></em><span>Delete Partner</span></a></li>
                        </ul>
                    </div>
                    </div>
                    </li>
                </ul>';
                    return $actions;
                })->rawColumns(['action', 'is_active'])->make(true);
        }
        return view('partners.all');
    }

    public function getAddPartner()
    {
        return view('partners.add');
    }

    public function addPartner(Request $request)
    {
        $request->validate([
            'partner_image' => 'required|image|max:100',
            'partner_name' => 'required',
        ], [
            'partner_image.required' => 'The partner image field is required.',
            'partner_image.image' => 'The file must be an image.',
            'partner_image.max' => 'The image size must not exceed 50KB.',
            'partner_image.dimensions' => 'The image dimensions must be exactly 85x85 pixels.',
            'partner_name.required' => 'The partner name field is required.',
        ]);

        $partnerImagePath = NULL;
        if (isset($request->partner_image)) {
            $partnerImage = $request->file('partner_image');
            $number = rand(1111111, 999999);
            $partnerImagePath = "Partners/Partner{$number}.".$partnerImage->getClientOriginalExtension();
            Storage::putFileAs('public', $partnerImage, $partnerImagePath);
        }

        $data = $request->all();
        $data['partner_image'] = $partnerImagePath;
        $response = $this->PartnerService->addPartner($data);
        if ($response) {
            return redirect('partners/all')->with('success', 'Partner details added successfully.');
        }
        return redirect('partners/all')->with('error', 'Something went wrong');
    }

    public function getEditPartner($id)
    {
        $data = $this->PartnerService->fetch($id);
        if ($data) {
            return view('partners.edit', compact('data'));
        }
        return redirect('partners/all')->with('error', 'Something went wrong');
    }

    public function updatePartner(Request $request, $id)
    {
        $request->validate([
            'partner_image' => 'nullable|image|max:100|dimensions:width=85,height=85',
            'partner_name' => 'required',
        ], [
            'partner_image.image' => 'The file must be an image.',
            'partner_name.required' => 'The partner name field is required.',
            'partner_image.max' => 'The image size must not exceed 50KB.',
            'partner_image.dimensions' => 'The image dimensions must be exactly 85x85 pixels.',
        ]);

        $partnerImagePath = NULL;
        if ($request->hasFile('partner_image')) {
            $partner = $this->PartnerService->fetch($request->id);
            if ($partner && $partner->partner_image) {
                Storage::delete('public/' . $partner->partner_image);
            }

            $partnerImage = $request->file('partner_image');
            $number = rand(1111111, 999999);
            $partnerImagePath = "Partners/Partner{$number}.".$partnerImage->getClientOriginalExtension();
            Storage::putFileAs('public', $partnerImage, $partnerImagePath);
        }

        $data = $request->all();
        $data['id'] = $request->id;
        if ($partnerImagePath) {
            $data['partner_image'] = $partnerImagePath;
        }
        $response = $this->PartnerService->editPartner($data);
        if ($response) {
            return redirect('partners/all')->with('success', 'Partner details updated successfully.');
        }
        return redirect('partners/all')->with('error', 'Something went wrong');
    }

    public function deletePartner(Request $request)
    {
        $id = $request->id;

        if (!empty($id)) {
            $record = Partner::find($id);
            
            if ($record) {
                $record->delete();
                $message = "Partner deleted successfully.";
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Error, while deleting partner details.']);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if (!empty($id)) {
            $response = Partner::where('id', $id)->update([
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