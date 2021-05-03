<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LoggedInMiddleware;

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

//Users Route
Route::get('/home/users','UserController@getAllUsers')->name('getAllUsers');
Route::get('/home/users/create','UserController@getNewUserRegistrationPage')->name('getNewUserRegistrationPage');
Route::post('/home/users/create','UserController@NewUserRegistration')->name('NewUserRegistration');
Route::get('/home/users/{id}/edit','UserController@getUserEditPage')->name('userEditPage');
Route::put('/home/users/{id}/edit','UserController@userUpdate')->name('userUpdate');
Route::get('/home/users/{id}/editStatus','UserController@userUpdateStatus')->name('userUpdateStatus');

});

Route::middleware([LoggedInMiddleware::class])->group(function(){
    //Stock Route
Route::get('/home/stock','StockController@getStockPage')->name('getAllStock');
Route::get('/home/stock/create','StockController@getNewStockRegistrationPage')->name('getNewStockRegistrationPage');
Route::post('/home/stock/create','StockController@NewStockRegistration')->name('NewStockRegistration');
Route::get('/home/stock/{id}/edit','StockController@getStockEditPage')->name('stockEditPage');
Route::put('/home/stock/{id}/edit','StockController@StockUpdate')->name('stockUpdate');
Route::get('/home/stock/{id}/delete','StockController@stockDeletion')->name('stockDeletion');

//suppliers Route
Route::get('/home/suppliers','SupplierController@getSuppliersPage')->name('getAllSuppliers');
Route::get('/home/suppliers/create','SupplierController@getNewSupplierRegistrationPage')->name('getNewSupplierRegistrationPage');
Route::post('/home/suppliers/create','SupplierController@NewSupplierRegistration')->name('NewSupplierRegistration');
Route::get('/home/suppliers/{id}/edit','SupplierController@getSupplierEditPage')->name('supplierEditPage');
Route::put('/home/suppliers/{id}/edit','SupplierController@SupplierUpdate')->name('supplierUpdate');
Route::get('/home/suppliers/{id}/delete','SupplierController@supplierDeletion')->name('supplierDeletion');

//Invoices Route
Route::get('/home/invoices','InvoiceController@getInvoicesPage')->name('getAllInvoices');
Route::get('/home/invoices/clientSelection','InvoiceController@getClientToMakeInvoice')->name('getClientToMakeInvoice');
Route::post('/home/invoices/clientSelection','InvoiceController@saveClientToMakeInvoice')->name('saveClientToMakeInvoice');
Route::post('/home/invoices/productSelection','InvoiceController@saveProductToMakeInvoice')->name('saveProductToMakeInvoice');
Route::get('/home/invoices/create','InvoiceController@getNewInvoiceRegistrationPage')->name('getNewInvoiceRegistrationPage');
Route::post('/home/invoices/create','InvoiceController@NewInvoiceRegistration')->name('NewInvoiceRegistration');
Route::get('/home/invoices/{id}/confirmInvoice','InvoiceController@confirmInvoice')->name('confirmInvoice');
Route::get('/home/invoices/{id}/viewInvoice','InvoiceController@viewInvoice')->name('viewInvoice');
Route::put('/home/invoices/changeInvoiceStatus','InvoiceController@changeInvoiceStatus')->name('changeInvoiceStatus');
Route::get('/home/invoices/{id}/deleteInvoice','InvoiceController@deleteInvoice')->name('deleteInvoice');
Route::post('/home/invoices/addProductToExistingInvoice','InvoiceController@addProductToExistingInvoice')->name('addProductToExistingInvoice');
Route::post('/home/invoices/deleteInvoiceItem','InvoiceController@deleteInvoiceItem')->name('deleteInvoiceItem');
Route::get('/home/invoices/{id}/getInvoiceToPrint/print','InvoiceController@printPDF')->name('printInvoicePDF');


//Proforma Route
Route::get('/home/proformas','ProformaController@getProformasPage')->name('getAllProformas');
Route::get('/home/proformas/clientSelection','ProformaController@getClientToMakeProforma')->name('getClientToMakeProforma');
Route::post('/home/proformas/clientSelection','ProformaController@saveClientToMakeProforma')->name('saveClientToMakeProforma');
Route::post('/home/proformas/productSelection','ProformaController@saveProductToMakeProforma')->name('saveProductToMakeProforma');
Route::get('/home/proformas/create','ProformaController@getNewProformaRegistrationPage')->name('getNewProformaRegistrationPage');
Route::post('/home/proformas/create','ProformaController@NewProformaRegistration')->name('NewProformaRegistration');
Route::get('/home/proformas/{id}/confirmProforma','ProformaController@confirmProforma')->name('confirmProforma');
Route::get('/home/proformas/{id}/viewProforma','ProformaController@viewProforma')->name('viewProforma');
Route::put('/home/proformas/changeProformaStatus','ProformaController@changeProformaStatus')->name('changeProformaStatus');
Route::get('/home/proformas/{id}/deleteProforma','ProformaController@deleteProforma')->name('deleteProforma');
Route::get('/home/proformas/{id}/changeProformaToInvoice','ProformaController@changeProformaToInvoice')->name('changeProformaToInvoice');
Route::post('/home/proformas/addProductToExistingProforma','ProformaController@addProductToExistingProforma')->name('addProductToExistingProforma');
Route::post('/home/proformas/deleteProformaItem','ProformaController@deleteProformaItem')->name('deleteProformaItem');
Route::get('/home/proformas/{id}','ProformaController@getProformaDetails')->name('getProformaDetails');
Route::get('/home/proformas/{id}/getProformaToPrint/print','ProformaController@printPDF')->name('printProformaPDF');

//Receipts Route
Route::get('/home/receipts','ReceiptController@getReceiptsPage')->name('getAllReceipts');
Route::get('/home/receipts/clientSelection','ReceiptController@getClientToMakeReceipt')->name('getClientToMakeReceipt');
Route::post('/home/receipts/clientSelection','ReceiptController@saveClientToMakeReceipt')->name('saveClientToMakeReceipt');
Route::post('/home/receipts/productSelection','ReceiptController@saveProductToMakeReceipt')->name('saveProductToMakeReceipt');
Route::get('/home/receipts/create','ReceiptController@getNewReceiptRegistrationPage')->name('getNewReceiptRegistrationPage');
Route::post('/home/receipts/create','ReceiptController@NewReceiptRegistration')->name('NewReceiptRegistration');
Route::get('/home/receipts/{id}/deleteReceipt','ReceiptController@deleteReceipt')->name('deleteReceipt');
Route::post('/home/receipts/deleteReceiptItem','ReceiptController@deleteReceiptItem')->name('deleteReceiptItem');
Route::get('/home/receipts/{id}/confirmReceipt','ReceiptController@confirmReceipt')->name('confirmReceipt');
Route::get('/home/receipts/{id}/viewReceipt','ReceiptController@viewReceipt')->name('viewReceipt');
Route::post('/home/receipts/addProductToExistingReceipt','ReceiptController@addProductToExistingReceipt')->name('addProductToExistingReceipt');
});


