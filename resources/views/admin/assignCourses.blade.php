@extends('layouts.main')

@section('title', 'Assign Teacher')
@section('header')
@include('partials.header')
@endsection


@section('banner_title', 'Assign Teacher')

@section('content')
<div class="content" style="padding: 1rem; margin: 0 auto; width: 600px;">
  <form action="{{route('assignPostCourses', $dept)}}"  method="post">
    @csrf
    <input type="hidden" name="teacher_id" value="{{$teacher['teacher_username']}}" >
    <h3 style="margin: 0 0 5px; font-weight: 500;">Choose Year & Semester:</h3>
    <label for="year">Year & Semesete</label >
    <select name="year" onchange="handleData(this.value)" id="year">
      <option disabled selected>Chooose</option>
        <option value="1-1" >1st year 1st semester</option>
        <option value="1-2" >1st year 2nd semester</option>
        <option value="2-1" >2nd year 1st semester</option>
        <option value="2-2" >2nd year 2nd semester</option>
        <option value="3-1" >3rd year 1st semester</option>
        <option value="3-2" >3rd year 2nd semester</option>
        <option value="4-1" >4th year 1st semester</option>
        <option value="4-2" >4th year 2nd semester</option>

    </select>
    <div  id="course-section" style="display: flex; flex-direction: column; flex-wrap: wrap; justify-content: space-around; padding: 5px;
    text-align: left;">

    </div>
    <hr>
    <button type="submit" class="button primary" name="assign" >Assign</button>

</form>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/js/axios.min.js')}}"></script>
<script>
  // let year = null;
  const dept = "{{$dept}}";
  const handleData =(data)=> {
  let semester = data.slice(2, 3);
  let year = data.slice(0,1);
  console.log(`year is ${year} and semester is ${semester}`);

  let uri = `/admin/assign/${dept}/${year}/${semester}`;
  console.log(uri);

  axios.get(uri)
        .then(response => {
            let courses = response.data;
            document.querySelector('#course-section').innerHTML = courses;
        })
        .catch(error => console.error(error));
}

</script>
@endsection