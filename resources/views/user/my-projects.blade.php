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

                 <div class="row justify-content-center">                                                            
                 @if(count($projects) > 0)
                    @foreach($projects as $project)
                    <div class="card border-0 rounded-0 m-1 col-md-3 p-0">
                        <img class="card-img-top" src="{{ asset('storage/'.$project->project_picture) }}" alt="img" />

                        <div class="card-body">
                            <span class="card-title"><strong>{{ ucwords($project->title) }}</strong></span>
                            <div class="small">Returns {{ ucwords($project->returns) }}% in {{ $project->duration }} months</div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6"><span class="small">&#8358;{{ ucwords($project->minimum_investment) }} Per Slot</span></div>
                                <div class="col-md-6 col-sm-6"><span class="small">Located In {{ ucwords($project->location) }}</span></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-7 col-sm-8"><span class="small">{{ ucwords($project->partner) }}</span></div>
                                <div class="col-md-5 col-sm-4"><span class="small">{{ ucwords($project->risk) }} Risk</span></div>
                            </div>
                            
                            <p class="card-text"></p>
                            <a href="{{ route('purchase', ['id' => $project->id ]) }}" class="btn btn-primary rounded-0">Purchase Slot</a>
                            <a href="{{ route('details', ['id' => $project->id ]) }}" class="btn btn-primary rounded-0">Details</a>
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
