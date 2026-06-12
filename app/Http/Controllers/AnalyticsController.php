<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function click(Request $request)
    {
        $validated = $request->validate([
            'path' => ['nullable', 'string', 'max:255'],
            'target' => ['nullable', 'string', 'max:255'],
        ]);

        AnalyticsEvent::create([
            'event_type' => 'click',
            'path' => $validated['path'] ?? $request->path(),
            'target' => $validated['target'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true]);
    }
}
