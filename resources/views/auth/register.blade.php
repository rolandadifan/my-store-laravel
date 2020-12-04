@extends('layouts.auth')

@section('content')
<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center justify-content-center row-login mt-5">
                <div class="col-lg-4">
                    <h2>Memulai untuk jual beli, <br>dengan cara terbaru</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" v-model="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input v-model="email" @change="checkForEmailAvailability()" id="email" type="email" class="form-control @error('email') is-invalid @enderror" :class="{ 'is-invalid': this.email_unavailable }" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Password Confirm</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label>Store</label>
                            <p class="text-muted">
                                Apakah anda juga ingin membuka toko?
                            </p>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="is_store_open" id="openStoreTrue" v-model="is_store_open" :value="true" />
                                <label class="custom-control-label" for="openStoreTrue">Iya, boleh</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="is_store_open" id="openStoreFalse" v-model="is_store_open" :value="false" />
                                <label makasih class="custom-control-label" for="openStoreFalse">Enggak, makasih</label>
                            </div>
                        </div>
                        <div class="form-group" v-if="is_store_open">
                            <label for="">Nama Toko</label>
                            <input id="store_name" type="text" class="form-control @error('name') is-invalid @enderror" name="store_name" value="{{ old('store_name') }}" required autocomplete="store_name" v-model="store_name" autofocus>
                            @error('store_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" v-if="is_store_open">
                            <label for="">Kategori</label>
                            <select type="text" id="" class="form-control" name="categories_id">
                                <option value="" disabled>Select Category</option>
                                @foreach($categories as $ctg)
                                <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block  mt-4" :disabled="this.email.unavailable">
                            Sign Up Now
                        </button>
                        <a href="{{route('login')}}" class="btn btn-signup btn-block  mt-2">
                            Back To Sign In
                        </a>
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
    Vue.use(Toasted);
    var register = new Vue({
        el: "#register",
        mounted() {
            AOS.init();

        },
        methods: {
            checkForEmailAvailability: function() {
                var self = this;
                axios.get('{{ route('api-register-check') }}', {
                            params: {
                                email: this.email
                            }
                        })
                    .then(function(response) {
                        if (response.data == 'Available') {
                            self.$toasted.show(
                                "Email anda tersedia! Silahkan lanjut langkah selanjutnya!", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = false;
                        } else {
                            self.$toasted.error(
                                "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = true;
                        }
                        // handle success
                        console.log(response.data);
                    })
            }
        },
        data() {
            return {
                name: "rolanda",
                email: "rolanda@gans.id",
                is_store_open: true,
                store_name: "",
                email_unavailable: false
            }
        },
    });
</script>
<script>
    AOS.init();
</script>
@endpush