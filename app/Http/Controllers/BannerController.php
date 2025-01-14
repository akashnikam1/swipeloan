<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    protected $BannerService;

    public function __construct()
    {
        $this->BannerService = new BannerService();
    }

    public function getAllBanners(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->BannerService->fetchRecord($data);

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
                        <li><a href="' . url('banners/edit') . '/' . $rec->id . '"><em class="icon ni ni-edit"></em><span>Edit Banner</span></a></li>';
                    if ($rec->is_active == 1) {
                        $actions .= '<li><a href="javascript:void(0)" onclick="deleteRecord(' . $rec->id . ')"><em class="icon ni ni-trash"></em><span>Delete Banner</span></a></li>';
                    }
                    $actions .= '</ul>
                </div>
                </div>
                </li>
                </ul>';
                    return $actions;
                })->rawColumns(['action', 'is_active'])->make(true);
        }
        return view('banners.all');
    }

    public function getAddBanner()
    {
        return view('banners.add');
    }

    public function addBanner(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|max:100|dimensions:width=320,height=145',
            'banner_link' => 'nullable|url'
        ], [
            'banner_image.required' => 'The image field is required.',
            'banner_image.image' => 'The file must be an image.',
            'banner_image.max' => 'The image size must not exceed 100KB.',
            'banner_image.dimensions' => 'The image dimensions must be exactly 320x145 pixels.',
            'banner_link.url' => 'The banner link must be a valid URL.',
        ]);        
   
        $bannerImagePath = NULL;
        if (isset($request->banner_image)) {
            $bannerImage = $request->file('banner_image');
            $number = rand(1111111, 999999);
            $bannerImagePath = "Banners/Banner{$number}.".$bannerImage->getClientOriginalExtension();
            Storage::putFileAs('public', $bannerImage, $bannerImagePath);
        }

        $data = $request->all();
        $data['banner_image'] = $bannerImagePath;
        $response = $this->BannerService->addBanner($data);
        if ($response) {
            return redirect('banners/all')->with('success', 'Banner added successfully.');
        }
        return redirect('banners/all')->with('error', 'Something went wrong');
    }

    public function getEditBanner($id)
    {
        $data = $this->BannerService->fetch($id);
        if ($data) {
            return view('banners.edit', compact('data'));
        }
        return redirect('banners/all')->with('error', 'Something went wrong');
    }

    public function updateBanner(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|max:100|dimensions:width=320,height=145',
            'banner_link' => 'nullable|url'
        ], [
            'banner_image.image' => 'The file must be an image.',
            'banner_image.max' => 'The image size must not exceed 100KB.',
            'banner_image.dimensions' => 'The image dimensions must be exactly 320x145 pixels.',
            'banner_link.url' => 'The banner link must be a valid URL.',
        ]);

        $bannerImagePath = NULL;
        if ($request->hasFile('banner_image')) {
            $banner = $this->BannerService->fetch($request->id);
            if ($banner && $banner->banner_image) {
                Storage::delete('public/' . $banner->banner_image);
            }

            $bannerImage = $request->file('banner_image');
            $number = rand(1111111, 999999);
            $bannerImagePath = "Banners/Banner{$number}.".$bannerImage->getClientOriginalExtension();
            Storage::putFileAs('public', $bannerImage, $bannerImagePath);
        }

        $data = $request->all();
        $data['id'] = $request->id;
        if ($bannerImagePath) {
            $data['banner_image'] = $bannerImagePath;
        }

        $response = $this->BannerService->editBanner($data);
        if ($response) {
            return redirect('banners/all')->with('success', 'Banner updated successfully.');
        }
        return redirect('banners/all')->with('error', 'Something went wrong');
    }

    public function deleteBanner(Request $request)
    {
        $id = $request->id;

        if (!empty($id)) {
            $record = Banner::find($id);
            
            if ($record) {
                $record->delete();
                $message = "Banner deleted successfully.";
                return response()->json(['status' => 'success', 'message' => $message]);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Error, while deleting banner.']);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if (!empty($id)) {
            $response = Banner::where('id', $id)->update([
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