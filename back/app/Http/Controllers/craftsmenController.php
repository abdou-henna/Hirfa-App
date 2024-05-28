<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\craftsmen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class craftsmenController extends Controller
{
    public function complete_register(Request $request){     
        $validator = Validator::make($request->all(), [
            'personalPhoto' => ['required', 'mimes:jpeg,jpg,png,gif', ],
            'idCard' => ['required', 'mimes:jpeg,jpg,png,gif', ],
            'craftCertificate' => ['required'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' =>true,
                'message'=>$validator->errors()
            ],200);
        };

        $img= Image::make($request->file('personalPhoto'));
        $personalPhotoPath= Str::random(8) . time();
        $img->save(storage_path('app/public/craftsmen_image').'/'.$personalPhotoPath);
        
        $img= Image::make($request->file('idCard'));
        $idCardPath= Str::random(8) . time();
        $img->save(storage_path('app/public/craftsmen_image').'/'.$idCardPath);

        $img= Image::make($request->file('craftCertificate'));
        $craftCertificatePath= Str::random(8) . time();
        $img->save(storage_path('app/public/craftsmen_image').'/'.$craftCertificatePath);

        
        $lastUser = craftsmen::latest()->first();
        $lastUser->id_card = $idCardPath;
        $lastUser->image = $personalPhotoPath;
        $lastUser->craftsman_certificate = $craftCertificatePath;
        $lastUser->save();
        
        return response()->json([
            'error' =>false,
            'message'=>"Registration completed successfully",
            'data'=> $lastUser,
            'role' => 'user'
        ],200);


        
    }
}
