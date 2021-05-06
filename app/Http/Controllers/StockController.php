<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Supplier;
use App\Product;
use App\Client;
use App\Stock;
use App\User;
use App\Invoice;
use App\Stock_Record;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function getStockPage()
    {
        $allStock = Stock::with('stock_records')->get();
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
        if(Product::count() == 0){
            return back()->with('danger','please record products first');
        }
        if(Supplier::count() == 0){
            return back()->with('danger','please record suppliers first');
        }
        return view('Dashboard.stock.create',compact('numberOfClients','numberOfProducts','allProducts','allSuppliers','numberOfUsers'));

    }
    public function checkIfProductExistsInStock(Request $request)
    {
       if(Stock::where('product',$request->productId)->exists()){
           return "Exists";
       }else{
        return "Doesn't Exist";
       }
    }
    public function NewStockRegistration(Request $request)
    {
        $stockProduct = $request->stockProduct;
        $stockSupplier = $request->stockSupplier;
        $stockQuantity = $request->stockQuantity;
        $stockBuyingPrice = $request->stockBuyingPrice;
        $stockEntryDate = $request->stockEntryDate;
        $productSellingPrice = Product::where('name',$stockProduct)->value('price');
        $userNames = Auth::user()->first_Name . ' ' . Auth::user()->lastName;
        $userRole = Auth::user()->role;
         $checkStock = Stock::where('product',$stockProduct);
         if($checkStock->exists()){
            if(empty($stockQuantity)){
                return back()->withInput()->with('danger','provide the quantity');
            }
            if(!is_numeric($stockQuantity)){
                return back()->withInput()->with('danger','The stock quantity must be numeric');
            }
             //incrementing the existing stock quantity
            $updateExistingStock = $checkStock->update([
                'remainingQuantity'=>$checkStock->value('remainingQuantity') + $stockQuantity
            ]);
            if($updateExistingStock){
                $recordedStock = Stock_Record::create([
                    'id'=>Str::uuid()->toString(),
                    'stock_id'=>$checkStock->value('id'),
                    'date'=>date("Y-m-d"),
                    'recorded_quantity'=>$stockQuantity
                ]);
                if($recordedStock){
                   return redirect()->route('getAllStock')->with('success','Stock updated successfully');
                }
            }
         }else{
            if(empty($stockBuyingPrice) || empty($stockProduct) || empty($stockQuantity)|| empty($stockSupplier) || empty($stockEntryDate)){
                return back()->withInput()->with('danger','please fill all fields');
            }
            if(!is_numeric($stockQuantity) || !is_numeric($stockBuyingPrice)){
                return back()->withInput()->with('danger','The stock quantity and the stock buying price must be numeric');
            }
             //recording a new stock quantity
             $newStock = Stock::create([
                'id'=> Str::uuid()->toString(),
                'product'=>$stockProduct,
                'supplier'=>$stockSupplier,
                'buying_price'=>$stockBuyingPrice,
                'selling_price'=>$productSellingPrice,
                'date'=>$stockEntryDate,
                'remainingQuantity'=>$stockQuantity,
                'entry_by'=>$userNames .''.'('.''.$userRole.''.')'
             ]);
             if($newStock){
                 $recordedStock = Stock_Record::create([
                     'id'=>Str::uuid()->toString(),
                     'stock_id'=>$newStock->id,
                     'date'=>date("Y-m-d"),
                     'recorded_quantity'=>$stockQuantity
                 ]);
                 if($recordedStock){
                    return redirect()->route('getAllStock')->with('success','Stock recorded successfully');
                 }
             }
         }
    }
    public function getStockEditPage($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $allProducts = Product::get();
        $allSuppliers = Supplier::get();
        $stockToEdit = Stock::find($id);
        return view('Dashboard.stock.edit',compact('numberOfClients','numberOfProducts','allProducts','allSuppliers','stockToEdit','numberOfUsers'));
    }
    public function checkStockOut($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $stock = Stock::find($id)->value('product');
        $product = Product::where('name',$stock)->value('id');
        $allInvoicesContainingThisProduct = Invoice::with('products')
        ->whereHas('products',function($q) use($product){
           $q->where('product_id',$product);
        })->get();
        return view('Dashboard.stock.stockOut',compact('allInvoicesContainingThisProduct','stock','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function StockUpdate(Request $request , $id)
    {
        $stockToEdit = Stock::find($id);
        $stockProduct = $request->stockProduct;
        $stockSupplier = $request->stockSupplier;
        $stockBuyingPrice = $request->stockBuyingPrice;
        $stockEntryDate = $request->stockEntryDate;
        if(empty($stockBuyingPrice) || empty($stockProduct) || empty($stockSupplier) || empty($stockEntryDate)){
            return back()->withInput()->with('danger','please fill all fields');
        }
        if(!is_numeric($stockBuyingPrice)){
            return back()->withInput()->with('danger','The stock quantity and the stock buying price must be numeric');
        }
        $updateQuery = $stockToEdit->update([
            'product'=>$stockProduct,
            'supplier'=>$stockSupplier,
            'buying_price'=>$stockBuyingPrice,
            'date'=>$stockEntryDate,
        ]);
        if($updateQuery){
            return redirect()->route('getAllStock')->with('success','Stock Updated Successfully');
        }
        return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function stockDeletion($id)
    {

        $checkStockRecord = Stock_Record::where('stock_id',$id)->count();
        if($checkStockRecord > 0){
            Stock_Record::where('stock_id',$id)->delete();
            Stock::where('id',$id)->delete();
            return back()->with('success','stock deleted successful');
        }else{
            Stock::where('id',$id)->delete();
            return back()->with('success','stock deleted successful');
        }
    }
}


