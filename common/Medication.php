<?php
/**
 * Medication.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

require_once 'DBTable.php';
require_once 'DB.php';

class Medication extends DBTable {

  # GET QUERIES
  const QUERY_FROM_CLIENT = "SELECT * FROM Clients_Medications WHERE client_id = :client_id;";
  const QUERY_FROM_ID = "SELECT * FROM Clients_Medications WHERE id = :id LIMIT 1;";

  const QUERY_UPDATE = "UPDATE Clients_Medications SET 
  medication = :medication,
  dosage = :dosage,
  frequency = :frequency,
  time_taken = :time_taken,
  active = :active
  WHERE id = :id";

  protected $id,
    $client_id,
    $medication,
    $dosage,
    $frequency,
    $time_taken,
    $active;

  /**
   * @param int $client_id
   * @return Medication[]
   */
  public static function query_from_client( $client_id ) {
    return self::queryAll( self::QUERY_FROM_CLIENT, array( ':client_id' => $client_id ) );
  }


  /**
   * @param int $id
   * @return Medication|bool
   */
  public static function query_from_id( $id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':id' => $id ) );
  }

  /**
   * @param int $client_id
   * @param array $request
   * @return bool|Medication
   */
  static function insert( $client_id, $request ) {
    if ( isset( $request[ 'medication' ] ) ) {
      $medication = $request[ 'medication' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'dosage' ] ) ) {
      $dosage = $request[ 'dosage' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'frequency' ] ) ) {
      $frequency = $request[ 'frequency' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'time_taken' ] ) ) {
      $time_taken = $request[ 'time_taken' ];
    } else {
      return false;
    }

    return self::queryOne( "CALL insert_client_medication(:client_id, :medication, :dosage, :frequency, :time_taken);", array(
      ':client_id' => $client_id,
      ':medication' => $medication,
      ':dosage' => $dosage,
      ':frequency' => $frequency,
      ':time_taken' => $time_taken
    ) );
  }

  public function update() {
    try {
      $db = new DB();
      $stmt = $db->prepare( self::QUERY_UPDATE );
      $stmt->bindParam( ':medication', $this->medication, PDO::PARAM_STR );
      $stmt->bindParam( ':dosage', $this->dosage, PDO::PARAM_STR );
      $stmt->bindParam( ':frequency', $this->frequency, PDO::PARAM_STR );
      $stmt->bindParam( ':time_taken', $this->time_taken, PDO::PARAM_STR );
      $stmt->bindParam( ':active', $this->active, PDO::PARAM_BOOL);
      $stmt->bindParam( ':id', $this->id, PDO::PARAM_INT );
      return $stmt->execute();
    } catch ( PDOException $ex ) {
      die( $ex->getMessage() . PHP_EOL . $ex->getTraceAsString() );
    }
  }

  /**
   * @return int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return int
   */
  public function getClientId() {
    return $this->client_id;
  }

  /**
   * @param int $client_id
   */
  public function setClientId( $client_id ) {
    $this->client_id = $client_id;
  }

  /**
   * @return string
   */
  public function getMedication() {
    return $this->medication;
  }

  /**
   * @param string $medication
   */
  public function setMedication( $medication ) {
    $this->medication = $medication;
  }

  /**
   * @return string
   */
  public function getDosage() {
    return $this->dosage;
  }

  /**
   * @param string $dosage
   */
  public function setDosage( $dosage ) {
    $this->dosage = $dosage;
  }

  /**
   * @return string
   */
  public function getFrequency() {
    return $this->frequency;
  }

  /**
   * @param string $frequency
   */
  public function setFrequency( $frequency ) {
    $this->frequency = $frequency;
  }

  /**
   * @return string
   */
  public function getTimeTaken() {
    return $this->time_taken;
  }

  /**
   * @param string $time_taken
   */
  public function setTimeTaken( $time_taken ) {
    $this->time_taken = $time_taken;
  }

  /**
   * @return bool
   */
  public function isActive() {
    return $this->active;
  }

  /**
   * @param bool $active
   */
  public function setActive( $active ) {
    $this->active = $active;
  }
}