<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Models\configuration\Structures;
use App\Models\Affectation;


require_once app_path('Helpers/StructureAddHelper.php');


class RegisterController extends Controller
{
	/**
	 * Display the registration view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$structures = Structures::whereNull('parent_id')->get();
		return view('auth.register',compact('structures'));
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$request->validate([
			'nom' => ['required', 'string', 'max:255'],
			'prenom' => ['required', 'string', 'max:255'],
			'matricule' => ['required', 'string', 'max:20'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
			'terms' => ['required'],
			'affectation_date' => 'required|date',                 
            'structure_id' => 'required',
		]);

		$user = User::create([
			'nom' => $request->nom,
			'prenom' => $request->prenom,
			'matricule' => $request->matricule,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		event(new Registered($user));

		$affectation = new Affectation;
    
		$affectation->affectation_date = $request->affectation_date;
		$affectation->user_id = $user['id'];            
		$affectation->structure_id = $request->structure_id;
		$affectation->save();

		Auth::login($user);

		return redirect(RouteServiceProvider::HOME);
	}
}
