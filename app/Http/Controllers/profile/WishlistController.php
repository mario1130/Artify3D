<?php

namespace App\Http\Controllers\profile;

use App\Models\Wishlist;
use App\Models\WishlistGroup;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index($groupId)
    {
        $wishlistGroup = WishlistGroup::findOrFail($groupId);
        $wishlists = Wishlist::where('wishlist_group_id', $groupId)->get();

        return view('profile.wishlist', compact('wishlistGroup', 'wishlists'));
    }

    public function groups()
    {
        $wishlistGroups = WishlistGroup::where('user_id', auth()->id())->get();

        return view('profile.wishlist_groups', compact('wishlistGroups'));
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        WishlistGroup::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
        ]);

        return redirect()->route('wishlist.groups')->with('success', 'Lista de deseos creada correctamente.');
    }

    public function destroyGroup($id)
    {
        $group = WishlistGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('wishlist.groups')->with('success', 'Lista de deseos eliminada correctamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'wishlist_group_id' => 'required|exists:wishlist_groups,id',
        ]);

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'wishlist_group_id' => $request->wishlist_group_id,
        ]);

        return redirect()->back()->with('success', 'Producto añadido a la lista de deseos.');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return redirect()->back()->with('success', 'Producto eliminado de la lista de deseos.');
    }
}