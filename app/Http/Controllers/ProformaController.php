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
        $allProfomas = Proforma::with('client')->get();
        $allProformas  = Proforma::get();
        return view('Dashboard.invoices.proforma.index',compact('numberOfClients','numberOfProducts','numberOfUsers','allProformas'));
    }
    public function getClientToMakeProforma(Request $request)
    {
        $request->session()->forget('clientToMakeProforma');
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
         return view('Dashboard.invoices.proforma.clientSelection',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients'));

    }
    public function saveClientToMakeProforma(Request $request)
    {

        $client = $request->client;
        if(empty($client)){
            return back()->with('danger','please select the client');
        }
        $clientToMakeProforma = Proforma::create([
            'id'=> Str::uuid()->toString(),
            'client_id'=>$client,
            'date'=>date("Y-m-d"),
            'isConfirmed'=>false,
            'status'=>'NOT PAID',
        ]);
        if($clientToMakeProforma){
             $request->session()->put('clientToMakeProforma',$clientToMakeProforma);
              return redirect()->route('getNewProformaRegistrationPage');
        }
    }
    public function getNewProformaRegistrationPage(Request $request)
    {

        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        $clientToMakeProforma = $request->session()->get('clientToMakeProforma');
        $clientToMakeProforma  = Proforma::with('products')->with('client')->find($clientToMakeProforma->id);
       // return $clientToMakeProforma;
       return view('Dashboard.invoices.proforma.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts','clientToMakeProforma'));
     }
    public function NewProformaRegistration(Request $request)
    {
         //return $request->all();
         $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $unitCost = $request->unitCost;
        $totalCost = $request->totalCost;
        $clientToMakeProforma = $request->session()->get('clientToMakeProforma');
        if(empty($description)){
            return back()->withInput()->with('danger','Provide the description');
        }
        if($quantity == 0 || $unitCost == 0){
            return back()->withInput()->with('danger','Invalid quantity or Unit Cost');

        }
        $clientToMakeProforma->products()->attach($product,array(
            'proforma_product_id'=>Str::uuid(),
            'description'=>$description,
            'quantity'=>$quantity,
            'unit_cost'=>$unitCost,
            'total_cost'=>$totalCost
            ));
            return back()->with('success','Proforma captured...add more if you want or confirm your invoice');
    }
    public function confirmProforma($id , Request $request)
    {
        $proformaToConfirm = Proforma::with('products')->find($id);
        if($proformaToConfirm->products()->count() > 0){
            if($proformaToConfirm->update([
                'isConfirmed'=>true
            ])){
                return redirect()->route('getAllProformas')->with('success','Proforma created successfully');
                $request->session()->forget('clientToMakeProforma');
            }
        }else{
            return back()->with('danger','proforma doesn t have any product');
        }
    }
    public function deleteProforma($id)
    {
        $ProformaToDelete = Proforma::with('products')->find($id);
        if($ProformaToDelete->products()->count() > 0){
            $ProformaToDelete->products()->detach();
            $ProformaToDelete->delete();
            return redirect()->route('getAllProformas')->with('success','Proforma canceled successfully');
        }else{
            $ProformaToDelete->delete();
            return redirect()->route('getAllInvoices')->with('success','Invoice canceled successfully');
        }
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
