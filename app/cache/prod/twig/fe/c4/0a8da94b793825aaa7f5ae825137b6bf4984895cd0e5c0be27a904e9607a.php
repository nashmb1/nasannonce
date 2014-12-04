<?php

/* NASCoreBundle::layout.html.twig */
class __TwigTemplate_fec40a8da94b793825aaa7f5ae825137b6bf4984895cd0e5c0be27a904e9607a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 15
        echo "</head>

<body>


<div class=\"container\">
<header>
    <div class =\"tete\"> <img src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("legacy/images/logo.png"), "html", null, true);
        echo "\" alt=\"Symfony!\" /> </div>
</header>
<div><ul id=\"navigation\" class=\"nav-main\">
        <li><a href=\"";
        // line 25
        echo $this->env->getExtension('routing')->getPath("nas_core_homepage");
        echo "\">Accueil</a></li>
        <li class=\"list\"><a href=\"";
        // line 26
        echo $this->env->getExtension('routing')->getPath("oc_platform_add");
        echo "\">Ajouter une annonce</a>
        </li>
        <li class=\"list\"><a href=\"";
        // line 28
        echo $this->env->getExtension('routing')->getPath("nas_core_contact");
        echo "\">Contact</a>
        </li>
    </ul></div>

<div class=\"row\">
    <div id=\"menu\" class=\"col-md-3\">
        <h3>Menu principal</h3>
        <ul class=\"nav nav-pills nav-stacked\">
            <li><a href=\"";
        // line 36
        echo $this->env->getExtension('routing')->getPath("nas_core_homepage");
        echo "\">Accueil</a></li>
            <li><a href=\"";
        // line 37
        echo $this->env->getExtension('routing')->getPath("oc_platform_home");
        echo "\">Les annonces</a></li>
            <li><a href=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("oc_platform_add");
        echo "\">Ajouter une annonce</a></li>
            <li><a href=\"";
        // line 39
        echo $this->env->getExtension('routing')->getPath("nas_core_contact");
        echo "\">Nous contacter</a></li>
        </ul>

        <h4>Dernières annonces</h4>
        ";
        // line 43
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("OCPlatformBundle:Advert:menu", array("limit" => 3)));
        echo "
    </div>
    <div id=\"content\" class=\"col-md-9\">
        ";
        // line 46
        $this->displayBlock('body', $context, $blocks);
        // line 48
        echo "    </div>
</div>

<hr>

<footer>
    <p>The sky's the limit © ";
        // line 54
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " and beyond.</p>
</footer>
</div>

";
        // line 58
        $this->displayBlock('javascripts', $context, $blocks);
        // line 63
        echo "
</body>
</html>
";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "OC Plateforme";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "        ";
        // line 12
        echo "        <link rel=\"stylesheet\" href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">
        <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    ";
    }

    // line 46
    public function block_body($context, array $blocks = array())
    {
        // line 47
        echo "        ";
    }

    // line 58
    public function block_javascripts($context, array $blocks = array())
    {
        // line 59
        echo "    ";
        // line 60
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "NASCoreBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 60,  154 => 59,  151 => 58,  147 => 47,  144 => 46,  138 => 13,  135 => 12,  133 => 11,  130 => 10,  124 => 9,  117 => 63,  115 => 58,  108 => 54,  100 => 48,  98 => 46,  92 => 43,  85 => 39,  81 => 38,  77 => 37,  73 => 36,  62 => 28,  57 => 26,  53 => 25,  47 => 22,  38 => 15,  36 => 10,  32 => 9,  23 => 2,);
    }
}
