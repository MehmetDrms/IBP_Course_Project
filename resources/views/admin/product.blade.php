@extends('admin.layouts.master')
@section('title', 'Ürünler')
@section('content')
        <div class="card">
            <div class="card-body">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Yeni Ürün
                    </button>
                    <!-- Modal -->
                    <form action="{{route('admin.product.add')}}" enctype="multipart/form-data" id="modalForm" method="post">
                        @csrf
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Bilgileri doldurun.</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 form-floating">
                                        <input type="text" id="title" name="title" class="form-control">
                                        <label for="title">Başlık:</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <textarea id="description" name="description" class="form-control"></textarea>
                                        <label for="description">Açıklama:</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Resimler: (1-3 adet arası)</label>
                                        <input class="form-control" type="file" name="pictures[]" id="formFileMultiple" multiple>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Kategori:</label>
                                        <select id="category" name="category" class="form-select">
                                            <option>Seçiniz</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="models" class="form-label">Uyumlu Modeller:</label>
                                        <ul class="list-group overflow-auto" style="max-height: 250px;" id="models">
                                            @foreach($models as $model)
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" name="models[]" value="{{$model->id}}" id="{{$model->id}}">
                                                    <label class="form-check-label stretched-link" for="{{$model->id}}">
                                                        {{$model->getBrand->brand." ".$model->model." ".$model->start."-".$model->end}}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetModal()">Vazgeç</button>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                @if(Session::has('addProduct.categoryError'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('addProduct.categoryError')}}
                    </div>
                @endif
                @if(Session::has('addProduct.success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('addProduct.success')}}
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <span class="text-danger">{{$error}}</span>
                    @endforeach
                @endif
                <h3>Filtre:</h3>
                <div class="card">
                <div class="card-body">
                <form action="#" method="get">
                    <div class="row">
                        <div class="dropdown d-grid gap-2 col-md-6 mb-3">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori:
                            </button>
                            <ul class="dropdown-menu p-3" style="width: 96%">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#" class="dropdown-item" data-value="{{$category->id}}" tabIndex="-1">
                                            <div class="form-check">
                                                <input class="form-check-input" name="categories[]" type="checkbox" {{$query_cat != NULL && in_array($category->id, $query_cat) ? 'checked' : ''}} value="{{$category->id}}" id="{{$category->id}}">
                                                <label class="form-check-label" for="{{$category->id}}">
                                                    {{$category->category}}
                                                </label>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown d-grid gap-2 col-md-6 mb-3">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Model:
                            </button>
                            <ul class="dropdown-menu p-3" style="width: 96%">
                                @foreach($models as $model)
                                    <li>
                                        <a href="#" class="dropdown-item" data-value="{{$model->id}}" tabIndex="-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="models[]" {{$query_mod != NULL && in_array($model->id, $query_mod) ? 'checked' : ''}} value="{{$model->id}}" id="{{$model->id}}">
                                                <label class="form-check-label" for="{{$model->id}}">
                                                    {{$model->getBrand->brand." ".$model->model." ".$model->start."-".$model->end}}
                                                </label>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="search-bar" class="form-label">Arama metni:</label>
                        <input type="text" id="search-bar" value="{{$query_search != NULL ? $query_search : ''}}" name="search" class="form-control">
                    </div>
                    @if($query_cat != NULL || $query_mod != NULL || $query_search != NULL)
                        <a href="{{route('admin.products')}}" class="link-info">Filtreyi Temizle</a>
                    @endif
                    <button type="submit" class="btn btn-primary float-end">Filtrele</button>
                </form>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-xl-3">
                    <div class="card overflow-hidden rounded-2">
                        <div class="position-relative">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="{{'#'.$product->id}}"><img src="{{asset('storage/'.$product->picture1)}}" class="card-img-top rounded-0" alt="..."></button>
                        </div>
                        <div class="card-body pt-3 p-4">
                            <h6 class="fw-semibold fs-4">{{$product->title}}</h6>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$product->title}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img class="img-fluid" src="{{asset('storage/'.$product->picture1)}}">
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
