<?php
 
namespace tmukherjee13\mailer;
 
class ResetPassword extends \tmukherjee13\mailer\Base
{
 
    protected $_emailCode = 'test';
 
    protected function _initData($data)
    {
        $data['USER'] = $data['user']['username'];
        $data['ADMIN_EMAIL'] = 'asdfsdaf';
 
        return $data;
    }
 
}