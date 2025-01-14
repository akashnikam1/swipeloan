<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qDFZESIlMHgyKoh6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/billdesk_webhook_response' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kU5hOSAKs7mhyFzl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/razorpay_webhook_response' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::s2HsQ7JcMYxCnXgh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/checkAppVersion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CkGYfqFY5VDkKKYO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hPzs8FjWOzVHSde2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/googleSignIn' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5TkEmZg5iu3PiI9L',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/resendOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4iUVKKC6cHQ1OPO2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auth/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ygi23Iu4MVxRPLSZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/getProfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1I3WhknG7bWNmkh4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/postProfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UgUFdI53ET9zFH1o',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/getRelations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N1EyCnrhGKxWNZt1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/sendEmailOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xtoPTM8rEPiXpufS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/verifyEmailOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gS2Xe0ALg9FQxGAC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/sendMobileOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NesWJnYklWBINYuF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/verifyMobileOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ct9zEABIdvk3Xvo1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/validatePincode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BtbavGaCEOk7RJGI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/savePersonalDetails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1UnVmcaWxGCgxApV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/saveBankStatement' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PWEwdTC5L1YrUjHL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/saveLoanLimitDetails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sXOofHQPgXZbjxIJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/saveBankDetails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5QJ034Oc25JYIpgV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/profile/deleteProfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0orZVPjbWNhkMA2U',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getBusinessInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RDXgsW1pMEtONZD5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getBanks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OK3hiK6Pq3Cp6Lsc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/saveUserContactData' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bZqAJE245Zbx73RO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/saveUserSmsData' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OxZ59nP8J2Atd36L',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/aadhaar/sendOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iOV07C4YYywRmW9M',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/aadhaar/verifyOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DwBdwQqSUBi7He62',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/pan/verifyPan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pOOkh0Pk90Cafpn2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/verifySelfie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9lU8jb8sY1WgRU1N',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getCibilScore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::f2bEzGOey1N7DFTM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getCreditLimit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g9AAOAH5kAy4wV5s',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/homeScreen' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9xVOOEpV8AAmTGuK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getLoanStages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JeSS5dfEDJ19EplM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getLoanEmiDetails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iABfsyHsbqyp9fUz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/applyLoan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pLoA8PUDZN4i7sje',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/sendEsignOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::po8GWpfL13CaX6CZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/verifyEsignOtp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EkyJkqew9SOOiNHN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/submitFeedback' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VRLgQwY2Rl4TXEME',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/myLoans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Btv6HkJA5VvgtcVN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/loanDetails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PUYMjkNNDv9FVYWg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getLoanDocument' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ixMMPBdnlz1Uymqn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/paymentHistory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::no9P9RgSlhRPp9d1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getNotificationList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aWfEIP6djRv3b992',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/changeNotificationStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Fr9VqYudRUgCuJti',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/contactUs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::71ZHsfMJ5qZmoSTB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/getReferAndEarn' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LHSXuzI10iju1ocW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/saveBusinessLoanEnquiry' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AZDAGQPlHyNJKgaT',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/updateBusinessEnquiryCount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Vu8uFFPzLGH9Unre',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/changeUserApplicationStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5bf0sUC6WWg2iQWE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/payments/payEmiNow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iCgr9BwG6ihOnzXl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/payments/createOrder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XoOMEcsSnHQs0GLw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/payments/paymentStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TNG5GXJMSh13QcM8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/payments/billdeskPaymentStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vv4nMCy5oWo3kIDS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/creditReport/createOrder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cxnJamtRfE5s9cKO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/creditReport/paymentStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N7qu8RYbFgyN3JdF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/sendNotify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uFZwMz0dRhT38lz5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::H88ITfO8FHZaXZln',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::chVzzeihixstO5iF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GgNgzPKbspQxOv2z',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UREkUP97xLFrrSP8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::S8KvfYwYTZ4ji66X',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/change-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WTzjgKyg5UyPmf0k',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/change-notification-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cHFiKIVNafMC3Kfr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/banners/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nnEprNBTSQRiYMk5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/banners/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OViUt6Bia2ga5XWu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::el7C1bE48WENzZG3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/banners/change-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8XwabNb1Fnbut7XX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/partners/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NP6ybHqvQfkSQEaH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/partners/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HbmNYUD3yBRWx9ci',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gi5SyResL6QU9nEs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/partners/change-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g7RJ8JgkXHaU183g',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notifications/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ClCELgqwwIyLGSF5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notifications/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4FDXIUM0LMN3FazX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y4edYJc8Si7he7Bt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/notifications/auto_notifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7wBJ3ojii5yewokC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_notifications/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IbAq5xn1cMEfkwWU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/loan_requests/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vaVudonPBc4F6Ect',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payments/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0xZguWzQTPCPKo0w',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/credit_report_transactions/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XsR62fT2EOPP3LpP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/loan_limit_requests/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aO8SsVRnUNEd8ooP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/loan_limit_requests/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7s12fTSBbKq6pmAx',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/contact_us/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::03ihMw8MMegqpHeH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/loan_stages/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ieQpyQWLWNLz2E1i',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/loan_stages/change-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BXeY6y1jzPFIvk0E',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_feedbacks/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UDzviFa0ek3JZGrw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/defaulters_users/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QuvdBplDQlbc1Fwu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/business_loan_enquiry/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tJs6UjGC3hQISzrz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nbfc/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0cy9RbvHKDgDIxqk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nbfc/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YUbcNN94VKBmGq4P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8hWmBQJDbzVLebPk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nbfc/change-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6HGfSByKvH7W7gkI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nbfc/update-transaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wVTUxvdLdJIzbVy4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nbfc/convert-to-words' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1PuuGrMmsSiR0TBE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/business_enquiry_statistics/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KXeAWtcAoTvYhwWB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download/loan_report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tk6pMzBgpXr1inlE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download/payment_history_report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yukGbsgxttmIUzP3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download/credit_report_transaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tW8UozthiMZgV7TL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download/business_loan_enquiry_report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::m2vHvQ8lt69AgOYZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download/user_report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u4hejFiiHCB8lsb5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fetch-users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.fetch',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/calculate-users-count' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'calculate.user_count',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/pa(?|ssword/reset/([^/]++)(*:34)|rtners/(?|delete/([^/]++)(*:66)|edit/([^/]++)(?|(*:89))))|/users/user_details/(?|([^/]++)(*:130)|personal_info/edit/([^/]++)(*:165)|relative_info/edit/([^/]++)(*:200)|loan_limit_info/edit/([^/]++)(*:237)|kyc_info/edit/([^/]++)(*:267)|bank_info/edit/([^/]++)(*:298))|/banners/(?|delete/([^/]++)(*:334)|edit/([^/]++)(?|(*:358)))|/general_settings/edit/([^/]++)(?|(*:402))|/n(?|otifications/(?|edit/([^/]++)(?|(*:448))|send/([^/]++)(*:470))|bfc/(?|delete/([^/]++)(*:501)|edit/([^/]++)(?|(*:525))))|/loan_requests/loan_details/(?|([^/]++)(*:575)|d(?|eclined_loan_request/([^/]++)(*:616)|isburse_amount/([^/]++)(*:647))))/?$}sDu',
    ),
    3 => 
    array (
      34 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      66 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pfwcRKn7nN09ELAx',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      89 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HMuZnd8gQzdNJXSA',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xyLcA8u9FOiKBtOD',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      130 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.details',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      165 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2XEqiLDEXSnfC2q7',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      200 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2QTVBVQTeUmDniFX',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      237 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CNQLoRo8E31U1ohq',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      267 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::94auqTEWZXOvGY4N',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      298 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::at26cIY0MnIcox4n',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      334 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OZAb5l28YJT1srbJ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      358 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oXbjRrYBh1jJj5qS',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B1Y3BzB1ERzvqTUg',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      402 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cQnbBn6zwUfa6pjr',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2RF2sDWJL2gmteyF',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      448 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QX4g9xBzbOupMwSu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0n7dVgtPOcLcM50Q',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      470 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::57zrhsSHLRTBFpgh',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      501 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3wFi4YQ4qm4IwqTJ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      525 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nbfc.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dIWeuc62AfstRkLg',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      575 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'loan.details',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      616 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yGclqhEaZth6jX2z',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      647 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'loan.disburse',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::qDFZESIlMHgyKoh6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::qDFZESIlMHgyKoh6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kU5hOSAKs7mhyFzl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/billdesk_webhook_response',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@billdeskWebhookResponse',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@billdeskWebhookResponse',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::kU5hOSAKs7mhyFzl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::s2HsQ7JcMYxCnXgh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/razorpay_webhook_response',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@razorpayWebhookResponse',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@razorpayWebhookResponse',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::s2HsQ7JcMYxCnXgh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CkGYfqFY5VDkKKYO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/checkAppVersion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@checkAppVersion',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@checkAppVersion',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::CkGYfqFY5VDkKKYO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hPzs8FjWOzVHSde2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@login',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1\\Auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::hPzs8FjWOzVHSde2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5TkEmZg5iu3PiI9L' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/googleSignIn',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@googleSignIn',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@googleSignIn',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1\\Auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::5TkEmZg5iu3PiI9L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4iUVKKC6cHQ1OPO2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/resendOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@resendOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@resendOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1\\Auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::4iUVKKC6cHQ1OPO2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ygi23Iu4MVxRPLSZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/auth/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\Auth\\AuthController@logout',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1\\Auth',
        'prefix' => 'api/v1/auth',
        'where' => 
        array (
        ),
        'as' => 'generated::Ygi23Iu4MVxRPLSZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1I3WhknG7bWNmkh4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/getProfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getProfile',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getProfile',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::1I3WhknG7bWNmkh4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UgUFdI53ET9zFH1o' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/postProfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@postProfile',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@postProfile',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::UgUFdI53ET9zFH1o',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N1EyCnrhGKxWNZt1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/getRelations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getRelations',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getRelations',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::N1EyCnrhGKxWNZt1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xtoPTM8rEPiXpufS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/sendEmailOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@sendEmailOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@sendEmailOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::xtoPTM8rEPiXpufS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gS2Xe0ALg9FQxGAC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/verifyEmailOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@verifyEmailOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@verifyEmailOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::gS2Xe0ALg9FQxGAC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NesWJnYklWBINYuF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/sendMobileOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@sendMobileOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@sendMobileOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::NesWJnYklWBINYuF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ct9zEABIdvk3Xvo1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/verifyMobileOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@verifyMobileOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@verifyMobileOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::Ct9zEABIdvk3Xvo1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BtbavGaCEOk7RJGI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/validatePincode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@validatePincode',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@validatePincode',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::BtbavGaCEOk7RJGI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1UnVmcaWxGCgxApV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/savePersonalDetails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@savePersonalDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@savePersonalDetails',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::1UnVmcaWxGCgxApV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PWEwdTC5L1YrUjHL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/saveBankStatement',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@saveBankStatement',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@saveBankStatement',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::PWEwdTC5L1YrUjHL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sXOofHQPgXZbjxIJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/saveLoanLimitDetails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveLoanLimitDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveLoanLimitDetails',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::sXOofHQPgXZbjxIJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5QJ034Oc25JYIpgV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/saveBankDetails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@saveBankDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@saveBankDetails',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::5QJ034Oc25JYIpgV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0orZVPjbWNhkMA2U' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/profile/deleteProfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@deleteProfile',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@deleteProfile',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/profile',
        'where' => 
        array (
        ),
        'as' => 'generated::0orZVPjbWNhkMA2U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RDXgsW1pMEtONZD5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getBusinessInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getBusinessInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getBusinessInfo',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::RDXgsW1pMEtONZD5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OK3hiK6Pq3Cp6Lsc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getBanks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getBanks',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getBanks',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::OK3hiK6Pq3Cp6Lsc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bZqAJE245Zbx73RO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/saveUserContactData',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveUserContactData',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveUserContactData',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::bZqAJE245Zbx73RO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OxZ59nP8J2Atd36L' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/saveUserSmsData',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveUserSmsData',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveUserSmsData',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::OxZ59nP8J2Atd36L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iOV07C4YYywRmW9M' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/aadhaar/sendOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@sendAadhaarOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@sendAadhaarOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::iOV07C4YYywRmW9M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DwBdwQqSUBi7He62' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/aadhaar/verifyOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifyAadhaarOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifyAadhaarOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::DwBdwQqSUBi7He62',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pOOkh0Pk90Cafpn2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/pan/verifyPan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifyPanCard',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifyPanCard',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::pOOkh0Pk90Cafpn2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9lU8jb8sY1WgRU1N' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/verifySelfie',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifySelfie',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifySelfie',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::9lU8jb8sY1WgRU1N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::f2bEzGOey1N7DFTM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getCibilScore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getCibilScore',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getCibilScore',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::f2bEzGOey1N7DFTM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g9AAOAH5kAy4wV5s' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getCreditLimit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getCreditLimit',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getCreditLimit',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::g9AAOAH5kAy4wV5s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9xVOOEpV8AAmTGuK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/homeScreen',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@homeScreen',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@homeScreen',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::9xVOOEpV8AAmTGuK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JeSS5dfEDJ19EplM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getLoanStages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getLoanStages',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getLoanStages',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::JeSS5dfEDJ19EplM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iABfsyHsbqyp9fUz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getLoanEmiDetails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getLoanEmiDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getLoanEmiDetails',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::iABfsyHsbqyp9fUz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pLoA8PUDZN4i7sje' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/applyLoan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@applyLoan',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@applyLoan',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::pLoA8PUDZN4i7sje',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::po8GWpfL13CaX6CZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/sendEsignOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@sendEsignOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@sendEsignOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::po8GWpfL13CaX6CZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EkyJkqew9SOOiNHN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/verifyEsignOtp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifyEsignOtp',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\VerificationApiController@verifyEsignOtp',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::EkyJkqew9SOOiNHN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VRLgQwY2Rl4TXEME' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/submitFeedback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@submitFeedback',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@submitFeedback',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::VRLgQwY2Rl4TXEME',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Btv6HkJA5VvgtcVN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/myLoans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@myLoans',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@myLoans',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::Btv6HkJA5VvgtcVN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PUYMjkNNDv9FVYWg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/loanDetails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@loanDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@loanDetails',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::PUYMjkNNDv9FVYWg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ixMMPBdnlz1Uymqn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getLoanDocument',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getLoanDocument',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getLoanDocument',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::ixMMPBdnlz1Uymqn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::no9P9RgSlhRPp9d1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/paymentHistory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@paymentHistory',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@paymentHistory',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::no9P9RgSlhRPp9d1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aWfEIP6djRv3b992' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getNotificationList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getNotificationList',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getNotificationList',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::aWfEIP6djRv3b992',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Fr9VqYudRUgCuJti' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/changeNotificationStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@changeNotificationStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@changeNotificationStatus',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::Fr9VqYudRUgCuJti',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::71ZHsfMJ5qZmoSTB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/contactUs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@storeContactDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@storeContactDetails',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::71ZHsfMJ5qZmoSTB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LHSXuzI10iju1ocW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/getReferAndEarn',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getReferAndEarn',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@getReferAndEarn',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::LHSXuzI10iju1ocW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AZDAGQPlHyNJKgaT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/saveBusinessLoanEnquiry',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveBusinessLoanEnquiry',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@saveBusinessLoanEnquiry',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::AZDAGQPlHyNJKgaT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Vu8uFFPzLGH9Unre' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/updateBusinessEnquiryCount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@updateBusinessEnquiryCount',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@updateBusinessEnquiryCount',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::Vu8uFFPzLGH9Unre',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5bf0sUC6WWg2iQWE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/changeUserApplicationStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@changeUserApplicationStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@changeUserApplicationStatus',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::5bf0sUC6WWg2iQWE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iCgr9BwG6ihOnzXl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/payments/payEmiNow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@payEmiNow',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@payEmiNow',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::iCgr9BwG6ihOnzXl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XoOMEcsSnHQs0GLw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/payments/createOrder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@createOrderId',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@createOrderId',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::XoOMEcsSnHQs0GLw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TNG5GXJMSh13QcM8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/payments/paymentStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@razorpayPaymentStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@razorpayPaymentStatus',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::TNG5GXJMSh13QcM8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vv4nMCy5oWo3kIDS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/payments/billdeskPaymentStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@billdeskPaymentStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@billdeskPaymentStatus',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::vv4nMCy5oWo3kIDS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cxnJamtRfE5s9cKO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/creditReport/createOrder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@createCreditReportOrderId',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@createCreditReportOrderId',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/creditReport',
        'where' => 
        array (
        ),
        'as' => 'generated::cxnJamtRfE5s9cKO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N7qu8RYbFgyN3JdF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/creditReport/paymentStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@razorpayCreditReportPaymentStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\PaymentApiController@razorpayCreditReportPaymentStatus',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1/creditReport',
        'where' => 
        array (
        ),
        'as' => 'generated::N7qu8RYbFgyN3JdF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uFZwMz0dRhT38lz5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/sendNotify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@sendNotify',
        'controller' => 'App\\Http\\Controllers\\Api\\V1\\WebApiController@sendNotify',
        'namespace' => 'App\\Http\\Controllers\\Api\\V1',
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
        'as' => 'generated::uFZwMz0dRhT38lz5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H88ITfO8FHZaXZln' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::H88ITfO8FHZaXZln',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:286:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:68:"function () {
    \\Auth::logout();
    return \\redirect(\'/login\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006930000000000000000";}";s:4:"hash";s:44:"5hv/+cMIhA2F3ehq2e0Yv+iZuGXgIaKKWTRASTRPPlo=";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::chVzzeihixstO5iF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::chVzzeihixstO5iF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GgNgzPKbspQxOv2z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GgNgzPKbspQxOv2z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UREkUP97xLFrrSP8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:264:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:46:"function () {
    return \\redirect(\'login\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000064d0000000000000000";}";s:4:"hash";s:44:"RdCf/z1Cz6HhAzyGvEKG3QYlwxSJ5DOWGaq3JirEAeA=";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::UREkUP97xLFrrSP8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::S8KvfYwYTZ4ji66X' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'users/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@getAllUsers',
        'controller' => 'App\\Http\\Controllers\\UserController@getAllUsers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::S8KvfYwYTZ4ji66X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'users/user_details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@getUserDetails',
        'controller' => 'App\\Http\\Controllers\\UserController@getUserDetails',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'user.details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WTzjgKyg5UyPmf0k' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/change-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@changeStatus',
        'controller' => 'App\\Http\\Controllers\\UserController@changeStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::WTzjgKyg5UyPmf0k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cHFiKIVNafMC3Kfr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/change-notification-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@changeNotificationStatus',
        'controller' => 'App\\Http\\Controllers\\UserController@changeNotificationStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::cHFiKIVNafMC3Kfr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2XEqiLDEXSnfC2q7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/user_details/personal_info/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updatePersonalInfo',
        'controller' => 'App\\Http\\Controllers\\UserController@updatePersonalInfo',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::2XEqiLDEXSnfC2q7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2QTVBVQTeUmDniFX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/user_details/relative_info/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updateRelativeInfo',
        'controller' => 'App\\Http\\Controllers\\UserController@updateRelativeInfo',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::2QTVBVQTeUmDniFX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CNQLoRo8E31U1ohq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/user_details/loan_limit_info/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updateLoanLimitInfo',
        'controller' => 'App\\Http\\Controllers\\UserController@updateLoanLimitInfo',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::CNQLoRo8E31U1ohq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::94auqTEWZXOvGY4N' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/user_details/kyc_info/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updateKYCInfo',
        'controller' => 'App\\Http\\Controllers\\UserController@updateKYCInfo',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::94auqTEWZXOvGY4N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::at26cIY0MnIcox4n' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/user_details/bank_info/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updateBankInfo',
        'controller' => 'App\\Http\\Controllers\\UserController@updateBankInfo',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::at26cIY0MnIcox4n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nnEprNBTSQRiYMk5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'banners/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@getAllBanners',
        'controller' => 'App\\Http\\Controllers\\BannerController@getAllBanners',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::nnEprNBTSQRiYMk5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OViUt6Bia2ga5XWu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'banners/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@getAddBanner',
        'controller' => 'App\\Http\\Controllers\\BannerController@getAddBanner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::OViUt6Bia2ga5XWu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::el7C1bE48WENzZG3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'banners/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@addBanner',
        'controller' => 'App\\Http\\Controllers\\BannerController@addBanner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::el7C1bE48WENzZG3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OZAb5l28YJT1srbJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'banners/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@deleteBanner',
        'controller' => 'App\\Http\\Controllers\\BannerController@deleteBanner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::OZAb5l28YJT1srbJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oXbjRrYBh1jJj5qS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'banners/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@getEditBanner',
        'controller' => 'App\\Http\\Controllers\\BannerController@getEditBanner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::oXbjRrYBh1jJj5qS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B1Y3BzB1ERzvqTUg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'banners/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@updateBanner',
        'controller' => 'App\\Http\\Controllers\\BannerController@updateBanner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::B1Y3BzB1ERzvqTUg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8XwabNb1Fnbut7XX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'banners/change-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BannerController@changeStatus',
        'controller' => 'App\\Http\\Controllers\\BannerController@changeStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/banners',
        'where' => 
        array (
        ),
        'as' => 'generated::8XwabNb1Fnbut7XX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NP6ybHqvQfkSQEaH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'partners/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@getAllPartners',
        'controller' => 'App\\Http\\Controllers\\PartnerController@getAllPartners',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::NP6ybHqvQfkSQEaH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HbmNYUD3yBRWx9ci' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'partners/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@getAddPartner',
        'controller' => 'App\\Http\\Controllers\\PartnerController@getAddPartner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::HbmNYUD3yBRWx9ci',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gi5SyResL6QU9nEs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'partners/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@addPartner',
        'controller' => 'App\\Http\\Controllers\\PartnerController@addPartner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::gi5SyResL6QU9nEs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pfwcRKn7nN09ELAx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'partners/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@deletePartner',
        'controller' => 'App\\Http\\Controllers\\PartnerController@deletePartner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::pfwcRKn7nN09ELAx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HMuZnd8gQzdNJXSA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'partners/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@getEditPartner',
        'controller' => 'App\\Http\\Controllers\\PartnerController@getEditPartner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::HMuZnd8gQzdNJXSA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xyLcA8u9FOiKBtOD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'partners/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@updatePartner',
        'controller' => 'App\\Http\\Controllers\\PartnerController@updatePartner',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::xyLcA8u9FOiKBtOD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g7RJ8JgkXHaU183g' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'partners/change-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PartnerController@changeStatus',
        'controller' => 'App\\Http\\Controllers\\PartnerController@changeStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/partners',
        'where' => 
        array (
        ),
        'as' => 'generated::g7RJ8JgkXHaU183g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cQnbBn6zwUfa6pjr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'general_settings/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\GeneralSettingController@getEditGeneralSetting',
        'controller' => 'App\\Http\\Controllers\\GeneralSettingController@getEditGeneralSetting',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/general_settings',
        'where' => 
        array (
        ),
        'as' => 'generated::cQnbBn6zwUfa6pjr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2RF2sDWJL2gmteyF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'general_settings/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\GeneralSettingController@updateGeneralSetting',
        'controller' => 'App\\Http\\Controllers\\GeneralSettingController@updateGeneralSetting',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/general_settings',
        'where' => 
        array (
        ),
        'as' => 'generated::2RF2sDWJL2gmteyF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ClCELgqwwIyLGSF5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'notifications/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@getAllNotifications',
        'controller' => 'App\\Http\\Controllers\\NotificationController@getAllNotifications',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::ClCELgqwwIyLGSF5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4FDXIUM0LMN3FazX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'notifications/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@getAddNotification',
        'controller' => 'App\\Http\\Controllers\\NotificationController@getAddNotification',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::4FDXIUM0LMN3FazX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y4edYJc8Si7he7Bt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'notifications/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@addNotification',
        'controller' => 'App\\Http\\Controllers\\NotificationController@addNotification',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::Y4edYJc8Si7he7Bt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QX4g9xBzbOupMwSu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'notifications/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@getEditNotification',
        'controller' => 'App\\Http\\Controllers\\NotificationController@getEditNotification',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::QX4g9xBzbOupMwSu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0n7dVgtPOcLcM50Q' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'notifications/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@updateNotification',
        'controller' => 'App\\Http\\Controllers\\NotificationController@updateNotification',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::0n7dVgtPOcLcM50Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::57zrhsSHLRTBFpgh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'notifications/send/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@pushNotification',
        'controller' => 'App\\Http\\Controllers\\NotificationController@pushNotification',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::57zrhsSHLRTBFpgh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7wBJ3ojii5yewokC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'notifications/auto_notifications',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@getAllAutoNotifications',
        'controller' => 'App\\Http\\Controllers\\NotificationController@getAllAutoNotifications',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::7wBJ3ojii5yewokC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IbAq5xn1cMEfkwWU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user_notifications/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserNotificationController@getAlluserNotifications',
        'controller' => 'App\\Http\\Controllers\\UserNotificationController@getAlluserNotifications',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user_notifications',
        'where' => 
        array (
        ),
        'as' => 'generated::IbAq5xn1cMEfkwWU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vaVudonPBc4F6Ect' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'loan_requests/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanRequestController@getAllLoanRequests',
        'controller' => 'App\\Http\\Controllers\\LoanRequestController@getAllLoanRequests',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_requests',
        'where' => 
        array (
        ),
        'as' => 'generated::vaVudonPBc4F6Ect',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'loan.details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'loan_requests/loan_details/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanRequestController@getAllLoanRequestDetails',
        'controller' => 'App\\Http\\Controllers\\LoanRequestController@getAllLoanRequestDetails',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_requests',
        'where' => 
        array (
        ),
        'as' => 'loan.details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yGclqhEaZth6jX2z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'loan_requests/loan_details/declined_loan_request/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanRequestController@declinedLoanRequest',
        'controller' => 'App\\Http\\Controllers\\LoanRequestController@declinedLoanRequest',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_requests',
        'where' => 
        array (
        ),
        'as' => 'generated::yGclqhEaZth6jX2z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'loan.disburse' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'loan_requests/loan_details/disburse_amount/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanRequestController@disburseLoanAmount',
        'controller' => 'App\\Http\\Controllers\\LoanRequestController@disburseLoanAmount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_requests',
        'where' => 
        array (
        ),
        'as' => 'loan.disburse',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0xZguWzQTPCPKo0w' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'payments/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaymentController@getAllPayments',
        'controller' => 'App\\Http\\Controllers\\PaymentController@getAllPayments',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::0xZguWzQTPCPKo0w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XsR62fT2EOPP3LpP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'credit_report_transactions/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CreditReportTransactionController@getAllCreditReportTransactions',
        'controller' => 'App\\Http\\Controllers\\CreditReportTransactionController@getAllCreditReportTransactions',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/credit_report_transactions',
        'where' => 
        array (
        ),
        'as' => 'generated::XsR62fT2EOPP3LpP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aO8SsVRnUNEd8ooP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'loan_limit_requests/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanLimitRequestController@getAllLoanLimitRequests',
        'controller' => 'App\\Http\\Controllers\\LoanLimitRequestController@getAllLoanLimitRequests',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_limit_requests',
        'where' => 
        array (
        ),
        'as' => 'generated::aO8SsVRnUNEd8ooP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7s12fTSBbKq6pmAx' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'loan_limit_requests/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanLimitRequestController@updateCreditLimit',
        'controller' => 'App\\Http\\Controllers\\LoanLimitRequestController@updateCreditLimit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_limit_requests',
        'where' => 
        array (
        ),
        'as' => 'generated::7s12fTSBbKq6pmAx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::03ihMw8MMegqpHeH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contact_us/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ContactUsController@getAllContacts',
        'controller' => 'App\\Http\\Controllers\\ContactUsController@getAllContacts',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/contact_us',
        'where' => 
        array (
        ),
        'as' => 'generated::03ihMw8MMegqpHeH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ieQpyQWLWNLz2E1i' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'loan_stages/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanStageController@getAllLoanStages',
        'controller' => 'App\\Http\\Controllers\\LoanStageController@getAllLoanStages',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_stages',
        'where' => 
        array (
        ),
        'as' => 'generated::ieQpyQWLWNLz2E1i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BXeY6y1jzPFIvk0E' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'loan_stages/change-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\LoanStageController@changeStatus',
        'controller' => 'App\\Http\\Controllers\\LoanStageController@changeStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/loan_stages',
        'where' => 
        array (
        ),
        'as' => 'generated::BXeY6y1jzPFIvk0E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UDzviFa0ek3JZGrw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user_feedbacks/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\FeedbackController@getAllFeedbacks',
        'controller' => 'App\\Http\\Controllers\\FeedbackController@getAllFeedbacks',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user_feedbacks',
        'where' => 
        array (
        ),
        'as' => 'generated::UDzviFa0ek3JZGrw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QuvdBplDQlbc1Fwu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'defaulters_users/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DefaulterUserController@getAlldefaulters',
        'controller' => 'App\\Http\\Controllers\\DefaulterUserController@getAlldefaulters',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/defaulters_users',
        'where' => 
        array (
        ),
        'as' => 'generated::QuvdBplDQlbc1Fwu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tJs6UjGC3hQISzrz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'business_loan_enquiry/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BusinessLoanEnquiryController@getAllBusinessLoanEnquiries',
        'controller' => 'App\\Http\\Controllers\\BusinessLoanEnquiryController@getAllBusinessLoanEnquiries',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/business_loan_enquiry',
        'where' => 
        array (
        ),
        'as' => 'generated::tJs6UjGC3hQISzrz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0cy9RbvHKDgDIxqk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nbfc/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@getAllNbfcs',
        'controller' => 'App\\Http\\Controllers\\NbfcController@getAllNbfcs',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::0cy9RbvHKDgDIxqk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YUbcNN94VKBmGq4P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nbfc/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@getAddNbfc',
        'controller' => 'App\\Http\\Controllers\\NbfcController@getAddNbfc',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::YUbcNN94VKBmGq4P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8hWmBQJDbzVLebPk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nbfc/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@addNbfc',
        'controller' => 'App\\Http\\Controllers\\NbfcController@addNbfc',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::8hWmBQJDbzVLebPk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3wFi4YQ4qm4IwqTJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nbfc/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@deleteNbfc',
        'controller' => 'App\\Http\\Controllers\\NbfcController@deleteNbfc',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::3wFi4YQ4qm4IwqTJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'nbfc.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nbfc/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@getEditNbfc',
        'controller' => 'App\\Http\\Controllers\\NbfcController@getEditNbfc',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'nbfc.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dIWeuc62AfstRkLg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nbfc/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@updateNbfc',
        'controller' => 'App\\Http\\Controllers\\NbfcController@updateNbfc',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::dIWeuc62AfstRkLg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6HGfSByKvH7W7gkI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nbfc/change-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@changeStatus',
        'controller' => 'App\\Http\\Controllers\\NbfcController@changeStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::6HGfSByKvH7W7gkI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wVTUxvdLdJIzbVy4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nbfc/update-transaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@updateTransaction',
        'controller' => 'App\\Http\\Controllers\\NbfcController@updateTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::wVTUxvdLdJIzbVy4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1PuuGrMmsSiR0TBE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nbfc/convert-to-words',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\NbfcController@convertToWords',
        'controller' => 'App\\Http\\Controllers\\NbfcController@convertToWords',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/nbfc',
        'where' => 
        array (
        ),
        'as' => 'generated::1PuuGrMmsSiR0TBE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KXeAWtcAoTvYhwWB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'business_enquiry_statistics/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BusinessEnquiryStatisticsController@getAllBusinessEnquiryStatistics',
        'controller' => 'App\\Http\\Controllers\\BusinessEnquiryStatisticsController@getAllBusinessEnquiryStatistics',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/business_enquiry_statistics',
        'where' => 
        array (
        ),
        'as' => 'generated::KXeAWtcAoTvYhwWB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tk6pMzBgpXr1inlE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'download/loan_report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GenerateExcelController@generateLoanReport',
        'controller' => 'App\\Http\\Controllers\\GenerateExcelController@generateLoanReport',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::tk6pMzBgpXr1inlE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yukGbsgxttmIUzP3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'download/payment_history_report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GenerateExcelController@generatePaymentHistoryReport',
        'controller' => 'App\\Http\\Controllers\\GenerateExcelController@generatePaymentHistoryReport',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::yukGbsgxttmIUzP3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tW8UozthiMZgV7TL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'download/credit_report_transaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GenerateExcelController@generateCreditTransactionReport',
        'controller' => 'App\\Http\\Controllers\\GenerateExcelController@generateCreditTransactionReport',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::tW8UozthiMZgV7TL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::m2vHvQ8lt69AgOYZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'download/business_loan_enquiry_report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GenerateExcelController@generateBusinessLoanEnquiryReport',
        'controller' => 'App\\Http\\Controllers\\GenerateExcelController@generateBusinessLoanEnquiryReport',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::m2vHvQ8lt69AgOYZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u4hejFiiHCB8lsb5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'download/user_report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GenerateExcelController@generateUserReport',
        'controller' => 'App\\Http\\Controllers\\GenerateExcelController@generateUserReport',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::u4hejFiiHCB8lsb5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'users.fetch' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'fetch-users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@fetchUsers',
        'controller' => 'App\\Http\\Controllers\\NotificationController@fetchUsers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'users.fetch',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'calculate.user_count' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'calculate-users-count',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@fetchUsersCount',
        'controller' => 'App\\Http\\Controllers\\NotificationController@fetchUsersCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'calculate.user_count',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
