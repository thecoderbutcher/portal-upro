<?php 
    class DataBase{
        # data for conection
		/* private $sdbm    = "pgsql";
        private $host    = "10.18.120.183";
        private $port    = "5432";
        private $dbname  = "guarani3";
        private $user    = "postgres";
        private $pass    = "poimnbqaz.,"; */
		private $sdbm    = "pgsql";
        private $host    = "localhost";
        private $port    = "5432";
        private $dbname  = "uplatform";
        private $user    = "uadmin";
        private $pass    = "password"; 

        private $dbh;  #handler
		private	$stmt; #statement
		private	$error;

        public function __construct(){
            $dsn = $this->sdbm .':host=' . $this->host;
			$this->sdbm == "pgsql"? $dsn = $dsn . ';port=' . $this->port . ';dbname=' . $this->dbname : $dsn . ';dbname=' . $this->dbname;
            # pdo options 
            $option = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE 	 => PDO::ERRMODE_EXCEPTION
            ); 

            # making conection 
            try { $this->dbh = new PDO($dsn, $this->user, $this->pass, $option); } 
            catch (PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error; 
            }
        }

        # Prepare the query
		public function query($sql){$this->stmt = $this->dbh->prepare($sql);}

		# Link the query with bind
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break; 
					default:
						$type = PDO::PARAM_STR;
						break;
				}
				$this->stmt->bindValue($param, $value, $type);
			}
		}

		# Execute the query
		public function execute(){
			return $this->stmt->execute();
		}

		# Get one record
		public function getRecord(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		# Get records
		public function getRecords(){
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		# Get row counts
		public function rowCount(){
			return $this->stmt->rowCount();
		}

		# Delete possible injections 
		public function deleteSpecialChars($param, $type){ 
			switch ($type) {
				case 'email':
					$filter = FILTER_SANITIZE_EMAIL;
					break;
				case 'int':
					$filter = FILTER_SANITIZE_NUMBER_INT;
					break;
				case 'float':
					$filter = FILTER_SANITIZE_NUMBER_FLOAT;
					break;
				case 'char':
					$filter = FILTER_SANITIZE_SPECIAL_CHARS;
					break;
			}
			return filter_var(htmlspecialchars(trim($param)), $filter);
		}
    }
?>