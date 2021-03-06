@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Project') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store-project') }}" enctype="multipart/form-data">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror rounded-0" name="title"  value="{{ old('title') }}"  autocomplete="title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('category') is-invalid @enderror rounded-0" name="category"  value="{{ old('category') }}"  autocomplete="category">
                                    <option value="">Select Project Category</option>
                                
                                @foreach($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="returns" class="col-md-4 col-form-label text-md-right">{{ __('Returns') }}</label>

                            <div class="col-md-6">
                                <input id="returns" type="text" class="form-control rounded-0" name="returns"  value="{{ old('returns') }}" >
                            </div>

                            @error('returns')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="text" class="form-control rounded-0" name="duration"  value="{{ old('duration') }}" >
                            </div>
                            @error('duration')
                                <span class="invalid-feedback" role="alert">duration
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control rounded-0" name="location"  value="{{ old('location') }}">
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
                                <input id="minimum" type="text" class="form-control rounded-0" name="minimum"  value="{{ old('minimum') }}" placeholder="Minimum amount allowed">
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
                                <input id="risk" type="text" class="form-control rounded-0" name="risk"  value="{{ old('risk') }}" placeholder="Risk Level">
                            </div>
                            @error('risk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="partner" class="col-md-4 col-form-label text-md-right">{{ __('Partner') }}</label>

                            <div class="col-md-6">
                                <input id="partner" type="text" class="form-control rounded-0" name="partner"  value="{{ old('partner') }}" placeholder="Risk Level">
                            </div>
                            @error('partner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="charge" class="col-md-4 col-form-label text-md-right">{{ __('charge') }}</label>

                            <div class="col-md-6">
                                <input id="charge" type="text" class="form-control rounded-0" name="charge"  value="{{ old('charge') }}" placeholder="Our charges in %" rows="5">
                            </div>
                            @error('charge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('Details') }}</label>

                            <div class="col-md-6">
                                <textarea id="details" type="text" class="form-control rounded-0" name="details"  value="{{ old('details') }}" placeholder="Everything the person should know about the project" rows="5"></textarea>
                            </div>
                            @error('details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>

                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control rounded-0" name="picture"  value="{{ old('picture') }}" accept="image/*">
                            </div>
                            @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary rounded-0">
                                    {{ __('Save Project') }}
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
