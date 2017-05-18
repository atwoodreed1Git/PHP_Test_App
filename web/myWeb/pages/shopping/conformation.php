<?php 
session_start();

$username = htmlspecialchars($_POST['name']);
$address = htmlspecialchars($_POST['address']);

include_once '../head.php';

echo " <body class=\"black\">";
include_once '../landonHeader.php';
include_once '../menu.php';

echo "	<main class=\"center\">
	
	<h1 class=\"white-text\">Conformation </h1>
	<h3 class=\"white-text\">$username's Order </h3>

	<div class=\"container white\">	
		<table class=\"striped responsive-table\">
			<thead>
		      <tr>
		         <th>Item</th>
		         <th>Price</th>
		         <th>Quantity</th>
		         <th>Total</th>
		      </tr>
		   </thead>
		   <tbody>
";

$cartTotal = 0;

foreach ($_SESSION['shopCart'] as $key => $val) 
{

	if ($val["item_quantity"] > 0)
	{
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
						<td>$" . $cartTotal . "</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<br/>
		<br/>
		<div class=\"white-text\">
			<p>Thank You $username<br>
			Your thank you note will be sent to:<br>
			$address
			</p>
		</div>
	</main>
</body>
</html>";

if (isset($_POST['chout']))
{
	unset($_SESSION['shopCart']);
	exit;
}

 ?>