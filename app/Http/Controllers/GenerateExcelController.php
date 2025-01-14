<?php

namespace App\Http\Controllers;

use App\Models\CreditReportTransaction;
use App\Models\LoanRequest;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateExcelController extends Controller
{
    public function generateUserReport(Request $request)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('Harshita Gupta')
            ->setLastModifiedBy('Harshita Gupta')
            ->setTitle('User Report')
            ->setSubject('User Report')
            ->setDescription('User Report Excel Sheet')
            ->setKeywords('user report')
            ->setCategory('Report file');

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Roboto');

        $sheet->mergeCells('A1:E6');
        $sheet->getStyle('A1:E6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $drawing = new Drawing();
        $drawing->setName('User Report');
        $drawing->setDescription('KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $drawing->setPath(public_path('assets/images/app_logo.png'));
        $drawing->setHeight(70);
        $startColumn = 'C';
        $endColumn = 'D';
        $startRow = 1;
        $endRow = 4;

        $startCell = $startColumn . $startRow;
        $endCell = $endColumn . $endRow;

        $leftOffset = round(($sheet->getColumnDimension($startColumn)->getWidth() + $sheet->getColumnDimension($endColumn)->getWidth()) / 2);
        $topOffset = round(($sheet->getRowDimension($startRow)->getRowHeight() + $sheet->getRowDimension($endRow)->getRowHeight()) / 2);

        $drawing->setCoordinates($startCell);
        $drawing->setOffsetX($leftOffset + 120);
        $drawing->setOffsetY($topOffset + 5);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        $sheet->mergeCells('A1:E4');
        $sheet->getStyle('A1:E4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('A5', 'KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $sheet->mergeCells('A5:E5');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A5')->getFont()->setBold(true)->setSize(18)->getColor()->setARGB('1AA0A0');

        $addressPart1 = 'OFFICE NO 219 FLR 2 GERA, IMPERIUM RISE NR WIPRO, Infotech Park,';
        $addressPart2 = ' Hinjawadi, Pune, Haveli, Maharashtra, India, 411057';
        $fullAddress = $addressPart1 . "\n" . $addressPart2;

        $sheet->setCellValue('A6', $fullAddress);
        $sheet->mergeCells('A6:E6');
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(10);

        $title = 'User Report';

        $sheet->setCellValue('A7', $title);
        $sheet->mergeCells('A7:E7');
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(16);

        $headings = [
            'First Name', 'Last Name', 'Mobile Number', 'Email Id', 'Credit Score',
        ];

        $columnIndex = 'A';
        foreach ($headings as $heading) {
            $sheet->setCellValue($columnIndex . '9', $heading);
            $sheet->getStyle($columnIndex . '9')->getFont()->setBold(true);
            $columnIndex++;
        }

        $query = User::where('role_id', 2);

        if ($request->loanStatus !== null) {
            $query->where('loan_status', $request->loanStatus);
        }

        $users = $query->orderBy('id', 'desc')->get();

        $rowIndex = 10;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $rowIndex, ($user->first_name) ? ($user->first_name) : 'NA');
            $sheet->setCellValue('B' . $rowIndex, ($user->last_name) ? ($user->last_name) : 'NA');
            $sheet->setCellValue('C' . $rowIndex, ($user->phone_number) ? ($user->phone_number) : 'NA');
            $sheet->setCellValue('D' . $rowIndex, ($user->email) ? ($user->email) : 'NA');
            $sheet->setCellValue('E' . $rowIndex, ($user->cibil_score) ? ($user->cibil_score) : 'NA');
            $rowIndex++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
        }

        $writer = new Xlsx($spreadsheet);
        ob_clean();

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'UserReport_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function generateLoanReport(Request $request)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('Harshita Gupta')
            ->setLastModifiedBy('Harshita Gupta')
            ->setTitle('Loan Report')
            ->setSubject('Loan Report')
            ->setDescription('Loan Report Excel Sheet')
            ->setKeywords('loan report')
            ->setCategory('Report file');

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Roboto');

        $sheet->mergeCells('A1:Y6');
        $sheet->getStyle('A1:Y6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $drawing = new Drawing();
        $drawing->setName('Loan Report');
        $drawing->setDescription('KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $drawing->setPath(public_path('assets/images/app_logo.png'));
        $drawing->setHeight(70);
        $startColumn = 'M';
        $endColumn = 'N';
        $startRow = 1;
        $endRow = 4;

        $startCell = $startColumn . $startRow;
        $endCell = $endColumn . $endRow;

        $leftOffset = round(($sheet->getColumnDimension($startColumn)->getWidth() + $sheet->getColumnDimension($endColumn)->getWidth()) / 2);
        $topOffset = round(($sheet->getRowDimension($startRow)->getRowHeight() + $sheet->getRowDimension($endRow)->getRowHeight()) / 2);

        $drawing->setCoordinates($startCell);
        $drawing->setOffsetX($leftOffset + 170);
        $drawing->setOffsetY($topOffset + 5);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        $sheet->mergeCells('A1:Y4');
        $sheet->getStyle('A1:Y4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('A5', 'KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $sheet->mergeCells('A5:Y5');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A5')->getFont()->setBold(true)->setSize(18)->getColor()->setARGB('1AA0A0');

        $addressPart1 = 'OFFICE NO 219 FLR 2 GERA, IMPERIUM RISE NR WIPRO, Infotech Park,';
        $addressPart2 = ' Hinjawadi, Pune, Haveli, Maharashtra, India, 411057';
        $fullAddress = $addressPart1 . "\n" . $addressPart2;

        $sheet->setCellValue('A6', $fullAddress);
        $sheet->mergeCells('A6:Y6');
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(10);

        $title = 'Loan Report';
        if ($request->startDate && $request->endDate) {
            $dateRange = Carbon::parse($request->startDate)->format('d-m-Y') . ' to ' . Carbon::parse($request->endDate)->format('d-m-Y');
            $title .= ' (' . $dateRange;
        }

        if ($request->loanStatus) {
            $loanStatusMap = [
                0 => 'Pending',
                1 => 'Approved',
                2 => 'Ongoing',
                3 => 'Closed',
                4 => 'Declined',
            ];
            $loanStatusText = isset($loanStatusMap[$request->loanStatus]) ? $loanStatusMap[$request->loanStatus] : '';
            $title .= ($request->startDate && $request->endDate ? ' && ' : ' (') . $loanStatusText;
        }

        if ($request->startDate && $request->endDate || $request->loanStatus) {
            $title .= ')';
        }

        $sheet->setCellValue('A7', $title);
        $sheet->mergeCells('A7:Y7');
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(16);

        $headings = [
            'Sr No.', 'Loan Number', 'Loan Status', 'First Name', 'Last Name', 'Phone Number', 'Email', 'CIBIL Score', 'Credit Limit',
            'Loan Amount', 'Documentation Fee', 'UP Front Charges', 'Net Disbursed Amount', 'Pre Interest Amount', 'Disbursed Amount',
            'Disbursed Date', 'Tenure', 'EMI Amount', 'Technology Fee', 'Post Service Fee', 'EMI Start Date', 'EMI End Date', 'Loan Type',
            'Lender', 'Declined Reason',
        ];

        $columnIndex = 'A';
        foreach ($headings as $heading) {
            $sheet->setCellValue($columnIndex . '9', $heading);
            $sheet->getStyle($columnIndex . '9')->getFont()->setBold(true);
            $columnIndex++;
        }

        $query = LoanRequest::with('users')->newQuery();

        if ($request->loanStatus !== null) {
            $query->where('loan_status', $request->loanStatus);
        }

        if ($request->startDate && $request->endDate) {
            $query->whereBetween('created_at', [$request->startDate, $request->endDate]);
        }

        $loanRequests = $query->get();

        $loanStatusMap = [
            0 => ['status' => 'Pending', 'color' => 'FFFF00'],
            1 => ['status' => 'Approved', 'color' => '00FF00'],
            2 => ['status' => 'Ongoing', 'color' => '0000FF'],
            3 => ['status' => 'Closed', 'color' => '00FFFF'],
            4 => ['status' => 'Declined', 'color' => 'FF0000'],
        ];

        $serialNumber = 1;
        $rowIndex = 10;
        foreach ($loanRequests as $loanRequest) {
            $sheet->setCellValue('A' . $rowIndex, $serialNumber);
            $sheet->setCellValue('B' . $rowIndex, $loanRequest->loan_number);

            if (isset($loanStatusMap[$loanRequest->loan_status])) {
                $status = $loanStatusMap[$loanRequest->loan_status]['status'];
                $color = $loanStatusMap[$loanRequest->loan_status]['color'];
                $sheet->setCellValue('C' . $rowIndex, $status);
                $sheet->getStyle('C' . $rowIndex)->applyFromArray([
                    'font' => [
                        'color' => ['argb' => $color],
                    ],
                ]);
            } else {
                $sheet->setCellValue('C' . $rowIndex, 'NA');
            }

            $sheet->setCellValue('D' . $rowIndex, $loanRequest->users->first_name);
            $sheet->setCellValue('E' . $rowIndex, $loanRequest->users->last_name);
            $sheet->setCellValue('F' . $rowIndex, $loanRequest->users->phone_number);
            $sheet->setCellValue('G' . $rowIndex, $loanRequest->users->email);
            $sheet->setCellValue('H' . $rowIndex, $loanRequest->users->cibil_score);
            $sheet->setCellValue('I' . $rowIndex, $loanRequest->users->credit_limit);
            $sheet->setCellValue('J' . $rowIndex, $loanRequest->loan_amount);
            $sheet->setCellValue('K' . $rowIndex, $loanRequest->documentation_fee + $loanRequest->gst_on_documentation_fee);
            $sheet->setCellValue('L' . $rowIndex, $loanRequest->up_front_charges + $loanRequest->gst_on_up_front_charges);
            $sheet->setCellValue('M' . $rowIndex, $loanRequest->net_disbursed_amount);
            $sheet->setCellValue('N' . $rowIndex, $loanRequest->pre_interest_amount);
            $sheet->setCellValue('O' . $rowIndex, $loanRequest->disbursed_amount);
            $sheet->setCellValue('P' . $rowIndex, $loanRequest->disbursed_date ? Carbon::parse($loanRequest->disbursed_date)->format('d-m-Y') : 'NA');
            $sheet->setCellValue('Q' . $rowIndex, $loanRequest->tenure);
            $sheet->setCellValue('R' . $rowIndex, $loanRequest->emi_amount);
            $sheet->setCellValue('S' . $rowIndex, $loanRequest->technology_fee + $loanRequest->gst_on_technology_fee);
            $sheet->setCellValue('T' . $rowIndex, $loanRequest->post_service_fee + $loanRequest->gst_on_post_service_fee);
            $sheet->setCellValue('U' . $rowIndex, Carbon::parse($loanRequest->emi_start_date)->format('d-m-Y'));
            $sheet->setCellValue('V' . $rowIndex, Carbon::parse($loanRequest->emi_end_date)->format('d-m-Y'));
            $sheet->setCellValue('W' . $rowIndex, $loanRequest->loan_type);
            $sheet->setCellValue('X' . $rowIndex, $loanRequest->lender);
            $sheet->setCellValue('Y' . $rowIndex, $loanRequest->declined_reason ? $loanRequest->declined_reason : 'NA');
            $rowIndex++;
            $serialNumber++;
        }

        $sumColumns = ['J', 'K', 'L', 'M', 'N', 'O', 'R', 'S', 'T'];
        foreach ($sumColumns as $column) {
            $sumFormula = "=SUM($column" . "10:$column" . ($rowIndex - 1) . ")";
            $sheet->setCellValue($column . $rowIndex, $sumFormula);
            $sheet->getStyle($column . $rowIndex)->getFont()->setBold(true);
        }

        foreach (range('A', 'Y') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
        }

        $writer = new Xlsx($spreadsheet);
        ob_clean();

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'LoanReport_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function generatePaymentHistoryReport(Request $request)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('Harshita Gupta')
            ->setLastModifiedBy('Harshita Gupta')
            ->setTitle('Payment History Report')
            ->setSubject('Payment History Report')
            ->setDescription('Payment History Report Excel Sheet')
            ->setKeywords('payment history report')
            ->setCategory('Report file');

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Roboto');

        $sheet->mergeCells('A1:P6');
        $sheet->getStyle('A1:P6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $drawing = new Drawing();
        $drawing->setName('Loan Report');
        $drawing->setDescription('KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $drawing->setPath(public_path('assets/images/app_logo.png'));
        $drawing->setHeight(70);
        $startColumn = 'H';
        $endColumn = 'I';
        $startRow = 1;
        $endRow = 4;

        $startCell = $startColumn . $startRow;
        $endCell = $endColumn . $endRow;

        $leftOffset = round(($sheet->getColumnDimension($startColumn)->getWidth() + $sheet->getColumnDimension($endColumn)->getWidth()) / 2);
        $topOffset = round(($sheet->getRowDimension($startRow)->getRowHeight() + $sheet->getRowDimension($endRow)->getRowHeight()) / 2);

        $drawing->setCoordinates($startCell);
        $drawing->setOffsetX($leftOffset + 150);
        $drawing->setOffsetY($topOffset + 5);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        $sheet->mergeCells('A1:P4');
        $sheet->getStyle('A1:P4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('A5', 'KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $sheet->mergeCells('A5:P5');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A5')->getFont()->setBold(true)->setSize(18)->getColor()->setARGB('1AA0A0');

        $addressPart1 = 'OFFICE NO 219 FLR 2 GERA, IMPERIUM RISE NR WIPRO, Infotech Park,';
        $addressPart2 = ' Hinjawadi, Pune, Haveli, Maharashtra, India, 411057';
        $fullAddress = $addressPart1 . "\n" . $addressPart2;

        $sheet->setCellValue('A6', $fullAddress);
        $sheet->mergeCells('A6:P6');
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(10);

        $title = 'Payment History Report';
        if ($request->startDate && $request->endDate) {
            $dateRange = Carbon::parse($request->startDate)->format('d-m-Y') . ' to ' . Carbon::parse($request->endDate)->format('d-m-Y');
            $title .= ' (' . $dateRange;
        }

        if ($request->userId) {
            $user = User::find($request->userId);
            if ($user) {
                $userName = $user->first_name . ' ' . $user->last_name;
                $title .= ($request->startDate && $request->endDate ? ' && ' : ' (') . $userName;
            }
        }

        if ($request->startDate && $request->endDate || $request->userId) {
            $title .= ')';
        }

        $sheet->setCellValue('A7', $title);

        $sheet->mergeCells('A7:P7');
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(16);

        $headings = [
            'Sr No.', 'First Name', 'Last Name', 'Phone Number', 'Email', 'Loan Number', 'Transaction ID', 'Payment Amount',
            'E-Nach Charges', 'GST on E-Nach Charges', 'Bounce Charges', 'Total Amount', 'Payment Mode', 'Payment Date', 'Status',
            'Payment Completed Date',
        ];

        $columnIndex = 'A';
        foreach ($headings as $heading) {
            $sheet->setCellValue($columnIndex . '9', $heading);
            $sheet->getStyle($columnIndex . '9')->getFont()->setBold(true);
            $columnIndex++;
        }

        $query = Payment::with('users')->with('loans')->newQuery();

        if ($request->userId) {
            $query->where('user_id', $request->userId);
        }

        if ($request->startDate && $request->endDate) {
            $query->whereBetween('payment_date', [$request->startDate, $request->endDate]);
        }

        $payments = $query->get();

        $statusMap = [
            0 => ['status' => 'Pending', 'color' => 'FF0000'],
            1 => ['status' => 'Completed', 'color' => '00FF00'],
        ];

        $serialNumber = 1;
        $rowIndex = 10;
        foreach ($payments as $payment) {
            $sheet->setCellValue('A' . $rowIndex, $serialNumber);
            $sheet->setCellValue('B' . $rowIndex, $payment->users->first_name);
            $sheet->setCellValue('C' . $rowIndex, $payment->users->last_name);
            $sheet->setCellValue('D' . $rowIndex, $payment->users->phone_number);
            $sheet->setCellValue('E' . $rowIndex, $payment->users->email);
            $sheet->setCellValue('F' . $rowIndex, $payment->loans->loan_number);
            $sheet->setCellValue('G' . $rowIndex, $payment->transaction_id ? $payment->transaction_id : 'NA');
            $sheet->setCellValue('H' . $rowIndex, $payment->payment_amount);
            $sheet->setCellValue('I' . $rowIndex, $payment->enach_charges);
            $sheet->setCellValue('J' . $rowIndex, $payment->gst_on_enach_charges);
            $sheet->setCellValue('K' . $rowIndex, $payment->bounce_charges);
            $sheet->setCellValue('L' . $rowIndex, $payment->total_amount);
            $sheet->setCellValue('M' . $rowIndex, $payment->payment_mode ? $payment->payment_mode : 'NA');
            $sheet->setCellValue('N' . $rowIndex, Carbon::parse($payment->payment_date)->format('d-m-Y'));

            if (isset($statusMap[$payment->status])) {
                $status = $statusMap[$payment->status]['status'];
                $color = $statusMap[$payment->status]['color'];
                $sheet->setCellValue('O' . $rowIndex, $status);
                $sheet->getStyle('O' . $rowIndex)->applyFromArray([
                    'font' => [
                        'color' => ['argb' => $color],
                    ],
                ]);
            } else {
                $sheet->setCellValue('O' . $rowIndex, 'NA');
            }

            $sheet->setCellValue('P' . $rowIndex, $payment->payment_completed_date ? Carbon::parse($payment->payment_completed_date)->format('d-m-Y') : 'NA');
            $rowIndex++;
            $serialNumber++;
        }

        $sumColumns = ['H'];
        foreach ($sumColumns as $column) {
            $sumFormula = "=SUM($column" . "10:$column" . ($rowIndex - 1) . ")";
            $sheet->setCellValue($column . $rowIndex, $sumFormula);
            $sheet->getStyle($column . $rowIndex)->getFont()->setBold(true);
        }

        foreach (range('A', 'P') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
        }

        $writer = new Xlsx($spreadsheet);
        ob_clean();

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'PaymentHistoryReport_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function generateCreditTransactionReport(Request $request)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('Harshita Gupta')
            ->setLastModifiedBy('Harshita Gupta')
            ->setTitle('Credit Report Transaction')
            ->setSubject('Credit Report Transaction')
            ->setDescription('Credit Report Transaction Excel Sheet')
            ->setKeywords('credit_report_transaction')
            ->setCategory('Report file');

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Roboto');

        $sheet->mergeCells('A1:J6');
        $sheet->getStyle('A1:J6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $drawing = new Drawing();
        $drawing->setName('Credit Report Transaction');
        $drawing->setDescription('KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $drawing->setPath(public_path('assets/images/app_logo.png'));
        $drawing->setHeight(70);
        $startColumn = 'E';
        $endColumn = 'F';
        $startRow = 1;
        $endRow = 4;

        $startCell = $startColumn . $startRow;
        $endCell = $endColumn . $endRow;

        $leftOffset = round(($sheet->getColumnDimension($startColumn)->getWidth() + $sheet->getColumnDimension($endColumn)->getWidth()) / 2);
        $topOffset = round(($sheet->getRowDimension($startRow)->getRowHeight() + $sheet->getRowDimension($endRow)->getRowHeight()) / 2);

        $drawing->setCoordinates($startCell);
        $drawing->setOffsetX($leftOffset + 150);
        $drawing->setOffsetY($topOffset + 5);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        $sheet->mergeCells('A1:J4');
        $sheet->getStyle('A1:J4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('A5', 'KGIL FINTECH SOLUTIONS PRIVATE LIMITED');
        $sheet->mergeCells('A5:J5');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A5')->getFont()->setBold(true)->setSize(18)->getColor()->setARGB('1AA0A0');

        $addressPart1 = 'OFFICE NO 219 FLR 2 GERA, IMPERIUM RISE NR WIPRO, Infotech Park,';
        $addressPart2 = ' Hinjawadi, Pune, Haveli, Maharashtra, India, 411057';
        $fullAddress = $addressPart1 . "\n" . $addressPart2;

        $sheet->setCellValue('A6', $fullAddress);
        $sheet->mergeCells('A6:J6');
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(10);

        $title = 'Credit Report Transaction';
        if ($request->startDate && $request->endDate) {
            $dateRange = Carbon::parse($request->startDate)->format('d-m-Y') . ' to ' . Carbon::parse($request->endDate)->format('d-m-Y');
            $title .= ' (' . $dateRange;
        }

        if ($request->userId) {
            $user = User::find($request->userId);
            if ($user) {
                $userName = $user->first_name . ' ' . $user->last_name;
                $title .= ($request->startDate && $request->endDate ? ' && ' : ' (') . $userName;
            }
        }

        if ($request->startDate && $request->endDate || $request->userId) {
            $title .= ')';
        }

        $sheet->setCellValue('A7', $title);

        $sheet->mergeCells('A7:J7');
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(16);

        $headings = [
            'Sr No.', 'First Name', 'Last Name', 'Phone Number', 'Email', 'Transaction ID', 'Payment Amount',
            'Payment Mode', 'Payment Date', 'Status',
        ];

        $columnIndex = 'A';
        foreach ($headings as $heading) {
            $sheet->setCellValue($columnIndex . '9', $heading);
            $sheet->getStyle($columnIndex . '9')->getFont()->setBold(true);
            $columnIndex++;
        }

        $query = CreditReportTransaction::with('users')->newQuery();

        if ($request->userId) {
            $query->where('user_id', $request->userId);
        }

        if ($request->startDate && $request->endDate) {
            $query->whereBetween('payment_date', [$request->startDate, $request->endDate]);
        }

        $payments = $query->get();

        $statusMap = [
            0 => ['status' => 'Pending', 'color' => 'FF0000'],
            1 => ['status' => 'Completed', 'color' => '00FF00'],
        ];

        $serialNumber = 1;
        $rowIndex = 10;
        foreach ($payments as $payment) {
            $sheet->setCellValue('A' . $rowIndex, $serialNumber);
            $sheet->setCellValue('B' . $rowIndex, $payment->users->first_name);
            $sheet->setCellValue('C' . $rowIndex, $payment->users->last_name);
            $sheet->setCellValue('D' . $rowIndex, $payment->users->phone_number);
            $sheet->setCellValue('E' . $rowIndex, $payment->users->email);
            $sheet->setCellValue('F' . $rowIndex, $payment->transaction_id ? $payment->transaction_id : 'NA');
            $sheet->setCellValue('G' . $rowIndex, $payment->payment_amount);
            $sheet->setCellValue('H' . $rowIndex, $payment->payment_mode ? $payment->payment_mode : 'NA');
            $sheet->setCellValue('I' . $rowIndex, Carbon::parse($payment->payment_date)->format('d-m-Y'));

            if (isset($statusMap[$payment->status])) {
                $status = $statusMap[$payment->status]['status'];
                $color = $statusMap[$payment->status]['color'];
                $sheet->setCellValue('J' . $rowIndex, $status);
                $sheet->getStyle('J' . $rowIndex)->applyFromArray([
                    'font' => [
                        'color' => ['argb' => $color],
                    ],
                ]);
            } else {
                $sheet->setCellValue('J' . $rowIndex, 'NA');
            }

            $rowIndex++;
            $serialNumber++;
        }

        $sumColumns = ['G'];
        foreach ($sumColumns as $column) {
            $sumFormula = "=SUM($column" . "10:$column" . ($rowIndex - 1) . ")";
            $sheet->setCellValue($column . $rowIndex, $sumFormula);
            $sheet->getStyle($column . $rowIndex)->getFont()->setBold(true);
        }

        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
        }

        $writer = new Xlsx($spreadsheet);
        ob_clean();

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'CreditReportTransaction_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function generateBusinessLoanEnquiryReport(Request $request)
    {

    }
}
