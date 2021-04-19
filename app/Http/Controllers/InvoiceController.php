<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\User;
use App\Product;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function getInvoicesPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allInvoices  = Invoice::get();
        return view('Dashboard.invoices.index',compact('numberOfClients','numberOfProducts','numberOfUsers','allInvoices'));
    }
    public function getNewInvoiceRegistrationPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        return view('Dashboard.invoices.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts'));
    }
    public function NewInvoiceRegistration(Request $request)
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
        $newInvoice = Invoice::create([
            'id'=> Str::uuid()->toString(),
            'client'=>$client,
            'product'=>$product,
            'description'=>$description,
            'quantity'=>$quantity,
            'unit_cost'=>$unitCost,
            'date'=>date("Y-m-d"),
            'total_cost'=>$totalCost,
            'status'=>'NOT PAID'
         ]);
         if($newInvoice){
             return redirect()->route('getAllInvoices')->with('success','New Invoice Registered Successfully');
         }
         return back()->withInput()->with('danger','an error occured...please try again');
    }
}
