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
        echo "</title> ";
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "</head>

<body>


\t<div class=\"container\">
\t\t<header>
\t\t\t<div class=\"tete\">
\t\t\t\t<img src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("legacy/images/logo.png"), "html", null, true);
        echo "\" alt=\"Symfony!\" />
\t\t\t</div>
\t\t</header>
\t\t<nav class=\"navbar navbar-inverse\">
\t\t\t<div class=\"container-fluid\">
\t\t\t\t<ul class=\"nav navbar-nav\">
\t\t\t\t\t<li class=\"active\"><a href=\"";
        // line 31
        echo $this->env->getExtension('routing')->getPath("nas_core_homepage");
        echo "\">Accueil</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 32
        echo $this->env->getExtension('routing')->getPath("oc_platform_add");
        echo "\">Ajouter
\t\t\t\t\t\t\tune annonce</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 34
        echo $this->env->getExtension('routing')->getPath("nas_core_contact");
        echo "\">Contact</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t<form class=\"navbar-form navbar-right inline-form\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t <a href=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("login");
        echo "\">Connexion</a>
\t\t\t\t\t\t\t<input type=\"search\" class=\"input-sm form-control\" placeholder=\"Recherche\">
\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary btn-sm\">
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-eye-open\"></span> Chercher
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</form>
\t\t\t</div>
\t\t</nav>
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-3\">
\t\t\t\t<h3 class = \"couleur-verte\">Menu principal</h3>
\t\t\t\t<ul class=\"nav nav-pills nav-stacked couleur-grise\">
\t\t\t\t\t<li><a href=\"";
        // line 51
        echo $this->env->getExtension('routing')->getPath("nas_core_homepage");
        echo "\">Accueil</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 52
        echo $this->env->getExtension('routing')->getPath("oc_platform_home");
        echo "\">Les annonces</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 53
        echo $this->env->getExtension('routing')->getPath("oc_platform_add");
        echo "\">Ajouter une annonce</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 54
        echo $this->env->getExtension('routing')->getPath("nas_core_contact");
        echo "\">Nous contacter</a></li>
\t\t\t\t\t<li color =\"red\"><a href=\"";
        // line 55
        echo $this->env->getExtension('routing')->getPath("logout");
        echo "\">Se déconnecter</a></li>
\t\t\t\t</ul>
\t\t\t\t
\t\t\t\t<h3 class = \"couleur-verte\">Dernières annonces</h3>
\t\t\t\t<div class=\"couleur-grise\">
\t\t\t\t";
        // line 60
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("OCPlatformBundle:Advert:menu", array("limit" => 3)));
        echo "</div>
\t\t\t</div>
\t\t\t<div id=\"content\" class=\"col-md-9\">";
        // line 62
        $this->displayBlock('body', $context, $blocks);
        echo "</div>
\t\t</div>

\t\t<hr>

\t\t<footer>
\t\t\t<p> hm.nassirou©";
        // line 68
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " and beyond.</p>
\t\t</footer>
\t</div>

\t";
        // line 72
        $this->displayBlock('javascripts', $context, $blocks);
        // line 79
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

    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo " ";
        // line 12
        echo "<link rel=\"stylesheet\"
\thref=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">
<link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" type=\"text/css\"
\trel=\"stylesheet\" />
";
    }

    // line 62
    public function block_body($context, array $blocks = array())
    {
        echo " ";
    }

    // line 72
    public function block_javascripts($context, array $blocks = array())
    {
        echo " ";
        // line 74
        echo "\t<script
\t\tsrc=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
\t<script
\t\tsrc=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js\"></script>
\t";
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
        return array (  172 => 74,  168 => 72,  162 => 62,  155 => 14,  151 => 12,  149 => 10,  141 => 9,  134 => 79,  132 => 72,  125 => 68,  116 => 62,  111 => 60,  103 => 55,  99 => 54,  95 => 53,  91 => 52,  87 => 51,  71 => 38,  64 => 34,  59 => 32,  55 => 31,  46 => 25,  36 => 17,  32 => 9,  23 => 2,);
    }
}
