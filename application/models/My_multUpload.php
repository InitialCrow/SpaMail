<?php  
	Class My_multUpload extends CI_Model{
		public function do_upload($path, $inputName){


			// Count # of uploaded files in array
			$total = count($_FILES[$inputName]['name']);

			// Loop through each file
			for($i=0; $i<$total; $i++) {
				$ext = pathinfo($_FILES[$inputName]['name'][$i] , PATHINFO_EXTENSION);
				$newName = uniqid().".$ext";
				$_FILES[$inputName]['name'][$i]= $newName;
			
				 
				//Get the temp file path
				$tmpFilePath = $_FILES[$inputName]['tmp_name'][$i];

				//Make sure we have a filepath
				if ($tmpFilePath != ""){
					//Setup our new file path
					$newFilePath = $path .'/'. $newName;
					
					//Upload the file into the temp dir
					if(move_uploaded_file($tmpFilePath, $newFilePath)) {
						
						$file = $_FILES[$inputName];
						
					//Handle other code here

					}
				}	
			}
			return $file;
		}
	}
?>
