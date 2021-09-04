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
          <a href="{{route('browseStudentInfoById.admin')}}" class="icon fa-eye"><span
                  class="label">Icon</span></a>
          <h3>Browse Student By ID</h3>
      </header>
      <p>Browse Detail Informations Of Students</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('browseStudentInfoBySemester.admin')}}" class="icon fa-eye"><span
                  class="label">Icon</span></a>
          <h3>Browse Student By Semester</h3>
      </header>
      <p>Browse Detail Informations Of Student</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('browseStudentInfoBySession.admin')}}" class="icon fa-eye"><span
                  class="label">Icon</span></a>
          <h3>Browse Student By Session</h3>
      </header>
      <p>Browse Detail Informations Of Student</p>
  </div>
</section>
@endsection