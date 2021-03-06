@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
            @foreach($projects as $project)

                <div class="card-header">Details for {{ $project->title }} Project</div>
                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                    <div class="card border-0 rounded-0 p-4 m-0">
                        <div>
                            <a href="{{ route('purchase', ['id' => $project->id ]) }}" class="btn btn-primary rounded-0">Purchase Slot</a>
                        </div>
                        {!! nl2br(e($project->details)) !!}
                    </div>

                </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
