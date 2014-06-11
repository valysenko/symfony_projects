<?php

/* @WebProfiler/Profiler/base_js.html.twig */
class __TwigTemplate_e58c5d52c04789d0dfcdf3aa32f86267613f7b567c01313d5a0a8d456b05e404 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script>/*<![CDATA[*/
    Sfjs = (function() {
        \"use strict\";

        var noop = function() {},

            profilerStorageKey = 'sf2/profiler/',

            request = function(url, onSuccess, onError, payload, options) {
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                options = options || {};
                options.maxTries = options.maxTries || 0;
                xhr.open(options.method || 'GET', url, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function(state) {
                    if (4 !== xhr.readyState) {
                        return null;
                    }

                    if (xhr.status == 404 && options.maxTries > 1) {
                        setTimeout(function(){
                            options.maxTries--;
                            request(url, onSuccess, onError, payload, options);
                        }, 500);

                        return null;
                    }

                    if (200 === xhr.status) {
                        (onSuccess || noop)(xhr);
                    } else {
                        (onError || noop)(xhr);
                    }
                };
                xhr.send(payload || '');
            },

            hasClass = function(el, klass) {
                return el.className && el.className.match(new RegExp('\\\\b' + klass + '\\\\b'));
            },

            removeClass = function(el, klass) {
                if (el.className) {
                    el.className = el.className.replace(new RegExp('\\\\b' + klass + '\\\\b'), ' ');
                }
            },

            addClass = function(el, klass) {
                if (!hasClass(el, klass)) {
                    el.className += \" \" + klass;
                }
            },

            getPreference = function(name) {
                if (!window.localStorage) {
                    return null;
                }

                return localStorage.getItem(profilerStorageKey + name);
            },

            setPreference = function(name, value) {
                if (!window.localStorage) {
                    return null;
                }

                localStorage.setItem(profilerStorageKey + name, value);
            };

        return {
            hasClass: hasClass,

            removeClass: removeClass,

            addClass: addClass,

            getPreference: getPreference,

            setPreference: setPreference,

            request: request,

            load: function(selector, url, onSuccess, onError, options) {
                var el = document.getElementById(selector);

                if (el && el.getAttribute('data-sfurl') !== url) {
                    request(
                        url,
                        function(xhr) {
                            el.innerHTML = xhr.responseText;
                            el.setAttribute('data-sfurl', url);
                            removeClass(el, 'loading');
                            (onSuccess || noop)(xhr, el);
                        },
                        function(xhr) { (onError || noop)(xhr, el); },
                        '',
                        options
                    );
                }

                return this;
            },

            toggle: function(selector, elOn, elOff) {
                var i,
                    style,
                    tmp = elOn.style.display,
                    el = document.getElementById(selector);

                elOn.style.display = elOff.style.display;
                elOff.style.display = tmp;

                if (el) {
                    el.style.display = 'none' === tmp ? 'none' : 'block';
                }

                return this;
            }
        }
    })();
/*]]>*/</script>
";
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Profiler/base_js.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  91 => 35,  75 => 28,  50 => 15,  42 => 12,  24 => 2,  19 => 1,  279 => 126,  276 => 125,  265 => 117,  262 => 116,  257 => 113,  254 => 112,  242 => 102,  236 => 100,  234 => 99,  226 => 94,  222 => 93,  217 => 91,  213 => 90,  210 => 89,  198 => 79,  194 => 78,  179 => 68,  175 => 67,  163 => 58,  120 => 31,  97 => 17,  94 => 16,  88 => 9,  84 => 8,  76 => 6,  70 => 26,  63 => 131,  61 => 125,  59 => 116,  56 => 115,  54 => 112,  51 => 111,  49 => 31,  47 => 16,  36 => 6,  32 => 6,  26 => 3,  173 => 92,  170 => 91,  165 => 87,  162 => 85,  159 => 57,  156 => 81,  153 => 79,  151 => 78,  149 => 77,  147 => 48,  145 => 75,  143 => 47,  140 => 72,  138 => 71,  136 => 70,  134 => 69,  132 => 68,  130 => 37,  127 => 65,  125 => 64,  123 => 32,  121 => 62,  119 => 61,  109 => 24,  102 => 20,  83 => 30,  79 => 29,  66 => 25,  62 => 24,  57 => 19,  46 => 14,  41 => 8,  38 => 11,  33 => 5,  30 => 5,);
    }
}
