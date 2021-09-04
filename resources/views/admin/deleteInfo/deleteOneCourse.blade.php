@extends('layouts.main')

@section('title', 'Delete All Course Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete All Course Information')

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
    <form action="{{route('deleteOneCourseData.admin')}}" method="post">
      @csrf
      <label for="course-code">Course Code:</label>
      <input type="text" name="course-code" id="course-code" placeholder="CSE1101" required>
      <br/>
        <button class="button primary" type="submit" name="delete">Delete</button>
      </form>
  </div>
</section>
@endsection