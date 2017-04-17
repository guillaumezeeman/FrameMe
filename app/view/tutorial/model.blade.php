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
        @include('tutorial.partial.content_banner', ["navigation_left" => "controller-and-module", "navigation_right" => "query-builder",])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <h1 class="header">Model and Model Generator</h1>

        <span>Besides the <code>Controllers, Modules and Views</code>, this framework also has the concept of a <code>Model</code>. A <code>Model</code> is a <code>PHP class</code> that represents a database table in your project.
            These classes posses the same columns (including the primary keys) of the table they are derived from. They are used for the purpose of representing a given data object within your PHP framework. An example of
            this is a <code>Project Model</code>, which can represent a project for replacing an out-of-date <code>PHP</code> framework with the <code>FrameMe</code> framework. </span>

        <br>
        <br>
        <code class="editor-title">Project.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

namespace <span class="variable">app\model</span><span class="bracket">;</span>

class <span class="tag">Project</span> <span class="keyword">implements</span> <span class="variable">BaseModelInterface</span> {
    use <span class="variable">BaseModelTrait</span><span class="bracket">;</span>

    private $table = 'project';

    /*** The following logic is auto generated. DO NOT REMOVE!!. ***/

    /**
    * @var array <span>$columns</span>
    */
    private $columns = [
        ...
    ];

    /**
    * @var array <span>$keys</span>
    */
    private $keys = [
        ...
    ];

    /*** The end of the auto generated logic. ***/

    /**
     * @param <span>$hash</span>
     *
     * @throws Exception
     */
    public static function <span class="tag">find_by_hash</span>($hash) {
        ...

        return $project;
    }
}
            </pre>
        </div>

        <span>This <code>Models</code> can be created manually, but can also be generated based on your connected database. The <code>Model Generator</code> will scan your database for every table and create
            the corresponding <code>Models</code>. It will either create a new <code>Model</code>, if one does not already exist, or it will modify the existing one. When modifying an existing <code>Model</code>, it will only
            alter the columns and primary keys of the table. Any additional logic will not be removed or altered as long as its not in between the auto generator section of the <code>Model.</code></span>

        <br>
        <br>
        <span>We have already setup a route for executing the <code>Model Generator</code>, which you can call by <code>/script/generate-model</code>&nbsp;<code>URI</code>. However, if you have removed the route and/or the corresponding <code>method</code>,
            you can create a new <code>Route and Method</code> and execute the following logic.</span>

        <br>
        <br>
        <code class="editor-title">DefaultController.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

...
    public function <span class="tag">generate_model</span>() {
        <span class="variable">$model_generated</span> = new <span class="variable">ModelGenerator</span>();
        $model_generated-><span class="tag">generate_models</span>();
    }
...

}
            </pre>
        </div>

        <span>When you execute the <code>Model Generator</code>, it will output the results of the script. It will display all the models it has created or modified and show a list of all columns.</span>

        <div class="center">
            <img src="{{ image('tutorial/model_generator.png') }}" class="bordered image-inline">
        </div>

        <div class="navigation-container bottom">
            <div class="navigation controller-and-module-btn"><span class="navigation-icon ti-arrow-left"></span></div>
            <div class="navigation query-builder-btn"><span class="navigation-icon ti-arrow-right"></span></div>
        </div>
    </div>
@stop