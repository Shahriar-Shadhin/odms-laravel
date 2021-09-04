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
          <a href="{{route('browseTeacherInfoById.admin')}}" class="icon fa-eye"><span
                  class="label">Icon</span></a>
          <h3>Browse Teacher By Username</h3>
      </header>
      <p>Browse Detail Informations Of Teacher</p>
  </div>
</section>
<section>
  <div class="content">
      <header>
          <a href="{{route('browseTeacherInfoByDept.admin')}}" class="icon fa-eye"><span
                  class="label">Icon</span></a>
          <h3>Browse Teacher By Department</h3>
      </header>
      <p>Browse Detail Informations Of Teacher</p>
  </div>
</section>
@endsection