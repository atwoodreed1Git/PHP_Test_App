<?php
 $curP = basename($_SERVER['PHP_SELF'],".php");

echo "
	<header>
		<nav class=\"nav-extender \">
			<div class=\"nav-wrapper blue lighten-1 white-text\">
		  		<div>
		  			<a href=\"../recipePlanner/index.php\" class=\"brand-logo\"> Recipe Planner </a>
		      </div>
		   </div>

		   <div class=\"nav-wrapper black-text blue lighten-1\">
		   	<ul class=\"left\">
";
?>
				<li class="<?php if ($curP == "index") echo 'active'?>">
<?php
echo "					<a href=\"../recipePlanner/index.php\">Today's Recipe</a>
				</li>
";
?>
				<li class="<?php if ($curP == "addRecipe") echo 'active'?>">
<?php
echo "					<a href=\"../recipePlanner/addRecipe.php\">Add Recipe</a>
				</li>
";
?>
				<li class="<?php if ($curP == "Pantry") echo 'active'?>">
<?php
echo "					<a href=\"../recipePlanner/pantry.php\">Pantry</a>
				</li>
			</ul>
			</div>
		</nav>
		<br>
		<br>	
		<br>
";
?>