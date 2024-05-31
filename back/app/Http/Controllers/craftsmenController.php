<?php

namespace App\Http\Controllers;

use App\Models\craft;
use App\Models\craftsmen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\image_craftsmen;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class craftsmenController extends Controller
{
    public function get_craft (){
        $craft= craft::Select('id','type')->orderBy('id')->get();
        return response()->json([
            'error' =>false,
            'data'=> $craft,
        ],200);
    }
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
    public function show_information_craftsman(Request $request){  
        // جلب أحدث حرفي مع العلاقة بالحرفة والصور المرتبطة به
        $latestCraftsman = craftsmen::with(['crafts', 'image_craftsmens'])->latest()->first();     
        if ($latestCraftsman) {
            // إضافة رابط الصورة الشخصية الكامل
            $latestCraftsman->image_url = url(Storage::url('craftsmen_image/'.$latestCraftsman->image));
            
            // إضافة رابط الصور المرتبطة بالحرفي
            $latestCraftsman->image_craftsmens->transform(function($image) {
                $image->full_url = url(Storage::url('craftsmen_image_old_project/'.$image->url));
                return $image;
            });
    
            return response()->json([
                'error' => false,
                'data' => $latestCraftsman,
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'No craftsmen found',
            ], 404);
        }
    }
    
    
    public function update_craftsman(Request $request)
{
    // العثور على الحرفي باستخدام الـ ID (افترض أن الحرفي معرف مسبقاً)
    $craftsman = craftsmen::latest()->first();

    // التحقق من المدخلات
    $validator = Validator::make($request->all(), [
        'firstName' => 'required|string|max:255',
        'craftType' => 'required|string|max:255',
        'place' => 'nullable|string|max:255',
        'price' => 'nullable|numeric',
        'profileImage' => 'nullable|mimes:jpeg,jpg,png,gif|max:10240', // 10MB Max
        'galleryImages.*' => 'nullable|mimes:jpeg,jpg,png,gif|max:10240',
        'existingImages.*.id' => 'nullable|integer|exists:image_craftsmens,id',
        'existingImages.*.description' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ], 422);
    }

    // تحديث بيانات الحرفي
    $craftsman->firstName = $request->input('firstName');
    $craftsman->id_crafts = $request->input('craftType');
    $craftsman->place = $request->input('place');
    $craftsman->price = $request->input('price');

    // تحديث الصورة الشخصية إذا كانت موجودة
    if ($request->hasFile('profileImage')) {
        $profileImage = $request->file('profileImage');
        $profileImagePath = Str::random(8) . time() . '.' . $profileImage->getClientOriginalExtension();
        $profileImage->storeAs('public/craftsmen_image', $profileImagePath);
        $craftsman->image = $profileImagePath;
    }

    $craftsman->save();

    // إضافة الصور الجديدة إلى معرض الصور
    if ($request->hasFile('galleryImages')) {
        foreach ($request->file('galleryImages') as $key => $file) {
            $description = $request->input("galleryDescriptions.$key");
            $filePath = Str::random(8) . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/craftsmen_image_old_project', $filePath);

            image_craftsmen::create([
                'url' => $filePath,
                'id_craftsmen' => $craftsman->id,
                'description' => $description,
            ]);
        }
    }

    // تحديث وصف الصور القديمة
    if ($request->has('existingImages')) {
        foreach ($request->input('existingImages') as $existingImage) {
            $image = image_craftsmen::find($existingImage['id']);
            if ($image) {
                $image->description = $existingImage['description'];
                $image->save();
            }
        }
    }

    // حذف الصور المحددة
    if ($request->has('deletedImages')) {
        foreach ($request->input('deletedImages') as $id) {
            $image = image_craftsmen::find($id);
            if ($image) {
                Storage::delete('public/craftsmen_image_old_project/' . $image->url);
                $image->delete();
            }
        }
    }

    return response()->json([
        'error' => false,
        'message' => 'Craftsman updated successfully',
        'craftsman' => $craftsman->load('crafts', 'image_craftsmens'),
    ], 200);
}


    
}
