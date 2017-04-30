<?php 
  $curPage = basename($_SERVER['PHP_SELF'],".php");

echo "<ul id=\"assigns\" class=\"side-nav fixed\">\n";
?>
        <li class="<?php if ($curPage == "home") echo 'active'?>">
<?php
echo "    <a href=\"home.php\">Home</a></li>\n";
echo "  <li class=\"divider\"></li>\n";
?>
        <li class="<?php if ($curPage == "assignments") echo 'active'?>">
<?php
echo "    <a href=\"assignments.php\">Assignments</a></li>\n";
echo "  </li>\n";
echo "  <li class=\"divider\"></li> \n";
echo "</ul>\n";
?>