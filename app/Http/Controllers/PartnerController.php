<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->paginate(9);

        return view('backend.setting.join-us', compact('partners'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'phone'    => 'nullable|string|max:20',
            'business' => 'required|string',
        ]);

        Partner::create([
            'user_id'  => auth()->id(),
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'business' => $request->business,
        ]);

        return back()->with('success', 'Thank you! Your information has been sent successfully.');
    }
}
