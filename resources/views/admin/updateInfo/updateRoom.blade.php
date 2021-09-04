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
    <form action="{{route('updateRoomDetails.admin')}}" method="post">
      @csrf
      <label for="room-num">Room Number:</label>
      <input type="text" name="room-num" id="room-num" placeholder="CSE1101" required>
      <label for="room-dept" >Room Dept:</label>
      <select name="room-dept" id="room-dept">
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
      <label for="latitude">Latitude:</label>
      <input type="text" name="latitude" id="latitude" placeholder="" required>
      <label for="longitude">Longitude:</label>
      <input type="text" name="longitude" id="longitude" placeholder="" required>
      <label for="radious">Radious:</label>
      <input type="text" name="radious" id="radious" placeholder="" required>
      <br />
      <input type="submit" class="button primary" value="Update">
    </form>
  </div>
</section>
@endsection