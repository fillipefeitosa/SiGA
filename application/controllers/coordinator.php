<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('program.php');

class Coordinator extends CI_Controller {

	private $COORDINATOR_GROUP = "coordenador";

	public function index() {
		
		loadTemplateSafelyByGroup($this->COORDINATOR_GROUP, "coordinator/coordinator_home");
	}

	public function coordinator_programs(){

		$session = $this->session->userdata("current_user");
		$userData = $session['user'];
		$coordinatorId = $userData['id'];

		$program = new Program();
		$coordinatorPrograms = $program->getCoordinatorPrograms($coordinatorId);
		
		$data = array(
			'coordinatorPrograms' => $coordinatorPrograms,
			'userData' => $userData,
			'programObject' => $program
		);

		loadTemplateSafelyByGroup($this->COORDINATOR_GROUP, "coordinator/coordinator_programs", $data);
	}

	public function program_evaluation_index($programId, $programEvaluationId){

		$this->load->model('program_evaluation_model', 'evaluation');

		$dimensionsTypes = $this->evaluation->getAllDimensionTypes();

		$program = new Program();

		$programData = $program->getProgramById($programId);
		$evaluation = $program->getProgramEvaluation($programEvaluationId);

		$data = array(
			'programData' => $programData,
			'programEvaluation' => $evaluation,
			'dimensionsTypes' => $dimensionsTypes
		);
		
		loadTemplateSafelyByGroup($this->COORDINATOR_GROUP, "program/program_evaluation_index", $data);
	}

	public function evaluationDimensionData($evaluationId, $dimensionType, $programId){

		$this->load->model('program_evaluation_model', 'evaluation');

		$dimensionData = $this->evaluation->getDimensionData($evaluationId, $dimensionType);
		$allDimensionsTypes = $this->evaluation->getAllDimensionTypes();

		// Find the dimension name
		if($allDimensionsTypes !== FALSE){
			foreach($allDimensionsTypes as $type){
				if($type['id_dimension_type'] == $dimensionType){
					$dimensionName = $type['dimension_type_name'];
					break;
				}
			}
		}else{
			$dimensionName = FALSE;
		}
		
		$evaluationDimensions = $this->evaluation->getEvaluationDimensions($evaluationId);

		if($evaluationDimensions !== FALSE){

			$weightsSum = 0;
			foreach($evaluationDimensions as $dimension){
				$weightsSum = $weightsSum + $dimension['weight'];
			}
		}else{
			$weightsSum = 0;
		}

		$program = new Program();		
		$evaluationData = $program->getProgramEvaluation($evaluationId);

		$data = array(
			'dimensionData' => $dimensionData,
			'evaluationData' => $evaluationData,
			'dimensionName' => $dimensionName,
			'programId' => $programId,
			'weightsSum' => $weightsSum
		);

		loadTemplateSafelyByGroup($this->COORDINATOR_GROUP, "program/program_evaluation_dimension", $data);	
	}

	public function disableDimension($evaluationId, $dimensionType, $dimensionId, $programId){

		$this->load->model('program_evaluation_model', 'evaluation');

		$wasDisabled = $this->evaluation->disableDimension($dimensionId);

		if($wasDisabled){
			$status = "success";
			$message = "Dimensão desativada com sucesso!";
		}else{
			$status = "danger";
			$message = "Ñão foi possível desativar a dimensão.";
		}

		$this->session->set_flashdata($status, $message);
		redirect("coordinator/evaluationDimensionData/{$evaluationId}/{$dimensionType}/{$programId}");
	}

	public function createProgramEvaluation($programId){

		$program = new Program();

		$programData = $program->getProgramById($programId);

		$data = array(
			'programData' => $programData
		);

		loadTemplateSafelyByGroup($this->COORDINATOR_GROUP, "coordinator/new_program_evaluation", $data);
	}

	public function newEvaluation(){

		$programId = $this->input->post('programId');
		$startYear = $this->input->post('evaluation_start_year');
		$endYear = $this->input->post('evaluation_end_year');

		$currentYear = getCurrentYear();

		$evaluation = array(
			'id_program' => $programId,
			'start_year' => $startYear,
			'end_year' => $endYear
		);

		if($currentYear !== FALSE){
			$evaluation['current_year'] = $currentYear;
		}

		$this->load->model('program_evaluation_model', 'evaluation');

		$evaluationId = $this->evaluation->saveProgramEvaluation($evaluation);

		if($evaluationId !== FALSE){

			$dimensionsOk = $this->initiateDimensionsToEvaluation($evaluationId);

			if($dimensionsOk){
				$status = "success";
				$message = "Avaliação salva com sucesso.";
			}else{
				$status = "danger";
				$message = "Ñão foi possível salvar algumas dimensões da avaliação. Tente novamente.";
			}

		}else{
			$status = "danger";
			$message = "Não foi possível salvar a avaliação. Tente novamente.";
		}

		$this->session->set_flashdata($status, $message);
		redirect('coordinator/coordinator_programs');
	}

	private function initiateDimensionsToEvaluation($evaluationId){

		$this->load->model('program_evaluation_model', 'evaluation');

		$dimensionsTypes = $this->evaluation->getAllDimensionTypes();

		if($dimensionsTypes !== FALSE){

			foreach($dimensionsTypes as $type){
				$this->evaluation->addDimensionTypeToEvaluation($evaluationId, $type['id_dimension_type'], $type['default_weight']);
			}

			$dimensionsSetted = $this->evaluation->checkIfHaveAllDimensions($evaluationId);
		}else{
			$dimensionsSetted = FALSE;
		}

		return $dimensionsSetted;
	}

	public function changeDimensionWeight(){

		$dimensionId = $this->input->post('dimensionId');
		$programEvaluationId = $this->input->post('programEvaluationId');
		$dimensionType = $this->input->post('dimensionType');
		$programId = $this->input->post('programId');
		$newWeight = $this->input->post('dimension_new_weight');
		
		$this->load->model('program_evaluation_model', 'evaluation');

		$wasChanged = $this->evaluation->updateDimensionWeight($dimensionId, $newWeight);

		if($wasChanged){
			$status = "success";
			$message = "Peso da dimensão alterado com sucesso.";
		}else{
			$status = "danger";
			$message = "Não foi possível alterar o peso da dimensão. Tente novamente.";
		}

		$this->session->set_flashdata($status, $message);
		redirect("coordinator/evaluationDimensionData/{$programEvaluationId}/{$dimensionType}/{$programId}");
	}

}