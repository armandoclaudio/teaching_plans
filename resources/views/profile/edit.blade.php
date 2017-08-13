@extends('master')

@section('content')
<section class="section">
    <div class="container">

        <div class="content">
            <div class="columns is-desktop">
                <div class="column is-8 is-offset-2">

                    <h1 class="title">Profile</h1>

                    <hr>

                    <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input
                                    class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}" required autofocus>
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
                                    value="{{ old('class', $user->class) }}" required>
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
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            @if ($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
