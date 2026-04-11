<?php

return [

    /* メンバー用設定・複数いるので配列でまとめる*/
    'members' => [
        'member1' => [
            'name' => env('MEMBER1_NAME'),
            'email' => env('MEMBER1_EMAIL'),
            'password' => env('MEMBER1_PASSWORD'),
        ],
        'member2' => [
            'name' => env('MEMBER2_NAME'),
            'email' => env('MEMBER2_EMAIL'),
            'password' => env('MEMBER2_PASSWORD'),
        ],
    ],
];
