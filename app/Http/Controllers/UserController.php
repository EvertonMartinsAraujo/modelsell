<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $user = User::all();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( User::regras(), User::feedback());
        $user = User::create($request->all());
        return response() -> json($user, 201);
    }

    /**
     * Display the specified resource.
     * @param App\Model\User $id
     *
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param App\Model\User $id
     */
    public function update(Request $request, User $user)
    {
        $request->validate(User::regras(), User::feedback());
        $user->update($request->all());
        return response()->json(['Cadastro atualizado!',$user], 201);
    }

    /**
     * Remove the specified resource from storage.
     * @param App\Model\User $user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ['Cadastro excluido'];
    }
}
