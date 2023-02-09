<?php

namespace App\Http\Controllers;

use App\Models\HelpData;
use App\Models\HelperData;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function yardimTalebimVar()
    {
        return view('yardim_talebim_var');
    }

    public function yardimdaBulunabilirim(Request $request, $id = null)
    {

        

        if (!empty($id)) {
            return $this->yardimdaBulunabilirimShow($id);
        }

        $all_data = HelpData::orderBy('created_at', 'DESC')->get();

        $success_count = $all_data->where('help_status', 'Yardım Ulaştı')->count();
        $warning_count = $all_data->where('help_status', 'Yardım Bekliyor')->count();
        $info_count = $all_data->where('help_status', 'Yardım Geliyor')->count();
        $data = $all_data->where('help_status', '!=', 'Yardım Ulaştı');

        if($request->has('old_page'))
        {
            return view('yardimda-bulunabilirim-old' , compact('data', 'success_count', 'warning_count', 'info_count'));
        }

        return view('yardimda_bulunabilirim', compact('data', 'success_count', 'warning_count', 'info_count'));
    }

    public function yardimdaBulunabilirimShow($id)
    {
        $item = HelpData::findOrFail($id);

        $helpers = collect();
        if ($item->help_status != 'Yardım Bekliyor') {
            $helpers = HelperData::where('help_data_id', $item->id)->get();
        }

        return view('yardimda_bulunabilirim_show', compact('item', 'helpers'));
    }
}
