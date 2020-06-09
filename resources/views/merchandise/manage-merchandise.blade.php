{{-- 指定繼承 layous.app 母版模 --}}
@extends('layouts.app')

{{-- 傳送資料到母版模，並指定變數為 title --}}
@section('title', $title ?? '')

{{-- 傳送資料到母版模，並指定變數為 content --}}
@section('content')
    <div class="container">
        <h1>{{ $title ?? '' }}</h1>

    {{-- 錯誤訊息模板元件 --}}


    <table class="table">
        <tr>
            <th>編號</th>
            <th>名稱</th>
            <th>圖片</th>
            <th>狀態</th>
            <th>價格</th>
            <th>剩餘數量</th>
            <th>編輯</th>
        </tr>
        @foreach($MerchandisePaginate as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><img src="{{ $Merchandise->photo ?? '/img/def.png' }}" /></td>
                <td>
                    @if($item->status == 'C')
                        建立中
                    @else
                        可販售
                    @endif
                </td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->reain_count }}</td>
                <td><a href="/merchandise/{{ $item->id }}/edit">編輯</a></td>
            </tr>
        @endforeach
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $MerchandisePaginate->links() }}

    </div>
@endsection
