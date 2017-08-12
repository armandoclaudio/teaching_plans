@extends('master')

@section('content')
<section class="section">
    <div class="container">

        <h1 class="title">Register</h1>
        <hr>
        <div class="content">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input
                            class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                            type="text"
                            name="name"
                            value="{{ old('name') }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">Class</label>
                    <div class="control">
                        <input
                            class="input{{ $errors->has('class') ? ' is-danger' : '' }}"
                            type="text"
                            name="class"
                            value="{{ old('class') }}" required autofocus>
                    </div>
                    @if ($errors->has('class'))
                        <p class="help is-danger">{{ $errors->first('class') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input
                            class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                            type="email"
                            name="email"
                            value="{{ old('email') }}" required>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input
                            class="input{{ $errors->has('password') ? ' is-danger' : '' }}"
                            type="password"
                            name="password"
                            required>
                    </div>
                    @if ($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label">Confirm Password</label>
                    <div class="control">
                        <input
                            class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}"
                            type="password"
                            name="password_confirmation"
                            required>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button is-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
