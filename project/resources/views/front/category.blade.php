@extends('layouts.front')
@section('content')
<style type="text/css">
    #loading-img {
    background: url("https://boomopti.com/assets/images/1638444758Rolling-1s-57px(1).gif") center center no-repeat;
    display: none;
    height: 100px;
    width: 100px;
    position: fixed;
    top: 33%;
    left: 1%;
    right: 1%;
    margin: auto;

}




#cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}



</style>
<div id="cover-spin"></div>


    <?php
        $max = DB::table('products')->max('price');
    ?>
    <input type="hidden" id="max_price_product" name="max_price_product" value="{{$max}}" />

  <div id="loading-img"></div>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="pages">
               <li>
                  <a href="{{route('front.indexx')}}">{{ $langg->lang17 }}</a>
               </li>
               @if (!empty($cat))
               <li>
                  <a href="{{route('front.category', $cat->slug)}}">{{ $cat->name }}</a>
               </li>
               @endif
               @if (!empty($subcat))
               <li>
                  <a href="{{route('front.category', [$cat->slug, $subcat->slug])}}">{{ $subcat->name }}</a>
               </li>
               @endif
               @if (!empty($childcat))
               <li>
                  <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])}}">{{ $childcat->name }}</a>
               </li>
               @endif
               @if (empty($childcat) && empty($subcat) && empty($cat))
               <li>
                  <a href="{{route('front.category')}}">{{ $langg->lang36 }}</a>
               </li>
               @endif

            </ul>
         </div>
      </div>
   </div>
</div>
    <!--Breadcrumb-->
    <!-- <div class="productbanner text-center">
            <div class="container ">
                <h3>Products</h3>
                <div class="lower-text">
                 <span><a href="{{route('front.index')}}">{{ $langg->lang17 }}</a></span> <span>/</span>
                 @if (!empty($cat))
               <span>
                  <a href="{{route('front.category', $cat->slug)}}">{{ $cat->name }}</a>
               </span>
               @endif
               @if (empty($childcat) && empty($subcat) && empty($cat))
               <span>
                  <a href="{{route('front.category')}}">{{ $langg->lang36 }}</a>
              </span>
               @endif
               </div>
            </div>
        </div> -->

    <!--Breadcrumb end-->
<!-- Breadcrumb Area End -->
<!-- SubCategori Area Start -->
<section class="sub-categori">
   <div class="container">
      <div class="row">
         @include('includes.catalog')
         <div class="col-lg-9 order-first order-lg-last ajax-loader-parent">
            <div class="right-area" id="app">

               @include('includes.filter')
               <div class="categori-item-area">
                 <div class="row fil_products" id="ajaxContent">
                   @include('includes.product.filtered-products')
                 </div>
                 <div id="ajaxLoader" class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
               </div>

            </div>
         </div>
      </div>
   </div>
</section>
<!-- SubCategori Area End -->
@endsection


@section('scripts')

<script>



                function select_all(a)
                {
                  $('#search_by').val(a);
                  $('#prod_namee').attr('placeholder','Search by '+a);
                }

                $('#prod_namee').keyup(function(){

                    $('#cover-spin').show(0);
                    $('#loading-img').show();



                     $.ajax(
                      '<?php echo url('search_by?search_by=') ?>'+$('#search_by').val()+'&key='+$(this).val(),
                      {
                          success: function(data)
                           {
                            $('#cover-spin').hide(0);
                            $('#loading-img').hide();
                               if($('#search_by').val() == 'Category')
                               {
                                var obj = jQuery.parseJSON(data);
                                console.log(obj.html);
                                $('.categoriess').html(obj.html)
                               }else{
                                var obj = jQuery.parseJSON(data);
                                console.log(obj.html);
                                $('.fil_products').html(obj.html)
                               }

                          }

                       }
                );

     });













  $(document).ready(function() {

    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
            scrollTop: 0
          }, 1);

          addToPagination();
        }
      });
    }
  });

</script>

<script type="text/javascript">

  $(function () {

    $("#slider-range").slider({
      range: true,
      orientation: "horizontal",
      min: 0,
      max: $('#max_price_product').val(),
      values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000' }}],
      step: 5,

      slide: function (event, ui) {
        if (ui.values[0] == ui.values[1]) {
          return false;
        }


        $("#min_price").val(ui.values[0]);
        $("#max_price").val(ui.values[1]);
      }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });

</script>



@endsection
