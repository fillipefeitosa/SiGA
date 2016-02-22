
<?php
require_once(APPPATH."/constants/TeacherConstants.php");

function bold($string){
	return "<b>".$string."</b>";
}

function searchForDisciplineByNameForm($syllabusId, $courseId){

	$discipline = array(
		"name" => "discipline_to_search",
		"id" => "discipline_to_search",
		"type" => "text",
		"class" => "form-campo form-control",
		"placeholder" => "Informe o nome da disciplina...",
		"maxlength" => "50",
		'style' => "width:80%;"
	);

	$searchForDisciplineBtn = array(
		"id" => "search_student_request_btn",
		"class" => "btn bg-primary btn-flat",
		"content" => "Pesquisar por nome da disciplina",
		"type" => "submit"
	);

	define("SEARCH_BY_NAME", "by_name");

	echo "<h4><i class='fa fa-search'></i> Pesquisar por nome da disciplina</h4>";
	echo form_open("syllabus/searchForDiscipline");
		echo form_hidden('searchType', SEARCH_BY_NAME);
		echo form_hidden('syllabusId', $syllabusId);
		echo form_hidden('courseId', $courseId);

		echo "<div class='form-group'>";
			echo form_label("Informe o nome da disciplina para pesquisar:", "discipline_to_search");
			echo form_input($discipline);
		echo "</div>";

		echo form_button($searchForDisciplineBtn);
	echo form_close();
}

function searchForDisciplineByIdForm($syllabusId, $courseId){

	$discipline = array(
		"name" => "discipline_to_search",
		"id" => "discipline_to_search",
		"type" => "text",
		"class" => "form-campo form-control",
		"placeholder" => "Informe o código da disciplina...",
		"maxlength" => "10",
		'style' => "width:80%;"
	);

	$searchForDisciplineBtn = array(
		"id" => "search_student_request_btn",
		"class" => "btn bg-primary btn-flat",
		"content" => "Pesquisar por código da disciplina",
		"type" => "submit"
	);

	define("SEARCH_BY_ID", "by_id");

	echo "<h4><i class='fa fa-search'></i> Pesquisar por código da disciplina</h4>";
	echo form_open("syllabus/searchForDiscipline");
		echo form_hidden('searchType', SEARCH_BY_ID);
		echo form_hidden('syllabusId', $syllabusId);
		echo form_hidden('courseId', $courseId);

		echo "<div class='form-group'>";
			echo form_label("Informe o código da disciplina para pesquisar:", "discipline_to_search");
			echo form_input($discipline);
		echo "</div>";

		echo form_button($searchForDisciplineBtn);
	echo form_close();
}

function searchForStudentRequestByIdForm($courseId){

	$student = array(
		"name" => "student_identifier",
		"id" => "student_identifier",
		"type" => "text",
		"class" => "form-campo",
		"class" => "form-control",
		"placeholder" => "Informe a matrícula do aluno...",
		"maxlength" => "50",
		'style' => "width:80%;"
	);

	$searchForStudentBtn = array(
		"id" => "search_student_request_btn",
		"class" => "btn bg-primary btn-flat",
		"content" => "Pesquisar por matrícula",
		"type" => "submit"
	);

	define("SEARCH_BY_ID", "by_id");

	echo "<h4><i class='fa fa-search'></i> Pesquisar por matrícula do aluno</h4>";
	echo form_open("request/searchForStudentRequest");
		echo form_hidden('searchType', SEARCH_BY_ID);
		echo form_hidden('courseId', $courseId);

		echo "<div class='form-group'>";
			echo form_label("Informe a matrícula do aluno para pesquisar:", "student_identifier");
			echo form_input($student);
		echo "</div>";

		echo form_button($searchForStudentBtn);
	echo form_close();
}

function searchForStudentRequestByNameForm($courseId){

	$student = array(
		"name" => "student_identifier",
		"id" => "student_identifier",
		"type" => "text",
		"class" => "form-campo",
		"class" => "form-control",
		"placeholder" => "Informe o nome do aluno...",
		"maxlength" => "50",
		'style' => "width:80%;"
	);

	$searchForStudentBtn = array(
		"id" => "search_student_request_btn",
		"class" => "btn bg-primary btn-flat",
		"content" => "Pesquisar por nome",
		"type" => "submit"
	);

	define("SEARCH_BY_NAME", "by_name");

	echo "<h4><i class='fa fa-search'></i> Pesquisar por nome do aluno</h4>";
	echo form_open("request/searchForStudentRequest");
		echo form_hidden('searchType', SEARCH_BY_NAME);
		echo form_hidden('courseId', $courseId);

		echo "<div class='form-group'>";
			echo form_label("Informe o nome do aluno para pesquisar:", "student_identifier");
			echo form_input($student);
		echo "</div>";

		echo form_button($searchForStudentBtn);
	echo form_close();
}

function displayEnrollStudentForm(){

	$studentName = array(
		"name" => "student_name",
		"id" => "student_name",
		"type" => "text",
		"class" => "form-campo",
		"class" => "form-control",
		"maxlength" => "50",
		'style' => "width:40%;"
	);

	$searchForStudentBtn = array(
		"id" => "search_student_btn",
		"class" => "btn bg-olive btn-block",
		"content" => "Procurar por aluno",
		"type" => "submit",
		'style' => "width:15%;"
	);

	echo form_label("Informe o nome do usuário para matricular nesse curso:");
	echo form_input($studentName);

	echo form_button($searchForStudentBtn);
}

function displayEnrollMastermindToStudentForm($students, $masterminds, $courseId){

	$submitBtn = array(
		"class" => "btn bg-olive btn-block",
		"content" => "Relacionar",
		"type" => "submit"
	);

	if($students === FALSE){
		$thereIsNoStudents = TRUE;
		$students = array("Nenhum aluno neste curso.");
		$submitBtn['disabled'] = TRUE;
	}else{
		$thereIsNoStudents = FALSE;
	}

	if($masterminds === FALSE){
		$thereIsNoMasterminds = TRUE;
		$masterminds = array("Nenhum orientador cadastrado.");
		$submitBtn['disabled'] = TRUE;
	}else{
		$thereIsNoMasterminds = FALSE;
	}

	echo "<div class='form-box' id='login-box'>";
		echo "<div class='header'>Relacionar Orientador a Aluno</div>";

		echo form_open('mastermind/saveMastermindToStudent','',array('courseId'=>$courseId));
		echo "<div class='body bg-gray'>";
			echo "<div class='form-group'>";
				echo form_label("Aluno do curso", "course_student") . "<br>";
				echo form_dropdown("course_student", $students, '', "id='course_student'");
				echo form_error("course_student");
				echo "<br>";
				echo "<br>";
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Orientador para este aluno", "student_mastermind") . "<br>";
				echo form_dropdown("student_mastermind", $masterminds, '', "id='student_mastermind'");
				echo form_error("student_mastermind");
				echo "<br>";
				echo "<br>";
			echo "</div>";
		echo "</div>";
		echo "<div class='footer body bg-gray'>";
			echo form_button($submitBtn);
		echo "</div>";

		if($thereIsNoStudents){
			echo "<div class='callout callout-danger'>";
				echo "<h4>Não é possível relacionar orientadores sem alunos.</h4>";
			echo "</div>";
		}
		if($thereIsNoMasterminds){
			echo "<div class='callout callout-danger'>";
				echo "<h4>Não é possível relacionar orientadores sem orientadores.</h4>";
			echo "</div>";
		}

		echo form_close();
	echo "</div>";

}

