# Shapecode - Twig Collector Extension

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e3c8e229-09ac-4ec7-94cb-5c6c18dd095f/mini.png)](https://insight.sensiolabs.com/projects/e3c8e229-09ac-4ec7-94cb-5c6c18dd095f)
[![Latest Stable Version](https://poser.pugx.org/shapecode/twig-collector-extension/v/stable)](https://packagist.org/packages/shapecode/twig-collector-extension) 
[![Total Downloads](https://poser.pugx.org/shapecode/twig-collector-extension/downloads)](https://packagist.org/packages/shapecode/twig-collector-extension) 
[![Latest Unstable Version](https://poser.pugx.org/shapecode/twig-collector-extension/v/unstable)](https://packagist.org/packages/shapecode/twig-collector-extension) 
[![License](https://poser.pugx.org/shapecode/twig-collector-extension/license)](https://packagist.org/packages/shapecode/twig-collector-extension)

## Install instructions

Via Composer

``` bash
$ composer require shapecode/twig-collector-extension
```

Add Extension to your Twig Environment

``` php
<?php 

use Twig\Environment;
use Shapecode\Twig\Extensions\Extension\CollectorExtension;

$twig = new Environment($loader);
$twig->addExtension(new CollectorExtension());
```

## Usage

collect stuff over all templates

``` twig
{% collector stylesheets %}
<style>
    .body {
        margin-bottom: 10px;
    }
</style>
{% endcollector %}
```

... and output it at a specific line 

``` twig
{% collection stylesheets %}
```
