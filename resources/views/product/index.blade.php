<x-app-layout>
        <x-slot name="title">Semua Produk</x-slot>
        <x-header.banner>
            <x-slot name="title">Selamat Datang di Toko Online Kami</x-slot>
            <x-slot name="description">Temukan produk anda disini</x-slot>
        </x-header.banner>
        @if (Auth::user()->phone == null || Auth::user()->address == null)
            <section class="mt-5 container d-flex align-items-center justify-content-center text-align-center bg-warning p-3">
                <i class="fas fa-info-circle"></i>
                Lengkapi data diri anda sebelum melakukan transaksi pembelian produk kami <a class="ms-1" href="{{route('profile.edit')}}">disini</a>
            </section>
        @endif
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($products as $product)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="{{asset('images/'.$product->image)}}" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{$product->name}} {{Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner') ? '('.$product->stock.')' : ''}}</h5>
                                        <!-- Product price-->
                                        Rp. {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                @if ($product->stock < 1 && Auth::user()->hasRole('buyer'))
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="{{route('product.show', $product->id)}}">Detail</a>
                                            <button class="btn btn-outline-dark mt-auto" disabled>Out of Stock</button>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->hasRole('buyer') && $product->stock > 0)
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product.show', $product->id)}}">Beli</a></div>
                                    </div>
                                @elseif (Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner'))
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="{{route('product.show', $product->id)}}">Detail</a>
                                            <a class="btn btn-outline-dark mt-auto" href="{{route('product.edit', $product->id)}}">Edit</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
</x-app-layout>
