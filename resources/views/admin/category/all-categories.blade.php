@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                
                <a href="{{ route('edit-category', [ 'id' => $cat->id ]) }}" class="btn btn-primary rounded-0" >{{ $cat->category }}</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
