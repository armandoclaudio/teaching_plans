@extends('master')

@section('content')

<section class="section">
    <div class="container">
        
        <h1 class="title">
            <div class="columns">
                <div class="column">Standards</div>
                <div class="column has-text-right title is-5" style="margin-top:auto">
                    <a href="{{ route('standards.create') }}">Create a new standard</a>
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