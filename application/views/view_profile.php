<?php
echo '<a href="'.base_url().'project/index.php/home"><h1>Home</h1></a>';
echo form_open(base_url().'project/index.php/Profile/updateProfile');
echo form_label('What is your id', 'label_id');
echo '<br>';
echo form_input('input_id', $id);
echo '<br>';
echo '<br>';

echo form_label('What is your username', 'label_username');
echo '<br>';
echo form_input('input_username', $name);

echo '<br>';
echo '<br>';

echo form_label('your email', 'label_email');
echo '<br>';
echo form_input('input_email', $email);
echo '<br>';
echo '<br>';

echo form_label('What is your password', 'label_pw');
echo '<br>';
echo form_input('input_pw', $password);
echo '<br>';
echo '<br>';

echo form_label('What is your phone number', 'label_phone');
echo '<br>';
echo form_input('input_phone', $phone);
echo '<br>';
echo '<br>';
echo form_reset('reset', 'cancel');
echo form_submit('submit', 'save');



if($GLOBALS['exist_name']){
	echo '<br>';
	echo 'the user already exist';
}

?>
