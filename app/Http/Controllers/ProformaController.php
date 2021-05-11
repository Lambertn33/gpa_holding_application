<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proforma;
use App\Client;
use App\User;
use App\Product;
use App\Invoice;
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
             //return $request->session()->get('clientToMakeProforma');
              return redirect()->route('getNewProformaRegistrationPage');
        }
    }
    public function saveProductToMakeProforma(Request $request)
    {
    $product = Product::where('id',$request->productId)->first();
    return $product->price;
    }
    public function getNewProformaRegistrationPage(Request $request)
    {

        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allClients = Client::get();
        $allProducts = Product::get();
        $clientToMakeProforma = $request->session()->get('clientToMakeProforma');
        $client = Client::where('id',$clientToMakeProforma->client_id)->first();
        $clientToMakeProforma  = Proforma::with('products')->find($clientToMakeProforma->id);
       // return $client;
       // return $clientToMakeProforma;
       return view('Dashboard.invoices.proforma.create',compact('numberOfClients','numberOfProducts','numberOfUsers','allClients','allProducts','clientToMakeProforma','client'));
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
            return redirect()->route('getAllProformas')->with('success','Proforma canceled successfully');
        }
    }
    public function viewProforma($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allProducts = Product::get();
        $proformaToView = Proforma::with('products')->with('client')->find($id);
        //return $proformaToView;
        return view('Dashboard.invoices.proforma.view',compact('numberOfClients','allProducts','numberOfProducts','numberOfUsers','proformaToView'));
    }
    public function getProformaDetails($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $clientToView = Client::with('proformas')->find($id);
         return view('Dashboard.invoices.proforma.view',compact('numberOfClients','numberOfProducts','numberOfUsers','clientToView'));

    }
    public function addProductToExistingProforma(Request $request)
    {
      $proformaToAddProduct = Proforma::with('products')->where('id',$request->proformaId)->first();
      $product = $request->product;
      $description = $request->description;
      $quantity = $request->quantity;
      $unitCost = $request->unitCost;
      $totalCost = $request->totalCost;
      $proformaToAddProduct->products()->attach($product,array(
        'proforma_product_id'=>Str::uuid(),
        'description'=>$description,
        'quantity'=>$quantity,
        'unit_cost'=>$unitCost,
        'total_cost'=>$totalCost
        ));
       return back();

    }
    public function deleteProformaItem(Request $request)
    {
       // return $request->all();
       $productToDetach = Product::find($request->productId);
       $proforma = Proforma::find($request->proformaId);
       if($proforma->products()->detach($productToDetach)){
           return back()->with('success','product removed successfully');
       }
    }
    public function changeProformaToInvoice($id)
    {
        $proformaToMakeInvoice = Proforma::with('client')->with('products')->find($id);
        $newInvoiceFromProforma = Invoice::create([
            'id'=> Str::uuid()->toString(),
            'client'=>$proformaToMakeInvoice->client->client_Names,
            'date'=>$proformaToMakeInvoice->date,
            'isConfirmed'=>$proformaToMakeInvoice->isConfirmed,
            'status'=>$proformaToMakeInvoice->status,
        ]);
        if($newInvoiceFromProforma){
            foreach($proformaToMakeInvoice->products as $product){
                $newInvoiceFromProforma->products()->attach($product,array(
                    'invoice_product_id'=>Str::uuid(),
                    'description'=>$product->pivot->description,
                    'quantity'=>$product->pivot->quantity,
                    'unit_cost'=>$product->pivot->unit_cost,
                    'total_cost'=>$product->pivot->total_cost
                    ));
            }
            return back()->with('success','Proforma Changed to invoice successfully');
        }
    }

    public function changeProformaStatus(Request $request)
    {
        $proformaToUpdate = Proforma::where('id',$request->proformaId)->first();
        if($proformaToUpdate->status === "NOT PAID"){
           // return $request->all();
            Proforma::where('id',$request->proformaId)->update([
                'status'=>$request->paymentStatus
            ]);
            return back();
        }else{
            Proforma::where('id',$request->proformaId)->update([
                'status'=>'NOT PAID'
            ]);
            return back();
        }
    }
    public function printPDF($id)
    {
         $proformaToPrint = Proforma::with('products')->with('client')->find($id);
         $clientTin = Client::where('id',$proformaToPrint->client_id)->value('TIN');
         $totalAmount = $proformaToPrint->products->sum('pivot.total_cost');
         $eighteenPercent = round(($totalAmount *18) /100);
         $totalAmountWithoutEightheenPercent = $totalAmount - $eighteenPercent;
         return view('Dashboard.invoices.proforma.printProforma',compact('proformaToPrint','clientTin','eighteenPercent','totalAmountWithoutEightheenPercent'));
    }
    public function getProformasReportPeriodPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.reports.proformas.periodSelection',compact('numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function queryProformasReport(Request $request)
    {
       $year = $request->input('year');
       $month = $request->input('month');
       $startingDate = $request->input('startingDate');
       $endingDate = date('Y-m-d',strtotime($startingDate. ' + 7 days'));
       if($year && !$month){
           $proformaToReport = Proforma::with('products')->whereYear('date',$year)->get();
        }elseif($year && $month){
           $proformaToReport = Proforma::with('products')
           ->whereYear('date',$year)
           ->whereMonth('date',$month)
           ->get();
        }elseif(!$year && !$month && $startingDate){

            $proformaToReport = Proforma::with('products')
            ->whereBetween('date',[$startingDate,$endingDate])
            ->get();
        }
        return view('Dashboard.reports.proformas.reportPage',compact('proformaToReport','year','month','startingDate','endingDate'));
    }
}
