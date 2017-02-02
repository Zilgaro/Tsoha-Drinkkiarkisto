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

  $routes->get('/drink/1/edit', function() {
    HelloWorldController::drink_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });