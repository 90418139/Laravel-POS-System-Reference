{{-- 指定繼承 layous.app 母版模 --}}
@extends('layouts.app')

{{-- 傳送資料到母版模，並指定變數為 title --}}
@section('title', $title ?? '')

{{-- 傳送資料到母版模，並指定變數為 content --}}
@section('content')
    <div class="container">
        <h1>{{ $title ?? '' }}</h1>

    {{-- 錯誤訊息模板元件 --}}


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Num</th>
                <th>Category</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Price</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($MerchandisePaginate as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->class }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ $Merchandise->photo ?? '/img/def.png' }}" /></td>
                    <td>
                        @if($item->status == 'C')
                            Create
                        @else
                            Sell
                        @endif
                    </td>
                    <td>{{ $item->price }}</td>
                    <td><a href="/merchandise/{{ $item->id }}/edit">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $MerchandisePaginate->links() }}

    </div>
@endsection
