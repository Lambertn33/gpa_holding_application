<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Category;
use App\Product;
use App\User;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function getCategoriesPage()
    {
        $allCategories = Category::get();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        return view('Dashboard.categories.index',compact('allCategories','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function getNewCategoryRegistrationPage()
    {
        $numberOfUsers = User::count();
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        return view('Dashboard.categories.create',compact('numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function NewCategoryRegistration(Request $request)
    {
        $categoryName = $request->categoryName;
        $categoryDetails = $request->categoryDetails;

        if(empty($categoryName)){
            return back()->with('danger','The category name cannot be empty');
        }
        $checkCategoryName = Category::where('name',$categoryName);
        if($checkCategoryName->exists()){
            return back()->with('danger','the category with such name already exists');
        }
        $newCategory = Category::create([
            'id'=> Str::uuid()->toString(),
            'name'=>$categoryName,
            'details'=>$categoryDetails,
          ]);
          if($newCategory){
              return redirect()->route('getAllCategories')->with('success','New Category Registered Successfully');
          }
          return back()->withInput()->with('danger','an error occured...please try again');
    }
    public function getCategoryEditPage($id)
    {
        $numberOfClients = Client::count();
        $numberOfProducts = Product::count();
        $numberOfUsers = User::count();
        $categoryToEdit = Category::find($id);
        return view('Dashboard.categories.edit',compact('categoryToEdit','numberOfClients','numberOfProducts','numberOfUsers'));
    }
    public function CategoryUpdate($id , Request $request)
    {
        $categoryToUpdate = Category::find($id);
        $categoryName = $request->categoryName;
        $categoryDetails = $request->categoryDetails;

        if(empty($categoryName)){
            return back()->with('danger','The category name cannot be empty');
        }
        $checkCategoryName = Category::where('name',$categoryName);
        if($checkCategoryName->exists()){
            if($checkCategoryName->value('id')!== $id){
                return back()->with('danger','the category with such name already exists');
            }
        }
        $categoryUpdateQuery = $categoryToUpdate->update([
            'name'=>$categoryName,
            'details'=>$categoryDetails,
          ]);
          if($categoryUpdateQuery){
              return redirect()->route('getAllCategories')->with('success','Category Updated Successfully');
          }
          return back()->withInput()->with('danger','an error occured. please try again');
    }
    public function categoryDeletion($id){
        if(Category::find($id)->delete()){
            return back()->with('success','Category Deleted successfully');
        }
        return back()->with('danger','an error occured..please try again');
      }
}
