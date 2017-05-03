<?php 
 
 $curPage = basename($_SERVER['PHP_SELF'],".php");

echo "<body>
	<header>
		<nav class=\"top-nav\">
			<div class=\"nav-wrapper blue lighten-1\">
		  		<div>
		      	<a href=\"#\" class=\"brand-logo\"> Landon's Laptop Fund</a>
		      </div>
		   </div>
		</nav>

		<ul id=\"assigns\" class=\"side-nav fixed\">
	";
?>
		<li class="<?php if ($curPage == "home") echo 'active'?>">
<?php
echo "				<a href=\"$baseDir"."pages/home.php\">Home</a></li>
			<li class=\"divider\"></li>
			<li>
    			<ul class=\"collapsible collapsible-accordion\">
    				<li>
    					<a class=\"collapsible-header\">Assignments<i class=\"material-icons\"></i></a>
    					<div class=\"collapsible-body\">
    						<ul>
";
?>
								<li class="<?php if ($curPage == "assignments") echo 'active'?>">
<?php
echo "									<a href=\"$baseDir"."pages/shopping/donationItems.php\">Donations</a>
								</li>
								<li class=\"divider\"></li>
							</ul>
						</div>
					</li>
				</ul>
  			</li>
		</ul>
	</header>
";

?>