<?php
// Refresh page timing //
echo '<meta http-equiv="refresh" content="1;url=http://localhost:8000" />'
----------------------

try{
	$myPDO = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '172839');
	$myPDO -> exec("SET NAMES 'UTF8'");
	$myPDO -> exec("SET character_set_connection='UTF8'");
}catch (PDOException $err){
	echo 'error in connection' . $err -> getmessage();
}


		$array = [];
		for ($i=0; $i<$size; $i++){
			$array[$attr_names[$i]['name']] = $attr_values[$i]['value'];
		}
		$attr_json = '"Attributes":' . json_encode($array , JSON_UNESCAPED_SLASHES);



$image_names = $_FILES['part_image']["name"];
		$image_files = $_FILES['part_image'];
		$size = 0;
		foreach ($image_names as $value)
		{
			$size++;
		}
		$target_dir = "uploads/";
		$array = [];
		for ($i=0; $i<$size; $i++){
			$uploadOk = 1;
			$target_file = $target_dir . basename($image_names[$i]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			   && $imageFileType != "gif" ) {
				//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				//echo "Sorry, your file was not uploaded.";
			} else {
				move_uploaded_file($image_files["tmp_name"][$i]["name"], $target_file);
				$array[] = $_SERVER['SERVER_NAME'] . '/isee/' . $target_dir . $image_names[$i]["name"];
			}
		}
		$image_json = '"Image":' . json_encode($array , JSON_UNESCAPED_SLASHES) ;

		$dkj_json =  '{' . $image_json . ','  . $doc_json . ',' .$attr_json . '}';
		$sij_json = '{' . $image_json . ','  . $doc_json . '}';


		var_dump($dkj_json);

		$insert = $myPDO->query(" insert into xproduct_202008041139 (partnumber, description, detaileddescription , sij ,  dkj ) values('$part_number','$description','$detaileddescription', '$sij_json' ,'$dkj_json') ");
		//$insert = $myPDO->query(" insert into xproduct_202008041139 (partnumber, description, detaileddescription , sij ,  dkj ) values('$part_number','$description','$detaileddescription', '{\"Categories\": {\"main\": \"Integrated Circuits (ICs)\"}}' ,'{\"Categories\": {\"main\": \"Integrated Circuits (ICs)\"}}') ");
		if ($insert){
			echo 'OK';
		}else{
			echo 'Not Ok';
		}