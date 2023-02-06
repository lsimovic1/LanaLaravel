<?php

namespace App\Http\Controllers;

use App\Http\Resources\Art\ArtCollection;
use App\Http\Resources\Art\ArtResource;
use App\Models\Art;
use App\Models\Artist;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $art = Art::all();
        return response()->json(new ArtCollection($art));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'year' => 'required|integer|between:1000,2023',
            'value' => 'required|integer|between:100,450300000',
            'artist_id' => 'required|integer',
            'form_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $artist = Artist::find($request->artist_id);
        if (is_null($artist)) {
            return response()->json('There is no artist with that id', 404);
        }

        $form = Form::find($request->form_id);
        if (is_null($form)) {
            return response()->json('There is no art form with that id', 404);
        }

        $art = Art::create([
            'title' => $request->title,
            'year' => $request->year,
            'value' => $request->value,
            'artist_id' => $request->artist_id,
            'form_id' => $request->form_id,
        ]);

        return response()->json([
            'message' => 'Art created',
            'art' => new ArtResource($art)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Art  $art
     * @return \Illuminate\Http\Response
     */
    public function show($art_id)
    {
        $art = Art::find($art_id);
        if (is_null($art)) {
            return response()->json('Art not found', 404);
        }
        return response()->json(new ArtResource($art));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Art  $art
     * @return \Illuminate\Http\Response
     */
    public function edit(Art $art)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Art  $art
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Art $art)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'year' => 'required|integer|between:1000,2023',
            'value' => 'required|integer|between:100,450300000',
            'artist_id' => 'required|integer',
            'form_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $artist = Artist::find($request->artist_id);
        if (is_null($artist)) {
            return response()->json('There is no artist with that id', 404);
        }

        $form = Form::find($request->form_id);
        if (is_null($form)) {
            return response()->json('There is no art form with that id', 404);
        }

        $art->title = $request->title;
        $art->year = $request->year;
        $art->value = $request->value;
        $art->artist_id = $request->artist_id;
        $art->form_id = $request->form_id;
        $art->save();

        return response()->json([
            'message' => 'Art updated',
            'art' => new ArtResource($art)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Art  $art
     * @return \Illuminate\Http\Response
     */
    public function destroy(Art $art)
    {
        $art->delete();

        return response()->json('Art deleted');
    }
}
