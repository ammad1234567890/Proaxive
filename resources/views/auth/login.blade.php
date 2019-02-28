@extends('layouts.authLayout')

@section('content')
    <div class="am-signin-wrapper">
        <div class="am-signin-box">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div>

                        <img src="{{asset('img/logo_final.png')}}" />

                        <p>Proaxive Sdn. Bhd.</p>
                        <p>Your one stop solution to all of your HR
                            needs in Malaysia and Far East</p>


                    </div>
                </div>
                <div class="col-lg-7">
                    <h5 class="tx-gray-800 mg-b-25">Signin to your account</h5>
                    <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <div class="form-group">
                            <label class="form-control-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter your email address" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                        </div><!-- form-group -->

                        <div class="form-group">
                            <label class="form-control-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div><!-- form-group -->

                        <div class="form-group mg-b-20">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif




                        </div>

                        <button type="submit" class="btn btn-block cursorpointer">Sign In</button>
                    </form>
                </div><!-- col-7 -->
            </div><!-- row -->
            <p class="tx-center tx-white-5 tx-12 mg-t-15">Copyright &copy; 2019. All Rights Reserved. Proaxive</p>
        </div><!-- signin-box -->
    </div><!-- am-signin-wrapper -->

@endsection
