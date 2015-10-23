<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('course.php');
require_once('usuario.php');
require_once('module.php');
require_once(APPPATH."/constants/PermissionConstants.php");

class Secretary extends CI_Controller {

	public function courseTeachers($courseId){

		$course = new Course();
		$courseData = $course->getCourseById($courseId);

		$courseTeachers = $course->getCourseTeachers($courseId);

		$group = new Module();
		$foundGroup = $group->getGroupByName(GroupConstants::TEACHER_GROUP);

		if($foundGroup !== FALSE){
			$user = new Usuario();
			$teachers = $user->getUsersOfGroup($foundGroup['id_group']);

			if($teachers !== FALSE){

				$allTeachers = array();

				foreach($teachers as $teacher){
					$allTeachers[$teacher['id']] = $teacher['name'];
				}
			}else{
				$allTeachers = FALSE;
			}

		}else{
			$allTeachers = FALSE;
		}

		$data = array(
			'course' => $courseData,
			'teachers' => $courseTeachers,
			'allTeachers' => $allTeachers
		);

		loadTemplateSafelyByPermission(PermissionConstants::ENROLL_TEACHER_PERMISSION, 'secretary/course_teachers', $data);
	}

	public function enrollTeacherToCourse(){

		$courseId = $this->input->post('courseId');
		$teacherId = $this->input->post('teacher');

		$course = new Course();
		$wasEnrolled = $course->enrollTeacherToCourse($teacherId, $courseId);

		if($wasEnrolled){

			$status = "success";
			$message = "Docente vinculado ao curso com sucesso.";
		}else{
			$status = "danger";
			$message = "Não foi possível vincular o docente ao curso.";
		}

		$this->session->set_flashdata($status, $message);
		redirect("secretary/courseTeachers/{$courseId}");
	}

	public function removeTeacherFromCourse($teacherId, $courseId){

		$course = new Course();
		$wasRemoved = $course->removeTeacherFromCourse($teacherId, $courseId);

		if($wasRemoved){
			$status = "success";
			$message = "Docente removido do curso com sucesso.";
		}else{
			$status = "danger";
			$message = "Não foi possível remover o docente ao curso.";
		}

		$this->session->set_flashdata($status, $message);
		redirect("secretary/courseTeachers/{$courseId}");
	}
	
	public function saveResearchLine(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("researchLine", "Linha de Pesquisa", "required|trim|xss_clean|callback__alpha_dash_space");
		$this->form_validation->set_error_delimiters("<p class='alert-danger'>", "</p>");
		$success = $this->form_validation->run();
		
		if ($success) {
			$researchLine  = $this->input->post("researchLine");
			$researchCourse   = $this->input->post("research_course");
				
			$newResearchLine = array(
					'description'    => $researchLine,
					'id_course' => $researchCourse
			);
		
			$this->load->model("course_model");
		
			$wasSaved = $this->course_model->saveResearchLine($newResearchLine);
			if ($wasSaved){
				$status = "success";
				$message = "Linha de pesquisa salva do curso ".$course." com sucesso.";
			}else{
				$status = "danger";
				$message = "Não foi possível salvar o linha de pesquisa do curso ". $course;
			}
			
			$this->session->set_flashdata($status,$message);
			redirect("research_lines/");
		} else {
			$status = "danger";
			$message = "Não foi possível salvar o linha de pesquisa. Tente Novamente";
				
			$this->session->set_flashdata($status,$message);
			redirect("research_lines/");
			
		}
	}
	
	public function updateResearchLine(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("researchLine", "Linha de Pesquisa", "required|trim|xss_clean|callback__alpha_dash_space");
		$this->form_validation->set_error_delimiters("<p class='alert-danger'>", "</p>");
		$success = $this->form_validation->run();
	
		if ($success) {
			$researchLine  = $this->input->post("researchLine");
			$researchCourse   = $this->input->post("research_course");
			$researchLineId = $this->input->post("id_research_line");
			
			$updateResearchLine = array(
					'description'    => $researchLine,
					'id_course' => $researchCourse
			);
	
			$this->load->model("course_model");
	
			$wasSaved = $this->course_model->updateResearchLine($updateResearchLine, $researchLineId);
			if ($wasSaved){
				$status = "success";
				$message = "Linha de pesquisa alterada com sucesso.";
			}else{
				$status = "danger";
				$message = "Não foi possível alterar o linha de pesquisa.";
			}
				
			$this->session->set_flashdata($status,$message);
			redirect("research_lines/");
		} else {
			$status = "danger";
			$message = "Não foi possível alterar o linha de pesquisa. Tente Novamente";
	
			$this->session->set_flashdata($status,$message);
			redirect("research_lines/");
				
		}
	}
	
	public function removeCourseResearchLine($researchLineId,$course){
		
		$this->load->model("course_model");
		
		$wasRemoved = $this->course_model->removeCourseResearchLine($researchLineId);
		
		if($wasRemoved){
			$status = "success";
			$message = "Linha de pesquisa removida do curso ".$course." com sucesso.";
		}else{
			$status = "danger";
			$message = "Não foi possível remover o linha de pesquisa do curso ". $course;
		}
		
		$this->session->set_flashdata($status, $message);
		redirect("research_lines/");
		
	}

	public function defineTeacherSituation(){

		$courseId = $this->input->post('courseId');
		$teacherId = $this->input->post('teacherId');
		$situation = $this->input->post('situation');

		$course = new Course();
		$wasDefined = $course->defineTeacherSituation($courseId, $teacherId, $situation);

		if($wasDefined){
			$status = "success";
			$message = "Situação do docente definida com sucesso.";
		}else{
			$status = "danger";
			$message = "Não foi possível definir a situação do docente.";
		}

		$this->session->set_flashdata($status, $message);
		redirect("secretary/courseTeachers/{$courseId}");
	}
}

