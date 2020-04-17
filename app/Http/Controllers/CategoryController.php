<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $data = [
            'categories' => $categories,
            'menu_item' => 'categories'
        ];
        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'menu_item' => 'categories'
        ];
        return view('categories.create', $data);
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
        ]);

        $message = 'Category created!';
        $status = 'success';

        $category = Category::create([
            'title' => $request->title,
        ]);

        if (!$category) {
            $message = 'Category not created!';
            $status = 'danger';
        }

        return redirect()->route('category.index')->with([
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
        $category = Category::findOrFail($id);
        return view('categories.show', [ 'category' => $category ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $data = [
            'menu_item' => 'categories',
            'category' => $category,
        ];

        return view('categories.update', $data);
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
        ]);

        $message = 'Category updated!';
        $status = 'success';

        $category = Category::findOrFail($id);

        $updated = $category->update([
            'title' => $request->title,
        ]);

        if (!$updated) {
            $message = 'Category not created!';
            $status = 'danger';
        }

        return redirect()->route('category.index')->with([
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
        $message = 'Category deleted!';
        $status = 'success';

        if (!Category::destroy($id)) {
            $message = 'Category not deleted!';
            $status = 'danger';
        }

        return back()->with([
            'alert-'.$status => $message
        ]);
    }
}
