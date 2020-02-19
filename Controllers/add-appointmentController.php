<?php
require_once '../Models/Patient.php';
require_once '../Models/Appointment.php';
$patient = new Patient();
$patientsList = $patient->getAll();
require_once '../Views/add-appointment.php';
