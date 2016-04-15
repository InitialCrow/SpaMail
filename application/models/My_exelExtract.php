<?php  
require_once './application/libraries/exel/Excel/reader.php';
	Class My_exelExtract extends CI_Model{
		private $data;
		public function extract($file){
			
			$this->data = new Spreadsheet_Excel_Reader();
			// ExcelFile($filename, $encoding);
			

			// Set output Encoding.
			$this->data->setOutputEncoding('CP1251');

			

			 //if you want you can change 'iconv' to mb_convert_encoding:
			 $this->data->setUTFEncoder('mb');

			

			


			

			 //By default rows & cols indeces start with 1
			 //For change initial index use:
			 $this->data->setRowColOffset(0);

		


		

			 // Some function for formatting output.
			 $this->data->setDefaultFormat('%.2f');
			 //setDefaultFormat - set format for columns with unknown formatting

			

			 $this->data->setColumnFormat(4, '%.3f');
			 //setColumnFormat - set format for column (apply only to number fields)


			$this->data->read($file);

			

			 $this->data->sheets[0]['numRows']-//- count rows
			 $this->data->sheets[0]['numCols']-// - count columns
			 $this->data->sheets[0]['cells'][$i][$j]-// - data from $i-row $j-column

			 $this->data->sheets[0]['cellsInfo'][$i][$j]-// - extended info about cell

			    $this->data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown";
			        //if 'type' == "unknown" //- use 'raw' value, because  cell contain value with format '0.00';
			    $this->data->sheets[0]['cellsInfo'][$i][$j]['raw'] = //value if cell without format
			    $this->data->sheets[0]['cellsInfo'][$i][$j]['colspan'];
			    $this->data->sheets[0]['cellsInfo'][$i][$j]['rowspan'];

		


			error_reporting(E_ALL ^ E_NOTICE);
			
			for ($i = 1; $i <= $this->data->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $this->data->sheets[0]['numCols']; $j++) {
					echo "".$this->data->sheets[0]['cells'][$i][$j]."<br>";
				}
				echo "\n";

			}

			


			echo "".$this->data->sheets[0]['cells'][1][1]."<br>";
			echo "".$this->data->sheets[0]['cells'][1][2]."<br>";

			print_r($this->data);
			print_r($this->data->formatRecords);
					}
					
				}
?>
