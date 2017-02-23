<?php
  
  function check_logged_in() {
    BaseController::check_logged_in();
  }

  $routes->get('/', function() {
    DrinkController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/drink', function() {
  	DrinkController::index();
  });

  $routes->post('/drink', 'check_logged_in', function() {
    DrinkController::store();
  });

  $routes->get('/drink/new', 'check_logged_in', function() {
    DrinkController::create();
  });
  
  $routes->get('/drink/:id', 'check_logged_in', function($id) {
    DrinkController::show($id);
  });

  $routes->get('/drink/:id/edit', 'check_logged_in', function($id) {
    DrinkController::drink_edit($id);
  });

  $routes->post('/drink/:id/edit', 'check_logged_in', function($id) {
    DrinkController::update($id);
  });

  $routes->post('/drink/:id/destroy', 'check_logged_in', function($id) {
    DrinkController::destroy($id);
  });

  $routes->get('/register', function() {
    ClientController::register();
  });

  $routes->post('/register', function() {
    ClientController::create();
  });

  $routes->get('/login', function() {
    ClientController::login();
  });
  
  $routes->post('/logout', function() {
    ClientController::logout();
  });
  
  $routes->post('/login', function() {
    ClientController::handle_login();
  });

  $routes->get('/ingredient', 'check_logged_in', function() {
    IngredientController::index();
  });

  $routes->get('/ingredient/new', 'check_logged_in', function() {
    IngredientController::create();
  });

  $routes->post('/ingredient', 'check_logged_in', function() {
    IngredientController::store();
  });
  
  $routes->get('/ingredient/:name', 'check_logged_in', function($name){
    IngredientController::show($name);
  });