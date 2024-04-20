<div class="sidebar">
	<nav class="sidebar card py-2 mb-4">
		<ul class="nav flex-column" id="nav_accordion">
			<li class="nav-item home_option">
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
				<a class="nav-link" href="#"> Product Data </a>
				<ul class="submenu collapse sub_option">
					<li><a class="nav-link" href="{{ route('productsDetail') }}">My Product </a></li>
					<li><a class="nav-link" href="{{ route('addform') }}">Add product </a></li>
					<li><a class="nav-link" href="{{ route('categories') }}">Categories </a></li>
					<li><a class="nav-link" href="{{ route('website') }}">Website </a></li>
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