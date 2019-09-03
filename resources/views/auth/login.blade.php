@extends('layouts.app')

@section('content')
@if(isset(Auth::user()->email))
    <h2>You are login for email : {{Auth::user()->email}}</h2>
    <a href="{{url('/admin')}}" class="change-color-a"><h3>Go to Admin dashboard <i class="fa fa-home" aria-hidden="true"></i></h3></a>
@else
    
            <div class="limiter" style="margin-top: -22px">
                <div class="container-login100" style="background-image: url('image/bg-01.jpg');"> 
                    <div class="wrap-login100 p-t-30 p-b-50">
                        <span class="login100-form-title p-b-41">
                            Account Login
                        </span>
                    <form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}


                        <div class="wrap-input100 validate-input" data-validate = "Enter username">

                                <input id="email" type="email" class="input100" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autofocus>
                                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="wrap-input100 validate-input" data-validate = "Enter password">

                                   <input id="password" type="password" class="input100" name="password" placeholder="Enter Password" required>
                                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="container-login100-form-btn m-t-32">
                                <button type="submit" class="login100-form-btn">
                                    Login
                                </button>
                                <a href="{{url('auth/google')}}" class="login100-form-btn">Login Google</a>
                            </div>
            
                    </form>
                </div>
            </div>
            </div>
@endif

@endsection
