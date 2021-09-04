@extends('layouts.main')

@section('title', 'Upload Info')
@section('header')
@include('partials.header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
@endsection


@section('banner_title', 'Upload Information')

@section('content')
<form action="{{route('uploadTeacher.admin')}}" method="post" enctype="multipart/form-data">
@csrf
    <section>
        <div class="content">
            <header>
                <input type="file" class="form-control" id="teacherFile" name="teacherFile" required />
                <h3>Upload Teacher Information</h3>
            </header>
            <a href="{{route('teacherSample.admin')}}" class="link-success">Download Sample Excel File</a>
            <br>
            <br>
            <input type="submit" name="submit-teacher" value="Upload" class="button primary">
        </div>
    </section>
</form>

<form action="{{route('uploadStudent.admin')}}" method="post" enctype="multipart/form-data">
    @csrf
    <section>
        <div class="content">
            <header>
                <input type="file" class="form-control" id="studentFile" name="studentFile" />
                <h3>Upload Student Information</h3>
            </header>
            <a href="{{route('studentSample.admin')}}" class="link-success">Download Sample Excel File</a>
            <br>
            <br>
            <input type="submit" name="submit-student" value="Upload" class="button primary">
        </div>
    </section>
</form>

<form action="{{route('uploadCourse.admin')}}" method="post" enctype="multipart/form-data">
    @csrf
    <section>
        <div class="content">
            <header>
                <input type="file" class="form-control" id="courseFile" name="courseFile" />
                <h3>Upload Course Information</h3>
            </header>
            <a href="{{route('courseSample.admin')}}" class="link-success">Download Sample Excel File</a>
            <br>
            <br>
            <input type="submit" name="submit-course" value="Upload" class="button primary">
        </div>
    </section>
</form>
@endsection