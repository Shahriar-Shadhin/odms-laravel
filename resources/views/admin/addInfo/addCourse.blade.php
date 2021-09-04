@extends('layouts.main')

@section('title', 'Add Course Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Add Course Information')

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
  <form action="" method="post">
    @csrf
      <div class="content" style="padding: 10px;">
          <label for="cousrs-code" class="">Course Code:</label>
          <input type="text" placeholder="CSE-42001" pattern="[A-Z]{2,}-[0-9]{5}" name="course-code" id="course-code" required>
          <label for="dept" class="">Course Department:</label>
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
          <label for="course-semester" class="">course Semester:</label>
          <select name="course-semester" id="course-semester">
              <option value="1st">1st</option>
              <option value="2nd">2nd</option>
              <option value="3rd">3rd</option>
              <option value="4th">4th</option>
              <option value="5th">5th</option>
              <option value="6th">6th</option>
              <option value="7th">7th</option>
              <option value="8th">8th</option>
          </select>
          <label for="course-class" class="">Number Of class:</label>
          <input type="number" name="course-class" id="course-class" required
              style="border-radius: 5px; border-width: 1px; min-width: 296px; background-color: #ECECEC; border-color: #b1b1b1;">
          <label for="cousrs-name" class="">Course Name:</label>
          <input type="text" name="course-name" id="course-name" required>
          <label for="cousrs-credit" class="">Course Credit:</label>
          <input type="text" name="course-credit" id="course-credit" required>
          <hr>
          <button type="submit" name="add-course-info" class="button primary">Add Course</button>
      </div>
  </form>
</section>
@endsection