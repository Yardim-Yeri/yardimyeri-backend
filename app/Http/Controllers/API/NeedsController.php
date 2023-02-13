<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class NeedsController extends Controller
{
    public function index()
    {
        $needs = [];
        $data = config('needs');

        foreach ($data as $key => $item) {
            $item_array = [];
            $item_array['id'] = $key;
            $item_array['label'] = $item;

            $needs['result'][] = $item_array;
        }

        try {
            $needs['success'] = true;
            return $this->respondWithData($needs);
        } catch (\Throwable $th) {
            return $this->respondError('Error get needs');
        }
    }
}
