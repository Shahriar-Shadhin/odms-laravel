@extends('layouts.main')

@section('title', 'Student Dashboard')
@section('header')
@include('partials.header')
@endsection

{{-- @section('banner_title', 'Student Dashboard') --}}
@section('banner_title')
  {{"Update Email"}}
@endsection

@section('content')
<section>
    <div class="content">
        <div>
            <p>
                @if($errors->any())
                    <h4 style="color: red">{{$errors->first()}}</h4>
                @endif
                @if(session()->has('message'))
                    <h4 style="color: green">{{ session()->get('message') }}</h4>
                @endif
            </p>
        </div>
        <div>
            <p><strong> Old Email : </strong>
                @if ($email == null)
                    Email Is Empty
                @else
                    {{$email}}
                @endif</p>
        </div>
        <form action="{{route('updateEmail.student', session('id'))}}" method="post">
            @csrf
            <label for="email">New Email</label>
            <input type="email" name="email" placeholder="New Email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="password" id="password" required>
            <br>
            <input type="submit" class="button primary" value="Update">
        </form>
        
    </div>
</section>
@endsection