<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;1,500&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/css/addinfo.css')}}" />


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  


    <style>
    label{
        margin: 0px 0px 0px 0px;
    }
	.navi{
    display: flex !important;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
    align-items: space-between;
	}
  .highlights{
    justify-content: center;
  }
  .content{
    padding: 0 !important;
  }.display-info {
			padding: 10px;
			width: auto;
			height: 500px;
			border: 1px solid gray;
			justify-content: center;
		}
    </style>
  <title>@yield('title')</title>
</head>
<body class="is-preload">

  {{-- header --}}
  @yield('header')


  {{-- banner --}}
  <section id="banner">
		<div class="inner">
			<h1>@yield('banner_title')</h1>
		</div>
	</section>


  {{-- main section --}}
  <section class="wrapper">
		<div class="inner">
			<div class="highlights">
        @yield('content')
      </div>
    </div>
  </section>

  {{-- footer --}}
@include('partials.footer')

</body>
</html>