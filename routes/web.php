<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GodownController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ManifestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;



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
Route::get('dashboard', 'HomeController@index')->name('index')->middleware('auth');
Route::resource('products','ProductController')->middleware('auth');
Route::resource('product-names','ProductNameController')->middleware('auth');
Route::resource('godowns','GodownController')->middleware('auth');
Route::resource('shipments','ShipmentController')->middleware('auth');
Route::resource('shipment-types','ShipmentTypeController')->middleware('auth');
Route::resource('categories','CategoryController')->middleware('auth');
Route::resource('couriers','CourierController')->middleware('auth');
Route::resource('customers','CustomerController')->middleware('auth');
Route::resource('packlists','PackListController')->middleware('auth');
Route::resource('menifest','ManifestController')->middleware('auth');
Route::resource('crms','CRMController')->middleware('auth');

Route::resource('users','UserController')->middleware('auth');
Route::resource('profile','UserController')->middleware('auth');
Route::get('users-delete/{id}','UserController@destroy')->middleware('auth');
Route::get('crms-delete/{id}','CRMController@destroy')->middleware('auth');
Route::get('crm-details/{id}','CRMController@details')->middleware('auth');
Route::post('crm-post-update','CRMController@crm_post_update')->middleware('auth');

Route::get('all-menifests', 'ManifestController@all_menifests')->name('all-menifests')->middleware('auth');
Route::post('save-menifest', 'ManifestController@store_menifest')->name('save-menifest')->middleware('auth');
Route::get('delete-menifest/{id}', 'ManifestController@delete_menifest')->name('delete-menifest')->middleware('auth');
Route::get('view-menifest-list/{id}', 'ManifestController@view_menifest_list')->name('view-menifest-list')->middleware('auth');
Route::post('update-menifest-list', 'ManifestController@update_menifest_list')->name('update-menifest-list')->middleware('auth');
Route::get('delete-menifest-list/{id}', 'ManifestController@delete_menifest_list')->name('delete-menifest-list')->middleware('auth');
Route::get('view-menifest-list/shipments/edit/{id}', 'ShipmentController@edit')->name('view-menifest-list/shipments/edit/{id}')->middleware('auth');
Route::get('view-menifest-list-data', 'ManifestController@view_menifest_list_data')->name('view-menifest-list-data')->middleware('auth');
Route::get('create-menifest-list', 'ManifestController@create_menifest_list')->name('create-menifest-list')->middleware('auth');
Route::get('menifest-export/{id}', [ManifestController::class, 'menifest_export'])->name('menifest-export')->middleware('auth');


Route::get('single-product-outward', 'SinglePacklistController@single_product_outward')->name('single-product-outward')->middleware('auth');
Route::get('single-packlist', 'SinglePacklistController@single_packlist')->name('single-packlist')->middleware('auth');
Route::post('single-packlist-store', 'SinglePacklistController@single_packlist_store')->name('single-packlist-store')->middleware('auth');
Route::post('single-packlist-pdf', 'SinglePacklistController@single_packlist_pdf')->name('single-packlist-pdf')->middleware('auth');


Route::get('product_name/{id}', 'ProductController@product_name')->name('product_name')->middleware('auth');
Route::get('product_category/{id}', 'ProductController@product_category')->name('product_category')->middleware('auth');
Route::get('product_godown/{id}', 'ProductController@product_godown')->name('product_godown')->middleware('auth');
Route::get('table_category/{id}', 'ProductController@table_category')->name('table_category')->middleware('auth');
Route::get('create-packlist', 'PackListController@index')->name('create-packlist')->middleware('auth');


Route::get('packlists-godown/{id}', 'PackListController@packlist_godown')->name('packlists-godown')->middleware('auth');
Route::get('packlists-quantity/{product_id}/{godown_id}', 'PackListController@packlist_quantity')->name('packlists-quantity')->middleware('auth');
Route::get('packlists-export', 'PackListController@packlist_export')->name('packlists-export')->middleware('auth');
Route::get('clear-packlist', 'PackListController@clear_packlist')->name('clear-packlist')->middleware('auth');


Route::get('shipment_type/{id}', 'ShipmentController@shipment_type')->name('shipment_type/{id}')->middleware('auth');
Route::get('courier_name/{id}', 'ShipmentController@courier_name')->name('courier_name/{id}')->middleware('auth');

Route::get('view-menifest-list/shipment_type/{id}', 'ShipmentController@shipment_type')->name('view-menifest-list/shipment_type/{id}')->middleware('auth');
Route::get('view-menifest-list/courier_name/{id}', 'ShipmentController@courier_name')->name('view-menifest-list/courier_name/{id}')->middleware('auth');
Route::post('view-menifest-list/shipments', 'ShipmentController@store')->name('view-menifest-list/shipments')->middleware('auth');
Route::get('manifest_courier_name/{id}', 'ManifestController@manifest_courier_name')->name('manifest_courier_name')->middleware('auth');

Route::get('products-import-export', [ProductController::class, 'fileImportExport'])->middleware('auth');
Route::get('tracking-number-import', [ShipmentController::class, 'fileImportExport'])->middleware('auth');
Route::post('file_import', [ProductController::class, 'fileImport'])->name('file_import')->middleware('auth');
Route::post('tracking-number-import', [ShipmentController::class, 'fileImport'])->middleware('auth');
Route::get('file-export', [ProductController::class, 'fileExport'])->name('file-export')->middleware('auth');

Route::post('autocomplete-products', 'AutocompleteController@products')->name('autocomplete-products');
Route::post('autocomplete-all-products', 'AutocompleteController@product_name')->name('autocomplete-all-products');

require __DIR__.'/auth.php';
