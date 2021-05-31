<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GodownController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;



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

Route::get('/foo', function () {
Artisan::call('storage:link');
Artisan::call('route:cache');
Artisan::call('route:clear');
Artisan::call('cache:clear');
Artisan::call('config:clear');
echo "Clear";
});


Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('/dashboard', 'HomeController@index')->name('index')->middleware('auth');
Route::resource('products','ProductController')->middleware('auth');
Route::resource('product-names','ProductNameController')->middleware('auth');
Route::resource('godowns','GodownController')->middleware('auth');
Route::resource('shipments','ShipmentController')->middleware('auth');
Route::resource('shipment-types','ShipmentTypeController')->middleware('auth');
Route::resource('categories','CategoryController')->middleware('auth');
Route::resource('couriers','CourierController')->middleware('auth');
Route::resource('customers','CustomerController')->middleware('auth');
Route::resource('packlists','PackListController')->middleware('auth');
Route::resource('manifest','ManifestController')->middleware('auth');


Route::get('/product_name/{id}', 'ProductController@product_name')->name('product_name')->middleware('auth');
Route::get('/product_category/{id}', 'ProductController@product_category')->name('product_category')->middleware('auth');
Route::get('/product_godown/{id}', 'ProductController@product_godown')->name('product_godown')->middleware('auth');
Route::get('/table_category/{id}', 'ProductController@table_category')->name('table_category')->middleware('auth');
Route::get('/create-packlist', 'PackListController@index')->name('create-packlist')->middleware('auth');


Route::get('packlists-godown/{id}', 'PackListController@packlist_godown')->name('packlists-godown')->middleware('auth');
Route::get('packlists-quantity/{product_id}/{godown_id}', 'PackListController@packlist_quantity')->name('packlists-quantity')->middleware('auth');
Route::get('packlists-export', 'PackListController@packlist_export')->name('packlists-export')->middleware('auth');
Route::get('clear-packlist', 'PackListController@clear_packlist')->name('clear-packlist')->middleware('auth');


Route::get('/shipment_type/{id}', 'ShipmentController@shipment_type')->name('shipment_type')->middleware('auth');
Route::get('/courier_name/{id}', 'ShipmentController@courier_name')->name('courier_name')->middleware('auth');
Route::get('/manifest_courier_name/{id}', 'ManifestController@manifest_courier_name')->name('manifest_courier_name')->middleware('auth');

Route::get('products-import-export', [ProductController::class, 'fileImportExport'])->middleware('auth');
Route::get('tracking-number-import', [ShipmentController::class, 'fileImportExport'])->middleware('auth');
Route::post('file_import', [ProductController::class, 'fileImport'])->name('file_import')->middleware('auth');
Route::post('tracking-number-import', [ShipmentController::class, 'fileImport'])->middleware('auth');
Route::get('file-export', [ProductController::class, 'fileExport'])->name('file-export')->middleware('auth');

require __DIR__.'/auth.php';
