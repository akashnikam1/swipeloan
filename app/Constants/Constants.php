<?php

namespace App\Constants;

class Constants
{
    const PG_PROD_BASE_URL = "https://api.billdesk.com";
    const CREATE_ORDER_URL = "payments/ve1_2/orders/create";
    const CREATE_TRANSACTION_URL = "payments/ve1_2/transactions/create";
    const CREATE_MANDATE_TOKEN_URL = "pgsi/ve1_2/mandatetokens/create";
    const HEADER_BD_TRACE_ID = "BD-Traceid";
    const HEADER_BD_TIMESTAMP = "BD-Timestamp";
    const JWE_HEADER_CLIENTID = "clientid";

    public static function createOrderURL($baseUrl = Constants::PG_PROD_BASE_URL) 
    {
        return $baseUrl . "/" . Constants::CREATE_ORDER_URL;
    }

    public static function createTransactionURL($baseUrl = Constants::PG_PROD_BASE_URL) 
    {
        return $baseUrl . "/" . Constants::CREATE_TRANSACTION_URL;
    }

    public static function createMandateTokenURL($baseUrl = Constants::PG_PROD_BASE_URL) 
    {
        return $baseUrl . "/" . Constants::CREATE_MANDATE_TOKEN_URL;
    }
}
