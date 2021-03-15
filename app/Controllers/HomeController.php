<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Views\MainView;
use App\Util\EmailAdapterUtil;

/**
 * 
 */
class HomeController
{
	public function __construct()
	{
		$this->view = new MainView('home');
	}

	public function executar()
	{
		if (isset($_POST['curriculo'])) {

			$ip = $_SERVER['REMOTE_ADDR'];
			$data = date('Y-m-d H:i:s');
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$fone = $_POST['telefone'];
			$cargo = $_POST['cargo'];
			$escolaridade = $_POST['escolaridade'];
			$obs = $_POST['obs'];
			$curriculo = $_FILES['curriculo'];
			// echo PHP_EOL;
			
			if (!empty($nome) &&
				!empty($email) &&
				!empty($fone) &&
				!empty($cargo) &&
				!empty($escolaridade) &&
				!empty($curriculo) ) {
				
				if ($this->validaCurriculo($curriculo) == false){
					echo 'O formato do arquivo é inválido!';
				}else{
					$verificaObs = $obs ? $obs : 'Sem observacoes!';

					$curriculoName = $this->uploadFile($curriculo);
					if(HomeModel::insert($nome,$email,$fone,$cargo,$escolaridade,$verificaObs,$curriculoName,$ip,$data)){
						
						$emailDest = 'meuemail@email.com';
						$nomeDest = 'Nome do destinatário';
						$assunto = 'Teste envio de curriculo';
						$conteudo = '<h3>Email enviado pelo formúlario de cadastro de currículo</h3><br>'.
									'<p>Enviado por: '.$nome.
									'<br>Telefone: '.$fone.
									'<br>Observação: '.$verificaObs.'</p><br><br><br>';
						$arquivoCaminho = 'app/Views/pages/uploads/'.$curriculoName;
						$this->enviarEmail($email,$nome,$emailDest,$nomeDest,$conteudo,$assunto,$arquivoCaminho,$curriculoName);
						
						$_SESSION['formEnv'] = "Formulário enviado com sucesso!";
						echo '<script>location.href="'.INCLUDE_PATH.'"</script>';		
						die();
					}else{
						echo 'Algo deu errado e os dados não foram cadastrados!';
					}
				}
			}else{
				$_SESSION['preenchaCampos'] = "Preencha todos os campos obrigatórios!";
				echo '<script>location.href="'.INCLUDE_PATH.'"</script>';		
				die();
			}
		}else{
			session_destroy();
		}

		$this->view->render(array('titulo'=>'Form | Currículo'));
	}

	public function validaCurriculo($file)
	{
		if(	$file['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
			$file['type'] == 'application/pdf') {
			$tamanho = intval($file['size']/1024);
			if ($tamanho <= 1024)
				return true;
			else
				return false;
		}else{
			return false;
		}
	}

	public function uploadFile($file)
	{
		$formatoArquivo = explode('.',$file['name']);
		$nome = $formatoArquivo[0];
		// $nomeArquivo = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
		$nomeArquivo = $nome.'.'.$formatoArquivo[count($formatoArquivo) - 1];
		
		if (move_uploaded_file($file['tmp_name'],'app/Views/pages/uploads/'.$nomeArquivo)){
			return $nomeArquivo;
		}else{
			return false;
		}
	}

	public function enviarEmail($email,$nome,$emailDestino,$nomeDetino,$body,$subject,$caminhArquivo,$nomeArquivo)
	{
		$mail = new EmailAdapterUtil;
		$mail->setFrom($email,$nome);
		$mail->addAddress($emailDestino,$nomeDetino);
		$mail->addAttachment($caminhArquivo,$nomeArquivo);
		$mail->mountContent($subject,$body);
		if($mail->send())
			return true;
		else
			return false;
	}
}

?>