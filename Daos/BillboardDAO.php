<?php namespace Daos;

  use \Exception as Exception;
  use Models\Movie as Movie;
  use Models\Billboard as Billboard;
  use Daos\Connection as Connection;
  use Daos\SaloonDAO as SaloonDAO;
  use Daos\MovieDAO as MovieDAO;
  use Daos\cinemaDAO as cinemaDAO;
  use Daos\FunctionDAO as FunctionDAO;

  class BillboardDAO{

    private $connection;
    private $tableName = "billboard";
    private $functionDAO;
    private $movieDAO;
    private $cinemaDAO;

    public function __construct() {
      $this->functionDAO = new FunctionDAO();
      $this->movieDAO = new MovieDAO();
      $this->cinemaDAO = new cinemaDAO();
  }

    /**
     * Funcion para agregar mediante un INSERT una pelicula a la base de datos.
     */
    public function Add($id_movie, $id_cinema, $id_saloon, $day, $hour) {
      $flag = false;
      try {
        $query = "INSERT INTO " . $this->tableName . "(id_movie, id_cinema) VALUES (:id_movie, :id_cinema);";

        $parameters = Array();
        $parameters["id_movie"] = $id_movie;
        $parameters["id_cinema"] = $id_cinema;

        $this->connection = Connection::GetInstance();

        $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
        $id_billboard = $this->connection->getPdo()->lastInsertId();
        if($rowCount > 0) {
          for($i = 0; $i < count($day); $i++) {
            $this->functionDAO->Add($day[$i], $hour[$i], $id_saloon[$i], $id_billboard);
          }
        }
        //$this->AddDate($bill->getDay(), $bill->getHour(), $bill->getSaloon(), $id);
        if($rowCount > 0)
          $flag = true;
      } catch(Exception $e) {
          //throw $e;
      }
      return $flag;
    }
    
  public function GetAll() {
    $query = "select b.id_movie as 'id_movie' , b.id_cinema as 'id_cinema' , b.id_billboard as 'id_billboard'
    from billboard as b;";
    $result = array();
      try {
          $this->connection = Connection::GetInstance();
          $resultSet = $this->connection->Execute($query);
          $billboardList = array();
          if(!empty($resultSet)) {
            $result = $this->mapear($resultSet);
          }
          
      } catch(Exception $e) {
          //throw $e;
      }
      return $result;
  }

  public function GetAllWithThisMovie($id_movie) {
    $query = "select b.id_movie as 'id_movie' , b.id_cinema as 'id_cinema' , b.id_billboard as 'id_billboard'
    from billboard as b where b.id_movie = :id_movie;";
    $result = array();
      try {
          $this->connection = Connection::GetInstance();

          $parameters = Array();
          $parameters['id_movie'] = $id_movie;

          $resultSet = $this->connection->Execute($query, $parameters);
          $billboardList = array();
          if(!empty($resultSet)) {
            $result = $this->mapear($resultSet);
          }
          
      } catch(Exception $e) {
          //throw $e;
      }
      return $result;
  }

  public function Delete($id_billboard) {
    $query = "DELETE FROM billboard WHERE (id_billboard = :id_billboard)";
    $flag = false;
    try {
      $this->connection = Connection::getInstance();

      $parameters = Array();
      $parameters['id_billboard'] = $id_billboard;

      $proof = $this->connection->ExecuteNonQuery($query, $parameters);
      if($proof > 0)
        $flag = true;
    } catch (PDOException $e) {
      //echo $e->getMessage();
    } catch(Exception $e){
      //echo $e->getMessage();
    }
    return $flag;
  }

  public function Update($id_cinema, $id_movie, $id_billboard) {

    $query = "UPDATE billboard as b SET b.id_cinema = :id_cinema, b.id_movie = :id_movie WHERE id_billboard = :id_billboard;";
    $flag = false;
    try {
      $this->connection = Connection::getInstance();

      $parameters = array();
      $parameters["id_cinema"] = $id_cinema;
      $parameters["id_movie"] = $id_movie;
      $parameters["id_billboard"] = $id_billboard;

      $rowCount = $this->connection->executeNonQuery($query, $parameters);

      if($rowCount == 1)
        $flag = true;
    }catch (PDOException $e) {
      //echo $e->getMessage();
    } catch(Exception $e){
        //echo $e->getMessage();
    }
    return $flag;
  }



  private function mapear($value) {
      $value = is_array($value) ? $value : [];
      $resp = array_map(function($p){
          return new Billboard($this->movieDAO->GetById($p['id_movie']), $this->cinemaDAO->GetById($p['id_cinema']), $p['id_billboard'], $this->functionDAO->GetFunctionsByBillboardId($p['id_billboard']));
      }, $value);
          return count($resp) > 1 ? $resp : $resp['0'];
  }

  }
