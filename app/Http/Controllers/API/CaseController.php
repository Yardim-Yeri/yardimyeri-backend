<?php

namespace App\Http\Controllers\API;

use App\Enums\HelpStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\HelpDataResource;
use App\Models\HelpData;
use App\Models\HelperData;
use Illuminate\Http\Request;

class CaseController extends Controller
{

    // get all cases

    public function index(Request $request,$base64)
    {
        $base64 = base64_decode($base64);
        $base64 = explode("?",$base64);
        $helpId = $base64[0] ?? null;
        $helperPhone = $base64[1] ?? null;

        $helperCheck = HelperData::where('help_data_id', $helpId)->where('tel', $helperPhone)->first();

        if($helperCheck){
            $help_data = HelpData::find($helpId);

            if (empty($help_data)) {
                return $this->respondNotFound('Yardım Talebi Bulunamadı');
            }

            $resource = new HelpDataResource($help_data);

            return $this->respondWithResource($resource);
        }else{
            return response()->json(['message' => 'You are not authorized to view this page.'], 401);
        }
    }

    // finish a case

    public function finish(Request $request,$base64)
    {
        $base64 = base64_decode($base64);
        $base64 = explode("?",$base64);
        $helpId = $base64[0] ?? null;
        $helperPhone = $base64[1] ?? null;

        $helperCheck = HelperData::where('help_data_id', $helpId)->where('tel', $helperPhone)->first();

        if($helperCheck){
            $help_data = HelpData::find($helpId);

            if (empty($help_data)) {
                return $this->respondNotFound('Yardım Talebi Bulunamadı');
            }

            $help_data->help_status = HelpStatusEnum::FINISHED;
            $help_data->save();

            return response()->json(['message' => 'Yardım Talebi Başarıyla Tamamlandı'], 200);
        }else{
            return response()->json(['message' => 'You are not authorized to view this page.'], 401);
        }
    }

    // cancel a case

    public function cancel(Request $request,$base64)
    {
        $base64 = base64_decode($base64);
        $base64 = explode("?",$base64);
        $helpId = $base64[0] ?? null;
        $helperPhone = $base64[1] ?? null;

        $helperCheck = HelperData::where('help_data_id', $helpId)->where('tel', $helperPhone)->first();

        if($helperCheck){
            $help_data = HelpData::find($helpId);

            if (empty($help_data)) {
                return $this->respondNotFound('Yardım Talebi Bulunamadı');
            }

            $help_data->help_status = HelpStatusEnum::PENDING;
            $help_data->save();

            return response()->json(['message' => 'Yardım Talebi Başarıyla İptal Edildi'], 200);
        }else{
            return response()->json(['message' => 'You are not authorized to view this page.'], 401);
        }
    }

}
