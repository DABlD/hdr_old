<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Patient};

class UserController extends Controller
{
    public function createUser(Request $req){
        $user = new User();
        $user->username = $req->username;
        $user->role = $req->role;
        $user->fname = $req->fname;
        $user->mname = $req->mname;
        $user->lname = $req->lname;
        $user->suffix = $req->suffix;
        $user->gender = $req->gender;
        $user->birthday = $req->birthday;
        $user->civil_status = $req->civil_status;
        $user->address = $req->address;
        $user->email = $req->email;
        $user->contact = $req->contact;
        $user->nationality = $req->nationality;
        $user->religion = $req->religion;
        $user->avatar = $req->avatar;
        $user->password = $req->password;

        foreach (["email", "username"] as $col) {
            $flag = User::where($col, '=', $req->$col)->where('id', '!=', $user->id)->count();

            if($flag){
                return [
                    "status" => "Error",
                    "message" => "$col already exists",
                    "data" => $user
                ];
            }
        }

        try {
            $user->save();

            if($user->role == "Patient"){
                $patient = new Patient();
                $patient->user_id = $user->id;
                $patient->patient_id = $req->patient_id;
                $patient->hmo_provider = $req->hmo_provider;
                $patient->hmo_number = $req->hmo_number;
                $patient->save();
                
                $user->load('patient');

                return [
                    "status" => "Success",
                    "message" => "Patient successfully created",
                    "data" => $user
                ];
            }
            else{
                return [
                    "status" => "Success",
                    "message" => "User successfully created",
                    "data" => $user
                ];
            }

        } catch (Exception $e) {
            return [
                "status" => "Error",
                "message" => $e->errorMessage()
            ];
        }
    }

    public function getUser(Request $req){
        $user = User::find($req->id);

        if($user){
            if($user->role == "Patient"){
                $user->load('patient');
            }

            return [
                "status" => "Success",
                "data" => $user
            ];
        }
        else{
            return [
                "status" => "Error",
                "message" => "Invalid ID"
            ];
        }
    }

    public function updateUser(Request $req){
        $user = User::find($req->id);

        if($user){
            // UPDATE COLUMNS OF ALL PASSED ATTRIBUTE ONLY
            $columns = $user->getFillable();

            foreach($columns as $col){
                if(in_array($col, ["username", "email"])){
                    if($req->$col != $user->$col){
                        // CHECK IF DUPLICATE
                        $flag = User::where($col, '=', $req->$col)->where('id', '!=', $user->id)->count();

                        if($flag){
                            return [
                                "status" => "Error",
                                "message" => "$col already exists",
                                "data" => $user
                            ];
                        }
                        else{
                            $user->$col = $req->$col;
                        }
                    }
                }
                elseif(isset($req->$col)){
                    $user->$col = $req->$col;
                }
            }

            try {
                $user->save();

                if($user->role == "Patient"){
                    $user->load('patient');

                    $columns = $user->patient->getFillable();

                    foreach($columns as $col){
                        if(isset($req->$col)){
                            $user->patient->$col = $req->$col;
                        }
                    }

                    return [
                        "status" => "Success",
                        "message" => "Patient details successfully updated",
                        "data" => $user
                    ];
                }
                else{
                    return [
                        "status" => "Success",
                        "message" => "User details successfully updated",
                        "data" => $user
                    ];
                }


            } catch (Exception $e) {
                return [
                    "status" => "Error",
                    "message" => $e->errorMessage()
                ];
            }
        }
        else{
            return [
                "status" => "Error",
                "message" => "Invalid ID"
            ];
        }
    }

    public function deleteUser(Request $req){
        $user = User::find($req->id);

        if($user){
            try {
                $user->delete();

                return [
                    "status" => "Success",
                    "message" => "User deleted",
                    "data" => $user
                ];

            } catch (Exception $e) {
                return [
                    "status" => "Error",
                    "message" => $e->errorMessage()
                ];
            }
        }
        else{
            return [
                "status" => "Error",
                "message" => "Invalid ID"
            ];
        }
    }
}
