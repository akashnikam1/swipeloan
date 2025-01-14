<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Services\ContactUsService;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    protected $ContactUsService;

    public function __construct()
    {
        $this->ContactUsService = new ContactUsService();
    }

    public function getAllContacts(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->ContactUsService->fetchRecord($data);

            return DataTables::of($record)
            ->editColumn('created_at', function ($record) {
                return Carbon::parse($record->created_at)->format('d-m-Y H:i:s');
            })->make(true);
        }
        return view('contact_us.all');
    }
}