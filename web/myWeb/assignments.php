<?php 
echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n\n";

include 'header.php';

echo "</head>\n";
echo "<body>\n";
echo "<header>\n\n";

include 'menu.php';

echo "</header>\n";
echo "   <main>\n";

echo "      <div id=\"fade-image\" class=\"section scrollspy\">\n";
echo "         <div>\n";
echo "            <a href=\"https://goo.gl/DC2ruU\">\n";
echo "            <img id=\"image-test\" class=\"responsive-img\" \n";
echo "               alt=\"Under Construction\" src=\"website-under-construction.jpeg\">\n";
echo "            <a href=\"#!\" class=\"btn\" onclick=\"Materialize.fadeInImage('#image-test')\">Click Me</a>\n";
echo "         </div>\n";
echo "      </div>\n";
echo "   </main>\n";
echo "</body>\n";
echo "</html>\n";
?>