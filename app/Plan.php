<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = [
        'date_from',
        'date_to',
        'deleted_at'
    ];

    public function getDateFromAttribute($date_from)
    {
        return Carbon::parse($date_from)->toDateString();
    }

    public function getDateToAttribute($date_to)
    {
        return Carbon::parse($date_to)->toDateString();
    }

    public function getFormattedDateFromAttribute()
    {
        return Carbon::parse($this->date_from)->toFormattedDateString();
    }

    public function getFormattedDateToAttribute()
    {
        return Carbon::parse($this->date_to)->toFormattedDateString();
    }

    public function getStandardsAttribute($standards)
    {
        return json_decode($standards);
    }

    public function getExpectationsAttribute($expectations)
    {
        return json_decode($expectations);
    }

    public function getEssentialQuestionsAttribute($essential_questions)
    {
        return json_decode($essential_questions);
    }

    public function getObjectivesAttribute($objectives)
    {
        return json_decode($objectives);
    }

    public function getActivitiesAttribute($activities)
    {
        return json_decode($activities);
    }

    public function getEvaluationsAttribute($evaluations)
    {
        return json_decode($evaluations);
    }

    public function getDailyPlanAttribute($daily_plan)
    {
        return json_decode($daily_plan);
    }
}
