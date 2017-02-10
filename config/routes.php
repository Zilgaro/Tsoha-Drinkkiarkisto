<?php

  $routes->get('/', function() {
    DrinkController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/drink', function() {
  	DrinkController::index();
  });

  $routes->post('/drink', function(){
    DrinkController::store();
  });

  $routes->get('/drink/new', function(){
    DrinkController::create();
  });
  
  $routes->get('/drink/:id', function($id){
    DrinkController::show($id);
  });

  $routes->get('/drink/:id/edit', function($id) {
    DrinkController::drink_edit($id);
  });

  $routes->post('/drink/:id/edit', function($id) {
    DrinkController::update($id);
  });

  $routes->post('/drink/:id/destroy', function($id) {
    DrinkController::destroy($id);
  });

  $routes->get('/login', function() {
    UserController::login();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });