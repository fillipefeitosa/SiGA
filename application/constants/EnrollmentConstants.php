<?php

require_once('constants.php');

class EnrollmentConstants extends Constants{
	
	const MIN_VACANCY_QUANTITY_TO_ENROLL = 1;
	
	// Request discipline status
	const NO_VACANCY_STATUS = "no_vacancy";
	const PRE_ENROLLED_STATUS = "pre_enrolled";
	const ENROLLED_STATUS = "enrolled";
	const REFUSED_STATUS = "refused";

	// Request general status
	const REQUEST_INCOMPLETE_STATUS = "incomplete";
	const REQUEST_ALL_APPROVED_STATUS = "all_approved";
	const REQUEST_ALL_REFUSED_STATUS = "all_refused";
	const REQUEST_PARTIALLY_APPROVED_STATUS = "partially_approved";

}