<?php

/* VladyslavSmartBookmarkBundle:Index:index.html.twig */
class __TwigTemplate_c341faf1771ecd4b5393f3cbcdd736f80a8d4e6b4f3b0e73de568b7a2d84b4c0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
            'languages' => array($this, 'block_languages'),
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_languages($context, array $blocks = array())
    {
        // line 5
        echo "
";
    }

    // line 7
    public function block_menu($context, array $blocks = array())
    {
        // line 8
        echo "    <table class=\"menu_index\">
        <tr>
            <td class=\"logo\" >
                <a href =\"";
        // line 11
        echo $this->env->getExtension('routing')->getPath("index_page");
        echo "\" id=\"href\">
                    <div class=\"orange_logo\"> smartBookmark</div>
                </a>
            </td>

            <td class=\"gap\">
            </td>

            <a href=\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("login_path");
        echo "\" id=\"href\" class=\"index_href\">
                <td class=\"enter\">
                    <a href=\"";
        // line 21
        echo $this->env->getExtension('routing')->getPath("login_path");
        echo "\" id=\"href\">
                        <div class=\"orange_button\"> ";
        // line 22
        echo $this->env->getExtension('translator')->getTranslator()->trans("Вхід", array(), "messages");
        echo "</div>
                    </a>
                </td>
            </a>

            <td class=\"gap\">
            </td>


                <td class=\"register\">
                    <a href=\"";
        // line 32
        echo $this->env->getExtension('routing')->getPath("registration_path");
        echo "\" id=\"href\">
                        <div class=\"orange_button\"> ";
        // line 33
        echo $this->env->getExtension('translator')->getTranslator()->trans("Реєстрація", array(), "messages");
        echo "</div>
                    </a>
                </td>


            <td class=\"gap\">
            </td>

            <td class=\"fast_enter\">
            </td>

            <td class=\"gap\">
            </td>

            <td class=\"languages\" style=\"vertical-align:bottom;text-decoration:none;color:white;
            \">&nbsp;&nbsp;
                <a href=\"";
        // line 49
        echo $this->env->getExtension('routing')->getPath("index_page", array("_locale" => "en"));
        echo "\" style=\"text-decoration:none\">
                    <img src=\"/bundles/vladyslavsmartbookmark/images/England.png\">
                </a>

                <a href=\"";
        // line 53
        echo $this->env->getExtension('routing')->getPath("index_page", array("_locale" => "ukr"));
        echo "\" style=\"text-decoration:none\">
                    <img src=\"/bundles/vladyslavsmartbookmark/images/Ukraine.png\">
                </a>
            </td>
        </tr>

    </table>
    ";
        // line 61
        echo "        ";
        // line 62
        echo "            ";
        // line 63
        echo "            ";
        // line 64
        echo "        ";
        // line 65
        echo "
        ";
        // line 67
        echo "            ";
        // line 68
        echo "                ";
        // line 69
        echo "                ";
        // line 70
        echo "            ";
        // line 71
        echo "        ";
        // line 72
        echo "
        ";
        // line 74
        echo "            ";
        // line 75
        echo "                ";
        // line 76
        echo "                ";
        // line 77
        echo "            ";
        // line 78
        echo "        ";
        // line 79
        echo "
        ";
        // line 81
        echo "
        ";
        // line 83
        echo "
        ";
        // line 85
        echo "
        ";
        // line 87
        echo "
    ";
    }

    // line 91
    public function block_content($context, array $blocks = array())
    {
        // line 92
        echo "    <div class=\"content_index\">
        <div class=\"sp-slideshow\">

            <input id=\"button-1\" type=\"radio\" name=\"radio-set\" class=\"sp-selector-1\" checked=\"checked\" />
            <label for=\"button-1\" class=\"button-label-1\"></label>

            <input id=\"button-2\" type=\"radio\" name=\"radio-set\" class=\"sp-selector-2\" />
            <label for=\"button-2\" class=\"button-label-2\"></label>

            <input id=\"button-3\" type=\"radio\" name=\"radio-set\" class=\"sp-selector-3\" />
            <label for=\"button-3\" class=\"button-label-3\"></label>

            ";
        // line 105
        echo "            ";
        // line 106
        echo "
            ";
        // line 108
        echo "            ";
        // line 109
        echo "
            <label for=\"button-1\" class=\"sp-arrow sp-a1\"></label>
            <label for=\"button-2\" class=\"sp-arrow sp-a2\"></label>
            <label for=\"button-3\" class=\"sp-arrow sp-a3\"></label>
            ";
        // line 114
        echo "            ";
        // line 115
        echo "
            <div class=\"sp-content\">
                <div class=\"sp-parallax-bg\" style=\"background: #ff6e22;\"></div>
                <ul class=\"sp-slider clearfix\">
                    <li class=\"main_li\">
                        <span style=\"padding-bottom:10px\">smartBookmark - зберігайте свій час та закладки!</span>
                        <img src=\"/bundles/vladyslavsmartbookmark/images/one.jpeg\" alt=\"image01\"
                        >
                    </li>
                    <li class=\"main_li\">
                        <span>smartBookmark - діліться закладками з друзями!</span>
                        <img src=\"/bundles/vladyslavsmartbookmark/images/two.jpg\" alt=\"image02\"
                             />
                    </li>
                    ";
        // line 130
        echo "                        ";
        // line 131
        echo "                        ";
        // line 132
        echo "                    ";
        // line 133
        echo "                    <li class=\"main_li\">
                        <span>і ще, smartBookmark - це абсолютно безкоштовно=)</span>
                        <img src=\"/bundles/vladyslavsmartbookmark/images/four.png\" alt=\"image03;\"
                        >
                    </li>
                </ul>
            </div><!-- sp-content -->

        </div><!-- sp-slideshow -->


    </div>
";
    }

    // line 147
    public function block_footer($context, array $blocks = array())
    {
        // line 148
        echo "    <table class=\"footer_index\">
        <tr>
            <td>
                Copyright 2014 © - web_guru
            </td>
        </tr>
    </table>
";
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Index:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 148,  241 => 147,  225 => 133,  223 => 132,  221 => 131,  219 => 130,  203 => 115,  201 => 114,  195 => 109,  193 => 108,  190 => 106,  188 => 105,  174 => 92,  171 => 91,  166 => 87,  163 => 85,  160 => 83,  157 => 81,  154 => 79,  152 => 78,  150 => 77,  148 => 76,  146 => 75,  144 => 74,  141 => 72,  139 => 71,  137 => 70,  135 => 69,  133 => 68,  131 => 67,  128 => 65,  126 => 64,  124 => 63,  122 => 62,  120 => 61,  110 => 53,  103 => 49,  84 => 33,  80 => 32,  67 => 22,  63 => 21,  58 => 19,  47 => 11,  42 => 8,  39 => 7,  34 => 5,  31 => 4,);
    }
}
