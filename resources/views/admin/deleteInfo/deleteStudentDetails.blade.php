@extends('layouts.main')

@section('title', 'Delete Student Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Student Information')

@section('content')
<form action="{{route('deleteStudentData.admin', $stu[0]->student_id)}}" method="post">
  @csrf
  <div class="content" style="padding: 10px;">
    <label for="student-id" class="">Student ID:</label>
    <input type="text" name="student-id" id="student-id" value='{{$stu[0]->student_id}}'>
    <label for="student-dept" class="">Student Dept:</label>
    <input type="text" name="student-dept" id="student-dept" value='{{$stu[0]->student_dept}}'>
    <label for="student-name" class="">Student Name:</label>
    <input type="text" name="student-name" id="student-name" value='{{$stu[0]->student_name}}'>
    <label for="student-session" class="">Student Sessions:</label>
    <input type="text" name="student-session" id="student-session" value='{{$stu[0]->student_session}}'>
    <hr>
    <button type="submit" name="delete-student-info" class="button primary">
      Delete Student
    </button>
  </div>
</form>
@endsection