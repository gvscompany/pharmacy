<?php

namespace App\Http\Controllers;

use App\Product;
use App\Manufacturer;

class ApiController extends Controller
{
    public function manufacturers()
    {
        $manufacturers = Manufacturer::select(['id', 'name'])->get();
        return response()->json($manufacturers);
    }

    public function products()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->manufacturer_id = $product->manufacturer->name;
            $product->purpose_id = $product->purpose->name;
        }
        return response()->json($products);
    }

    public function getProductsByManufacturers($id)
    {
        $productByManufacturer = Product::where('manufacturer_id', $id)->get();
        foreach ($productByManufacturer as $item) {
            $item->manufacturer_id = $item->manufacturer->name;
            $item->purpose_id = $item->purpose->name;
        }
        return response()->json($productByManufacturer);
    }
}
