@extends('frontend.master-frontend')
@section('js-css')

    <style>
    	.heading{
		    margin-bottom: 70px;
		    border-bottom: 1px solid #ddd;
		    padding-bottom: 10px;
		    text-align: center;
		    text-transform: uppercase;
    	}
    	.thankYou{
    		background-color: green;
    		color: #fff;
    		font-weight: bold;
    		text-transform: uppercase;
    		text-align: center;
    		padding: 15px 10px;
    	}
    </style>

@endsection


@section('content')
    <br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Current Status</p>
            </div>
        </div>
        
        <h4 class="heading">Status</h4>

        <div class="row">
        	<div class="col-md-3"></div>
        	@if($statusID == 1)
        	<div class="col-md-6">
        		<table class="table">
        			<tr>
        				<th>Payment Status</th>
        				<td style="color: darkred">Not Paid</td>
        			</tr>
        			<tr>
        				<th>General Status</th>
        				<td style="color: #666">Unknown Error</td>
        			</tr>
        			<tr>
        				<td colspan="2">WE Are Really Sorry!! Please try agian later.</td>
        			</tr>
        		</table>
        	</div>
        	@elseif($statusID == 2)
        	<div class="col-md-6">
        		<h5 class="thankYou">Thank You</h5>
        		<table class="table">
        			<tr>
        				<th>Payment Status</th>
        				<td style="color: green">Paid Successfully</td>
        			</tr>
        			<tr>
        				<th>Amount</th>
        				<td>£{{ Auth::user()->amount_paid }}</td>
        			</tr>
        			<tr>
        				<th>Your ID</th>
        				<td>{{ Auth::user()->customer_id }}</td>
        			</tr>
        			<tr>
        				<th>Subscription Plan</th>
        				<td>
        					@if(Auth::user()->role == 5)
        					{{ 'Basic' }}
        					@elseif(Auth::user()->role == 6)
        					{{ 'Standard' }}
        					@elseif(Auth::user()->role == 7)
        					{{ 'Advance' }}
        					@elseif(Auth::user()->role == 8)
        					{{ 'Professional' }}
        					@else
        					{{ 'Something Wrong' }}
        					@endif
        				</td>
        			</tr>
        			<tr>
        				<th>Subscription Expired Date</th>
        				<td>
        					{{ Auth::user()->expeir_date }}
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2">
        					Thanks a lot to subscribe
        					<br>
        					<span style="color: red">N.B Please keep you ID safe to any inquiry about your payment or plan.</span>
        				</td>
        			</tr>
        		</table>
        	</div>

        	@elseif($statusID == 3)
        	<div class="col-md-6">
        		<table class="table">
        			<tr>
        				<th>Payment Status</th>
        				<td style="color: darkred">Fail</td>
        			</tr>
        			<tr>
        				<th>General Status</th>
        				<td style="color: #666">Something wrong or invalid card information</td>
        			</tr>
        			<tr>
        				<td colspan="2">WE Are Really Sorry!! Please try agian later.</td>
        			</tr>
        		</table>
        	</div>
        	@else

        	<h4 style="color: red;">{{ 'Invalid Access' }}</h4>

        	@endif

        	<div class="col-md-3"></div>
        </div>
    </div>
    <br>
@endsection