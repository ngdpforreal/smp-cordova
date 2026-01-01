<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Models\SchoolSetting;

class ContactController extends Controller
{
    public function index()
    {
        $setting = SchoolSetting::first();
        return view('contact', compact('setting'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima (Thank you! We have received your message.)');
    }
}