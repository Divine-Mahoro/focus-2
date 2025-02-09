<?php
function prepare_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES);
  //$data = htmlentities($data, ENT_QUOTES);
  return $data;
}

function get_employee_job_id($employee_id = NULL, $fieldNames, $fieldValues){
	global $dbh;
	$count_fields = count($fieldNames);
	$count_values = count($fieldValues);
	if($employee_id != NULL && $count_fields > 0 && $count_fields == $count_values){
		$query = "SELECT ej.id
				  FROM employees e, employeejob ej, jobtb j 
				  WHERE e.employee_id = ej.employee_id AND ej.job_id = j.job_id AND 
		          ";
		          for($i=0;$i<$count_fields;$i++){
					$query .= "ej." . $fieldNames[$i] . " = '" . $fieldValues[$i] . "' AND ";
				 }
		$query = chop($query," AND ");
        $stmt = $dbh->prepare($query);
    	$stmt->execute();

    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		extract($row);
    		return $id;
    	}
	}
}

function getFieldValueById($fieldName = NULL, $tableName = NULL, $id = NULL) { // $id assigned to the primary key field of {$tableName} table
	global $dbh;
	$idName = chop($tableName, "s");
	$idName = $idName . "_id";
	if($tableName == "jobtb"){
		$idName = "job_id";
	}
	
	if($tableName == "admin_structure"){
		$idName = "id";
	}
	if($tableName == "job_affiliations"){
		$idName = "id";
	}
	if($tableName == "job_domains"){
		$idName = "id";
	}
	if($tableName == "job_responsabilities"){
		$idName = "id";
	}
	if($tableName == "job_qualifications"){
		$idName = "id";
	}
	if($tableName == "job_experiences"){
		$idName = "id";
	}
	if($tableName == "job_skills"){
		$idName = "id";
	}
	if($tableName == "job_competencies"){
		$idName = "id";
	}
	if($tableName == "job_trainings"){
		$idName = "id";
	}
	if($tableName == "competencies"){
		$idName = "id";
	}
	if($tableName == "qualifications"){
		$idName = "id";
	}
	if($tableName == "job_authorities"){
		$idName = "id";
	}
	if($tableName == "empplacement"){
		$idName = "id";
	}
	if($tableName == "empsanctions"){
		$idName = "id";
	}
	if($tableName == "empprofession"){
		$idName = "id";
	}
	if($tableName == "empcompetencies"){
		$idName = "id";
	}
	if($tableName == "emptrainings"){
		$idName = "id";
	}
	if($tableName == "pro_achievements"){
		$idName = "id";
	}
	if($tableName == "employeeskills"){
		$idName = "id";
	}
	if($tableName == "affiliations"){
		$idName = "id";
	}
	if($tableName == "empprofession"){
		$idName = "id";
	}
	if($tableName == "empresponsabilities"){
		$idName = "id";
	}
	if($tableName == "villages"){
		$idName = "village_code";
	}
	if($tableName == "cells"){
		$idName = "cell_code";
	}
	if($tableName == "sectors"){
		$idName = "sector_code";
	}
	if($tableName == "districts"){
		$idName = "district_code";
	}
	if($tableName == "provinces"){
		$idName = "province_code";
	}
	
	$result='';
	if($fieldName != NULL && $tableName != NULL && $id != NULL){
	
		$query = "SELECT " . $fieldName . " AS result_name FROM ". $tableName . " WHERE " . $idName . " = ".$id;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($res);
			$result = $result_name;
		}
	}
	return $result;
}

function insertRecord($tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);
	$affected_rows=0;
	if($tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "INSERT INTO ". $tableName . "(" ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . ", ";
				 }
		$query = chop($query,", ");
		$query .= ") VALUES (" ;
				for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= "'" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= ")";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
	                     
		$affected_rows=$stmt->rowCount();
	}
	else{
		echo "0 Failed";
		return 0;
	}
	return $affected_rows;
}

function updateRecord($id = NULL,$tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	$idField = chop($tableName,"s");
	$idField = $idField . "_id";
	
	if($tableName == "jobtb"){
		$idField = "job_id";
	}
	if($tableName == "academic_achievements" || $tableName == "pro_achievements" || $tableName == "emptrainings" || $tableName == "affiliations" || $tableName == "empsanctions" ||  $tableName == "empplacement"){
		$idField = "id";
	}
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);
	$affected_rows=0;
	if($id != NULL && $tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "UPDATE ". $tableName . " SET " ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . " = '" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= " WHERE " . $idField . " = ".$id;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$affected_rows=$stmt->rowCount();
	}
	return $affected_rows;
}

