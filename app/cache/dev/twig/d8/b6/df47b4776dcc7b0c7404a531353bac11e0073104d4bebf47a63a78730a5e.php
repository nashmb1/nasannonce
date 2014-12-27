<?php

/* NASUserBundle:Security:login.html.twig */
class __TwigTemplate_d8b6df47b4776dcc7b0c7404a531353bac11e0073104d4bebf47a63a78730a5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("NASCoreBundle::layout.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "NASCoreBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "
  ";
        // line 8
        echo "  ";
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 9
            echo "    <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message", array()), "html", null, true);
            echo "</div>
  ";
        }
        // line 11
        echo "
  ";
        // line 13
        echo "  <form action=\"";
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\" class =\"well\">
    <div class=\"form-group\">
    <label for=\"username\">Login :</label><br />
    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" />
    </div>
    <div class=\"form-group\">
    <label for=\"password\">Mot de passe :</label><br />
    <input type=\"password\" id=\"password\" name=\"_password\" />
    </div>
    <input type=\"submit\" value=\"Connexion\" class =\" btn btn-primary\"/>
  </form>

";
    }

    public function getTemplateName()
    {
        return "NASUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 16,  46 => 13,  43 => 11,  37 => 9,  34 => 8,  31 => 6,  28 => 5,);
    }
}
