<?php 
session_start(); 

include_once '../head.php';

echo " <body class=\"black\">";

include_once '../headers/landonHeader.php';
include_once '../menu.php';

echo "	<main>
		<h1 class=\"white-text center\"> Shopping Cart </h1>
		<div class=\"container white\">	
			<table class=\"striped responsive-table\" id=\"cartTable\">
				<thead>
			      <tr>
			         <th>Item</th>
			         <th>Price</th>
			         <th>Quantity</th>
			         <th>Total</th>
			         <th>Remove Item<th>
			      </tr>
			   </thead>
			   <tbody>
";

$cartTotal = 0;

$id = -1;

foreach ($_SESSION['shopCart'] as $key => $val) 
{

	if ($val["item_quantity"] > 0)
	{
		$id = $_SESSION["shopCart"][$key]["item_id"];
		$isize = $_SESSION["shopCart"][$key]["item_size"];
		$iprice = $_SESSION["shopCart"][$key]["item_price"];
		$iq = $_SESSION["shopCart"][$key]["item_quantity"];
		$itotal = $iq * $iprice;
		
		$cartTotal += $itotal;
	echo "				<tr>
					<td>" . $isize ."</td>
					<td>$" . $iprice . "</td>
					<td>" . $iq . "</td>
					<td>" . $itotal . "</td>
					<td>
						<form action=\"$baseDir" . "pages/shopping/cart.php\" method=\"post\">
							<input type=\"hidden\" name=\"productID\" id=\"productID" . $id . "\" value=\"" . $id . "\"/>
							</input>
							<input type=\"button\" class=\"btn-flat\" onclick=\"removeItem" . $id . "(this);\"
							id=\"add" . $id . "\"name=\"remove_cart\" value=\"Remove From Cart \">
							</input>
						</form>
					</td>
				</tr>
";
			
	}
}	

echo "			</tbody>
				<tfoot>
					<tr class=\"bold grey\">
						<td>Total</td>
						<td></td>
						<td></td>
						<td></td>
						<td>$" . $cartTotal . "</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<br/>
		<br/>
		<div class=\"center\">
			<form action=\"$baseDir" . "pages/shopping/checkout.php\" method=\"post\"> 
				<input type=\"submit\" name=\"checkout\" value=\"Checkout\"> 
				</input>
			</form>
		</div>
		<br>
		<div class=\"center\">
			<a href=\"$baseDir" . "pages/shopping/donationItems.php\">Return to Donations</a>
		</div>
	</main>
"; 
?>
	<script type="text/javascript">
		function removeItem0(r) {
			
			var pid = $('#productID0').val();
			var i = r.parentNode.parentNode.rowIndex;

			$.post('/myWeb/pages/shopping/cart.php', {rid:pid});

			document.getElementById("cartTable").deleteRow(i+1);

			window.location.href = "/myWeb/pages/shopping/displayCart.php";
		}
	</script>
	<script type="text/javascript">
		function removeItem1(r) {
			
			var pid = $('#productID1').val();
			var i = r.parentNode.parentNode.rowIndex + 1;

			$.post('/myWeb/pages/shopping/cart.php', {rid:pid});

			document.getElementById("cartTable").deleteRow(i);
			window.location.href = "/myWeb/pages/shopping/displayCart.php";
		}
	</script>
	<script type="text/javascript">
		function removeItem2(r) {
			
			var pid = $('#productID2').val();
			var i = r.parentNode.parentNode.rowIndex + 1;

			$.post('/myWeb/pages/shopping/cart.php', {rid:pid});

			document.getElementById("cartTable").deleteRow(i);
			window.location.href = "/myWeb/pages/shopping/displayCart.php";
		}
	</script>
	<script type="text/javascript">
		function removeItem3(r) {
			
			var pid = $('#productID3').val();
			var i = r.parentNode.parentNode.rowIndex + 1;

			$.post('/myWeb/pages/shopping/cart.php', {rid:pid});

			document.getElementById("cartTable").deleteRow(i);
			window.location.href = "/myWeb/pages/shopping/displayCart.php";
		}
	</script>
	<script type="text/javascript">
		function removeItem4(r) {
			
			var pid = $('#productID4').val();
			var i = r.parentNode.parentNode.rowIndex + 1;

			$.post('/myWeb/pages/shopping/cart.php', {rid:pid});

			document.getElementById("cartTable").deleteRow(i);
			window.location.href = "/myWeb/pages/shopping/displayCart.php";
		}
	</script>
	<script type="text/javascript">
		function removeItem5(r) {
			
			var pid = $('#productID5').val();
			var i = r.parentNode.parentNode.rowIndex + 1;

			$.post('/myWeb/pages/shopping/cart.php', {rid:pid});

			document.getElementById("cartTable").deleteRow(i);
			window.location.href = "/myWeb/pages/shopping/displayCart.php";
		}
	</script>

<?php
echo "</body>
</html>";

 ?>



   	