function getSemesterId(){
	global $dbh;
	$currentDate = date("Y-m-d");	
	$qry = "SELECT * FROM semester WHERE start_date <= '".$currentDate."' and end_date >= '".$currentDate."'";
	$stmt = $dbh->prepare($qry);
	$stmt->execute();
	if($res = $stmt->fetch(PDO::FETCH_ASSOC)){
		return $res['semester_id'];
	}
	return NULL;
}

function getCourseSession($course = NULL){
	global $dbh;
	$currentDate = date("Y-m-d");
	if($course != NULL){
		$qry = "SELECT * FROM teaching_session WHERE teacher_courses_id = '".$course."' and date = '".$currentDate."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		if($res = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $res['teaching_session_id'];
		}
		return NULL;
	}
	return NULL;
}

function getAssetCountry($imm_asset_id = NULL){
	//global $dbh;
	if($imm_asset_id != NULL){
		$location_id = getFieldValueById("asset_location_id", "immovable_asset_declarations", $imm_asset_id);
		if($location_id == 1){
			return "Rwanda";
		} else {
			return (getFieldValueById("country", "immovable_asset_declarations", $imm_asset_id));
		}
	}
	return NULL;
}

function getAssetCountryLivestock($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$location_id = getFieldValueById("asset_location_id", "livestock_declarations", $m_asset_id);
		if($location_id == 1){
			return "Rwanda";
		} else {
			return (getFieldValueById("country", "livestock_declarations", $m_asset_id));
		}
	}
	return NULL;
}

function getAssetCountryVehicles($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$location_id = getFieldValueById("asset_location_id", "vehicle_declarations", $m_asset_id);
		if($location_id == 1){
			return "Rwanda";
		} else {
			return (getFieldValueById("country", "vehicle_declarations", $m_asset_id));
		}
	}
	return NULL;
}

function getAssetCountryOtherMovable($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$location_id = getFieldValueById("asset_location_id", "other_movable_declarations", $m_asset_id);
		if($location_id == 1){
			return "Rwanda";
		} else {
			return (getFieldValueById("country", "other_movable_declarations", $m_asset_id));
		}
	}
	return NULL;
}

function getVillageCode($imm_asset_id = NULL){
	//global $dbh;
	if($imm_asset_id != NULL){
		return (getFieldValueById("village_code", "immovable_asset_declarations", $imm_asset_id));
	}
	return NULL;
}

function getVillageCodeLivestock($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		return (getFieldValueById("village_code", "livestock_declarations", $m_asset_id));
	}
	return NULL;
}

function getVillageCodeOtherMovale($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		return (getFieldValueById("village_code", "other_movable_declarations", $m_asset_id));
	}
	return NULL;
}

function getVillageCodeVehicles($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		return (getFieldValueById("village_code", "vehicle_declarations", $m_asset_id));
	}
	return NULL;
}

function getVillageName($village_code = NULL){
	//global $dbh;
	if($village_code != NULL){
		return (getFieldValueById("village_name", "villages", $village_code));
	}
	return NULL;
}

function getVillageByDeclaration($imm_asset_id = NULL){
	//global $dbh;
	if($imm_asset_id != NULL){
		return getVillageName(getVillageCode($imm_asset_id));
	}
	return NULL;
}


function getAssetLocation($imm_asset_id = NULL){
	//global $dbh;
	if($imm_asset_id != NULL){
		$vCode = getVillageCode($imm_asset_id);
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);

		return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
	}
	return NULL;
}

function getAssetLocationLivestock($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$vCode = getVillageCodeLivestock($m_asset_id);
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);

		return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
	}
	return NULL;
}

function getAssetLocationOtherMovable($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$vCode = getVillageCodeOtherMovale($m_asset_id);
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);

		return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
	}
	return NULL;
}

function getAssetLocationVehicles($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$vCode = getVillageCodeVehicles($m_asset_id);
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);

		return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
	}
	return NULL;
}


function getAssetLocationByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);

		return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
	}
	return NULL;
}

function getCellByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		return (getFieldValueById("cell_name","cells",$cCode));
	}
	return NULL;
}

function getCellCodeByVillageCode($vCode = NULL){
	if($vCode != NULL){
		return (getFieldValueById("cell_code","villages",$vCode));
	}
	return NULL;	
}

function getSectorCodeByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		return (getFieldValueById("sector_code","cells",$cCode));
	}
	return NULL;
}

function getSectorByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$sCode = getSectorCodeByVillageCode($vCode);
		return (getFieldValueById("sector_name","sectors",$sCode));
	}
	return NULL;
}

function getDistrictCodeByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		return (getFieldValueById("district_code","sectors",$sCode));
	}
	return NULL;
}

function getDistrictByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$dCode = getDistrictCodeByVillageCode($vCode);
		return (getFieldValueById("district_name","districts",$dCode));
	}
	return NULL;
}

function getProvinceCodeByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		return (getFieldValueById("province_code","districts",$dCode));
	}
	return NULL;
}

