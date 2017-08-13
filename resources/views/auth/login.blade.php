@extends('master')

@section('content')
<section class="section">
    <div class="container">

        <div class="content">
            <div class="columns is-desktop">
                <div class="column is-8 is-offset-2">
                    <h1 class="title">Login</h1>

                    <hr>

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input
                                    class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input" type="password" name="password" required>
                            </div>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
