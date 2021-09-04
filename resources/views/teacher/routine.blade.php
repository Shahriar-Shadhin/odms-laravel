@extends('layouts.main')

@section('title', 'Teacher Dashboard')
@section('header')
@include('partials.header')
@endsection


@section('banner_title')
{{'Routine'}}
@endsection

@section('content')
<section>
    <div class="content">
        <div>
            @if(session()->has('message'))
                <h4 style="color: green">{{ session()->get('message') }}</h4>
            @endif
        </div>
        
        <form action="{{route('setRoutine.teacher', session('id'))}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="course-name" class="form-label">Course Name</label>
                <select name="course-name" class="form-select" id="course-name">
                    <option disabled selected>Select</option>
                    @foreach ($assignedCourses as $assignedCourse)
                    <option value="{{$assignedCourse->course_code}}">{{$assignedCourse->course_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="routine-time" class="form-label">Preferred Time</label>
                <select type="text" class="form-control" name="routine-time" id="routine-time">
                    <option value="10">10 AM</option>
                    <option value="11">11 AM</option>
                    <option value="12">12 PM</option>
                    <option value="14">2 PM</option>
                    <option value="14">3 PM</option>
                    <option value="14">4 PM</option>
                    <option value="14">5 PM</option>
                    <option value="14">6 PM</option>
                    <option value="14">7 PM</option>
                </select>
            </div>
              <div class="">
                  <h4 class='text-danger'>Reserved Times</h4>
                @foreach ($routineInfos as $routineInfo)
                    <span style="padding: 5px">{{$routineInfo->preferred_time}}, </span>
                @endforeach
            </div>
              <br>
              <button type="submit" class="button primary">Assign</button>
              
        </form>
    </div>
  </section>
@endsection