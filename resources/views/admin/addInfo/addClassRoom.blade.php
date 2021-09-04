@extends('layouts.main')

@section('title', 'Add Class Room Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Add Class Room Information')

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
          <label for="room-num" class="">Room Number:</label>
          <input type="number" name="room-num" id="room-num" required style="border-radius: 5px; border-width: 1px; height: 40px; background-color: #ECECEC; border-color: #b1b1b1; min-width: 297px">
          <label for="dept" class="">Department:</label>
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
          <label for="latitude" class="">Latitude:</label>
          <input type="text" inputmode="numeric" pattern="[0-9]+([,\.][0-9]+)?" name="latitude" id="latitude" required
              style="border-radius: 5px; border-width: 1px; background-color: #ECECEC; border-color: #b1b1b1; height: 40px;">

          <label for="longitude" class="">Longitude:</label>
          <input type="text" inputmode="numeric" pattern="[0-9]+([,\.][0-9]+)?" name="longitude" id="longitude" required
              style="border-radius: 5px; border-width: 1px; background-color: #ECECEC; border-color: #b1b1b1; height: 40px;">

          <label for="radius" class="">Class Room Radius:</label>
          <input type="number" name="radius" id="radius" required
              style="border-radius: 5px; border-width: 1px; background-color: #ECECEC; border-color: #b1b1b1; height: 40px; min-width: 297px">
          <hr>
          <button type="submit" name="add-room-info" class="button primary">Add Room</button>
      </div>
  </form>

</section>
@endsection