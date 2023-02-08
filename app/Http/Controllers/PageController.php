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

    public function yardimdaBulunabilirim($id = null)
    {
        if (!empty($id)) {
            return $this->yardimdaBulunabilirimShow($id);
        }

        $data = HelpData::where('help_status', '!=', 'Yardım Ulaştı')->get();

        return view('yardimda_bulunabilirim', compact('data'));
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
