<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\User;
use App\Stock;
use App\Product;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

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
    public function checkStockAvailability(Request $request)
    {
        $product = Product::where('id',$request->productId)->value('name');
        $remainingQuantity = Stock::where('product',$product)->value('remainingQuantity');
        if(!$remainingQuantity){
            $remainingQuantity = 0;
        }
        return $remainingQuantity;
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
        $remainingStock = $request->remainingStock;
        $product = $request->product;
        $description = $request->description;
        $quantity = $request->quantity;
        $unitCost = $request->unitCost;
        $totalCost = $request->totalCost;
        $clientToMakeInvoice = $request->session()->get('clientToMakeInvoice');

        if($remainingStock == 0)
        {
            return back()->withInput()->with('danger','The selected product is not available in stock');
        }
        $checkIfInvoiceHasThisProduct = Invoice::where('id',$clientToMakeInvoice->id)
        ->whereHas('products',function($q) use($product){
           $q->where('product_id',$product);
        })->count();
         if($checkIfInvoiceHasThisProduct > 0){

             return back()->withInput()->with('danger','This Product is already recorded to this invoice..delete it and re-create it');
         }
        if($quantity == 0){
            return back()->withInput()->with('danger','Invalid quantity or Unit Cost');
        }
        if($quantity > $remainingStock){
            return back()->withInput()->with('danger','The remaining stock available for this product is ' . $remainingStock .'');
        }
        $clientToMakeInvoice->products()->attach($product,array(
        'invoice_product_id'=>Str::uuid(),
        'description'=>$description,
        'quantity'=>$quantity,
        'unit_cost'=>$unitCost,
        'total_cost'=>$totalCost
        ));
        $productName = Product::where('id',$product)->value('name');
        $stockToUpdate = Stock::where('product',$productName);
        $updateQuery = $stockToUpdate->update([
            'remainingQuantity'=>$stockToUpdate->value('remainingQuantity') - $quantity
        ]);
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
    public function viewInvoice($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $invoiceToView = Invoice::with('products')->find($id);
        $allProducts = Product::get();
        return view('Dashboard.invoices.view',compact('numberOfClients','allProducts','numberOfProducts','numberOfUsers','invoiceToView'));
    }
    public function addProductToExistingInvoice(Request $request)
    {
      $invoiceToAddProduct = Invoice::with('products')->where('id',$request->invoiceId)->first();
      $product = $request->product;
      $remainingStock = $request->remainingStock;
      $description = $request->description;
      $quantity = $request->quantity;
      $unitCost = $request->unitCost;
      $totalCost = $request->totalCost;
      $checkIfInvoiceHasThisProduct = Invoice::where('id',$invoiceToAddProduct->id)
        ->whereHas('products',function($q) use($product){
           $q->where('product_id',$product);
        })->count();
         if($checkIfInvoiceHasThisProduct > 0){

             return back()->withInput()->with('danger','This Product is already recorded to this invoice..delete it and re-create it');
         }
      if($quantity > $remainingStock){
        return back()->withInput()->with('danger','The remaining stock available for this product is ' . $remainingStock .'');
    }
      $invoiceToAddProduct->products()->attach($product,array(
        'invoice_product_id'=>Str::uuid(),
        'description'=>$description,
        'quantity'=>$quantity,
        'unit_cost'=>$unitCost,
        'total_cost'=>$totalCost
        ));
        $productName = Product::where('id',$product)->value('name');
        $stockToUpdate = Stock::where('product',$productName);
        $updateQuery = $stockToUpdate->update([
            'remainingQuantity'=>$stockToUpdate->value('remainingQuantity') - $quantity
        ]);
       return back();

    }
    public function deleteInvoice($id)
    {
        $invoiceToDelete = Invoice::with('products')->find($id);
        if($invoiceToDelete->products()->count() > 0){
            foreach($invoiceToDelete->products as $product){
                $stockQuantity = Stock::where('product',$product->name)->value('remainingQuantity');
                $stockToRestoreQuantity = Stock::where('product',$product->name)->update([
                    'remainingQuantity'=> $product->pivot->quantity + $stockQuantity
                    ]);
                    if($stockToRestoreQuantity){
                        $invoiceToDelete->products()->detach();
                        $invoiceToDelete->delete();
                    }
                }
                return redirect()->route('getAllInvoices')->with('success','Invoice deleted successfully');
        }else{
            $invoiceToDelete->delete();
            return redirect()->route('getAllInvoices')->with('success','Invoice deleted successfully');
        }
    }
    public function changeInvoiceStatus(Request $request)
    {
        $invoiceToUpdate = Invoice::where('id',$request->invoiceId)->first();
        if($invoiceToUpdate->status === "NOT PAID"){
            Invoice::where('id',$request->invoiceId)->update([
                'status'=>$request->paymentStatus
            ]);
            return back();
        }else{
            Invoice::where('id',$request->invoiceId)->update([
                'status'=>'NOT PAID'
            ]);
            return back();
        }
    }
    public function printPDF($id)
    {
        $invoiceToPrint = Invoice::with('products')->find($id);
        $clientTin = Client::where('client_Names',$invoiceToPrint->client)->value('TIN');
        $invoiceCreatedDate = $invoiceToPrint->date;
        $invoiceDueDate = date('Y-m-d',strtotime($invoiceCreatedDate. ' + 15 days'));
        $totalAmount = $invoiceToPrint->products->sum('pivot.total_cost');
        $eighteenPercent = round(($totalAmount *18) /100);
        $totalAmountWithoutEightheenPercent = $totalAmount - $eighteenPercent;
        return view('Dashboard.invoices.printInvoice',compact('invoiceToPrint','clientTin','invoiceDueDate','eighteenPercent','totalAmountWithoutEightheenPercent'));
    }
    public function deleteInvoiceItem(Request $request)
    {
       $productToDetach = Product::find($request->productId);
       $productName = Product::where('id',$request->productId)->value('name');
       $stockToUpdate = Stock::where('product',$productName);
       $invoice = Invoice::find($request->invoiceId);
       $productToDetachQuantity = Invoice::find($request->invoiceId)->products()->wherePivot('product_id',$request->productId)->value('quantity');
       $updateQuery = $stockToUpdate->update([
        'remainingQuantity'=>$stockToUpdate->value('remainingQuantity') + $productToDetachQuantity
       ]);
       if($updateQuery){
        if($invoice->products()->detach($productToDetach)){
            return back()->with('success','product removed successfully');
        }
       }
    }
    public function getInvoicesReportPeriodPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.reports.invoices.periodSelection',compact('numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function queryInvoicesReport(Request $request)
    {
       $year = $request->input('year');
       $month = $request->input('month');
       $startingDate = $request->input('startingDate');
       $endingDate = date('Y-m-d',strtotime($startingDate. ' + 7 days'));
       if($year && !$month){
           $invoiceToReport = Invoice::with('products')->whereYear('date',$year)->get();
        }elseif($year && $month){
           $invoiceToReport = Invoice::with('products')
           ->whereYear('date',$year)
           ->whereMonth('date',$month)
           ->get();
        }elseif(!$year && !$month && $startingDate){

            $invoiceToReport = Invoice::with('products')
            ->whereBetween('date',[$startingDate,$endingDate])
            ->get();
        }
        return view('Dashboard.reports.invoices.reportPage',compact('invoiceToReport','year','month','startingDate','endingDate'));
    }

}
