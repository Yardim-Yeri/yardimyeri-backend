<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpData;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function index(Request $request)
    {
        $data = HelpData::filter()->orderBy('created_at', 'DESC')->with('helper')->paginate(200);

        $status = $request->status;

        $provinces = \DB::table('sehir')->get();
        $districts = \DB::table('ilce')->get();
        $neighbourhoods = \DB::table('mahalle')->get();
        $streets = \DB::table('sokak_cadde')->get();

        return view('admin.demands', compact('data', 'status', 'provinces', 'districts', 'neighbourhoods', 'streets'));
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
}
