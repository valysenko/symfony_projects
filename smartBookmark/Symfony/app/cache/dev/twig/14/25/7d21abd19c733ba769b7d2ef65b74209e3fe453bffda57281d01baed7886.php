<?php

/* VladyslavSmartBookmarkBundle:Cabinet:editUser.html.twig */
class __TwigTemplate_14257d21abd19c733ba769b7d2ef65b74209e3fe453bffda57281d01baed7886 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
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
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div class=\"content\">
        ";
        // line 7
        echo "        ";
        // line 8
        echo "        ";
        // line 9
        echo "        <table class=\"add_table\">
            <tr class=\"tr_class\">
                <td>
                   ";
        // line 12
        echo $this->env->getExtension('translator')->getTranslator()->trans("Редагування користувача", array(), "messages");
        // line 13
        echo "                </td>
            </tr>
            ";
        // line 15
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
            ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "

            <tr>
                <td>
                    ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'errors');
        echo "
                    ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'widget', array("attr" => array("class" => "form_name", "value" => (isset($context["username"]) ? $context["username"] : $this->getContext($context, "username")))));
        echo "
                </td>
            </tr>

            ";
        // line 26
        echo "                ";
        // line 27
        echo "                    ";
        // line 28
        echo "                    ";
        // line 29
        echo "                ";
        // line 30
        echo "            ";
        // line 31
        echo "
            <tr>
                <td>
                    ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'errors');
        echo "
                    ";
        // line 35
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'widget', array("attr" => array("class" => "form_name", "value" => (isset($context["email"]) ? $context["email"] : $this->getContext($context, "email")))));
        echo "
                </td>
            </tr>



            <tr>
                <td>
                  ";
        // line 43
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "save"), 'widget', array("attr" => array("class" => "add_button")));
        echo "
                </td>
            </tr>

            ";
        // line 47
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

        </table>

    </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Cabinet:editUser.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 47,  101 => 43,  90 => 35,  86 => 34,  81 => 31,  79 => 30,  77 => 29,  75 => 28,  73 => 27,  71 => 26,  64 => 21,  60 => 20,  53 => 16,  49 => 15,  45 => 13,  43 => 12,  38 => 9,  36 => 8,  34 => 7,  31 => 5,  28 => 4,);
    }
}
