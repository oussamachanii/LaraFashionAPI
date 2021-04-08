<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
        if ($request->search) {
            return UserResource::collection(User::orderByDesc('created_at')->search()->where('id','!=',auth()->user()->id)->paginate($request->pagination ?? 50));
        }
        return UserResource::collection(User::orderByDesc('created_at')->where('id','!=',auth()->user()->id)->paginate($request->pagination ?? 50));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $this->authorize('show',$user);
        $this->authorize('view', $user,auth()->user());
        return   $user->only(['first_name','last_name','country','region','city','address','code_postal',]);
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
        $this->authorize('update', $user,auth()->user());
        $request->validate(
             ['first_name'=> 'required',
            'last_name'=> 'required',
            'country'=> 'required',
            'region'=> 'required',
            'city'=> 'required',
            'address'=> 'required',
            'code_postal'=> 'required',]);
        $user->update($request->only(['first_name','last_name','country','region','city','address','code_postal',]));
        return $user->only(['first_name','last_name','country','region','city','address','code_postal',]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
