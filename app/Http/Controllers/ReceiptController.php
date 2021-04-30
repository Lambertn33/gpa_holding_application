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
       // return $allClients;
         return view('Dashboard.invoices.receipts.clientSelection',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients'));

    }
    public function saveClientToMakeReceipt(Request $request)
    {
        $client = $request->client;
        if(empty($client)){
            return back()->with('danger','please select the client');
        }
        $clientToMakeReceipt = Receipt::create([
            'id'=> Str::uuid()->toString(),
            'client'=>$client,
            'date'=>date("Y-m-d"),
            'isConfirmed'=>false,
        ]);
        if($clientToMakeReceipt){
             $request->session()->put('clientToMakeReceipt',$clientToMakeReceipt);
              return redirect()->route('getNewReceiptRegistrationPage');
        }
    }
    public function saveProductToMakeReceipt(Request $request)
    {
    $product = Product::where('id',$request->productId)->first();
    return $product->price;
    }
    public function getNewReceiptRegistrationPage(Request $request)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        $clientToMakeReceipt = $request->session()->get('clientToMakeReceipt');
        $clientToMakeReceipt  = Receipt::with('products')->find($clientToMakeReceipt->id);
        return view('Dashboard.invoices.receipts.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts','clientToMakeReceipt'));
    }
    public function NewReceiptRegistration(Request $request)
    {
        //return $request->all();
        $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $unitCost = $request->unitCost;
        $totalCost = $request->totalCost;
        $clientToMakeReceipt = $request->session()->get('clientToMakeReceipt');
        if($quantity == 0){
            return back()->withInput()->with('danger','Invalid quantity or Unit Cost');

        }

        $clientToMakeReceipt->products()->attach($product,array(
        'receipt_product_id'=>Str::uuid(),
        'description'=>$description,
        'quantity'=>$quantity,
        'unit_cost'=>$unitCost,
        'total_cost'=>$totalCost
        ));
        return back()->with('success','invoice captured...add more if you want or confirm your invoice');
    }
    public function deleteReceiptItem(Request $request)
    {
       $productToDetach = Product::find($request->productId);
       $receipt = Receipt::find($request->receiptId);
       if($receipt->products()->detach($productToDetach)){
           return back()->with('success','product removed successfully');
       }
    }
    public function confirmReceipt($id , Request $request)
    {
        $receiptToConfirm = Receipt::with('products')->find($id);
        if($receiptToConfirm->products()->count() > 0){
            if($receiptToConfirm->update([
                'isConfirmed'=>true
            ])){
                return redirect()->route('getAllReceipts')->with('success','Receipt created successfully');
                $request->session()->forget('clientToMakeReceipt');
            }
        }else{
            return back()->with('danger','receipt doesn t have any product');
        }
    }
    public function deleteReceipt($id)
    {
        $receiptToDelete = Receipt::with('products')->find($id);
        //return $receiptToDelete;
        if($receiptToDelete->products()->count() > 0){
            $receiptToDelete->products()->detach();
            $receiptToDelete->delete();
            return redirect()->route('getAllReceipts')->with('success','Receipt deleted successfully');
        }else{
            $receiptToDelete->delete();
            return redirect()->route('getAllReceipts')->with('success','Receipt deleted successfully');
        }
    }
    public function viewReceipt($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $receiptToView = Receipt::with('products')->find($id);
        $allProducts = Product::get();
        return view('Dashboard.invoices.receipts.view',compact('numberOfClients','allProducts','numberOfProducts','numberOfUsers','receiptToView'));
    }
    public function addProductToExistingReceipt(Request $request)
    {

      $receiptToAddProduct = Receipt::with('products')->where('id',$request->receiptId)->first();
      $product = $request->product;
      $description = $request->description;
      $quantity = $request->quantity;
      $unitCost = $request->unitCost;
      $totalCost = $request->totalCost;
      $receiptToAddProduct->products()->attach($product,array(
        'receipt_product_id'=>Str::uuid(),
        'description'=>$description,
        'quantity'=>$quantity,
        'unit_cost'=>$unitCost,
        'total_cost'=>$totalCost
        ));
       return back();

    }
}