function mastermindMessageForm($requestId, $mastermindId, $isFinalized, $mastermindMessage = ""){

	$hidden = array(
		'requestId' => $requestId,
		'mastermindId' => $mastermindId
	);

	$message = array(
		'name' => 'mastermind_message',
		'id' => 'mastermind_message',
		'placeholder' => 'Deixe aqui sua mensagem para o aluno.',
		'rows' => '20',
		"class" => "form-control",
		'style' => 'height: 70px; margin-top:-10%;'
	);

	if($isFinalized){

		$message['value'] = $mastermindMessage;

		$submitBtn = array(
			"class" => "btn btn-warning btn-flat",
			"content" => "Alterar mensagem",
			"type" => "submit"
		);

	}else{
		$submitBtn = array(
			"class" => "btn btn-primary btn-flat",
			"content" => "Finalizar solicitação",
			"type" => "submit"
		);
	}

	echo form_open('mastermind/finalizeRequest','',$hidden);
	echo form_label('Mensagem:', 'mastermind_message');
	echo "<br>";
	echo "<br>";
	echo form_textarea($message);
	echo form_button($submitBtn);
	echo form_close();
}

function displayFormUpdateStudentBasicInformation($idUser){
	$user = new Usuario();

	$studentData = $user->getStudentBasicInformation($idUser);
	$hidden = array('student_registration' => $idUser, 'id_user' => $idUser);

	if($studentData){
		echo "<h4>Mantenha-nos atualizados:</h4>";
		echo "<div class='form-box' id='login-box'>";
			echo "<div class='header'>Informações Básicas</div>";
			updateStudentBasicInformationForm($studentData,$hidden);
	}else{
		echo "<h4>Cadastre aqui seus dados:</h4>";
		echo "<div class='form-box' id='login-box'>";
			echo "<div class='header'>Informações Básicas</div>";
			saveStudentBasicInformationForm($hidden);
	}

	echo "</div>";
}

function saveStudentBasicInformationForm($hidden){

	$emailLabel = array(
			"name" => "email",
			"id" => "email",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "30"
	);

	$cellPonheLabel = array(
			"name" => "cell_phone_number",
			"id" => "cell_phone_number",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "9"
	);

	$homePonheLabel = array(
			"name" => "home_phone_number",
			"id" => "home_phone_number",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "9"
	);

	$submit_button_array_to_form = array(
			"class" => "btn btn-success btn-block ",
			"content" => "Aprovar",
			"type" => "submit"
	);

	echo form_open('usuario/saveStudentBasicInformation','',$hidden);
	echo "<div class='body bg-gray'>";
	echo "<div class='form-group'>";
	echo form_label("Email", "email") . "<br>";
	echo form_input($emailLabel);
	echo form_error("email");
	echo "<br>";
	echo "<br>";
	echo "</div>";
	echo "<div class='form-group'>";
	echo form_label("Telefone Residencial", "home_phone_number") . "<br>";
	echo form_input($homePonheLabel);
	echo form_error("home_phone_number");
	echo "<br>";
	echo "<br>";
	echo "</div>";
	echo "<div class='form-group'>";
	echo form_label("Telefone Celular", "cell_phone_number") . "<br>";
	echo form_input($cellPonheLabel);
	echo form_error("cell_phone_number");
	echo "<br>";
	echo "<br>";
	echo "</div>";
	echo "</div>";
	echo "<div class='footer'>";
	echo form_button($submit_button_array_to_form);
	echo "</div>";
	echo form_close();


}


function updateStudentBasicInformationForm($studentData,$hidden){

	$emailLabel = array(
			"name" => "email",
			"id" => "email",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "30",
			"value" => $studentData['email']
	);

	$cellPonheLabel = array(
			"name" => "cell_phone_number",
			"id" => "cell_phone_number",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "9",
			"value" => $studentData['cell_phone_number']
	);

	$homePonheLabel = array(
			"name" => "home_phone_number",
			"id" => "home_phone_number",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "9",
			"value" => $studentData['home_phone_number']
	);

	$submit_button_array_to_form = array(
			"class" => "btn btn-success btn-block ",
			"content" => "Aprovar",
			"type" => "submit"
	);

	echo form_open('usuario/updateStudentBasicInformation','', $hidden);
	echo "<div class='body bg-gray'>";
	echo "<div class='form-group'>";
	echo form_label("Email", "email") . "<br>";
	echo form_input($emailLabel);
	echo form_error("email");
	echo "<br>";
	echo "<br>";
	echo "</div>";
	echo "<div class='form-group'>";
	echo form_label("Telefone Residencial", "home_phone_number") . "<br>";
	echo form_input($homePonheLabel);
	echo form_error("home_phone_number");
	echo "<br>";
	echo "<br>";
	echo "</div>";
	echo "<div class='form-group'>";
	echo form_label("Telefone Celular", "cell_phone_number") . "<br>";
	echo form_input($cellPonheLabel);
	echo form_error("cell_phone_number");
	echo "<br>";
	echo "<br>";
	echo "</div>";
	echo "</div>";
	echo "<div class='footer'>";
	echo form_button($submit_button_array_to_form);
	echo "</div>";
	echo form_close();


}

