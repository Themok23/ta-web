<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $branding = Footer::where('key', 'branding')->first();
        $social = Footer::where('key', 'social')->first();
        $contact = Footer::where('key', 'contact')->first();

        return view('backend.setting.footer', compact(
            'branding',
            'social',
            'contact'
        ));
    }

    public function update(Request $request)
    {
        // Validate
        $request->validate([
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Handle Logo Image Upload
        $logoImagePath = $request->logo_image_old;
        if ($request->hasFile('logo_image')) {
            if ($logoImagePath && file_exists(public_path($logoImagePath))) {
                unlink(public_path($logoImagePath));
            }

            $logoImage = $request->file('logo_image');
            $logoImageName = 'footer_logo_' . time() . '.' . $logoImage->getClientOriginalExtension();
            $logoImage->move(public_path('assets/img/footer'), $logoImageName);
            $logoImagePath = 'assets/img/footer/' . $logoImageName;
        }

        // Update Branding Section
        Footer::updateOrCreate(
            ['key' => 'branding'],
            [
                'value' => [
                    'logo_text_trades' => $request->logo_text_trades,
                    'logo_text_axis' => $request->logo_text_axis,
                    'logo_image' => $logoImagePath,
                    'tagline' => $request->tagline,
                    'newsletter_text' => $request->newsletter_text,
                ]
            ]
        );

        // Update Social Section
        Footer::updateOrCreate(
            ['key' => 'social'],
            [
                'value' => [
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'linkedin' => $request->linkedin,
                ]
            ]
        );

        // Update Contact Section
        Footer::updateOrCreate(
            ['key' => 'contact'],
            [
                'value' => [
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]
            ]
        );

        return back()->with('success', 'Footer settings updated successfully!');
    }
}
