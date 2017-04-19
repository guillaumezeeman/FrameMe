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
        @include('tutorial.partial.content_banner', ["navigation_left" => "query-builder"])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <h1 class="header">Blade (Template Engine)</h1>

        <span>In this last step, we will create the views for the <strong>Overview</strong> and <strong>Details</strong> pages described in the previous step.
            The <code>FrameMe</code> framework implements the <code>Blade</code> template engine for the management of views. All views are stored in the
            <strong>View folder</strong> located in <code>/app/view.</code> When a view is being parsed by the template engine, it creates a cached version
            of it in the <strong>Cache View folder</strong> located in <code>app\cache\view.</code> It is imported that you set the correct permission for
            this cache folder, so that your webserver can create new files here. </span>

        <br>
        <br>
        <span>For this use case, we will create 2 views for 2 pages. The first page (<strong>Overview</strong>) will list all tutorials stored in the database.
            The <strong>Details</strong> page will display all information of a single tutorial. We will create these templates in the following location:
            <code>/app/view/tutorial/use-case</code></span>

        <br>
        <br>
        <code class="editor-title">Overview.blade.php</code>
        <div class="editor-container has-title">
            <pre class="editor html">
&#64;extends('base')

&#64;section('css')
    &#60;!!link href=!!'http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'!!&#62;
    &#60;!!link href=!!"&#123;&#123; asset('css/themify-icons.css') &#125;&#125;" type="text/css" rel="stylesheet"!!&#62;
    &#60;!!link href=!!"&#123;&#123; asset('css/home.css') &#125;&#125;" type="text/css" rel="stylesheet"!!&#62;
    &#60;!!link href=!!"&#123;&#123; asset('css/use_case.css') &#125;&#125;" type="text/css" rel="stylesheet"!!&#62;
&#64;stop

&#64;section('content')

    &#60;!!div class=!!"navigation-header container"!!&#62;
        &#60;!!img src=!!"&#123;&#123; image('frame_me_blue.png') &#125;&#125;" class=!!"banner"!!&#62;
    &#60;!!/div!!&#62;

    &#60;!!div class=!!"tutorial-container container bordered"!!&#62;
        &#60;!!h1!!&#62;List of tutorials&#60;!!/h1!!&#62;
        &#123;&#123;--&#60;!!hr!!&#62;--&#125;&#125;

        &#60;!!div class=!!"button-container"!!&#62;
            &#60;!!span class=!!"btn"!!&#62;Create&#60;!!/span!!&#62;
        &#60;!!/div!!&#62;

        &#60;!!table class=!!"tutorial-overview frameme-table"!!&#62;
            &#60;!!thead!!&#62;
            &#60;!!tr!!&#62;
                &#60;!!th!!&#62;#&#60;!!/th!!&#62;
                &#60;!!th!!&#62;Name&#60;!!/th!!&#62;
                &#60;!!th!!&#62;Description&#60;!!/th!!&#62;
                &#60;!!th!!&#62;Pages&#60;!!/th!!&#62;
                &#60;!!th!!&#62;&#60;!!/th!!&#62;
            &#60;!!/tr!!&#62;
            &#60;!!/thead!!&#62;
            &#60;!!tbody!!&#62;
            &#64;foreach($tutorials as $key =!!&#62; $tutorial)
                &#60;!!tr!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $key &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $tutorial-!!&#62;get('name') &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $tutorial-!!&#62;get('description') &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $tutorial-!!&#62;get('pages_count') &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;
                        &#60;!!div class=!!"table-btn-container"!!&#62;
                            &#60;!!span class=!!"btn disabled"!!&#62;&#60;!!span class=!!"btn-icon ti-plus"!!&#62;&#60;!!/span!!&#62;&#60;!!/span!!&#62;
                            &#60;!!a href=!!"&#123;&#123; url('use_case_details', [$tutorial-!!&#62;get('hash')]) &#125;&#125;" class=!!"btn"!!&#62;&#60;!!span class=!!"btn-icon ti-pencil"!!&#62;&#60;!!/span!!&#62;&#60;!!/a!!&#62;
                            &#60;!!span class=!!"btn disabled"!!&#62;&#60;!!span class=!!"btn-icon ti-trash"!!&#62;&#60;!!/span!!&#62;&#60;!!/span!!&#62;
                        &#60;!!/div!!&#62;
                    &#60;!!/td!!&#62;
                &#60;!!/tr!!&#62;
            &#64;endforeach
            &#60;!!/tbody!!&#62;
        &#60;!!/table!!&#62;
    &#60;!!/div!!&#62;
&#64;stop
            </pre>
        </div>

        <code class="editor-title">Details.blade.php</code>
        <div class="editor-container has-title">
            <pre class="editor html">
&#64;extends('base')

