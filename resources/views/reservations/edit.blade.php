@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <h3>キャンセル内容</h3>
                <p>店舗名：{{ $reservation->shop ? $reservation->shop->name : '店舗が見つかりません' }}</p>
                <p>予約日時: {{ $reservation->date }}</p>
                <p>人数: {{ $reservation->number }}</p>
                <img src="{{ asset($reservation->shop ? $reservation->shop->image : '画像が見つかりません') }}" alt="Shop Image" class="img-fluid">
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('本当にキャンセルしますか？')">予約をキャンセル</button>
                </form>
            </div>
        </div>
    </div>
@endsection
