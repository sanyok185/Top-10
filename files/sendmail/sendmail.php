<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('uk', 'phpmailer/language/');
	$mail->IsHTML(true);

	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@gmail.com';                     //SMTP username
	$mail->Password   = '';                               			//SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 

	//Від кого лист
	$mail->setFrom('user@gmail.com', 'Top-10.in.ua'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('user@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Вітання! Хочу отримати консультацію!"';

	//Тіло листа
	$body = '<h1>Зустрічайте супер листа!</h1>';

	if(trim(!empty($_POST['userName']))){
		$body.= "<p><strong>Ім'я:</strong>" . $_POST['userName'] .'</p>';
	}	
	
	if(trim(!empty($_POST['userPhone']))){
		$body.= "<p><strong>Телефон:</strong>" . $_POST['userPhone'] .'</p>';
	}	
	
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>