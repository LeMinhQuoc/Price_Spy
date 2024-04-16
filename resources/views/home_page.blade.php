<!DOCTYPE html>
<html>
<head>
  <title>Product Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

<!-- ======= Icons used for dropdown (you can use your own) ======== -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
<style>
  body {
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
    }
    .sidebar {
      background-color: #f8f9fa;
      width: 200px;
      padding: 10px;
      display: flex;
      flex-direction: column;
    }
    .sidebar a {
      color: #333;
      text-decoration: none;
      margin: 10px 0;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .main-container {
      flex: 1;
      padding: 20px;
    }
    .product-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .product-container h1 {
      margin: 0;
    }
    .actions {
      display: flex;
    }
    .actions button {
      
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }
    .actions button:hover {
      background-color: #45a049;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
  .sidebar li .submenu{
	list-style: none;
	margin: 0;
	padding: 0;
	padding-left: 1rem;
	padding-right: 1rem;
}
.psubmenu, th{
	background-color: #696565;
  border: 0.5px solid lightgray;
}
.psubmenu a{
  color:white;
}
.sub_option{
  background-color: white;
}
.sub_option li a{
  color:black;
}
.sub_option li :hover{
  background-color:#f2f2f2;

}
.home_option{
  background-color:#524D4D;
}
.home_option a{
 color:white;
}
a{
  text-decoration:none !important;
}
body, .sidebar  {
  background-color:#D9D9D9;
}
td{
  background-color: lightgray;
}
.header-title{
  display:flex;
  background-color:white;
  height: 50px;
  border-radius: 15px;
  align-items: center;
  padding: 5px;
}
  </style>
</head>
<body>
  <div class="sidebar">
  <nav class="sidebar card py-2 mb-4">
<ul class="nav flex-column" id="nav_accordion">
	<li class="nav-item home_option" >
		<a class="nav-link" href="{{ route('products') }}"> Home </a>
	</li>
	<li class="nav-item has-submenu psubmenu">
		<a class="nav-link" href="#"> Dashboard </a>
		<ul class="submenu collapse product_menu sub_option">
			<li><a class="nav-link" href="{{ route('productsDetail') }}">My Product </a></li>
			<li><a class="nav-link" href="{{ route('addform') }}">Add product </a></li>
			<li><a class="nav-link" href="#">Import </a> </li>
		</ul>
	</li>
	<li class="nav-item has-submenu psubmenu">
		<a class="nav-link" href="#"> Product Data  </a>
		<ul class="submenu collapse sub_option">
      <li><a class="nav-link" href="{{ route('productsDetail') }}">My Product </a></li>
			<li><a class="nav-link" href="{{ route('addform') }}">Add product </a></li>
			<li><a class="nav-link" href="#">Import </a> </li>
		</ul>
	</li>
	<li class="nav-item psubmenu">
		<a class="nav-link" href="#"> Report </a>
	</li>
	<li class="nav-item psubmenu">
		<a class="nav-link" href="#"> Setting </a>
	</li>
</ul>
</nav>
    </div>
  <div class="main-container">
    <div class="product-container">
      <div class= "header-title col-12 col-sm-12 col-md-10 col-lg-10">
        ABBW
      </div>
      <div class="actions">
        <button class="add-product-button btn btn-secondary">Account Infor</button>
      </div>
    </div>
    <?php
    
  
    
    
    if (isset($products)) { ?>

    <table>
      <thead>
        <tr>
          <th>Select</th>
          <th>Product Name</th>
          <th>Min/Max Price</th>
          <th>Last Change</th>
          <th>Frequency Interval</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

      @foreach($products as $product)
        <tr>
          <td><input type="checkbox"></td>
          <td>{{$product->name}}</td>
          <td>$10.00 - $100.00</td>
          <td>2022-01-01</td>
          <td>Weekly</td>
          <td>
            <button class="add-product-button">Edit</button>
          </td>
        </tr>
        @endforeach
        
      
        
        
      </tbody>
    </table>
<?php } elseif(isset($is_add)) {?>
   @include('products/form_add_product')
<?php } elseif(isset($product_detail)) {?>
   @include('products/product')
<?php }else{}?>
  </div>
</body>
<script>
  document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;

        if(nextEl) {
            e.preventDefault();
            let mycollapse = new bootstrap.Collapse(nextEl);

            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                }
            }
        }
    }); 
  }) 
});


</script>
</html>
