@extends('master')

@section('content')

<section class="section">
    <div class="container">

        <h1 class="title">
            <div class="columns">
                <div class="column">Plans</div>
                <div class="column has-text-right title is-5" style="margin-top:auto">
                    <a href="{{ route('plans.create') }}">Create a new plan</a>
                </div>
            </div>
        </h1>
        <hr>
        <div class="content">

            <form>
                <div class="field has-addons has-addons-right">
                    <p class="control">
                        <span class="select">
                        <select name="grade">
                            <option value="">Grade</option>
                            @foreach(['K','1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'] as $grade)
                                <option @if($grade == $params->grade) selected @endif>{{ $grade }}</option>
                            @endforeach
                        </select>
                        </span>
                    </p>
                    <p class="control">
                        <input class="input" type="text" placeholder="Find a plan" name="s" value="{{ $params->s }}">
                    </p>
                    <p class="control">
                        <button class="button is-primary">
                            Search
                        </button>
                    </p>
                </div>
            </form>

            <table class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th><p class="has-text-centered">Grade</p></th>
                  <th><p class="has-text-centered">From</p></th>
                  <th><p class="has-text-centered">To</p></th>
                  <th><p class="has-text-centered"></p></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td><a href="{{ route('plans.show', $plan->id) }}">{{ $plan->title }}</a></td>
                        <td class="has-text-centered">{{ $plan->grade }}</td>
                        <td class="has-text-centered">{{ $plan->formatted_date_from }}</td>
                        <td class="has-text-centered">{{ $plan->formatted_date_to }}</td>
                        <td class="has-text-centered">
                            <!-- <form action="{{ route('plans.delete', $plan->id) }}" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button class="button is-link">X</button>
                            </form> -->
                            <a href="{{ route('plans.edit', $plan->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>

        </div>
    </div>
    
    {{ $plans->appends(['s' => $params->s, 'grade' => $params->grade])->links() }}

</section>

@endsection