@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>お気に入り</h1>

        <hr>

        <div class="row">
             @foreach ($favorites as $fav)
             <div class="col-md-7 mt-2">
                 <div class="d-inline-flex">
                     <a href="{{route('shops.show', $fav->favoriteable_id)}}" class="w-25">
                        @if (App\Models\Shop::find($fav->favoriteable_id)->image !== "")
                        <img src="{{ asset(App\Models\Shop::find($fav->favoriteable_id)->image) }}" class="img-fluid w-100">
                        @else
                        <img src="{{ asset('img/dummy.png') }}" class="img-fluid w-100">
                        @endif
                    </a>
                     <div class="container mt-3">
                         <h5 class="w-100 samuraimart-favorite-item-text">{{App\Models\Shop::find($fav->favoriteable_id)->name}}</h5>
                         <h6 class="w-100 samuraimart-favorite-item-text">&yen;{{App\Models\Shop::find($fav->favoriteable_id)->price}}</h6>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 d-flex align-items-center justify-content-end">
                 <a href="{{ route('shops.favorite', $fav->favoriteable_id) }}" class="samuraimart-favorite-item-delete">
                     削除
                 </a>
             </div>
             <div class="col-md-3 d-flex align-items-center justify-content-end">
               <a href="{{ route('shops.show', $fav->favoriteable_id) }}">
                <button>予約する</button>
               </a>
             </div>
             @auth
                    <div class="row">
                        <div class="offset-md-5 col-md-5">
                        <form method="post" action="{{ route('reservations.store') }}">
                            @csrf
                            <label for ="quantity" class="number">予約人数</label>
                            <div class="col-sm-10">
                                <input type="number" id="number" name="number" min="1" value="" class="form-control w-28">
                            </div>
                            <label for="date">予約日:</label> 
                            <input type="date" name="date" class="form-control m-2">
                            <input type="hidden" name="shop" value="{{$fav->id}}">
                            <button type="submit" class="btn nagoyameshi-submit-button ml-2">予約を追加</button>
                        </form>
                        </div>
                    </div>
                @endauth





             <div class="col-md-3 d-flex align-items-center justify-content-end">
               <a href="{{ route('reservations.index', $fav->favoriteable_id) }}">

                <button>テスト</button>
               </a>
             </div>
             @endforeach
         </div>

        <hr>
    </div>
</div>
@endsection
            