function formToEnrollTeacherToCourse($courseTeachers, $teachers, $courseId){

	$submitBtn = array(
		"class" => "btn bg-olive btn-block",
		"type" => "submit",
		"content" => "Vincular docente"
	);

	if($teachers !== FALSE){

		$thereIsTeachers = TRUE;

		// Just a copy of the array '$teachers'
		$t = $teachers;

		if($courseTeachers !== FALSE){

			foreach($t as $userId => $teacher){
				foreach($courseTeachers as $courseTeacher){
					if($courseTeacher['id_user'] == $userId){

						unset($teachers[$userId]);

						if(sizeof($teachers) === 0){
							$submitBtn['disabled'] = TRUE;
							$teachers = array("Docentes do sistema já vinculados ao curso");
						}
					}
				}
			}
		}

	}else{
		$thereIsTeachers = FALSE;
		$submitBtn['disabled'] = TRUE;
		$teachers = array('Nenhum docente cadastrado.');
	}

	echo form_open("secretary/enrollTeacherToCourse");
		echo form_hidden('courseId', $courseId);
		echo "<div class='form-box'>";
			echo"<div class='header'>Vincular docente ao curso</div>";
			echo "<div class='body bg-gray'>";

				echo "<div class='form-group'>";
					echo form_label("Docente:", "teacher");
						echo form_dropdown("teacher", $teachers, '', "class='form-control'");
					echo form_error("teacher");
				echo "</div>";

			echo "</div>";
			echo "<div class='footer bg-gray'>";
				echo form_button($submitBtn);
			echo "</div>";

			if(!$thereIsTeachers){
				echo "<div class='callout callout-danger'>";
					echo "<h4>Não há docentes cadastrados no sistema.</h4>";
				echo "</div>";
			}
		echo "</div>";

	echo form_close();
}

function formToDefineTeacherSituation($teacherId, $courseId, $oldSituation){

	$submitBtn = array(
		"class" => "btn btn-primary btn-flat",
		"type" => "submit",
		"content" => "Definir situação"
	);

	$teacherConstants = new TeacherConstants();
	$situations = $teacherConstants->getSituations();

	echo form_open("secretary/defineTeacherSituation");
		echo form_hidden("teacherId", $teacherId);
		echo form_hidden("courseId", $courseId);

		if($oldSituation !== FALSE){
			echo form_label("Atualizar situação do docente:", "situation");
			echo form_dropdown("situation", $situations, $oldSituation, "class='form-control'");
		}else{
			echo form_label("Situação do docente:", "situation");
			echo form_dropdown("situation", $situations, '', "class='form-control'");
		}
		echo form_error("situation");

		echo form_button($submitBtn);
	echo form_close();
}

