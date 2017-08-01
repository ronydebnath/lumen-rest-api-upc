<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $users = User::all();
        return response()->json(['data'=> $users], 200);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $user = User::create(
            ['email' => $request->get('email'), 
            'password' => Hash::make($request->get('password')),]
            );
        return response()->json(['data' => "User with the id {$user->id} has been created"], 200);
    }

    public function show($id)
    {
        $user = User::findorfail($id);
        if (!$user) {
            return response()->json(['message'=> "The User with the id {$id} doesn't exist"], 404);
        }
        return response()->json(['data' => $user], 200);
    }

    /**
     * User Update Function
     * @param  Request $request 
     * @param  integer  $id      
     * @return JSON response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => "The User with the id {$id} doesn't Exist"], 400);
        }

        $this->validateRequest($request);

        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        $user->save();

        return $this->success("The User with the id {$id} has been updated", 200);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id){
        $user = User::find($id);
        if(!$user){
            return $this->error("The user with {$id} doesn't exist", 404);
        }
        $user->delete();
        return $this->success("The user with with id {$id} has been deleted", 200);
    }

    /**
     * [validateRequest description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function validateRequest(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rules);
    }
}
