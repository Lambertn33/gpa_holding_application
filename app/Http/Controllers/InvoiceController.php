<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Session;
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
    public function getClientToMakeInvoice(Request $request)
    {
        $request->session()->forget('clientToMakeInvoice');
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
         return view('Dashboard.invoices.clientSelection',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients'));

    }
    public function saveClientToMakeInvoice(Request $request)
    {

        $client = $request->client;
        if(empty($client)){
            return back()->with('danger','please select the client');
        }
        $clientToMakeInvoice = Invoice::create([
            'id'=> Str::uuid()->toString(),
            'client'=>$client,
            'date'=>date("Y-m-d"),
            'isConfirmed'=>false,
            'status'=>'NOT PAID',
        ]);
        if($clientToMakeInvoice){
             $request->session()->put('clientToMakeInvoice',$clientToMakeInvoice);
              return redirect()->route('getNewInvoiceRegistrationPage');
        }
    }
    public function saveProductToMakeInvoice(Request $request)
    {
    $product = Product::where('id',$request->productId)->first();
    return $product->price;
    }
    public function getNewInvoiceRegistrationPage(Request $request)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        $clientToMakeInvoice = $request->session()->get('clientToMakeInvoice');
        $clientToMakeInvoice  = Invoice::with('products')->find($clientToMakeInvoice->id);
        return view('Dashboard.invoices.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts','clientToMakeInvoice'));
    }
    public function NewInvoiceRegistration(Request $request)
    {
        //return $request->all();
        $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $unitCost = $request->unitCost;
        $totalCost = $request->totalCost;
        $clientToMakeInvoice = $request->session()->get('clientToMakeInvoice');
        if(empty($description)){
            return back()->withInput()->with('danger','Provide the description');
        }
        if($quantity == 0 || $unitCost == 0){
            return back()->withInput()->with('danger','Invalid quantity or Unit Cost');

        }

        $clientToMakeInvoice->products()->attach($product,array(
        'invoice_product_id'=>Str::uuid(),
        'description'=>$description,
        'quantity'=>$quantity,
        'unit_cost'=>$unitCost,
        'total_cost'=>$totalCost
        ));
        return back()->with('success','invoice captured...add more if you want or confirm your invoice');
    }
    public function confirmInvoice($id , Request $request)
    {
        $invoiceToConfirm = Invoice::with('products')->find($id);
        if($invoiceToConfirm->products()->count() > 0){
            if($invoiceToConfirm->update([
                'isConfirmed'=>true
            ])){
                return redirect()->route('getAllInvoices')->with('success','Invoice created successfully');
                $request->session()->forget('clientToMakeInvoice');
            }
        }else{
            return back()->with('danger','invoice doesn t have any product');
        }
    }
    public function deleteInvoice($id)
    {
        $invoiceToDelete = Invoice::with('products')->find($id);
        if($invoiceToDelete->products()->count() > 0){
            $invoiceToDelete->products()->detach();
            $invoiceToDelete->delete();
            return redirect()->route('getAllInvoices')->with('success','Invoice canceled successfully');
        }else{
            $invoiceToDelete->delete();
            return redirect()->route('getAllInvoices')->with('success','Invoice canceled successfully');
        }
    }
    public function deleteInvoiceItem(Request $request)
    {
       $productToDetach = Product::find($request->productId);
       $invoice = Invoice::find($request->invoiceId);
       if($invoice->products()->detach($productToDetach)){
           return back()->with('success','product removed successfully');
       }
    }
}
