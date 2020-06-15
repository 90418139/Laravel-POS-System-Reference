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
            <div class="form-row">
                <div class="form-group col">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="C" @if (old('status', $Merchandise->status) == 'C') selected @endif>Create</option>
                        <option value="S" @if (old('status', $Merchandise->status) == 'S') selected @endif>Sell</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="category">Category</label>
                    <input class="form-control" type="text" name="class" placeholder="Category" value="{{ old('class', $Merchandise->class) }}" required>
                </div>
                <div class="form-group col">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Name" value="{{ old('name', $Merchandise->name) }}" required>
                </div>
                <div class="form-group col">
                    <label for="introduction">Introduction</label>
                    <input class="form-control" type="text" name="introduction" placeholder="Introduction" value="{{ old('introduction', $Merchandise->introduction) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="photo">Photo</label>
                    <input class="form-control-file" type="file" name="photo" placeholder="Photo">
                    <img src="{{ $Merchandise->photo ?? '/img/def.png' }}" />
                </div>
                <div class="form-group col">
                    <label for="price">Price</label>
                    <input class="form-control" type="text" name="price" placeholder="price" value="{{ old('price', $Merchandise->price) }}" required>
                </div>
            </div>


            <button type="submit" class="btn btn-dark btn-block">Submit</button>
        </form>
    </div>
@endsection
