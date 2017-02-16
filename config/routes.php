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

  $routes->post('/drink', function(){
    DrinkController::store();
  });

  $routes->get('/drink/new', 'check_logged_in', function(){
    DrinkController::create();
  });
  
  $routes->get('/drink/:id', 'check_logged_in', function($id){
    DrinkController::show($id);
  });

  $routes->get('/drink/:id/edit', 'check_logged_in', function($id) {
    DrinkController::drink_edit($id);
  });

  $routes->post('/drink/:id/edit', function($id) {
    DrinkController::update($id);
  });

  $routes->post('/drink/:id/destroy', function($id) {
    DrinkController::destroy($id);
  });

  $routes->get('/login', function() {
    ClientController::login();
  });

  $routes->post('/login', function() {
    ClientController::handle_login();
  });

  $routes->post('/logout', function() {
    ClientController::logout();
  });