function formToNewOfferDisciplineClass($idDiscipline, $idOffer, $teachers, $idCourse){

	$disciplineClass = array(
		"name" => "disciplineClass",
		"id" => "disciplineClass",
		"type" => "text",
		"class" => "form-campo",
		"class" => "form-control",
		"maxlength" => "3"
	);

	$totalVacancies = array(
		"name" => "totalVacancies",
		"id" => "totalVacancies",
		"type" => "number",
		"class" => "form-campo",
		"class" => "form-control",
		"min" => "0",
		"value" => "0"
	);

	$submitBtn = array(
		"class" => "btn bg-olive btn-block",
		"type" => "submit",
		"content" => "Cadastrar turma"
	);

	echo form_open("offer/newOfferDisciplineClass/{$idDiscipline}/{$idOffer}/{$idCourse}");

		echo "<div class='form-box'>";
			echo"<div class='header'>Nova turma para oferta</div>";
			echo "<div class='body bg-gray'>";

				echo "<div class='form-group'>";
					echo form_label("Turma", "disciplineClass");
					echo form_input($disciplineClass);
					echo form_error("disciplineClass");
				echo "</div>";

				echo "<div class='form-group'>";
					echo form_label("Vagas totais", "totalVacancies");
					echo form_input($totalVacancies);
					echo form_error("disciplineClass");
				echo "</div>";

				echo "<div class='form-group'>";
					echo form_label("Professor principal", "mainTeacher");
					if($teachers !== FALSE){
						echo form_dropdown("mainTeacher", $teachers, '', "class='form-control'");
					}else{
						$submitBtn['disabled'] = TRUE;
						echo form_dropdown("mainTeacher", array('Nenhum professor cadastrado.'), '', "class='form-control'");
					}
					echo form_error("mainTeacher");
				echo "</div>";

				echo "<div class='form-group'>";
					echo form_label("Professor secundário", "secondaryTeacher");
					if($teachers !== FALSE){
						define("NONE_TEACHER", 0);
						$teachers[NONE_TEACHER] = "Nenhum";
						echo form_dropdown("secondaryTeacher", $teachers, NONE_TEACHER, "class='form-control'");
					}else{
						echo form_dropdown("secondaryTeacher", array('Nenhum professor cadastrado.'), '', "class='form-control'");
					}
					echo form_error("secondaryTeacher");
				echo "</div>";

			echo "</div>";
			echo "<div class='footer bg-gray'>";
				echo form_button($submitBtn);
			echo "</div>";
		echo "</div>";

	echo form_close();

	if($teachers === FALSE){

		echo "<div class='callout callout-danger'>";
			echo "<h4>Não é possível cadastrar uma turma para oferta sem um professor principal.</h4>";
			echo "<p>Contate o administrador.</p>";
		echo "</div>";
	}
}

function createResearchLineForm($courses){

	$submitBtn = array(
			"class" => "btn bg-olive btn-block",
			"content" => "Salvar",
			"type" => "submit"
	);

	$researchLine = array(
			"name" => "researchLine",
			"id" => "researchLine",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "80"
	);


	echo "<div class='form-box' id='login-box'>";
		echo "<div class='header'>Cadastrar nova Linha de Pesquisa</div>";

		echo form_open('secretary/saveResearchLine','');
		echo "<div class='body bg-gray'>";
			echo "<div class='form-group'>";
			echo form_label("Linha de Pesquisa", "research_line");
				echo form_input($researchLine);
			echo form_error("research_line");
		echo "</div>";
		echo "<div class='form-group'>";
			echo form_label("Curso da Linha de Pesquisa", "research_course");
			echo form_dropdown("research_course", $courses, '', "id='research_course'");
			echo form_error("research_course");
		echo "</div>";
	echo "</div>";

	echo "<div class='footer body bg-gray'>";
		echo form_button($submitBtn);
	echo "</div>";

	echo form_close();
	echo "</div>";
}

