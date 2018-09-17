<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurposeRequest;
use App\Purpose;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Purpose::orderBy('id', 'DESC')->paginate(5);
        if (view()->exists('admin.purpose-list')) {
            return view('admin.purpose-list', compact('purposes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (view()->exists('admin.purpose-add')) {
            return view('admin.purpose-add');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurposeRequest $request)
    {
        $inputs = $request->except('_token');
        $new_purpose = new Purpose();
        $new_purpose->fill($inputs);
        if ($new_purpose->save()) {
            return redirect()->route('purpose.index')->with('status', 'Purpose successfully added !!!');
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
        $updatable_purpose = Purpose::find($id);
        if (view()->exists('admin.purpose-edit')) {
            return view('admin.purpose-edit', compact('updatable_purpose'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurposeRequest $request, $id)
    {
        $inputs = $request->except(['_method', '_token']);
        $update_purpose = Purpose::find($id);
        $update_purpose->fill($inputs);
        if ($update_purpose->update()) {
            return redirect()->route('purpose.index')->with('status', 'Purpose successfully updated !!!');
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
        $purpose = Purpose::find($id);
        if ($purpose->products->isEmpty()) {
            if ($purpose->delete()) {
                return redirect()->route('purpose.index')->with('status', 'Purpose successfully send to trash !!!');
            }
        } else {
            return redirect()->route('purpose.index')->with('status', 'There are products that belong to this category, first send them to the trash !!!');
        }
    }


    /**
     * View all trash
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $trashed_purposes = Purpose::onlyTrashed()->paginate(5);
        if (view()->exists('admin.purpose-trash')) {
            return view('admin.purpose-trash', compact('trashed_purposes'));
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
        $restore_purpose = Purpose::withTrashed()->findOrFail($id);
        if ($restore_purpose->restore()) {
            return redirect()->back()->with('status', 'Purpose successfully restore !!!');
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
        $delete_purpose = Purpose::withTrashed()->findOrFail($id);
        if ($delete_purpose->products->isEmpty()) {
            if ($delete_purpose->forceDelete()) {
                return redirect()->back()->with('status', 'Purpose successfully delete !!!');
            }
        } else {
            return redirect()->back()->with('status', 'There are products that belong to this category, first remove them !!!');
        }
    }
}