&#64;section('css')
    &#60;!!link href=!!'http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'!!&#62;
    &#60;!!link href=!!"&#123;&#123; asset('css/themify-icons.css') &#125;&#125;" type="text/css" rel="stylesheet"!!&#62;
    &#60;!!link href=!!"&#123;&#123; asset('css/home.css') &#125;&#125;" type="text/css" rel="stylesheet"!!&#62;
    &#60;!!link href=!!"&#123;&#123; asset('css/use_case.css') &#125;&#125;" type="text/css" rel="stylesheet"!!&#62;
&#64;stop

&#64;section('js')
    &#60;!!script type=!!"text/javascript" src=!!"&#123;&#123; asset("javascript/app.js") &#125;&#125;"!!&#62;&#60;!!/script!!&#62;
&#64;stop

&#64;section('content')

    &#60;!!div class=!!"navigation-header fade-in fade-out container"!!&#62;
        &#64;include('tutorial.partial.content_banner', ["navigation_left" =!!&#62; "use-case"])
    &#60;!!/div!!&#62;

    &#60;!!div class=!!"tutorial-container container bordered"!!&#62;
        &#60;!!div class=!!"row tutorial-description"!!&#62;
            &#60;!!table!!&#62;
                &#60;!!tbody!!&#62;
                &#60;!!tr!!&#62;
                    &#60;!!td class=!!"description-title"!!&#62;Name:&#60;!!/td!!&#62;
                    &#60;!!td class=!!"description-value"!!&#62;&#123;&#123; $tutorial-!!&#62;get('name') &#125;&#125;&#60;!!/td!!&#62;
                &#60;!!/tr!!&#62;
                &#60;!!tr!!&#62;
                    &#60;!!td class=!!"description-title"!!&#62;Description:&#60;!!/td!!&#62;
                    &#60;!!td class=!!"description-value"!!&#62;&#123;&#123; $tutorial-!!&#62;get('description') &#125;&#125;&#60;!!/td!!&#62;
                &#60;!!/tr!!&#62;
                &#60;!!tr!!&#62;
                    &#60;!!td class=!!"description-title"!!&#62;Number of pages:&#60;!!/td!!&#62;
                    &#60;!!td class=!!"description-value"!!&#62;&#123;&#123; $tutorial-!!&#62;get('pages_count') &#125;&#125;&#60;!!/td!!&#62;
                &#60;!!/tr!!&#62;
                &#60;!!/tbody!!&#62;
            &#60;!!/table!!&#62;
        &#60;!!/div!!&#62;

        &#60;!!table class=!!"pages-overview frameme-table"!!&#62;
            &#60;!!thead!!&#62;
            &#60;!!tr!!&#62;
                &#60;!!th!!&#62;#&#60;!!/th!!&#62;
                &#60;!!th!!&#62;Name&#60;!!/th!!&#62;
                &#60;!!th!!&#62;Title&#60;!!/th!!&#62;
                &#60;!!th!!&#62;Description&#60;!!/th!!&#62;
                &#60;!!th!!&#62;&#60;!!/th!!&#62;
            &#60;!!/tr!!&#62;
            &#60;!!/thead!!&#62;
            &#60;!!tbody!!&#62;
            &#64;foreach($tutorial-!!&#62;get('pages') as $key =!!&#62; $page)
                &#60;!!tr!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $key &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $page-!!&#62;get('name') &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $page-!!&#62;get('title') &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;&#123;&#123; $page-!!&#62;get('description') &#125;&#125;&#60;!!/td!!&#62;
                    &#60;!!td!!&#62;
                        &#60;!!div class=!!"table-btn-container"!!&#62;
                            &#60;!!span class=!!"btn disabled"!!&#62;&#60;!!span class=!!"btn-icon ti-pencil"!!&#62;&#60;!!/span!!&#62;&#60;!!/span!!&#62;
                            &#60;!!span class=!!"btn disabled"!!&#62;&#60;!!span class=!!"btn-icon ti-trash"!!&#62;&#60;!!/span!!&#62;&#60;!!/span!!&#62;
                        &#60;!!/div!!&#62;
                    &#60;!!/td!!&#62;
                &#60;!!/tr!!&#62;
            &#64;endforeach
            &#60;!!/tbody!!&#62;
        &#60;!!/table!!&#62;
    &#60;!!/div!!&#62;
&#64;stop
            </pre>
        </div>

        <span>And viola! You have now created a simple working website where users can log in and view data fetched from your database! During this tutorial we have touched
            on the biggest features this framework can offer. Now you have acquired enough information to start implementing your own logic with the <code>FrameMe</code> framework.
            We wish you good luck with our great framework!</span>

        <div class="navigation-container bottom">
            <div class="navigation query-builder-btn"><span class="navigation-icon ti-arrow-left"></span></div>
        </div>
    </div>
@stop