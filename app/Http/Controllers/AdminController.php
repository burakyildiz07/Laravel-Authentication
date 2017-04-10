<?php

namespace App\Http\Controllers;

use App\HaberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Admin sayfasına yönlendirme
    public function get_admin(){
        return view('backend.pages.anasayfa');
    }

    public function get_haberEkle()
    {
        return view('backend.pages.haber-ekle');
    }

    public function post_haberEkle(Request $request)
    {
        $kontrol=Validator::make($request->all(),array(
            'baslik'=>'required|min:2',
            'icerik'=>'required|min:2'
        ));

        if ($kontrol->fails()){
            return response(['baslik'=>'Boş alan','msg'=>'Lüthen tüm alanları eksiksiz doldurun.']);
        }
        else{
            $request->merge(['kullanici_id'=>Auth::user()->id,'slug'=>str_slug($request->baslik)]);
            $kaydet=HaberModel::create($request->all());

            if ($kaydet)
            {
                return response(['baslik'=>'Başarılı','msg'=>'Başarılı bir şekilde kaydedildi.','code'=>200],200);
            }
            else{
                return response(['baslik'=>'Hata','msg'=>'İşlemde hata oluştu!']);
            }
        }
    }
}
