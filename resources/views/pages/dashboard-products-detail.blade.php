@extends('layouts.dashboard')
@section('title', 'Dashboard Product Detail')
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Shrirup Marzan</h2>
            <p class="dashboard-subtitle">Products Details</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Kategori</label>
                                <select name="categories_id" class="form-control">
                                                <option value="{{$product->categories_id}}" selected>{{$product->category->name}}</option>
                                                @foreach($categories as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="editor4" class="form-control">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col text-right">
                                <button
                                type="submit"
                                class="btn btn-success px-5"
                                >
                                Save Now
                                </button>
                            </div>
                        </div>
                        </div>
          </form>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($product->galleries as $gallery)
                            <div class="col-md-4">
                                <div class="gallery-container">
                                    <img src="{{ Storage::url($gallery->photos ?? '') }}" alt="" class="w-100 mb-2">
                                    <form action="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete-gallery"><img src="/images/icon-delete.svg" alt=""></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="col-12">
                                <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="products_id">
                                    <input type="file" name="photos" id="file" style="display: none;" onchange="form.submit()">
                                    <button type="button" class="btn btn-secondary btn-block mt-2" onclick="thisFileUpload()">Add Photo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
</script>
<script>
    CKEDITOR.replace('editor4');
</script>
<script>
    AOS.init();
</script>
<script>
    $('#menu-toggle').click(function(e) {
        e.preventDefault();
        $('#wrapper').toggleClass('toggled');
    });
</script>
@endpush