<?php

namespace core;

App::bind("config", require "../config.php");
App::bind("router", new Router());
App::bind("request", new Request());

require "helper.php";