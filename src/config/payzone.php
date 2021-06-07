<?php

return [
    'debugMode' => true,
    'merchantId' => env('PAYZONE_MERCHANT_ID'),
    'merchantPass' => env('PAYZONE_MERCHANT_PASS'),
    'merchantKey' => env('PAYZONE_MERCHANT_KEY'),
    'currencyCode' => env('PAYZONE_CURRENCY_CODE'),

    'integrationType' => 'direct',
    'hashMethod' => 'SHA1',
    'resultDeliveryMethod' => 'POST',
    'transactionType' => 'SALE',

    'callback_url'  => config('app.url') . '/callback',
    'result_page'   => config('app.url') . '/result',
    'process'       => config('app.url') . '/process',

    // TPCONST
    'COREVERSION'   => "1.0.0",
    'VERSION'       => "2.0.0",
    'VGUID'         => "02c7a060-2f1c-4979-b7fa-f42efaaa70ee",
    'GATEWAYURL'    => "https://gw1.tponlinepayments2.com:4430",
    'MAPIURL'       => "https://mapi.takepayments.com/umbraco/api/ModulesApi/Version?id=",

    // RESULT DELIVERY METHOD
    'POST' => 'POST',
    'SERVER' => 'SERVER',
    'SERVER_PULL' => 'SERVER_PULL',

    //TRANSACTION TYPE
    'SALE' => 'SALE',
    'PREAUTH' => 'PREAUTH',
    'REFUND' => 'REFUND',

    // HASH METHOD
    'SHA1' => 'SHA1',
    'MD5' => 'MD5',
    'HMACSHA1' => 'HMACSHA1',
    'HMACMD5' => 'HMACMD5',
    'HMACSHA256' => 'HMACSHA256',
    'HMACSHA512' => 'HMACSHA512',

    // INTEGRATION TYPE
    'HOSTED'          => 'hosted',
    'DIRECT'          => 'direct',
    'TRANSPARENT'     => 'transparent',

    // RESPONSE CODE
    "SUCCESSFUL"        => 0,
    "THREEDREQUIRED"    => 3,
    "REFERRED"          => 4,
    "DECLINED"          => 5,
    "DUPLICATE"         => 20,
    "ERROR"             => 30,

    'testMode' => true,

    //OrderDetails
    "amt" => rand(0, 9999),
    "orderid" => 'Order-' . rand(0, 999),
    "currencycode" => 826,
    "transactiondatetime" => date('Y-m-d H:i:s P'),
    "orderdesc" => 'Order description ',

    //Customer Details
    "customername" => "Geoff Wayne",
    "address1" => "113 Broad Street West",
    "address2" => "",
    "address3" => "",
    "address4" => "",
    "city" => "Oldpine",
    "state" => "Strongbarrow",
    "postcode" => "SB42 1SX",
    "countrycode" => 826,

    //Card Detilas
    "cardname" => "Geoff Wayne",
    "cardnumber" => 4976350000006891,
    "cv2" => 341,
    "expirydatemonth" => 01,
    "expirydateyear" => 25,
];
