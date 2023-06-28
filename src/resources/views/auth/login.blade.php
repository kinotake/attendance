@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="header">
                <h1 class="app_header">Atte</h1>
            <div>
            <div class="card">
                <div class="card-header">{{ __('ログイン') }}</div>
                <p class="error">{{$message??''}}</p>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"></label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="メールアドレス">
                            

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                placeholder="パスワード">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn-primary">
                                    {{ __('ログイン') }}
                                </button>

                                
                            </div>
                        </div>
                        <div class="infomation">
                        <span>アカウントをお持ちでない方はこちらから</span>
                        <div>
                        <a href="/register">会員登録</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
             <div class="end">
                <h3 class="end_content">Atte,inc.</h3>
            </div>
        </div>
    </div>
</div>
@endsection
