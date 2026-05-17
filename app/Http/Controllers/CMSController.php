<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Log;

class CMSController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.cms.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        
        // Ensure directories exist
        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('assets/brand'));
        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('assets/cms'));

        // Handle Brand Assets
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'logo-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/brand'), $filename);
            SiteSetting::set('site_logo', 'assets/brand/' . $filename);
        }
        
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $filename = 'favicon-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/brand'), $filename);
            SiteSetting::set('site_favicon', 'assets/brand/' . $filename);
        }

        // Handle CMS Landing Page Image Uploads
        if ($request->hasFile('cms_hero_image')) {
            $file = $request->file('cms_hero_image');
            $filename = 'hero-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/cms'), $filename);
            SiteSetting::set('cms_hero_image', 'assets/cms/' . $filename);
        }

        if ($request->hasFile('cms_about_image')) {
            $file = $request->file('cms_about_image');
            $filename = 'about-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/cms'), $filename);
            SiteSetting::set('cms_about_image', 'assets/cms/' . $filename);
        }

        // Handle Gallery Image Uploads (img1 to img4)
        for ($i = 1; $i <= 4; $i++) {
            $key = 'cms_gallery_img' . $i;
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = 'gallery-' . $i . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/cms'), $filename);
                SiteSetting::set($key, 'assets/cms/' . $filename);
            }
        }

        $sections = [
            'cms_section_hero_active',
            'cms_section_products_active',
            'cms_section_features_active',
            'cms_section_recommendations_active',
            'cms_section_blog_active',
            'cms_section_gallery_active'
        ];

        foreach ($sections as $section) {
            SiteSetting::set($section, $request->has($section) ? '1' : '0');
        }

        // Skip keys that are handled as files or arrays
        $fileKeys = ['site_logo', 'site_favicon', 'cms_hero_image', 'cms_about_image', 'cms_gallery_img1', 'cms_gallery_img2', 'cms_gallery_img3', 'cms_gallery_img4'];

        foreach ($data as $key => $value) {
            if (in_array($key, $fileKeys) || in_array($key, $sections)) {
                continue;
            }
            SiteSetting::set($key, $value);
        }

        $message = 'Konten CMS berhasil diperbarui.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'settings' => SiteSetting::all()->pluck('value', 'key')
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
