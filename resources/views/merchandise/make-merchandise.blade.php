{{-- 指定繼承 layous.app 母版模 --}}
@extends('layouts.app')

{{-- 傳送資料到母版模，並指定變數為 title --}}
@section('title', $title ?? '')

{{-- 傳送資料到母版模，並指定變數為 content --}}
@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 10px">
            @if(isset($TableList))
                @foreach($TableList as $table)
                    @if($table->complete == 'N')
                    <div class="col-3">
                        <div class="card">
                            <h5 class="card-header">
                                {{ $table->user_id }}
                            </h5>
                            <div class="card-body">
                                <form action="/ordered" method="post">
                                    <table class="table table-hover">
                                        @csrf
                                        @method('post')
                                        <thead>
                                            <tr>
                                                <th scope="col">item</th>
                                                <th scope="col">qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($MakeList as $make)
                                            @if($make->user_id == $table->user_id and $make->complete == 'N')
                                                <tr>
                                                    <th scope="row">{{ $make->merchandise_id }}</th>
                                                    <td>{{ $make->buy_count }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <input name="id" value="
                                        @foreach($MakeList as $make)
                                            @if($make->user_id == $table->user_id and $make->complete == 'N')
                                                {{ $make->id }},
                                            @endif
                                        @endforeach
                                            " hidden>
                                        </tbody>
                                    </table>
                                    <input class="btn btn-dark btn-block" type="submit" value="finish">
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

@endsection
