<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->category !== null) {
            $shops = Shop::where('category_id', $request->category)->sortable();
            $total_count = Shop::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
        } else{
            $shops = Shop::sortable();
            $total_count = "";
            $category = null;
        }

        $categories = Category::all();

        $query = $shops;

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $shops = $query->paginate(15);
        $shops->appends(['search' => $request->input('search')]);

        return view('shops.index', compact('shops', 'category', 'total_count','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->price = $request->input('price');
        $shop->category_id = $request->input('category_id');
        $shop->save();

        return to_route('shops.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $reviews = $shop->reviews()->get();
        $reservations = $shop->reservations()->get();

        return view('shops.show', compact('shop', 'reviews', 'reservations'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
       $categories = Category::all();

       return view('shops.edit', compact('shop', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->price = $request->input('price');
        $shop->category_id = $request->input('category_id');
        $shop->update();
 
        return to_route('shops.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
  
        return to_route('shops.index');
        
    }

    public function favorite(Shop $shop)
    {
        Auth::user()->togglefavorite($shop);

        return back();
    }

  
    
}
 