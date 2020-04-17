<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $data = [
            'products' => $products,
            'menu_item' => 'products'
        ];
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $data = [
            'menu_item' => 'products',
            'categories' => $categories,
        ];
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $filenameWithExt = $request->image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->image->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $request->image->storeAs('public/images', $fileNameToStore);

        $message = 'Product created!';
        $status = 'success';

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $fileNameToStore
        ]);

        if (!$product) {
            $message = 'Product not created!';
            $status = 'danger';
        }

        return redirect()->route('product.index')->with([
            'alert-'.$status => $message
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', [ 'product' => $product ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        $data = [
            'menu_item' => 'product',
            'product' => $product,
            'categories' => $categories,
        ];

        return view('products.update', $data);
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
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $product = Product::findOrFail($id);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];

        if ($request->has('image') && $request->image) {
            $filenameWithExt = $request->image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->image->storeAs('public/images', $fileNameToStore);
            Storage::disk('public')->delete('images/'.$product->image);
            $updateData['image'] = $fileNameToStore;
        }

        $message = 'Product updated!';
        $status = 'success';

        $updated = $product->update($updateData);

        if (!$updated) {
            $message = 'Product not created!';
            $status = 'danger';
        }

        return redirect()->route('product.index')->with([
            'alert-'.$status => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = 'Product deleted!';
        $status = 'success';

        $product = Product::findOrFail($id);
        Storage::disk('public')->delete('images/'.$product->image);

        if (!$product->delete()) {
            $message = 'Product not deleted!';
            $status = 'danger';
        }

        return back()->with([
            'alert-'.$status => $message
        ]);
    }
}
