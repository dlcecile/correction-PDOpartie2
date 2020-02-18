<?php

require_once 'DataBase.php';

/**
 * Description of Appointment
 *
 * @author deleu
 */
class Appointment extends DataBase {

    /**
     * @var type string
     */
    public $dateHour;

    /**
     * @var type integer
     */
    public $idPatients;

    /**
     * Le constructeur de la classe patient
     */
    public function __construct($date_Hour = '', $id_Patients = '') {
        parent::__construct();
        $this->dateHour = $date_Hour;
        $this->idPatients = $id_Patients;
    }

    /**
     * 
     * @return boolean|$this
     */
    public function create() {
        // Le code pour créer un rendez vous.
        $query = "INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUE (:dateHour, :idPatients)";
        $sth = $this->db->prepare($query);
        $sth->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $sth->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($sth->execute()) {
            return $this;
        }
        return false;
    }

    /**
     * cette methode permet de recuperer tous les rendez-vous de tous les patients
     * @return type array
     */
    public function getAll() {
        $sql = 'SELECT `idPatients`, DATE_FORMAT(`dateHour`, "%d/%m/%Y %H:%i") AS `dateHour` ,`patients`.`lastname`, `patients`.`firstname`, DATE_FORMAT(`patients`.`birthdate`, "%d/%m/%Y") AS birthdate, `patients`.`phone`, `patients`.`mail` FROM `appointments`INNER JOIN `patients` ON `appointments`. `idPatients` = `patients` . `id` WHERE `appointments`.`idPatients` = :id';
        $appointmentsList = [];
        $sth = $this->db->query($sql);
        if ($sth instanceOf PDOStatement) {
            // Collection des données dans un tableau associatif (FETCH_ASSOC)
            $appointmentsList = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        return $appointmentsList;
    }

    /**
     * cette methode permet de recupérer tous les rendez vous d'un patient dans la table appointment s'ils existent.
     * @return boolean|$this
     */
    public function getPatientAppointments() {
        //Le code permettant de récupèrer les rendez vous d'un patient
        $sql = 'SELECT  DATE_FORMAT(`dateHour`, "%d/%m/%Y %H:%i") AS `dateHour` FROM `appointments` WHERE `appointments`.`idPatients` = :id';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id', $this->id, PDO::PARAM_INT);
        //Initialisation du tableau
        $appointmentsList = [];
        //Si l'excute se passe bien
        if ($sth->execute()) {//hydrate la fonction, lui attribut des nouvelles valeurs
            if ($sth instanceOf PDOStatement) {
                // Collection des données dans un tableau associatif (FETCH_ASSOC)
                $appointmentsList = $sth->fetchAll(PDO::FETCH_ASSOC);
            }
          
        }
        return $appointmentsList;
    }
  public function delete() {
        //Le code pour supprimer un rendez-vous
    }
/** 
 * Methode permettant de mettre à jour les informations d'un rendez vous
 * @return boolean|$this
 */
    public function update() {
        $sql = 'UPDATE `appointments` SET `dateHour`= :dateHour, `idPatients`= :idPatients  WHERE `idPatients` = :id';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $sth->bindValue(':idPatients', $this->idPatients, PDO::PARAM_STR);
        if ($sth->execute()) {
            return $this;
        }
        return false;
    }
}
