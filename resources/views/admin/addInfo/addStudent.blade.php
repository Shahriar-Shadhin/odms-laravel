@extends('layouts.main')

@section('title', 'Add Student Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Add Student Information')

@section('content')
<section>
  <div class="text-center">
    @if($errors->any())
      <h4 style="color: red; text-align:center">{{$errors->first()}}</h4>
    @endif
    @if(session()->has('message'))
      <h4 style="color: green; text-align:center">{{ session()->get('message') }}</h4>
    @endif
    </div>
  <form action="{{route('postStudent.admin')}}" method="post">
    @csrf
      <div class="content" style="padding: 10px;">
          <label for="student-id" class="">Student ID:</label>
          <input type="text" name="student-id" id="student-id" pattern="[A-Z]{2,4}[0-9]{5}" placeholder="CE16017" required>
          <label for="student-dept" class="">Student Dept:</label>
          <select name="dept" id="dept">
          <option value="CSE">CSE</option>
              <option value="ICT">ICT</option>
              <option value="TE">TE</option>
              <option value="FAR">Farmacy</option>
              <option value="BGE">BGE</option>
              <option value="BMB">BMB</option>
              <option value="ESRM">ESRM</option>
              <option value="FTNS">FTNS</option>
              <option value="CPS">CPS</option>
              <option value="PHY">PHY</option>
              <option value="CHE">CHEM</option>
              <option value="MATH">MATH</option>
              <option value="STAT">STAT</option>
              <option value="ECO">ECO</option>
              <option value="BBA">BBA</option>
          </select>
          <label for="student-semester" class="">Student Semester:</label>
          <select name="student-semester" id="student-semester">
              <option value="1st">1st</option>
              <option value="2nd">2nd</option>
              <option value="3rd">3rd</option>
              <option value="4th">4th</option>
              <option value="5th">5th</option>
              <option value="6th">6th</option>
              <option value="7th">7th</option>
              <option value="8th">8th</option>
          </select>
          <label for="student-name" class="">Student Name:</label>
          <input type="text" name="student-name" id="student-name" required>
          <label for="student-email" class="">Student Email:</label>
          <input type="email" name="student-email" id="student-email">
          <label for="student-session" class="">Student Session:</label>
          <input type="text" name="student-session" placeholder="2015-16" pattern="[0-9]{4}-[0-9]{2}" id="student-session" required>
          <hr>
          <button type="submit" name="add-student-info" class="button primary">
            Add Student
          </button>
      </div>
  </form>
</section>
@endsection