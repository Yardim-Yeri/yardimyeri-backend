<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use App\Models\HelpData;
use App\Models\Neighborhood;
use App\Models\Province;
use App\Models\Street;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function index(Request $request)
    {
        
        $cities=Province::whereIn('sehir_title',config('cities.avaliable_cities'))->get();

        $data = HelpData::orderBy('created_at', 'DESC')
        ->with('helper')
        ->filter()
        ->paginate(200);

        $status = $request->status;

        return view('admin.demands', compact('data', 'status','cities'));
    }

    public function show($id)
    {
        $data = HelpData::find($id);

        return view('admin.demand-show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = HelpData::find($id);

        $data->name = $request->name;
        $data->tel = $request->tel;
        $data->ihtiyac_turu_detayi = $request->ihtiyac_turu_detayi;
        $data->kac_kisilik = $request->kac_kisilik;
        $data->help_status = $request->help_status;

        $status = $data->save();

        return $status
            ? back()->with('success', 'Talep Güncellendi')
            : back()->with('error', 'Talep Güncellenemedi');
    }

    public function approved($id)
    {
        $help_data = HelpData::findOrFail($id);

        $help_data->approved = !$help_data->approved;
        $status = $help_data->save();

        return $status ? response()->json(['success' => true]) : response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $help_data = HelpData::find($id);
        $status = $help_data->delete();

        return $status
            ? back()->with('success', 'Talep Silindi')
            : back()->with('error', 'Talep Silinemedi');
    }

    public function getDistricts($province_id){
        $districts=District::where('ilce_sehirkey',$province_id)->get();
        foreach($districts as $disc)
        {
            $data[]=[
                'id'=>$disc->ilce_key,
                'text'=>$disc->ilce_title
            ];
        }
        return response()->json($data);
    }

    public function getNeighborhood($district_id){
        $neighborhood=Neighborhood::where('mahalle_ilcekey',$district_id)->get();
        foreach($neighborhood as $neigh)
        {
            $data[]=[
                'id'=>$neigh->mahalle_key,
                'text'=>$neigh->mahalle_title
            ];
        }
        return response()->json($data);
    }

    public function getStreet($neighborhood_id){
        $streets=Street::where('sokak_cadde_mahallekey',$neighborhood_id)->get();
        foreach($streets as $street)
        {
            $data[]=[
                'id'=>$street->sokak_cadde_id,
                'text'=>$street->sokak_cadde_title
            ];
        }
        return $data ? response()->json($data) : response()->json(['id'=>1,'text'=>'Veri Yok']);
    }

}
