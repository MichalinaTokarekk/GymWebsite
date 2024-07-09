<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Shop::class);
        return view(
            'shops.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Shop::class);
        return view(
            'shops.form'
        );
    }

   
    public function edit(Shop $shop)
    {

        $this->authorize('update', $shop);
        return view(
            'shops.form',
            [
                'shop' => $shop
            ]
        );
    }

     
    public function show(Shop $shop)
    {
       
        $this->authorize('show', $shop);
        return view(
            'shops.show',
            [
                'shop' => $shop
            ]
        );
    }
}
