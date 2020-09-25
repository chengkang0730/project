<?php
return array (
  'basic' => 
  array (
    'site_name' => '博客后台管理',
    'record' => '备案',
    'login_vercode' => '1',
    'first_menu_num' => '7',
  ),
  'dictionary' => 
  array (
    'config' => 
    array (
      'basic' => '基础配置',
      'dictionary' => '分组配置',
      'upload' => '上传配置',
    ),
  ),
  'qiniu_kodo' => 
  array (
    'access_key' => '',
    'bucket' => '',
    'domain' => '',
    'secret_key' => '',
  ),
  'upload' => 
  array (
    'maxsize' => '500mb',
    'mimetype' => 'jpg,png,bmp,jpeg,gif,zip,rar,xls,xlsx,mp4',
    'radio' => 'open',
    'domain' => 'http://127.0.0.1:8000/',
  ),
  'email' => 
  array (
    'send_type' => 'smtp',
    'smtp_host' => 'smtp.qq.com',
    'smtp_port' => '587',
    'smtp_user' => '',
    'smtp_password' => '',
    'verify_type' => 'ssl',
    'from' => '',
    'from_name' => '',
    'max_send_num' => '3',
  ),
  'aliyun_ram' => 
  array (
    'access_key' => '',
    'access_key_secret' => '',
  ),
  'aliyun_oss' => 
  array (
    'access_key_id' => '0',
    'access_key_secret' => '1',
    'bucket' => '',
    'bucket_url' => '',
    'endpoint' => '',
  ),
  'aliyun_mobilemsg' => 
  array (
    'access_key' => '',
    'access_key_secret' => '',
    'sign' => '',
    'template' => 
    array (
      '' => '',
    ),
    'expire_time' => '',
    'interval_time' => '',
  ),
  'apidoc' => 
  array (
    'apidoc_file_name' => 'api',
    'apidoc_title' => 'LayTp - api文档',
  ),
);