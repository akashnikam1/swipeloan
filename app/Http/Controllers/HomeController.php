<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoanRequest;
use App\Models\LoanLimitRequest;
use App\Models\Partner;
use App\Models\ContactUs;
use App\Models\Feedback;
use App\Models\Payment;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        if (is_null($fromDate) || is_null($toDate)) {
            $startOfMonth = Carbon::now()->startOfMonth()->format('d M, Y');
            $middleOfMonth = Carbon::now()->startOfMonth()->addDays((Carbon::now()->endOfMonth()->day - 1) / 2)->format('d M, Y');
            $endOfMonth = Carbon::now()->endOfMonth()->format('d M, Y');
    
            $paymentFromDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $paymentToDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        } else {
            $fromDate = Carbon::parse($fromDate);
            $toDate = Carbon::parse($toDate);

            $startOfMonth = $fromDate->format('d M, Y');
            $middleOfMonth = $fromDate->addDays($fromDate->diffInDays($toDate) / 2)->format('d M, Y');
            $endOfMonth = $toDate->format('d M, Y');
    
            $paymentFromDate = $fromDate->format('Y-m-d');
            $paymentToDate = $toDate->format('Y-m-d');
        }

        $userQuery = User::query();
        $bannerQuery = Banner::query();
        $partnerQuery = Partner::query();
        $contactUsQuery = ContactUs::query();
        $feedbackQuery = Feedback::query();
        $loanlimitRequestQuery = LoanLimitRequest::with('users');
        $loanRequestQuery = LoanRequest::query();
        $paymentQuery = Payment::query();
        
        if ($fromDate && $toDate) {
            $userQuery->whereBetween('created_at', [$fromDate, $toDate]);
            $bannerQuery->whereBetween('created_at', [$fromDate, $toDate]);
            $partnerQuery->whereBetween('created_at', [$fromDate, $toDate]);
            $contactUsQuery->whereBetween('created_at', [$fromDate, $toDate]);
            $feedbackQuery->whereBetween('created_at', [$fromDate, $toDate]);
            $loanlimitRequestQuery->whereBetween('created_at', [$fromDate, $toDate]);
            $paymentQuery->whereBetween('payment_completed_date', [$paymentFromDate, $paymentToDate]);
        }

        $totalLoanRequests = $loanRequestQuery->count();

        $statusCounts = [
            'pending' => LoanRequest::where('loan_status', 0)
                                    ->when($fromDate && $toDate, fn($query) => $query->whereBetween('pending_on', [$fromDate, $toDate]))
                                    ->count(),
            'approved' => LoanRequest::where('loan_status', 1)
                                     ->when($fromDate && $toDate, fn($query) => $query->whereBetween('approved_on', [$fromDate, $toDate]))
                                     ->count(),
            'ongoing' => LoanRequest::where('loan_status', 2)
                                    ->when($fromDate && $toDate, fn($query) => $query->whereBetween('ongoing_on', [$fromDate, $toDate]))
                                    ->count(),
            'closed' => LoanRequest::where('loan_status', 3)
                                   ->when($fromDate && $toDate, fn($query) => $query->whereBetween('closed_on', [$fromDate, $toDate]))
                                   ->count(),
        ];

        $percentages = array_map(fn($count) => $totalLoanRequests > 0 ? round(($count / $totalLoanRequests) * 100, 2) : 0, $statusCounts);


        $emiCollection = $paymentQuery->where('status', 1)->sum('total_amount');
        $disbursedAmount = LoanRequest::whereNotNull('disbursed_date')
                ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
                    return $query->whereBetween('disbursed_date', [$fromDate, $toDate]);
                })
                ->sum('disbursed_amount');    
        $profit = $emiCollection - $disbursedAmount;
        $loanUserCount = LoanRequest::where('loan_status', 2)
                ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
                    return $query->whereBetween('ongoing_on', [$fromDate, $toDate]);
                })
                ->distinct('user_id')
                ->count('user_id');

        $labels = [];
        $paymentData = [];
    
        for ($date = Carbon::parse($paymentFromDate); $date->lte(Carbon::parse($paymentToDate)); $date->addDay()) {
            $formattedDate = $date->format('d M'); 
            $labels[] = $formattedDate;
    
            $dailyTotal = Payment::whereDate('payment_completed_date', $date->toDateString())->sum('total_amount');
            $paymentData[] = $dailyTotal;
        }

        $data = [
            'userCount' => $userQuery->where('role_id', 2)
                            ->where('is_active', 1)
                            ->count(),
            'personalDetailStageCount' => $userQuery->where('role_id', 2)
                            ->where('is_active', 1)
                            ->whereIn('user_application_status', [1, 2, 3, 4])
                            ->count(),
            'kycDetailStageCount' => $userQuery->where('role_id', 2)
                            ->where('is_active', 1)
                            ->whereIn('user_application_status', [2, 3, 4])
                            ->count(),
            'bankVerificationStageCount' => $userQuery->where('role_id', 2)
                            ->where('is_active', 1)
                            ->whereIn('user_application_status', [3, 4])
                            ->count(),
            'incomeDetailStageCount' => $userQuery->where('role_id', 2)
                            ->where('is_active', 1)
                            ->where('user_application_status', 4)
                            ->count(),
            'bannerCount' => $bannerQuery->where('is_active', 1)
                                        ->count(),
            'partnerCount' => $partnerQuery->where('is_active', 1)
                                        ->count(),
            'defaulterCount' => $userQuery->where('is_defaulter', 1)
                                            ->count(),
            'contactUsCount' => $contactUsQuery->count(),
            'feedbackCount' => $feedbackQuery->count(),
            'loanLimitRequests' => $loanlimitRequestQuery->latest()->take(5)->get(),
            'totalLoanRequests' => $totalLoanRequests,
            'statusCounts' => $statusCounts,
            'percentages' => $percentages,
            'loanUserCount' => $loanUserCount,
            'emiCollection' => number_format($emiCollection, 0), 
            'disbursedAmount' => number_format($disbursedAmount, 0),
            'profit' => number_format($profit, 0), 
            'analyticOvPaymentData' => [
                'labels' => $labels,
                'paymentData' => $paymentData
            ],
            'startOfMonth' => $startOfMonth,
            'middleOfMonth' => $middleOfMonth,
            'endOfMonth' => $endOfMonth
        ];

        return view('dashboard', $data);
    }
}