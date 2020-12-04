@extends('layouts.dashboard')
@section('title', 'Dashboard Setting')
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Store Settings</h2>
            <p class="dashboard-subtitle">Make store that profitable</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard-settings-redirect', 'dashboard-setting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama Toko</label>
                                            <input type="text" id="" name="store_name" value="{{ $user->store_name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kategori</label>
                                            <select name="categories_id" class="form-control">
                                                <option value="{{ $user->categories_id }}">tidak diganti</option>
                                                @foreach ($categories as $categories)
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Store</label>
                                            <p class="text-muted">
                                                Apakah anda juga ingin membuka toko?
                                            </p>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="store_status" value="1" {{ $user->store_status == 1 ? 'checked' : '' }} id="openStoreTrue" :value="true" />
                                                <label class="custom-control-label" for="openStoreTrue">Buka</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="store_status" value="0" {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }} id="openStoreFalse" :value="false" />
                                                <label makasih class="custom-control-label" for="openStoreFalse">Sementara Tutup</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
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