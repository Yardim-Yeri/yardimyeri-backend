<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class StencilService
 * @package App\Services
 */
class StencilService
{

    /**
     * @param $people_count
     * @param $location
     * @param $help_type
     * @return array
     */
    // generate a featured image for the help

    public static function generateFeaturedImage($people_count, $location, $help_type)
    {
        // https://api.usestencil.com/v1/images/sync

        $date = date('Y-m-d H:i:s');

        $url = 'https://api.usestencil.com/v1/images/sync';
        $token = env('STENCIL_TOKEN');


        $data = [
            "template" => env('STENCIL_TEMPLATE'),
            "modifications" => [
                [
                    "name" => "image_1",
                    "src" => "https://cdn.usestencil.com/uploads/91d4e185-e06b-4018-881d-bbecb627ca3f/cd21adb7-dbcc-4812-9d93-32611cb0114f/logo-1115430770.jpg"
                ],
                [
                    "name" => "image_2",
                    "src" => "https://cdn.usestencil.com/uploads/91d4e185-e06b-4018-881d-bbecb627ca3f/cd21adb7-dbcc-4812-9d93-32611cb0114f/icons8-user-location-100-1115486407.png"
                ],
                [
                    "name" => "city",
                    "text" => $location
                ],
                [
                    "name" => "image_4",
                    "src" => "https://cdn.usestencil.com/uploads/91d4e185-e06b-4018-881d-bbecb627ca3f/cd21adb7-dbcc-4812-9d93-32611cb0114f/icons8-crowd-100-1115556944.png"
                ],
                [
                    "name" => "count",
                    "text" => $people_count
                ],
                [
                    "name" => "image_6",
                    "src" => "https://cdn.usestencil.com/uploads/91d4e185-e06b-4018-881d-bbecb627ca3f/cd21adb7-dbcc-4812-9d93-32611cb0114f/icons8-wishlist-66-1115684985.png"
                ],
                [
                    "name" => "need_type",
                    "text" => $help_type
                ],
                [
                    "name" => "image_8",
                    "src" => "https://cdn.usestencil.com/uploads/91d4e185-e06b-4018-881d-bbecb627ca3f/cd21adb7-dbcc-4812-9d93-32611cb0114f/icons8-tear-off-calendar-100-1115905784.png"
                ],
                [
                    "name" => "text_9",
                    "text" => $date
                ]
            ]
        ];
        $stencil =  Http::withHeaders(
            [
                "Content-Type" => "application/json",
                "Authorization" => "Bearer " . $token
            ]
        )->post($url, $data);

        return $stencil->json();
    }
}
