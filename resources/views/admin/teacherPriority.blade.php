@extends('layouts.main')

@section('title', 'Update Teacher Priority')
@section('header')
@include('partials.header')
@endsection

@section('banner_title', 'Update Teacher Priority')

@section('content')
@php
    $number = count($teachers)
@endphp
<div class="content" style="padding: 1rem; margin: 0 auto; width: 600px;">
    <div class="text-center">
      @if($errors->any())
        <h4 style="color: red; text-align:center">{{$errors->first()}}</h4>
      @endif
      @if(session()->has('message'))
        <h4 style="color: green; text-align:center">{{ session()->get('message') }}</h4>
      @endif
    </div>
    
    <form action="{{route('teacherPriority.admin')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <select name="name" class="from-control" id="name">
                <option disabled selected>Select</option>
                @foreach ($teachers as $key=>$teacher)
                <option value="{{$teacher->teacher_username}}">{{$teacher->teacher_name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select name="priority" id="priority">
                <option disabled selected>Select</option>
                @foreach ($teachers as $key=>$teacher)
                <option value="{{$key+1}}">{{$key+1}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="button primary">Update</button>
    </form>
</div>
   
@endsection