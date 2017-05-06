<?php 
/**
* 
*/
class CartItem
{
	
	public function CartItem()
	{

		# code...
	}


	public function displayCards($value='0')
	{
		echo "				<div class=\"card small cyan lighten-4\">
						<div class=\"card-content\">
							<span class=\"card-title\">$$num Donation</span>
							<p> $$num donation to the fund </p>
						</div>
						<div class=\"card-action\">
							<button type=\"button\" class=\"btn-flat\">
							Add to cart </button>
							<button type=\"button\" class=\"btn-flat\">
							Remove for cart</button>
						</div>
					</div>
					";
	}


}
 ?>