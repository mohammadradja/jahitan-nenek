<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function index()
    {
        $measurements = Measurement::with('user')->latest()->paginate(10);
        return view('admin.measurements.index', compact('measurements'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.measurements.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hip' => 'nullable|numeric',
            'shoulder' => 'nullable|numeric',
            'sleeve_length' => 'nullable|numeric',
            'body_length' => 'nullable|numeric',
        ]);

        Measurement::create($request->all());

        return redirect()->route('admin.measurements.index')->with('success', 'Data ukuran pelanggan berhasil disimpan.');
    }

    public function show(Measurement $measurement)
    {
        return view('admin.measurements.show', compact('measurement'));
    }

    public function edit(Measurement $measurement)
    {
        return view('admin.measurements.edit', compact('measurement'));
    }

    public function update(Request $request, Measurement $measurement)
    {
        $measurement->update($request->all());
        return redirect()->route('admin.measurements.index')->with('success', 'Data ukuran pelanggan berhasil diperbarui.');
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return redirect()->route('admin.measurements.index')->with('success', 'Data ukuran pelanggan berhasil dihapus.');
    }
}
