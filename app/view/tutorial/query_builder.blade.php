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
        @include('tutorial.partial.content_banner', ["navigation_left" => "model", "navigation_right" => "blade",])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <h1 class="header">Query Builder (Database Coupling)</h1>

        <span>Here we will go over the <code>Query Builder</code> of this framework. In order to demonstrate the capabilities of the <code>Query Builder</code>, we will create a simple feature based on
            a fictional use case. When a user succesfully logs in on this website, with the authorization module we have previously created, he/she will be redirected to the a page that displays
            a list of tutorials. The user can open a tutorial and view the different steps of the tutorial. It's a very simple use case only to demontrate the inner machenics of the
            <code>Query Builder.</code> For this purpose, we provided you with a <code>tutorial_schema.sql</code> file for the basic database setup which is located at the root of the <strong>Project folder</strong>.
            Once you have imported this schema into your database we can setup the tutorial page. The first thing we will do is create two <code>Routes</code> with a new <code>Controller and Module</code>
            with it's respective <code>Methods.</code></span>

        <br>
        <br>
        <code class="editor-title">Routes.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

...
<span class="comment">// Routes for us<span>e</span> case</span>
Router::get("use_case_overview", "/use-case", "TutorialController@overview")<span class="bracket">;</span>
Router::get("use_case_details", "/use-case/:alphanum", "TutorialController@details", ["hash" => 1])<span class="bracket">;</span>
...
            </pre>
        </div>

        <br>
        <span>The <code>TutorialController</code> will have two <code>Methods</code> that will display with page: an <strong>Overview</strong> page that shows a list of all templates
            and a <strong>Details</strong> page that shows all information over a single tutorial. These pages are not accessable if the user is not logged in. If one is unauthorized, he/she will be redirected to
            the homepage. </span>

        <br>
        <br>
        <code class="editor-title">TutorialController.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

namespace <span class="variable">app\controller</span><span class="bracket">;</span>

use <span class="variable">app\module\TutorialModule</span><span class="bracket">;</span>
use <span class="variable">Cartalyst\Sentry\Facades\Native\Sentry as Sentry</span><span class="bracket">;</span>
use <span class="variable">core\Request</span><span class="bracket">;</span>

class <span class="tag">TutorialController</span> {
    public function <span class="tag">overview</span>() {
        if ( ! Sentry::check())
            redirect('login_page')<span class="bracket">;</span>

        $tutorial_module = new TutorialModule()<span class="bracket">;</span>
        $tutorials       = $tutorial_module-><span class="tag">fetch_all</span>()<span class="bracket">;</span>

        view('tutorial.use_case.overview', ["tutorials" => $tutorials])<span class="bracket">;</span>
    }

    public function <span class="tag">details</span>(Request $request) {
        if ( ! Sentry::check())
            redirect('login_page')<span class="bracket">;</span>

        if ($request->is_empty("hash"))
            redirect('use_case')<span class="bracket">;</span>

        $tutorial_module = new TutorialModule()<span class="bracket">;</span>
        $tutorial        = $tutorial_module-><span class="tag">find</span>($request->get("hash"))<span class="bracket">;</span>

        view('tutorial.use_case.details', ["tutorial" => $tutorial])<span class="bracket">;</span>
    }
}
            </pre>
        </div>

        <br>
        <span>The corresponding <code>Module</code> will also have two <code>Methods:</code> <code>fetch_all()</code> and <code>find().</code> In order to connect to the database, you will need
            to instantiate a object of the <code>QueryBuilder</code> class. The first requirement for fetching a table from the database is that the table that you wish to fetch must have
            a <code>Model</code> represented in your framework. You can automatically generate these <code>Models</code> with the <code>Model generator.</code> Next you will need to specify which
            table would like to fetch from the database. You achieve this via several methods: </span>

        <ul class="covered-features">
            <li><span><span class="ti ti-arrow-right"></span>The table name as a <code>String</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span>The class name of the <code>Model</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span>Or simple pass an instance of the <code>Model</code></span></li>
        </ul>

        <span>Next you can add extra filters to the query by simply calling one of the many <code>Methods</code> provided with the <code>QueryBuilder.</code> For example, you can add a join
            statement by calling the <code>add_join() Method.</code> or you can add select statements with the <code>add_select_statement() Method.</code> With the <code>add_variable() Method</code>
            you can bind values to your query. When calling this function you first specify the key and then the value. When defining a parameter anywhere in your query, always prefix it with a
            <code>:</code> symbol and when you specify a key for setting that variable, leave out the prefix (like in the example below). The <code>QueryBuilder</code> always returns the
            results as instanciated <code>Models</code>. So in the example below, you'll always get <code>Tutorial</code> or <code>Page Models</code> returned. </span>

        <br>
        <br>
        <span>Now in the example below, we have 2 <code>Methods</code> implemented. The <code>fetch_all() Method</code> grabs all tutorials and all it's corresponding pages from the database. The
            <code>find() Method</code> fetches a tutorial and it's associated pages by the corresponding <code>Hash</code> variable.</span>

        <br>
        <br>
        <code class="editor-title">TutorialModule.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

