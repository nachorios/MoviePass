<?php namespace Daos;

    use \PDO as PDO;
    use \Exception as Exception;
    use Daos\QueryType as QueryType;

    class Connection {
        private $pdo = null;
        private $pdoStatement = null;
        private static $instance = null;
    

        /**
         * Inicializamos el objeto PDO.
         */
        private function __construct() {
            
            try{
                $this->pdo = $this->getPDOConnection(DB_HOST,DB_NAME,DB_USER,DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(Exception $e) {
                throw $e;
            }
        }

        /**
         * instancia PDO con los valores entregados por parametros.
         */
        private function GetPDOConnection($dbHost, $dbName, $dbUser, $dbPass) {
            return new PDO("mysql:host=".$dbHost."; dbname=".$dbName, $dbUser, $dbPass);
        }

        /**
         * Instancia la Connection siempre y cuando no se encuentre ya instanciada.
         */
        public static function GetInstance() {
            if(self::$instance == null) {
                self::$instance = new Connection();
            }
            return self::$instance;
        }

        /**
         * Ejecuta una query SQL de tipo SELECT, recibe parámetros (opcional) y un $queryType. Retorna una matriz de resultados
         */
        public function Execute($query, $parameters = array(), $queryType = QueryType::Query) {
            try{
                
                $this->Prepare($query);

                $this->BindParameters($parameters, $queryType);

                $this->pdoStatement->execute();

                return $this->pdoStatement->fetchAll();

            } catch(Exception $e) {
                throw $e;
            }
        }

        /**
         * Ejecuta una query SQL de tipo INSERT, UPDATE, DELETE, recibe parámetros (opcional) y un $queryType. Retorna la cantidad de filas afectadas
         */
        public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::Query) {
            try{

                $this->Prepare($query);

                $this->BindParameters($parameters, $queryType);

                $this->pdoStatement->execute();

                return $this->pdoStatement->rowCount();

            } catch(Exception $e) {
                throw $e;
            }
        }

        /**
         * método privado que ejecuta un prepare interno de PDO para preparar la consulta a ejecutar.
         */
        private function Prepare($query) {
            try{
                $this->pdoStatement = $this->pdo->prepare($query);
            } catch(Exception $e) {
                throw $e;
            }
        }

        /**
         * Dependiendo el $queryType realiza el armado de los parámetros que serán enviados en la query
         */
        private function BindParameters($parameters = array(), $queryType = QueryType::Query) {
            $i = 0;

            foreach($parameters as $parameterName => $value):

                $i++;
                if($queryType == QueryType::Query) {
                    $this->pdoStatement->bindParam(":".$parameterName, $parameters[$parameterName]);
                } else {
                    $this->pdoStatement->bindParam($i, $parameters[$parameterName]);
                }
            
            endforeach;
        }

    }