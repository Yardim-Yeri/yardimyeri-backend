<?php

namespace App\Http\Controllers\API;

use App\Enums\HelpStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\HelperFormRequest;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\NeighborhoodResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\StreetResource;
use App\Jobs\HelperNotificationJob;
use App\Models\District;
use App\Models\HelpData;
use App\Models\HelperData;
use App\Models\Neighborhood;
use App\Models\Province;
use App\Models\Street;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::whereIn('sehir_title', config('cities.avaliable_cities'))->get();

        return $this->respondWithResourceCollection(
            ProvinceResource::collection($provinces)
        );
    }

    public function getDistricts($province)
    {
        $districts = District::where('ilce_sehirkey', $province)->paginate(25);

        return $this->respondWithResourceCollection(
            DistrictResource::collection($districts)
        );
    }

    public function getNeighborhoods($district)
    {
        $neighborhoods = Neighborhood::where('mahalle_ilcekey', $district)->paginate(25);

        return $this->respondWithResourceCollection(
            NeighborhoodResource::collection($neighborhoods)
        );
    }

    public function getStreets($neighborhood)
    {
        $streets = Street::where('sokak_cadde_mahallekey', $neighborhood)->paginate(25);

        return $this->respondWithResourceCollection(
            StreetResource::collection($streets)
        );
    }

    public function sendHelperForm(HelperFormRequest $request, $help_data_id)
    {
        $help_data = HelpData::find($help_data_id);
        if (empty($help_data)) {
            return $this->respondError('Yardım Talebi Mevcut Değil', 404);
        }

        try {
            $helper = new HelperData();
            $helper->name = $request->name;
            $helper->tel = $request->phone_number;
            $helper->email = $request->email;
            $helper->help_data_id = $help_data->id;
            $helper->save();

            $help_data->help_status = HelpStatusEnum::PROCESS->value;
            $help_data->save();

            HelperNotificationJob::dispatch($helper);

            return $this->respondSuccess('Yardım başarıyla başlatılmıştır. Lütfen yardım talep edene ait telefon numarası ile irtibata geçin.');
        } catch (\Throwable $th) {
            return $this->respondError('Yardım başlatılamadı');
        }
    }
}
