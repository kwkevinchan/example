<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entites\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index')->with([
            'data' => User::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'comment' => $request->comment ?? "",
            ]);
            return response()->json([
                'status' => 'success',
                'msg' => 'Ok',
            ], 200);
        } catch ( \Exception $e ) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 422);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit')->with([
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'comment' => $request->comment,
            ]);
            return response()->json([
                'status' => 'success',
                'msg' => 'Ok',
            ], 200);
        } catch ( \Exception $e ) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 422);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return response()->json([
                'status' => 'success',
                'msg' => 'Ok',
            ], 200);
        } catch ( \Exception $e ) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 422);
        }
    }
}
