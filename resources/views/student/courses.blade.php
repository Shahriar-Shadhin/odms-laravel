@extends('layouts.main')

@section('title', 'Student Dashboard')
@section('header')
  @include('partials.header')
@endsection

@section('banner_title', 'Courses')

@section('content')
  @foreach ($courses as $course)
      <section>
        <div class="content">
          <header>
            <a 
            href="{{route('course.student', ['id' => session('id'), 'code' => $course['course_code']])}}" class="icon fa-file"
            >
            <span class="label">Icon</span>
            </a>
            <h3>{{$course['course_name']}}</h3>
          </header>
          <p>{{$course['course_code']}}</p>
        </div>
      </section>
  @endforeach
@endsection