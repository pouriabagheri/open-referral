<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 23.10.2019
 * Time: 22:59
 */


return [

    'user_models' => 'App\User',

    /*
    |--------------------------------------------------------------------------
    | open_referral referral code
    |--------------------------------------------------------------------------
    |
    | Supported cases for the referral code (Refer to the docs).
    | Available: uppercase|lowercase|mixcase
    |
    */

    'referral_code_length' => 5,

    'referral_code_prefix' => 'REF_',

    'referral_code_case' => 'mixcase',

    'referral_link' => url('/') . '/?ref=',

];