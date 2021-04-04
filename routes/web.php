<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

Auth::routes();

//Dashboard
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware([AdminMiddleware::class])->group(function(){
//Clients Route
Route::get('/home/clients','ClientController@getClientsPage')->name('getAllClients');
Route::get('/home/clients/create','ClientController@getNewClientRegistrationPage')->name('getNewClientRegistrationPage');
Route::post('/home/clients/create','ClientController@NewClientRegistration')->name('NewClientRegistration');
Route::get('/home/clients/{id}/edit','ClientController@getClientEditPage')->name('clientEditPage');
Route::put('/home/clients/{id}/edit','ClientController@ClientUpdate')->name('clientUpdate');
Route::get('/home/clients/{id}/delete','ClientController@ClientDeletion')->name('clientDeletion');

//Categories Route
Route::get('/home/categories','CategoryController@getCategoriesPage')->name('getAllCategories');
Route::get('/home/categories/create','CategoryController@getNewCategoryRegistrationPage')->name('getNewCategoryRegistrationPage');
Route::post('/home/categories/create','CategoryController@NewCategoryRegistration')->name('NewCategoryRegistration');
Route::get('/home/categories/{id}/edit','CategoryController@getCategoryEditPage')->name('categoryEditPage');
Route::put('/home/categories/{id}/edit','CategoryController@CategoryUpdate')->name('categoryUpdate');
Route::get('/home/categories/{id}/delete','CategoryController@CategoryDeletion')->name('categoryDeletion');

//products Route
Route::get('/home/products','ProductController@getProductsPage')->name('getAllProducts');
Route::get('/home/products/create','ProductController@getNewProductRegistrationPage')->name('getNewProductRegistrationPage');
Route::post('/home/products/create','ProductController@NewProductRegistration')->name('NewProductRegistration');
Route::get('/home/products/{id}/edit','ProductController@getProductEditPage')->name('productEditPage');
Route::put('/home/products/{id}/edit','ProductController@ProductUpdate')->name('productUpdate');
Route::get('/home/products/{id}/delete','ProductController@productDeletion')->name('productDeletion');


//suppliers Route
Route::get('/home/suppliers','SupplierController@getSuppliersPage')->name('getAllSuppliers');
Route::get('/home/suppliers/create','SupplierController@getNewSupplierRegistrationPage')->name('getNewSupplierRegistrationPage');
Route::post('/home/suppliers/create','SupplierController@NewSupplierRegistration')->name('NewSupplierRegistration');
Route::get('/home/suppliers/{id}/edit','SupplierController@getSupplierEditPage')->name('supplierEditPage');
Route::put('/home/suppliers/{id}/edit','SupplierController@SupplierUpdate')->name('supplierUpdate');
Route::get('/home/suppliers/{id}/delete','SupplierController@supplierDeletion')->name('supplierDeletion');

//Stock Route
Route::get('/home/stock','StockController@getStockPage')->name('getAllStock');
Route::get('/home/stock/create','StockController@getNewStockRegistrationPage')->name('getNewStockRegistrationPage');
Route::post('/home/stock/create','StockController@NewStockRegistration')->name('NewStockRegistration');
Route::get('/home/stock/{id}/edit','StockController@getStockEditPage')->name('stockEditPage');
Route::put('/home/stock/{id}/edit','StockController@StockUpdate')->name('stockUpdate');
Route::get('/home/stock/{id}/delete','StockController@stockDeletion')->name('stockDeletion');

//Users Route
Route::get('/home/users','UserController@getAllUsers')->name('getAllUsers');
Route::get('/home/users/create','UserController@getNewUserRegistrationPage')->name('getNewUserRegistrationPage');
Route::post('/home/users/create','UserController@NewUserRegistration')->name('NewUserRegistration');
Route::get('/home/users/{id}/edit','UserController@getUserEditPage')->name('userEditPage');
Route::put('/home/users/{id}/edit','UserController@userUpdate')->name('userUpdate');
Route::get('/home/users/{id}/editStatus','UserController@userUpdateStatus')->name('userUpdateStatus');

});


