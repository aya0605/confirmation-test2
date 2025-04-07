<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Http\Requests\SeasonRequest;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::all();
        return view('seasons.index', compact('seasons'));
    }

    public function create()
    {
        return view('seasons.create');
    }

    public function store(SeasonRequest $request)
    {
        Season::create($request->validated());

        return redirect()->route('seasons.index')
            ->with('success', '季節が作成されました。');
    }

    public function show(Season $season)
    {
        return view('seasons.show', compact('season'));
    }

    public function edit(Season $season)
    {
        return view('seasons.edit', compact('season'));
    }

    public function update(SeasonRequest $request, Season $season)
    {
        $season->update($request->validated());

        return redirect()->route('seasons.index')
            ->with('success', '季節が更新されました。');
    }

    public function destroy(Season $season)
    {
        $season->delete();

        return redirect()->route('seasons.index')
            ->with('success', '季節が削除されました。');
    }
}