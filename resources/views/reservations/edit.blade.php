@extends('layouts.app')

@section('content')
    <h1>キャンセル内容</h1>
    <p>店名: {{ $reservation->shop->name }}</p>
    <p>予約日時: {{ $reservation->date }}</p>
    <p>人数: {{ $reservation->number }}</p>
    <h1 class="">
     <img src="{{ asset($reservation->shop->image) }}" alt="Shop Image">
    </h1>
    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当にキャンセルしますか？')">予約をキャンセル</button>
    </form>
    
    <!-- 他の予約詳細情報をここに追加 -->
@endsection