@extends('layouts.main')

@section('title', 'Assign Teacher')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Assign Teacher')

@section('content')
<div class="content" style="padding: 1rem; margin: 0 auto; width: 600px;">
  <div class="text-center">
    @if($errors->any())
      <h4 style="color: red; text-align:center">{{$errors->first()}}</h4>
    @endif
    @if(session()->has('message'))
      <h4 style="color: green; text-align:center">{{ session()->get('message') }}</h4>
    @endif
  </div>
  <form action="{{route('assignPostDept.admin')}}" method="post">
    @csrf
      <label for="teacher-dept">Teacher Dept:</label>
      <select name="dept" id="teacher-dept" onchange="depts(this.value)">
          <option>Select</option>
          <option value="cse">CSE</option>
          <option value="ict">ICT</option>
          <option value="te">TE</option>
          <option value="farm">Farmacy</option>
          <option value="bge">BGE</option>
          <option value="bmb">BMB</option>
          <option value="esrm">ESRM</option>
          <option value="ftns">FTNS</option>
          <option value="cps">CPS</option>
          <option value="phy">PHY</option>
          <option value="chem">CHEM</option>
          <option value="math">MATH</option>
          <option value="stat">STAT</option>
          <option value="eco">ECO</option>
          <option value="bba">BBA</option>
      </select>
      <label for="teacher-name">Teacher Name:</label>
      <select name="teacher-name" id="teacher-name">
      <option >Select</option>
      </select>
      <hr>
      <button type="submit" class="button primary" name="course">Goto Courses Page</button>

  </form>
</div>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  function depts(data){
    axios.get(`/admin/assign/${data}`)
        .then(response => {
            let names = response.data;
            document.getElementById('teacher-name').innerHTML = names;
            console.log(names);
        })
        .catch(error => console.error(error));
  }

</script>
@endsection