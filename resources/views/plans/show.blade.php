@extends('master')

@section('content')

<section class="section">
    <div class="container">

        <div class="columns">
            <div class="column"><h1 class="title is-5">Caguas Learning Academy</h1></div>
            <div class="column is-narrow"><h1 class="title is-5">{{ Auth::user()->class }} class</h1></div>
        </div>

        <div class="columns">
            <div class="column">Teacher: {{ Auth::user()->name }}</div>
            <div class="column is-narrow">Grade: {{ $plan->grade }}</div>
            <div class="column has-text-right is-hidden-mobile">{{ $plan->formatted_date_from }} - {{ $plan->formatted_date_to }}</div>
            <div class="column is-hidden-tablet">{{ $plan->formatted_date_from }} - {{ $plan->formatted_date_to }}</div>
        </div>

        <hr>

        <h1 class="title is-4">{{ $plan->title }}</h1>

        <hr>

        <div class="content">

            <div class="avoid-break-inside">

                <h3 class="title is-5">Standards</h3>

                <ul>
                    @foreach($plan->standards as $standard)
                        <li>{{ $standard }}</li>
                    @endforeach
                </ul>

            </div>

            <hr>

            <div class="avoid-break-inside">
                <div class="columns">
                    <div class="column">
                        <h3 class="title is-5">Expectations</h3>
                        <ul>
                            @foreach($plan->expectations as $expectation)
                                <li>{{ $expectation }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="column">
                        <h3 class="title is-5">Essential Questions</h3>
                        <ol>
                            @foreach($plan->essential_questions as $essential_question)
                                <li>{{ $essential_question }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <hr>

            <div class="avoid-break-inside">
                <h3 class="title is-5">Objectives</h3>

                <ol>
                    @foreach($plan->objectives as $objective)
                        <li>{{ $objective }}</li>
                    @endforeach
                </ol>
            </div>

            <hr>

            <div class="avoid-break-inside">
                <h3 class="title is-5">Evaluations</h3>

                <ol>
                    @foreach($plan->evaluations as $evaluation)
                        <li>{{ $evaluation }}</li>
                    @endforeach
                </ol>
            </div>

            <hr>

            <div class="avoid-break-inside">
                <h3 class="title is-5">Activities</h3>

                <ol>
                    @foreach($plan->activities as $activity)
                        <li>{{ $activity }}</li>
                    @endforeach
                </ol>
            </div>
            <hr>

            @foreach($plan->daily_plan as $day)
                <table class="table is-narrow is-bordered avoid-break-inside">
                    <thead>
                        <th>{{ $day->date }}</th>
                        <th width="100"><p class="has-text-centered">Time</p></th>
                    </thead>
                    <tbody>
                        @forelse($day->plans as $day_plan)
                            <tr>
                                <td>{{ $day_plan->plan }}</td>
                                <td class="has-text-centered">{{ $day_plan->time }} mins</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Nothing planned for this day</td>
                                <td class="has-text-centered">-</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endforeach

            <div class="avoid-break-inside">
                <h3 class="title is-5">Observations</h3>

                <p>{{ $plan->observations }}</p>
            </div>
        </div>
    </div>
</section>

@endsection