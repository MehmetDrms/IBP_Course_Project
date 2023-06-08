@extends('admin.layouts.master')
@section('title', 'Kategoriler')
@section('content')
    @if($errors->any())
        <div class="container justify-content-center">
        @foreach($errors->all() as $error)
            <span class="text-danger">{{$error}}</span>
        @endforeach
        </div>
    @endif
<div class="card">
    <div class="card-header">Kategori:</div>
    <div class="card-body">
        @if(Session::has('category.add'))
            <span class="text-success">{{Session::get('category.add')}}</span>
        @endif
        <form action="{{route('admin.category.add')}}" method="post">
            @csrf
            <div class="mb-3 form-floating">
                <input type="text" id="category" name="category" class="form-control">
                <label for="category">Yeni kategori ismi girin...</label>
            </div>
            <button type="submit" class="btn btn-primary float-end">Ekle</button>
        </form>
    </div>
    <div class="card-body">
        @if(Session::has('category.delete'))
            <span class="text-success">{{Session::get('category.delete')}}</span>
        @endif
        <form action="{{route('admin.category.delete')}}" method="post">
            @csrf
            <div class="mb-3 form-floating">
                <select id="category" name="id" class="form-control">
                    <option></option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
                <label for="category">Silmek için seçin</label>
            </div>
            <button type="submit" class="btn btn-danger float-end">Sil</button>
        </form>
    </div>
</div>
    <div class="card">
        <div class="card-header">Marka:</div>
        <div class="card-body">
            @if(Session::has('brand.add'))
                <span class="text-success">{{Session::get('brand.add')}}</span>
            @endif
            <form action="{{route('admin.brand.add')}}" method="post">
                @csrf
                <div class="mb-3 form-floating">
                    <input type="text" id="brand" name="brand" class="form-control">
                    <label for="brand">Yeni marka ismi girin...</label>
                </div>
                <button type="submit" class="btn btn-primary float-end">Ekle</button>
            </form>
        </div>
        <div class="card-body">
            @if(Session::has('brand.delete'))
                <span class="text-success">{{Session::get('brand.delete')}}</span>
            @endif
            <form action="{{route('admin.brand.delete')}}" method="post">
                @csrf
                <div class="mb-3 form-floating">
                    <select  id="brand" name="id" class="form-control">
                        <option></option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand}}</option>
                        @endforeach
                    </select>
                    <label for="category">Silmek için seçin</label>
                </div>
                <button type="submit" class="btn btn-danger float-end">Sil</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Model:</div>
        <div class="card-body">
            @if(Session::has('model.add'))
                <span class="text-success">{{Session::get('model.add')}}</span>
            @endif
            <form action="{{route('admin.model.add')}}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <select id="brand" name="brand" class="form-control">
                        <option>Marka Seçin</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand}}</option>
                        @endforeach
                    </select>
                    <label for="brand">Marka</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="model" name="model" class="form-control">
                    <label for="brand">Model adı</label>
                </div>
                <div class="row">
                    <div class="col form-floating mb-3">
                        <select id="start" name="start" class="form-control">
                            <option>Tarih seçin</option>
                            @for($i = date('Y'); $i >= 1930; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <label for="start">Başlangıç</label>
                    </div>
                    <div class="col form-floating mb-3">
                        <select id="end" name="end" class="form-control">
                            <option>Tarih seçin</option>
                            @for($i = date('Y'); $i >= 1930; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <label for="end">Bitiş</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end">Ekle</button>
            </form>
        </div>
        <div class="card-body">
            @if(Session::has('model.delete'))
                <span class="text-success">{{Session::get('model.delete')}}</span>
            @endif
            <form action="{{route('admin.model.delete')}}" method="post">
                @csrf
                <div class="mb-3 form-floating">
                    <select  id="brand" name="id" class="form-control">
                        <option></option>
                        @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->getBrand->brand}} {{$model->model}} {{$model->start}}-{{$model->end}}</option>
                        @endforeach
                    </select>
                    <label for="category">Silmek için seçin</label>
                </div>
                <button type="submit" class="btn btn-danger float-end">Sil</button>
            </form>
        </div>
    </div>

@endsection
