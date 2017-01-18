<?php
 
namespace tmukherjee13\mailer;
 
abstract class Base
{
 use \tmukherjee13\mailer\MailerTrait;
    /**
     *
     * @var TransportInterface
     */
    private static $_transport;
 
    /**
     *
     * @var \MyApp\model\EmailTemplate
     */
    private $_emailTemplate;
    protected $_emailCode;
    private $_addToEmail;
    private $_addToUsername;
    private $_data;
 
    /**
     * Recipient
     * @var \MyApp\model\User
     */
    private $_user;
 
    public function __construct($data)
    {
        $data = $this->_initData($data);
 
        if (!empty($data['user'])) {
            $this->_user = $data['user'];
            $data['email'] = $this->_user->email;
            $data['username'] = $this->_user->username;
        } else {
            if (empty($data['email'])) {
                throw new \Exception("Email is not defined");
            }
        }
        $this->_addToEmail = $data['email'];
        if (!empty($data['username'])) {
            $this->_addToUsername = $data['username'];
        }
        $this->_data = $data;
    }
 
    protected function _initData($data)
    {
        return $data;
    }
 
    /**
     * Compile and send email
     */
    public function send()
    {
        $email = $this->_emailTemplate();
        $email->compile($this->_data);
 
        
        \Yii::$app->mailer->compose()
        ->setFrom(\Yii::$app->params['adminEmail'])
        ->setTo($this->_addToEmail)
        ->setSubject($email->subject)
        ->setHtmlBody($email->body)
        ->send();

        // $mail = new \Zend\Mail\Message();
        // $mail->setBody($email->body);
        // $mail->setSubject($email->subject);
        // $mail->addTo($this->_addToEmail, $this->_addToUsername);
        // $mail->setFrom(\Yii::$app->params['adminEmail'], \Yii::$app->params['adminEmail']);
 
        //$mail->addHeader('List-Unsubscribe', '<' . 'link' . '>');
        // $this->getTransport()->send($mail);
 
        return true;
    }
 
    /**
     * Return email transport
     * @return \Zend\Mail\Transport\TransportInterface
     */
    public static function getTransport()
    {
        if (!self::$_transport) {
            if (\Yii::$app->mailer->messageClass ==  'sendmail') {
                self::$_transport = new \Zend\Mail\Transport\Sendmail();
            } elseif (\Yii::$app->params['email']['provider'] == 'file') {
                $fileOptions = new \Zend\Mail\Transport\FileOptions();
                $fileOptions->setPath(\Yii::$app->basePath . '/runtime/cache/email/' . APPLICATION_ENV);
                self::$_transport = new \Zend\Mail\Transport\File($fileOptions);
            }
        }
        return self::$_transport;
    }
 
    
 
}