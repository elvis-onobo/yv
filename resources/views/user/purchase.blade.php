@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">

                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                
                    @foreach($projects as $project)
                
                        <div class="row justify-content-center p-2">
                            <div class="col-md-5 card rounded-0 p-2 m-0 text-center">
                                <div class="card-header"><h5>{{ ucwords($project->title) }} Project<h5></div>
                                    <p>Each Slot Costs &#8358;{{ $project->minimum_investment }} </p>
                                    
                                    <form method="POST" action="{{ route('login') }}">

                                    <div class="form-group row">
                                    @csrf

                                        <label for="slots" class="col-md-4 col-form-label text-md-right">{{ __('Slots') }}</label>

                                        <div class="col-md-6">
                                            <input id="slots" type="number" class="form-control @error('slots') is-invalid @enderror" name="slots" value="{{ old('slots') }}" required autocomplete="number" placeholder="Number Of Slots To Buy" autofocus>

                                            @error('slots')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 justify-content-center">
                                            <button type="submit" class="btn btn-primary rounded-0">
                                                {{ __('Buy Slots') }}
                                            </button>
                                            </div>
                                        </div>

                                    <form>

                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#"  >Terms and Conditions </a>
                        </div>
                    @endforeach
                    

                </div> 

            </div>
        </div>
    </div>
</div>
@endsection
