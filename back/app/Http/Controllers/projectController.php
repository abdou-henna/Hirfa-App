<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\image_project;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function request_register(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|integer',
            'images' => 'nullable|array', // الصور يمكن أن تكون مصفوفة
            'images.*' => 'nullable|string', // كل عنصر في المصفوفة يجب أن يكون نص
        ]);

        // العثور على المستخدم الأخير في قاعدة البيانات
        $user = \App\Models\User::latest()->first();

        // إنشاء مشروع جديد
        $project = Project::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => now(),
            'state' => 1,
            'id_crafts' => $request->category,
            'id_craftsmen' => null,
            'id_user' => $user->id,
        ]);

        // حفظ الصور إذا تم تحميلها
        if ($request->images) {
            foreach ($request->images as $imageData) {
                $imageName = Str::random(8) . time() . '.png';
                $imagePath = storage_path('app/public/image_projects') . '/' . $imageName;

                // تحويل بيانات base64 إلى صورة باستخدام Intervention Image
                $img = Image::make(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
                $img->save($imagePath);

                image_project::create([
                    'url' => $imageName,
                    'id_project' => $project->id,
                ]);
            }
        }

        return response()->json(['message' => 'تم إنشاء المشروع بنجاح'], 201);
    }
    public function getProjects(Request $request)
    {
        // فلترة المنشورات حسب المستخدم والفئة والتوقيت إذا كانت موجودة
        $query = Project::query();

        if ($request->has('user_id')) {
            $query->where('id_user', $request->user_id);
        }

        if ($request->has('category')) {
            $query->where('id_crafts', $request->category);
        }

        if ($request->has('time')) {
            $now = \Carbon\Carbon::now();
            switch ($request->time) {
                case 'hour':
                    $query->where('date', '>=', $now->subHour());
                    break;
                case 'day':
                    $query->where('date', '>=', $now->subDay());
                    break;
                case 'week':
                    $query->where('date', '>=', $now->subWeek());
                    break;
            }
        }

        $projects = $query->with('user', 'crafts', 'image_project')->get();
        $projects->transform(function ($project) {
            $project->image_project->transform(function ($image) {
                $image->url = url('storage/image_projects/' . $image->url);
                return $image;
            });
            return $project;
        });

        return response()->json(['projects' => $projects], 200);
    }
}
