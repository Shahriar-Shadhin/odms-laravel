@extends('layouts.main')

@section('title', 'Update Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Update Information')

@section('content')
<div class="content" style="padding: 1rem; margin: 0 auto; width: 600px; height: 650px; display: flex; flex-direction: column; justify-content: center;">
  <div>
    @if($errors->any())
      <h4 style="color: red">{{$errors->first()}}</h4>
    @endif
  </div>
  <form action="{{route('browseStudentInfoBySessionPost.admin')}}" method="post">
    @csrf
    <input  type="search" name="session" placeholder="2015-16" required>
    <button type="submit" name="search" class="button primary" style="margin-top: 5px;">Search</button>
  </form>
  <div class="display-info">
    <h3 style="margin: 0px 0px 5px">Student Details</h3>
    <div class="details" style="overflow: auto; height: 450px;">
      <table >
        <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Usename</th>
              <th>Dept</th>
              <th>Semester</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($students) && !empty($students))
            @for ($i = 0; $i<=count($students) - 1; $i++)
              <tr>
                <td style="padding: 2px">{{$students[$i]['student_id']}}</td>
                <td style="padding: 2px">{{$students[$i]['student_name']}}</td>
                <td style="padding: 2px">{{$students[$i]['student_username']}}</td>
                <td style="padding: 2px">{{$students[$i]['student_dept']}}</td>
                <td style="padding: 2px">{{$students[$i]['student_semester']}}</td>
              </tr>
            @endfor
          @endif
        </tbody>
        <tfoot>
  
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection