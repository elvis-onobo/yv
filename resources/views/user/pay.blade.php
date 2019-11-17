@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="">

                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                
                    <div class="card border-0 rounded-0 m-1 col-md-12 p-0">
                        <img class="card-img-top" src="{{ asset('storage/'.$project->project_picture) }}" alt="img" />

                        <div class="card-body">
                            <span class="card-title"><strong>{{ ucwords($project->title) }}</strong></span>
                            <div class="small">Returns {{ ucwords($project->returns) }}% in {{ $project->duration }} months</div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6"><span class="small">&#8358;{{ ucwords($project->minimum_investment) }} Per Slot</span></div>
                            </div>
                            
                            <form >
                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                <button type="button" onclick="payWithPaystack()"> Pay </button>
                            </form>
                            <script>
                                function payWithPaystack(){
                                    var handler = PaystackPop.setup({
                                        key: 'pk_test_86d32aa1nV4l1da7120ce530f0b221c3cb97cbcc',
                                        email: 'customer@email.com',
                                        amount: 10000,
                                        currency: "NGN",
                                        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference.
                                        firstname: 'Stephen',
                                        lastname: 'King',
                                        // label: "Optional string that replaces customer email"
                                        metadata: {
                                        custom_fields: [
                                            {
                                                display_name: "Mobile Number",
                                                variable_name: "mobile_number",
                                                value: "+2348012345678"
                                            }
                                        ]},
                                        callback: function(response){
                                        alert('success. transaction ref is ' + response.reference);
                                        },
                                        onClose: function(){
                                        alert('window closed');
                                        }
                                });
                                handler.openIframe();
                                }
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


