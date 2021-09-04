@extends('layouts.main')

@section('title', 'Delete All Course Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete All Course Information')

@section('content')
<section>
  <div class="content">
    <header>
      <h3>Delete All Courses By Dept</h3>
    </header>

    <form action="{{route('deleteAllCourseDate.admin')}}" method="post">
      @csrf
      <label for="dept">Select dept:</label>
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
        <option value="CHEM">CHEM</option>
        <option value="MATH">MATH</option>
        <option value="STAT">STAT</option>
        <option value="ECO">ECO</option>
        <option value="BBA">BBA</option>
      </select>
      <br>
      <button class="button primary" type="submit" name="delete-btn">Delete</button>
    </form>
  </div>
</section>
@endsection