namespace <span class="variable">app\module</span><span class="bracket">;</span>

use <span class="variable">app\model\Page</span><span class="bracket">;</span>
use <span class="variable">app\model\Tutorial</span><span class="bracket">;</span>
use <span class="variable">app\model\TutorialPage</span><span class="bracket">;</span>
use <span class="variable">core\database\QueryBuilder</span><span class="bracket">;</span>

class <span class="tag">TutorialModule</span> {
    public function <span class="tag">fetch_all</span>() {
        $query_builder = new QueryBuilder()<span class="bracket">;</span>
        $tutorials     = $query_builder->set_table(Tutorial::class)
            ->query()<span class="bracket">;</span>

        /**
         * @var <span class="variable">Tutorial $tutorial</span>
         */
        foreach ($tutorials as $key => $tutorial) {
            $pages = $tutorial-><span class="tag">fetch_pages</span>()<span class="bracket">;</span>
            $tutorial->set("pages_count", count($pages))<span class="bracket">;</span>
        }

        return $tutorials<span class="bracket">;</span>
    }

    public function <span class="tag">find</span>($hash) {
        $query_builder = new QueryBuilder()<span class="bracket">;</span>

        /**
         * @var <span class="variable">Tutorial $tutorial</span>
         */
        $tutorial      = $query_builder->set_table(Tutorial::class)
            ->add_where("hash = :hash")
            ->add_variables("hash", $hash)
            ->set_result_type(<span class="tag">QueryBuilder::QUERY_OPTION_RESULT_SINGULAR</span>)
            ->query()<span class="bracket">;</span>

        $pages = $tutorial-><span class="tag">fetch_pages</span>()<span class="bracket">;</span>
        $tutorial->set("pages_count", count($pages))<span class="bracket">;</span>

        return $tutorial<span class="bracket">;</span>
    }
}
            </pre>
        </div>

        <span>At lastly we will implement a function in the <code>Tutorial Model</code> for fetching it's pages from the database. This <code>Method</code> will both return an array of pages and add them to the
            data collection of the <code>Tutorial model.</code></span>
        <br>
        <br>
        <code class="editor-title">Tutorial.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

<span class="variable">namespace app\model</span><span class="bracket">;</span>

use <span class="variable">core\database\QueryBuilder</span><span class="bracket">;</span>

class <span class="tag">Tutorial</span> <span class="keyword">implements</span> <span class="tag">BaseModelInterface</span> {

...
    public function <span class="tag">fetch_pages</span>() <span class="bracket">:</span> array {
        $query_builder = new QueryBuilder()<span class="bracket">;</span>
        $pages         = $query_builder->set_table(Page::class)
            ->add_join(TutorialPage::class, "tutorial_page.page_id = page.page_id")
            ->add_where("tutorial_page.tutorial_id = :tutorial_id")
            ->add_variables("tutorial_id", $this->get("tutorial_id"))
            ->query()<span class="bracket">;</span>

        $this->set("pages", $pages)<span class="bracket">;</span>

        return $pages<span class="bracket">;</span>
    }
...
            </pre>
        </div>

        <div class="navigation-container bottom">
            <div class="navigation model-btn"><span class="navigation-icon ti-arrow-left"></span></div>
            <div class="navigation blade-btn"><span class="navigation-icon ti-arrow-right"></span></div>
        </div>
    </div>
@stop