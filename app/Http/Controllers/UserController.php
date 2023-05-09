<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::latest()->paginate();
		
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$user = new User;
        $roles  = Role::all();


		return view('users.create', compact('user','roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'nom' => 'required|string',
			'prenom' => 'required|string',
			'matricule' => 'required|string|unique:users,matricule',

			'email' => 'required|string|email|unique:users',
			'password' => 'required|confirmed',
		]);

		$data['password'] = Hash::make($data['password']);
		$data['email_verified_at'] = now();


		$user = User::create($data);
        if ($request->roles) {
            $user->assignRole($request->roles);
        }



		return to_route('users.index')->withSuccess('Data succcessfully created.');
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


	public function edit(User $user)
	{
        $roles = Role::all();
        $userRole = $user->roles->pluck('name','name')->all();

		return view('users.edit', compact('user','roles','userRole'));
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
		$request->validate([
			'nom' => 'required|string',
			'prenom' => 'required|string',
			'matricule' => 'required|string|unique:users,matricule,' . $user->id,
			'email' => 'required|string|email|unique:users,email,' . $user->id,
			'password' => $request->password ? 'required|confirmed' : '',
		]);

		$data['name'] = $request->name;
		if ($request->password) {
			$data['password'] = Hash::make('password');
		}
		$data['email'] = $request->email;



		$user->update($data);

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }


		return to_route('users.index')->withSuccess('Data succcessfully updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete(User $user)
	{
		$user->delete();
		return to_route('users.index')->withSuccess('Data successfully deleted.');
	}
}
