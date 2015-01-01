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
                            ";
        // line 38
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 39
            echo "                               Bienvenue ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "
                                <a href=\"";
            // line 40
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\">
                                    Déconnexion
                                </a>
                            ";
        } else {
            // line 44
            echo "                                <a href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_security_login");
            echo "\">Connexion</a>
                            ";
        }
        // line 46
        echo "\t\t\t\t\t\t\t<input type=\"search\" class=\"input-sm form-control\" placeholder=\"Recherche\">
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
        // line 58
        echo $this->env->getExtension('routing')->getPath("nas_core_homepage");
        echo "\">Accueil</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 59
        echo $this->env->getExtension('routing')->getPath("oc_platform_home");
        echo "\">Les annonces</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 60
        echo $this->env->getExtension('routing')->getPath("oc_platform_add");
        echo "\">Ajouter une annonce</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 61
        echo $this->env->getExtension('routing')->getPath("nas_core_contact");
        echo "\">Nous contacter</a></li>
                    <li><a href=\"";
        // line 62
        echo $this->env->getExtension('routing')->getPath("fos_user_registration_register");
        echo "\">S'inscrire</a></li>

\t\t\t\t</ul>

<h3 class = \"couleur-verte\">Dernières annonces</h3>
<div class=\"couleur-grise\">
    ";
        // line 68
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("OCPlatformBundle:Advert:menu", array("limit" => 3)));
        echo "</div>
</div>
<div id=\"content\" class=\"col-md-9\">";
        // line 70
        $this->displayBlock('body', $context, $blocks);
        echo "</div>
</div>

<hr>

<footer>
    <p> hm.nassirou©";
        // line 76
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " and beyond.</p>
</footer>
</div>

";
        // line 80
        $this->displayBlock('javascripts', $context, $blocks);
        // line 87
        echo "
</body>
</html>
g";
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

    // line 70
    public function block_body($context, array $blocks = array())
    {
        echo " ";
    }

    // line 80
    public function block_javascripts($context, array $blocks = array())
    {
        echo " ";
        // line 82
        echo "    <script
            src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script
            src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js\"></script>
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
        return array (  191 => 82,  187 => 80,  181 => 70,  174 => 14,  170 => 12,  168 => 10,  160 => 9,  153 => 87,  151 => 80,  144 => 76,  135 => 70,  130 => 68,  121 => 62,  117 => 61,  113 => 60,  109 => 59,  105 => 58,  91 => 46,  85 => 44,  78 => 40,  73 => 39,  71 => 38,  64 => 34,  59 => 32,  55 => 31,  46 => 25,  36 => 17,  32 => 9,  23 => 2,);
    }
}
