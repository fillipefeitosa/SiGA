<?php $session = $this->session->userdata("current_user"); ?>

<h2 class="principal">Relatório de solicitações de matrícula</h2>

<h4>Cursos para o(a) secretário(a) <b><?php echo $session['user']['name']?></b>:</h4>
<?php 

	if($courses !== FALSE){
		secretaryCoursesToRequestReport($courses);
 	}else{
?>
	<div class="callout callout-info">
		<h4>Nenhum curso cadastrado no momento para sua secretaria.</h4>
	</div>
<?php }

	echo anchor("secretary_home", "Voltar", "class='btn btn-danger'");
?>