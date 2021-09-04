<!DOCTYPE HTML>
<html>
<head>
	
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;1,500&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
  <title>Student Attendance System</title>
  <style>
  label{
      margin: 0px 0px 0px 0px;
  }
  .navi{
    display: flex !important;
    flex-wrap: wrap;
    flex-direction: row;
    /* align-self: center; */
    justify-content: space-between;
    align-items: space-between;
    /* padding: 2rem; */
  }
  
  </style>

</head>

<body class="is-preload">
	<!-- menu -->
    <header id="header">
		<a class="logo" href="/">Student Attendance System</a>
    </header>

	<!-- Banner -->
	<section id="banner">
		<div class="inner" style="max-width: 500px;">
			<div style="margin-bottom: 1rem;">
	      <img class='logo' src="{{asset('assets/images/logo.png')}}" alt="logo" height="150">
			</div>
			<div>
				<h3 style="font-family: 'Secular One', sans-serif; margin-bottom: 1rem; opacity: 0.7;">DEPARTMENT OF CSE<br/> MBSTU</h3>
			</div>
			<div>
        <div>
          @if($errors->any())
            <h4 style="color: red">{{$errors->first()}}</h4>
          @endif
        </div>
        <form action="/" method="post">
          @csrf
          <label for="username" style="font-weight: 300; font-family: 'Kanit', sans-serif; font-size: 1.2rem">User Name</label>
          <input type="text" name="username" id="username" placeholder="Username" required> 
          <label for="password" style="font-weight: 300; font-family: 'Kanit', sans-serif; font-size: 1.2rem">Password
          </label>
          <input type="password" name="password" id="password" placeholder="Password" required>
          <input type="submit" value="Login" class="button primary" name="submit" style=" margin-top: 10px;">
        </form>
			</div>
		</div>
		
	</section>
	
	<!-- Footer -->
@include('partials.footer')

	</body>

</html>