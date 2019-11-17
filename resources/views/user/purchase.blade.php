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

                
                    @foreach($projects as $project)
                    <div class="card border-0 rounded-0 m-1 col-md-12 p-0">
                        <img class="card-img-top" src="{{ asset('storage/'.$project->project_picture) }}" alt="img" />

                        <div class="card-body">
                            <span class="card-title"><strong>{{ ucwords($project->title) }}</strong></span>
                            <div class="small">Returns {{ ucwords($project->returns) }}% in {{ $project->duration }} months</div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6"><span class="small">&#8358;{{ ucwords($project->minimum_investment) }} Per Slot</span></div>
                            </div>
                            
                            <form method="POST" action="{{ route('pay', ['price'=> $project->minimum_investment ]) }}">
                            
                            <div class="form-group row mt-1">
                            @csrf
                                <div class="col-md-6">
                                    <input id="slots" type="number" class="" name="slots" value="{{ old('slots') }}" required autocomplete="number" placeholder="Number Of Slots To Buy" autofocus>

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
                                    {{ __('Purchase Slot') }}
                                </button>
                                </div>
                            </div>

                            <form>

                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#"  >Terms and Conditions Apply</a> 
                    </div>
                    @endforeach
                    

                </div> 

            </div>
        </div>
    </div>
</div>
@endsection
