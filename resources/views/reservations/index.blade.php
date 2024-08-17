@extends('layouts.app')

@section('content')            
            <div class="row">
              <form method="GET" action="{{ route('reservations.store') }}">
                @foreach ($reservations as $reservation)
                    <div class="d-inline-flex">
                        <div class="container mt-3">
                            <h5 class="w-100 nagoyameshi-favorite-items-text">{{App\Models\Reservation::find($reservation->shop_id)->name}}</h5>
                        </div>
                    </div>    
                 @endforeach   
                </form>
            </div>

    <div class="container d-flex justify-content-center mt-3">
        <div class="w-75">
            <h1>予約一覧</h1>

            <hr>

            <div class="row">
                <form method="GET" action="{{ route('reservations.store') }}">
                    
                    @foreach ($reservations as $reservation)
                    <div class="col-md-7 mt-2">
                        <div class="d-inline-flex">
                            <div class="container mt-3">
                                <h1 class="">
                                   <p> 予約人数：{{$reservation->number}}人</p>
                                </h1>
                                <h1 class="">
                                   <p> 予約日時：{{$reservation->date}}</p>
                                </h1>
                                <h1 class="">
                                    <p>店舗名：{{$reservation->shop->name}}</p>
                                </h1>
                                <h1 class="">
                                    <img src="{{ asset($reservation->shop->image) }}" alt="Shop Image">
                                </h1>
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </form>
            </div>

            <hr>
        </div>
    </div>

    
    <!DOCTYPE html>
        <html>
        <head>
        <title>Reservations</title>
        </head>
        <body>
        <h1>{{ $user->name }}'s Reservations</h1>
        <ul>
            @foreach ($reservations as $reservation)
                <li>{{ $reservation->reservation_date }}: {{ $reservation->details }}</li>
            @endforeach
        </ul>
        </body>
        </html>
@endsection



