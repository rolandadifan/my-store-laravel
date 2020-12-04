@extends('layouts.app')

@section('title')
category
@endsection


@section('content')
<div class="page-content pages-home">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
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
    </section>

    <section class="store-new-product">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
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
                            $Rp.{{$pd->price}}
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Product Found
                </div>
                @endforelse
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>
@endsection