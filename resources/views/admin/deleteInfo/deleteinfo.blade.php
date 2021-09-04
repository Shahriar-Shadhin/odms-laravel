@extends('layouts.main')

@section('title', 'Delete Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Information')

@section('content')
<section>
  <div class="content">
      <header>
          <a href="{{route('deleteStudent.admin')}}" class="icon fa-minus-circle"><span
                  class="label">Icon</span></a>
          <h3>Delete </br> Student Information</h3>
      </header>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('deleteTeacher.admin')}}" class="icon fa-minus-circle"><span
                  class="label">Icon</span></a>
          <h3>Delete </br>Teacher Information</h3>
      </header>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('deleteCourse.admin')}}" class="icon fa-minus-circle"><span
                  class="label">Icon</span></a>
          <h3>Delete </br>Course Information</h3>
      </header>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('deleteClass.admin')}}" class="icon fa-minus-circle"><span
                  class="label">Icon</span></a>
          <h3>Delete </br>Class Room</h3>
      </header>
  </div>
</section>
@endsection