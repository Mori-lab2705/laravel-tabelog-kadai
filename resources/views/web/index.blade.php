@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories]) 
        @endcomponent

        <link rel="stylesheet" href="nagoyameshi.css">
    </div>

    <div class="col-9">
            <h1>おすすめ商品</h1>
            <div class="row">
                @foreach ($recommend_shops as $recommend_shop)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <a href="{{ route('shops.show', $recommend_shop) }}">
                            @if ($recommend_shop->image !== "")
                            <img src="{{ asset($recommend_shop->image) }}" class="img-thumbnail">
                            @else
                            <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                            @endif
                        </a>
                        <div class="row">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recommend_shop->name }}</h5>
                                <p class="card-text">￥{{ $recommend_shop->price }}</p>
                                <a href="{{ route('shops.show', $recommend_shop) }}" class="btn btn-primary">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <h1>新着商品</h1>
            <div class="row">
                @foreach ($recently_shops as $recently_shop)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <a href="{{ route('shops.show', $recently_shop) }}">
                            @if ($recently_shop->image !== "")
                            <img src="{{ asset($recently_shop->image) }}" class="card-img-top img-fluid">
                            @else
                            <img src="{{ asset('img/dummy.png')}}" class="card-img-top img-fluid">
                            @endif
                        </a>
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title">{{ $recently_shop->name }}</h5>
                            <p class="card-text">￥{{ $recently_shop->price }}</p>
                            <a href="{{ route('shops.show', $recently_shop) }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>                  
</div>
@endsection