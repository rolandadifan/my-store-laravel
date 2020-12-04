@extends('layouts.app')

@section('title')
Cart
@endsection


@section('content')
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-cart">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-12 table-responsive">
                    <table class="table table-borderless table-cart">
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Name &amp; Seller</td>
                                <td>Price</td>
                                <td>Menu</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPrice = 0 @endphp
                            @foreach($items as $itm)
                            <tr>
                                <td style="width: 20%;">
                                    @if($itm->product->galleries)
                                    <img src="{{Storage::url($itm->product->galleries->first()->photos)}}" class="cart-image " alt="">
                                    @endif
                                </td>
                                <td style="width: 35%;">
                                    <div class="product-tittle">{{$itm->product->name}}</div>
                                    <div class="product-subtittle">By {{$itm->product->user->store_name}}</div>
                                </td>
                                <td style="width: 35%;">
                                    <div class="product-tittle">Rp.{{number_format($itm->product->price)}}</div>
                                    <div class="product-subtittle">USD</div>
                                </td>
                                <td style="width: 20%;">
                                    <form action="{{ route('cart-delete', $itm->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-remove-cart">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @php $totalPrice += $itm->product->price @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <h2 class="mb-4">Shipping Details</h2>
                </div>
            </div>
            <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="addressOne">Address 1</label>
                        <input type="text" class="form-control" name="address_one" id="addressOne" class="addressOne" value="Jl. Jakarta barat">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="addressTwo">Address 2</label>
                        <input type="text" class="form-control" name="address_two" id="addressTwo" class="addressTwo" value="Jl. Jakarta timur">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="province">Province</label>
                        <select type="text" name="provinces_id" class="form-control" id="province" class="province" v-if="provinces" v-model="provinces_id">
                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                        </select>
                        <select v-else="" class="form-control" name="" id=""></select>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="regencies_id">City</label>
                  <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                    <option v-for="regency in regencies" :value="regencies.id">@{{regency.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="postalCode">Post Code</label>
                        <input type="text" class="form-control" name="zip_code" id="postalCode" class="postalCode" value="09981">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" id="country" class="country" value="Indonesia">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="mobile" class="mobile" value="+62 855515">
                    </div>
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <h2 class="mb-3">Payment Informations</h2>
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-4 col-md-2">
                    <div class="product-tittle">$10</div>
                    <div class="product-subtittle">Country Tax</div>
                </div>
                <div class="col-4 col-md-3">
                    <div class="product-tittle">$10</div>
                    <div class="product-subtittle">Product Insurance</div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="product-tittle">$10</div>
                    <div class="product-subtittle">Ship To Jakarta</div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="product-tittle text-success">${{ number_format($totalPrice ?? 0) }}</div>
                    <div class="product-subtittle">Total</div>
                </div>
                <div class="col-8 col-md-3">
                    <button type="submit" class="btn btn-success mt-4 px-4 btn-block">Checkout Now</button>
                </div>
            </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
            AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url('/api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });
    </script>
@endpush