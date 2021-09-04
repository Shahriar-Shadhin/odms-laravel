@extends('layouts.main')

@section('title', 'Student Dashboard')
@section('header')
  @include('partials.header')
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

@section('banner_title')
{{$course['course_name']}}
@endsection
<?php
  if($roomInfo !== null){
    $latDb = (double)$roomInfo['latitude'];
    $lonDb = (double)$roomInfo['longitude'];
    $radiousDb = (double)$roomInfo['radious'];
  }else {
    $latDb = null;
    $lonDb = null;
    $radiousDb = null;
  }
 
?>
<script>
  var lat1 = '';
  var lon1 = '';
  var lat2 = Number("<?php echo $latDb?>");
  var lon2 = Number("<?php echo $lonDb?>");
  var radious = Number("<?php echo $radiousDb?>");
  console.log(`radious is ${radious}`);

  var loader = setInterval(function () {
            if(document.readyState !== "complete") return;
            clearInterval(loader);
            if(navigator.geolocation){
              navigator.geolocation.getCurrentPosition(function(p){
                  lat1 = p.coords.latitude;
                  lon1 = p.coords.longitude;

                  console.log(`student latitude: ${lat1}`);
                  console.log(`student longitude: ${lon1}`);
                  console.log(`class room latitude: ${lat2}`);
                  console.log(`class room longitude: ${lon2}`);

                  const R = 6371e3; // metres
                  const φ1 = lat1 * Math.PI/180; // φ, λ in radians
                  const φ2 = lat2 * Math.PI/180;
                  const Δφ = (lat2-lat1) * Math.PI/180;
                  const Δλ = (lon2-lon1) * Math.PI/180;

                  const a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
                      Math.cos(φ1) * Math.cos(φ2) *
                      Math.sin(Δλ/2) * Math.sin(Δλ/2);
                  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

                  const d = R * c; // in metres
                  
                  console.log(`distance = ${d}`);
                  if(d < radious){
                    const subBtn = document.getElementById("submit");
                    subBtn.disabled = false;
                    document.getElementById("message").textContent = `${d.toFixed(2)} m`;
                  }else{
                    const subBtn = document.getElementById("submit");
                    subBtn.disabled = true;
                    document.getElementById("message").textContent = `${d.toFixed(2)} m`;
                  }
              })
            }
  }, 300);
</script>

@section('content')
<section style="margin-top: -9%">
  <div class="content" style="margin: 0 auto; max-width: 500px; height: auto; padding: 0px;">
    <p id="msg">
      @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
      @endif
      @if(session()->has('message'))
        <h4 style="color: green">{{ session()->get('message') }}</h4>
      @endif
    </p>
    <form action="{{route('attendance.student', ['id' => session('id'), 'code' => $course['course_code']])}}" method="post">
      @csrf
      <input type="hidden" name="latitude" value="{{$latDb}}">
      <input type="hidden" name="longitude" value="{{$lonDb}}">
      <input type="hidden" name="radious" value="{{$radiousDb}}">
      <input type="hidden" name="total-class-num" value="{{$course['class_number']}}">

      <table>
        <tr>
          <th>Course Name:</th>
          <td>{{$course['course_name']}}</td>
        </tr>

        <tr>
          <th>Course Code:</th>
          <td id="course-code">{{$course['course_code']}}</td>
        </tr>

        <tr>
          <th>Course Credit:</th>
          <td>{{$course['course_credit']}}</td>
        </tr>

        <tr>
          <th>Class Room:</th>
          <td>
            @if ($classInfo !== null)
            {{$classInfo['room_num']}}
            @else
                {{"null"}}
            @endif
          </td>
        </tr>

        <tr>
          <th>
            Current Class Number:
          </th>
          <td>
            @if ($classInfo !== null)
            {{$classInfo['class_num']}}
            <input type="hidden" name="class-num" value="{{$classInfo['class_num']}}">
            @else
                {{"null"}}
            @endif
          </td>
        </tr>

        <tr style="color: #c71441">
          <th>Current Class Code:</th>
          <td>
            @if ($classInfo !== null)
            {{$classInfo['class_code']}}
            @else
                {{"No code is available"}}
            @endif
          </td>
        </tr>

        <tr>
          <th>Distance</th>
          <td>
            <span id="message" style="color:red;"></span>
          </td>
        </tr>

        <tr style="background: white;">
          <td colspan="2">
            <div id="status" style="text-align: center">
              <input type="submit" id= "submit" name="submit" value="Submit" class="button primary" />
            </div>
          </td>
        </tr>
      </table>
    </form>
    
  </div>
</section>
@endsection