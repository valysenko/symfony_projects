<?php

/* VladyslavSmartBookmarkBundle:Cabinet:sendBookmark.html.twig */
class __TwigTemplate_df80bad2b0233ec314961e1c936acfff253f5515e06e8de42805cc30f9fed99a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
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
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div class=\"content\">
        <table class=\"add_table\">
            <tr class=\"tr_class\">
                <td>
                    ";
        // line 9
        echo $this->env->getExtension('translator')->getTranslator()->trans("Відправка закладки другу", array(), "messages");
        // line 10
        echo "
                </td>
            </tr>
            ";
        // line 13
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
            ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "

            <tr>
                <td>
                    ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'errors');
        echo "
                    ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'widget', array("attr" => array("class" => "input_login", "placeholder" => "Email")));
        echo "
                </td>
            </tr>

            <tr>
                <td>
                    ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "send"), 'widget', array("attr" => array("class" => "add_button", "label" => "")));
        // line 26
        echo "
                </td>
            </tr>



            ";
        // line 32
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

        </table>


    </div>
";
    }

    // line 40
    public function block_footer($context, array $blocks = array())
    {
        // line 41
        echo "    <div class=\"footer\">
        <br>Copyright 2014 © - web_guru
    </div>
";
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Cabinet:sendBookmark.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 41,  90 => 40,  79 => 32,  71 => 26,  69 => 25,  60 => 19,  56 => 18,  49 => 14,  45 => 13,  40 => 10,  38 => 9,  32 => 5,  29 => 4,);
    }
}
