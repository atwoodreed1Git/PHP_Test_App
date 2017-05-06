<?php

include "/errorCheck.php";

$shoppingCart = array(array(item_id => 0,
									item_size => "Extra Small",
									item_price => 5,
									item_quantity => 0),
							array(item_id => 1,
									item_size => "Small",
									item_price => 10,
									item_quantity => 0),
							array(item_id => 2,
									item_size => "Medium",
									item_price => 15,
									item_quantity => 0),
							array(item_id => 3,
									item_size => "Large",
									item_price => 25,
									item_quantity => 0),
							array(item_id => 4,
									item_size => "Extra Large",
									item_price => 50,
									item_quantity => 0),
							array(item_id => 5,
									item_size => "Jumbo",
									item_price => 100,
									item_quantity => 0)
							);

$numPossibleItems = count($shoppingCart);

include '../head.php';

echo "<body class=\"black\">";

include '../menu.php';

echo "	<main>
		<h1 class=\"white-text\">Donation Amounts</h1>
		
		<form action=\"$baseDir" . "pages/shopping/cart.php\" method=\"post\">
			<div class=\"row\">
";

for ($row = 0; $row < $numPossibleItems; $row++) 
{ 
	if ((($row % 3) == 0) && ($row > 0))
	{
		echo "
				<br />

";
	}

echo "				<div class=\"col s3\">
			      	<div class=\"card small cyan lighten-4\">
						<div class=\"card-content\" id=\"" . $shoppingCart[$row]["item_id"] . "\">
							<span class=\"card-title\">" . $shoppingCart[$row]["item_size"] . " Donation</span>
							<p> $" . $shoppingCart[$row]["item_price"] . " donation to the fund </p>
						</div>
						<div class=\"card-action\">
							<button type=\"button\" class=\"btn-flat\">
							Add to cart </button>
							<button type=\"button\" class=\"btn-flat\">
							Remove for cart</button>
						</div>
					</div>
				</div>
				
				<div class=\"col s0.5\">
				</div>
";
}
		      
echo "				<div class=\"col s1\">
				</div>
		   </div>
			
			<div>
				<div>
					<button type=\"submit\" name=\"cur_cart\" value=\"cur_cart\"> 
					Go to cart 
					</button>
				</div>
			</div>
		</form>
	</main>
</body>
</html>";

?>
