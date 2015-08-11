<h2 class="principal">Escolha o curso para solicitar os documentos</h2>

<div class="panel panel-primary">
  
	<div class="panel-heading"><h4>Cursos para o(a) aluno(a) <i><?php echo $userData['name'];?></i></h4></div>

	<div class="panel-body">
	
		<?php
		if($courses !== FALSE){

			foreach ($courses as $course) {
				
				echo anchor("documentrequest/requestDocument/{$course['id_course']}/{$userData['id']}", "<b>".$course['course_name']."</b>");
				echo "<br>";
				echo "Data matrícula: ".$course['enroll_date'];
				echo "<hr>";
			}

		}else{
		?>

		<div class="callout callout-info">
			<h4>Aluno não matriculado em nenhum curso.</h4>
		</div>

		<?php } ?>

	</div>

	<div class="panel-footer" align="center"><i>Escolha um curso para prosseguir...</i></div>
</div>