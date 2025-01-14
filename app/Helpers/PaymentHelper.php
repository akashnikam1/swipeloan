<?php

namespace App\Helpers;

use App\Models\ENachTransaction;
use Carbon\Carbon;

class PaymentHelper
{
    public static function calculateEMIBounceCharges($paymentData)
    {
        $today = Carbon::today();
        $eNachCharges = 0;
        $gstOnENachCharges = 0;
        $bounceCharges = 0;
        $totalAmount = 0;
        $totalENachCharges = 0;

        if ($paymentData) {
            $amount = $paymentData->payment_amount;

            if ($today->greaterThan($paymentData->payment_date)) {
                $daysOverdue = $paymentData->payment_date->diffInDays($today);

                if ($daysOverdue > 0) {
                    $eNachCount = ENachTransaction::where('payment_id', $paymentData->id)->count();

                    $bounceChargePerDay = round($amount * 0.01, 2);
                    $bounceCharges = round($daysOverdue * $bounceChargePerDay, 2);

                    if ($eNachCount > 0) {
                        $eNachCharges = round(500 * $eNachCount, 2);
                        $gstOnENachCharges = round($eNachCharges * 0.18, 2);
                        $totalENachCharges = round($eNachCharges + $gstOnENachCharges, 2);
                    }
                }
            }
            $totalAmount = round($amount + $bounceCharges + $totalENachCharges, 2);
        }

        return [
            'enach_charges' => number_format($eNachCharges, 2, '.', ''),
            'gst_on_enach_charges' => number_format($gstOnENachCharges, 2, '.', ''),
            'bounce_charges' => number_format($bounceCharges, 2, '.', ''),
            'total_amount' => number_format($totalAmount, 2, '.', ''),
        ];
    }
}
