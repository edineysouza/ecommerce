<?php

use \Hcode\Page;
use \Hcode\Model\Product;

$app->config('debug', true);

$app->get('/', function() {
    
    $products = Product::listAll();

	$page = new Page();

	$page->setTpl("index",[
		'products'=>Product::checklist($products)
	]);

});


?>