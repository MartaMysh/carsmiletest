<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeselGenderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class PeselApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeselGenderRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(PeselGenderRequest $request): JsonResponse
    {
        try {
            $request->validated();
            return response()->json(['ok' => 'OK'], 201);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['errors' => $errors], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
