@if(count($errors) >0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-danger"> {{ $error }}</li>
        @endforeach
    </ul>
@endif

@if(session('status'))
    <ul>
        <li class="text-danger"> {{ session('status') }}</li>
    </ul>
@endif


<form method="POST" action="{{route('auth')}}">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="name" name="username" value="{{ old('username') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit" name="submit-auth-form" value="login">Login</button>
        <button type="submit" name="submit-auth-form" value="register">Register</button>
    </div>
</form>
