@extends('layouts.main')

@section('title', 'Add Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Add Information')

@section('content')
<section>
  <div class="content">
      <header>
          <a href="{{route('addStudent.admin')}}" class="icon fa-plus-circle"><span
                  class="label">Icon</span></a>
          <h3>Add </br> Student Information</h3>
      </header>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('addTeacher.admin')}}" class="icon fa-plus-circle"><span
                  class="label">Icon</span></a>
          <h3>Add </br>Teacher Information</h3>
      </header>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('addCourse.admin')}}" class="icon fa-plus-circle"><span
                  class="label">Icon</span></a>
          <h3>Add </br>Course Information</h3>
      </header>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('addClassRoom.admin')}}" class="icon fa-plus-circle">
          <span class="label">Icon</span></a>
          <h3>Add </br>Class Room Details</h3>
      </header>
  </div>
</section>
@endsection