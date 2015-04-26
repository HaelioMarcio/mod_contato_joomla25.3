<div class="row">
	<p><?php echo $params->get('TEXTO_MOD_CONTATO'); ?></p>
</div>
<p>

<?php
$map = $params->get('CODIGO_MAP_MOD_CONTATO');
 if(!empty($map) ){ ?>
	<iframe 
		src="<?php echo $params->get('CODIGO_MAP_MOD_CONTATO'); ?>"
		width="100%" height="<?php echo $params->get('HEIGHT_MAP_MOD_CONTATO'); ?>" frameborder="0" style="border:0">
	</iframe>
<?php } ?>
</p>

<form action="<?php $_SERVER ['REQUEST_URI']; ?>" id="mod_contato_form" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input type="text" name="nome" id="nome" class="form-control" placeholder="* Nome">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" onblur="valida_form();" class="form-control" placeholder="* Email">
					<div id="response_email"></div>
				</div>
				<div class="form-group">
					<input type="text" name="assunto" id="assunto" class="form-control" placeholder="* Assunto">
				</div>
			
			</div>
			
			<div class="col-md-6">

				<div class="form-group">
					<textarea name="mensagem" id="mensagem" class="form-control" placeholder="* Mensagem"
					cols="30" rows="6"></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
			<div class="checkbox">
			  <label>
			    <p><input type="checkbox" name="enviaCopiaEmail" value="enviaCopiaEmail" id="copia"> Me enviar uma cópia.</p>
			  </label>
			</div>
			<div><p id="respostaModContato"></p></div>
			<div class="form-group">
				<input type="submit" class="btn btn-danger center-block" value="Enviar">
			</div> 
			</div>
		</div>
	</form>


		<?php
			
			$ativa = true;

			if( isset($_POST['nome'], $_POST['email'], $_POST['assunto'], $_POST['mensagem']) ){
					
					$nome = $_POST['nome'];
					$email = $_POST['email'];
					$assunto = $_POST['assunto'];
					$mensagem = $_POST['mensagem'];	

					if(!empty($nome) & !empty($email) & !empty($assunto) & !empty($mensagem)){
						
						function validaEmail($email) {
							
							$conta = "^[a-zA-Z0-9\._-]+@";
							$domino = "[a-zA-Z0-9\._-]+.";
							$extensao = "([a-zA-Z]{2,4})$";

							$pattern = $conta.$domino.$extensao;

							if( ereg($pattern, $email) ){
								return true;
							} else {
								return false;
							}
						}

						if($ativa){

							if(validaEmail($email)){
								$corpo = "Nome: ". $nome."\n".
								"E-mail: ". $email ."\n".
								"Assunto: ". $assunto ."\n".
								"Mensagem: ". $mensagem;

								$emaildestino = $params->get('EMAIL_MOD_CONTATO');
								
								if(isset($_POST['enviaCopiaEmail']) ){
									mail($email, "Contato - Mod_Contato", $corpo);
								}

								if( mail($emaildestino, "Contato - Mod_Contato", $corpo) )
								{
									echo "
										<script>
											document.getElementById('respostaModContato').innerHTML = '<div class=\"alert alert-success\" role=\"alert\">E-mail enviado com sucesso!</div>';
										</script>
									"
									;
									
									$ativa = false;

								} else {
									echo "
										<script>
											document.getElementById('respostaModContato').innerHTML = '<div class=\"alert alert-danger\" role=\"alert\">Erro ao enviar e-mail, por favor, tente mais tarde!</div>';
										</script>";
								}

							} else {

								echo "
									<script>
										document.getElementById('response_email').innerHTML = '<p class=\"red\">Por favor, informe seu email corretamente!</p>';
									</script>";
							}
							
						}

					} else {
						echo "
							<script>
								document.getElementById('respostaModContato').innerHTML = '<div class=\"alert alert-info\" role=\"alert\">Por favor, preencha todos os campos!</div>';
							</script>";
					}

			}
			
		 ?>