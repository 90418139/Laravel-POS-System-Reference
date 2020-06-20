{{-- 指定繼承 layous.app 母版模 --}}
@extends('layouts.app')

{{-- 傳送資料到母版模，並指定變數為 title --}}
@section('title', $title ?? '')

{{-- 傳送資料到母版模，並指定變數為 content --}}
@section('content')
    <div class="container-fluid">

        {{-- 錯誤訊息模板元件 @include('components.validationErrorMessage') --}}

        <div class="row" style="margin: 5px">
            <div class="col-8" id="table_menu">
                <nav>
                    <div class="nav nav-tabs menu_tab mb-4" id="nav-tab" role="tablist">
                        @if(isset($class))
                            @for($i=0;$i<count($class);$i++)
                                @if($class[$i]->status == 'S')
                                <a class="nav-item nav-link @if($i==0) active @endif" id="nav-{{$i}}-tab" data-toggle="tab" href="#nav-{{$i}}" role="tab" aria-controls="nav-{{$i}}" aria-selected="true">
                                    {{ $class[$i]->class }}
                                </a>
                                @endif
                            @endfor
                        @endif
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    @if(isset($class))
                        @for($i=0;$i<count($class);$i++)
                            @php $t = 0 @endphp
                            @foreach($merchandise as $item)
                                @if($class[$i]->class == $item->class)
                                    @php $t+=1 @endphp
                                @endif
                            @endforeach
                            @for($j=2;$j>0;$j--)
                                @if($t % $j == 0)
                                    @break
                                @endif
                            @endfor
                            <div class="tab-pane fade @if($i==0) show active @endif" id="nav-{{$i}}" role="tabpanel" aria-labelledby="nav-{{$i}}-tab">
                                <table class="myTable" style="width: 100%;">
                                    <thead class="hide">
                                    <tr>
                                        @for($k=0;$k<$j;$k++)
                                            <td></td>
                                        @endfor
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $a = 0 @endphp
                                        @foreach($merchandise as $item)
                                            @if($class[$i]->class == $item->class)
                                                @if($a % $j == 0) <tr> @endif
                                                <td style="height: 130px">
                                                    <a class="order_item" href="#">
                                                    <div class="single_menu">
                                                        <img src="{{ $item->photo ?? 'img/def.png' }}" alt="burger">
                                                        <div class="menu_content">
                                                            <h4>{{ $item->name }}<span>{{ $item->price }}</span></h4>
                                                            <p>{{ $item->introduction }}</p>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </td>
                                                @php $a += 1 @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>

            <div class="col-4">
                <span style="font-size: 1.5em">Serial number：</span>
                <span id="table_num" style="font-size: 2em">{{ session('SeriaNnumber') }}</span>
                <form method="post" action="/order" >
                    @csrf
                    @method('post')
                    <table class="table table-hover" style="border:1px #cccccc solid;overflow-y: scroll;height: 50vh;display: block;">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 180px">Item</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody id="right_table_body" onclick="item_delete(event)">

                        </tbody>
                    </table>
                    <span style="font-size: 3em">Total:</span>
                    <span id="total" style="font-size: 3em"></span>
                    <br />
                    <input name="item" value="a" id="input_item" hidden>
                    <input name="qty" value="a" id="input_qty" hidden>
                    <input name="price" value="a" id="input_price" hidden>
                    <input name="user" value="a" id="input_user" hidden>
                    <button class="btn btn-dark btn-lg btn-block" type="submit" id="send_item">Checkout</button>
                </form>

            </div>
        </div>

    </div>
    <div id="canvas" >
        <table border="1px">
            <thead>
                <tr>
                    <th colspan="3">
                        <div type="text" class="text" id="text"></div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="number">1</td>
                    <td class="number">2</td>
                    <td class="number">3</td>
                </tr>
                <tr>
                    <td class="number">4</td>
                    <td class="number">5</td>
                    <td class="number">6</td>
                </tr>
                <tr>
                    <td class="number">7</td>
                    <td class="number">8</td>
                    <td class="number">9</td>
                </tr>
                <tr>
                    <td class="number">0</td>
                    <td class="func" id="c">C</td>
                    <td class="func" id="ent">Ent</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
