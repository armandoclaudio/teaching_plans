<?php

namespace App\Http\Controllers;

use Auth;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $params)
    {
        $plans = Auth::user()->plans()
            ->where(function($query) use($params) {
                if($params->grade != '')
                    $query->whereGrade($params->grade);
            })
            ->where('title', 'like', "%$params->s%")
            ->orderBy('date_from', 'desc')->paginate(25);
        return view('plans.index', compact('plans', 'params'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $daily_plan = $this->removeEmptyDailyPlans($request->daily_plan);

        $this->validate($request, [
            'title' => 'required|max:255',
            'grade' => 'required',
            'date_from' => 'required',
            'date_to' => 'required'
        ]);

        Auth::user()->plans()->save(new Plan([
            'title' => $request->title,
            'grade' => $request->grade,
            'date_from' => Carbon::parse($request->date_from),
            'date_to' => Carbon::parse($request->date_to),
            'standards' => $this->prepareArray($request->standards),
            'expectations' => $this->prepareArray($request->expectations),
            'essential_questions' => $this->prepareArray($request->essential_questions),
            'objectives' => $this->prepareArray($request->objectives),
            'activities' => $this->prepareArray($request->activities),
            'evaluations' => $this->prepareArray($request->evaluations),
            'daily_plan' => json_encode($daily_plan),
            'observations' => $request->observations,
        ]));

        return [
            'success' => true,
            'id' => Auth::user()->plans()->latest()->first()->id
        ];
    }

    public function prepareArray($array)
    {
        return json_encode(array_values(array_filter($array)));
    }

    public function removeEmptyDailyPlans($daily_plan)
    {
        return collect($daily_plan)->map(function($day) {
            return [
                'date' => $day['date'],
                'plans' => collect($day['plans'])->filter(function($dailyPlan) {
                    return $dailyPlan['plan'] != '';
                }),
            ];
        });
    }

    public function show($id)
    {
        $plan = Auth::user()->plans->find($id);
        return view('plans.show', compact('plan'));
    }

    public function edit($id)
    {
        $plan = Auth::user()->plans->find($id);
        return view('plans.edit', compact('plan'));
    }

    public function get($id)
    {
        return Auth::user()->plans->find($id);
    }

    public function update(Request $request, $id)
    {
        $daily_plan = $this->removeEmptyDailyPlans($request->daily_plan);

        Auth::user()->plans->find($id)->update([
            'title' => $request->title,
            'grade' => $request->grade,
            'date_from' => Carbon::parse($request->date_from),
            'date_to' => Carbon::parse($request->date_to),
            'standards' => $this->prepareArray($request->standards),
            'expectations' => $this->prepareArray($request->expectations),
            'essential_questions' => $this->prepareArray($request->essential_questions),
            'objectives' => $this->prepareArray($request->objectives),
            'activities' => $this->prepareArray($request->activities),
            'evaluations' => $this->prepareArray($request->evaluations),
            'daily_plan' => json_encode($daily_plan),
            'observations' => $request->observations,
        ]);

        return ['success' => true];
    }

    public function delete($id)
    {
        $plan = Auth::user()->plans->find($id);

        $plan->delete();

        return redirect(route('plans.index'));
    }
}
