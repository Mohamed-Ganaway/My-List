<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //collect all users from val name users
        $users = User::all();
        //return the response to the client
        return response()->json(['data' => $users]);
    }

    public function store(Request $request)
    {
        //step 1: validate the input data -> done
        //step 2: store the user in the database -> done
        //step 3: return a message to the client


        $input = $request->validate([
            'name' => ['String', 'required'],
            'email' => ['String', 'required', 'email', 'unique:users,email'],
        ]);
        User::create($input);
        return response()->json(['message' => 'User created successfully']);
    }
    

    //update a user in the database
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        if (!$users){
            return response()->json(['message' => 'user not found'],404);
        }
        
        $input = $request->validate([
           'name' => ['String', 'required'],
           'email' => ['String', 'required', 'email', 'unique:users,email'],
       ]); 
    $users->update($input);
    return response()->json(['message' => 'user updated successfully']);
    }

//delete a user from the database
    public function destroy($id)
{
    $users = User::find($id);
    
    if (!$users) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $users->delete();
    return response()->json(['message' => 'User deleted successfully']);
}



//show a particular user
 public function show($id)
{
    $users = User::find($id);
    if (!$users) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json(['User', $users]);
}


}
