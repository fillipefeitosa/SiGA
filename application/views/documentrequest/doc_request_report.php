<?php require_once(APPPATH."/constants/DocumentConstants.php"); ?>

<h2 class="principal">Solicitação de documentos para o curso <i><b><?php echo $courseData['course_name']?></b></i></h2>

<h3><i class="fa fa-list"></i> Documentos solicitados pelos alunos:</h3>
<?php if($courseRequests !== FALSE){ ?>

		<div class="box-body table-responsive no-padding">
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
			        <th class="text-center">Código</th>
			        <th class="text-center">Aluno</th>
			        <th class="text-center">Tipo do documento</th>
			        <th class="text-center">Status</th>
			        <th class="text-center">Dados adicionais</th>
			        <th class="text-center">Ações</th>
			    </tr>
<?php
	    			$user = new Usuario();
			    	foreach($courseRequests as $request){

						echo "<tr>";
				    		echo "<td>";
				    		echo $request['id_request'];
				    		echo "</td>";

				    		echo "<td>";
				    			$studentId = $request['id_student'];
				    			$userData = $user->getUserById($studentId);
				    			echo $userData['name'];
				    		echo "</td>";

				    		echo "<td>";
					    		$docConstants = new DocumentConstants();
					    		$allTypes = $docConstants->getAllTypes();
					    		echo $allTypes[$request['document_type']];
				    		echo "</td>";

				    		echo "<td>";
				    		switch($request['status']){
				    			case DocumentConstants::REQUEST_OPEN:
				    				echo "<span class='label label-info'>Aberta</span>";
				    				break;
				    			case DocumentConstants::REQUEST_READY:
				    				echo "<span class='label label-success'>Pronto</span>";
				    				break;
				    			default:
				    				echo "-";
				    				break;
				    		}
				    		echo "</td>";

				    		echo "<td>";
				    		switch($request['document_type']){
				    			case DocumentConstants::OTHER_DOCS:
				    				echo "<b>Documento solicitado: </b>".$request['other_name'];
				    				break;
				    			
				    			default:
				    				echo "-";
				    				break;
				    		}
				    		echo "</td>";

				    		echo "<td>";
				    		echo "<div class='callout callout-info'>";

				    		if($request['status'] === DocumentConstants::REQUEST_READY){
				    			echo "<h4>Este documento já está disponível para o aluno.</h4>";
				    		}else{	
					    		echo anchor(
					    			"documentrequest/documentReady/{$request['id_request']}/{$courseData['id_course']}",
						    		"<i class='fa fa-check'></i> Expedir documento",
						    		"class='btn btn-success'"
					    		);
					    		echo "<p>Permite que o aluno saiba que o documento está pronto.</p>";
				    		}
				    		echo "</div>";
				    		echo "</td>";
			    		echo "</tr>";
			    	}
?>			    
			</tbody>
		</table>
		</div>

<?php
 	} else{
?>
	<div class="callout callout-info">
		<h4>Nenhum solicitação de documentos feita para o curso.</h4>
	</div>
<?php }?>
