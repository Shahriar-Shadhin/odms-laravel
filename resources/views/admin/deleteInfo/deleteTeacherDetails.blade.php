@extends('layouts.main')

@section('title', 'Delete Teacher Information')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Delete Teacher Information')

@section('content')
<section>
  <div class="content">
    
      <form action="{{route('deleteTeacherData.admin', session('id'))}}" method="post">
        @csrf
          <div class="content" style="padding: 10px;">
              <label for="teacher-id" class="">Teacher Username:</label>
              <input type="text" name="teacher-id" id="teacher-id" value='{{$tea[0]->teacher_username}}'>
              <label for="teacher-dept" class="">Teacher Dept:</label>
              <input type="text" name="teacher-dept" id="teacher-dept" value='{{$tea[0]->teacher_dept}}'>
              <label for="teacher-name" class="">Teacher Name:</label>
              <input type="text" name="teacher-name" id="teacher-name" value='{{$tea[0]->teacher_name}}'>
              <label for="phon-number" class="">Teacher Phone:</label>
              <input type="text" name="phon-number" id="phon-number" value='{{$tea[0]->teacher_phone}}'>

              <hr>
              <button type="submit" name="delete-teacher-info" value="Delete Teacher"
              class="button primary">Delete Teacher</button>
          </div>
      </form>
  </div>
</section>
@endsection