<?php 

include_once 'head.php';

echo " <body>";

include_once 'landonHeader.php';
include_once 'menu.php';

echo "	<main class=\"white\">
		<div>
			<p class=\"courier bold bglightblue\">Our Mission:</p>
			<hr/>
	
			<img id=\"sad_pic\" src = \"$baseDir"."pics/sad.jpg\" alt = \"sad\"/>

			<p class=\"fontVerdana\">
			Landon Jamieson is a poor CS major without a laptop.
			<br/>
			<br/>
			Our <span class=\"bold\"> mission</span>  is to
			get him a laptop.
			<br/>
			<br/>          
			He just can't make it 
			without <span class=\"bold inline-color-text\">your
 			help.</span>
			</p>

			<br/>
			<br/>
			<br/>
		</div>

		<div>
			<h1>Our Goal:</h1>
		</div>

		<hr/>

		<div>
			<a href = \"http://bit.ly/1dcJlUd\">
	     		<img id=\"hp-pic\" src=\"$baseDir"."pics/hp.jpg\" alt=\"Laptop to buy\">
	     	</a>

	     	<div id=\"laptop-info\">
	     		<p>
	     		Our goal is to purchase Landon a <span class=\"bold\">HP Flyer
	     		 Red 15.6\" Laptop PC</span>. For more 
	     		<br/>
	     		<br/>
	     		information about this computer click on the picture.
	     		</p>
	     	</div>
		</div>
		
	</main>
</body>
</html>";
?>