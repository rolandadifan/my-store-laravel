@extends('layouts.app')

@section('title')
MyStore
@endsection


@section('content')
<div class="page-content pages-home">
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCrousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#storeCrousel" data-slide-to="0" class="active"></li>
                            <li data-target="#storeCrousel" data-slide-to="1"></li>
                            <li data-target="#storeCrousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/banner.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/images/banner.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/images/banner.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Trend Categories</h5>
                </div>
            </div>
            <div class="row mt-4">
                @php $incrementCategory = 0 @endphp
                @forelse($categories as $ctg)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{$incrementCategory += 100}}">
                    <a href="{{route('category-detail', $ctg->slug)}}" class="component-categories d-block">
                        <div class="categories-image">
                            <img src="{{Storage::url($ctg->photo)}}" class="w-100" alt="">
                        </div>
                        <p class="categories-text">{{$ctg->name}}</p>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Categories Found
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="store-new-product">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>New Products</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0 @endphp
                @forelse($products as $pd)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{$incrementCategory += 100}}">
                    <a href="{{route('detail', $pd->slug)}}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-gambar" style="
                                        @if($pd->galleries->count())
                                            background-image: url('{{ Storage::url($pd->galleries->first()->photos) }}');
                                        @else
                                            background-color: #eee;
                                        @endif
                                    ">
                            </div>
                        </div>
                        <div class="products-text">
                            {{$pd->name}}
                        </div>
                        <div class="products-price">
                            Rp.{{$pd->price}}
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Product Found
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection