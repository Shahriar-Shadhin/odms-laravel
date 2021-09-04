@extends('layouts.main')

@section('title', 'Student Dashboard')
@section('header')
@include('partials.header')
@endsection

@section('banner_title', 'Update Password')

@section('content')
    <div class="content" style="padding: 20px;">
        <p>
            @if(session()->has('message'))
                <h4 style="color: green">{{ session()->get('message') }}</h4>
            @endif
        </p>
        <form action="{{route('signup.student', session('id'))}}" method="post" style="margin: 0 0 10px;">
            @csrf
            <div class="form-control" style="display: grid;">
                <label for="old-password">Old Password:</label>
                <input type="password" name="old-password" id="old-password" required>
                <small style="color: red" id="oldpasstext">
                    @error('old-password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </small>
            </div>
            <div class="form-control">
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" required>
                <small style="color: red" id="newpasstext">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </small>
            </div>
            <div class="form-control">
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <small style="color: red" id="password_confirmation">
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </small>
            </div>
            <input type="submit" value="Submit" name="submit" id="button" class="button primary" style="margin: 10px;">
            <p style="font-size: 12px; color: green;">Password Must Be Between 8-15 Characters 
                <br> 
                Minimum One Number, One Special Character, One Lower Case and Upper Case Character!
            </p>
        </form>
        
    </div>
@endsection

