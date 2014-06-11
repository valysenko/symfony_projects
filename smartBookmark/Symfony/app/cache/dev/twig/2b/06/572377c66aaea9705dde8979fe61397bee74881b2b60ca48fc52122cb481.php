<?php

/* VladyslavSmartBookmarkBundle:Cabinet:responsedBookmarks.html.twig */
class __TwigTemplate_2b06572377c66aaea9705dde8979fe61397bee74881b2b60ca48fc52122cb481 extends Twig_Template
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
        <div style=\"padding-top:10px;padding-left:5px; height:470px;width:10%;float:left;
        border-right:7px solid rgba(214,211,210,0.5);\">
            <a href=\"";
        // line 8
        echo $this->env->getExtension('routing')->getPath("add_all");
        echo "\" class=\"category_name\"><span>
                        Додати всі
                    </span></a><br>

            <a href=\"";
        // line 12
        echo $this->env->getExtension('routing')->getPath("delete_all");
        echo "\" class=\"category_name\"><span>
                        Видалити всі
                    </span></a><br>

        </div>
        <div style=\"float:left;width:85%;\">
            ";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["bookmarks"]) ? $context["bookmarks"] : $this->getContext($context, "bookmarks")));
        foreach ($context['_seq'] as $context["_key"] => $context["bookmark"]) {
            // line 19
            echo "
                <div class=\"one\">
                    <table>
                        <tr>
                            <td class=\"bookmark_name\">
                                ";
            // line 24
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getName", array(), "method"), 0, 28), "html", null, true);
            echo "
                            </td>
                        </tr>
                        <tr>
                            <td class=\"tr_hover\">
                                ";
            // line 29
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getDescription", array(), "method"), 0, 145), "html", null, true);
            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <a href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("add_responsed_bookmark", array("id" => $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getId", array(), "method"))), "html", null, true);
            echo "\">
                                        <li>";
            // line 36
            echo $this->env->getExtension('translator')->getTranslator()->trans("Додати", array(), "messages");
            echo "</li>
                                    </a>
                                    <a href=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("delete_responsed_bookmark", array("id" => $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getId", array(), "method"))), "html", null, true);
            echo "\">
                                        <li>";
            // line 39
            echo $this->env->getExtension('translator')->getTranslator()->trans("Видалити", array(), "messages");
            echo "</li>
                                    </a>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bookmark'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "            ";
        if (((isset($context["quantityOfPages"]) ? $context["quantityOfPages"] : $this->getContext($context, "quantityOfPages")) > 1)) {
            // line 48
            echo "                <div style=\"margin:auto;padding-top:20px;clear:both;text-align: center\">
                    ";
            // line 49
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, ((isset($context["quantityOfPages"]) ? $context["quantityOfPages"] : $this->getContext($context, "quantityOfPages")) + 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 50
                echo "                        <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("responsed_bookmarks", array("page" => (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))), "html", null, true);
                echo "\" class=\"paginator_link\">";
                echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                echo " </a>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "                </div>
            ";
        }
        // line 54
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Cabinet:responsedBookmarks.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 54,  128 => 52,  117 => 50,  113 => 49,  110 => 48,  107 => 47,  93 => 39,  89 => 38,  84 => 36,  80 => 35,  71 => 29,  63 => 24,  56 => 19,  52 => 18,  43 => 12,  36 => 8,  31 => 5,  28 => 4,);
    }
}
