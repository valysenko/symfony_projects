<?php

/* VladyslavSmartBookmarkBundle:Security:registration.html.twig */
class __TwigTemplate_2fe68d347ca1a69f9d7430014c4bafb6e012209e90d92ff9a2b3b2a3c68b6193 extends Twig_Template
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
        // line 85
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

           ";
        // line 16
        echo "               <div class=\"security_logo\">
                   <a href =\"";
        // line 17
        echo $this->env->getExtension('routing')->getPath("index_page");
        echo "\" id=\"href\">
                       <div class=\"orange_logo\"> smartBookmark</div>
                   </a>
               </div>
           ";
        // line 22
        echo "
            ";
        // line 23
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
            ";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "

                <table class=\"security_table\">
                    <tr style=\"height: 10px;\"></tr>
                    <tr style=\"height: 10px;\"></tr>

                    <tr>

                        <td>
                            ";
        // line 33
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'errors');
        echo "
                            ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'widget', array("attr" => array("class" => "input_login", "placeholder" => "Логін")));
        echo "
                        </td>
                    </tr>
                    <tr>

                        <td>
                            ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), 'errors');
        echo "
                            ";
        // line 41
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), 'widget', array("attr" => array("class" => "input_login", "placeholder" => "Пароль")));
        echo "
                        </td>
                    </tr>

                    <tr>

                        <td>
                            ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "confirm_password"), 'errors');
        echo "
                            ";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "confirm_password"), 'widget', array("attr" => array("class" => "input_login", "placeholder" => "Підтвердження пароля")));
        echo "
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <span style=\"font-size:14px; color:red;\"> ";
        // line 54
        echo twig_escape_filter($this->env, (isset($context["error_message"]) ? $context["error_message"] : $this->getContext($context, "error_message")), "html", null, true);
        echo " </span>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            ";
        // line 60
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'errors');
        echo "
                            ";
        // line 61
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'widget', array("attr" => array("class" => "input_login", "placeholder" => "Email")));
        echo "
                        </td>
                    </tr>


                    <tr>
                        <td>
                             ";
        // line 68
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "register"), 'widget', array("attr" => array("class" => "add_button", "name" => "Зареєструватися")));
        echo "
                         </td>
                    </tr>
                    <tr style=\"height: 10px;\"></tr>
                    <tr style=\"height: 10px;\"></tr>
                </table>
            ";
        // line 74
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
        </form>
        </div>
        ";
        // line 78
        echo "            ";
        // line 79
        echo "                ";
        // line 80
        echo "                    ";
        // line 81
        echo "                ";
        // line 82
        echo "            ";
        // line 83
        echo "        ";
        // line 84
        echo "    ";
    }

    // line 96
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Security:registration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 96,  206 => 84,  204 => 83,  202 => 82,  200 => 81,  198 => 80,  196 => 79,  194 => 78,  188 => 74,  179 => 68,  169 => 61,  165 => 60,  156 => 54,  148 => 49,  144 => 48,  134 => 41,  130 => 40,  121 => 34,  117 => 33,  105 => 24,  101 => 23,  98 => 22,  91 => 17,  88 => 16,  82 => 11,  79 => 10,  75 => 9,  72 => 8,  68 => 7,  65 => 6,  51 => 85,  48 => 10,  45 => 8,  42 => 6,  39 => 5,  33 => 3,);
    }
}
