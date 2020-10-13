<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
// Paypal IPN Class
// ------------------------------------------------------------------------

// Use PayPal on Sandbox or Live

//something wrong with my setting
$config['sandbox'] = TRUE; // FALSE for live environment
$config['paypal_api_username'] = 'sb-zniuw1629332@business.example.com';
$config['paypal_api_password'] = 'ENgvult5gXhW92idnOg6LVE_32Rh5yt_es5mMz5zf63tRRVe-0Y7cFccMiWSx1_-JHARkCNs2u5raWBk';
//$config['paypal_api_signature'] = 'AU';

// PayPal Business Email ID
$config['business'] = 'InsertPayPalBusinessEmail';

// If (and where) to log ipn to file
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
$config['paypal_lib_ipn_log'] = TRUE;

// Where are the buttons located at 
$config['paypal_lib_button_path'] = 'buttons';

// What is the default currency?
$config['paypal_lib_currency_code'] = 'AU';


?>
