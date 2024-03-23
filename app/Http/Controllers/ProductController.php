<?php

namespace App\Http\Controllers;

use App\Models\Categorys;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Variasi_Ukurans;
use App\Models\Variasi_Warnas;

class ProductController extends Controller
{
    public function DataProducts()
    {
        $products = Products::all();

        return view('Dashboard.product.Data_product', compact('products'));
    }

    public function CreateProduct()
    {
        $category = Categorys::all();
        return view('Dashboard.product.create', compact('category'));
    }

    public function postProduct(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'id_category' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:5000',

        ]);

        $product = new Products();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;
        $product->id_category = $request->id_category;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destination = public_path() . '/assets/images/product/';

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $fileName);
            $product->image = $fileName;
        }

        if ($product->save()) {
            if ($request->has('color')) {
                $variasi_color = $request->color;

                foreach ($variasi_color as $color) {
                    $var_color = new Variasi_Warnas();
                    $var_color->name = $color['name'];
                    $var_color->id_product = $product->id;
                    $var_color->save();
                }
            }

            if ($request->has('size')) {
                $variasi_size = $request->size;

                foreach ($variasi_size as $size) {
                    $var_size = new Variasi_Ukurans();
                    $var_size->ukuran = $size['ukuran'];
                    $var_size->id_product = $product->id;
                    $var_size->save();
                }
            }

            return redirect()->route('products')->with('success', 'Product saved Successfuly');
        } else {
            return redirect()->back()->with('error', 'product data failed to save');
        }
    }

    public function EditProduct($id)
    {
        $dec = decrypt($id);
        $product = Products::findOrFail($dec);
        $var_color = Variasi_Warnas::where('id_product', $product->id)->get();
        $var_size = Variasi_Ukurans::where('id_product', $product->id)->get();
        $category = Categorys::all();

        return view('Dashboard.product.edit', compact('product', 'var_color', 'var_size', 'category'));
    }

    public function UpdateProduct(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'id_category' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5000',

        ]);

        $dec = decrypt($id);
        $product = Products::findOrFail($dec);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;
        $product->id_category = $request->id_category;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destination = public_path() . '/assets/images/product/';

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $fileName);
            $product->image = $fileName;
        }

        if ($product->save()) {
            if ($request->has('color')) {
                $variasi_color = $request->color;


                foreach ($variasi_color as $color) {


                    if (array_key_exists('id', $color)) {
                        $var_color = Variasi_Warnas::where('id', $color['id'])->first();

                        if ($color['name'] === 'deleted') {
                            $var_color->delete();
                        } else {

                            $var_color->name = $color['name'];
                            $var_color->id_product = $product->id;
                            $var_color->save();
                        }
                    } else {
                        $var_color = new Variasi_Warnas();
                        $var_color->name = $color['name'];
                        $var_color->id_product = $product->id;
                        $var_color->save();
                    }
                }
            }

            if ($request->has('size')) {
                $variasi_size = $request->size;

                foreach ($variasi_size as $size) {

                    if (array_key_exists('id', $size)) {
                        $var_size = Variasi_Ukurans::where('id', $size['id'])->first();

                        if ($size['ukuran'] === 'deleted') {
                            $var_size->delete();
                        } else {
                            $var_size->ukuran = $size['ukuran'];
                            $var_size->id_product = $product->id;
                            $var_size->save();
                        }
                    } else {

                        $var_size = new Variasi_Ukurans();
                        $var_size->ukuran = $size['ukuran'];
                        $var_size->id_product = $product->id;
                        $var_size->save();
                    }
                }
            }

            return redirect()->route('products')->with('success', 'Product Update Successfuly');
        } else {
            return redirect()->back()->with('error', 'product data failed to Update');
        }
    }


    public function deleteProduct($id)
    {

        $dec = decrypt($id);
        $product = Products::findOrFail($dec);
        $product->delete();

        return redirect()->back()->with('Success', 'Data has been successfuly to delete');
    }
}
