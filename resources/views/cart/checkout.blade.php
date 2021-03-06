@extends('layouts.app')

@section('title')
    Checkout
@endsection
@section('class')
    container
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="panel panel-default  text-center">
            <div class="panel-heading">
                <h3 class="panel-heading">Total: RM{{$total}}</h3>
            </div>
            <div class="panel-body">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                    <div class='col-md-12 hide error form-group'>
                        <div class='alert-danger alert'>Reminder: Please fix the errors before you begin.</div>
                    </div>

                <form role="form" action="{{ url('checkout') }}" method="post" class="validation"
                                                 data-cc-on-file="false"
                                                data-stripe-publishable-key="pk_test_51HFVGNCFq6SzGxX2zzStHtD9N673SVQ5nUqVXeHivLn454y1GZCyOLY6UGIMkzsvhje3XRSgnZlGJ1MEu0OBWBkH00KOxIOjIg"
                                                id="payment-form">
                    {{ csrf_field() }}

                    <div class='form-group'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Address</label> <input
                                class='form-control' type='text' name="address">
                        </div>
                    </div>
                    <div class='form-group'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label> <input
                                class='form-control' type='text'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label> <input
                                autocomplete='off' class='form-control card-num' maxlength='20'
                                type='text' value="4242424242424242">
                        </div>
                    </div>

                    <div class='form-group row'>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' maxlength='2'
                                type='text' value="12">
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' maxlength='4'
                                type='text' value="2024">
                        </div>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> 
                            <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' maxlength='4'
                                type='text' value="123">
                        </div>
                    </div>

                        <div class="col-xs-12">
                            <button class="btn btn-success btn-lg btn-block" type="submit">Pay Now</button>
                        </div>
                      
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
{{-- <script src="https://js.stripe.com/v3/"></script> --}}
{{-- <script src="{{ asset('js/checkout.js')}}"></script> --}}
<script type="text/javascript">
    $(function() {
        var $form         = $(".validation");
      $('form.validation').bind('submit', function(e) {
        var $form         = $(".validation"),
            inputVal = ['input[type=email]', 'input[type=password]',
                             'input[type=text]', 'input[type=file]',
                             'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputVal),
            $errorStatus = $form.find('div.error'),
            valid         = true;
            $errorStatus.addClass('hide');
     
            $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorStatus.removeClass('hide');
            e.preventDefault();
          }
        });
      
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-num').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeHandleResponse);
        }
      
      });
      
      function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
      
    });
    </script>
@endsection