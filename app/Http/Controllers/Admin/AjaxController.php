<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function select2(Request $request)
    {
        $result = [];
        $term = $request->input('term');
        $type = $request->input('type');

        $query = \DB::table($type);
        if (!empty($term)) {
            $query->where($type . '_title', 'like', '%' . $term . '%');
        }

        $data = $query->take(10)->get();

        $data = $data->map(function ($item) use ($type) {
            return [
                'id' => $item->{$type . '_id'},
                'text' => $item->{$type . '_title'},
            ];
        })->toArray();

        $result['results'] = $data;

        return response()->json($result);
    }
}
