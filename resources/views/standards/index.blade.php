@extends('master')

@section('content')

<section class="section">
    <div class="container">

        <h1 class="title">
            <div class="columns is-mobile">
                <div class="column">Standards</div>
                <div class="column is-narrow">
                    <a class="button is-primary is-small align-bottom" href="{{ route('standards.create') }}">Create a standard</a>
                </div>
            </div>
        </h1>
        <hr>
        <div class="content">
            @foreach ($standards as $standard)

                <p><a href="{{ route('standards.edit', $standard->id) }}">{{ $standard->description }}</a></p>

            @endforeach
        </div>
    </div>
</section>

@endsection