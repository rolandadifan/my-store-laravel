@extends('layouts.dashboard')
@section('title', 'Dashboard Account')
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My Account</h2>
            <p class="dashboard-subtitle">Update Your Current Profile</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard-settings-redirect', 'dashboard-setting-account') }}" method="POST" enctype="multipart/form-data" id="locations">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Your Name</label>
                                            <input type="text" class="form-control" id="name" class="name" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input type="text" class="form-control" id="email" class="email" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Address 1</label>
                                            <input type="text" class="form-control" id="addressOne" class="addressOne" name="address_one" value="{{ Auth::user()->address_one }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressTwo">Address 2</label>
                                            <input type="text" class="form-control" id="addressTwo" class="addressTwo" name="address_two" value="{{ Auth::user()->address_two }}">
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
                                            <input type="text" class="form-control" id="postalCode" class="postalCode" name="zip_coe" value="{{ Auth::user()->zip_code }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" class="country" name="country" value="{{ Auth::user()->country }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Phone Number</label>
                                            <input type="text" class="form-control" id="mobile" class="mobile" name="phone_number" value="{{ Auth::user()->phone_number }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
                                    </div>
                                </div>
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