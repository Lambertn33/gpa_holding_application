<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Supplier;
use App\Product;
use App\Client;
use App\Stock;
use App\User;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function getStockPage()
    {
        $allStock = Stock::get();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.stock.index',compact('allStock','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function getNewStockRegistrationPage()
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $allProducts = Product::get();
        $allSuppliers = Supplier::get();
        $numberOfUsers = User::count();
        return view('Dashboard.stock.create',compact('numberOfClients','numberOfProducts','allProducts','allSuppliers','numberOfUsers'));

    }
    public function NewStockRegistration(Request $request)
    {
        $stockProduct = $request->stockProduct;
        $stockSupplier = $request->stockSupplier;
        $stockQuantity = $request->stockQuantity;
        $stockBuyingPrice = $request->stockBuyingPrice;
        $stockEntryDate = $request->stockEntryDate;
        if(empty($stockBuyingPrice) || empty($stockProduct) || empty($stockQuantity)|| empty($stockSupplier) || empty($stockEntryDate)){
            return back()->withInput()->with('danger','please fill all fields');
        }
        if(!is_numeric($stockQuantity) || !is_numeric($stockBuyingPrice)){
            return back()->withInput()->with('danger','The stock quantity and the stock buying price must be numeric');
        }
        $userNames = Auth::user()->first_Name . ' ' . Auth::user()->lastName.' '.(Auth::user()->role);
        $newStock = Stock::create([
            'id'=> Str::uuid()->toString(),
            'product'=>$stockProduct,
            'supplier'=>$stockSupplier,
            'quantity'=>$stockQuantity,
            'buying_price'=>$stockBuyingPrice,
            'date'=>$stockEntryDate,
            'selling_price'=>600,
            'entry_by'=>$userNames
            ]);
            if($newStock){
                return redirect()->route('getAllStock')->with('success','New Stock Registered Successfully');
            }
            return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function getStockEditPage($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $allProducts = Product::get();
        $allSuppliers = Supplier::get();
        $stockToEdit = Stock::find($id);
        $numberOfUsers = User::count();
        return view('Dashboard.stock.edit',compact('numberOfClients','numberOfProducts','allProducts','allSuppliers','stockToEdit','numberOfUsers'));
    }
    public function StockUpdate(Request $request , $id)
    {
        $stockToEdit = Stock::find($id);
        $stockProduct = $request->stockProduct;
        $stockSupplier = $request->stockSupplier;
        $stockQuantity = $request->stockQuantity;
        $stockBuyingPrice = $request->stockBuyingPrice;
        $stockEntryDate = $request->stockEntryDate;
        if(empty($stockBuyingPrice) || empty($stockProduct) || empty($stockQuantity)|| empty($stockSupplier) || empty($stockEntryDate)){
            return back()->withInput()->with('danger','please fill all fields');
        }
        if(!is_numeric($stockQuantity) || !is_numeric($stockBuyingPrice)){
            return back()->withInput()->with('danger','The stock quantity and the stock buying price must be numeric');
        }
        $updateQuery = $stockToEdit->update([
            'product'=>$stockProduct,
            'supplier'=>$stockSupplier,
            'quantity'=>$stockQuantity,
            'buying_price'=>$stockBuyingPrice,
            'date'=>$stockEntryDate,
        ]);
        if($updateQuery){
            return redirect()->route('getAllStock')->with('success','Stock Updated Successfully');
        }
        return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function stockDeletion($id){
        if(Stock::find($id)->delete()){
            return back()->with('success','Stock Deleted successfully');
        }
        return back()->with('danger','an error occured..please try again');
      }
}
