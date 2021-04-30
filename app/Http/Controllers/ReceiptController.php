<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\Client;
use App\User;
use App\Product;
use Illuminate\Support\Str;

class ReceiptController extends Controller
{
    public function getReceiptsPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allReceipts  = Receipt::get();
        return view('Dashboard.invoices.receipts.index',compact('numberOfClients','numberOfProducts','numberOfUsers','allReceipts'));
    }
    public function getClientToMakeReceipt(Request $request)
    {
        $request->session()->forget('clientToMakeProforma');
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        return $allClients;
        // return view('Dashboard.invoices.proforma.clientSelection',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients'));

    }
    public function getNewReceiptRegistrationPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        return view('Dashboard.invoices.receipts.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts'));
    }
    public function NewReceiptRegistration(Request $request)
    {
        $client = $request->client;
        $product = $request->product;
        $description = $request->description;
        $duration = $request->duration;
        $totalCost = $request->totalCost;
        if(empty($client) || empty($product) || empty($duration) || empty($totalCost)){
            return back()->withInput()->with('danger','Only the Description is allowed to be optional');
        }
        if($totalCost == 0){
            return back()->withInput()->with('danger','Cant create a receipt of 0 frws');
        }
        $newReceipt = Receipt::create([
            'id'=> Str::uuid()->toString(),
            'client'=>$client,
            'product'=>$product,
            'description'=>$description,
            'date'=>date("Y-m-d"),
            'duration'=>$duration,
            'amount'=>$totalCost,
         ]);
         if($newReceipt){
             return redirect()->route('getAllReceipts')->with('success','New Receipt Registered Successfully');
         }
         return back()->withInput()->with('danger','an error occured...please try again');
    }
}
