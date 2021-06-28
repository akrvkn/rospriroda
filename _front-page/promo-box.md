---
title: Promo-box
front-page: promo-box
---


{% for cat in site.categories %}
{% if cat[0] == 'news' %}

{% for post in cat[1] limit: 1 %}
### Росприроднадзор информирует

{{ post.excerpt }}

[Подробнее]({{ post.url }})

{% endfor %}

{% endif %}
{% endfor %}
