# twig-pjaxr

## How to install twig-pjaxr?

There are just two steps needed to install twig-pjaxr:

1. Add twig-pjaxr to your composer.json:

	```json
	{
        "require": {
            "iekadou/twig_pjaxr": ">=0.1.2",
        }
    }
	```

2. Add pjaxr_extends TokenParser to the template:

    ```php
    $template->addTokenParser(new Twig_Pjaxr_TokenParser_PjaxrExtends());
	```

## How do i use twig-pjaxr?

Instead of using the `{% extends %}` tag use `{% pjaxr_extends %}`.

```twig
{% pjaxr_extends "__base.html" "__pjaxr.html" 'Pjaxr' %}
{% block page %}
...
{% endblock page %}

or

{% pjaxr_extends "__base.html" 'Pjaxr' %}
{% block page %}
...
{% endblock page %}
```
- The first argument is the template, which is extended if the request is not a PJAXR request, or the namespace does not match.
- The second argument is the template, which is extended if the namespace matches. (optional, default is "__pjaxr.html")
- The thrid argument is the namespace which should be tested against, to decide which template should be extended.

## What do you need for twig-pjaxr?

1. [PHP](http://php.net) >= 5.3.29
2. [twig](https://github.com/twigphp/Twig)
3. [php-pjaxr](https://github.com/iekadou/php-pjaxr)
4. [jquery-pjaxr](https://github.com/minddust/jquery-pjaxr)

## Projects using twig-pjaxr

1. [pjaxr.io](https://github.com/iekadou/pjaxr-io)

If you are using twig-pjaxr, please contact me, and tell me in which projects you are using it. Thank you!

Happy speeding up your twig project!

For further information read [twig-pjaxr on iekadou.com](http://www.iekadou.com/programming/twig-pjaxr)