function updateResearchLineForm($researchId, $description, $actualCourseForm, $courses){


	$submitBtn = array(
			"class" => "btn bg-olive btn-block",
			"content" => "Salvar",
			"type" => "submit"
	);

	$researchLine = array(
			"name" => "researchLine",
			"id" => "researchLine",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "80",
			"value" => $description
	);

	$hidden = array('id_research_line'=>$researchId);

	echo "<div class='form-box' id='login-box'>";
		echo "<div class='header'>Cadastrar nova Linha de Pesquisa</div>";

		echo form_open('secretary/updateResearchLine','',$hidden);
		echo "<div class='body bg-gray'>";
			echo "<div class='form-group'>";
				echo form_label("Linha de Pesquisa", "research_line");
				echo form_input($researchLine);
				echo form_error("research_line");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Curso da Linha de Pesquisa", "research_course");
				echo form_dropdown("research_course", $courses, $actualCourseForm, "id='research_course'");
				echo form_error("research_course");
		echo "</div>";
	echo "</div>";

	echo "<div class='footer body bg-gray'>";
	echo form_button($submitBtn);
	echo "</div>";

	echo form_close();
	echo "</div>";
}

function relateDisciplineToResearchLineForm($researchLines, $discipline, $syllabusId, $courseId){

	$submitBtn = array(
			"class" => "btn bg-olive btn-block",
			"content" => "Salvar",
			"type" => "submit"
	);

	$thereIsNoResearchLines = sizeof($researchLines) == 1;
	if($thereIsNoResearchLines){
		$submitBtn['disabled'] = TRUE;
	}

	$hidden = array(
			'discipline_code'=>$discipline['discipline_code'],
			'syllabusId' => $syllabusId,
			'courseId' => $courseId
	);

			echo "<div class='form-box' id='login-box'>";
				echo "<div class='header'>Cadastrar nova Linha de Pesquisa</div>";

				echo form_open('syllabus/saveDisciplineResearchLine','',$hidden);
				echo "<div class='body bg-gray'>";
					echo "<div class='form-group'>";
						echo $discipline['discipline_code']." - ".$discipline['discipline_name']." (".$discipline['name_abbreviation'].")";
					echo "</div>";
					echo "<div class='form-group'>";
						echo form_label("Linha de Pesquisa da Disciplina", "research_line");
						echo form_dropdown("research_line", $researchLines, "id='research_line'");
						echo form_error("research_line");
					echo "</div>";
			echo "</div>";

			echo "<div class='footer body bg-gray'>";
				echo form_button($submitBtn);
			echo "</div>";

			echo form_close();

}

function loadStaffRegistrationForm($users){

	/**
	 *	New staff Labels
	 */
	$submitBtn = array(
			"class" => "btn bg-olive btn-block",
			"content" => "Salvar",
			"type" => "submit"
	);

	$pisNumber = array(
			"name" => "pis",
			"id" => "pis",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "20"
	);

	$registration = array(
			"name" => "registration",
			"id" => "registration",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "10",
			"placeholder" => "Opcional",
			"value" => NULL
	);

	$landingDate = array(
			"name" => "landingDate",
			"id" => "arrivalInBrazil",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"placeholder" => "Opcional",
			"value" => NULL
	);

	$address = array(
			"name" => "address",
			"id" => "address",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "50"
	);

	$phone = array(
			"name" => "telephone",
			"id" => "telephone",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "15"
	);

	/**
	 *	Bank labels
	 */

	$bank = array(
			"name" => "bank",
			"id" => "bank",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "25",
			"value" => NULL
	);

	$agency = array(
			"name" => "agency",
			"id" => "agency",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "10",
			"value" => NULL
	);

	$checkingAccount = array(
			"name" => "accountNumber",
			"id" => "accountNumber",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "15",
			"value" => NULL
	);

	echo "<div class='form-box' id='login-box'>";
		echo "<div class='header'>Cadastrar novo Funcionário</div>";

		echo form_open('staff/newStaff','');
		echo "<div class='body bg-gray'>";
			echo "<div class='form-group'>";
				echo form_label("PIS/INSS", "pis_number");
				echo form_input($pisNumber);
				echo form_error("pis_number");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Selecione o Funcionário", "staff");
				echo form_dropdown("staff", $users, "id='staff'");
				echo form_error("staff");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Matrícula", "registration");
				echo form_input($registration);
				echo form_error("registration");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Chegada ao Brasil", "landingDate");
				echo form_input($landingDate);
				echo form_error("landingDate");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Endereço", "address");
				echo form_input($address);
				echo form_error("address");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Telefone", "telephone");
				echo form_input($phone);
				echo form_error("telephone");
			echo "</div>";

			echo "<hr>";
			echo "<h3>Dados Bancários</h3> (Opcionais)";

			echo "<div class='form-group'>";
				echo form_label("Banco", "bank");
				echo form_input($bank);
				echo form_error("bank");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Agência", "agency");
				echo form_input($agency);
				echo form_error("agency");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Conta Corrente", "accountNumber");
				echo form_input($checkingAccount);
				echo form_error("accountNumber");
			echo "</div>";

		echo "</div>";

		echo "<div class='footer body bg-gray'>";
		echo form_button($submitBtn);
		echo "</div>";

		echo form_close();
	echo "</div>";

}

