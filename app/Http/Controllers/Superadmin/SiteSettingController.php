<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
        return view('superadmin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section');
        $data = $request->except(['_token', 'section']);
        
        foreach ($data as $key => $value) {
            \App\Models\SiteSetting::set($key, $value);
        }

        $message = 'Pengaturan ' . ($section ?? 'sistem') . ' berhasil diperbarui.';
        return redirect()->back()->with('success', $message);
    }
}
