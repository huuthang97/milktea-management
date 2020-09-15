<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="wrapper row">
  
  <!--Sidebar-->
  <div id="sidebar" class="col-md-3">
    <div id="header-sidebar">Milk tea store</div>
    <ul id="menu" class="text-center">
      <li>
        <a href="">Store 1</a>
      </li>
      <li>
        <a href="">Store 2</a>
      </li>
      <li>
        <a href="">Store 1</a>
      </li>
      <li>
        <a href="">Store 1</a>
      </li>
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
      <select>
          <option value="name_asc">Name giảm dần</option>
          <option value="name_dsc">Name tăng dần</option>
          <option value="price_asc">Price giảm dần</option>
          <option value="price_dsc">Price tăng dần</option>
      </select>
    </div>
    <div id="topping">
      <div class="title">Toppings:</div>
      <div class="row">
        <div class="col-md-4">
          <input type="checkbox" class="" id="">
          <label class="" for="">Milk Foam</label>
        </div>
        <div class="col-md-4">
          <input type="checkbox" class="" id="">
          <label class="" for="">Milk Foam</label>
        </div>
        <div class="col-md-4">
          <input type="checkbox" class="" id="">
          <label class="" for="">Milk Foam</label>
        </div>
        <div class="col-md-4">
          <input type="checkbox" class="" id="">
          <label class="" for="">Milk Foam</label>
        </div>
      </div>
    </div>
    <div id="main-content" class="row">
      <div class="card col-md-4 border-0 p-0 shadow mb-3 rounded">
        <div class="card-body">
          <div class="code">MT-01</div>
          <div class="title">Royal Milk Tea</div>
          <hr>
          <div class="topping-detail">
            <div class="title">Toppings:</div>
            <p>Milk foam, White pearl</p>
          </div>
          <p class="text-right">$4.8</p>
        </div>
      </div>

      <div class="card col-md-4 border-0 p-0 shadow mb-3 rounded">
        <div class="card-body">
          <div class="code">MT-01</div>
          <div class="title">Royal Milk Tea</div>
          <hr>
          <div class="topping-detail">
            <div class="title">Toppings:</div>
            <p>Milk foam, White pearl</p>
          </div>
          <p class="text-right">$4.8</p>
        </div>
      </div>

      <div class="card col-md-4 border-0 p-0 shadow mb-3 rounded">
        <div class="card-body">
          <div class="code">MT-01</div>
          <div class="title">Royal Milk Tea</div>
          <hr>
          <div class="topping-detail">
            <div class="title">Toppings:</div>
            <p>Milk foam, White pearl</p>
          </div>
          <p class="text-right">$4.8</p>
        </div>
      </div>

      <div class="card col-md-4 border-0 p-0 shadow mb-3 rounded">
        <div class="card-body">
          <div class="code">MT-01</div>
          <div class="title">Royal Milk Tea</div>
          <hr>
          <div class="topping-detail">
            <div class="title">Toppings:</div>
            <p>Milk foam, White pearl</p>
          </div>
          <p class="text-right">$4.8</p>
        </div>
      </div>

    </div>
  </div>
  <!--End Content-->
</div>


</body>
</html>
