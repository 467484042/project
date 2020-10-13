


<?php

echo '<a href="'.base_url().'project/index.php/home"><h1>Home</h1></a>';
echo"Welcome ";
echo $uname;
echo '<br>';
echo 'will auto back home page in 3s';
header( 'refresh:3; '.base_url().'project/index.php/home' );

