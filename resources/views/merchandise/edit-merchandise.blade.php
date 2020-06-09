{{-- 指定繼承 layous.app 母版模 --}}
@extends('layouts.app')

{{-- 傳送資料到母版模，並指定變數為 title --}}
@section('title', $title ?? '')

{{-- 傳送資料到母版模，並指定變數為 content --}}
@section('content')
    <div class="container">
        <h1>{{ $title ?? '' }}</h1>

        {{-- 錯誤訊息模板元件 @include('components.validationErrorMessage') --}}


        <form action="/merchandise/{{ $Merchandise->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label>
                商品狀態：
                <select name="status">
                    <option value="C" @if (old('status', $Merchandise->status) == 'C') selected @endif>建立中</option>
                    <option value="S" @if (old('status', $Merchandise->status) == 'S') selected @endif>可販售</option>
                </select>
            </label>
            <label>
                商品類別：
                <input type="text" name="class" placeholder="商品類別" value="{{ old('class', $Merchandise->class) }}">
            </label>
            <label>
                商品名稱：
                <input type="text" name="name" placeholder="商品名稱" value="{{ old('name', $Merchandise->name) }}">
            </label>
            <label>
                商品介紹：
                <input type="text" name="introduction" placeholder="商品介紹" value="{{ old('introduction', $Merchandise->introduction) }}">
            </label>
            <label>
                商品照片：
                <input type="file" name="photo" placeholder="商品照片">
                <img src="{{ $Merchandise->photo ?? '/img/def.png' }}" />
            </label>
            <label>
                商品價格：
                <input type="text" name="price" placeholder="商品價格" value="{{ old('price', $Merchandise->price) }}">
            </label>


            <button type="submit" class="btn btn-dark">更新商品資訊</button>
        </form>
    </div>
@endsection
