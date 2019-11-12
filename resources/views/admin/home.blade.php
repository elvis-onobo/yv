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
                    
                    <div class="col-md-3 card border-0 rounded-0 m-1 p-2  bg-danger text-white">
                        <div class="col-md-12">
                            <div class="col-md-4"><i class="ico icon-user icon-5x"></i></div>
                            <div class="col-md-8">
                                <p>Current Investment</p>
                                12345
                            </div>    
                        </div>


                    </div>

                    <div class="col-md-3 card card border-0 rounded-0 m-1 p-2  bg-primary text-white">
                        <p>Expected Returns</p>
                        12345
                    </div>

                    <div class="col-md-3 card card border-0 rounded-0 m-1 p-2  bg-success text-white">
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
                            <span class="card-title"><strong>{{ ucwords($project->title) }}</strong></span>
                            <div class="small">Returns {{ ucwords($project->returns) }}% in {{ $project->duration }} months</div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6"><span class="small">&#8358;{{ ucwords($project->minimum_investment) }} Per Unit</span></div>
                                <div class="col-md-6 col-sm-6"><span class="small">Located In {{ ucwords($project->location) }}</span></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-7 col-sm-8"><span class="small">{{ ucwords($project->partner) }}</span></div>
                                <div class="col-md-5 col-sm-4"><span class="small">{{ ucwords($project->risk) }} Risk</span></div>
                            </div>

                            


                            <p class="card-text"></p>
                            <a href="#" class="btn btn-primary rounded-0">View</a>
                            <a href="#" class="btn btn-primary rounded-0">Edit</a>
                            <a href="#" class="btn btn-primary rounded-0">Sold Out</a>
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
