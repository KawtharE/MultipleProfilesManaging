<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFormRequest;
use App\User;

class ProfilesController extends Controller
{
    private $user;

    function __construct(User $user)
    {
    	$this->user = $user;
    }
    function saveForm(ProfileFormRequest $request) {
    	$newProfile = $this->user->create([
    			'uniqueID' => uniqid(),
    			'firstname' => $request->get('firstname'),
    			'lastname' => $request->get('lastname'),
    			'gender' => $request->get('gender'),
    			'birthDate' => $request->get('birthDate'),
    			'country' => $request->get('country'),
    			'city' => $request->get('city'),
    			'email' => $request->get('email'),
    			'mobile' => $request->get('mobile')
    		]);
    	if (!$newProfile) {
          return response()->json(['failed to create new profile'], 500);
        } else {
        	return response()->json(['new profile was successfully created'], 200);
        }
    }
    function getProfiles() {
    	$users = User::all();
    	return $users;
    }

}
