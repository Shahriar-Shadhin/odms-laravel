@extends('layouts.main')

@section('title', 'Add Teacher Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Add Teacher Information')

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
  <form action="{{route('postTeacher.admin')}}" method="post">
    @csrf
      <div class="content" style="padding: 10px;">
          <label for="teacher-dept" class="">Teacher Dept:</label>
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
          <label for="teacher-name" class="">Teacher Name:</label>
          <input type="text" name="teacher-name" id="teacher-name" required>
          <label for="teacher-email" class="">Teacher Email:</label>
          <input type="email" name="teacher-email" id="teacher-email">
          <label for="phone-number" class="">Teacher Phone:</label>
          <input type="tel" pattern="[0-9]{11}" placeholder="01700000000" name="phone-number" id="phone-number" required>
          <label for="teacher-username" class="">Teacher Username:</label>
          <input type="text" name="teacher-username" id="teacher-username" required>
          {{-- <label for="teacher-password" class="">Teacher Password:</label>
          <input type="text" name="teacher-password" id="teacher-password" required> --}}
          <hr>
          <button type="submit" name="add-teacher-info" class="button primary">Add Teacher</button>
      </div>
  </form>

</section>
@endsection