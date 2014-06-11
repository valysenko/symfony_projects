<?php

/* VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig */
class __TwigTemplate_0b9c05ae6ec77abe5b38d53a533f072e2c85195f822d60e05922c6997093cddf extends Twig_Template
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

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "

    <div class=\"content\">
        <div style=\"padding-top:10px;padding-left:15px; height:470px;width:12%;float:left;overflow:scroll;\">
            <a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("cabinet");
        echo "\" class=\"category_name\"><span>
                        Всі закладки
                    </span></a><br>
            ";
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : $this->getContext($context, "categories")));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 14
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("cabinet", array("category_id" => $this->getAttribute((isset($context["category"]) ? $context["category"] : $this->getContext($context, "category")), "getId", array(), "method"))), "html", null, true);
            echo "\" class=\"category_name\"> <span>
                           ";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : $this->getContext($context, "category")), "getName", array(), "method"), "html", null, true);
            echo "

                       </span></a>
                <br>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "

        </div>
        <div style=\"float:left;width:85%;\">

            ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["bookmarks"]) ? $context["bookmarks"] : $this->getContext($context, "bookmarks")));
        foreach ($context['_seq'] as $context["_key"] => $context["bookmark"]) {
            // line 26
            echo "               <div class=\"one\">
                    <table>
                        <tr>
                            <td class=\"bookmark_name\">
                                ";
            // line 30
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getName", array(), "method"), 0, 28), "html", null, true);
            echo "
                            </td>
                        </tr>
                        <tr>
                            <td class=\"tr_hover\">
                                ";
            // line 35
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getDescription", array(), "method"), 0, 145), "html", null, true);
            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <a href=\"";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getLink", array(), "method"), "html", null, true);
            echo "\">
                                        <li>";
            // line 42
            echo $this->env->getExtension('translator')->getTranslator()->trans("Перейти", array(), "messages");
            echo "</li>
                                    </a>
                                    <a href=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("send_bookmark", array("id" => $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getId", array(), "method"))), "html", null, true);
            echo "\">
                                        <li>";
            // line 45
            echo $this->env->getExtension('translator')->getTranslator()->trans("Надіслати", array(), "messages");
            echo "</li>
                                    </a>
                                    <a href=\"";
            // line 47
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("delete_bookmark", array("id" => $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getId", array(), "method"))), "html", null, true);
            echo "\">
                                        <li>";
            // line 48
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
        // line 56
        echo "            ";
        if (((isset($context["quantityOfPages"]) ? $context["quantityOfPages"] : $this->getContext($context, "quantityOfPages")) > 1)) {
            // line 57
            echo "                <div style=\"margin:auto;padding-top:20px;clear:both;text-align: center\">
                    ";
            // line 58
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, ((isset($context["quantityOfPages"]) ? $context["quantityOfPages"] : $this->getContext($context, "quantityOfPages")) + 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 59
                echo "                        <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("cabinet", array("page" => (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")))), "html", null, true);
                echo "\" class=\"paginator_link\">";
                echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
                echo " </a>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "                </div>
            ";
        }
        // line 63
        echo "        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 63,  154 => 61,  143 => 59,  139 => 58,  136 => 57,  133 => 56,  119 => 48,  115 => 47,  110 => 45,  106 => 44,  101 => 42,  97 => 41,  88 => 35,  80 => 30,  74 => 26,  70 => 25,  63 => 20,  52 => 15,  47 => 14,  43 => 13,  37 => 10,  31 => 6,  28 => 5,);
    }
}
