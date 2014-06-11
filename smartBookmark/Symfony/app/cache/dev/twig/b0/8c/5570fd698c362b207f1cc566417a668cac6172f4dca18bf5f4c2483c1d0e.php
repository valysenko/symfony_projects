<?php

/* VladyslavSmartBookmarkBundle:Cabinet:popular.html.twig */
class __TwigTemplate_b08c5570fd698c362b207f1cc566417a668cac6172f4dca18bf5f4c2483c1d0e extends Twig_Template
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
        <div style=\"padding-top:10px;padding-left:15px; height:470px;width:12%;float:left;overflow:scroll;\">
            <a href=\"";
        // line 7
        echo $this->env->getExtension('routing')->getPath("popular_bookmarks");
        echo "\" class=\"category_name\"><span>
                        Всі популярні
                    </span></a><br>
            ";
        // line 10
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : $this->getContext($context, "categories")));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 11
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("popular_bookmarks", array("category_id" => $this->getAttribute((isset($context["category"]) ? $context["category"] : $this->getContext($context, "category")), "getId", array(), "method"))), "html", null, true);
            echo "\" class=\"category_name\"> <span>
                           ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : $this->getContext($context, "category")), "getName", array(), "method"), "html", null, true);
            echo "

                       </span></a>
                <br>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "

        </div>
        <div style=\"float:left;width:85%;\">
        ";
        // line 21
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["bookmarks"]) ? $context["bookmarks"] : $this->getContext($context, "bookmarks")));
        foreach ($context['_seq'] as $context["_key"] => $context["bookmark"]) {
            // line 22
            echo "
             <div class=\"one\">
                 <table>
                     <tr>
                         <td class=\"bookmark_name\">
                             ";
            // line 27
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getName", array(), "method"), 0, 28), "html", null, true);
            echo "
                         </td>
                     </tr>
                     <tr>
                         <td class=\"tr_hover\">
                             ";
            // line 32
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getDescription", array(), "method"), 0, 145), "html", null, true);
            echo "
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <ul>
                                 <a href=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("add_responsed_bookmark", array("id" => $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getId", array(), "method"))), "html", null, true);
            echo "\">
                                     <li>";
            // line 39
            echo $this->env->getExtension('translator')->getTranslator()->trans("Додати", array(), "messages");
            echo "</li>
                                 </a>
                                 <a href=\"";
            // line 41
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("delete_responsed_bookmark", array("id" => $this->getAttribute((isset($context["bookmark"]) ? $context["bookmark"] : $this->getContext($context, "bookmark")), "getId", array(), "method"))), "html", null, true);
            echo "\">
                                     <li>";
            // line 42
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
        // line 50
        echo "         ";
        // line 51
        echo "        ";
        // line 52
        echo "            ";
        // line 53
        echo "                ";
        // line 54
        echo "            ";
        // line 55
        echo "        ";
        // line 56
        echo "        ";
        // line 57
        echo "    </div>
        </div>
";
    }

    public function getTemplateName()
    {
        return "VladyslavSmartBookmarkBundle:Cabinet:popular.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 57,  134 => 56,  132 => 55,  130 => 54,  128 => 53,  126 => 52,  124 => 51,  122 => 50,  108 => 42,  104 => 41,  99 => 39,  95 => 38,  86 => 32,  78 => 27,  71 => 22,  67 => 21,  61 => 17,  50 => 12,  45 => 11,  41 => 10,  35 => 7,  31 => 5,  28 => 4,);
    }
}
