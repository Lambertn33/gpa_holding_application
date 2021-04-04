<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Supplier;
use App\Product;
use App\Client;
use App\User;

class SupplierController extends Controller
{
    public function getSuppliersPage()
    {
        $allSuppliers = Supplier::get();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.stock.suppliers.index',compact('allSuppliers','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function getNewSupplierRegistrationPage()
    {
        $allProducts = Product::get();
        $numberOfProducts = Product::count();
        $numberOfClients = Client::count();
        $numberOfUsers = User::count();
        return view('Dashboard.stock.suppliers.create',compact('numberOfClients','numberOfProducts','allProducts','numberOfUsers'));
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
    public function NewSupplierRegistration(Request $request)
    {
        //return $request->all();
        $supplierNames = $request->supplierNames;
        $supplierAddress = $request->supplierAddress;
        $supplierPhoneNo = $request->supplierPhoneNo;
        if(empty($supplierAddress) || empty($supplierNames) || empty($supplierPhoneNo)){
            return back()->withInput()->with('danger','please fill all fields');
        }
        if(!$this->validatePhoneNumber($supplierPhoneNo)){
            return back()->withInput()->with('danger','Invalid phone number');
        }
        $checkPhoneNo = Supplier::where('phone_No',$supplierPhoneNo);
        if($checkPhoneNo->exists()){
            return back()->withInput()->with('danger','The phone number provided is already registered to another supplier');
        }
        $newSupplier = Supplier::create([
            'id'=> Str::uuid()->toString(),
            'address'=>$supplierAddress,
            'names'=>$supplierNames,
            'phone_No'=>$supplierPhoneNo,
            ]);
            if($newSupplier){
                return redirect()->route('getAllSuppliers')->with('success','New Supplier Registered Successfully');
            }
            return back()->withInput()->with('danger','an error occured...please try again');

        }
        public function getSupplierEditPage($id)
        {
            $numberOfProducts = Product::count();
            $numberOfClients = Client::count();
            $supplierToEdit =  Supplier::find($id);
            $numberOfUsers = User::count();
            return view('Dashboard.stock.suppliers.edit',compact('numberOfClients','numberOfProducts','supplierToEdit','numberOfUsers'));
        }
        public function SupplierUpdate($id , Request $request)
        {
            $supplierToUpdate =  Supplier::find($id);
            $supplierNames = $request->supplierNames;
            $supplierAddress = $request->supplierAddress;
            $supplierPhoneNo = $request->supplierPhoneNo;
            if(empty($supplierAddress) || empty($supplierNames) || empty($supplierPhoneNo)){
                return back()->withInput()->with('danger','please fill all fields');
            }
            if(!$this->validatePhoneNumber($supplierPhoneNo)){
                return back()->withInput()->with('danger','Invalid phone number');
            }
            $checkPhoneNo = Supplier::where('phone_No',$supplierPhoneNo);
            if($checkPhoneNo->exists()){
                if($checkPhoneNo->value('id')!== $id){
                    return back()->with('danger','Telephone Number provided already exists');
                }
            }
            $supplierUpdateQuery = $supplierToUpdate->update([
                'names'=>$supplierNames,
                'address'=>$supplierAddress,
                'phone_No'=>$supplierPhoneNo,
              ]);
              if($supplierUpdateQuery){
                  return redirect()->route('getAllSuppliers')->with('success','Supplier Updated Successfully');
              }
              return back()->withInput()->with('danger','an error occured. please try again');

    }
    public function supplierDeletion($id){
        if(Supplier::find($id)->delete()){
            return back()->with('success','Supplier Deleted successfully');
        }
        return back()->with('danger','an error occured..please try again');
      }
}
