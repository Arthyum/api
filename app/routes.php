<?php

// Home page
$app->get('/', "api\Controller\HomeController::indexAction");

// Detailed info about an article
$app->match('/article/{id}', "api\Controller\HomeController::articleAction");

// Login form
$app->get('/login', "api\Controller\HomeController::loginAction")
->bind('login');  // named route so that path('login') works in Twig templates

//API : add a category
$app->post('/api/category/add', "api\Controller\ApiController::addCategoryAction");

//API : get all categories
$app->get('/api/categories', "api\Controller\ApiController::getCategoriesAction");

//API : get all products
$app->get('/api/products', "api\Controller\ApiController::getProductsAction");

//API : get all categories
$app->get('/api/productsbycategory/{id}', "api\Controller\ApiController::getProductsByCategoriesAction");

//API : get all sells
$app->get('/api/sells', "api\Controller\ApiController::getSellsAction");

//API : get all sells
$app->get('/api/stores', "api\Controller\ApiController::getShopsAction");

