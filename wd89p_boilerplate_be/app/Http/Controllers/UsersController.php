<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Show all users
     * SELECT * FROM USERS
     * @return Users
     */
    public function index()
    {
        return response()->json(["data" => User::all()]);
    }

    /**
     * Insert into users values('','')
     *
     * @param Request $request
     * @return void
     * <input type='text' name='name' />
     * $_POST['name'] = $request->name
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json(["data" => $user, "message" => "Inserted"]);
    }

    /**
     * SELECT * FROM USERS WHERE ID = ?
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        return response()->json(["data" => User::findOrFail($id)]);
    }

    /**
     * Select * from users where id = $id
     * 
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); //Select * from User where id = $id
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json(["data" => $user, "message" => "Updated"]);
    }

    /**
     * Delete from users where id = $id
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(["data" => $user, "message" => "Deleted"]);
    }
}
