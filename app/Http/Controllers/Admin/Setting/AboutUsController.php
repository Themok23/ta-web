<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $hero = AboutUs::where('key', 'hero')->first();
        $mission = AboutUs::where('key', 'mission')->first();
        $vision = AboutUs::where('key', 'vision')->first();

        return view('backend.setting.about_us', compact(
            'hero',
            'mission',
            'vision'
        ));
    }

    public function update(Request $request)
    {
        // Validate
        $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vision_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vision_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vision_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vision_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $heroImagePath = $request->hero_image_old;
        if ($request->hasFile('hero_image')) {
            if ($heroImagePath && file_exists(public_path($heroImagePath))) {
                unlink(public_path($heroImagePath));
            }
            
            $heroImage = $request->file('hero_image');
            $heroImageName = 'hero_' . time() . '.' . $heroImage->getClientOriginalExtension();
            $heroImage->move(public_path('assets/img/about'), $heroImageName);
            $heroImagePath = 'assets/img/about/' . $heroImageName;
        }

        AboutUs::updateOrCreate(
            ['key' => 'hero'],
            [
                'value' => [
                    'title' => $request->hero_title,
                    'subtitle' => $request->hero_subtitle,
                    'image' => $heroImagePath,
                ]
            ]
        );

        AboutUs::updateOrCreate(
            ['key' => 'mission'],
            [
                'value' => [
                    'title' => $request->mission_title,
                    'description' => $request->mission_description,
                ]
            ]
        );

        $visionImages = [];
        for ($i = 1; $i <= 4; $i++) {
            $fieldName = 'vision_image_' . $i;
            $oldFieldName = 'vision_image_' . $i . '_old';
            
            $imagePath = $request->$oldFieldName;
            
            if ($request->hasFile($fieldName)) {
                if ($imagePath && file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
                
                $image = $request->file($fieldName);
                $imageName = 'vision_' . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/about/vision'), $imageName);
                $imagePath = 'assets/img/about/vision/' . $imageName;
            }
            
            $visionImages[] = $imagePath;
        }

        AboutUs::updateOrCreate(
            ['key' => 'vision'],
            [
                'value' => [
                    'title' => $request->vision_title,
                    'description' => $request->vision_description,
                    'images' => $visionImages,
                ]
            ]
        );

        return back()->with('success', 'About Us updated successfully!');
    }
}