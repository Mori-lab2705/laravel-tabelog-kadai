@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories]) 
        @endcomponent
    </div>

    <div class="col-9">
        <h1>おすすめ商品</h1>
        <div class="row">
            @foreach ($recommend_shops as $recommend_shop)
            <div class="col-4">
                <a href="{{ route('shops.show', $recommend_shop) }}">
                    @if ($recommend_shop->image !== "")
                    <img src="{{ asset($recommend_shop->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="samuraimart-shop-label mt-2">
                            {{ $recommend_shop->name }}<br>
                            <label>￥{{ $recommend_shop->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h1>新着商品</h1>
        <div class="row">
        @foreach ($recently_shops as $recently_shop)
            <div class="col-3">
                <a href="{{ route('shops.show', $recently_shop) }}">
                    @if ($recently_shop->image !== "")
                    <img src="{{ asset($recently_shop->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="samuraimart-shop-label mt-2">
                            {{ $recently_shop->name }}<br>
                            <label>￥{{ $recently_shop->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>                  
</div>
@endsection