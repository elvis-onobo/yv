@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="">

                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                
                    <div class="card border-0 rounded-0 m-1 col-md-12">
                        @php
                            $amount = $slots * str_replace(',', '', $projects->minimum_investment)
                        @endphp
                        <div class="card-body">
                            
                        <form>
                        <script src="https://js.paystack.co/v1/inline.js"></script>
                        <div id="paystackEmbedContainer"></div>
                        </div>

                        <script>
                        var price =  {!! json_encode($amount, JSON_HEX_TAG)  !!};
                        var price = price * 100;
                        var email = {!! json_encode($user->email, JSON_HEX_TAG)  !!};
                        // metadata
                        var user_id = {!! json_encode($user->id, JSON_HEX_TAG)  !!};
                        var username = {!! json_encode($user->name, JSON_HEX_TAG)  !!};
                        var project_id = {!! json_encode($projects->id, JSON_HEX_TAG)  !!};
                        var tranx_type = 'Deposit';
                        var slots = {!! json_encode($slots, JSON_HEX_TAG)  !!};
                        var duration = {!! json_encode($projects->duration, JSON_HEX_TAG)  !!};
                        var roi = {!! json_encode($projects->returns, JSON_HEX_TAG)  !!};
                        var code = {!! json_encode($projects->code, JSON_HEX_TAG)  !!};

                        PaystackPop.setup({
                            key: 'pk_test_aa9329d3c4b89960b496a2e699d03c4339e8f819',
                            email: email,
                            amount: price,
                            metadata: {
                                user: user_id,
                                project: project_id,
                                tranx: tranx_type,
                                amount: price,
                                slot: slots,
                                duration: duration,
                                roi: roi,
                                code: code
                            },
                            customer: {
                                first_name: username
                            },
                            container: 'paystackEmbedContainer',
                            callback: function(response){
                                    //alert('successfully subscribed. transaction ref is ' + response.reference);
                                    
                                    //redirect to verify url
                                    window.location.href= '/youvest/public/verify/'+response.reference;

                                    //get the base path
                                    //var path = window.location.origin+window.location.pathname;

                                    //redirect to the verification url
                                    //window.location.href = path+'/verify/'+response.reference;
                                },
                        });
                        </script>

                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#"  >Terms and Conditions Apply</a> 
                    </div>
                    

                </div> 

            </div>
        </div>
    </div>
</div>
@endsection


