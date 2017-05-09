<?php 
session_start();

if (isset($_POST['postid']))
{
	$i_idd = htmlspecialchars($_POST['postid']);

	// add quantity to the item
	foreach ($_SESSION['shopCart'] as $key => $val) 
	{
		if ($i_idd == $val["item_id"])
		{
			$_SESSION["shopCart"][$key]["item_quantity"] += 1;
			
			echo "Quantity = " . $_SESSION["shopCart"][$key]["item_quantity"];
		}
	}
}

if (isset($_POST['rid']))
{
	$i_idd = htmlspecialchars($_POST['rid']);

	// add quantity to the item
	foreach ($_SESSION['shopCart'] as $key => $val) 
	{
		if ($i_idd == $val["item_id"])
		{
			$_SESSION["shopCart"][$key]["item_quantity"] = 0;
			echo "Quantity = " . $_SESSION["shopCart"][$key]["item_quantity"];
		}
	}
}

if (isset($_POST['clearCart']))
{
	unset($_SESSION['shopCart']);
	exit;
}

 ?>