<?php

namespace App\Http\Controllers;

use App\HelpDataExport;
use App\Http\Requests\HelpStartRequest;
use App\Http\Requests\YardimTalebiRequest;
use App\Models\HelpData;
use App\Models\HelperData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ApiController extends Controller
{
    public function getCountryData(Request $request)
    {
        $type = $request->input('type');

        if ($type == 'ilceler') {
            $sehir_title = $request->input('sehir');

            $sehir = DB::table('sehir')->where('sehir_title', $sehir_title)->first();
            $ilceler = DB::table('ilce')->where('ilce_sehirkey', $sehir->sehir_key)->get();

            return response()->json($ilceler);
        } elseif ($type == 'mahalle') {
            $ilce_key = $request->input('ilce');

            $mahalleler = DB::table('mahalle')->where('mahalle_ilcekey', $ilce_key)->get();

            return response()->json($mahalleler);
        } elseif ($type == 'sokak') {
            $mahalle_key = $request->input('mahalle');

            $sokaklar = DB::table('sokak_cadde')->where('sokak_cadde_mahallekey', $mahalle_key)->get();

            return response()->json($sokaklar);
        }

        abort(404);
    }

    public function sendYardimTalebiForm(YardimTalebiRequest $request)
    {
        $help_data = new HelpData();
        $help_data->name = $request->input('name');
        $help_data->tel = $request->input('tel');
        $help_data->ihtiyac_turu = $request->input('ihtiyac_turu');
        $help_data->ihtiyac_turu_detayi = $request->input('ihtiyac_turu_detayi');
        $help_data->kac_kisilik = $request->input('kac_kisilik');
        $help_data->sehir = $request->input('sehir');
        $help_data->ilce_id = $request->input('ilce');
        $help_data->mahalle_id = $request->input('mahalle');
        $help_data->sokak_id = (int)$request->input('sokak');
        $help_data->apartman = $request->input('apartman');
        $help_data->adres_tarifi = $request->input('adres_tarifi');
        $help_data->lat = $request->input('lat');
        $help_data->lng = $request->input('lng');
        $help_data->save();

        return response()->json(['success' => true, 'message' => 'Yardım talebiniz başarıyla kaydedilmiştir.']);
    }

    public function changeHelpStatus(HelpStartRequest $request, $id)
    {
        $item = HelpData::findOrFail($id);
        $status = $request->input('status');

        $message = 'Yardım başarıyla başlatılmıştır. Lütfen yardım talep edene ait telefon numarası ile irtibata geçin.';
        if ($status == 'Yardım Geliyor') {
            $helper = new HelperData();
            $helper->name = $request->input('name');
            $helper->tel = $request->input('tel');
            $helper->email = $request->input('email');
            $helper->help_data_id = $item->id;
            $helper->save();
        } elseif ($status == 'Yardım Ulaştı') {
            $message = 'Yardım başarıyla bitirilmiştir.';
        } elseif ($status == 'Yardım Bekliyor') {
            $message = 'Yardım başarıyla iptal edilmiştir.';
        }

        $item->help_status = $status;
        $item->save();

        return response()->json(['success' => true, 'message' => $message, 'help_id' => $item->id]);
    }

    public function exportSpreadsheet(Request $request)
    {
        return Excel::download(
            new HelpDataExport(),
            sprintf('yardim_talepleri_%s.xlsx', strftime('%Y-%m-%d-%H-%M-%S')),
            \Maatwebsite\Excel\Excel::CSV,
            ['Content-Type' => 'text/csv']
        );
    }
}
