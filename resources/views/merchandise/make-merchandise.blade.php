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
                        <div class="col-3 princing-item text-center @if($table->user_id % 2 == 0) red @else green @endif">
                            <div class="pricing-divider ">
                                <h3 class="text-light" style="padding-left: 10px">
                                    {{ $table->user_id }}
                                </h3>
                                <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
                        <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
                            c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
                                    <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
                            c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
                                    <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
                            H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                                    <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
                            c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
                    </svg>
                            </div>
                            <form action="/ordered" method="post">
                                @csrf
                                @method('post')
                                <div class="card-body bg-white mt-0 shadow">
                                    <ul class="list-unstyled mb-5 position-relative">
                                        @foreach($MakeList as $make)
                                            @if($make->user_id == $table->user_id and $make->complete == 'N')
                                                <li>
                                                    <b>{{ $make->merchandise_id }}</b>
                                                    {{ $make->buy_count }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <input name="id" value="
                                    @foreach($MakeList as $make)
                                        @if($make->user_id == $table->user_id and $make->complete == 'N')
                                            {{ $make->id }},
                                        @endif
                                    @endforeach
                                        " hidden>
                                    <input class="btn btn-lg btn-block btn-custom" type="submit" value="finish">
                                </div>
                            </form>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection
