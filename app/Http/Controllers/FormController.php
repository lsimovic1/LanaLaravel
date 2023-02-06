<?php

namespace App\Http\Controllers;

use App\Http\Resources\Form\FormCollection;
use App\Http\Resources\Form\FormResource;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::all();
        return response()->json(new FormCollection($forms));
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
            'name' => 'required|string|max:255|unique:forms',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $form = Form::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Form created',
            'form' => new FormResource($form)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show($form_id)
    {
        $form = Form::find($form_id);
        if (is_null($form)) {
            return response()->json('Form not found', 404);
        }
        return response()->json(new FormResource($form));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:forms',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $form->name = $request->name;
        $form->save();

        return response()->json([
            'message' => 'Form updated',
            'form' => new FormResource($form)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        $form->delete();

        return response()->json('Form deleted');
    }
}
