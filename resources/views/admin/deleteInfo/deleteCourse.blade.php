@extends('layouts.main')

@section('title', 'Delete Course Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Course Information')

@section('content')
<section>
  <div class="content">
      <header>
          <a href="{{route('deleteOneCourse.admin')}}" class="icon fa-minus-circle"><span
            class="label">Icon</span></a>
          <h3>Delete </br>One Course Information</h3>
      </header>
      <p>Search and delete one course information</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('deleteAllCourse.admin')}}" class="icon fa-minus-circle"><span
            class="label">Icon</span></a>
          <h3>Delete </br>All Course Information</h3>
      </header>
      <p>Search and delete All course information</p>
  </div>
</section>
@endsection