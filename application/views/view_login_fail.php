<?php
echo "Login ";
echo $message;
header( 'refresh:3; '.base_url().'project/index.php/Login' );
//redirect(base_url().'a2/index.php/Login','refresh');

