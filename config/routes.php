<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/drink', function() {
  	HelloWorldController::drink_list();
  });
  $routes->get('/drink/1', function() {
  	HelloWorldController::drink_show();	
  });

  $routes->get('/drink/1/edit', function() {
    HelloWorldController::drink_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });