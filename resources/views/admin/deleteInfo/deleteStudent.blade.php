@extends('layouts.main')

@section('title', 'Delete Student Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Student Information')

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
      <h3>Search Student By ID</h3>
            <form action="{{route('searchStudent.admin')}}" method="post">
              @csrf
              <input type="search" name="search-student" id="search-student">
              <hr>
              <button class="button primary" type="submit" name="search-btn">Search</button>
            </form>
    </div>
  </div>
</section>
@endsection