<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $products = Product::all();
        return view('inventory', compact('products'));
    })->name('dashboard');

    Route::post('/products', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect('/dashboard');
    });

    Route::post('/products/edit/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Product::findOrFail($id)->update($validated);

        return redirect('/dashboard');
    });

    Route::post('/products/delete/{id}', function ($id) {
        Product::findOrFail($id)->delete();

        return redirect('/dashboard');
    });
});

require __DIR__.'/auth.php';