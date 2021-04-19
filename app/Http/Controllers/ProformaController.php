<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proforma;
use App\Client;
use App\User;
use App\Product;
use Illuminate\Support\Str;

class ProformaController extends Controller
{
    public function getProformasPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProformas  = Proforma::get();
        return view('Dashboard.invoices.proforma.index',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients'));
    }
    public function getNewProformaRegistrationPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        return view('Dashboard.invoices.proforma.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts'));
    }
    public function NewProformaRegistration(Request $request)
    {
        $client = $request->client;
        $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $unitCost = $request->unitCost;
        $totalCost = $request->totalCost;
        if($quantity == 0 || $unitCost == 0){
            return back()->withInput()->with('danger','Invalid quantity or Unit Cost');

        }
        $newProforma = Proforma::create([
            'id'=> Str::uuid()->toString(),
            'client_id'=>$client,
            'product'=>$product,
            'description'=>$description,
            'quantity'=>$quantity,
            'unit_cost'=>$unitCost,
            'date'=>date("Y-m-d"),
            'total_cost'=>$totalCost,
            'status'=>'NOT PAID'
         ]);
         if($newProforma){
             return redirect()->route('getAllProformas')->with('success','New Proforma Registered Successfully');
         }
         return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function getProformaDetails($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $clientToView = Client::with('proformas')->find($id);
        return view('Dashboard.invoices.proforma.view',compact('numberOfClients','numberOfProducts','numberOfUsers','clientToView'));

    }
}
