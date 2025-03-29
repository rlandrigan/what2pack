<?php if(isset($params['id'])) {
	$unit = $params['id']; } 
	else {
		$unit=2;
	}?>
<nav class="py-2 bg-body-tertiary border-bottom d-print-none">
	<div class="container ">
<div class="row">
	<div class="col-md-9">		
	  <ul class="nav me-auto">
		<li class="nav-item"><a href="https://what2pack.org" class="nav-link link-body-emphasis px-2 active" aria-current="page">Home</a></li>
		<li class="nav-item"><a href="/planner/<?php print($unit); ?>" class="nav-link link-body-emphasis px-2">Campouts</a></li>
		<li class="nav-item"><a href="/cookbook" class="nav-link link-body-emphasis px-2">Cookbook</a></li>
		<li class="nav-item"><a href="https://where2camp.com" target="_blank" class="nav-link link-body-emphasis px-2">Locations</a></li>
		<li class="nav-item"><a href="https://what2pack.org/unit/<?php print($unit); ?>" class="nav-link link-body-emphasis px-2">Inventory</a></li>
	  </ul>
	</div>
	<div class="col-md-3 text-center">
	  <image src="/img/what2pack.png" style="max-height: 2.25rem;margin-top: .6rem" >
	 </div>
 </div>
	</div>
  </nav>