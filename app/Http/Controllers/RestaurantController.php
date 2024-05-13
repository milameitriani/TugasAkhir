<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{

    public function get()
    {
        $restaurants = Restaurant::all();
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved restaurants',
            'data' => $restaurants,
        ], 200);
    }


public function create(Request $request)
{
    // Mulai transaksi database
    DB::beginTransaction();

    try {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'postal_code' => 'required|string',
        ]);

        // Simpan data restoran ke database
        $restaurant = Restaurant::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'postal_code' => $request->input('postal_code'),
        ]);

        // Akhiri transaksi database
        DB::commit();

        return response()->json(['message' => 'Restaurant created successfully', 'data' => $restaurant], 201);
    } catch (\Exception $e) {
        // Rollback transaksi database jika terjadi kesalahan
        DB::rollBack();

        return response()->json(['message' => 'Failed to create restaurant', 'error' => $e->getMessage()], 500);
    }
}

}
