{%- assign per_row = section.settings.per_row -%}
{% assign paginate_by = per_row | times: 5 %}
{% if section.settings.collection_tags_style == 'inline' and collection.all_tags.size > 0 %}
  {% assign paginate_by = paginate_by | minus: 1 %}
{% elsif section.settings.collection_subnav_style == 'inline' %}
  {% assign paginate_by = paginate_by | minus: 1 %}
{% endif %}

{% paginate collection.products by paginate_by %}

<div id="CollectionSection" data-section-id="{{ section.id }}" data-section-type="collection-template">
  {% if section.settings.collection_image_enable and collection.image %}
    <div class="collection-hero loading--delayed">
      <div
        class="collection-hero__image lazyload"
        data-bgset="{% include 'bgset', image: collection.image %}"
        data-sizes="auto">
      </div>
      <noscript>
        <div
          class="collection-hero__image"
          style="background-image: url({{ collection.image | img_url: '1400x' }});";
          ></div>
      </noscript>

      <div class="collection-hero__content">
        <div class="page-width">
          <header class="section-header section-header--hero">
            <h1 class="section-header__title section-header__title--medium">
              <div class="animation-cropper">
                <div class="animation-contents">
                  {{ collection.title }}
                </div>
              </div>
            </h1>
          </header>
        </div>
      </div>

    </div>
  {% endif %}

  <div class="page-width page-content">
    
<!--     <div> 
       <img src="{{section.settings.image_slider | img_url: 'master'}}"/>
    </div> -->
    {% include 'breadcrumbs' %}
    

    {% unless section.settings.collection_image_enable and collection.image %}
      <header class="section-header">
