@extends('layouts.main')

@section('title', 'Teacher Dashboard')
@section('header')
@include('partials.header')
@endsection


@section('banner_title')
{{$name}}
@endsection

@section('content')
<section>
  <div class="content">
    <header>
      <a href="{{route('courses.teacher', session('id'))}}" class="icon fa-files-o"><span class="label">Icon</span></a>
      {{-- <h1>{{session('id')}}</h1> --}}
      <h3>View Courses</h3>
    </header>
    <p>View All Current Courses</p>
  </div>
</section>

<section>
  <div class="content">
    <header>
      <a href="{{route('signup.teacher', session('id'))}}" class="icon fa-pencil-square-o"><span
          class="label">Icon</span></a>
      <h3>Change Password</h3>
    </header>
    <p>Change User Password</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('updateEmail.teacher', session('id'))}}" class="icon fa-envelope"><span
          class="label">Icon</span></a>
      <h3>Update Email</h3>
    </header>
    <p>Update User Email</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('setRoutine.teacher', session('id'))}}" class="icon fa-calendar-o"><span
          class="label">Icon</span></a>
      <h3>Routine</h3>
    </header>
    <p>Class Routine</p>
  </div>
</section>
@endsection