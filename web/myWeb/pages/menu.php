<?php 
 
 $curPage = basename($_SERVER['PHP_SELF'],".php");

echo "		<ul id=\"assigns\" class=\"side-nav fixed\">
";
?>
		<li class="<?php if ($curPage == "home") echo 'active'?>">
<?php
echo "				<a href=\"$baseDir"."pages/home/home.php\">Home</a></li>
			<li class=\"divider\"></li>
			<li>
    			<ul class=\"collapsible collapsible-accordion\">
    				<li>
    					<a class=\"collapsible-header\">Donations<i class=\"material-icons right\">arrow_drop_down</i></a>
    					<div class=\"collapsible-body\">
    						<ul>
";
?>
								<li class="<?php if ($curPage == "donationItems") echo 'active'?>">
<?php
echo "									<a href=\"$baseDir"."pages/shopping/donationItems.php\">Donations</a>
								</li>
";
?>
								<li class="<?php if ($curPage == "displayCart") echo 'active'?>">
<?php
echo "									<a href=\"$baseDir"."pages/shopping/displayCart.php\">Cart</a>
								</li>
";
?>
								<li class="<?php if ($curPage == "checkout") echo 'active'?>">
<?php
echo "									<a href=\"$baseDir"."pages/shopping/checkout.php\">Check Out</a>
								</li>
";
?>
								<li class="<?php if ($curPage == "conformation") echo 'active'?>">
<?php
echo "									<a href=\"$baseDir"."pages/shopping/conformation.php\">Conformation</a>
								</li>
							</ul>
						</div>
					</li>
					<li class=\"divider\"></li>
				</ul>
  			</li>
";
?>
			<li class="<?php if ($curPage == "index") echo 'active'?>">
<?php
echo "				<a href=\"$baseDir"."pages/recipePlanner/index.php\">Recipe Planner</a>
			</li>
			<li class=\"divider\"></li>

		</ul>
	</header>
";

?>