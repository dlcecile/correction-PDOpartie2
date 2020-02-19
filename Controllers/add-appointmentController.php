<?php

require_once '../Models/Patient.php';
require_once '../Models/Appointment.php';
//on recupére les données via axios
$data = json_decode(file_get_contents('php://input', true));
//on verifie que cela n'est pas nul
if (!empty($data)) {
    if (isset($data->search)) {
        $patient = new Patient();
        $search = filter_var($data->search, FILTER_SANITIZE_STRING);
        $patientsList = $patient->findPatient($search);
//on retourne la liste des patients correspondant sous format json
        exit(json_encode($patientsList, JSON_UNESCAPED_UNICODE));
    }
}
require_once '../Views/add-appointment.php';
