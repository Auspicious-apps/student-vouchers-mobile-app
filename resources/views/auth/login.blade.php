@extends('layouts.app')

@section('content')
<!-- <div class="container"> -->
    


         <div class="login-main-outer">
             <h2>Welcome Back</h2>
             <p>Sign in to continue</p>
            <div class="login-main-inner" >
                <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-feild">
                  <!--   <input type="Email" placeholder="Email"> -->
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-feild">
                   <!--  <input id="password-field" type="password" class="" name="password" value="secret" placeholder="Password"> -->
                     <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Password">
                    <span toggle="#password-field" class=" toggle-password" id="icon">
                        <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.7596 4.83271C14.0801 5.23129 14.0801 5.76936 13.7596 6.16729C12.7501 7.42021 10.3279 10 7.5001 10C4.67227 10 2.25015 7.42021 1.24059 6.16729C1.08465 5.97644 1 5.74166 1 5.5C1 5.25834 1.08465 5.02356 1.24059 4.83271C2.25015 3.57979 4.67227 1 7.5001 1C10.3279 1 12.7501 3.57979 13.7596 4.83271V4.83271Z" stroke="#35414B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.50026 7.42843C8.62061 7.42843 9.52883 6.56498 9.52883 5.49986C9.52883 4.43474 8.62061 3.57129 7.50026 3.57129C6.3799 3.57129 5.47168 4.43474 5.47168 5.49986C5.47168 6.56498 6.3799 7.42843 7.50026 7.42843Z" stroke="#35414B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> 
                    </span>
                     @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div> 
              
                  
                  <div class="subscription-form-item-btn">
                      <!--  <input type="submit" value="Sign in"> -->
                      <button type="submit" >
                                    {{ __('Sign in') }}
                                </button>
                    </div>
               </form> 

            </div>
         </div>



<!-- </div> -->
@endsection
