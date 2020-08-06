<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
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
            'name.required' => '* Please enter Brand Name.',
            'name.min' => 'Brand Name should be 3 letters and more.',
            'photo.required' => '* Please choose Brand Photo.',
            'photo.image' => 'Please choose image file type.'
        ];
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ], $messages);

        // file upload
        $photoName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('backend_template/brand_img/'), $photoName);
        $filePath = 'backend_template/brand_img/'.$photoName;

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->photo = $filePath;

        $brand->save();

        // redirect
        return redirect()->route('brands.index')->withSuccessMessage('New Brand is Successfully Added.');

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
        $brand = Brand::find($id);
        return view('backend.brands.edit', compact('brand'));
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
            'name.required' => '* Please enter Brand Name.',
            'name.min' => 'Brand Name should be 3 letters and more.',
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
            $request->photo->move(public_path('backend_template/brand_img/'), $photoName);
            // remove photo
            $file = public_path($filePath);
            if (File::exists($file)) {
                File::delete($file);
            }
            $filePath = 'backend_template/brand_img/'.$photoName;
        }

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->photo = $filePath;
        $brand->save();

        // redirect
        return redirect()->route('brands.index')->withSuccessMessage($brand->name. ' is Successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        // delete related file from storage
        $file = public_path($brand->photo);
        // dd($file);
        if (File::exists($file)) {
            File::delete($file);
        }

        $brand->delete();
        return redirect()->route('brands.index')->withSuccessMessage($brand->name. ' is Successfully Deleted.');
    }
}
