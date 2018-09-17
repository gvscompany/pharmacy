<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manufacturer;
use App\Http\Requests\ManufacturerRequest;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::orderBy('id', 'DESC')->paginate(5);
        if (view()->exists('admin.manufacturer-list')) {
            return view('admin.manufacturer-list', compact('manufacturers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (view()->exists('admin.manufacturer-add')) {
            return view('admin.manufacturer-add');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ManufacturerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManufacturerRequest $request)
    {
        $inputs = $request->except('_token');
        $new_manufacturer = new Manufacturer();
        $new_manufacturer->fill($inputs);
        if ($new_manufacturer->save()) {
            return redirect()->route('manufacturer.index')->with('status', 'Manufacturer successfully added !!!');
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
        $updatable_manufacturer = Manufacturer::find($id);
        if (view()->exists('admin.manufacturer-edit')) {
            return view('admin.manufacturer-edit', compact('updatable_manufacturer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ManufacturerRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManufacturerRequest $request, $id)
    {
        $inputs = $request->except(['_method', '_token']);
        $update_manufacturer = Manufacturer::find($id);
        $update_manufacturer->fill($inputs);
        if ($update_manufacturer->update()) {
            return redirect()->route('manufacturer.index')->with('status', 'Manufacturer successfully updated !!!');
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
        $manufacturer = Manufacturer::find($id);
        if ($manufacturer->products->isEmpty()) {
            if ($manufacturer->delete()) {
                return redirect()->route('manufacturer.index')->with('status', 'Manufacturer successfully send to trash !!!');
            }
        } else {
            return redirect()->route('manufacturer.index')->with('status', 'This manufacturer has products present, first send them to the trash !!!');
        }
    }


    /**
     * View all trash
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $trashed_manufacturers = Manufacturer::onlyTrashed()->paginate(5);
        if (view()->exists('admin.manufacturer-trash')) {
            return view('admin.manufacturer-trash', compact('trashed_manufacturers'));
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
        $restore_manufacturer = Manufacturer::withTrashed()->findOrFail($id);
        if ($restore_manufacturer->restore()) {
            return redirect()->back()->with('status', 'Manufacturer successfully restore !!!');
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
        $delete_manufacturer = Manufacturer::withTrashed()->findOrFail($id);
        if ($delete_manufacturer->products->isEmpty()) {
            if ($delete_manufacturer->forceDelete()) {
                return redirect()->back()->with('status', 'Manufacturer successfully delete !!!');
            }
        } else {
            return redirect()->back()->with('status', 'This manufacturer has products present, first remove them !!!');
        }
    }
}
