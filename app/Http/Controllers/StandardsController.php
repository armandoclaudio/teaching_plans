<?php

namespace App\Http\Controllers;

use App\Standard;
use Illuminate\Http\Request;

class StandardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $standards = Standard::orderBy('description')->get();
        return view('standards.index', compact('standards'));
    }

    public function all()
    {
        return Standard::with('expectations')->orderBy('description')->get()->map(function($standard) {
            return [
                'description' => $standard['description'],
                'expectations' => collect($standard['expectations'])->pluck('description'),
                'essential_questions' => [],
            ];
        });
    }

    public function store(Request $request) {

        $this->validate($request, [
            'description' => 'required|unique:standards'
        ]);

        $standard = Standard::create(['description' => $request->description]);

        $this->saveExpectations($standard->id, $request->expectations);

        return ['success' => true];
    }

    public function saveExpectations($standard_id, $expectations) {
        foreach($expectations as $exp) {
            if($exp == null)
                continue;

            \App\Expectation::updateOrCreate([
                'standard_id' => $standard_id,
                'description' => $exp
            ]);
        }
    }

    public function create() {
        return view('standards.create');
    }

    public function edit($id) {
        $standard = Standard::with('expectations')->find($id);
        return view('standards.edit', compact('standard'));
    }

    public function get($id) {
        return Standard::with('expectations')->find($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'description' => 'required|unique:standards,description,' . $id
        ]);

        Standard::find($id)
          ->update(['description' => $request->description]);

        \App\Expectation::whereStandardId($id)->update(['standard_id' => 0]);
        $this->saveExpectations($id, $request->expectations);

        return ['success' => true];
    }
}