<!--         <h1 class="section-header__title">
          {{ collection.title }}
        </h1> -->
      </header>
    {% endunless %}

    {% if section.settings.collection_tags_style == 'dropdown' or section.settings.collection_sort_enable %}
      <div class="collection-filter">
        <h1>Sajjad</h1>
        <div class="grid grid--uniform">

         {% if section.settings.collection_tags_style == 'dropdown' %}
          <div class="grid__item small--one-half medium-up--one-quarter">
            <label for="SortTags" class="hidden-label">{{ 'collections.filters.title_tags' | t }}</label>
            <select name="SortTags" id="SortTags">
              {% if current_tags %}
                {% if collection.handle %}
                  <option value="/collections/{{ collection.handle }}">{{ 'collections.filters.all_tags' | t }}</option>
                {% elsif collection.current_type %}
                  <option value="{{ collection.current_type | url_for_type }}">{{ 'collections.filters.all_tags' | t }}</option>
                {% elsif collection.current_vendor %}
                  <option value="{{ collection.current_vendor | url_for_vendor }}">{{ 'collections.filters.all_tags' | t }}</option>
                {% endif %}
              {% else %}
                {% if current_tags contains tag %}
                  <option value="">{{ 'collections.filters.all_tags' | t }}</option>
                {% else %}
                  <option value="">{{ 'collections.filters.title_tags' | t }}</option>
                {% endif %}
              {% endif %}
              {% for tag in collection.all_tags %}
                {% include 'filter-out-custom-tags' %}
                <option value="/collections/{% if collection.handle != blank %}{{ collection.handle }}{% else %}all{% endif %}/{{ tag | handleize }}"{% if current_tags contains tag %} selected="selected"{% endif %}>{{ tag }}</option>
              {% endfor %}
            </select>
          </div>
        {% endif %}
          

        {% if section.settings.collection_sort_enable %}
          <div class="grid__item small--one-half medium-up--one-quarter float-right">
            {%- assign sort_by = collection.sort_by | default: collection.default_sort_by -%}
            <label for="SortBy" class="hidden-label">{{ 'collections.sorting.title' | t }}</label>
            <select name="SortBy" id="SortBy">
              {% if sort_by == collection.default_sort_by %}
                <option value="title-ascending" selected="selected">{{ 'collections.sorting.title' | t }}</option>
                {% if collection.default_sort_by != 'manual' %}
                  <option value="manual"{% if sort_by == "manual" %} selected="selected"{% endif %}>{{ 'collections.sorting.featured' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'best-selling' %}
                  <option value="best-selling"{% if sort_by == "best-selling" %} selected="selected"{% endif %}>{{ 'collections.sorting.best_selling' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'title-ascending' %}
                  <option value="title-ascending"{% if sort_by == "title-ascending"  %}selected="selected"{% endif %}>{{ 'collections.sorting.az' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'title-descending' %}
                  <option value="title-descending"{% if sort_by == "title-descending" %} selected="selected"{% endif %}>{{ 'collections.sorting.za' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'price-ascending' %}
                  <option value="price-ascending"{% if sort_by == "price-ascending" %} selected="selected"{% endif %}>{{ 'collections.sorting.price_ascending' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'price-descending' %}
                  <option value="price-descending"{% if sort_by == "price-descending" %} selected="selected"{% endif %}>{{ 'collections.sorting.price_descending' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'created-descending' %}
                  <option value="created-descending"{% if sort_by == "created-descending" %} selected="selected"{% endif %}>{{ 'collections.sorting.date_descending' | t }}</option>
                {% endif %}
                {% if collection.default_sort_by != 'created-ascending' %}
                  <option value="created-ascending"{% if sort_by == "created-ascending" %} selected="selected"{% endif %}>{{ 'collections.sorting.date_ascending' | t }}</option>
                {% endif %}
              {% else %}
                <option value="manual"{% if sort_by == "manual" %} selected="selected"{% endif %}>{{ 'collections.sorting.featured' | t }}</option>
                <option value="best-selling"{% if sort_by == "best-selling" %} selected="selected"{% endif %}>{{ 'collections.sorting.best_selling' | t }}</option>
                <option value="title-ascending"{% if sort_by == "title-ascending"  %}selected="selected"{% endif %}>{{ 'collections.sorting.az' | t }}</option>
                <option value="title-descending"{% if sort_by == "title-descending" %} selected="selected"{% endif %}>{{ 'collections.sorting.za' | t }}</option>
                <option value="price-ascending"{% if sort_by == "price-ascending" %} selected="selected"{% endif %}>{{ 'collections.sorting.price_ascending' | t }}</option>
                <option value="price-descending"{% if sort_by == "price-descending" %} selected="selected"{% endif %}>{{ 'collections.sorting.price_descending' | t }}</option>
                <option value="created-descending"{% if sort_by == "created-descending" %} selected="selected"{% endif %}>{{ 'collections.sorting.date_descending' | t }}</option>
                <option value="created-ascending"{% if sort_by == "created-ascending" %} selected="selected"{% endif %}>{{ 'collections.sorting.date_ascending' | t }}</option>
              {% endif %}
            </select>
            <input class="collection-header__default-sort" type="hidden" value="{{ collection.default_sort_by }}">
          </div>
        {% endif %}

        </div>
      </div>
    {% endif %}

    {% if collection.description != blank %}
      <div class="rte">
        {{ collection.description }}
      </div>
      <hr class="hr--clear hr--small">
    {% endif %}

    <div id="CollectionAjaxResult">
      <div id="CollectionAjaxContent">
       
        <div class="grid grid--uniform">
          {% assign grid_item_width = 'small--one-half medium-up--one-third' %}

          {% case per_row %}
          {% when 1 %}
            {%- assign grid_item_width = '' -%}
          {% when 2 %}
            {%- assign grid_item_width = 'medium-up--one-half' -%}
          {% when 3 %}
            {%- assign grid_item_width = 'small--one-half medium-up--one-third' -%}
          {% when 4 %}
            {%- assign grid_item_width = 'small--one-half medium-up--one-quarter' -%}
          {% when 5 %}
            {%- assign grid_item_width = 'small--one-half medium-up--one-fifth' -%}
          {% endcase %}

          {%- assign have_sidebar = false -%}
          {%- assign tag_count = 0 -%}
          {%- assign tag_limit = 7 -%}
          {%- assign have_extra_tags = false -%}
          {% if section.settings.collection_tags_style == 'inline' %}
            {% if collection.all_tags.size > 0 %}
              <div class="grid__item {{ grid_item_width }}">
                <ul class="tags tags--vertical">
                  <li{% unless current_tags %} class="tag--active"{% endunless %}>
                    {% if collection.handle %}
                      <a href="/collections/{{ collection.handle }}">
                        {{ 'collections.general.all_of_collection' | t }}
                      </a>
                    {% elsif collection.current_type %}
                      <a href="{{ collection.current_type | url_for_type }}">
                        {{ 'collections.general.all_of_collection' | t }}
                      </a>
                    {% elsif collection.current_vendor %}
                      <a href="{{ collection.current_vendor | url_for_vendor }}">
                        {{ 'collections.general.all_of_collection' | t }}
                      </a>
                    {% endif %}
                  </li>

                  {% for tag in collection.all_tags %}
                    {%- assign tag_count = tag_count | plus: 1 -%}
                    {% include 'filter-out-custom-tags' %}
                    {%- assign tag_with_hyphens = tag | replace: ' ', '-' -%}
                    {% if tag_count == tag_limit %}
                      {%- assign have_extra_tags = true -%}
                      </ul>
                      <div id="TagList-{{ section.id }}" class="collapsible-content collapsible-content--all">
                        <ul class="tags tags--vertical collapsible-content__inner collapsible-content__inner--no-translate">
                    {% endif %}
                    {% if current_tags contains tag or current_tags contains tag_with_hyphens %}
                      <li class="tag--active">
                        {{ tag | link_to_remove_tag: tag | replace: 'title=', 'class="js-no-transition" title=' }}
                      </li>
                    {% else %}
                      <li>
                        {{ tag | link_to_tag: tag | replace: 'title=', 'class="js-no-transition" title=' }}
                      </li>
                    {% endif %}
                  {% endfor %}

                  {% if have_extra_tags %}
                    </div>
                  {% endif %}
                </ul>

                {%- assign show_button_limit = tag_limit | minus: 1  -%}
                {% if tag_count > show_button_limit %}
                  <p>
                    <button type="button" class="collapsible-trigger collapsible--auto-height collapsible-trigger-btn btn btn--tertiary tags-toggle" aria-controls="TagList-{{ section.id }}">
                      <span class="collapsible-label__closed">{{ 'collections.general.see_more' | t }}</span>
                      <span class="collapsible-label__open">{{ 'collections.general.see_less' | t }}</span>
                    </button>
                  </p>
                {% endif %}
              </div>
            {% endif %}
          {% elsif section.settings.collection_subnav_style == 'inline' %}
            {% if linklists.main-menu.levels > 0 %}
              {% for link in linklists.main-menu.links %}
                {% if link.active %}
                  {% if link.links.size > 0 %}
                    {%- assign have_sidebar = true -%}
                  {% endif %}
                {% elsif link.child_active %}
                  {%- assign have_sidebar = true -%}
                {% endif %}
              {% endfor %}
            {% endif %}

            {% if have_sidebar %}
              <div class="grid__item {{ grid_item_width }} grid__item--{{ section.id }}">
                <ul class="tags tags--vertical">
                  {% if linklists.main-menu.levels > 0 %}
                    {% for link in linklists.main-menu.links %}
                      {% if link.active %}
                        {% include 'subcollection-list', links: link.links %}
                      {% elsif link.child_active %}
                        {% for sub_link in link.links %}
                          {% if sub_link.active or sub_link.child_active %}
                            {% if sub_link.levels > 0 %}
                              {% include 'subcollection-list', links: sub_link.links %}
                            {% else %}
                              {% include 'subcollection-list', links: link.links %}
                            {% endif %}
                          {% endif %}
                        {% endfor %}
                      {% endif %}
                    {% endfor %}

                    {% if have_extra_tags %}
                      </div>
                    {% endif %}
                  {% endif %}
                </ul>

                {%- assign show_button_limit = tag_limit | minus: 1  -%}
                {% if tag_count > show_button_limit %}
                  <p>
                    <button type="button" class="collapsible-trigger collapsible--auto-height collapsible-trigger-btn btn btn--tertiary tags-toggle" aria-controls="TagList-{{ section.id }}">
                      <span class="collapsible-label__closed">{{ 'collections.general.see_more' | t }}</span>
                      <span class="collapsible-label__open">{{ 'collections.general.see_less' | t }}</span>
                    </button>
                  </p>
                {% endif %}
              </div>
            {% endif %}
          {% endif %}

          {% for product in collection.products %}
            {% include 'product-grid-item' %}
          {% else %}
            <div class="grid__item">
              <p>{{ 'collections.general.no_matches' | t }}</p>
            </div>
          {% endfor %}
        </div>

        {% if paginate.pages > 1 %}
          {% include 'pagination' %}
        {% endif %}

        {% if settings.quick_shop_enable %}
          {% for product in collection.products %}
            {% if product.available %}
              {% include 'quick-shop-modal' %}
            {% endif %}
          {% endfor %}
        {% endif %}
      </div>
    </div>
  </div>
</div>

{% endpaginate %}



{% schema %}
  {
    "name": "Collection pages",
    "settings": [
      {
        "type": "range",
        "id": "per_row",
        "label": "Products per row",
        "default": 4,
        "min": 1,
        "max": 5,
        "step": 1
      },
				{ 
                 "type":"image_picker",
                 "label":"your image",
                 "id":"image_slider"
          			 },
      {
        "type": "checkbox",
        "id": "collection_image_enable",
        "label": "Show collection image",
        "default": true
      },
      {
        "type": "select",
        "id": "collection_subnav_style",
        "label": "Subnavigation style",
        "default": "inline",
        "options": [
          {
            "value": "none",
            "label": "None"
          },
          {
            "value": "inline",
            "label": "Inline"
          }
        ]
      },
      {
        "type": "select",
        "id": "collection_tags_style",
        "label": "Tag filter style",
        "default": "none",
        "options": [
          {
            "value": "none",
            "label": "None"
          },
          {
            "value": "inline",
            "label": "Inline"
          },
          {
            "value": "dropdown",
            "label": "Dropdown"
          }
        ],
        "info": "Only one option can use Inline style at a time"
      },
      {
        "type": "checkbox",
        "id": "collection_sort_enable",
        "label": "Show sort options",
        "default": true
      }
    ]
  }
{% endschema %}
