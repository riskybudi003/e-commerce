<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorys;


class CategoryController extends Controller
{
    public function DataCategory()
    {
        $category = Categorys::all();
        return view('Dashboard.category.index', compact('category'));
    }

    public function CreateCat()
    {
        return view('Dashboard.category.create');
    }

    public function PostCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug_category' => 'required'
        ]);

        $category = Categorys::create($request->all());

        if ($category->save()) {
            return redirect()->route('Data_Category')->with('success', 'Data Saved Successfuly');
        } else {
            return redirect()->back()->with('Failed', 'Data Failed to save, check the input data again');
        }
    }

    public function EditCat($id)
    {
        $dec = decrypt($id);
        $category = Categorys::findOrFail($dec);

        return view('Dashboard.category.edit', compact('category'));
    }

    public function UpdateCat(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug_category' => 'required'
        ]);

        $dec = decrypt($id);
        $category = Categorys::findOrFail($dec);
        $category->name = $request->name;
        $category->slug_category = $request->slug_category;

        if ($category->save()) {
            return redirect()->route('Data_Category')->with('success', 'Data Update Successfuly');
        } else {
            return redirect()->back()->with('Failed', 'Data Failed to Update, check the input data again');
        }
    }

    public function deleteCat($id)
    {
        $dec = decrypt($id);
        $category = Categorys::findOrFail($dec);
        $category->delete();

        if ($category->delete()) {
            return redirect()->route('Data_Category')->with('success', 'Data Delete Successfuly');
        } else {
            return redirect()->back()->with('Failed', 'Data Failed to Delete, check the input data again');
        }
    }
}
