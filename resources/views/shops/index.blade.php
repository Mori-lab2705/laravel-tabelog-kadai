@extends('layouts.app')
 
 @section('content')
 <div class="row">
      <div class="col-2">
         @component('components.sidebar', ['categories' => $categories,])
         @endcomponent
         <form action="{{ route('shops.index') }}" method="GET">
                <input type="text" name="search" placeholder="商品名を入力">
                <button type="submit">検索</button>
         </form>
      </div>
     <div class="col-9"> 
         <div class="container">
             @if ($category !== null)
                 <a href="{{ route('shops.index') }}">トップ</a> > <a href="#">{{ $category->major_category_name }}</a> > {{ $category->name }}
                 <h1>{{ $category->name }}の商品一覧{{$total_count}}件</h1> 
             @endif
         </div>
         
         <div class="container mt-4">
             <div class="row w-100">
                 @foreach($shops as $shop)
                 <div class="col-3">
                     <a href="{{route('shops.show', $shop)}}">
                        @if($shop->image !== "")
                        <img src="{{ asset($shop->image) }}" class="img-thumbnail">
                        @else
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                        @endif
                     </a>
                     <div class="row">
                         <div class="col-12">
                             <p class="nagoyameshi-shop-label mt-2">
                                 {{$shop->name}}<br>
                                 <label>￥{{$shop->price}}</label> 
                             </p>
                         </div>
                     </div>
                 </div>
                 @endforeach
             </div>
         </div>
         {{ $shops->appends(request()->query())->links() }}
     </div>
 </div>
 @endsection