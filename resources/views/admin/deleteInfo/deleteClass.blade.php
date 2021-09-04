@extends('layouts.main')

@section('title', 'Delete Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Information')

@section('content')
<section>
  <div class="content">
    <div>
      @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
      @endif
      @if(session()->has('message'))
        <h4 style="color: green">{{ session()->get('message') }}</h4>
      @endif
    </div>
    <form action="{{route('deleteClassData.admin')}}" method="post">
      @csrf
        <label for="room-num">Room Number</label>
        <input type="number" name="room-num" id="room-num" required >
        <br/>
        <br/>
        <button type="submit" name="delete-room" class="button primary">Delete</button>
    </form>
  </div>
</section>
@endsection