<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('shop');

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $items = $query->latest()->paginate(12)->withQueryString();

        return view('marketplace.index', compact('items'));
    }

    public function show(Item $item)
    {
        $item->load('shop');

        return view('marketplace.show', compact('item'));
    }
}
