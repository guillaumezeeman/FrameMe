<?php

namespace app\module;

use app\model\BaseModelTrait;
use core\Request;
use Cartalyst\Sentry\Facades\Native\Sentry;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Users\UserExistsException;
use Exception;

class UserModule {
    use BaseModelTrait;
    
    public function login(Request $request) {
        if ($request->is_empty("email") || $request->is_empty("password"))
            throw new Exception("The username and password are required.");
        
        try {
            $user = Sentry::authenticate(['email' => $request->get("email"), 'password' => $request->get("password")], false);
            if ( ! $request->is_empty("remember_me"))
                Sentry::loginAndRemember($user);
            
            return true;
        } catch (WrongPasswordException $e) {
            throw new Exception("Oops we could not log you in, the username and password combination is invalid.");
        } catch (UserNotFoundException $e) {
            throw new Exception("Oops we could not log you in, the username and password combination is invalid.");
        } catch (UserNotActivatedException $e) {
            throw new Exception("Oops we could not log you in, the username and password combination is invalid.");
        } catch (Exception $exception) {
            throw new Exception("Oops looks like something went wrong.");
        }
    }
    
    public function register(Request $request) {
        if ($request->is_empty("email") || $request->is_empty("first_name") || $request->is_empty("last_name") || $request->is_empty("password") || $request->is_empty("password_confirm"))
            throw new Exception("Not all forms have been filled in.");
        
        if ($request->get("password") != $request->get("password_confirm"))
            throw new Exception("The given passwords do not match");
        
        try {
            $user = Sentry::createUser(['email' => $request->get("email"), 'password' => $request->get("password"), 'activated' => true]);
            
            return $this->login($request);
        } catch (UserExistsException $e) {
            throw new Exception("Oops we could not register you, this user already exists.");
        } catch (Exception $exception) {
            throw new Exception("Oops looks like something went wrong.");
        }
    }
}
