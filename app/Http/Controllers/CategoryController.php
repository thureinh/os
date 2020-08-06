<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $messages = [
            'name.required' => '* Please enter Category Name.',
            'name.min' => 'Category Name should be 3 letters and more.',
            'photo.required' => '* Please choose Category Photo.',
            'photo.image' => 'Please choose image file type.'
        ];
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ], $messages);

        // file upload
        $photoName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('backend_template/category_img/'), $photoName);
        $filePath = 'backend_template/category_img/'.$photoName;

        $category = new Category;
        $category->name = $request->name;
        $category->photo = $filePath;

        $category->save();

        // redirect
        return redirect()->route('categories.index')->withSuccessMessage('New Category is Successfully Added.');
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
        $category = Category::find($id);
        return view('backend.categories.edit', compact('category'));
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
        // validation
        $messages = [
            'name.required' => '* Please enter Category Name.',
            'name.min' => 'Category Name should be 3 letters and more.',
            'photo.image' => 'Please choose image file type.'
        ];
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'photo' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg'
        ], $messages);

        // file upload
        $filePath = $request->old_photo;
        if ($request->hasfile('photo')) 
        {
            $photoName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('backend_template/category_img/'), $photoName);
            // remove photo
            $file = public_path($filePath);
            if (File::exists($file)) {
                File::delete($file);
            }
            $filePath = 'backend_template/category_img/'.$photoName;
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->photo = $filePath;
        $category->save();

        // redirect
        return redirect()->route('categories.index')->withSuccessMessage($category->name. ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // delete related file from storage
        $file = public_path($category->photo);
        // dd($file);
        if (File::exists($file)) {
            File::delete($file);
        }

        $category->delete();
        return redirect()->route('categories.index')->withSuccessMessage($category->name. ' is Successfully Deleted.');
    }
}
