<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CMSController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.cms.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate($this->imageValidationRules());

        $data = $request->except(['_token']);
        
        File::ensureDirectoryExists(public_path('assets/images/settings'));

        // Handle CMS Landing Page Image Uploads
        if ($request->hasFile('cms_hero_image')) {
            SiteSetting::set('cms_hero_image', $this->storeImage($request, 'cms_hero_image'));
        }

        if ($request->hasFile('cms_about_image')) {
            SiteSetting::set('cms_about_image', $this->storeImage($request, 'cms_about_image'));
        }

        // Handle Gallery Image Uploads (img1 to img4)
        for ($i = 1; $i <= 4; $i++) {
            $key = 'cms_gallery_img' . $i;
            if ($request->hasFile($key)) {
                SiteSetting::set($key, $this->storeImage($request, $key));
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
            SiteSetting::set($section, $request->has($section) ? '1' : '0', 'boolean', 'cms');
        }

        // Skip keys that are handled as files or arrays
        $fileKeys = ['cms_hero_image', 'cms_about_image', 'cms_gallery_img1', 'cms_gallery_img2', 'cms_gallery_img3', 'cms_gallery_img4'];

        foreach ($data as $key => $value) {
            if (in_array($key, $fileKeys) || in_array($key, $sections)) {
                continue;
            }
            SiteSetting::set($key, $value, 'string', 'cms');
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

    private function storeImage(Request $request, string $key): string
    {
        $file = $request->file($key);
        $filename = Str::slug($key) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/settings'), $filename);

        return 'assets/images/settings/' . $filename;
    }

    private function imageValidationRules(): array
    {
        $rules = [];

        foreach (['cms_hero_image', 'cms_about_image', 'cms_gallery_img1', 'cms_gallery_img2', 'cms_gallery_img3', 'cms_gallery_img4'] as $key) {
            $rules[$key] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,avif', 'max:5120'];
        }

        return $rules;
    }
}
