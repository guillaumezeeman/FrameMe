@extends('base')

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('css')
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
@stop

@section('content')

    <div class="navigation-header fade-in fade-out container">
        @include('tutorial.partial.content_banner', ["navigation_left" => "route-and-request", "navigation_right" => "model",])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <h1 class="header">Controllers and Modules</h1>
        <span>In the previouws step we created 5 <code>Routes</code> in order to create an authorization functionality. We will now create
        the <code>Controller</code> and <code>Modules</code> for processing this logic. We first start by creating a <code>Controller</code>
        in the <strong>Controller folder</strong> located in <code>/app/controller</code> and we will name it <code>UserController.</code>
        This class will have the <code>app\controller</code> namespace. It will also implement the following <code>Methods:</code></span>

        <br>
        <ul class="covered-features">
            <li><span><span class="ti ti-arrow-right"></span><code>show_login</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span><code>login</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span><code>show_registration</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span><code>register</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span><code>logout</code></span></li>
        </ul>

        <code class="editor-title">UserController.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

namespace <span class="variable">app\controller</span><span class="bracket">;</span>

use <span class="variable">app\module\UserModule</span><span class="bracket">;</span>
use <span class="variable">core\Request</span><span class="bracket">;</span>
use <span class="variable">core\Router</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Facades\Native\Sentry</span> as <span class="variable">Sentry</span><span class="bracket">;</span>

class UserController {
    public function <span class="tag">show_login</span>() {
        view("auth.login");
    }

    public function <span class="tag">login</span>(Request $request) {
        $user_module = new UserModule();
        $user_module-><span class="tag">login</span>($request);

        header("Location: " . Router::generate_url("homepage"));
    }

    public function <span class="tag">show_registration</span>() {
        view("auth.register");
    }

    public function <span class="tag">register</span>(Request $request) {
        $user_module = new UserModule();
        $user_module-><span class="tag">register</span>($request);

        header("Location: " . Router::generate_url("homepage"));
    }

    public function <span class="tag">logout</span>() {
        if (<span class="tag">Sentry</span>::<span class="tag">check</span>())
            <span class="tag">Sentry</span>::<span class="tag">logout</span>();

        header("Location: " . Router::generate_url("homepage"));
    }
}
            </pre>
        </div>

        <br>
        <span>We have setup a simple <strong>Login</strong> and <strong>Registration</strong> forms which you can use. They are located in the <code>/app/view/auth folder.</code> You
            can access these forms by the following <code>URI</code> <a href="{{ url('login_page') }}" class="code" target="_blank"><code>/auth/login</code></a> and
            <a href="{{ url('registration_page') }}" class="code" target="_blank"><code>/auth/register</code></a> respectively.</span>

        <br>
        <br>
        <span>Next up we will create the correspondig <code>Module</code>&nbsp;<span class="ti ti-arrow-right"></span>&nbsp;&nbsp;<code>UserModule</code> in the <strong>Module folder</strong> located at
            <code>/app/module</code> with 2 <code>Methods.</code> These two functions will be responsible for <strong>Logging in</strong> and <strong>Registering</strong> a <code>User.</code>
            If these processes were succesful, the framework will redirect back to the homepage. If something went wrong in these processes, an exception will be thrown, which will later be
            caught by the framework and the corresponding message will be shown.</span>

        <br>
        <br>
        <code class="editor-title">UserModule.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

namespace <span class="variable">app\module</span><span class="bracket">;</span>

use <span class="variable">app\model\BaseModelTrait</span><span class="bracket">;</span>
use <span class="variable">core\Request</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Facades\Native\Sentry</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Users\WrongPasswordException</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Users\UserNotFoundException</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Users\UserNotActivatedException</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Users\UserExistsException</span><span class="bracket">;</span>
use Exception<span class="bracket">;</span>

class <span class="tag">UserModule</span> {
    use <span class="variable">BaseModelTrait</span><span class="bracket">;</span>

    public function <span class="tag">login</span>(Request $request) {
        if ($request->is_empty("email") || $request->is_empty("password"))
            throw new Exception("The username and password are required.");

        try {
            $user = <span class="tag">Sentry::authenticate</span>(['email' => $request->get("email"), 'password' => $request->get("password")], <span class="keyword">false</span>);
            if ( ! $request->is_empty("remember_me"))
                <span class="tag">Sentry::loginAndRemember</span>($user);

            return <span class="keyword">true</span><span class="bracket">;</span>
        } catch (<span class="variable">WrongPasswordException</span> $e) {
            throw new Exception("Oops we could not log you in, the username and password combination is invalid.");
        } catch (<span class="variable">UserNotFoundException</span> $e) {
            throw new Exception("Oops we could not log you in, the username and password combination is invalid.");
        } catch (<span class="variable">UserNotActivatedException</span> $e) {
            throw new Exception("Oops we could not log you in, the username and password combination is invalid.");
        } catch (Exception $exception) {
            throw new Exception("Oops looks like something went wrong.");
        }
    }

    public function <span class="tag">register</span>(Request $request) {
        if ($request->is_empty("email") || $request->is_empty("first_name") || $request->is_empty("last_name") || $request->is_empty("password") || $request->is_empty("password_confirm"))
            throw new Exception("Not all forms have been filled in.");

        if ($request->get("password") != $request->get("password_confirm"))
            throw new Exception("The given passwords do not match");

        try {
            $user = <span class="tag">Sentry::createUser</span>(['email' => $request->get("email"), 'password' => $request->get("password"), 'activated' => true]);

            return $this-><span class="tag">login</span>($request);
        } catch (<span class="variable">UserExistsException</span> $e) {
            throw new Exception("Oops we could not register you, this user already exists.");
        } catch (Exception $exception) {
            throw new Exception("Oops looks like something went wrong.");
        }
    }
}
            </pre>
        </div>


        <div class="navigation-container bottom">
            <div class="navigation authorization-btn"><span class="navigation-icon ti-arrow-left"></span></div>
            <div class="navigation model-btn"><span class="navigation-icon ti-arrow-right"></span></div>
        </div>
    </div>
@stop