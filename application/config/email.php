<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
| -------------------------------------------------------------------
| EMAIL CONFIG
| -------------------------------------------------------------------
| Konfigurasi email keluar melalui mail server
| */ 
$config['protocol']='smtp'; 
$config['smtp_host']='ssl://smtp.googlemail.com'; 
$config['smtp_port']='465'; 
$config['smtp_timeout']='30'; 
$config['smtp_user']='sigit.vespa12@gmail.com'; 
$config['smtp_pass']='sigit_vespa123'; 
$config['charset']='utf-8'; 
$config['newline']="\r\n"; 
/*
$config['smtp_host'] = 'mail.three.co.id';
$config['smtp_user'] = 'harmoni_studio@yahoo.com';
$config['smtp_pass'] = 'harmonistudio1608';
$config['smpt_port'] = '465';
$config['protocol']  = 'smtp';
/* End of file email.php */
/* Location: ./system/application/config/email.php */