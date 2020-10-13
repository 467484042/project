
<?php
echo '<a href="'.base_url().'project/index.php/home"><h1>Home</h1></a>';
echo"The verification code has been sent to the email:";
echo '<br>';
echo  $email;
echo '<br>';
echo "Verify account: ";
echo  $uname;
echo form_open(base_url().'project/index.php/signup/codeVerify');
echo form_label('please input verify code', 'label_code');
echo '<br>';
echo form_input('code','Six-digit verification code');
echo '<br>';

echo form_submit('submit', 'submit');

//header( 'refresh:3; '.base_url().'a2/index.php/home' );

