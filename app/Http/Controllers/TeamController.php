<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $with = [];

        if (isset($_GET['user']))   {

            $with[] = 'user';
        }

        $teams = QueryBuilder::for(Team::with($with)->where('user_id', Auth::user()->id))->paginate(100);

        return new TeamCollection($teams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamStoreRequest $request)
    {
        $validated = $request->validated();

        $team = Auth::user()->teams()->create($validated);

        return new TeamResource($team);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        if (isset($_GET['user']))   {

            $team->load('user');
        }

        return new TeamResource($team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        $validated = $request->validated();

        $team->update($validated);

        return new TeamResource($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return response()->noContent();
    }
}
