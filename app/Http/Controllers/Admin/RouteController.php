<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::orderBy('origin_city')->orderBy('destination_city')->paginate(10);
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.routes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'origin_city' => ['required','string','max:100'],
            'destination_city' => ['required','string','max:100'],
            'regular_price' => ['required','integer','min:0'],
        ]);

        Route::create($data);
        return redirect()->route('admin.routes.index')->with('success','Rute berhasil ditambahkan.');
    }

    public function edit(Route $route)
    {
        return view('admin.routes.edit', compact('route'));
    }

    public function update(Request $request, Route $route)
    {
        $data = $request->validate([
            'origin_city' => ['required','string','max:100'],
            'destination_city' => ['required','string','max:100'],
            'regular_price' => ['required','integer','min:0'],
        ]);

        $route->update($data);
        return redirect()->route('admin.routes.index')->with('success','Rute berhasil diperbarui.');
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('admin.routes.index')->with('success','Rute berhasil dihapus.');
    }

    public function show(Route $route)
    {
        return redirect()->route('admin.routes.edit', $route);
    }
}