function loadStaffEditForm($staff, $staffUserData){
	/**
	 *	Staff Labels
	 */
	$submitBtn = array(
			"class" => "btn bg-olive btn-block",
			"content" => "Salvar",
			"type" => "submit"
	);

	$pisNumber = array(
			"name" => "pis",
			"id" => "pis",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "20",
			"value" => $staff['pisPasep']
	);

	$registration = array(
			"name" => "registration",
			"id" => "registration",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "10",
			"placeholder" => "Opcional",
			"value" => $staff['registration']
	);

	$landingDate = array(
			"name" => "landingDate",
			"id" => "arrivalInBrazil",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"placeholder" => "Opcional",
			"value" => $staff['brazil_landing']
	);

	$address = array(
			"name" => "address",
			"id" => "address",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "50",
			"value" => $staff['address']
	);

	$phone = array(
			"name" => "telephone",
			"id" => "telephone",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "15",
			"value" => $staff['telephone']
	);

	/**
	 *	Bank labels
	 */

	$bank = array(
			"name" => "bank",
			"id" => "bank",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "25",
			"value" => $staff['bank']
	);

	$agency = array(
			"name" => "agency",
			"id" => "agency",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "10",
			"value" => $staff['agency']
	);

	$checkingAccount = array(
			"name" => "accountNumber",
			"id" => "accountNumber",
			"type" => "text",
			"class" => "form-campo",
			"class" => "form-control",
			"maxlength" => "15",
			"value" => $staff['account_number']
	);

	$hidden = array('user_id' => $staffUserData['id'], 'staff_id'=>$staff['id_staff']);

	echo "<div class='form-box' id='login-box'>";
		echo "<div class='header'> Alterar dados de Funcionário</div>";

		echo form_open('staff/updateStaff','',$hidden);
		echo "<div class='body bg-gray'>";
			echo "<div class='form-group'>";
				echo form_label("PIS/INSS", "pis_number");
				echo form_input($pisNumber);
				echo form_error("pis_number");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Nome do Funcionário", "staff");
				echo "<h4>".$staffUserData['name']."</h4>";
				echo form_error("staff");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Matrícula", "registration");
				echo form_input($registration);
				echo form_error("registration");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Chegada ao Brasil", "landingDate");
				echo form_input($landingDate);
				echo form_error("landingDate");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Endereço", "address");
				echo form_input($address);
				echo form_error("address");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Telefone", "telephone");
				echo form_input($phone);
				echo form_error("telephone");
			echo "</div>";

			echo "<hr>";
			echo "<h3>Dados Bancários</h3> (Opcionais)";

			echo "<div class='form-group'>";
				echo form_label("Banco", "bank");
				echo form_input($bank);
				echo form_error("bank");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Agência", "agency");
				echo form_input($agency);
				echo form_error("agency");
			echo "</div>";
			echo "<div class='form-group'>";
				echo form_label("Conta Corrente", "accountNumber");
				echo form_input($checkingAccount);
				echo form_error("accountNumber");
			echo "</div>";

		echo "</div>";

		echo "<div class='footer body bg-gray'>";
		echo form_button($submitBtn);
		echo "</div>";

		echo form_close();
	echo "</div>";
}

function emptyDiv(){
	echo "";
}