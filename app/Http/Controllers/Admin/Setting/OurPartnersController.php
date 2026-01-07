<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\OurPartners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurPartnersController extends Controller
{
    public function index()
    {
        $hero = OurPartners::where('key', 'hero')->first();
        $trust = OurPartners::where('key', 'trust')->first();
        $brands = OurPartners::where('key', 'brands')->first();
        $count = OurPartners::where('key', 'count')->first();

        return view('backend.setting.our_partners', compact(
            'hero',
            'trust',
            'brands',
            'count'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'brand_logos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);


        $heroImagePath = $request->hero_image_old; 

        if ($request->hasFile('hero_image')) {
            if ($heroImagePath && file_exists(public_path($heroImagePath))) {
                unlink(public_path($heroImagePath));
            }
            
            $heroImage = $request->file('hero_image');
            $heroImageName = 'hero_' . time() . '.' . $heroImage->getClientOriginalExtension();
            $heroImage->move(public_path('assets/img/partners'), $heroImageName);
            $heroImagePath = 'assets/img/partners/' . $heroImageName;
        }

        elseif (empty($request->hero_image_old)) {
            $oldHero = OurPartners::where('key', 'hero')->first();
            if ($oldHero && isset($oldHero->value['image']) && $oldHero->value['image']) {
                $oldImagePath = $oldHero->value['image'];
                if (file_exists(public_path($oldImagePath))) {
                    unlink(public_path($oldImagePath));
                }
            }
            $heroImagePath = null; 
        }

        OurPartners::updateOrCreate(
            ['key' => 'hero'],
            [
                'value' => [
                    'title' => $request->hero_title ?? 'Our Partners',
                    'subtitle' => $request->hero_subtitle ?? '',
                    'image' => $heroImagePath, 
                ]
            ]
        );


        OurPartners::updateOrCreate(
            ['key' => 'trust'],
            [
                'value' => [
                    'text' => $request->trust_text ?? "The world's best companies trust Trades Axis.",
                ]
            ]
        );


        $brandItems = [];
        
        if ($request->has('brand_names')) {
            foreach ($request->brand_names as $index => $brandName) {
                if (empty($brandName)) {
                    continue;
                }

                $logoPath = $request->input('brand_logo_old.' . $index);
                
                if ($request->hasFile('brand_logos.' . $index)) {
                    if ($logoPath && file_exists(public_path($logoPath))) {
                        unlink(public_path($logoPath));
                    }
                    
                    $logo = $request->file('brand_logos.' . $index);
                    $logoName = 'brand_' . time() . '_' . $index . '.' . $logo->getClientOriginalExtension();
                    $logo->move(public_path('assets/img/partners/brands'), $logoName);
                    $logoPath = 'assets/img/partners/brands/' . $logoName;
                }
                
                $brandItems[] = [
                    'name' => $brandName,
                    'logo' => $logoPath, 
                ];
            }
        }

        OurPartners::updateOrCreate(
            ['key' => 'brands'],
            [
                'value' => [
                    'items' => $brandItems,
                ]
            ]
        );


        OurPartners::updateOrCreate(
            ['key' => 'count'],
            [
                'value' => [
                    'text' => $request->count_text ?? 'Trades Axis is partner with over 100+ companies across the world',
                ]
            ]
        );

        return back()->with('success', 'Our Partners settings updated successfully!');
    }
}