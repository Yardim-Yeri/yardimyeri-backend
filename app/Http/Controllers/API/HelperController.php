<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\NeighborhoodResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\StreetResource;
use App\Models\District;
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

    public function getNeighborhoods($district)
    {
        $neighborhoods = Neighborhood::where('mahalle_ilcekey', 'like', $district)->paginate(25);

        return $this->respondWithResourceCollection(
            NeighborhoodResource::collection($neighborhoods)
        );
    }

    public function getStreets($neighborhood)
    {
        $streets = Neighborhood::where('sokak_cadde_mahallekey', 'like', $neighborhood)->paginate(25);

        return $this->respondWithResourceCollection(
            StreetResource::collection($streets)
        );
    }
}
