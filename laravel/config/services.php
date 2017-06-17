<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    'facebook' => [
        'client_id' => '1001014143350215',
        'client_secret' => '4741318d0474d9d35bcb7df5d3791b72',
        'redirect' => 'http://darwindeveloper.com/login/callback/facebook',
    ],


    'github' => [
        'client_id' => 'd693ad3130411bbaba2d',
        'client_secret' => '99fc52adf382a780530de484ee5d0bd2aefa203c',
        'redirect' => 'http://darwindeveloper.com/login/callback/github',
    ],


    'google' => [
        'client_id' => '801160296120-r6nd12jhbspgo0gv7i7kpphou64tfhmn.apps.googleusercontent.com',
        'client_secret' => '_6SF0PRRCpKem46HwHS-xpyr',
        'redirect' => 'http://darwindeveloper.com/login/callback/google',
    ],


    'twitter' => [
        'client_id' => 'ZqSwcbTXyG3kVlgt6yWDwBsGh',
        'client_secret' => 'jqEDQxjugc5f5R7Ba7FeVwL14eyabPxH0aL7YTlqP6OgcXLOt5',
        'redirect' => 'http://darwindeveloper.com/login/callback/twitter',
    ],



];
