@extends('layouts.main')

@section('title', 'Teacher Dashboard')
@section('header')
  @include('partials.header')
@endsection

@section('banner_title', 'Students Results')

@section('content')

  <section style="width: auto !important">
    <div class="content" style="margin: 0 auto; width: auto; height: auto;">
        {{-- <p><a id="download" class="button small">Download Excel File</a></p> --}}
        <p><a href="{{route('export.teacher', ['id'=>session('id'), 'code'=>$code])}}" class="button small">Download Excel File</a></p>

        <div class="display-info">
            <h3 style="margin: 0px 0px 5px">Student Details</h3>
            <div class="details" style="overflow-y: auto; max-height: 420px;">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Attendance (%)</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($students) == 0)
                            <p style="color: red">No students fond!</p>
                        @else
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{$student[0]}}</td>
                                    <td>
                                        <a 
                                        href="{{route('studentInfo.teacher', 
                                        [
                                        'id' => session('id'), 
                                        'code' => $code,
                                        'stuId' => $student[0]
                                        ]
                                        )}}"
                                        >
                                        {{$student[1]}}
                                        </a>
                                    </td>
                                    <td>{{$student[2]}}%</td>
                                    <td>{{$student[3]}}</td>
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