<?php

namespace App\Util;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\Exception;

/**
 * 
 */
class EmailAdapterUtil
{
	private $mail;

	function __construct()
	{
		$this->mail = new PHPMailer(true);
		$this->serverSettings();
	}

	private function serverSettings()
	{
		// $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
	    $this->mail->isSMTP();
	    $this->mail->Host       = MAIL_HOST;
	    $this->mail->SMTPAuth   = true;
	    $this->mail->Username   = MAIL_USERNAME;
	    $this->mail->Password   = MAIL_PASSWORD;
	    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
	    $this->mail->Port       = MAIL_PORT;  
	    $this->mail->CharSet = 'UTF-8';
	}

	public function setFrom($email,$name = null)
	{
		if (is_null($name)) {
			$this->mail->setFrom($email);
		} else {
			$this->mail->setFrom($email,$name);
		}
	}

	public function addAddress($email,$name)
	{
		$this->mail->addAddress($email,$name);
	}

	public function addAttachment($archivePath,$displayName)
	{
		if (is_null($displayName)) {
			$this->mail->addAttachment($archivePath);
		} else {
			$this->mail->addAttachment($archivePath,$displayName);
		}
	}

	public function mountContent($subject,$body,$altBody = null)
	{
		$this->mail->isHTML(true);
		$this->mail->Subject = $subject;
		$this->mail->Body    = $body;
		
		if (!is_null($altBody)) {
			$this->mail->AltBody = $altBody;
		}
	}

	public function send()
	{
		$this->mail->send();
	}

}