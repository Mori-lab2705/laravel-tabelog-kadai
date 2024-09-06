@extends('layouts.app')

@section('content')            
    <div class="container d-flex justify-content-center mt-3">
        <div class="w-100">
            <h1>予約一覧</h1>
            <hr>
            <div class="row">
                @foreach ($reservations as $reservation)
                <div class="col-md-7 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('reservations.store') }}">
                                <h4>予約人数：{{$reservation->number}}人</h4>
                                <h4>予約日時：{{$reservation->date}}</h4>
                                <h4>店舗名：{{ $reservation->shop ? $reservation->shop->name : '店舗が見つかりません' }}</h4>
                                <img src="{{ asset($reservation->shop ? $reservation->shop->image : '画像が見つかりません') }}" class="img-fluid" alt="Shop Image">
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-danger mt-2">予約のキャンセル</a>
                            </form> 
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
            <hr>
        </div>
    </div>
@endsection
