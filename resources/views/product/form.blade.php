<x-app-layout>
    <x-slot name="title">{{$metapage['title']}}</x-slot>
    <x-header.banner>
        <x-slot name="title">{{$metapage['title']}}</x-slot>
        <x-slot name="description">{{$metapage['description']}}</x-slot>
    </x-header.banner>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        {{$metapage['title']}}
                    </div>
                    <div class="card-body">
                        <form action="{{ $metapage['route'] }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($metapage['method'])
                            @if ($product->image ?? '')
                                <img src="{{ '/images/'.$product->image ?? ''}}" alt="" width="30%">
                            @endif
                            <div class="form-group">
                                <label for="image">Foto</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" value="{{old('name', $product->name ?? '')}}" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Harga</label>
                                        <input type="number" value="{{old('price', $product->price ?? '')}}" name="price" id="price" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stok</label>
                                        <input type="number" value="{{old('stock', $product->stock ?? '')}}" name="stock" id="stock" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" required>{{old('description', $product->description ?? '')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{$metapage['button']}}</button>
                        </form>
                            @if (Auth::user()->hasRole('admin') && $metapage['button'] == 'Edit')
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2">Hapus</button>
                                </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
