<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $allUsers = User::get();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.users.index',compact('allUsers','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function getNewUserRegistrationPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.users.create',compact('numberOfClients','numberOfProducts','numberOfUsers'));

    }
    public function NewUserRegistration(Request $request)
    {
        $userFirstName = $request->userFirstName;
        $userLastName = $request->userLastName;
        $userEmail = $request->userEmail;
        $userPassword = $request->userPassword;
        $userRole = $request->userRole;
        if(empty($userFirstName) || empty($userLastName) || empty($userEmail)|| empty($userPassword) || empty($userRole)){
            return back()->withInput()->with('danger','please fill all fields');
        }
        if (!$this->validateEmailAddress($userEmail)) {
            return back()->withInput()->with('danger', 'Invalid email Address..');
        }
        $checkEmail = User::where('email', $userEmail);
        if($checkEmail->exists()){
            return back()->withInput()->with('danger', 'There is already a user registered with such email...');
        }
        $newUser = User::create([
            'id'=> Str::uuid()->toString(),
            'first_Name'=>$userFirstName,
            'last_Name'=>$userLastName,
            'email'=>$userEmail,
            'role'=>$userRole,
            'status'=>'ACTIVE',
            'password'=>Hash::make($userPassword)
          ]);
          if($newUser){
              return redirect()->route('getAllUsers')->with('success','New User Registered Successfully');
          }
          return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function getUserEditPage($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $userToEdit = User::find($id);
        return view('Dashboard.users.edit',compact('numberOfClients','numberOfProducts','numberOfUsers','userToEdit'));
    }
    public function userUpdateStatus($id)
    {
        $userToEdit = User::find($id);
        if($userToEdit->value('status') === "ACTIVE"){
            $userToEdit->update([
                'status'=>'BLOCKED'
            ]);
            return back()->with('success','user Account Deactived successfully');
        }else{
            $userToEdit->update([
                'status'=>'ACTIVE'
            ]);
            return back()->with('success','user Account Actived successfully');

        }
    }
    public function userUpdate($id , Request $request)
    {
        $userToEdit = User::find($id);
        $userFirstName = $request->userFirstName;
        $userLastName = $request->userLastName;
        $userEmail = $request->userEmail;
        $userRole = $request->userRole;
        if(empty($userFirstName) || empty($userLastName) || empty($userEmail)|| empty($userRole)){
            return back()->withInput()->with('danger','please fill all fields');
        }
        if (!$this->validateEmailAddress($userEmail)) {
            return back()->withInput()->with('danger', 'Invalid email Address..');
        }
        $checkEmail = User::where('email', $userEmail);
        if($checkEmail->exists()){
            if($checkEmail->value('id')!== $id){
                return back()->with('danger','email provided already exists');
            }
        }
        $userUpdateQuery = $userToEdit->update([
            'first_Name'=>$userFirstName,
            'last_Name'=>$userLastName,
            'email'=>$userEmail,
            'role'=>$userRole,
        ]);
        if($userUpdateQuery){
            return redirect()->route('getAllUsers')->with('success','User Updated Successfully');
        }
        return back()->withInput()->with('danger','an error occured...please try again');

    }
    function validateEmailAddress($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}
