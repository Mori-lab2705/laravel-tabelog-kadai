@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>お気に入り</h1>

        <div class="row">
            @foreach ($favorites as $fav)
                
            
            <div class="col-md-7 mt-2">
                    <div class="card mb-3"> <!-- カード間のスペーシング -->
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <a href="{{route('shops.show', $fav->favoriteable_id)}}">
                                    @if (optional(App\Models\Shop::find($fav->favoriteable_id))->image)
                                        <img src="{{ asset(App\Models\Shop::find($fav->favoriteable_id)->image) }}" class="card-img">
                                    @else
                                        <img src="{{ asset('img/dummy.png') }}" class="card-img">
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{optional(App\Models\Shop::find($fav->favoriteable_id))->name}}</h5>
                                    <p class="card-text">{{optional(App\Models\Shop::find($fav->favoriteable_id))->price}}</p>
                                    <a href="{{ route('shops.favorite', $fav->favoriteable_id) }}" class="btn btn-danger">削除</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    <div class="col-md-5 mt-2">
                        <form method="post" action="{{ route('reservations.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="number">予約人数</label>
                                <input type="number" id="number" name="number" min="1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="date">予約日</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <input type="hidden" name="shop" value="{{$fav->id}}">
                            <button type="submit" class="btn btn-primary">予約を追加</button>
                        </form>
                    </div>
                @endauth

                <div class="col-12">
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
