<?php 

include_once 'shopHead.php';

echo " <body>";

include_once '../headers/landonHeader.php';
include_once '../menu.php';

echo "	<main>
	
		<h1 class=\"center\">Check Out </h1>

		<div class=\"container\">
			 <form action=\"$baseDir"."pages/shopping/conformation.php\" method=\"post\">
			 	<input type=\"hidden\" id=\"chout\" name=\"chout\" value=\"chout\"></input>
				<label for=\"name\">Name: </label>
				<input id=\"name\" type=\"text\" name=\"name\">
				<br>
				<br>
				<label for=\"address\">Address: </label>
					<input id=\"address\" type=\"text\" name=\"address\">
				<br>
				<br>
				<div class=\"row\">
					<div class=\"col s6\">
						<input class=\"btn-flat\" type=\"submit\" name=\"submit\" 
						value=\"Process Order\"></input>
					</div>
					<div class=\"col s6 center\">
						<input class=\"btn-flat\" type=\"reset\" name=\"reset\" 
						value=\"Clear\"></input>
					</div>
				</div>
			</form>
			<div>
				<a href=\"$baseDir" . "pages/shopping/displayCart.php\">Return to Cart</a>
			</div>
		</div>
	</main>
</body>
</html>";

 ?>

 