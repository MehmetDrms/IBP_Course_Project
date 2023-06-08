<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CarBrand;
use App\Models\CarModel;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::where('isDeleted', 0)->get();
        $data['brands'] = CarBrand::where('isDeleted', 0)->get();
        $data['models'] = CarModel::where('isDeleted', 0)->get();
        return view('admin.category', $data);
    }

    public function addCategory(Request $request){
        $validation = $request->validate([
            'category' => 'required|unique:App\Models\Category,category'
        ]);
        Category::create(['category' => $request->category]);
        return redirect()->back()->with('category.add', 'Kategori başarıyla kaydedildi.');
    }

    public function deleteCategory(Request $request){
        $data = Category::where('id', $request->id)->first();
        $data->isDeleted = 1;
        $data->category = $data->category." |deleted";
        $data->save();
        return redirect()->back()->with('category.delete', 'Kategori başarıyla silindi.');
    }

    public function addBrand(Request $request){
        $validation = $request->validate([
            'brand' => 'required|unique:App\Models\CarBrand,brand'
        ]);
        CarBrand::create(['brand' => $request->brand]);
        return redirect()->back()->with('brand.add', 'Marka başarıyla eklendi.');
    }

    public function deleteBrand(Request $request){
        $data = CarBrand::where('id', $request->id)->first();
        $data->isDeleted = 1;
        $data->brand = $data->brand." |deleted";
        $data->save();
        foreach ($data->getModels as $model) {
            $modelData = CarModel::where('id', $model->id)->first();
            $modelData->isDeleted = 1;
            $modelData->model = $modelData->model." |deleted";
            $modelData->save();
        }
        return redirect()->back()->with('brand.delete', 'Marka başarıyla silindi.');
    }

    public function addModel(Request $request){
        $validation = $request->validate([
           'brand' => 'required',
           'model' => 'required',
           'start' => 'lte:end'
        ]);
        CarModel::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'start' => $request->start,
            'end' => $request->end,
        ]);
        return redirect()->back()->with('model.add', 'Model başarıyla kaydedildi.');
    }

    public function deleteModel(Request $request){
        $data = CarModel::where('id',$request->id)->first();
        $data->isDeleted = 1;
        $data->model = $data->model." |deleted";
        $data->save();
        return redirect()->back()->with('model.delete', 'Model başarıyla silindi.');
    }
}
