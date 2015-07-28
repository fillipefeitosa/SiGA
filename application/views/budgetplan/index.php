<h2 class="principal">Plano orçamentário</h2>

<div class="box-body table-responsive no-padding">
<table class="table table-bordered table-hover">
<tbody>
		
	<tr>
		<th class="text-center">P.O. cadastrados</th>
	<?php if($budgetplans): ?>
		<th class="text-center">Curso</th>
		<th class="text-center">Montante</th>
		<th class="text-center">Gastos</th>
		<th class="text-center">Saldo</th>
		<th class="text-center">Status</th>
		<th class="text-center">Ações</th>
	</tr>

	<?php $i=0; ?>
	<?php foreach ($budgetplans as $budgetplan): ?>
		<tr>
			<td class="text-center"><?=++$i?></td>
			<td class="text-center"><?=$budgetplan['course']?></td>
			<td class="text-center"><?=currencyBR($budgetplan['amount'])?></td>
			<td class="text-center"><?=currencyBR($budgetplan['spending'])?></td>
			<td class="text-center"><?=currencyBR($budgetplan['balance'])?></td>
			<td class="text-center"><?=$budgetplan['status']?></td>

			<td>
				<?= anchor("budgetplan/budgetplanExpenses/{$budgetplan['id']}", "<i class='fa fa-dollar'></i>", "class='btn btn-warning btn-editar btn-sm' style='margin-right:2%;'") ?>
				<?= anchor("planoorcamentario/{$budgetplan['id']}", "<i class='fa fa-edit'></i>", "class='btn btn-primary btn-editar btn-sm' style='margin-right:10%;'") ?>
				<?= form_open('/budgetplan/delete') ?>
					<?= form_hidden('budgetplan_id', $budgetplan['id']) ?>
					<button type="submit" class="btn btn-danger btn-remover btn-sm" style="margin: -20px auto auto 100px;">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
				<?= form_close() ?>
			</td>
		</tr>
	<?php endforeach ?>
	<?php else: ?>
		</tr>
		<tr>
			<td><h3><label class="label label-default"> Não existem planos orçamentários cadastrados</label></h3></td>
		</tr>
	<?php endif ?>
</tbody>
</table>
</div>

<div class="form-box-logged" id="login-box"> 
	<div class="header">Cadastrar um novo P.O.</div>

	<?= form_open("budgetplan/save") ?>
	<div class="body bg-gray">
		<div class="form-group">
			<?= form_label("Curso", "course") ?><br>
			<?= form_dropdown('course', $courses) ?>
		</div>

		<div class="form-group">
			<?= form_label('Montante inicial', 'amount') ?>
			<?= form_input(array(
				"name" => "amount",
				"id" => "amount",
				"type" => "number",
				"class" => "form-campo form-control",
				"required" => "required"
			)) ?>
		</div>

		<div class="form-group">	
			<?= form_label("Status", "status") ?><br>
			<?= form_dropdown('status', $status) ?>
		</div>

		<div class="footer body bg-gray">
			<?= form_button(array(
				"class" => "btn bg-olive btn-block",
				"type" => "sumbit",
				"content" => "Cadastrar"
			)) ?>
		</div>
	</div>
	<?= form_close() ?>
</div>

<script>
	$(document).ready(function() {
		$("#amount").inputmask("decimal", {
			radixPoint: ",",
			groupSeparator: ".",
			digits: 2,
			autoGroup: true,
			prefix: "R$"
		});
	});
</script>