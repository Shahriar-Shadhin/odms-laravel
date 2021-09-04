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
  <form action="{{route('browseTeacherInfoByIdPost.admin')}}" method="post">
    @csrf
    <input type="search" name="teacher-id" placeholder="Teacher username" required>
    <button type="submit" name="search" class="button primary" style="margin-top: 5px;">Search</button>
  </form>
  <div class="display-info">
    <h3 style="margin: 0px 0px 5px">Teacher Details</h3>
    <table>
      <?php 
        $arr = ["Name", "Dept", "Phone", "Usename", "Email"];
      ?>
      @if (isset($data) && !empty($data))
        @for ($i = 0; $i<=4; $i++)
          <tr>
            <td><b>{{$arr[$i]}}:</b></td>
            <td>{{$data[$i]}}</td>
          </tr>
        @endfor
      @endif
    </table>
  </div>
</div>
@endsection