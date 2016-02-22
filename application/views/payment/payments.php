<h2 class="principal">Pagamentos</h2>

<?= anchor("payment/newPayment/{$budgetplanId}/{$expenseId}", "<i class='fa fa-plus-circle'></i> Novo pagamento", "class='btn-lg'") ?>
<?php
	if($payments !== FALSE){
?>
	<h3>Pagamentos registrados para essa despesa:</h3>
	<div class="box-body table-responsive no-padding">
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
			        <th class="text-center">Código</th>
			        <th class="text-center" colspan="3">Dados informados</th>
			        <th class="text-center">Ações</th>
			    </tr>
<?php
					foreach($payments as $payment){

						echo "<tr>";
				    		echo "<td>";
				    		echo $payment['id_payment'];
				    		echo "</td>";

				    		echo "<td>";
				    			echo bold("Nome: ").$payment['name']."</b><br>";
				    			echo bold("Cart. Identidade: ").$payment['id']."</b><br>";
				    			echo bold("PIS ou INSS: ").$payment['pisPasep']."</b><br>";
				    			echo bold("CPF: ").$payment['cpf']."</b><br>";
				    			echo bold("Matrícula: ").$payment['enrollmentNumber']."</b><br>";
				    			echo bold("Chegada ao Brasil: ").$payment['arrivalInBrazil']."</b><br>";
				    			echo bold("Telefone: ").$payment['phone']."</b><br>";
				    			echo bold("E-mail: ").$payment['email']."</b><br>";
				    			echo bold("Endereço: ").$payment['address']."</b><br>";
				    		echo "</td>";

				    		echo "<td>";
				    			echo bold("Tipo de Usuário: ").$payment['userType']."<br>";
				    			echo bold("Amparo Legal: ").$payment['legalSupport']."<br>";

				    			echo bold("Fonte de Recursos: ").$payment['resourseSource']."</b><br>";
				    			echo bold("Centro de Custo: ").$payment['costCenter']."</b><br>";
				    			echo bold("Nota de Dotação:").$payment['dotationNote']."</b><br>";
				    		echo "</td>";

				    		echo "<td>";
				    			echo bold("Denominação do projeto: ").$payment['projectDenomination']."</b><br>";
				    			echo bold("Banco: ").$payment['bank']."</b><br>";
				    			echo bold("Agência: ").$payment['agency']."</b><br>";
				    			echo bold("Conta: ").$payment['accountNumber']."</b><br>";

				    			echo bold("Valor total: ").$payment['totalValue']."</b><br>";
				    			echo bold("Período: ").$payment['period']." - ".$payment['end_period']."</b><br>";
				    			echo bold("Horas semanais: ").$payment['weekHours']."</b><br>";
				    			echo bold("Semanas: ").$payment['weeks']."</b><br>";
				    			echo bold("Total de horas: ").$payment['totalHours']."</b><br>";
				    			echo bold("Descrição do serviço: ").$payment['serviceDescription']."</b><br>";
				    		echo "</td>";

				    		echo "<td>";
				    			echo anchor(
				    				"payment/generateSpreadsheet/{$payment['id_payment']}",
				    				"<i class='fa fa-download'></i> Gerar planilha",
				    				"class='btn btn-success' style='margin-bottom:5%;'"
				    			);

				    			echo anchor(
				    				"payment/repayment/{$payment['id_payment']}/{$budgetplanId}/{$expenseId}",
				    				"<i class='fa fa-plus-square'></i> Novo Pagamento",
				    				"class='btn btn-info'"
				    			);
				    		echo "</td>";
						echo "</tr>";
			    	}
?>
			</tbody>
		</table>
		</div>

<?php
	}else{
?>

	<br>
	<br>
	<div class='callout callout-info'>
		<h4>Nenhum pagamento cadastrado para essa despesa no momento.</h4>
	</div>

<?php
	}
?>

<?php echo anchor("budgetplan/budgetplanExpenses/{$budgetplanId}", 'Voltar', "class='btn btn-danger'");?>
