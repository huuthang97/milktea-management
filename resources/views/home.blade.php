<!DOCTYPE html>
<html lang="en">
<head>
  <title>Milk Tea</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/1f83f64f55.js"></script>

</head>
<body>

<div class="wrapper row">
  <!--Sidebar-->
  <div id="sidebar" class="col-md-3">
    <div id="header-sidebar">Milk tea store</div>
    <ul id="menu" class="text-center">
        @if ($stores)
        @foreach ($stores as $store)
            <li class="@php if ( $store->id === $firstStore) echo "active" @endphp">
                <a data-store_id = "{{ $store->id }}">{{ $store->name }}</a>
            </li> 
        @endforeach
        @endif
      
    </ul>
  </div>
  <!--End Sidebar-->

  <!--Content-->
  <div id="content" class="col-md-9">
    <div id="header-content">
      Store 1 Menu
    </div>
    <div id="filter-sort" class="d-flex justify-content-between">
      <button type="button" id="" class="btn btn-filter">Filter</button>
      <select name="sort">
          <option value="name_asc">Name Increment</option>
          <option value="name_desc">Name Decrease</option>
          <option value="price_asc">Price Increment</option>
          <option value="price_desc">Price Decrease</option>
      </select>
    </div>
    <div id="topping" >
      <div class="title">Toppings:</div>
      <div class="row">
        @if ($toppingsHandled)
            @foreach ($toppingsHandled as $topping)
              <div class="col-md-4">
                <input type="checkbox" name="toppings[]" value="{{ $topping }}">
                <label class="" for="">{{ $topping }}</label>
              </div>
            @endforeach
        @endif
      </div>
    </div>

    <div class="container">
      <div id="main-content" class="row">
          @if ($products)
          @php $code = 1; @endphp
          @foreach ($products as $product)
              <div class="card col-md-3 border-0 shadow mb-3 mr-5 rounded ">
                  <div class="card-body">
                  <div class="code">MT-{{ sprintf("%02d", $code ++) }}</div>
                  <div class="name-product">{{ $product->name }}</div>
                  <hr style="border: 2px solid;">
                  <div class="topping-detail">
                      <div class="title">Toppings:</div>
                      <p>{{ $product->toppings }}</p>
                  </div>
                  @if ($product->trending === 1)
                    <p class="trending">Trending</p>
                  @endif
                  <p class="price text-right">${{ $product->price }}</p>
                  </div>
              </div>
          @endforeach
          @endif

      </div>
  </div>
  </div>
  <!--End Content-->
</div>

<input type="hidden" id="_url" value="{{ asset('/') }}">

</body>
</html>

<script>
  $(document).ready(function(){
    let url = $("#_url").val();

    $(".btn-filter").click(function() {
      $("#topping").slideToggle();
    });

    $("#topping input[type=checkbox]").change(function(){
        getData();

    });

    $("#menu li").click(function() {
      $("#menu li").removeClass("active");
      $(this).addClass("active");
      getData();
    });

    $("#filter-sort select[name=sort]").change(function() {
      getData();
    });


    function getData() {
        let store_id = $("#menu li.active>a").data("store_id");
        let toppings = [];
        $('#topping :checkbox:checked').each(function(i){
          toppings[i] = $(this).val();
        });

        let sort = $('select[name=sort] option').filter(':selected').val();
        

        $.post(url+"get-product-by-topping",
        {
          "store_id": store_id,
          "toppings": toppings,
          "sort": sort,
          "_token": "{{ csrf_token() }}",
        },
        function(data, status){
          loadding();
          pushData(data);
        });

    }

    function loadding() {
      let loadding = '<div class="col-md-12">';
      loadding += '<p class="text-center">';
      loadding += '<img width="50px" src="{{ asset('images/gif/loadding.gif') }}" alt="loadding">';
      loadding += '</p>';
      loadding += '</div>';
      $("#main-content").html(loadding);
    }

    function pushData(data) {
        if (data.length > 0) {
        var html = "";
        let code = 0;
        for (let i = 0; i < data.length; i++) {
          code = (code++ < 10 ? '0' : '') + code++;
          html += '<div class="card col-md-3 border-0 shadow mb-3 mr-5 rounded ">';
          html += '<div class="card-body">';
          html += '<div class="code">MT-'+ code + ' </div>';
          html += '<div class="name-product">'+ data[i].name +'</div>';
          html += '<hr style="border: 2px solid;">';
          html += '<div class="topping-detail">';
          html += '<div class="title">Toppings:</div>';
          html += '<p>'+data[i].toppings+'</p>';
          html += '</div>';
          if (data[i].trending === 1) {
            html += '<p class="trending">Trending</p>';
          }
          html += '<p class="price text-right">$'+data[i].price+'</p>';
          html += '</div>';
          html += '</div>';
        } 
      }
      else {
        html = '<p class="text-center">No products match!<p>';
      }
      setTimeout(function(){
        $("#main-content").html(html);
      }, 1000);

      
    }

});
</script>