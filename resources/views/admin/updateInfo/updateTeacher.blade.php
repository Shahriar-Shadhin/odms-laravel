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
    <form action="{{route('updateTeacherDetails.admin')}}" method="post">
      @csrf
      <label for="teacher-id">Teacher Username:</label>
      <input type="text" name="teacher-id" id="teacher-id" placeholder="Teacher username" required>
      <label for="teacher-dept" >Teacher Dept:</label>
      <select name="teacher-dept" id="teacher-dept">
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
      <label for="teacher-name">Teacher Name:</label>
      <input type="text" name="teacher-name" id="teacher-name" placeholder="Teacher Name" required>
      <label for="teacher-phone" class="">Phone Number:</label>
      <input type="text" name="teacher-phone" id="teacher-phone" placeholder="01700000000" required>
      <br />
      <input type="submit" class="button primary" value="Update">
    </form>
  </div>
</section>
@endsection