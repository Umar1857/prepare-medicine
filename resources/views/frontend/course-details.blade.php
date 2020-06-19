@extends('frontend.master-frontend')



@section('content')
    <br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Subscriptions</p>
            </div>
        </div>
        <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px;">
			<strong>Course: </strong>{{  $pageTitle }}
		</h2>
        
        <div class="row">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
        		@include('msg.msg')
        	</div>
        	<div class="col-md-3"></div>
        </div>
		@if(Auth::check() && Auth::user()->role == 4)
		<h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px;">
			You Are Admin
		</h2>
        @else
        <div class="container plans_area">
			
			<div class="row" >

				<div class="col-lg-4 col-md-6 col-sm-12 single_plan">
					<div class="card">
						<div class="price-header">
							<h3>Free Trial</h3>
						</div>
						<div class="price-content">
							<ul>
								<li>24-Hour Access
								<li>20 Q-Bank</li>
								<li>30 Different Specialties</li>
								<li>Mock Exam</li>
								<li>Progress Review</li>
								<li>Option to upgrade</li>
							</ul>
							<div class="price-value">
								<strong><sup>£</sup>00.00</strong>
							</div>
							<form action="{{ route('subscription_non_payalble') }}" method="POST">
					    		@csrf
					    		<input type="hidden" name="plan" value="trail">
					    		<button onclick="return confirm('Are you sure?')" type="submit" class="botton-border">BUY NOW</button>
					    	</form>
							<!-- <div class="price-value">
								<strong><sup>£</sup>00.00</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '6']) }}" class="botton-border">BUY NOW</a> -->
						</div>
					</div>
				</div> <!-- .single_plan end here -->

				<div class="col-lg-4 col-md-6 col-sm-12 single_plan">
					<div class="card">
						<div class="price-header">
							<h3>Refugee Doctors Free</h3>
						</div>
						<div class="price-content">
							<ul>
								<li>3 Months Access
								<li>2000 Q-Bank</li>
								<li>30 Different Specialties</li>
								<li>Unlimited Random Mocks</li>
								<li>Unlimited Manual Mocks</li>
								<li>Progress Review</li>
							</ul>
							<div class="price-value">
								<strong><sup>£</sup>00.00</strong>
							</div>
							<form action="{{ route('subscription_non_payalble') }}" method="POST">
								@csrf
								<input type="hidden" name="plan" value="refugees_doctors">
								<button onclick="return confirm('Are you sure?')" type="submit" class="botton-border">BUY NOW</button>
							</form>
							<!-- <div class="price-value">
								<strong><sup>£</sup>00.00</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '7']) }}" class="botton-border">BUY NOW</a> -->
						</div>
					</div>
				</div> <!-- .single_plan end here -->

				<div class="col-lg-4 col-md-6 col-sm-12 single_plan">
					<div class="card">
						<div class="price-header">
							<h3>Basic</h3>
						</div>
						<div class="price-content">
							<ul>
								<li>1 Months Access
								<li>2000 Q-Bank</li>
								<li>30 Different Specialties</li>
								<li>Unlimited Random Mocks</li>
								<li>Unlimited Manual Mocks</li>
								<li>Progress Review</li>
							</ul>
							<div class="price-value">
								<strong><sup>£</sup>9.99</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '5']) }}" class="botton-border">BUY NOW</a>
						</div>
					</div>
				</div> <!-- .single_plan end here -->
			

				<div class="col-lg-4 col-md-6 col-sm-12 single_plan">
					<div class="card">
						<div class="price-header">
							<h3>Standard </h3>
						</div>
						<div class="price-content">
							<ul>
								<li>3 Months Access</li>
								<li>2000 Q-Bank</li>
								<li>30 Different Specialties</li>
								<li>Unlimited Random Mocks</li>
								<li>Unlimited Manual Mocks</li>
								<li>Recall Exams 2020-2017</li>
							</ul>
							<div class="price-value">
								<strong><sup>£</sup>14.99</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '6']) }}" class="botton-border">BUY NOW</a>
						</div>
					</div>
				</div> <!-- .single_plan end here -->

				<div class="col-lg-4 col-md-6 col-sm-12 single_plan">
					<div class="card">
						<div class="price-header">
							<h3>Advance</h3>
						</div>
						<div class="price-content">
							<ul>
								<li>6 Months Access</li>
								<li>4000 Q-Bank</li>
								<li>30 Different Specialties</li>
								<li>Unlimited Mocks</li>
								<li>Recall Exam 2020-2018</li>
								<li>Access to Notes Bank</li>
							</ul>
							<div class="price-value">
								<strong><sup>£</sup>24.99</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '7']) }}" class="botton-border">BUY NOW</a>
						</div>
					</div>
				</div> <!-- .single_plan end here -->

				<div class="col-lg-4 col-md-6 col-sm-12 single_plan">
					<div class="card">
						<div class="price-header">
							<h3>Professional</h3>
						</div>
						<div class="price-content">
							<ul>
								<li>Advance Plus</li>
								<li>Access to Image Bank</li>
								<li>Access to Video Bank</li>
								<li>Access to Webinar</li>
								<li>Access to Smart Mock</li>
								<li>One to One Session</li>
							</ul>
							<div class="price-value">
								<strong><sup>£</sup>49.99</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '8']) }}" class="botton-border">BUY NOW</a>
						</div>
					</div>
				</div> <!-- .single_plan end here -->
			</div>

        </div>
        @endif




    </div>
    <br>
    	@if(session()->has('success_response'))
			<!-- Modal -->
			<div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
				style="display: block; padding-right: 17px;">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header" style="background: gray">
			        <h5 class="modal-title" id="exampleModalCenterTitle" style="color: #fff">Your Request Response</h5>
			        <button style="color: #fff" type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <h5 class="text-center" style="padding-top: 15px; padding-bottom: 15px">{{ session()->get('success_response') }}</h5>
			      </div>
			      <div class="modal-footer">
			      </div>
			    </div>
			  </div>
			</div>

			<script> 
			    document.getElementById("closeModal").addEventListener("click", function(){ 
			    	let modalX = document.getElementById("exampleModalCenter");
			    	
			    	modalX.classList.remove("show");
			    	modalX.style.display = 'none';
				}); 
		    </script> 
		@endif
@endsection