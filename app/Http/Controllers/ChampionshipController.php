<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChampionshipStoreRequest;
use App\Http\Requests\ChampionshipUpdateRequest;
use App\Http\Resources\ChampionshipCollection;
use App\Http\Resources\ChampionshipResource;
use App\Models\Championship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ChampionshipController extends Controller
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

        if (isset($_GET['matchups']))   {

            $with[] = 'matchups';
        }

        $championships = QueryBuilder::for(Championship::with($with)->where('user_id', Auth::user()->id))->paginate();

        return new ChampionshipCollection($championships);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChampionshipStoreRequest $request)
    {
        $validated = $request->validated();

        $championship = Auth::user()->championships()->create($validated);

        return new ChampionshipResource($championship);
    }

    /**
     * Display the specified resource.
     */
    public function show(Championship $championship)
    {
        if (isset($_GET['user']))   {

            $championship->load('user');
        }

        if (isset($_GET['matchups']))   {

            $championship->load('matchups');
        }

        return new ChampionshipResource($championship);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChampionshipUpdateRequest $request, Championship $championship)
    {
        $validated = $request->validated();

        $championship->update($validated);

        return new ChampionshipResource($championship);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Championship $championship)
    {
        $championship->delete();

        return response()->noContent();
    }
}
