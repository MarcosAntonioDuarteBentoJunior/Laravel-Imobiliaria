<?php

namespace App\Http\Controllers;

use App\Models\RealtyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Realty;

class RealtyPhotoController extends Controller
{
    public function removePhoto(Request $request)
    {
        $photoName = $request->get('photoName');

    	//Removo dos arquivos
		if(Storage::disk('public')->exists($photoName)) {
			Storage::disk('public')->delete($photoName);
		}

		//Removo a imagem do banco
        $removePhoto = RealtyPhoto::where('image_path', $photoName);

		$realtyId   = $removePhoto->first()->realty_id;
        $realty = Realty::find($realtyId)->first();

		$removePhoto->delete();

		return redirect()->route('realty.edit', $realty->slug);
    }
}
