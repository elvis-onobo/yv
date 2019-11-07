@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                <!-- <div class="card-header">Dashboard</div> -->
                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                
                    @foreach($users as $user)
                    <div class="row justify-content-center p-2">
                            <div class="col-md-3 card border-0 rounded-0 p-0 m-0">
                                <img class="card-img-top" src="{{ asset('storage/'.$user->picture) }}" alt="{{ $user->name }} profile picture" />                        
                            </div>
                            <div class="col-md-3 card border-0 rounded-0 p-2 m-0">
                                <h5>Profile Details</h5>
                                <span class="fa fa-user"> {{ $user->name }}</span>
                                <span>{{ $user->dob }}</span>
                                <span>{{ $user->gender }}</span>
                                <span>{{ $user->phone }}</span>
                                <span>{{ $user->address }}</span>
                                <span>{{ $user->nationality }}</span>
                                <span><a href="{{ route('edit-profile') }}">Edit Profile</a></span>
                            </div>
                            <div class="col-md-3 card border-0 rounded-0 p-2 m-0">
                            @foreach($accounts as $account)
                                <div>
                                    <h5>Account Details</h5>
                                    <span class="fa fa-user"> {{ $account->username }}</span>
                                    <span>{{ $account->acc_number }}</span>
                                    <span>{{ $account->bank }}</span>
                                    <span><a href="{{ route('edit-account') }}">Update Account</a></span>
                                </div>
                            @endforeach
                                <hr />
                                <div>
                                <h5>Next of Kin</h5>
                                @foreach($kins as $kin)                            
                                <span>{{ $kin->name_kin }}</span>
                                <span>{{ $kin->phone_kin }}</span>
                                <span>{{ $kin->relationship }}</span>
                                <span>{{ $kin->address_kin }}</span>
                                <span>{{ $kin->email_kin }}</span>
                                <span><a href="{{ route('edit-kin') }}">Update Kin</a></span>
                                @endforeach

                                </div>
                            </div>
                    </div>
                    @endforeach
                

                <div class="row justify-content-center">
                    
                    <div class="col-md-3 card border-0 rounded-0 m-1 p-2 current">
                        <div class="col-md-12">
                            <div class="col-md-4"><i class="ico icon-user icon-5x"></i></div>
                            <div class="col-md-8">
                                <p>Current Investment</p>
                                12345
                            </div>    
                        </div>


                    </div>

                    <div class="col-md-3 card card border-0 rounded-0 m-1 p-2 expected">
                        <p>Expected Returns</p>
                        12345
                    </div>

                    <div class="col-md-3 card card border-0 rounded-0 m-1 p-2 total">
                        <p>Number of Investments</p>
                        12345
                    </div>
                </div>


                 <div class="row justify-content-center">                
                                            
                    <div class="card border-0 rounded-0 m-1 col-md-3 p-0">
                            <img class="card-img-top" src="{{ URL::to('/') }}/img/dummies/works/1.jpg" alt="img" />

                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>

                                <p class="card-text">Some text</p>
                                <a href="#" class="btn btn-primary">See more</a>
                            </div>
                    </div>

                    <div class="card border-0 rounded-0 m-1 col-md-3 p-0">
                            <img class="card-img-top" src="{{ URL::to('/') }}/img/dummies/works/1.jpg" alt="img" />

                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>

                                <p class="card-text">Some text</p>
                                <a href="#" class="btn btn-primary">See more</a>
                            </div>
                    </div>

                    <div class="card border-0 rounded-0 m-1 col-md-3 p-0">
                            <img class="card-img-top" src="{{ URL::to('/') }}/img/dummies/works/1.jpg" alt="img" />

                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>

                                <p class="card-text">Some text</p>
                                <a href="#" class="btn btn-primary">See more</a>
                            </div>
                    </div>

                </div> 

            </div>
        </div>
    </div>
</div>
@endsection
