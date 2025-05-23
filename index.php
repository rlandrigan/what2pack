<?php

class Route {

	private function simpleRoute($file, $route){

		
		//replacing first and last forward slashes
		//$_REQUEST['uri'] will be empty if req uri is /

		if(!empty($_REQUEST['uri'])){
			$route = preg_replace("/(^\/)|(\/$)/","",$route);
			$reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
		}else{
			$reqUri = "/";
		}

		if($reqUri == $route){
			$params = [];
			include($file);
			exit();

		}

	}

	function add($route,$file){

		//will store all the parameters value in this array
		$params = [];

		//will store all the parameters names in this array
		$paramKey = [];

		//finding if there is any {?} parameter in $route
		preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

		//if the route does not contain any param call simpleRoute();
		if(empty($paramMatches[0])){
			$this->simpleRoute($file,$route);
			return;
		}

		//setting parameters names
		foreach($paramMatches[0] as $key){
			$paramKey[] = $key;
		}

	   
		//replacing first and last forward slashes
		//$_REQUEST['uri'] will be empty if req uri is /

		if(!empty($_REQUEST['uri'])){
			$route = preg_replace("/(^\/)|(\/$)/","",$route);
			$reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
		}else{
			$reqUri = "/";
		}

		//exploding route address
		$uri = explode("/", $route);

		//will store index number where {?} parameter is required in the $route 
		$indexNum = []; 

		//storing index number, where {?} parameter is required with the help of regex
		foreach($uri as $index => $param){
			if(preg_match("/{.*}/", $param)){
				$indexNum[] = $index;
			}
		}

		//exploding request uri string to array to get
		//the exact index number value of parameter from $_REQUEST['uri']
		$reqUri = explode("/", $reqUri);

		//running for each loop to set the exact index number with reg expression
		//this will help in matching route
		foreach($indexNum as $key => $index){

			 //in case if req uri with param index is empty then return
			//because url is not valid for this route
			if(empty($reqUri[$index])){
				return;
			}

			//setting params with params names
			$params[$paramKey[$key]] = $reqUri[$index];

			//this is to create a regex for comparing route address
			$reqUri[$index] = "{.*}";
		}

		//converting array to sting
		$reqUri = implode("/",$reqUri);

		//replace all / with \/ for reg expression
		//regex to match route is ready !
		$reqUri = str_replace("/", '\\/', $reqUri);

		//now matching route with regex
		if(preg_match("/$reqUri/", $route))
		{
			include($file);
			exit();

		}
	}

	function notFound($file){
		include($file);
		exit();
	}
}

$route = new Route();
$route->add('item/{id}', 'item.php');
$route->add('budget/{id}', 'budget.php');
$route->add('planner/{id}', 'planner/index.php');
$route->add('planner/{id}/add', 'planner/addcampout.php');
$route->add('planner/{id}/edit', 'planner/addcampout.php');
$route->add('planner/{id}/edit/{camp}', 'planner/editcampout.php');
$route->add('planner/{id}/menu/{menu}', 'planner/editmenu.php');
$route->add('planner/{id}/roster/{menu}', 'planner/addroster.php');
$route->add('planner/{id}/activity/{event}', 'planner/addactivity.php');
$route->add('planner/{id}/activity', 'planner/addactivity.php');
$route->add('planner/{id}/print/{event}', 'planner/printCampout.php');
$route->add('edit/{id}', 'editItem.php');
$route->add('/', 'allunits.php');
$route->add('unit/{id}', 'unit.php');
$route->add('itemsubmit', 'admin/server.php');
$route->add('savepatrol', 'admin/savePatrol.php');
$route->add('saveroster', 'admin/saveRoster.php');
$route->add('savecampout', 'admin/saveEvent.php');
$route->add('checkinout', 'admin/checkinout.php');
$route->add('cookbook', 'cookbook/index.php');
$route->add('packinglist/{id}/{event}', 'packingList.php');
$route->notFound('404.php');
?>