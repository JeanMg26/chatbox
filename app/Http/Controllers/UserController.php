<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(User $user)
   {
      return User::all();
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $data             = $request->all();
      $data['password'] = bcrypt($request->password);

      $user = User::create($data);
      broadcast(new UserCreated($user));
      return $user;

   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(User $user)
   {
      return $user;
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, User $user)
   {
      $data             = $request->all();
      $data['password'] = bcrypt($request->password);

      $user->fill($data);
      $user->save();

      return $user;
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(User $user)
   {
      $user->delete();

      return $user;
   }
}
