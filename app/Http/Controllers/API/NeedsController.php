<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class NeedsController extends Controller
{
    public function index()
    {
        $needs = [];

        try {
            $needs['result'] = config('needs');
            $needs['success'] = true;
        } catch (\Throwable $th) {
            return $this->respondError('Error get needs');
        }

        return $this->respondWithData($needs);
    }
}
