@extends('layouts.main')

@section('title', 'Admin Dashboard')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Admin Dashboard')

@section('content')
<section>
  <div class="content">
    <header>
      <a href="{{route('upload.admin')}}" class="icon fa-database"><span class="label">Icon</span></a>
      <h3>Upload Information</h3>
      {{-- <h1>{{session('id')}}</h1> --}}
    </header>
    <p>Upload Student, Teacher and Courses informations in Database</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('addinfo.admin')}}" class="icon fa-plus-circle"><span class="label">Icon</span></a>
      <h3>Add Information</h3>
    </header>
    <p>Add Student, Teacher and Course Information to Database</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('deleteinfo.admin')}}" class="icon fa-minus-circle"><span
        class="label">Icon</span></a>
      <h3>Delete Information</h3>
    </header>
    <p>Delete Student, Teacher and Course Information from Database</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('updateinfo.admin')}}" class="icon fa-pencil"><span class="label">Icon</span></a>
      <h3>Update Information</h3>
    </header>
    <p>Update information of student, teacher and courses from database</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('assign.admin')}}" class="icon fa-file-text-o"><span class="label">Icon</span></a>
      <h3>Assign Teacher</h3>
    </header>
    <p>Assign teachers of courses</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('browseinfo.admin')}}" class="icon fa-eye"><span class="label">Icon</span></a>
      <h3>Browse Information</h3>
    </header>
    <p>Browse informations of teacher, student and courses</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('passwordReset.admin', session('id'))}}" class="icon fa-pencil-square-o"><span
          class="label">Icon</span></a>
      <h3>Change Password</h3>
    </header>
    <p>Change Admin Password</p>
  </div>
</section>
<section>
  <div class="content">
    <header>
      <a href="{{route('teacherPriority.admin')}}" class="icon fa-user-circle"><span
          class="label">Icon</span></a>
      <h3>Update Teacher Priority</h3>
    </header>
    <p>Update Teacher Priority</p>
  </div>
</section>
@endsection