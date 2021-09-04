@extends('layouts.main')

@section('title', 'Teacher Dashboard')
@section('header')
  @include('partials.header')
@endsection

@section('banner_title', 'Students Results')

@section('content')
  <section style="width: auto !important">
    <div class="content" style="margin: 0 auto; height: auto; padding: 5px;">
        <div class="display-info">
            <div class="details" style="overflow-y: auto; max-height: 400px; max-width: 600px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Class Number</th>
                            <th>Date & Time</th>
                            <th>Present/Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($classInfos) == 0)
                            <p>No Data Found</p>
                        @else
                            @foreach ($classInfos as $classInfo)
                                <tr>
                                    <td>{{$classInfo['class_num']}}</td>
                                    <td>{{$classInfo['date']}}</td>
                                    <td>
                                        @if (strpos($classInfo['student_id'], $stuId) !== false)
                                            {{"Present"}}
                                        @else
                                        {{"Absent"}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </section>

@endsection