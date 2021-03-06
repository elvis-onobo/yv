@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Project') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store-project', [ 'id' => $project->id ]) }}" enctype="multipart/form-data">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="number" class="form-control @error('title') is-invalid @enderror" name="title"  value="{{ old('title', $project->title) }}"  autocomplete="title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="returns" class="col-md-4 col-form-label text-md-right">{{ __('Returns') }}</label>

                            <div class="col-md-6">
                                <input id="returns" type="date" class="form-control" name="returns"  value="{{ old('returns', $profile->returns) }}" >
                            </div>
                            @error('returns')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="text" class="form-control" name="duration"  value="{{ old('duration', $project->duration) }}" >
                            </div>
                            @error('duration')
                                <span class="invalid-feedback" role="alert">duration
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location"  value="{{ old('location', $project->location) }}">
                            </div>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="minimum" class="col-md-4 col-form-label text-md-right">{{ __('Minimum') }}</label>

                            <div class="col-md-6">
                                <input id="minimum" type="text" class="form-control" name="minimum"  value="{{ old('minimum', $project->minimum) }}" placeholder="Minimum amount allowed">
                            </div>
                            @error('minimum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="risk" class="col-md-4 col-form-label text-md-right">{{ __('Risk') }}</label>

                            <div class="col-md-6">
                                <input id="risk" type="text" class="form-control" name="risk"  value="{{ old('risk', $project->risk) }}" placeholder="Risk Level">
                            </div>
                            @error('risk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>

                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control" name="risk"  value="{{ old('picture', $projects->picture) }}" accept="image/*">
                            </div>
                            @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Project') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
