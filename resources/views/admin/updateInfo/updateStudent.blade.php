@extends('layouts.main')

@section('title', 'Update Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Update Information')

@section('content')
<section>
  <div class="content">
    <div>
      @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
      @endif
      @if(session()->has('message'))
        <h4 style="color: green">{{ session()->get('message') }}</h4>
      @endif
    </div>
    <form action="{{route('updateStudentDetails.admin')}}" method="post">
      @csrf
      <label for="student-id">Student ID:</label>
      <input type="text" name="student-id" id="student-id" placeholder="CE16017" required>
      <label for="student-dept" >Student Dept:</label>
      <select name="student-dept" id="student-dept">
        <option value="CSE">CSE</option>
        <option value="ICE">ICT</option>
        <option value="TE">TE</option>
        <option value="FARM">Farmacy</option>
        <option value="BGE">BGE</option>
        <option value="BMB">BMB</option>
        <option value="ESRM">ESRM</option>
        <option value="FTNS">FTNS</option>
        <option value="CPS">CPS</option>
        <option value="PHY">PHY</option>
        <option value="CHEM">CHEM</option>
        <option value="MATH">MATH</option>
        <option value="STATE">STAT</option>
        <option value="ECO">ECO</option>
        <option value="BBA">BBA</option>
    </select>
      <label for="student-name">Student Name:</label>
      <input type="text" name="student-name" id="student-name" placeholder="Student Name" required>
      <label for="student-semester" class="">Student Semester:</label>
      <select name="student-semester" id="student-semester" >
        <option value="1st">1st</option>
        <option value="2nd">2nd</option>
        <option value="3rd">3rd</option>
        <option value="4th">4th</option>
        <option value="5th">5th</option>
        <option value="6th">6th</option>
        <option value="7th">7th</option>
        <option value="8th">8th</option>
    </select>
      <label for="student-session" class="">Student Sessions:</label>
      <input type="text" name="student-session" id="student-session" placeholder="2015-16" required>
      <br />
      <input type="submit" class="button primary" value="Update">
    </form>
  </div>
</section>
@endsection