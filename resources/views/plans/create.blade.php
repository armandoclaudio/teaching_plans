@extends('master')

@section('content')

<section class="section">
    <div class="container">

        <h1 class="title">Create a plan</h1>
        <hr>
        <div class="content">
            <form action="{{ route('plans.store') }}" id="plans-form" @submit.prevent="submitForm" @keyUp="clearError($event.target.name)">
                @include('plans.form')
            </form>
        </div>
    </div>
</section>

<script src="/js/plans.js"></script>

@endsection