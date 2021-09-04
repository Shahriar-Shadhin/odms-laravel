@extends('layouts.main')

@section('title', 'Student Dashboard')
@section('header')
@include('partials.header')
@endsection

{{-- @section('banner_title', 'Student Dashboard') --}}
@section('banner_title')
  {{session('id')}}{{" Results"}}
@endsection

@section('content')
<div class="content" style="margin: 0; max-width: 600px; height: auto; padding: 5px;">
    <table>
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Total Class</th>
                <th>Absent</th>
                <th>Present</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infos as $info)
                <tr>
                    <td>{{$info[0]}}</td>
                    <td>{{$info[1]}}</td>
                    <td>{{$info[2]}}</td>
                    <td>{{$info[3]}}</td>
                    <td>{{$info[4]}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>
@endsection