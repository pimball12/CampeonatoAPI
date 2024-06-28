<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchupStoreRequest;
use App\Http\Requests\MatchupUpdateRequest;
use App\Http\Resources\MatchupCollection;
use App\Http\Resources\MatchupResource;
use App\Models\Matchup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class MatchupController extends Controller
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

        if (isset($_GET['championship']))   {

            $with[] = 'championship';
        }

        if (isset($_GET['team_1']))   {

            $with[] = 'team_1';
        }

        if (isset($_GET['team_2']))   {

            $with[] = 'team_2';
        }

        $matchups = QueryBuilder::for(Matchup::with($with)->where('user_id', Auth::user()->id))->paginate();

        return new MatchupCollection($matchups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatchupStoreRequest $request)
    {
        $validated = $request->validated();

        $matchup = Auth::user()->matchups()->create($validated);

        return new MatchupResource($matchup);
    }

    /**
     * Display the specified resource.
     */
    public function show(Matchup $matchup)
    {
        if (isset($_GET['user']))   {

            $matchup->load('user');
        }

        if (isset($_GET['team_1']))   {

            $matchup->load('team_1');
        }

        if (isset($_GET['team_2']))   {

            $matchup->load('team_2');
        }

        if (isset($_GET['phase']))   {

            $matchup->load('phase');
        }

        return new MatchupResource($matchup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatchupUpdateRequest $request, Matchup $matchup)
    {
        $validated = $request->validated();

        $matchup->update($validated);

        return new MatchupResource($matchup);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matchup $matchup)
    {
        $matchup->delete();

        return response()->noContent();
    }
}
