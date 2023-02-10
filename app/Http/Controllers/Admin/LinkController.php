<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(){
        $links=UsefulLink::get();
        return view('admin.useful-links',compact('links'));
   }

   public function store(Request $request){
    dd($request->all());
        $link = new UsefulLink();
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->save();

        return $link
        ? back()->with('success','Link Başarıyla Oluşturuldu')
        : back()->with('error','Link Oluşturulamadı');
   }

   public function update(Request $request,$id){
        $link = UsefulLink::find($id);
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->save();
        return $link
        ? back()->with('success','Link Başarıyla Güncellendi')
        : back()->with('error','Link Güncellenemedi');

   }

   public function delete($id){
        return UsefulLink::whereId($id)->delete()
        ? back()->with('success','Link Başarıyla Silindi')
        : back()->with('error','Link Silinemedi');
   }
}
