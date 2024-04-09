<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* pokemon/index.html.twig */
class __TwigTemplate_b5c643ea8608ee3df5a904acfdaf3be6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pokemon/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pokemon/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "pokemon/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Fiche Pokédex - ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 3, $this->source); })()), "name_fr", [], "any", false, false, false, 3), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "<style>
    .example-wrapper { margin: 1em auto; max-width: 800px; width: 95%; font: 18px/1.5 sans-serif; }
    .example-wrapper code { background: #F5F5F5; padding: 2px 6px; }
</style>

<div class=\"example-wrapper\">
    <div style=\"display: flex; justify-content: center; align-items: center; background-color: rgb(80, 80, 80); border-radius: 15px;\">
    <table style=\"width: 100%; color: white;\">
        <th style=\"width: 40%;\"><img style=\"width: 100%; height: auto;\" src=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 14, $this->source); })()), "sprite_regular", [], "any", false, false, false, 14), "html", null, true);
        echo "\"><th>
        <th style=\"text-align: left; width: 60%\">
            Fiche Pokédex de ";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 16, $this->source); })()), "name_fr", [], "any", false, false, false, 16), "html", null, true);
        echo "<br>
            <div style=\"background-color : green; height: 0.1em;\"></div>
            <div style=\"color: rgb(220, 220, 220);\">";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 18, $this->source); })()), "name_en", [], "any", false, false, false, 18), "html", null, true);
        echo " #";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 18, $this->source); })()), "pokedex_id", [], "any", false, false, false, 18), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 18, $this->source); })()), "name_jp", [], "any", false, false, false, 18), "html", null, true);
        echo "<br></div>
            ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 19, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 20
            echo "                <img style=\"width: 10%;\" src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["type"], "logo", [], "any", false, false, false, 20), "html", null, true);
            echo "\">
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "        </th>
    </table>
    </div>
    <div style=\"display: flex; justify-content: center; align-items: center; background-color: rgb(80, 80, 80); border-radius: 15px; margin-top: 1.5em; 
    padding-top: 1.2em; padding-bottom: 1.2em; color: rgb(220, 220, 220); font-size: 11px;\">
        <table style=\"width: 50%;\">
        <tr>
            <th style=\"text-align: left;\">CATÉGORIE</th>
            <th>";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 30, $this->source); })()), "category", [], "any", false, false, false, 30), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">GÉNÉRATION</th>
            <th>";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 34, $this->source); })()), "gene", [], "any", false, false, false, 34), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">PV</th>
            <th>";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 38, $this->source); })()), "hp", [], "any", false, false, false, 38), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">ATTAQUE</th>
            <th>";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 42, $this->source); })()), "atk", [], "any", false, false, false, 42), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">DÉFENSE</th>
            <th>";
        // line 46
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 46, $this->source); })()), "def", [], "any", false, false, false, 46), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">ATTAQUE SPÉ</th>
            <th>";
        // line 50
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 50, $this->source); })()), "spe_atk", [], "any", false, false, false, 50), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">DÉFENSE SPÉ</th>
            <th>";
        // line 54
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 54, $this->source); })()), "spe_def", [], "any", false, false, false, 54), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">VITESSE</th>
            <th>";
        // line 58
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 58, $this->source); })()), "vit", [], "any", false, false, false, 58), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">TAILLE</th>
            <th>";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 62, $this->source); })()), "height", [], "any", false, false, false, 62), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">POIDS</th>
            <th>";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["pokemon"]) || array_key_exists("pokemon", $context) ? $context["pokemon"] : (function () { throw new RuntimeError('Variable "pokemon" does not exist.', 66, $this->source); })()), "weight", [], "any", false, false, false, 66), "html", null, true);
        echo "</th>
        </tr>
        </table>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pokemon/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  203 => 66,  196 => 62,  189 => 58,  182 => 54,  175 => 50,  168 => 46,  161 => 42,  154 => 38,  147 => 34,  140 => 30,  130 => 22,  121 => 20,  117 => 19,  109 => 18,  104 => 16,  99 => 14,  89 => 6,  79 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Fiche Pokédex - {{ pokemon.name_fr }}{% endblock %}

{% block body %}
<style>
    .example-wrapper { margin: 1em auto; max-width: 800px; width: 95%; font: 18px/1.5 sans-serif; }
    .example-wrapper code { background: #F5F5F5; padding: 2px 6px; }
</style>

<div class=\"example-wrapper\">
    <div style=\"display: flex; justify-content: center; align-items: center; background-color: rgb(80, 80, 80); border-radius: 15px;\">
    <table style=\"width: 100%; color: white;\">
        <th style=\"width: 40%;\"><img style=\"width: 100%; height: auto;\" src=\"{{ pokemon.sprite_regular }}\"><th>
        <th style=\"text-align: left; width: 60%\">
            Fiche Pokédex de {{ pokemon.name_fr }}<br>
            <div style=\"background-color : green; height: 0.1em;\"></div>
            <div style=\"color: rgb(220, 220, 220);\">{{pokemon.name_en}} #{{ pokemon.pokedex_id }} - {{pokemon.name_jp}}<br></div>
            {% for type in types %}
                <img style=\"width: 10%;\" src=\"{{type.logo}}\">
            {% endfor %}
        </th>
    </table>
    </div>
    <div style=\"display: flex; justify-content: center; align-items: center; background-color: rgb(80, 80, 80); border-radius: 15px; margin-top: 1.5em; 
    padding-top: 1.2em; padding-bottom: 1.2em; color: rgb(220, 220, 220); font-size: 11px;\">
        <table style=\"width: 50%;\">
        <tr>
            <th style=\"text-align: left;\">CATÉGORIE</th>
            <th>{{pokemon.category}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">GÉNÉRATION</th>
            <th>{{pokemon.gene}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">PV</th>
            <th>{{pokemon.hp}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">ATTAQUE</th>
            <th>{{pokemon.atk}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">DÉFENSE</th>
            <th>{{pokemon.def}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">ATTAQUE SPÉ</th>
            <th>{{pokemon.spe_atk}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">DÉFENSE SPÉ</th>
            <th>{{pokemon.spe_def}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">VITESSE</th>
            <th>{{pokemon.vit}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">TAILLE</th>
            <th>{{pokemon.height}}</th>
        </tr>
        <tr>
            <th style=\"text-align: left;\">POIDS</th>
            <th>{{pokemon.weight}}</th>
        </tr>
        </table>
    </div>
</div>
{% endblock %}
", "pokemon/index.html.twig", "/Users/terrygyselings/Documents/Pokedex/templates/pokemon/index.html.twig");
    }
}
