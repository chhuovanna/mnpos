<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    
    
    $router->get("product/createwithimp", "ProductController@createwithimp");
    //$router->get('product/createwithimp', 'ProductController@createwithimp');
    

    $router->resource('product', ProductController::class);
    
    $router->get('product/createwithimp/save','ProductController@saveformwithimp');

    $router->resource('category', CategoryController::class);
    $router->resource('manufacturer', ManufacturerController::class);
    $router->resource('customer', CustomerController::class);
    $router->resource('exchangerate', ExchangerateController::class);
    $router->resource('importer', ImporterController::class);
    $router->resource('saleassistant', SaleassistantController::class);
    

    //$router->get('inventory/search','InventoryController@searchInventory');

    $router->resource('inventory', InventoryController::class);

    $router->get('inventory/create/{product}', 'InventoryController@productInventory');

    $router->get('sale/addsale','SaleController@addSale');
    $router->get('sale/addsalebarcode','SaleController@addSaleBarcode');
    $router->get('sale/addsalebarcodeunit','SaleController@addSaleBarcodeUnit');
    
    $router->get('sale/searchproduct','SaleController@searchProduct');
    $router->get('sale/searchproductbarcode','SaleController@searchProductBarcode');
    $router->get('sale/refreshsearchproduct','SaleController@refreshSearchProduct');
    $router->get('sale/getStock','SaleController@getStock');
    $router->get('sale/searchsale','SaleController@searchsale');
    


    //$router->post('sale/checkout','SaleController@checkout');
    $router->post('sale/checkout', 'SaleController@checkout');
    /*$router->get('sale/list','SaleController@listSale');
    $router->get('sale/list/{sale}/edit','SaleController@edit');
    $router->put('sale/list/{sale}','SaleController@update');*/
    $router->resource('sale/list',SaleController::class);
    $router->resource('orderline',SaleProductController::class);
    $router->get("searchsaleproduct","SaleProductController@searchsaleproduct");
    $router->get("searchinventory","InventoryController@searchinventory");





    



//    $router->resource('pisassistant', ProdImpSaleassistantController::class);


});

//$router->resource('product', ProductController::class);
