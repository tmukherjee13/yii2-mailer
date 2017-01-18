<?php
namespace tmukherjee13\mailer;

trait MailerTrait
{
    /**
     * Return email object
     * @return \MyApp\model\EmailTemplate
     * @throws Exception
     */
    protected function _emailTemplate()
    {
        if (!$this->_emailCode) {
            throw new Exception("Template name is not set");
        }
        if (!$this->_emailTemplate) {
            $this->_emailTemplate = \tmukherjee13\mailer\models\EmailTemplate::findOne(['code' => $this->_emailCode]);
        }

        return $this->_emailTemplate;
    }

    protected function _compileEmail($email,$data)
    {
        $loader = new \Twig_Loader_Array(array(
            'body' => $email->body,
        ));
        $twig = new \Twig_Environment($loader);
        $dd = $twig->render('body', $data);
        $email->body = $dd;
        return $email;
    }
}
