@extends('app')

@section('content')
    <section>
        <div class="album bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm" >
                                <img src="https://fakeimg.pl/600x350" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product['name'] }}</h5>
                                    <p class="card-text">{{ strlen($product['description']) > 100 ? substr($product['description'], 0, 100) . '...' : $product['description'] }}</p>
                                    <a href="{{route('product_show', $product['id'])}}" class="btn btn-primary">Show</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
