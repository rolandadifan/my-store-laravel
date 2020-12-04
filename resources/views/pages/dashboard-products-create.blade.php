@extends('layouts.dashboard')
@section('title', 'Dashboard Product Create')
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Products</h2>
            <p class="dashboard-subtitle">Create Your Own Product</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                     <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="name"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Kategori</label>
                                <select name="categories_id" class="form-control">
                                    @foreach ($categories as $categories)
                                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="editor2" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Thumbnails</label>
                                <input type="file" name="photo" class="form-control" />
                                <p class="text-muted">
                                    Kamu dapat memilih lebih dari satu file
                                </p>
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
    CKEDITOR.replace('editor2');
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