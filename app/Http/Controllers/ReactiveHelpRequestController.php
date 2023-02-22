<?php

namespace App\Http\Controllers;

use App\Models\HelpData;
use App\Services\EncrpytDecrypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReactiveHelpRequestController extends Controller
{
    public function index($base64)
    {
        $decode = base64_decode($base64);
        $encrypter = new EncrpytDecrypt();

        $id = $encrypter->decrpyt($decode);

        // Change deleted_at to 0
        // Change help_status to 'Yardım Bekliyor'

        HelpData::where('id', $id)->update([
            'deleted_at' => null,
            'help_status' => 'Yardım Bekliyor'
        ]);

        Log::info('Reactive help request id: ' . $id);
        return view('reactive_help_request');
    }
}
