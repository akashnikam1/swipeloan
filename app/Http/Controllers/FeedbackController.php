<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Services\FeedbackService;

class FeedbackController extends Controller
{
    protected $FeedbackService;

    public function __construct()
    {
        $this->FeedbackService = new FeedbackService();
    }

    public function getAllFeedbacks(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->FeedbackService->fetchRecord($data);

            return DataTables::of($record)->make(true);
        }
        return view('feedbacks.all');
    }
}