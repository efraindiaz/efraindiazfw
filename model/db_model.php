<?php 

	class DB_Model{

		protected $query;
		protected $arrayResult = array();
		private $conn;
		public $mensaje = "OK";


		private function open_connection(){

			#DB access info
			$host = '';
			$db = '';
			$user = 'root';
			$pass = '';

			try {

				$this->conn = new PDO('mysql:host='.$host.';dbname='.$db,$user,$pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->exec("SET CHARACTER SET UTF8");

				
			} catch (Exception $e) {
				print 'Error connecting to databse';
				exit;
			}

			return $this->conn;
		}


		private function close_connection(){
			$this->conn = null;
		}

		protected function ex_query(){

				try{
					$this->open_connection();
					$this->conn->query($this->query);
					$this->close_connection();
				}catch(PDOException $e){
					$this->mensaje = 'error'. $e;
				}
			return $this->mensaje;
		}

		protected function get_results(){

			try {
				
				$this->open_connection();
				$result = $this->conn->query($this->query);
				$this->close_connection();
				$rows = $result->fetchAll();

				foreach ($rows as $value) {
					$this->arrayResult[] = $value;
				}

				return $this->arrayResult;

			} catch (Exception $e) {
				print $e;
			}
		}
	}

 ?>