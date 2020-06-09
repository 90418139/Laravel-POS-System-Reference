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
                <th>商品名稱</th>
                <th>圖片</th>
                <th>單價</th>
                <th>數量</th>
                <th>總金額</th>
                <th>購買時間</th>
            </tr>
            @foreach($TransactionPaginate as #item)
                <tr>
                    <td>
                        <a href="/merchandise/{{ $item->Merchandise->id }}">
                            {{ $item->Merchandise->name }}
                        </a>
                    </td>
                    <td>
                        <a href="/merchandise/{{ $item->Merchandise->id }}">
                            <img src="{{ $item->Merchandise->photo ?? '/img/def.png' }}" />
                        </a>
                    </td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->buy_count }}</td>
                    <td>{{ $item->total_price }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </table>

        {{-- 分頁頁數按鈕 --}}
        {{ $TransactionPaginate->links() }}
    </div>
@endsection
