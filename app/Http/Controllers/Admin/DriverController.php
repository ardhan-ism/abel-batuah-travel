<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('name')->paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'phone' => ['nullable','string','max:30'],
            'status' => ['required','in:available,busy,off'],
        ]);

        Driver::create($data);
        return redirect()->route('admin.drivers.index')->with('success','Sopir ditambahkan.');
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'phone' => ['nullable','string','max:30'],
            'status' => ['required','in:available,busy,off'],
        ]);

        $driver->update($data);
        return redirect()->route('admin.drivers.index')->with('success','Sopir diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success','Sopir dihapus.');
    }

    public function show(Driver $driver)
    {
        return redirect()->route('admin.drivers.edit', $driver);
    }
}