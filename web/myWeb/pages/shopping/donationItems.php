<?php
session_start();

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

// store array in sesion
if (!isset($_SESSION['shopCart']))
{
	$_SESSION['shopCart'] = $shoppingCart;
}

include_once '../head.php';

echo "<body class=\"black\">";

include '../menu.php';

echo "	<main class=\"container\">
		<h1 class=\"white-text\">Donation Amounts</h1>
		
		<div class=\"row\">
";

// display cards for each item avalible
for ($row = 0; $row < $numPossibleItems; $row++) 
{ 
	$i_id = $shoppingCart[$row]["item_id"];
	$i_size = $shoppingCart[$row]["item_size"];
	$i_price = $shoppingCart[$row]["item_price"];

	if ((($row % 3) == 0) && ($row > 0))
	{
		echo "
				<br />

";
	}

echo "			
			<div class=\"col s3\">
		     	<div class=\"card small cyan lighten-4\">
					<div class=\"card-content\">
						<span class=\"card-title\">" . $i_size . " Donation</span>
						<p> $" . $i_price . " donation to the fund </p>
					</div>
					
					<div class=\"center\" id=\"result" . $i_id . "\">
					</div>
					<div class=\"card-action\">
						<form action=\"$baseDir" . "pages/shopping/cart.php\" method=\"post\">
							<input type=\"hidden\" name=\"productID\" id=\"productID" . $i_id . "\" value=\"" . $i_id . "\"/>
							</input>
							<input type=\"button\" class=\"btn-flat\" onclick=\"addToCart" . $i_id . "();\"
							id=\"add" . $i_id . "\"name=\"cur_cart\" value=\"Add to cart \">
							</input>
						</form>
					</div>
				</div>
			</div>
				
			<div class=\"col s0.5\">
			</div>
";
}
		      
echo "			<div class=\"col s1\">
			</div>
		</div>
		
		<div>
			<div>
				<form action=\"$baseDir" . "pages/shopping/displayCart.php\" method=\"post\"> 
					<input type=\"submit\" name=\"sub_cart\" value=\"Go to cart\"> 
					</input>
				</form>
			</div>
		</div>
		
	</main>
"; 
?>
	
	<script type="text/javascript">
		function addToCart0() {
			
		var pid = $('#productID0').val();

			 $.post('/cs313-php/web/myWeb/pages/shopping/cart.php', {postid:pid}, 
			 	function(data) {
			 		$('#result0').html(data);
			 	});
		}
	</script>
	<script type="text/javascript">
		function addToCart1() {
			
		var pid = $('#productID1').val();

			 $.post('/cs313-php/web/myWeb/pages/shopping/cart.php', {postid:pid}, 
			 	function(data) {
			 		$('#result1').html(data);
			 	});
		}
	</script>
	<script type="text/javascript">
		function addToCart2() {
			
		var pid = $('#productID2').val();

			 $.post('/cs313-php/web/myWeb/pages/shopping/cart.php', {postid:pid}, 
			 	function(data) {
			 		$('#result2').html(data);
			 	});
		}
	</script>
	<script type="text/javascript">
		function addToCart3() {
			
		var pid = $('#productID3').val();

			 $.post('/cs313-php/web/myWeb/pages/shopping/cart.php', {postid:pid}, 
			 	function(data) {
			 		$('#result3').html(data);
			 	});
		}
	</script>
	<script type="text/javascript">
		function addToCart4() {
			
		var pid = $('#productID4').val();

			 $.post('/cs313-php/web/myWeb/pages/shopping/cart.php', {postid:pid}, 
			 	function(data) {
			 		$('#result4').html(data);
			 	});
		}
	</script>
	<script type="text/javascript">
		function addToCart5() {
			
		var pid = $('#productID5').val();

			 $.post('/cs313-php/web/myWeb/pages/shopping/cart.php', {postid:pid}, 
			 	function(data) {
			 		$('#result5').html(data);
			 	});
		}
	</script>

<?php
echo "</body>
</html>";


?>