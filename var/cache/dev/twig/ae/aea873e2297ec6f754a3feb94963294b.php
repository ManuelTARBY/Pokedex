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

/* shinydex/index.html.twig */
class __TwigTemplate_270b7ab9eca75d62540afae510a10178 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "shinydex/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "shinydex/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "shinydex/index.html.twig", 1);
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

        echo "Hello ShinydexController!";
        
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
        <h1 id=\"h1-shinydex\">Shinydex</h1>
    </div>
    <div>
        ";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["totalCaught"]) || array_key_exists("totalCaught", $context) ? $context["totalCaught"] : (function () { throw new RuntimeError('Variable "totalCaught" does not exist.', 15, $this->source); })()), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 15, $this->source); })()), "html", null, true);
        echo "
    </div>
    <div class=\"div-select\">
        <div>    
            <button>+</button>
            <span>Ajouter un nouveau Shiny</span>
        </div>
        <select name=\"sel-generation\" id=\"select-generation\">
                ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["generations"]) || array_key_exists("generations", $context) ? $context["generations"] : (function () { throw new RuntimeError('Variable "generations" does not exist.', 23, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["generation"]) {
            // line 24
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["generation"], "id", [], "any", false, false, false, 24), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["generation"], "number", [], "any", false, false, false, 24), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['generation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "        </select>
    </div>
    <div id=\"totalByGen\">
    </div>
    <div class=\"div-shinydex\">
        ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pokemons"]) || array_key_exists("pokemons", $context) ? $context["pokemons"] : (function () { throw new RuntimeError('Variable "pokemons" does not exist.', 31, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["pokemon"]) {
            // line 32
            echo "        <div class=\"pokemon\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["pokemon"], "generation", [], "any", false, false, false, 32), "id", [], "any", false, false, false, 32), "html", null, true);
            echo "\">
            <div class=\"pokemon_id\"> # ";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pokemon"], "PokedexId", [], "any", false, false, false, 33), "html", null, true);
            echo " </div>
            ";
            // line 34
            $context["captured"] = twig_get_attribute($this->env, $this->source, ($context["capturedPokemons"] ?? null), twig_get_attribute($this->env, $this->source, $context["pokemon"], "getId", [], "method", false, false, false, 34), [], "array", true, true, false, 34);
            // line 35
            echo "            ";
            if ((isset($context["captured"]) || array_key_exists("captured", $context) ? $context["captured"] : (function () { throw new RuntimeError('Variable "captured" does not exist.', 35, $this->source); })())) {
                // line 36
                echo "            <img src=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pokemon"], "SpriteShiny", [], "any", false, false, false, 36), "html", null, true);
                echo "\">
            ";
            } else {
                // line 38
                echo "            <img class=\"filter\" src=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["pokemon"], "SpriteRegular", [], "any", false, false, false, 38), "html", null, true);
                echo "\">
            ";
            }
            // line 40
            echo "        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pokemon'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "    </div>
</div>
<script>
function changeGeneration () {
    var selectedGeneration = document.getElementById('select-generation').value;
    var pokemons = document.querySelectorAll('.pokemon');
    var totalByGen = document.getElementById('totalByGen');
    var total = '";
        // line 49
        echo (isset($context["totalCaughtByGen"]) || array_key_exists("totalCaughtByGen", $context) ? $context["totalCaughtByGen"] : (function () { throw new RuntimeError('Variable "totalCaughtByGen" does not exist.', 49, $this->source); })());
        echo "';
    total = JSON.parse(total);

    pokemons.forEach(function(pokemon) {
        var generationId = pokemon.getAttribute('value');
        if (selectedGeneration === 'null' || selectedGeneration === generationId) {
            pokemon.style.display = 'block';
        } else {
            pokemon.style.display = 'none';
        }  
        
    });
    if (total[selectedGeneration] == undefined){
        totalByGen.innerHTML = 0;
    }else{
        totalByGen.innerHTML = total[selectedGeneration];
    }
};

document.addEventListener('DOMContentLoaded', changeGeneration);
document.getElementById('select-generation').addEventListener('change', changeGeneration);
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "shinydex/index.html.twig";
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
        return array (  180 => 49,  171 => 42,  164 => 40,  158 => 38,  152 => 36,  149 => 35,  147 => 34,  143 => 33,  138 => 32,  134 => 31,  127 => 26,  116 => 24,  112 => 23,  99 => 15,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Hello ShinydexController!{% endblock %}

{% block body %}
<style>
    .example-wrapper { margin: 1em auto; max-width: 800px; width: 95%; font: 18px/1.5 sans-serif; }
    .example-wrapper code { background: #F5F5F5; padding: 2px 6px; }
</style>
<div class=\"main-container\">
    <div class=\"titre-page\">
        <h1 id=\"h1-shinydex\">Shinydex</h1>
    </div>
    <div>
        {{totalCaught}}/{{total}}
    </div>
    <div class=\"div-select\">
        <div>    
            <button>+</button>
            <span>Ajouter un nouveau Shiny</span>
        </div>
        <select name=\"sel-generation\" id=\"select-generation\">
                {% for generation in generations %}
                    <option value=\"{{generation.id}}\">{{generation.number}}</option>
                {% endfor %}
        </select>
    </div>
    <div id=\"totalByGen\">
    </div>
    <div class=\"div-shinydex\">
        {% for pokemon in pokemons %}
        <div class=\"pokemon\" value=\"{{ pokemon.generation.id }}\">
            <div class=\"pokemon_id\"> # {{ pokemon.PokedexId }} </div>
            {% set captured = capturedPokemons[pokemon.getId()] is defined %}
            {% if captured %}
            <img src=\"{{ pokemon.SpriteShiny }}\">
            {% else %}
            <img class=\"filter\" src=\"{{ pokemon.SpriteRegular }}\">
            {% endif %}
        </div>
        {% endfor %}
    </div>
</div>
<script>
function changeGeneration () {
    var selectedGeneration = document.getElementById('select-generation').value;
    var pokemons = document.querySelectorAll('.pokemon');
    var totalByGen = document.getElementById('totalByGen');
    var total = '{{totalCaughtByGen|raw}}';
    total = JSON.parse(total);

    pokemons.forEach(function(pokemon) {
        var generationId = pokemon.getAttribute('value');
        if (selectedGeneration === 'null' || selectedGeneration === generationId) {
            pokemon.style.display = 'block';
        } else {
            pokemon.style.display = 'none';
        }  
        
    });
    if (total[selectedGeneration] == undefined){
        totalByGen.innerHTML = 0;
    }else{
        totalByGen.innerHTML = total[selectedGeneration];
    }
};

document.addEventListener('DOMContentLoaded', changeGeneration);
document.getElementById('select-generation').addEventListener('change', changeGeneration);
</script>
{% endblock %}
", "shinydex/index.html.twig", "/Users/terrygyselings/Documents/Pokedex/templates/shinydex/index.html.twig");
    }
}
