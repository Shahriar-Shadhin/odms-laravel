@extends('layouts.main')

@section('title', 'Teacher Dashboard')
@section('header')
  @include('partials.header')
@endsection

@section('banner_title')
{{$courseInfo['course_name']}}
@endsection

@section('content')
  <section>
    <div class="content">
        <div>
            @if(session()->has('message'))
                <h4 style="color: green">{{ session()->get('message') }}</h4>
            @endif
        </div>
        <form action="{{route('course.teacher', ['id' => session('id'), 'code' => $courseInfo['course_code']])}}" method="post">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <th>Course Name:</th>
                        <td>{{$courseInfo['course_name']}}</td>
                    </tr>
                    <tr>
                        <th>Course Code:</th>
                        <td>{{$courseInfo['course_code']}}</td>
                    </tr>
                    <tr>
                        <th>Course Credit:</th>
                        <td>{{$courseInfo['course_credit']}}</td>
                    </tr>
                    <tr>
                        <th>Number Of Classes:</th>
                        <td>{{$courseInfo['class_number']}}</td>
                    </tr>
                    <tr>
                        <th>Current Class Number:</th>
                        <td>{{$currClass}}</td>
                        <input type="hidden" name="current-class" value="{{$currClass}}">
                    </tr>
                    <tr style="color: #FF5733">
                        <th>Current Class Code:</th>
                        <td>{{$classCode}}</td>
                        <input type="hidden" name="class-code" value="{{$classCode}}">
                    </tr>
                    <tr>
                        <th>Set Time Limit(Minutes):</th>
                        <td><input type="text" name="time-limit" id="time-limit" required></td>
                    </tr>
                    <tr>
                        <th>Set Class Room:</th>
                            <td>
                                <select name="class-room" id="class-room">
                                    <option disabled selected >Choose Room</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{$room['room_number']}}">{{$room['room_number']}}_{{$room['room_dept']}}</option>
                                    @endforeach
                                </select>
                            </td>
                    </tr>
                    <tr style="background: white;">
                        <td colspan="2"><button type="submit" class="button primary" name="submit">Submit</button></td>
                     </tr>
                </tbody>
            </table>
            </form>
    </div>
  </section>

@endsection