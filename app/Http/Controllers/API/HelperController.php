<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\NeighborhoodResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\StreetResource;
use App\Models\District;
use App\Models\HelpData;
use App\Models\HelperData;
use App\Models\Neighborhood;
use App\Models\Province;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::paginate(25);

        return $this->respondWithResourceCollection(
            ProvinceResource::collection($provinces)
        );
    }

    public function getDistricts($province)
    {
        $districts = District::where('ilce_sehirkey', 'like', $province)->paginate(25);

        return $this->respondWithResourceCollection(
            DistrictResource::collection($districts)
        );
    }

    public function getNeighborhoods($province, $district)
    {
        $neighborhoods = Neighborhood::where('mahalle_ilcekey', 'like', $district)->paginate(25);

        return $this->respondWithResourceCollection(
            NeighborhoodResource::collection($neighborhoods)
        );
    }

    public function getStreets($province, $district, $neighborhood)
    {
        $streets = Neighborhood::where('sokak_cadde_mahallekey', 'like', $neighborhood)->paginate(25);

        return $this->respondWithResourceCollection(
            StreetResource::collection($streets)
        );
    }

    public function sendHelperForm(Request $request, $help_data_id)
    {
        $help_data = HelpData::find($help_data_id);
        if (!$help_data) {
            return $this->respondError('Yardım Talebi Mevcut Değil', 404);
        }

        if (!$request->has('name') || !$request->has('tel')) {
            return $this->respondError('Lütfen Boş Alan Bırakmayın', 422);
        }

        $helper = new HelperData();
        $helper->name = $request->name;
        $helper->tel = $request->tel;
        $helper->email = $request->email;
        $helper->help_data_id = $help_data_id;
        $result = $helper->save();

        return $result
            ? $this->respondSuccess('Yardım başarıyla başlatılmıştır. Lütfen yardım talep edene ait telefon numarası ile irtibata geçin.')
            : $this->respondError('Yardım başlatılamadı');
    }
}
