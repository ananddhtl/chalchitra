<?php

namespace App\Http\Controllers;

use App\Models\PublicUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Redirect;

class PublicUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:26', 'min:5'],
                'phonenumber' => ['required', 'integer', 'unique:public_users'],
                'address' => ['required', 'string'],
                'gender' => ['required', 'integer'],
                'email' => ['required', 'string', 'unique:public_users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            $password = Hash::make($request->password);

            $user = new PublicUsers();
            $user->name = $request->name;
            $user->phonenumber = $request->phonenumber;
            $user->email = $request->email;
            $user->password = $password;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->save();

            return response()->json(['status' => 'true', 'message' => 'Your account is successfully registered.'], 200);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $firstError = [];

            foreach ($errors as $field => $errorMessages) {
                $firstError[$field] = $errorMessages[0];
            }

            return response()->json(['status' => 'error', 'message' => $firstError], 422);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(PublicUsers $publicUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublicUsers $publicUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PublicUsers $publicUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublicUsers $publicUsers)
    {
        //
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            $email = $request->email;
            $password = $request->password;
            $user = \DB::table('public_users')->where('email', $email)->get();

            if (!empty($user[0])) {
                if (Hash::check($password, $user[0]->password)) {


                    return json_encode(
                        array(
                            'status' => true,
                            'sessionUserId' => $user[0]->password,
                            'name' => $user[0]->name,
                            'phonenumber' => $user[0]->phonenumber,
                            'email_address' => $user[0]->email,
                            'user_id' => $user[0]->id,
                        )
                    );

                } else {

                    return response()->json(['status' => false, 'message' => 'Incorrect Password.'], 200);

                }
            } else {
                

                return response()->json(['status' => false, 'message' => 'Incorrect email or email not found.'], 200);

            }
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $firstError = [];

            foreach ($errors as $field => $errorMessages) {
                $firstError[$field] = $errorMessages[0];
            }

            return response()->json(['status' => 'error', 'message' => $firstError], 422);

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}