function getProvinceByVillageCode($vCode = NULL){
	//global $dbh;
	if($vCode != NULL){
		$pCode = getProvinceCodeByVillageCode($vCode);
		return (getFieldValueById("province_name","provinces",$pCode));
	}
	return NULL;
}

function immovable_asset_count($eid = NULL, $immov_asset_id = NULL){
	global $dbh;
	if($eid != NULL && $immov_asset_id != NULL){
		$qry = "SELECT * FROM immovable_asset_declarations WHERE employee_id='".$eid."' AND immovable_asset_id='".$immov_asset_id."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		return $stmt->rowCount();		
	}
	return NULL;
}

function getMovableTable($movable_asset_id = NULL){
	if($movable_asset_id == NULL) return NULL;
	else if($movable_asset_id == 1) return "livestock_declarations";
	else if($movable_asset_id == 2) return "gift_declarations";
	else if($movable_asset_id == 3) return "vehicle_declarations";
	else if($movable_asset_id == 4) return "money_declarations";
	else if($movable_asset_id == 5) return "other_movable_declarations";
}

function movable_asset_count($eid = NULL, $movable_asset_id = NULL){
	global $dbh;
	if($eid != NULL && $movable_asset_id != NULL){
		$qry = "SELECT * FROM ".getMovableTable($movable_asset_id)." WHERE employee_id='".$eid."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		return $stmt->rowCount();		
	}
	return NULL; 
}

function rmkdir($path) {
    $path = str_replace("\\", "/", $path);
    $path = explode("/", $path);

    $rebuild = '';
    foreach($path AS $p) {

        if(strstr($p, ":") != false) { 
            echo "\nExists : in $p\n";
            $rebuild = $p;
            continue;
        }
        $rebuild .= "/$p";
        echo "Checking: $rebuild\n";
        if(!is_dir($rebuild)) mkdir($rebuild);
    }
}

function has_submitted($declaration_period_id=NULL,$employee_id=NULL){
	global $dbh;
	
	if($declaration_period_id!=NULL && $employee_id!=NULL){
		$qry = "SELECT * FROM submitted_declarations 
			   WHERE declaration_period_id='".$declaration_period_id."' AND employee_id='".$employee_id."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return true;
		}
	}
	return false;
}

function getLocationData($imm_asset_id = NULL){
	//global $dbh;
	if($imm_asset_id != NULL){
		$vCode = getVillageCode($imm_asset_id);
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);
		
		$out = '<ul>';
		$out .= '<li>'.$pName.'</li>';
		$out .= '<li>'.$dName.'</li>';
		$out .= '<li>'.$sName.'</li>';
		$out .= '<li>'.$cName.'</li>';
		$out .= '<li>'.$vName.'</li>';
		$out .= '</ul>';

		//return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
		return $out;
		
	}
	return NULL;
}

function getLocationDataOtherMovable($m_asset_id = NULL){
	//global $dbh;
	if($m_asset_id != NULL){
		$vCode = getVillageCodeOtherMovale($m_asset_id);
		$vName = getVillageName($vCode);
		$cCode = getFieldValueById("cell_code","villages",$vCode);
		$cName = getFieldValueById("cell_name","cells",$cCode);
		$sCode = getFieldValueById("sector_code","cells",$cCode);
		$sName = getFieldValueById("sector_name","sectors",$sCode);
		$dCode = getFieldValueById("district_code","sectors",$sCode);
		$dName = getFieldValueById("district_name","districts",$dCode);
		$pCode = getFieldValueById("province_code","districts",$dCode);
		$pName = getFieldValueById("province_name","provinces",$pCode);
		
		$out = '<ul>';
		$out .= '<li>'.$pName.'</li>';
		$out .= '<li>'.$dName.'</li>';
		$out .= '<li>'.$sName.'</li>';
		$out .= '<li>'.$cName.'</li>';
		$out .= '<li>'.$vName.'</li>';
		$out .= '</ul>';

		//return ($pName.", ".$dName.", ".$sName.", ".$cName.",".$vName);
		return $out;
		
	}
	return NULL;
}

function declarationsCountImmovable($empId = NULL, $periodId = NULL, $id = NULL){
    global $dbh;
    if($empId != NULL && $periodId != NULL && $id != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM immovable_asset_declarations"; 
		$sql .= " WHERE employee_id='".$empId."'"; 
		$sql .= " AND declaration_period_id='".$periodId."'";
		$sql .= " AND immovable_asset_id='".$id."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function declarationsCount($empId = NULL, $periodId = NULL, $tableName = NULL){
    global $dbh;
    if($empId != NULL && $periodId != NULL && $tableName != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM " . $tableName; 
		$sql .= " WHERE employee_id='".$empId."'"; 
		$sql .= " AND declaration_period_id='".$periodId."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

?>