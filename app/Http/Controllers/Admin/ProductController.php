<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Purpose;
use App\Manufacturer;
use File;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        if (view()->exists('admin.product-list')) {
            return view('admin.product-list', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = Manufacturer::all();
        $purposes = Purpose::all();
        if (view()->exists('admin.product-add')) {
            return view('admin.product-add', [
                'manufacturers' => $manufacturers,
                'purposes' => $purposes,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $inputs = $request->except('_token');
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $new_name = uniqid(mb_strimwidth($poster->getClientOriginalName(), 0, 3, '_')) . '.' . $poster->getClientOriginalExtension();

            $img = Image::make($poster);
            $img->insert(public_path().'/images/watermark.png', 'center');
            $img->save(public_path() . '/images/' . $new_name);

            $inputs['poster'] = $new_name;
        } else {
            $inputs['poster'] = null;
        }
        if ($inputs['available'] === 'yes') {
            $inputs['available'] = 1;
        } else {
            $inputs['available'] = 0;
        }
        $new_product = new Product();
        $new_product->fill($inputs);
        if ($new_product->save()) {
            return redirect()->route('product.index')->with('status', 'Product successfully create !!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manufacturers = Manufacturer::all();
        $purposes = Purpose::all();
        $updatable_product = Product::find($id);
        if (view()->exists('admin.product-edit')) {
            return view('admin.product-edit', [
                'updatable_product' => $updatable_product,
                'manufacturers' => $manufacturers,
                'purposes' => $purposes,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $inputs = $request->except(['_method', '_token']);
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $new_name = uniqid(mb_strimwidth($poster->getClientOriginalName(), 0, 3, '_')) . '.' . $poster->getClientOriginalExtension();

            $img = Image::make($poster);
            $img->insert(public_path().'/images/watermark.png', 'center');
            $img->save(public_path() . '/images/' . $new_name);

            File::delete('images/' . $inputs['old_poster']);
            $inputs['poster'] = $new_name;
            unset($inputs['old_poster']);
        } else {
            $inputs['poster'] = $inputs['old_poster'] ?? null;
            unset($inputs['old_poster']);
        }
        if ($inputs['available'] === 'yes') {
            $inputs['available'] = 1;
        } else {
            $inputs['available'] = 0;
        }
        $update_product = Product::find($id);
        $update_product->fill($inputs);
        if ($update_product->update()) {
            return redirect()->route('product.index')->with('status', 'Product successfully updated !!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->delete()) {
            return redirect()->route('product.index')->with('status', 'Product successfully send to trash !!!');
        }
    }


    /**
     * View all trash
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $trashed_products = Product::onlyTrashed()->paginate(5);
        if (view()->exists('admin.product-trash')) {
            return view('admin.product-trash', compact('trashed_products'));
        }
    }


    /**
     * Restore from trash
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $restore_product = Product::withTrashed()->findOrFail($id);
        if ($restore_product->restore()) {
            return redirect()->back()->with('status', 'Product successfully restore !!!');
        }
    }


    /**
     * Final delete from trash
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $delete_product = Product::withTrashed()->findOrFail($id);
        if ($delete_product->poster) {
            File::delete('images/' . $delete_product->poster);
        }
        if ($delete_product->forceDelete()) {
            return redirect()->back()->with('status', 'Product successfully delete !!!');
        }
    }
}
