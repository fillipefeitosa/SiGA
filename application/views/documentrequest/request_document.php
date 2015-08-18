<?php require_once(APPPATH."/constants/DocumentConstants.php"); ?>

<h2 class="principal">Solicitação de Documentos</h2>

<h3><i class="fa fa-list"></i> Documentos já solicitados</h3>
<?php 
	echo anchor(
		"documentrequest/displayArchivedRequests/{$courseId}/{$userId}",
		"Solicitações arquivadas",
		"class='btn btn-success'"
	); 
?>
<?php if($documentRequests !== FALSE){ ?>

		<div class="box-body table-responsive no-padding">
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
			        <th class="text-center">Código</th>
			        <th class="text-center">Tipo do documento</th>
			        <th class="text-center">Data da solicitação</th>
			        <th class="text-center">Status</th>
			        <th class="text-center">Dados adicionais</th>
			        <th class="text-center">Ações</th>
			    </tr>
<?php
			    	foreach($documentRequests as $request){

						echo "<tr>";
				    		echo "<td>";
				    		echo $request['id_request'];
				    		echo "</td>";

				    		echo "<td>";
					    		$docConstants = new DocumentConstants();
					    		$allTypes = $docConstants->getAllTypes();
					    		
					    		if($allTypes !== FALSE){
					    			echo $allTypes[$request['document_type']];
					    		}else{
					    			echo "-";
					    		}
					    	echo "</td>";

				    		echo "<td>";
				    			echo $request['date'];
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
				    				echo "<b>Solicitação: </b>".$request['other_name'];
				    				break;
				    			
				    			default:
				    				echo "-";
				    				break;
				    		}
				    		echo "</td>";

				    		echo "<td>";
				    		if($request['status'] === DocumentConstants::REQUEST_READY){
				    			echo anchor(
					    			"documentrequest/archiveRequest/{$request['id_request']}/{$courseId}/{$userId}",
						    		"<i class='fa fa-archive'></i> Arquivar",
						    		"class='btn btn-success'"
					    		);
				    		}else{
					    		echo anchor(
					    			"documentrequest/cancelRequest/{$request['id_request']}/{$courseId}/{$userId}",
						    		"<i class='fa fa-remove'></i>",
						    		"class='btn btn-danger'"
					    		);
				    		}
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
		<h4>Nenhuma solicitação de documentos feita pelo aluno.</h4>
	</div>
<?php }?>

<br>
<h3><i class="fa fa-plus-circle"></i> Nova solicitação</h3>
<br>
<?= form_open('documentrequest/newDocumentRequest') ?>
	
	<?= form_hidden("courseId", $courseId)?>
	<?= form_hidden("studentId", $userId)?>
	
	<div class='form-group'>
		<?= form_label("Escolha o tipo de documento:", "documentTypes") ?>
		<?= form_dropdown("documentType", $documentTypes, '', "id='documentType' class='form-control' style='width:40%;'"); ?>
	</div>

	<br>
	<div id="document_request_data"></div>

<?= form_close() ?>

<br>
<br>
<?= anchor('documents_request', 'Voltar', "class='btn btn-danger'")?>