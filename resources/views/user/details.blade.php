@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                <div class="card-header">Details for {{ $project->title }}</div>
                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                
                    @foreach($users as $user)
                    <div class="row justify-content-center p-2">
                        <div class="col-md-3 card border-0 rounded-0 p-0 m-0">

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
