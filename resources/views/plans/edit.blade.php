@extends('master')

@section('content')

<section class="section">
    <div class="container">

        <h1 class="title">Edit plan</h1>
        <hr>
        <div class="content">
            <form action="{{ route('plans.update', $plan->id) }}" id="plans-form" @submit.prevent="submitForm" @keyUp="clearError($event.target.name)">
                @include('plans.form')
            </form>
        </div>
    </div>
</section>

<script src="/js/plans.js"></script>

@endsection