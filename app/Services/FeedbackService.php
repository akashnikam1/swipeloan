<?php

namespace App\Services;

use App\Models\Feedback;

class FeedbackService
{
    protected $FeedbackModel;

    public function __construct()
    {
        $this->FeedbackModel = new Feedback();
    }

    public function fetchRecord($data = [])
    {
        $feedbacks = [];
    
        $this->FeedbackModel->with('users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$feedbacks) {
            foreach ($chunk as $feedback) {
                $feedbacks[] = $feedback;
            }
        });
    
        return collect($feedbacks);
    }
}