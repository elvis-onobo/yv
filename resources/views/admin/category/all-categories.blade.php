@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <a href="{{ route('create-category') }}"  class="btn btn-primary  rounded-0 col-md-4 mb-1">{{ __('Create Category') }}</a>

            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                @foreach($cats as $cat)
                <a href="{{ route('edit-category', [ 'id' => $cat->id ]) }}" class="btn btn-primary rounded-0" >{{ $cat->category }}</a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
