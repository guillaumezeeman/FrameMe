$(document).ready(function () {
    app.onload();
});

var app = {
    onload                    : function () {
        var app = this;
        
        $(window).bind('unload', this.on_window_close);
        $(window).bind('beforeunload', this.on_window_close);
        
        switch (current_page) {
            case "route-and-request":
                this.on_route_and_request_load();
                break;
            case "query-builder":
                this.on_query_builder_load();
                break;
            case "blade":
                this.on_blade_load();
                break;
        }
        
        $.each($(".editor-container .editor"), function () {
            app.parse_editor($(this));
        });
        
        $(".fade-in").fadeIn("slow", function () { });
        
        $(".tutorial-btn").click(function () {
            app.go_to("/tutorial");
        });
        
        $(".authorization-btn").click(function () {
            app.go_to("/tutorial/authorization");
        });
        
        $(".route-and-request-btn").click(function () {
            app.go_to("/tutorial/route-and-request");
        });
        
        $(".controller-and-module-btn").click(function () {
            app.go_to("/tutorial/controller-and-module");
        });
        
        $(".model-btn").click(function () {
            app.go_to("/tutorial/model");
        });
        
        $(".query-builder-btn").click(function () {
            app.go_to("/tutorial/query-builder");
        });
        
        $(".use-case-btn").click(function () {
            console.log("Hoi!!");
    
            window.location = base_url + "/use-case";
        });
        
        $(".blade-btn").click(function () {
            app.go_to("/tutorial/blade");
        });
    },
    go_to                     : function (url) {
        $(".fade-out").fadeOut("slow", function () {
            window.location = base_url + url;
        });
    },
    on_window_close           : function () {
        $(".fade").fadeOut("slow", function () {
        
        });
    },
    parse_editor              : function (editor) {
        var app     = this;
        var content = editor.html();
    
        $.each(this.get_all_occurences("/*", content), function (key, indice) {
            var content_before           = content.substr(0, indice);
            var content_after            = content.substr(indice);
            var closing_comment_position = content_after.indexOf("*/") + 2;
            var value                    = content_after.substr(0, closing_comment_position);
            var container                = "<span class=\"comment\">" + value + "</span>";
            content                      = content_before + container + content_after.substr(closing_comment_position);
        });
        
        content = app.parse_codes(content, "&lt;?php", "&lt;?php", ["tag"]);
        content = app.parse_codes(content, "$this-&gt;", "$this-&gt;", ["variable"]);
        content = app.parse_codes(content, "header(", "header(", ["tag"]);
        content = app.parse_codes(content, "view(", "view(", ["tag"]);
        content = app.parse_codes(content, ");", ");", ["bracket"]);
        content = app.parse_codes(content, "];", "];", ["bracket"]);
        content = app.parse_codes(content, "\\", "\\", ["bracket"]);
        content = app.parse_codes(content, "[", "[", ["bracket"]);
        content = app.parse_codes(content, "]", "]", ["bracket"]);
        content = app.parse_codes(content, "(", "(", ["bracket"]);
        content = app.parse_codes(content, ")", ")", ["bracket"]);
        content = app.parse_codes(content, ",", ",", ["bracket"]);
        content = app.parse_codes(content, "}", "}", ["bracket"]);
        content = app.parse_codes(content, "{", "{", ["bracket"]);
        content = app.parse_codes(content, "::", "::", ["bracket"]);
        content = app.parse_codes(content, "||", "||", ["bracket"]);
        content = app.parse_codes(content, " = ", " = ", ["bracket"]);
        content = app.parse_codes(content, "!=", "!=", ["bracket"]);
        content = app.parse_codes(content, " ! ", " ! ", ["bracket"]);
        content = app.parse_codes(content, "=&gt;", "=&gt;", ["array", "declaration"]);
        content = app.parse_codes(content, "return", "return", ["keyword"]);
        content = app.parse_codes(content, "namespace", "namespace", ["keyword"]);
        content = app.parse_codes(content, "use ", "use ", ["keyword"]);
        content = app.parse_codes(content, " as ", " as ", ["keyword"]);
        content = app.parse_codes(content, "__DIR__;", "__DIR__;", ["bracket"]);
        content = app.parse_codes(content, "class ", "class ", ["keyword"]);
        content = app.parse_codes(content, "public function ", "public function ", ["keyword"]);
        content = app.parse_codes(content, "public static function ", "public static function ", ["keyword"]);
        content = app.parse_codes(content, "new ", "new ", ["keyword"]);
        content = app.parse_codes(content, "if ", "if ", ["keyword"]);
        content = app.parse_codes(content, "-&gt;get", "-&gt;get", ["tag"]);
        content = app.parse_codes(content, "-&gt;", "-&gt;", ["keyword"]);
        content = app.parse_codes(content, "try ", "try ", ["keyword"]);
        content = app.parse_codes(content, "catch ", "catch ", ["keyword"]);
        content = app.parse_codes(content, "throw ", "throw ", ["keyword"]);
        content = app.parse_codes(content, " private ", " private ", ["keyword"]);
        content = app.parse_codes(content, " array ", " array ", ["keyword"]);
        content = app.parse_codes(content, "Request", "Request", ["variable"]);
        content = app.parse_codes(content, "Exception", "Exception", ["variable"]);
        content = app.parse_codes(content, "__DIR__", "__DIR__", ["tag"]);
        content = app.parse_codes(content, "is_empty", "is_empty", ["tag"]);
        content = app.parse_codes(content, "...", "...", ["comment"]);
        
        $.each(this.get_all_occurences("$", content), function (key, indice) {
            var content_before     = content.substr(0, indice);
            var content_after      = content.substr(indice);
            var previous_character = content.substr(indice - 1, 1);

            var offset    = 0;
            var variable  = "";
            var delimeter = "<";
            if ("{" == previous_character) {
                content_before = content_before.substr(0, content_before.length - 1)
                variable       = "{";
                delimeter      = "}";
                offset         = 1;
            }

            var variable_end = content_after.indexOf(delimeter);
            if (variable_end < 0)
                return true;

            variable += content_after.substr(0, variable_end + offset);
            var after_variable = content_after.substr(variable_end + offset);
            var container      = "<span class=\"variable\">" + variable + "</span>";

            content = content_before + container + after_variable;

        });
        
        editor.html(content);
    },
    parse_codes               : function (content, needle, value, classes) {
        var app = this;
        
        $.each(this.get_all_occurences(needle, content), function (key, indice) {
            content = app.parse_code(content, indice, needle, value, classes);
        });
        
        return content;
    },
    parse_code                : function (content, indice, needle, value, classes) {
        if (content.substr(indice, value.length).indexOf("<span>") >= 0)
            return content;
        
        classes = this.concatenate(classes, " ");
        
        var container      = "<span class=\"" + classes + "\">" + value + "</span>";
        var content_before = content.substr(0, indice);
        var content_after  = content.substr(indice + needle.length);
        
        return content_before + container + content_after;
    },
    concatenate               : function (variables, seperator) {
        if (variables == null)
            return "";
        
        if (seperator == null)
            seperator = " - ";
        
        var output = "";
        variables.forEach(function (variable, key) {
            variable = variable.trim();
            if (!variable || !variable.length || variable.length <= 0)
                return true;
            
            output = output.trim();
            if (output.length > 0)
                output += seperator;
            
            output += variable;
        })
        
        return output;
    },
    get_all_occurences        : function (needle, haystack, $case_insensitive) {
        var string_length = needle.length;
        if (0 == string_length)
            return [];
        
        var start_index = 0, index, indices = [];
        if ($case_insensitive) {
            haystack = haystack.toLowerCase();
            needle   = needle.toLowerCase();
        }
        
        while ((index = haystack.indexOf(needle, start_index)) > -1) {
            indices.push(index);
            start_index = index + string_length;
        }
        
        return indices.reverse();
    },
    on_route_and_request_load : function () {
        var app = this;
    
        $.each($(".editor-container .editor"), function (key, editor) {
            var editor  = $(editor);
            var content = editor.html();
            
            content = app.parse_codes(content, "Router::", "Router::", ["tag"]);
            content = app.parse_codes(content, "get", "get", ["tag"]);
            content = app.parse_codes(content, "post", "post", ["tag"]);
            content = app.parse_codes(content, "\\/", "\\/", ["bracket"]);
            
            editor.html(content);
        })
    },
    on_query_builder_load : function () {
        var app = this;
        
        $.each($(".editor-container .editor"), function (key, editor) {
            var editor  = $(editor);
            var content = editor.html();
            
            content = app.parse_codes(content, "Router::", "Router::", ["tag"]);
            content = app.parse_codes(content, "get", "get", ["tag"]);
            content = app.parse_codes(content, "post", "post", ["tag"]);
            content = app.parse_codes(content, "TutorialModule(", "TutorialModule(", ["variable"]);
            content = app.parse_codes(content, "Sentry::", "Sentry::", ["tag"]);
            content = app.parse_codes(content, "check(", "check(", ["tag"]);
            content = app.parse_codes(content, "redirect(", "redirect(", ["keyword"]);
            content = app.parse_codes(content, "foreach ", "foreach ", ["keyword"]);
            content = app.parse_codes(content, "QueryBuilder(", "QueryBuilder(", ["tag"]);
            content = app.parse_codes(content, "set_table", "set_table", ["tag"]);
            content = app.parse_codes(content, "(TutorialPage", "(TutorialPage", ["tag"]);
            content = app.parse_codes(content, "(Tutorial", "(Tutorial", ["tag"]);
            content = app.parse_codes(content, "(Page", "(Page", ["tag"]);
            content = app.parse_codes(content, "::class", "::class", ["tag"]);
            content = app.parse_codes(content, "set_table(", "set_table(", ["tag"]);
            content = app.parse_codes(content, "add_join", "add_join", ["tag"]);
            content = app.parse_codes(content, "add_where(", "add_where(", ["tag"]);
            content = app.parse_codes(content, "add_variables(", "add_variables(", ["tag"]);
            content = app.parse_codes(content, "query(", "query(", ["tag"]);
            content = app.parse_codes(content, "set_result_type(", "set_result_type(", ["tag"]);
            content = app.parse_codes(content, "count(", "count(", ["tag"]);
            content = app.parse_codes(content, "set(", "set(", ["tag"]);
            
            editor.html(content);
        })
    },
    on_blade_load : function () {
        var app = this;
        
        $.each($(".editor-container .editor"), function (key, editor) {
            var editor  = $(editor);
            var content = editor.html();
    
            content = app.parse_codes(content, "span", "span", ["tag"]);
            content = app.parse_codes(content, "div", "div", ["tag"]);
            content = app.parse_codes(content, "link", "link", ["tag"]);
            content = app.parse_codes(content, "&lt;!!/table", "&lt;!!/table", ["tag"]);
            content = app.parse_codes(content, "&lt;!!table", "&lt;!!table", ["tag"]);
            content = app.parse_codes(content, "&lt;!!/script", "&lt;!!/script", ["tag"]);
            content = app.parse_codes(content, "&lt;!!script", "&lt;!!script", ["tag"]);
            content = app.parse_codes(content, "thead", "thead", ["tag"]);
            content = app.parse_codes(content, "tbody", "tbody", ["tag"]);
            content = app.parse_codes(content, "&lt;!!/tr", "&lt;!!/tr", ["tag"]);
            content = app.parse_codes(content, "&lt;!!tr", "&lt;!!tr", ["tag"]);
            content = app.parse_codes(content, "&lt;!!/th", "&lt;!!/th", ["tag"]);
            content = app.parse_codes(content, "&lt;!!th", "&lt;!!th", ["tag"]);
            content = app.parse_codes(content, "&lt;!!/td", "&lt;!!/td", ["tag"]);
            content = app.parse_codes(content, "&lt;!!td", "&lt;!!td", ["tag"]);
            content = app.parse_codes(content, "@extends", "@extends", ["keyword"]);
            content = app.parse_codes(content, "@section", "@section", ["keyword"]);
            content = app.parse_codes(content, "@stop", "@stop", ["keyword"]);
            content = app.parse_codes(content, "@include", "@include", ["keyword"]);
            content = app.parse_codes(content, "@section", "@section", ["keyword"]);
            content = app.parse_codes(content, "@foreach", "@foreach", ["keyword"]);
            content = app.parse_codes(content, "@endforeach", "@endforeach", ["keyword"]);
            content = app.parse_codes(content, "asset(", "asset(", ["variable"]);
            content = app.parse_codes(content, "image(", "image(", ["variable"]);
            content = app.parse_codes(content, "&lt;!!/", "&lt;/", ["variable"]);
            content = app.parse_codes(content, "&lt;!!", "&lt;", ["variable"]);
            content = app.parse_codes(content, "!!&gt;", "&gt;", ["variable"]);
            content = app.parse_codes(content, "href=!!", "href=", ["keyword"]);
            content = app.parse_codes(content, "src=!!", "src=", ["keyword"]);
            content = app.parse_codes(content, "type=!!", "type=", ["keyword"]);
            content = app.parse_codes(content, "class=!!", "class=", ["keyword"]);
            
            editor.html(content);
        })
    }
};