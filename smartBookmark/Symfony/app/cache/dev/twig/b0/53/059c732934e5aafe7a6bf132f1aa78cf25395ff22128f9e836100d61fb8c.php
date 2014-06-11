<?php

/* VladyslavSmartBookmarkBundle:Security:login.html.twig */
class __TwigTemplate_b053059c732934e5aafe7a6bf132f1aa78cf25395ff22128f9e836100d61fb8c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
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

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "SmartBookmark:login";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayBlock('languages', $context, $blocks);
        // line 8
        echo "    ";
        $this->displayBlock('menu', $context, $blocks);
        // line 10
        echo "    ";
        $this->displayBlock('content', $context, $blocks);
        // line 80
        echo "

    <div id=\"container\">






    </div>
";
    }

    // line 6
    public function block_languages($context, array $blocks = array())
    {
        // line 7
        echo "    ";
    }

    // line 8
    public function block_menu($context, array $blocks = array())
    {
        // line 9
        echo "    ";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "

        <div align=\"center\" class=\"login_block\">

        <form action=\"";
        // line 15
        echo $this->env->getExtension('routing')->getPath("check_path");
        echo "\" method=\"POST\">

            ";
        // line 18
        echo "                <div class=\"security_logo\">
                    <a href =\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("index_page");
        echo "\" id=\"href\">
                        <div class=\"orange_logo\"> smartBookmark</div>
                    </a>
                </div>
            <td class=\"logo\" >

            ";
        // line 26
        echo "
            <table class=\"security_table\">
                <tr style=\"height: 10px;\"></tr>
                <tr style=\"height: 10px;\"></tr>

                <tr>

                    <td>
                        <input type=\"text\" class=\"input_login\"  id=\"username\" placeholder=\"";
        // line 34
        echo $this->env->getExtension('translator')->getTranslator()->trans("Логін", array(), "messages");
        echo "\"
                               name=\"_username\" />
                    </td>
                </tr>
                <tr>

                    <td>
                        <input type=\"password\" class=\"input_login\" id=\"password\" placeholder=\"";
        // line 41
        echo $this->env->getExtension('translator')->getTranslator()->trans("Пароль", array(), "messages");
        echo "\"
                               name=\"_password\" />
                    </td>
                </tr>
                <tr>
                    <td style=\"color:red\">";
        // line 46
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 47
            echo "                      ";
            echo twig_escape_filter($this->env, strtr($this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message"), array("Bad credentials" => "Невірний логін/пароль")), "html", null, true);
            // line 49
            echo "

                    ";
        }
        // line 52
        echo "                    </td>
                </tr>
                <tr style=\"height: 10px;\">
                    <td style=\"text-align:left;padding-left:35px;height:15px;\">
                        <a href=\"";
        // line 56
        echo $this->env->getExtension('routing')->getPath("restore_password");
        echo "\" style=\"color:#ff6e22; text-decoration:none\"> ";
        echo $this->env->getExtension('translator')->getTranslator()->trans("Забули пароль?", array(), "messages");
        echo "</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type=\"hidden\" name=\"_csrf_token\"
                               value=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('form')->renderer->renderCsrfToken("authenticate"), "html", null, true);
        echo "\"
                                >
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type=\"submit\" class=\"add_button\" id=\"enter_button\" name=\"login\"
                               value=\"";
        // line 69
        echo $this->env->getExtension('translator')->getTranslator()->trans("Вхід", array(), "messages");
        echo "\" />
                    </td>
                </tr>

                <tr style=\"height: 10px;\"></tr>
                <tr style=\"height: 10px;\"></tr>
            </table>

        </form>
        </div>
    ";
    }

    // line 91
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  185 => 91,  170 => 69,  160 => 62,  149 => 56,  143 => 52,  138 => 49,  135 => 47,  133 => 46,  125 => 41,  115 => 34,  105 => 26,  96 => 19,  93 => 18,  88 => 15,  82 => 11,  79 => 10,  75 => 9,  72 => 8,  68 => 7,  65 => 6,  51 => 80,  48 => 10,  45 => 8,  42 => 6,  39 => 5,  33 => 3,);
    }
}
