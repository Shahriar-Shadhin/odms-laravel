@extends('layouts.main')

@section('title', 'Browse Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Browse Information')

@section('content')
<div class="content" style="padding: 1rem; margin: 0 auto; width: 600px; height: 650px; display: flex; flex-direction: column; justify-content: center;">
    <div>
      @if($errors->any())
        <h4 style="color: red">{{$errors->first()}}</h4>
      @endif
    </div>
    <form action="{{route('browseCourseInfo.admin')}}" method="post">
      @csrf
      <label for="dept" style="margin-bottom: 0px;">Choose Department:</label>
      <select name="dept" id="dept" required>
          <option value="CSE">CSE</option>
          <option value="ICT">ICT</option>
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
          <option value="STAT">STAT</option>
          <option value="ECO">ECO</option>
          <option value="BBA">BBA</option>
      </select>
      <button type="submit" name="search" class="button primary" style="margin-top: 5px;">Search</button>
    </form>
    <div class="display-info">
      <h3 style="margin: 0px 0px 5px">Teachers Details</h3>
      <div class="details" style="overflow: auto; height: 450px;">
        <table >
          <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Credit</th>
                <th>Semester</th>
                <th>Teacher</th>
            </tr>
          </thead>
          <tbody>
            @if (isset($courses) && !empty($courses))
              @for ($i = 0; $i<=count($courses) - 1; $i++)
                <tr>
                  <td style="padding: 2px">{{$courses[$i]['course_code']}}</td>
                  <td style="padding: 2px">{{$courses[$i]['course_name']}}</td>
                  <td style="padding: 2px">{{$courses[$i]['course_credit']}}</td>
                  <td style="padding: 2px">{{$courses[$i]['course_semester']}}</td>
                  <td style="padding: 2px">{{$courses[$i]['course_teacher']}}</td>

                </tr>
              @endfor
            @endif
          </tbody>
          <tfoot>
    
          </tfoot>
        </table>
      </div>
    </div>
@endsection