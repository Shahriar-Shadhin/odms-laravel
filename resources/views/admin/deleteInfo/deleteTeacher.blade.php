@extends('layouts.main')

@section('title', 'Delete Teacher Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Teacher Information')

@section('content')
<section>
  <div class="text-center">
    @if($errors->any())
      <h4 style="color: red; text-align:center">{{$errors->first()}}</h4>
    @endif
    @if(session()->has('message'))
      <h4 style="color: green; text-align:center">{{ session()->get('message') }}</h4>
    @endif
    </div>
  <div class="content">
    <div>
      <h3>Search Teacher By Username</h3>
      <form action="{{route('searchTeacher.admin')}}" method="post">
        @csrf
        <input type="search" name="search-teacher" id="search-teacher">
        <br>
        <button class="button primary" type="submit" name="search-btn">Search</button>
      </form>
    </div>
  </div>
</section>
@endsection