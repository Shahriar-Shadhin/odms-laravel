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
    <form action="{{route('updateCourseDetails.admin')}}" method="post">
      @csrf
      <label for="course-code">Course Code:</label>
      <input type="text" name="course-code" id="course-code" placeholder="CSE1101" required>
      <label for="course-dept" >Course Dept:</label>
      <select name="course-dept" id="course-dept">
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
      <label for="course-name">Course Name:</label>
      <input type="text" name="course-name" id="course-name" placeholder="Course Name" required>
      <label for="course-semester">Course Semester:</label>
      <select name="course-semester" id="course-semester">
        <option value="1st">1-1</option>
        <option value="2nd">1-2</option>
        <option value="3rd">2-1</option>
        <option value="4th">2-2</option>
        <option value="5th">3-1</option>
        <option value="6th">3-2</option>
        <option value="7th">4-1</option>
        <option value="8th">4-2</option>
      </select>
      <label for="course-class">Number Of Class:</label>
      <input type="text" name="course-class" id="course-class" placeholder="Course Class Number" required>
      <label for="course-credit">Course Credit:</label>
      <input type="text" name="course-credit" id="course-credit" placeholder="Course Credit" required>
      <br />
      <input type="submit" class="button primary" value="Update">
    </form>
  </div>
</section>
@endsection