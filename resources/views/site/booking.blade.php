@extends('layouts.site')

@section('content')


<!-- banner -->
<section class="banner_inner" id="home">
	<div class="banner_inner_overlay">
	</div>
</section>
<!-- //banner -->


<!-- Booking -->
<section class="contact py-5">
	<div class="container py-lg-5 py-sm-4">
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4"> Book Your Tour</h2>
		<div class="contact-grids">
			<div class="row">
				<div class="col-lg-7 contact-left-form">
					<form action="#" method="post" class="row">
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Name" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="email" class="form-control" placeholder="Email" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Phone" required=""> 
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Date" required=""> 
						</div>
						<div class="col-sm-6 form-group contact-forms">
							<select class="form-control" id="adults">
								<option>Adults</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 or more</option>
							</select>
						</div>
						<div class="col-sm-6 form-group contact-forms">
							<select class="form-control" id="kids">
								<option>Kids</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 or more</option>
							</select>
						</div>
						<div class="col-md-12 form-group contact-forms">
						  <textarea class="form-control" placeholder="Message" rows="3" required=""></textarea>
						</div>
						<div class="col-md-12 booking-button">
							<button class="btn btn-block sent-butnn">Book Now</button>
						</div>
					</form>
				</div>
				<div class="col-lg-5 contact-right pl-lg-5">
				
					<div class="image-tour position-relative">
						<img src="images/banner1.jpg" alt="" class="img-fluid" />
						<p><span class="fa fa-tags"></span> <span>20$ - 15% off</span></p>
					</div>
					
					<h4>Tour Description</h4>
					<p class="mt-3">Duis nisi sapien, elementum finibus ferme ntum ed eget, aliquet et leo. Mauris hendrerit vel ex.
					vitae luctus massa. Phas ellus sed aliquam leo et dolor. Vestibulum ullamcorper massa eut sed fringilla.</p>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //Booking -->

@endsection