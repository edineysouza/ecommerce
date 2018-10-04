<?php

namespace Hcode;

use Rain\Tpl;

class Mailer{

	const USERNAME = "edineypsouza@gmail.com";
	const PASSWORD = "bell5034";
	const NAME_FROM = "Ediney Store";

	private $mail;

	public function __construct($toAddress, $toName,$subject, $tplName, $data = array()){

		$config = array(
			"tpl_dir"       => "views/email/",
			"cache_dir"     => "views-cache/",
			"debug"         => false
		   );

		Tpl::configure( $config );

		$tpl = new Tpl;

		foreach ($data as $key => $value) {
			$tpl->assign($key, $value);
		}

		$html = $tpl->draw($tplName, true);

		$this->mail = new \PHPMailer;

		$this->mail->issMTP();

		$this->mail->SMTPDebug = 0;

		$this->mail->Debugoutput = 'html';

		$this->mail->Host = 'smtp.gmail.com';

		$this->mail->Port = 587;

		$this->mail->SMTPSecure = 'tls';

		$this->mail->SMTPAuth = true;

		$this->mail->Username = Mailer::USERNAME;

		$this->mail->Password = Mailer::PASSWORD;

		$this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);

		$this->mail->addAddress($toAddress, $toName);

		$this->mail->Subject = $subject;

		$this->mail->msgHTML($html);

		$this->mail->AltBody = 'This is a plain-text message bory';
	}

	public function send(){

		return $this->mail->send();
	}
}

?>