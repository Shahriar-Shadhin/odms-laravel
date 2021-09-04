@extends('layouts.main')

@section('title', 'Teacher Dashboard')
@section('header')
  @include('partials.header')
@endsection

@section('banner_title', 'Assigned Courses')

@section('content')
  @if (count($courses) == 0)
      <section><h2>No Courses found</h2></section>
  @else
  @foreach ($courses as $course)
  <section>
    <div class="content">
      <header>
        <a 
        href="{{route('course.teacher', ['id' => session('id'), 'code' => $course['course_code']])}}" class="icon fa-file"
        >
        <span class="label">Icon</span>
        </a>
        <h3>{{$course['course_name']}}</h3>
      </header>
      <p>{{$course['course_code']}}</p>
      <div>
        <a 
        href="{{route('studentsInfo.teacher', 
        [
          'id' => session('id'), 
          'code' => $course['course_code'],
          'dept' => $course['course_dept'],
          'semester' => $course['course_semester']
        ]
          )}}"
        class="button small">View Student Info</a>
      </div>
    </div>
  </section>
@endforeach
  @endif
@endsection