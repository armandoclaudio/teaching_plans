@extends('master')

@section('content')
    
<style>
.no-padding {
    padding:0;
}

.no-border-radius {
    border-radius:0
}
</style>

<section class="section">
    <div class="container">
        
        <h1 class="title">Create a standard</h1>
        <hr>
        <div class="content">
            <form action="{{ route('standards.store') }}" id="standards-form" @submit.prevent="submitForm" @keyUp="clearError($event.target.name)">
                @include('standards.form')
            </form>
        </div>
    </div>
</section>

<script src="/js/standards.js"></script>

@endsection