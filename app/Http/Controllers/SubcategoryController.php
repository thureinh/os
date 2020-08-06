<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('backend.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('backend.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => '* Please enter Category Name.',
            'name.min' => 'Category Name should be 3 letters and more.',
            'category_id.required' => '* Please choose Item Category.',
            'category_id.numeric' => '* Please choose Item Category.'
        ];

        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required|numeric'
        ], $messages);

        $subcategory = new Subcategory;
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        $subcategory->save();

        // redirect
        return redirect()->route('subcategories.index')->withSuccessMessage('New Subcategory is Successfully Added.');
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
        $subcategory = Subcategory::find($id);
        $categories = Category::orderBy('name')->get();
        return view('backend.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => '* Please enter Category Name.',
            'name.min' => 'Category Name should be 3 letters and more.',
            'category_id.required' => '* Please choose Item Category.',
            'category_id.numeric' => '* Please choose Item Category.'
        ];

        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required|numeric'
        ], $messages);

        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        $subcategory->save();

        // redirect
        return redirect()->route('subcategories.index')->withSuccessMessage($subcategory->name.' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect()->route('subcategories.index')->withSuccessMessage($subcategory->name. ' is Successfully Deleted.');
    }
}
