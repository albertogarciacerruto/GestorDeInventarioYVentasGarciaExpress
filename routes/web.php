<?php

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
    return redirect('login');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
    //Inicia Grupo de Rutas para usuarios
    Route::get('/users', 'UserController@list_users');
    Route::get('/users_destroy/{id}', 'UserController@destroy');
    Route::get('/users_block/{id}', 'UserController@block');
    Route::get('/users_unlock/{id}', 'UserController@unlock');
    Route::get('/users_edit/{id}', 'UserController@edit');
    Route::post('/users_edit', 'UserController@update');
    Route::get('/users_pass/{id}', 'UserController@edit_pass');
    Route::post('/users_pass', 'UserController@update_pass');
    Route::get('/profile_edit/{id}', 'UserController@edit_profile');
    Route::post('/profile_edit', 'UserController@update_profile');
    Route::get('/profile_pass/{id}', 'UserController@edit_pass');
    Route::post('/profile_pass', 'UserController@update_pass');
    //Termina Grupo de Rutas para Usuarios

    //Inicia Grupo de Rutas para Ubicaciones
    Route::get('/locations', 'LocationController@list_locations');
    Route::get('/register_location', 'LocationController@register');
    Route::post('/register_location', 'LocationController@register_location');
    Route::get('/locations_destroy/{id}', 'LocationController@destroy');
    Route::get('/locations_edit/{id}', 'LocationController@edit');
    Route::post('/locations_edit', 'LocationController@update');
    //Termina Grupo de Rutas para Ubicaciones

    //Inicia Grupo de Rutas para Proveedores
    Route::get('/providers', 'ProviderController@list_providers');
    Route::get('/register_provider', 'ProviderController@register');
    Route::post('/register_provider', 'ProviderController@register_provider');
    Route::get('/provider_destroy/{id}', 'ProviderController@destroy');
    Route::get('/provider_edit/{id}', 'ProviderController@edit');
    Route::post('/providers_edit', 'ProviderController@update');
    //Termina Grupo de Rutas para Proveedores

    //Inicia Grupo de Rutas para IVA
    Route::get('/iva', 'IvaController@list_iva');
    Route::get('/register_iva', 'IvaController@register');
    Route::post('/register_iva', 'IvaController@register_iva');
    Route::get('/iva_destroy/{id}', 'IvaController@destroy');
    Route::get('/iva_edit/{id}', 'IvaController@edit');
    Route::post('/iva_edit', 'IvaController@update');
    Route::get('/iva_active/{id}', 'IvaController@active');
    //Termina Grupo de Rutas para IVA

    //Inicia Grupo de Rutas para Formas de Pago
    Route::get('/payments', 'PaymentController@list_payments');
    Route::get('/register_payment', 'PaymentController@register');
    Route::post('/register_payment', 'PaymentController@register_payment');
    Route::get('/payments_destroy/{id}', 'PaymentController@destroy');
    Route::get('/payments_edit/{id}', 'PaymentController@edit');
    Route::post('/payments_edit', 'PaymentController@update');
    //Termina Grupo de Rutas para Formas de Pago

    //Inicia Grupo de Rutas para ProductosFinales
    Route::get('/products', 'ProductController@list_products');
    Route::get('/register_product', 'ProductController@register');
    Route::post('/register_product', 'ProductController@register_product');
    Route::get('/products_destroy/{id}', 'ProductController@destroy');
    Route::get('/products_edit/{id}', 'ProductController@edit');
    Route::post('/products_edit', 'ProductController@update');
    Route::get('/products_upload/{id}', 'ProductController@upload');
    //Termina Grupo de Rutas para ProductosFinales

    //Inicia Grupo de Rutas para Inventario de ProductosFinales
    Route::get('/inventories', 'InventoryController@list_inventories');
    Route::post('/register_inventory', 'InventoryController@register_inventory');
    Route::get('/inventories_destroy/{id}/{iden}', 'InventoryController@destroy');
    Route::get('/inventories_edit/{id}', 'InventoryController@edit');
    Route::post('/inventories_edit', 'InventoryController@update');
    Route::get('/inventories_view/{id}', 'InventoryController@view');
    Route::get('/sufficiency', 'InventoryController@sufficiency');
    Route::get('/aditioanls', 'InventoryController@list_aditioanls');
    //Termina Grupo de Rutas para Inventario de ProductosFinales

    //Inicia Grupo de Rutas para Servicios
    Route::get('/services', 'ServiceController@list_services');
    Route::get('/register_service', 'ServiceController@register');
    Route::post('/register_service', 'ServiceController@register_service');
    Route::get('/services_destroy/{id}', 'ServiceController@destroy');
    Route::get('/services_edit/{id}', 'ServiceController@edit');
    Route::post('/services_edit', 'ServiceController@update');
    //Termina Grupo de Rutas para Servicios

    //Inicia Grupo de Rutas para Clientes
    Route::get('/clients', 'ClientController@list_clients');
    Route::get('/register_client', 'ClientController@register');
    Route::post('/register_client', 'ClientController@register_client');
    Route::get('/clients_destroy/{id}', 'ClientController@destroy');
    Route::get('/clients_edit/{id}', 'ClientController@edit');
    Route::post('/clients_edit', 'ClientController@update');
    Route::get('/clients_block/{id}', 'ClientController@block');
    Route::get('/clients_unlock/{id}', 'ClientController@unlock');
    //Termina Grupo de Rutas para Clientes

    //Inicia Grupo de Rutas para Cotizaciones
    Route::get('/quotations', 'QuotationController@list_quotations');
    Route::get('/register_quotation', 'QuotationController@register');
    Route::post('/register_quotation', 'QuotationController@register_quotation');
    Route::get('/quotations_destroy/{id}', 'QuotationController@destroy');
    Route::get('/quotations_add/{id}', 'QuotationController@add');
    Route::post('/quotations_add/{id}', 'QuotationController@adding');
    Route::get('/quotation_destroy/{id}/{iden}', 'QuotationController@destroy_quotation');
    Route::get('/print_quotation/{id}', 'QuotationController@print');
    Route::post('/services_add/{id}', 'QuotationController@adding_service');
    Route::get('/service_destroy/{id}/{iden}', 'QuotationController@destroy_service');
    Route::get('/print_quotation_bs/{id}', 'QuotationController@print_bs');
    Route::get('/quotations_edit/{id}', 'QuotationController@edit');//REVISAR SI ES UTIL O NO
    Route::post('/quotations_edit', 'QuotationController@update');// REVISAR SI ES UTIL O NO
    //Termina Grupo de Rutas para Cotizaciones

    //Inicia Grupo de Rutas para Pedidos
    Route::get('/orders', 'OrderController@list_orders');
    Route::get('/orders_complete', 'OrderController@list_orders_complete');
    Route::get('/orders_devolution', 'OrderController@list_orders_devolution');
    Route::get('/register_order/{quotation}', 'OrderController@register_order');
    Route::get('/orders_edit/{id}', 'OrderController@edit');
    Route::post('/orders_edit', 'OrderController@edit_order');
    Route::get('/generate_note/{id}', 'OrderController@print');
    Route::get('/generate_note_bs/{id}', 'OrderController@print_bs');
    Route::get('/devolution/{id}', 'OrderController@devolution');
    Route::get('/payments/{id}', 'OrderController@payments');
    Route::get('/payment_delete/{id}', 'OrderController@payment_delete');
    Route::get('/register_pay/{id}', 'OrderController@pay_insert');
    Route::post('/payment_insert', 'OrderController@payment_insert');
    Route::get('/download/{file_id}' , 'OrderController@downloadFile');
    Route::get('/verify/{id}', 'OrderController@payment_verify');
    //Termina Grupo de Rutas para Pedidos

    //Inicia Grupo de Rutas para valor del dolar
    Route::get('/dollars', 'DolarController@list_dollars');
    Route::get('/dollars_edit/{id}', 'DolarController@edit');
    Route::post('/dollars_edit', 'DolarController@update');
    //Termina Grupo de Rutas para valor del dolar

});