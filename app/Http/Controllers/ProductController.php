<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Category;
use App\User;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function getProductsPage()
    {
        $allProducts = Product::with('category')->get();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.products.index',compact('allProducts','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function getNewProductRegistrationPage()
    {
        $allCategories = Category::get();
        $numberOfProducts = Product::count();
        $numberOfClients = Client::count();
        $numberOfUsers = User::count();
        return view('Dashboard.products.create',compact('numberOfClients','numberOfProducts','allCategories','numberOfUsers'));
    }
    public function NewProductRegistration(Request $request)
    {
       $productName = $request->productName;
       $productPrice = $request->productPrice;
       $productCategory = $request->productCategory;
       $productDetails = $request->productDetails;

       if(empty($productCategory) || empty($productPrice) || empty($productName)){
           return back()->with('danger','only the product details can be optional');
       }
       $newProduct = Product::create([
           'id'=> Str::uuid()->toString(),
           'name'=>$productName,
           'details'=>$productDetails,
        'category_id'=>$productCategory,
        'price'=>$productPrice
        ]);
        if($newProduct){
            return redirect()->route('getAllProducts')->with('success','New Product Registered Successfully');
        }
        return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function getProductEditPage($id)
    {
        $allCategories = Category::get();
        $numberOfProducts = Product::count();
        $numberOfClients = Client::count();
        $productToEdit = Product::find($id);
        $numberOfUsers = User::count();
        return view('Dashboard.products.edit',compact('productToEdit','numberOfClients','numberOfProducts','allCategories','numberOfUsers'));
    }
    public function productUpdate($id , Request $request)
    {
        $productName = $request->productName;
        $productPrice = $request->productPrice;
        $productCategory = $request->productCategory;
        $productDetails = $request->productDetails;
        $productToUpdate = Product::find($id);
        if(empty($productCategory) || empty($productPrice) || empty($productName)){
            return back()->with('danger','only the product details can be optional');
        }
        $productUpdateQuery = $productToUpdate->update([
            'name'=>$productName,
            'details'=>$productDetails,
            'category_id'=>$productCategory,
            'price'=>$productPrice
          ]);
          if($productUpdateQuery){
              return redirect()->route('getAllProducts')->with('success','Product Updated Successfully');
          }
          return back()->withInput()->with('danger','an error occured. please try again');
    }
    public function productDeletion($id){
        if(Product::find($id)->delete()){
            return back()->with('success','Product Deleted successfully');
        }
        return back()->with('danger','an error occured..please try again');
      }
}
