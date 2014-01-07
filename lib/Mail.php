<?php
require("phpmailer/class.phpmailer.php");
class Mail {
	public $host = "mail.51wan.com" ;// 您的企业邮局域名
	public $charSet = "UTF-8" ;	// 设置邮件的字符编码
	
	public $SMTPAuth = true ;	// 启用SMTP验证功能
	public $Username = "" ;		// 邮局用户名(请填写完整的email地址) diyong@51wan.com
	public $Password = "" ;		// 邮局密码dyong525
	public $fromEmail = "" ;	// 邮件发送者email地址 diyong@51wan.com
	public $fromUsername = "" ;	// 发件人名称
	
	public $toEmail = "" ;		//收件邮箱
	public $ccEmail = array() ;		//抄送
	public $bccEmail = array() ;	//暗送
	public $files = array() ;		//附件
	
	/**
	 * 邮件发送
	 *
	 * @param unknown_type $email
	 * @param unknown_type $Subject
	 * @param unknown_type $body
	 * @return bool
	 */
	public function sendMail($to,$Subject,$body){
		$mail = $this->getMail() ; 				//建立邮件发送类
		$mail->SMTPAuth = $this->SMTPAuth; 		// 启用SMTP验证功能
		if(empty($this->fromEmail) || empty($this->Password) || empty($to)){
			return false ;
		}
		if(empty($Subject)){
			$Subject = "null" ;
		}
		if(empty($body)){
			$body = "" ;
		}
		if(empty($this->fromUsername)){
			$this->fromUsername = $this->fromEmail ;
		}
		if(empty($this->Username)){
			$this->Username = $this->fromEmail ;
		}
		
		$mail->From = $this->fromEmail ;		//邮件发送者email地址 "diyong@51wan.com";
		$mail->FromName = $this->fromUsername ;	//"您的名称";
		$mail->Username = $this->Username ;		//邮局用户名(请填写完整的email地址) "diyong@51wan.com";
		$mail->Password = $this->Password ;		//邮局密码
		
		//收件箱信息
		if(is_array($to)){
			foreach ($to as $k=>$v){
				$mail->AddAddress("$v", "$k");//收件人地址
			}
		} else {
			$mail->AddAddress($to, $to);//收件人地址
		}
		$mail->Subject = $Subject ; //邮件标题
		$mail->Body = $body ; //邮件内容
		
		try {
			return $mail->Send() ;
		} catch (ErrorException $e){
			$e->getMessage();
			return $mail->ErrorInfo ;
		}
		return false ;
	}
	
	/**
	 * 发送邮件。
	 *
	 * @param unknown_type $subject
	 * @param unknown_type $body
	 * @param unknown_type $to
	 * @param unknown_type $from
	 * @param unknown_type $password
	 * @return unknown
	 */
	public function sendFullMail($subject,$body,$to,$from,$password){
		$this->toEmail = $to ;
		$this->fromEmail = $from ;
		$this->Password = $password ;
		return $this->sendMails($subject,$body) ;
	}
	
	/**
	 * 邮件发送
	 *
	 * @param string $Subject 主题
	 * @param string $body 邮件内容
	 * @return bool
	 */
	public function sendMails($Subject,$body){
		if(empty($this->fromEmail) || empty($this->Password) || empty($this->toEmail)){
			return false ;
		}
		if(empty($Subject) && empty($body)){
			return false ;
		}
		if(empty($this->fromUsername)){
			$this->fromUsername = $this->fromEmail ;
		}
		if(empty($this->Username)){
			$this->Username = $this->fromEmail ;
		}
		
		$mail = $this->getMail() ; //建立邮件发送类
		
		//发件邮箱信息
		$mail->From = $this->fromEmail ;		//邮件发送者email地址
		$mail->FromName = $this->fromUsername ;	//"您的名称";
		$mail->Username = $this->Username ;		//邮局用户名(请填写完整的email地址)
		$mail->Password = $this->Password ;		//邮局密码
		
		//收件箱信息
		if(is_array($this->toEmail)){
			foreach ($this->toEmail as $k=>$v){
				$mail->AddAddress("$v", "$k");//收件人地址
			}
		} else {
			$mail->AddAddress($this->toEmail, $this->toEmail);//收件人地址
		}
		//抄送
		if(is_array($this->ccEmail)){
			foreach ($this->ccEmail as $k=>$v){
				$mail->AddCC("$v", "$k");
			}
		}
		//暗送
		if(is_array($this->bccEmail)){
			foreach ($this->bccEmail as $k=>$v){
				$mail-> AddBCC("$v", "$k");
			}
		}

		//邮件内容
		$mail->Subject = $Subject ; //邮件标题
		$mail->Body = $body ; //邮件内容
		if (is_array($this->files)){
			foreach ($this->files as $v){
				if(is_file($v) && file_exists($v)){
					$mail->AddAttachment($v); // 添加附件
				}
			}
		}
		
		return $mail->Send() ;
	}
	
	/**
	 * 初步创建Mail对象
	 *
	 * @return unknown
	 */
	
	private function getMail(){
		$mail = new PHPMailer() ;	//建立邮件发送类
		$mail->IsSMTP() ;			// 使用SMTP方式发送
		$mail->CharSet = $this->charSet ;
		$mail->Host = $this->host ;	// 您的企业邮局域名
		$mail->SMTPAuth = $this->SMTPAuth ;	// 启用SMTP验证功能
		$mail->IsHTML(true) ;				//是否使用HTML格式
//		$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
		
		return $mail ;
	}
}


?>