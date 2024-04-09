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

/* pokedex/index.html.twig */
class __TwigTemplate_bc174516e40da527070f5385501c1924 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pokedex/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pokedex/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "pokedex/index.html.twig", 1);
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

        echo "Pokedex";
        
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

<div class=\"main-container\">
    <div class=\"titre-page\">
        <h1 id=\"h1-pokedex\">Pokedex</h1>
    </div>
    <div class=\"search-by-name\">
        <input type=\"text\" name=\"searchname\" id=\"search-by-name\" placeholder=\"Recherche par nom\" oninput=\"getPokedexByName(";
        // line 16
        echo twig_escape_filter($this->env, json_encode((isset($context["pokemons"]) || array_key_exists("pokemons", $context) ? $context["pokemons"] : (function () { throw new RuntimeError('Variable "pokemons" does not exist.', 16, $this->source); })())), "html", null, true);
        echo ")\">
    </div>
    <div class=\"div-select\">
        <select name=\"sel-type\" id=\"select-type\" onchange=\"getPokedexByType(";
        // line 19
        echo twig_escape_filter($this->env, json_encode((isset($context["pokemons"]) || array_key_exists("pokemons", $context) ? $context["pokemons"] : (function () { throw new RuntimeError('Variable "pokemons" does not exist.', 19, $this->source); })())), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode((isset($context["poketypes"]) || array_key_exists("poketypes", $context) ? $context["poketypes"] : (function () { throw new RuntimeError('Variable "poketypes" does not exist.', 19, $this->source); })())), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 19, $this->source); })())), "html", null, true);
        echo ")\">
                <option value=\"null\">Recherche par Type</option>
            ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 21, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 22
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["type"], "name", [], "any", false, false, false, 22), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["type"], "name", [], "any", false, false, false, 22), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "        </select>
        <select name=\"sel-generation\" id=\"select-generation\" onchange='getPokedexByGeneration(";
        // line 25
        echo twig_escape_filter($this->env, json_encode((isset($context["pokemons"]) || array_key_exists("pokemons", $context) ? $context["pokemons"] : (function () { throw new RuntimeError('Variable "pokemons" does not exist.', 25, $this->source); })())), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode((isset($context["generations"]) || array_key_exists("generations", $context) ? $context["generations"] : (function () { throw new RuntimeError('Variable "generations" does not exist.', 25, $this->source); })())), "html", null, true);
        echo ")'>
                <option value=\"null\">Recherche par Génération</option>
            ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["generations"]) || array_key_exists("generations", $context) ? $context["generations"] : (function () { throw new RuntimeError('Variable "generations" does not exist.', 27, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["generation"]) {
            // line 28
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["generation"], "number", [], "any", false, false, false, 28), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["generation"], "number", [], "any", false, false, false, 28), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['generation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "        </select>
    </div>
    <div class=\"div-table-pokedex\" id=\"tab-poke\">
        <table class=\"table-pokedex\">
            <tr class=\"first-lign-pokedex\">
                <th>Numéro</th>
                <th>Nom</th>
                <th>Types</th>
            </tr>
            ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pokemons"]) || array_key_exists("pokemons", $context) ? $context["pokemons"] : (function () { throw new RuntimeError('Variable "pokemons" does not exist.', 39, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["ligne"]) {
            // line 40
            echo "            <tr class=\"lign-pokedex\" id=\"datas-pokemon\">
                <th>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ligne"], "pokedex_id", [], "any", false, false, false, 41), "html", null, true);
            echo "</th>
                <th><a href=\"/pokemon/";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ligne"], "pokedex_id", [], "any", false, false, false, 42), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ligne"], "name_fr", [], "any", false, false, false, 42), "html", null, true);
            echo "</a></th>
                <th class=\"th-logo\">
                ";
            // line 44
            $context["leslogos"] = twig_split_filter($this->env, twig_get_attribute($this->env, $this->source, $context["ligne"], "logos", [], "any", false, false, false, 44), ",");
            // line 45
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["leslogos"]) || array_key_exists("leslogos", $context) ? $context["leslogos"] : (function () { throw new RuntimeError('Variable "leslogos" does not exist.', 45, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["logo"]) {
                // line 46
                echo "                    <img class=\"img-type\" src=\"";
                echo twig_escape_filter($this->env, $context["logo"], "html", null, true);
                echo "\">
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['logo'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "                </th>  
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ligne'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "        </table>
    </div>
</div>
<script src=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/script.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pokedex/index.html.twig";
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
        return array (  213 => 54,  208 => 51,  200 => 48,  191 => 46,  186 => 45,  184 => 44,  177 => 42,  173 => 41,  170 => 40,  166 => 39,  155 => 30,  144 => 28,  140 => 27,  133 => 25,  130 => 24,  119 => 22,  115 => 21,  106 => 19,  100 => 16,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Pokedex{% endblock %}

{% block body %}
<style>
    .example-wrapper { margin: 1em auto; max-width: 800px; width: 95%; font: 18px/1.5 sans-serif; }
    .example-wrapper code { background: #F5F5F5; padding: 2px 6px; }
</style>

<div class=\"main-container\">
    <div class=\"titre-page\">
        <h1 id=\"h1-pokedex\">Pokedex</h1>
    </div>
    <div class=\"search-by-name\">
        <input type=\"text\" name=\"searchname\" id=\"search-by-name\" placeholder=\"Recherche par nom\" oninput=\"getPokedexByName({{ pokemons|json_encode }})\">
    </div>
    <div class=\"div-select\">
        <select name=\"sel-type\" id=\"select-type\" onchange=\"getPokedexByType({{ pokemons|json_encode }}, {{ poketypes|json_encode }}, {{ types|json_encode }})\">
                <option value=\"null\">Recherche par Type</option>
            {% for type in types %}
                <option value=\"{{type.name}}\">{{type.name}}</option>
            {% endfor %}
        </select>
        <select name=\"sel-generation\" id=\"select-generation\" onchange='getPokedexByGeneration({{ pokemons|json_encode }}, {{ generations|json_encode }})'>
                <option value=\"null\">Recherche par Génération</option>
            {% for generation in generations %}
                <option value=\"{{generation.number}}\">{{generation.number}}</option>
            {% endfor %}
        </select>
    </div>
    <div class=\"div-table-pokedex\" id=\"tab-poke\">
        <table class=\"table-pokedex\">
            <tr class=\"first-lign-pokedex\">
                <th>Numéro</th>
                <th>Nom</th>
                <th>Types</th>
            </tr>
            {% for ligne in pokemons %}
            <tr class=\"lign-pokedex\" id=\"datas-pokemon\">
                <th>{{ ligne.pokedex_id }}</th>
                <th><a href=\"/pokemon/{{ ligne.pokedex_id }}\">{{ ligne.name_fr }}</a></th>
                <th class=\"th-logo\">
                {% set leslogos = ligne.logos | split(',') %}
                {% for logo in leslogos %}
                    <img class=\"img-type\" src=\"{{ logo }}\">
                {% endfor %}
                </th>  
            </tr>
            {% endfor %}
        </table>
    </div>
</div>
<script src=\"{{ asset('js/script.js') }}\"></script>
{% endblock %}
", "pokedex/index.html.twig", "/Users/terrygyselings/Documents/Pokedex/templates/pokedex/index.html.twig");
    }
}
