<?php

namespace app;

use core\Router;

// Routes for the Model generator
Router::get("model_generator", "/script/generate-model", "DefaultController@generate_model");

// Routes for the tutorial
Router::get("homepage", "/", "DefaultController@home");
Router::get("tutorial", "/tutorial", "DefaultController@tutorial");
Router::get("authorization", "/tutorial/authorization", "DefaultController@authorization");
Router::get("route_and_request", "/tutorial/route-and-request", "DefaultController@route_and_request");
Router::get("controller_and_module", "/tutorial/controller-and-module", "DefaultController@controller_and_module");
Router::get("model", "/tutorial/model", "DefaultController@model");
Router::get("query_builder", "/tutorial/query-builder", "DefaultController@query_builder");
Router::get("blade", "/tutorial/blade", "DefaultController@blade");