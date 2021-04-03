<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Client;
use App\Product;

class ClientController extends Controller
{
    public function getClientsPage()
    {
        $allClients = Client::get();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        return view('Dashboard.clients.index',compact('allClients','numberOfClients','numberOfProducts'));
    }
    public function getNewClientRegistrationPage()
    {
        $numberOfProducts = Product::count();
        $numberOfClients = Client::count();
        return view('Dashboard.clients.create',compact('numberOfClients','numberOfProducts'));
    }
    public function NewClientRegistration(Request $request)
    {
        //return $request->all();
        $clientNames = $request->clientNames;
        $clientEmail = $request->clientEmail;
        $clientAddress = $request->clientAddress;
        $clientTin = $request->clientTin;
        $contactName = $request->contactName;
        $clientPhoneNo = $request->clientPhoneNo;
        if(!empty($clientPhoneNo)){
            if (!$this->validatePhoneNumber($clientPhoneNo)) {
                return back()->withInput()->with('danger', 'Invalid Phone Number..');
            }
        }
        if(!empty($clientEmail)){
            if (!$this->validateEmailAddress($clientEmail)) {
                return back()->withInput()->with('danger', 'Invalid email Address..');
            }
        }
        $checkEmail = Client::where('email', $clientEmail)->exists();
        $checkPhoneNo = Client::where('phone_No', $clientPhoneNo)->exists();
        if(!empty($clientEmail)){
            if($checkEmail){
                return back()->withInput()->with('danger', 'There is already a client registered with such email...');
            }
        }
        if(!empty($clientPhoneNo)){
            if($checkPhoneNo){
                return back()->withInput()->with('danger', 'There is already a client registered with such telephone number...');
            }
        }
      $newClient = Client::create([
          'id'=> Str::uuid()->toString(),
          'client_Names'=>$clientNames,
          'Tin'=>$clientTin,
          'contact_Names'=>$contactName,
          'Address'=>$clientAddress,
        'phone_No'=>$clientPhoneNo,
        'email'=>$clientEmail
        ]);
        if($newClient){
            return redirect()->route('getAllClients')->with('success','New Client Registered Successfully');
        }
        return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function getClientEditPage($id)
    {
        $numberOfProducts = Product::count();
        $numberOfClients = Client::count();
        $clientToEdit = Client::find($id);
        return view('Dashboard.clients.edit',compact('clientToEdit','numberOfClients','numberOfProducts'));
    }
    public function clientUpdate($id , Request $request)
    {
        $clientToUpdate = Client::find($id);
        $clientNames = $request->clientNames;
        $clientEmail = $request->clientEmail;
        $clientAddress = $request->clientAddress;
        $clientTin = $request->clientTin;
        $contactName = $request->contactName;
        $clientPhoneNo = $request->clientPhoneNo;
        if(!empty($clientPhoneNo)){
            if (!$this->validatePhoneNumber($clientPhoneNo)) {
                return back()->withInput()->with('danger', 'Invalid Phone Number..');
              }
          }
          if(!empty($clientEmail)){
            if (!$this->validateEmailAddress($clientEmail)) {
                return back()->withInput()->with('danger', 'Invalid email Address..');
              }
          }
          $checkEmail = Client::where('email', $clientEmail);
          $checkPhoneNo = Client::where('phone_No', $clientPhoneNo);
          if(!empty($clientEmail)){
              if($checkEmail->exists()){
                  if($checkEmail->value('id')!== $id){
                      return back()->with('danger','email provided already exists');
                  }
              }
          }
          if(!empty($clientPhoneNo)){
              if($checkPhoneNo->exists()){
                  if($checkPhoneNo->value('id')!== $id){
                      return back()->with('danger','email provided already exists');
                  }
              }
          }
          $clientUpdateQuery = $clientToUpdate->update([
            'client_Names'=>$clientNames,
            'Tin'=>$clientTin,
            'contact_Names'=>$contactName,
            'Address'=>$clientAddress,
            'phone_No'=>$clientPhoneNo,
            'email'=>$clientEmail
          ]);
          if($clientUpdateQuery){
              return redirect()->route('getAllClients')->with('success','Client Updated Successfully');
          }
          return back()->withInput()->with('danger','an error occured. please try again');

    }

    public function ClientDeletion($id){
      if(Client::find($id)->delete()){
          return back()->with('success','Client Deleted successfully');
      }
      return back()->with('danger','an error occured..please try again');
    }

    function validatePhoneNumber($telNo)
    {
        $number = filter_var($telNo, FILTER_SANITIZE_NUMBER_INT);
        if (strlen($number) !== 12) {
            return false;
        } else {
            return true;
        }
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
