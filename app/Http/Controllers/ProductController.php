<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\CarModel;

use Illuminate\Support\Facades\Storage;
use function PHPUnit\TestFixture\func;

class ProductController extends Controller
{
    public function adminIndex(Request $request)
    {
        $data['products'] = Product::where('isDeleted', 0)->orderBy('created_at', 'DESC')->paginate(15);

        $data['categories'] = Category::where('isDeleted',0)->get();
        $data['models'] = CarModel::where('isDeleted',0)->get();
        $data['query_cat'] = $request->query('categories');
        $data['query_mod'] = $request->query('models');
        $data['query_search'] = $request->query('search');
        if($request->query->count()>0){
            if($request->query('categories')){
                $data['products'] = $data['products']->filter(function ($item){
                    global $request;
                    return in_array($item->category, $request->query('categories'));
                });
            }
            if($request->query('models')){
                $data['products'] = $data['products']->filter(function ($item){
                    return $item->getModel->filter(function($item){
                        global $request;
                        return in_array($item->model_id, $request->query('models'));
                    })->count() > 0;
                });
            }
            if($request->query('search')){
                $data['products'] = $data['products']->filter(function ($item) {
                    global $request;
                    if (strstr($item->title, $request->query('search')) != false || strstr($item->description, $request->query('search')) != false)
                        return $item;
                });
            }

        }
        foreach ($data['products'] as $product) {
            $product->picture1 = Str::after($product->picture1, 'public/');
        }
        return view('admin.product', $data);
    }

    public function addProduct(Request $request){
        if($request->category == 'Seçiniz')
            return redirect()->back()->with('addProduct.categoryError', 'Lütfen kategori seçin!');
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'pictures' => 'required|array|between:1,3',
            'pictures.*' => 'image',
            'category'=>'required',
        ]);
        $paths = [];
        foreach ($request->file('pictures') as $picture) {
            $paths[] = Storage::putFile('public/product-pics',$picture);
        }
        $product = Product::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'picture1'=>$paths[0],
            'picture2'=> $paths[1] ?? "",
            'picture3'=> $paths[2] ?? "",
            'category'=>$request->category,
        ]);
        if(isset($request->models)) {
            $models = $request->input('models');
            foreach ($models as $model) {
                ProductModel::create([
                    'model_id' => $model,
                    'product_id' => $product->id
                ]);
            }
        }
        return redirect()->back()->with('addProduct.success', "Ürün kaydı başarıyla gerçekleşti.");
    }
}
