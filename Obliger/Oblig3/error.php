<html>
<head>
  <?php
  if (file_exists("../style.css")):?>
    <link rel="stylesheet" type="text/css" href="../style.css">
  <?php else:?>
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php endif;?>
</head>
<body>
<?php
if (file_exists("../main_menu.php"))
  include "../main-menu.php";
else
  include "main-menu.php";
    ;?>

<main>
  <p>Her har det skjedd noe feil. Siden kunne ikke lastes.</p>
</main>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<?php
if (file_exists("../script.js")):?>
<script rel="script" src="../script.js" type="text/javascript"></script>
<?php else:?>
  <script rel="script" src="script.js" type="text/javascript"></script>
<?php endif;?>

</body>
</html>