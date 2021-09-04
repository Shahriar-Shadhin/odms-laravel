@extends('layouts.main')

@section('title', 'Update Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Update Information')

@section('content')
<section>
  <div class="content">
      <header>
          <a href="{{route('updateStudent.admin')}}" class="icon fa-pencil"><span class="label">Icon</span></a>
          <h3>Update </br> Student Information</h3>
      </header>
      <p>Update Student Information To Databse</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('updateTeacher.admin')}}" class="icon fa-pencil"><span class="label">Icon</span></a>
          <h3>Update </br>Teacher Information</h3>
      </header>
      <p>Update Teacher Information to Database</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('updateCourse.admin')}}" class="icon fa-pencil"><span class="label">Icon</span></a>
          <h3>Update </br>Course Information</h3>
      </header>
      <p>Update Course Information To Database</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('updateRoom.admin')}}" class="icon fa-pencil"><span class="label">Icon</span></a>
          <h3>Update </br>Room Information</h3>
      </header>
      <p>Update Room Information To Database</p>
  </div>
</section>
@endsection