@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					Welcome <b>{{Auth::user()->name}}</b>!<br>
					You are logged in!<br>
					<center>
						<img class='img-responsive' style='margin-top: -20px;margin-left: -5px;'
							 width='139' height='49' src="{{ asset('public/img/logo1.png') }}"
							 alt='CCT LOGO'/>
					</center>

					<p>
					<h1><b>Welcome to CCT jobs!</b></h1>
					Thank you for signing up with us. <br>
					We are happy you chose a sure and convenient  placement company for your career.
					</p>

					<p>
						The web site will be fully functional soon.

					<hr>
					<h5>For any assistance, reach us at</h5>
					contactus@cctjobs.com
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
