<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use Carbon\Carbon;

class LaptopController extends Controller
{
    public function showInputForm()
    {
        return view('laptop.input');
    }

   public function store(Request $request)
{
    $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'price' => 'required',
        'selling_price' => 'required'
    ]);

    // ✅ Bersihkan format harga
    $price = preg_replace('/[^\d]/', '', $request->price); // Rp 1.000.000 → 1000000
    $selling_price = preg_replace('/[^\d]/', '', $request->selling_price);

    $count = Laptop::count();
    $newId = ($count % 100) + 1;
    Laptop::where('id', $newId)->delete();

    Laptop::create([
        'brand' => $request->brand,
        'model' => $request->model,
        'price' => $price,
        'selling_price' => $selling_price,
    ]);

    return redirect('/laptop/input')->with('success', 'Data laptop berhasil disimpan.');
}

    // ✅ List laptop + fitur sortir
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'price');
        $sortOrder = $request->get('sort_order', 'asc');

        $laptops = Laptop::where('sold', 0)  // hanya ambil laptop yang belum terjual
       ->orderBy($sortBy, $sortOrder)
       ->get();

        return view('laptop.list', compact('laptops', 'sortBy', 'sortOrder'));
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $laptop = Laptop::findOrFail($id);
        return view('laptop.edit', compact('laptop'));
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric',
            'selling_price' => 'required|numeric|min:0'
        ]);

        $laptop = Laptop::findOrFail($id);
        $laptop->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'price' => $request->price,
            'selling_price' => $request->selling_price,
        ]);

        return redirect('/laptop/list')->with('success', 'Data laptop berhasil diupdate.');
    }

    // ✅ Delete data
    public function destroy($id)
    {
        $laptop = Laptop::findOrFail($id);
        $laptop->delete();

        return redirect('/laptop/list')->with('success', 'Data laptop berhasil dihapus.');
    }

    // Mark laptops as sold
public function markSold(Request $request)
{
    $request->validate([
        'laptop_ids' => 'required|array',
    ]);

    Laptop::whereIn('id', $request->laptop_ids)->update([
        'sold' => 1,
        'sold_at' => Carbon::now(),
    ]);

    return redirect()->route('laptop.index')->with('success', 'Laptop berhasil dipindahkan ke halaman terjual.');
}
// Show sold laptops
public function sold()
{
     $laptops = Laptop::where('sold', 1)->get();

    // Hitung akumulasi selisih harga dalam 1 bulan terakhir
    $oneMonthAgo = Carbon::now()->subMonth();

    $totalSelisih = Laptop::where('sold', 1)
        ->where('sold_at', '>=', $oneMonthAgo)
        ->sum(\DB::raw('selling_price - price'));

    return view('laptop.sold', compact('laptops', 'totalSelisih'));
}

public function dashboard()
{
    $totalLaptop = Laptop::count();

   $totalLaptopSold = Laptop::where('sold', 1)
    ->where('sold_at', '>=', now()->subMonth())
    ->count();

// Total profit
$totalProfit = Laptop::where('sold', 1)
    ->where('sold_at', '>=', now()->subMonth())
    ->get()
    ->sum(function($laptop) {
        return $laptop->selling_price - $laptop->price;
    });

    return view('dashboard', compact('totalLaptop', 'totalLaptopSold', 'totalProfit'));
}


}

