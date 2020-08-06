<?php

namespace App\Http\Controllers;

use App\Item;
use App\Brand;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        // dd($items);
        return view('backend.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('backend.items.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request); print output
        $messages = [
            'codeno.required' => '* Please enter Item Code Number.',
            'name.required' => '* Please enter Item Name.',
            'photo.required' => '* Please choose Item Photo.',
            'price.required' => '* Please enter Item Price.',
            'brand_id.required' => '* Please choose Item Brand.',
            'subcategory_id.required' => '* Please choose Item Subcategory.',
            'photo.image' => 'Please choose image file type.',
            'discount.min' => 'Discount percentage should be greater than 0.',
            'discount.max' => 'Discount percentage should be less than 100.',
            'price.numeric' => 'Please enter number value for Price.',
            'price.min' => 'Item Price should be greater than 0.',
            'price.max' => 'Item Price should be greater than 1000000.',
            'brand_id.numeric' => '* Please choose Item Brand.',
            'subcategory_id.numeric' => '* Please choose Item Subcategory.'
        ];

        // validation
        $validatedData = $request->validate([
            'codeno' => 'required',
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required|min:0|max:1000000|numeric',
            'discount' => 'nullable|min:0|max:100|numeric',
            'brand_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric'
        ], $messages);

        // file upload
        $photoName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('backend_template/item_img/'), $photoName);
        $filePath = 'backend_template/item_img/'.$photoName;

        // store data
        $item = new Item;
        $item->codeno = $request->codeno;
        $item->name = $request->name;
        $item->photo = $filePath;
        $item->price = $request->price;
        $item->discount = ($request->discount) ? $request->discount : 0;
        $item->description = $request->description;
        $item->brand_id = $request->brand_id;
        $item->subcategory_id = $request->subcategory_id;

        $item->save();

        // redirect
        return redirect()->route('items.index')->withSuccessMessage('New Item is Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('backend.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        // dd($item);
        $brands = Brand::orderBy('name')->get();
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('backend.items.edit', compact('item', 'brands', 'categories'));
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
        // dd($request);

        $messages = [
            'codeno.required' => '* Please enter Item Code Number.',
            'name.required' => '* Please enter Item Name.',
            'price.required' => '* Please enter Item Price.',
            'brand_id.required' => '* Please choose Item Brand.',
            'subcategory_id.required' => '* Please choose Item Subcategory.',
            'photo.image' => 'Please choose image file type.',
            'discount.min' => 'Discount percentage should be greater than 0.',
            'discount.max' => 'Discount percentage should be less than 100.',
            'price.numeric' => 'Please enter number value for Price.',
            'price.min' => 'Item Price should be greater than 0.',
            'price.max' => 'Item Price should be greater than 1000000.',
            'brand_id.numeric' => '* Please choose Item Brand.',
            'subcategory_id.numeric' => '* Please choose Item Subcategory.'
        ];

        $validatedData = $request->validate([
            'codeno' => 'required',
            'name' => 'required',
            'photo' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required|min:0|max:1000000|numeric',
            'discount' => 'nullable|min:0|max:100|numeric',
            'brand_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric'
        ], $messages);

        // file upload
        $filePath = $request->old_photo;
        if ($request->hasfile('photo')) 
        {
            $photoName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('backend_template/item_img/'), $photoName);
            // remove photo
            $file = public_path($filePath);
            if (File::exists($file)) {
                File::delete($file);
            }
            $filePath = 'backend_template/item_img/'.$photoName;
        }

        // if upload new image, delete old image

        // store data
        $item = Item::find($id);
        $item->codeno = $request->codeno;
        $item->name = $request->name;
        $item->photo = $filePath;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->description = $request->description;
        $item->brand_id = $request->brand_id;
        $item->subcategory_id = $request->subcategory_id;

        $item->save();

        // redirect
        return redirect()->route('items.index')->withSuccessMessage($item->name. ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        // delete related file from storage
        $file = public_path($item->photo);
        // dd($file);
        if (File::exists($file)) {
            File::delete($file);
        }

        $item->delete();
        return redirect()->route('items.index')->withSuccessMessage($item->name. ' is Successfully Deleted.');
    }
}
