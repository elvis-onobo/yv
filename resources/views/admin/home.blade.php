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
                    @if(count($projects) > 0)
                    @foreach($projects as $project)
                    <div class="card border-0 rounded-0 m-1 col-md-3 p-0">
                        <img class="card-img-top" src="{{ asset('storage/'.$project->project_picture) }}" alt="img" />

                        <div class="card-body">
                            <span class="card-title">{{ $project->title }}</span>

                            <div class="row">
                                <div class="col-md-4"><span class="card-title">N{{ $project->minimum_investment }}</span></div>
                                <div class="col-md-4"><span class="card-title">ROI {{ $project->returns }}%</span></div>
                                <div class="col-md-4"><span class="card-title">{{ $project->duration }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"><span class="card-title">{{ $project->location }}</span></div>
                                <div class="col-md-4"><span class="card-title">{{ $project->risk }}</span></div>
                            </div>
                            <span class="card-title">{{ $project->partner }}</span>


                            <p class="card-text"></p>
                            <a href="#" class="btn btn-primary">View</a>
                            <a href="#" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-primary">Sold Out</a>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div> 

            </div>
        </div>
    </div>
</div>
@endsection
