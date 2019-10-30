<?php

require __DIR__ . './bootstrap.php';
?>

<html>

<head>
</head>

<body>
    <?php
    foreach ($files as $file) {
        echo '<img src="image.php?image=' . $file . '" />';
    }
    ?>
</body>

</html>
