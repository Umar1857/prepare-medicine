<style type="text/css">
	.StripeElement {
	  box-sizing: border-box;

	  height: 40px;

	  padding: 10px 12px;

	  border: 1px solid transparent;
	  border-radius: 4px;
	  background-color: white;

	  box-shadow: 0 1px 3px 0 #e6ebf1;
	  -webkit-transition: box-shadow 150ms ease;
	  transition: box-shadow 150ms ease;
	}

	.StripeElement--focus {
	  box-shadow: 0 1px 3px 0 #cfd7df;
	}

	.StripeElement--invalid {
	  border-color: #fa755a;
	}

	.StripeElement--webkit-autofill {
	  background-color: #fefde5 !important;
	}


	/*custome css*/
	.checkoutForm_devR{
	    width: 60%;
	    margin: 5% auto;
	    background: #ddd;
	    padding: 5px 25px 40px 25px;
	    box-sizing: border-box;
	    border: 1px solid #999;
	    border-radius: 3px;
	    box-shadow: 0px 2px 7px 2px #555;
    }
    .checkoutForm_devR table{
    	text-align: left !important;
    	margin-bottom: 20px !important;
    }
    .checkoutForm_devR table tr{

    }
    .checkoutForm_devR table tr th,
    .checkoutForm_devR table tr td{
    	font-size: 20px !important;
    	color: #555 !important;
    	padding: 3px 15px !important
    }
    .card-element{
    	font-size: 20px !important
    }
    .payNowBtn{
    	background: #63BA52 !important;
	    padding: 10px 15px !important;
	    color: #fff !important;
	    font-weight: bold !important;
	    border: 1px solid #ddd !important;
	    margin-top: 10px !important;
	    border-radius: 2px;
	    cursor: pointer;
    }
    .payNowBtn:hover{
    	background-color: darkgreen;
    	transform: scale(1.1);
    	box-shadow: 0px 0px 6px 2px #444;
    	border: none !important;
    	transition: .5s
    }
    .cancel_payment{
    	background: red !important;
	    padding: 9px 15px !important;
	    color: #fff !important;
	    font-weight: bold !important;
	    border: none;
	    margin-top: 10px !important;
	    margin-left: 5px !important;
	    border-radius: 2px;
	    text-decoration: none;
	    float: right;
    }

    .checkout_h{
    	font-size: 25px;
    	color: #222;

    }
    .img{
    	border-bottom: 2px solid gray;
    	margin-bottom: 15px;
	    padding-bottom: 10px;
    }
    .img img{
    	width: 50%;
    }
    @media screen and (max-width: 767px) {
	  .checkoutForm_devR{
	  	width: 95% !important
	  }
	}
</style>



<script src="https://js.stripe.com/v3/"></script>

<form class="checkoutForm_devR" action="{{ route('stripe.paynow') }}" method="post" id="payment-form">
  @csrf
  <input type="hidden" name="plan" value="{{ $plan }}">

  <div class="row">
  	<div class="col-md-12">
  		<h3 class="checkout_h">Checkout</h3>
  		<div class="img">
  			<img src="{{ asset('frontend/images/logo/logo-3.png') }}">
  		</div>
  		
  		<table>
  			<tr>
  				<th>Course</th>
  				<td>{{ $coursrName }}</td>
  			</tr>
  			<tr>
  				<th>Plan</th>
  				<td>
  					@if($plan == 5)
  					 	{{ 'Basic' }}
  					@elseif($plan == 6)
  						{{ 'Standard' }}
  					@elseif($plan == 7)
  						{{ 'Advance' }}
  					@elseif($plan == 8)
  						{{ 'Professional' }}
  					@else
  						{{ 'Something Wrong' }}
  					@endif
  				</td>
  			</tr>
  			<tr>
  				<th>Subscription Charge</th>
  				<td>
  					@if($plan == 5)
  					 	{{ '£10' }}
  					@elseif($plan == 6)
  						{{ '£15' }}
  					@elseif($plan == 7)
  						{{ '£30' }}
  					@elseif($plan == 8)
  						{{ '£50' }}
  					@else
  						{{ 'Something Wrong' }}
  					@endif
  				</td>
  			</tr>
  		</table>
  	</div>
  </div>
  <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <br>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>
    <br>
    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button class="payNowBtn">PAY NOW</button>
  <a onclick="return confirm('Are you sure?')" href="{{ route('root_page') }}" class="cancel_payment">Exit</a>
</form>







<script type="text/javascript">
	// Create a Stripe client.
var stripe = Stripe('pk_live_fmBNkMSnRqsgDpehKhbvH8db00C3u6uvj3');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {hidePostalCode: true}, {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

</script>