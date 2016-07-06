<?php

// Home page
$app->get('/', "api\Controller\HomeController::indexAction");

// Detailed info about an article
$app->match('/article/{id}', "api\Controller\HomeController::articleAction");

// Login form
$app->get('/login', "api\Controller\HomeController::loginAction")
->bind('login');  // named route so that path('login') works in Twig templates

// Admin zone
$app->get('/admin', "api\Controller\AdminController::indexAction");

// Add a new article
$app->match('/admin/article/add', "api\Controller\AdminController::addArticleAction");

// Edit an existing article
$app->match('/admin/article/{id}/edit', "api\Controller\AdminController::editArticleAction");

// Remove an article
$app->get('/admin/article/{id}/delete', "api\Controller\AdminController::deleteArticleAction");

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', "api\Controller\AdminController::editCommentAction");

// Remove a comment
$app->get('/admin/comment/{id}/delete', "api\Controller\AdminController::deleteCommentAction");

// Add a user
$app->match('/admin/user/add', "api\Controller\AdminController::addUserAction");

// Edit an existing user
$app->match('/admin/user/{id}/edit', "api\Controller\AdminController::editUserAction");

// Remove a user
$app->get('/admin/user/{id}/delete', "api\Controller\AdminController::deleteUserAction");

// API : get all articles
$app->get('/api/articles', "api\Controller\ApiController::getArticlesAction");

//API : get all categories
$app->get('/api/categories', "api\Controller\ApiController::getCategoriesAction");

//API : get all products
$app->get('/api/products', "api\Controller\ApiController::getProductsAction");

//API : get all categories
$app->get('/api/productsbycategory/{id}', "api\Controller\ApiController::getProductsByCategoriesAction");

// API : get an article
$app->get('/api/article/{id}', "api\Controller\ApiController::getArticleAction");

// API : create an article
$app->post('/api/article', "api\Controller\ApiController::addArticleAction");

// API : remove an article
$app->delete('/api/article/{id}', "api\Controller\ApiController::deleteArticleAction");
