<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Helpers\IdGenerator;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tambah barang ke keranjang
    public function addToCart(Request $request)
    {
        $request->validate([
        'user_id'   => 'required|exists:users,user_id',
        'kode_item' => 'required|exists:items,kode_item',
        'nama_item' => 'required|string|max:255',
        'quantity'  => 'required|integer|min:1',
        'deskripsi' => 'nullable|string|max:255',
        'status'    => 'nullable|string|max:10'
]);


        $item = Item::where('kode_item', $request->kode_item)->first();

        // Cek apakah barang ini sudah ada di keranjang user
        $existing = Cart::where('user_id', Auth::user()->user_id)
            ->where('kode_item', $request->kode_item)
            ->first();

        if ($existing) {
            $existing->quantity += $request->quantity;
            $existing->save();
        } else {
            $id = IdGenerator::generateId('CART', 'carts');
            Cart::create([
                'id'          => $id,
                'user_id'     => Auth::user()->user_id,
                'kode_item'   => $item->kode_item,
                'nama_item'   => $item->nama_item,
                'warna'       => $item->warna,
                'size'        => $item->size,
                'quantity'    => $request->quantity,
                'deskripsi'   => $request->deskripsi,
                'gambar'      => $item->gambar ?? null
            ]);
        }

        return response()->json(['message' => 'Barang berhasil ditambahkan ke keranjang!']);
    }

    // Lihat isi keranjang user
    public function viewCart()
    {
        $cart = Cart::where('user_id', Auth::user()->user_id)->get();
        return response()->json($cart);
    }

    // Hapus item dari keranjang
    public function removeFromCart($id)
    {
        Cart::where('id', $id)
            ->where('user_id', Auth::user()->user_id)
            ->delete();

        return response()->json(['message' => 'Barang di keranjang berhasil dihapus!']);
    }

    // Kosongkan keranjang
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->user_id)->delete();
        return response()->json(['message' => 'Keranjang berhasil dikosongkan!']);
    }
}
