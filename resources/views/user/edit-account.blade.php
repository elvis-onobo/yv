@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-account') }}">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $account->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="acc_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="acc_number" type="number" class="form-control @error('phone') is-invalid @enderror" name="acc_number" value="{{  $account->acc_number }}" required autocomplete="acc_number">

                                @error('acc_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank" class="col-md-4 col-form-label text-md-right">{{ __('Bank') }}</label>

                            <div class="col-md-6">
                                <select id="bank" type="text" class="form-control" name="bank"  required>
                                
                                <option value="{{ $account->bank }}">{{ $account->bank_name }}"</option>
                                    @for($i=0; $i< count($data['data']); $i++)
                                        <option value="{{ $data['data'][$i]['code'] }}">{{ $data['data'][$i]['name'] }}</option>
                                    @endfor
                                </select>

                                @error('bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Account') }}
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
