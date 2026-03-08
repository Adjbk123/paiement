<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\str;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Requests\categoryFormRequest;
use Illuminate\Support\facades\File;


class categorycontroller extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(categoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category ;
        $category->name = $validatedData['name'];
        $category->slug =str::slug ($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if($request->hasFile('image')){
            $file =$request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);

            $category->image =$uploadPath.$filename; 
        }
       

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status =$request->status == true ? '1' :'0';

        $category->save();

        return redirect('admin/category')->with('message' , 'category added successfully');

    }
    public function edit(category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(categoryFormRequest $request, $category )
    {
        $category = Category::findOrFail($category);

        $validatedData = $request->validated();


        $category->name = $validatedData['name'];
        $category->slug =str::slug ($validatedData['slug']);
        $category->description = $validatedData['description'];
       
        if($request->hasFile('image')){
            $uploadPath ='uploads/category/';
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                file::delete($path);
            }

            $file =$request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);

            $category->image = $uploadPath.$filename; 
        }
       

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status =$request->status == true ? '1' :'0';

        $category->update();

         return redirect('admin/category')->with('message' , 'category update successfully');

    }
}