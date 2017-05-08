<?php 
echo "			<div class=\"container white\">	
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
 ";
 ?>