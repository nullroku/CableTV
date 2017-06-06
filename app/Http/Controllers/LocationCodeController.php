<?php

namespace App\Http\Controllers;

use App\LocationCode;
use Illuminate\Http\Request;

class LocationCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationCode::all();
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
      return LocationCode::create([
        'location' => $request->location,
        'code' => $request->code
      ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LocationCode  $locationCode
     * @return \Illuminate\Http\Response
     */
    public function show(LocationCode $locationCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LocationCode  $locationCode
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationCode $locationCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LocationCode  $locationCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationCode $locationCode, $id)
    {
        // $locationCode->update([
        //   'location' => $request->location,
        //   'code' => $request->code
        // ]);

        $locationCode = LocationCode::find($id);
        $locationCode->location = $request->location;
        $locationCode->code = $request->code;

        $locationCode->save();

        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LocationCode  $locationCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationCode $locationCode, $id)
    {
        // $locationCode->delete();

        LocationCode::find($id)->delete();

        return "success";
    }
}
