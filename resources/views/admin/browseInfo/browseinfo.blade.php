@extends('layouts.main')

@section('title', 'Browse Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Browse Information')

@section('content')
<section>
  <div class="content">
      <header>
          <a href="{{route('browseStudentInfo.admin')}}" class="icon fa-eye"><span class="label">Icon</span></a>
          <h3>Browse Student Information</h3>
      </header>
      <p>Browse Detail Informations Of Students</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('browseTeacherInfo.admin')}}" class="icon fa-eye"><span class="label">Icon</span></a>
          <h3>Browse Teacher Information</h3>
      </header>
      <p>Browse Detail Informations Of Teachers</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('browseCourseInfo.admin')}}" class="icon fa-eye"><span class="label">Icon</span></a>
          <h3>Browse Course Information</h3>
      </header>
      <p>Browse Detail Informations Of Courses</p>
  </div>
</section>
@endsection