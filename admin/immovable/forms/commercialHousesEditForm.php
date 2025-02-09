
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Commercial Houses Declaration</h4>
								<?php 
								if(isset($success_msg) && $success_msg != ''){
									echo '<p class="text-success">'.$success_msg.'</p>';
								} else if(isset($warning_msg) && $warning_msg != ''){
									echo '<p class="text-warning">'.$warning_msg.'</p>';
								} else if(isset($error_msg) && $error_msg != ''){
									echo '<p class="text-danger">'.$error_msg.'</p>';
								}
								?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php if($main_link == 'staffUser.php'){ ?>
                                    <form action="editCommercialHouseUser.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
								<?php } else { ?>
									<form action="editCommercialHouse.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
								<?php } ?>
                                        <div class="form-row">
											<div class="form-group col-md-6">
                                               
                                                <select class="custom-select mr-sm-2" name="asset_owner" id="asset_owner">
                                                    <option value="">Owner...</option>
                                                    <option value="1" <?php if($asset_owner_id==1){ echo 'selected="selected"'; } ?>>My Self</option>
                                                    <option value="2" <?php if($asset_owner_id==2){ echo 'selected="selected"'; } ?>>children</option>
                                                    <option value="3" <?php if($asset_owner_id==3){ echo 'selected="selected"'; } ?>>Spouse</option>
                                                </select>
                                            </div>
											
											<div class="form-group col-md-6">
											   
                                               <select class="custom-select mr-sm-2" name="location" id="location">
                                                    <option value="">Location...</option>
                                                    <option value="1" <?php if($asset_location_id==1){ echo 'selected="selected"'; } ?>>Rwanda</option>
                                                    <option value="2" <?php if($asset_location_id==2){ echo 'selected="selected"'; } ?>>Abroad</option>
                                                </select>
                                            </div>
										<?php if($asset_location_id==1){ ?>	
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="province" id="province">
                                                    
													<?php 
													$provincesQry = "SELECT * FROM provinces";
													foreach($dbh->query($provincesQry) as $p){
														$provinceCode = $p['province_code'];
														$provinceName = $p['province_name'];
														echo '<option value="'.$provinceCode.'"';
														if($provinceCode == $province_code){ echo ' selected="selected"'; }
														echo '>'.$provinceName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
										
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="district" id="district">
                                                    
													<?php 
													$pCode = getProvinceCodeByVillageCode($village_code);
													$districtsQry = "SELECT * FROM districts WHERE province_code = '".$pCode."'";
													foreach($dbh->query($districtsQry) as $d){
														$districtCode = $d['district_code'];
														$districtName = $d['district_name'];
														echo '<option value="'.$districtCode.'"';
														if($districtCode == $district_code){ echo ' selected="selected"'; }
														echo '>'.$districtName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="sector" id="sector">
                                                    
													<?php 
													$dCode = getDistrictCodeByVillageCode($village_code);
													$sectorsQry = "SELECT * FROM sectors WHERE district_code = '".$dCode."'";
													foreach($dbh->query($sectorsQry) as $s){
														$sectorCode = $s['sector_code'];
														$sectorName = $s['sector_name'];
														echo '<option value="'.$sectorCode.'"';
														if($sectorCode == $sector_code){ echo ' selected="selected"'; }
														echo '>'.$sectorName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <select class="custom-select mr-sm-2" name="cell" id="cell">
                                                    
													<?php 
													$sCode = getSectorCodeByVillageCode($village_code);
													$cellsQry = "SELECT * FROM cells WHERE sector_code = '".$sCode."'";
													foreach($dbh->query($cellsQry) as $c){
														$cellCode = $c['cell_code'];
														$cellName = $c['cell_name'];
														echo '<option value="'.$cellCode.'"';
														if($cellCode == $cell_code){ echo ' selected="selected"'; }
														echo '>'.$cellName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                 <select class="custom-select mr-sm-2" name="village" id="village" name="village">
                                                    
													<?php 
													$cCode = getCellCodeByVillageCode($village_code);
													$villagesQry = "SELECT * FROM villages WHERE cell_code = '".$cCode."'";
													foreach($dbh->query($villagesQry) as $v){
														$villageCode = $v['village_code'];
														$villageName = $v['village_name'];
														echo '<option value="'.$villageCode.'"';
														if($villageCode == $village_code){ echo ' selected="selected"'; }
														echo '>'.$villageName.'</option>';
													}
													?>
													
                                                </select>
                                            </div>
                                        </div>
										<?php } else if($asset_location_id==2){ ?>	
										<div class="form-row">
                                            <div class="col-auto my-1">
                                                 <select class="custom-select mr-sm-2" name="countryValue" id="countryValue">
                                                    <option value="">Country...</option>
													<option value="Afghanistan" <?php if($country=="Afghanistan"){ echo 'selected="selected"'; } ?>>Afghanistan</option>
													  <option value="Albania" <?php if($country=="Albania"){ echo 'selected="selected"'; } ?>>Albania</option>
													  <option value="Algeria" <?php if($country=="Algeria"){ echo 'selected="selected"'; } ?>>Algeria</option>
													  <option value="American Samoa" <?php if($country=="American Samoa"){ echo 'selected="selected"'; } ?>>American Samoa</option>
													  <option value="Andorra" <?php if($country=="Andorra"){ echo 'selected="selected"'; } ?>>Andorra</option>
													  <option value="Angola" <?php if($country=="Angola"){ echo 'selected="selected"'; } ?>>Angola</option>
													  <option value="Anguilla" <?php if($country=="Anguilla"){ echo 'selected="selected"'; } ?>>Anguilla</option>
													  <option value="Antartica" <?php if($country=="Antartica"){ echo 'selected="selected"'; } ?>>Antarctica</option>
													  <option value="Antigua and Barbuda" <?php if($country=="Antigua and Barbuda"){ echo 'selected="selected"'; } ?>>Antigua and Barbuda</option>
													  <option value="Argentina" <?php if($country=="Argentina"){ echo 'selected="selected"'; } ?>>Argentina</option>
													  <option value="Armenia" <?php if($country=="Armenia"){ echo 'selected="selected"'; } ?>>Armenia</option>
													  <option value="Aruba" <?php if($country=="Aruba"){ echo 'selected="selected"'; } ?>>Aruba</option>
													  <option value="Australia" <?php if($country=="Australia"){ echo 'selected="selected"'; } ?>>Australia</option>
													  <option value="Austria" <?php if($country=="Austria"){ echo 'selected="selected"'; } ?>>Austria</option>
													  <option value="Azerbaijan" <?php if($country=="Azerbaijan"){ echo 'selected="selected"'; } ?>>Azerbaijan</option>
													  <option value="Bahamas" <?php if($country=="Bahamas"){ echo 'selected="selected"'; } ?>>Bahamas</option>
													  <option value="Bahrain" <?php if($country=="Bahrain"){ echo 'selected="selected"'; } ?>>Bahrain</option>
													  <option value="Bangladesh" <?php if($country=="Bangladesh"){ echo 'selected="selected"'; } ?>>Bangladesh</option>
													  <option value="Barbados" <?php if($country=="Barbados"){ echo 'selected="selected"'; } ?>>Barbados</option>
													  <option value="Belarus" <?php if($country=="Belarus"){ echo 'selected="selected"'; } ?>>Belarus</option>
													  <option value="Belgium" <?php if($country=="Belgium"){ echo 'selected="selected"'; } ?>>Belgium</option>
													  <option value="Belize" <?php if($country=="Belize"){ echo 'selected="selected"'; } ?>>Belize</option>
													  <option value="Benin" <?php if($country=="Benin"){ echo 'selected="selected"'; } ?>>Benin</option>
													  <option value="Bermuda" <?php if($country=="Bermuda"){ echo 'selected="selected"'; } ?>>Bermuda</option>
													  <option value="Bhutan" <?php if($country=="Bhutan"){ echo 'selected="selected"'; } ?>>Bhutan</option>
													  <option value="Bolivia" <?php if($country=="Bolivia"){ echo 'selected="selected"'; } ?>>Bolivia</option>
													  <option value="Bosnia and Herzegowina" <?php if($country=="Bosnia and Herzegowina"){ echo 'selected="selected"'; } ?>>Bosnia and Herzegowina</option>
													  <option value="Botswana" <?php if($country=="Botswana"){ echo 'selected="selected"'; } ?>>Botswana</option>
													  <option value="Bouvet Island" <?php if($country=="Bouvet Island"){ echo 'selected="selected"'; } ?>>Bouvet Island</option>
													  <option value="Brazil" <?php if($country=="Brazil"){ echo 'selected="selected"'; } ?>>Brazil</option>
													  <option value="British Indian Ocean Territory" <?php if($country=="British Indian Ocean Territory"){ echo 'selected="selected"'; } ?>>British Indian Ocean Territory</option>
													  <option value="Brunei Darussalam" <?php if($country=="Brunei Darussalam"){ echo 'selected="selected"'; } ?>>Brunei Darussalam</option>
													  <option value="Bulgaria" <?php if($country=="Bulgaria"){ echo 'selected="selected"'; } ?>>Bulgaria</option>
													  <option value="Burkina Faso" <?php if($country=="Burkina Faso"){ echo 'selected="selected"'; } ?>>Burkina Faso</option>
													  <option value="Burundi" <?php if($country=="Burundi"){ echo 'selected="selected"'; } ?>>Burundi</option>
													  <option value="Cambodia" <?php if($country=="Cambodia"){ echo 'selected="selected"'; } ?>>Cambodia</option>
													  <option value="Cameroon" <?php if($country=="Cameroon"){ echo 'selected="selected"'; } ?>>Cameroon</option>
													  <option value="Canada" <?php if($country=="Canada"){ echo 'selected="selected"'; } ?>>Canada</option>
													  <option value="Cape Verde" <?php if($country=="Cape Verde"){ echo 'selected="selected"'; } ?>>Cape Verde</option>
													  <option value="Cayman Islands" <?php if($country=="Cayman Islands"){ echo 'selected="selected"'; } ?>>Cayman Islands</option>
													  <option value="Central African Republic" <?php if($country=="Central African Republic"){ echo 'selected="selected"'; } ?>>Central African Republic</option>
													  <option value="Chad" <?php if($country=="Chad"){ echo 'selected="selected"'; } ?>>Chad</option>
													  <option value="Chile" <?php if($country=="Chile"){ echo 'selected="selected"'; } ?>>Chile</option>
													  <option value="China" <?php if($country=="China"){ echo 'selected="selected"'; } ?>>China</option>
													  <option value="Christmas Island" <?php if($country=="Christmas Island"){ echo 'selected="selected"'; } ?>>Christmas Island</option>
													  <option value="Cocos Islands" <?php if($country=="Cocos Islands"){ echo 'selected="selected"'; } ?>>Cocos (Keeling) Islands</option>
													  <option value="Colombia" <?php if($country=="Colombia"){ echo 'selected="selected"'; } ?>>Colombia</option>
													  <option value="Comoros" <?php if($country=="Comoros"){ echo 'selected="selected"'; } ?>>Comoros</option>
													  <option value="Congo" <?php if($country=="Congo"){ echo 'selected="selected"'; } ?>>Congo</option>
													  <option value="Congo" <?php if($country=="Congo"){ echo 'selected="selected"'; } ?>>Congo, the Democratic Republic of the</option>
													  <option value="Cook Islands" <?php if($country=="Cook Islands"){ echo 'selected="selected"'; } ?>>Cook Islands</option>
													  <option value="Costa Rica" <?php if($country=="Costa Rica"){ echo 'selected="selected"'; } ?>>Costa Rica</option>
													  <option value="Cota D'Ivoire" <?php if($country=="Cota D'Ivoire"){ echo 'selected="selected"'; } ?>>Cote d'Ivoire</option>
													  <option value="Croatia" <?php if($country=="Croatia"){ echo 'selected="selected"'; } ?>>Croatia (Hrvatska)</option>
													  <option value="Cuba" <?php if($country=="Cuba"){ echo 'selected="selected"'; } ?>>Cuba</option>
													  <option value="Cyprus" <?php if($country=="Cyprus"){ echo 'selected="selected"'; } ?>>Cyprus</option>
													  <option value="Czech Republic" <?php if($country=="Czech Republic"){ echo 'selected="selected"'; } ?>>Czech Republic</option>
													  <option value="Denmark" <?php if($country=="Denmark"){ echo 'selected="selected"'; } ?>>Denmark</option>
													  <option value="Djibouti" <?php if($country=="Djibouti"){ echo 'selected="selected"'; } ?>>Djibouti</option>
													  <option value="Dominica" <?php if($country=="Dominica"){ echo 'selected="selected"'; } ?>>Dominica</option>
													  <option value="Dominican Republic" <?php if($country=="Dominican Republic"){ echo 'selected="selected"'; } ?>>Dominican Republic</option>
													  <option value="East Timor" <?php if($country=="East Timor"){ echo 'selected="selected"'; } ?>>East Timor</option>
													  <option value="Ecuador" <?php if($country=="Ecuador"){ echo 'selected="selected"'; } ?>>Ecuador</option>
													  <option value="Egypt" <?php if($country=="Egypt"){ echo 'selected="selected"'; } ?>>Egypt</option>
													  <option value="El Salvador" <?php if($country=="El Salvador"){ echo 'selected="selected"'; } ?>>El Salvador</option>
													  <option value="Equatorial Guinea" <?php if($country=="Equatorial Guinea"){ echo 'selected="selected"'; } ?>>Equatorial Guinea</option>
													  <option value="Eritrea" <?php if($country=="Eritrea"){ echo 'selected="selected"'; } ?>>Eritrea</option>
													  <option value="Estonia" <?php if($country=="Estonia"){ echo 'selected="selected"'; } ?>>Estonia</option>
													  <option value="Ethiopia" <?php if($country=="Ethiopia"){ echo 'selected="selected"'; } ?>>Ethiopia</option>
													  <option value="Falkland Islands" <?php if($country=="Falkland Islands"){ echo 'selected="selected"'; } ?>>Falkland Islands (Malvinas)</option>
													  <option value="Faroe Islands" <?php if($country=="Faroe Islands"){ echo 'selected="selected"'; } ?>>Faroe Islands</option>
													  <option value="Fiji" <?php if($country=="Fiji"){ echo 'selected="selected"'; } ?>>Fiji</option>
													  <option value="Finland" <?php if($country=="Finland"){ echo 'selected="selected"'; } ?>>Finland</option>
													  <option value="France" <?php if($country=="France"){ echo 'selected="selected"'; } ?>>France</option>
													  <option value="France Metropolitan" <?php if($country=="France Metropolitan"){ echo 'selected="selected"'; } ?>>France, Metropolitan</option>
													  <option value="French Guiana" <?php if($country=="French Guiana"){ echo 'selected="selected"'; } ?>>French Guiana</option>
													  <option value="French Polynesia" <?php if($country=="French Polynesia"){ echo 'selected="selected"'; } ?>>French Polynesia</option>
													  <option value="French Southern Territories" <?php if($country=="French Southern Territories"){ echo 'selected="selected"'; } ?>>French Southern Territories</option>
													  <option value="Gabon" <?php if($country=="Gabon"){ echo 'selected="selected"'; } ?>>Gabon</option>
													  <option value="Gambia" <?php if($country=="Gambia"){ echo 'selected="selected"'; } ?>>Gambia</option>
													  <option value="Georgia" <?php if($country=="Georgia"){ echo 'selected="selected"'; } ?>>Georgia</option>
													  <option value="Germany" <?php if($country=="Germany"){ echo 'selected="selected"'; } ?>>Germany</option>
													  <option value="Ghana" <?php if($country=="Ghana"){ echo 'selected="selected"'; } ?>>Ghana</option>
													  <option value="Gibraltar" <?php if($country=="Gibraltar"){ echo 'selected="selected"'; } ?>>Gibraltar</option>
													  <option value="Greece" <?php if($country=="Greece"){ echo 'selected="selected"'; } ?>>Greece</option>
													  <option value="Greenland" <?php if($country=="Greenland"){ echo 'selected="selected"'; } ?>>Greenland</option>
													  <option value="Grenada" <?php if($country=="Grenada"){ echo 'selected="selected"'; } ?>>Grenada</option>
													  <option value="Guadeloupe" <?php if($country=="Guadeloupe"){ echo 'selected="selected"'; } ?>>Guadeloupe</option>
													  <option value="Guam" <?php if($country=="Guam"){ echo 'selected="selected"'; } ?>>Guam</option>
													  <option value="Guatemala" <?php if($country=="Guatemala"){ echo 'selected="selected"'; } ?>>Guatemala</option>
													  <option value="Guinea" <?php if($country=="Guinea"){ echo 'selected="selected"'; } ?>>Guinea</option>
													  <option value="Guinea-Bissau" <?php if($country=="Guinea-Bissau"){ echo 'selected="selected"'; } ?>>Guinea-Bissau</option>
													  <option value="Guyana" <?php if($country=="Guyana"){ echo 'selected="selected"'; } ?>>Guyana</option>
													  <option value="Haiti" <?php if($country=="Haiti"){ echo 'selected="selected"'; } ?>>Haiti</option>
													  <option value="Heard and McDonald Islands" <?php if($country=="Heard and McDonald Islands"){ echo 'selected="selected"'; } ?>>Heard and Mc Donald Islands</option>
													  <option value="Holy See" <?php if($country=="Holy See"){ echo 'selected="selected"'; } ?>>Holy See (Vatican City State)</option>
													  <option value="Honduras" <?php if($country=="Honduras"){ echo 'selected="selected"'; } ?>>Honduras</option>
													  <option value="Hong Kong" <?php if($country=="Hong Kong"){ echo 'selected="selected"'; } ?>>Hong Kong</option>
													  <option value="Hungary" <?php if($country=="Hungary"){ echo 'selected="selected"'; } ?>>Hungary</option>
													  <option value="Iceland" <?php if($country=="Iceland"){ echo 'selected="selected"'; } ?>>Iceland</option>
													  <option value="India" <?php if($country=="India"){ echo 'selected="selected"'; } ?>>India</option>
													  <option value="Indonesia" <?php if($country=="Indonesia"){ echo 'selected="selected"'; } ?>>Indonesia</option>
													  <option value="Iran" <?php if($country=="Iran"){ echo 'selected="selected"'; } ?>>Iran (Islamic Republic of)</option>
													  <option value="Iraq" <?php if($country=="Iraq"){ echo 'selected="selected"'; } ?>>Iraq</option>
													  <option value="Ireland" <?php if($country=="Ireland"){ echo 'selected="selected"'; } ?>>Ireland</option>
													  <option value="Israel" <?php if($country=="Israel"){ echo 'selected="selected"'; } ?>>Israel</option>
													  <option value="Italy" <?php if($country=="Italy"){ echo 'selected="selected"'; } ?>>Italy</option>
													  <option value="Jamaica" <?php if($country=="Jamaica"){ echo 'selected="selected"'; } ?>>Jamaica</option>
													  <option value="Japan" <?php if($country=="Japan"){ echo 'selected="selected"'; } ?>>Japan</option>
													  <option value="Jordan" <?php if($country=="Jordan"){ echo 'selected="selected"'; } ?>>Jordan</option>
													  <option value="Kazakhstan" <?php if($country=="Kazakhstan"){ echo 'selected="selected"'; } ?>>Kazakhstan</option>
													  <option value="Kenya" <?php if($country=="Kenya"){ echo 'selected="selected"'; } ?>>Kenya</option>
													  <option value="Kiribati" <?php if($country=="Kiribati"){ echo 'selected="selected"'; } ?>>Kiribati</option>
													  <option value="Democratic People's Republic of Korea" <?php if($country=="Democratic People's Republic of Korea"){ echo 'selected="selected"'; } ?>>Korea, Democratic People's Republic of</option>
													  <option value="Korea" <?php if($country=="Korea"){ echo 'selected="selected"'; } ?>>Korea, Republic of</option>
													  <option value="Kuwait" <?php if($country=="Kuwait"){ echo 'selected="selected"'; } ?>>Kuwait</option>
													  <option value="Kyrgyzstan" <?php if($country=="Kyrgyzstan"){ echo 'selected="selected"'; } ?>>Kyrgyzstan</option>
													  <option value="Lao" <?php if($country=="Lao"){ echo 'selected="selected"'; } ?>>Lao People's Democratic Republic</option>
													  <option value="Latvia" <?php if($country=="Latvia"){ echo 'selected="selected"'; } ?>>Latvia</option>
													  <option value="Lebanon" <?php if($country=="Lebanon"){ echo 'selected="selected"'; } ?>>Lebanon</option>
													  <option value="Lesotho" <?php if($country=="Lesotho"){ echo 'selected="selected"'; } ?>>Lesotho</option>
													  <option value="Liberia" <?php if($country=="Liberia"){ echo 'selected="selected"'; } ?>>Liberia</option>
													  <option value="Libyan Arab Jamahiriya" <?php if($country=="Libyan Arab Jamahiriya"){ echo 'selected="selected"'; } ?>>Libyan Arab Jamahiriya</option>
													  <option value="Liechtenstein" <?php if($country=="Liechtenstein"){ echo 'selected="selected"'; } ?>>Liechtenstein</option>
													  <option value="Lithuania" <?php if($country=="Lithuania"){ echo 'selected="selected"'; } ?>>Lithuania</option>
													  <option value="Luxembourg" <?php if($country=="Luxembourg"){ echo 'selected="selected"'; } ?>>Luxembourg</option>
													  <option value="Macau" <?php if($country=="Macau"){ echo 'selected="selected"'; } ?>>Macau</option>
													  <option value="Macedonia" <?php if($country=="Macedonia"){ echo 'selected="selected"'; } ?>>Macedonia, The Former Yugoslav Republic of</option>
													  <option value="Madagascar" <?php if($country=="Madagascar"){ echo 'selected="selected"'; } ?>>Madagascar</option>
													  <option value="Malawi" <?php if($country=="Malawi"){ echo 'selected="selected"'; } ?>>Malawi</option>
													  <option value="Malaysia" <?php if($country=="Malaysia"){ echo 'selected="selected"'; } ?>>Malaysia</option>
													  <option value="Maldives" <?php if($country=="Maldives"){ echo 'selected="selected"'; } ?>>Maldives</option>
													  <option value="Mali" <?php if($country=="Mali"){ echo 'selected="selected"'; } ?>>Mali</option>
													  <option value="Malta" <?php if($country=="Malta"){ echo 'selected="selected"'; } ?>>Malta</option>
													  <option value="Marshall Islands" <?php if($country=="Marshall Islands"){ echo 'selected="selected"'; } ?>>Marshall Islands</option>
													  <option value="Martinique" <?php if($country=="Martinique"){ echo 'selected="selected"'; } ?>>Martinique</option>
													  <option value="Mauritania" <?php if($country=="Mauritania"){ echo 'selected="selected"'; } ?>>Mauritania</option>
													  <option value="Mauritius" <?php if($country=="Mauritius"){ echo 'selected="selected"'; } ?>>Mauritius</option>
													  <option value="Mayotte" <?php if($country=="Mayotte"){ echo 'selected="selected"'; } ?>>Mayotte</option>
													  <option value="Mexico" <?php if($country=="Mexico"){ echo 'selected="selected"'; } ?>>Mexico</option>
													  <option value="Micronesia" <?php if($country=="Micronesia"){ echo 'selected="selected"'; } ?>>Micronesia, Federated States of</option>
													  <option value="Moldova" <?php if($country=="Moldova"){ echo 'selected="selected"'; } ?>>Moldova, Republic of</option>
													  <option value="Monaco" <?php if($country=="Monaco"){ echo 'selected="selected"'; } ?>>Monaco</option>
													  <option value="Mongolia" <?php if($country=="Mongolia"){ echo 'selected="selected"'; } ?>>Mongolia</option>
													  <option value="Montserrat" <?php if($country=="Montserrat"){ echo 'selected="selected"'; } ?>>Montserrat</option>
													  <option value="Morocco" <?php if($country=="Morocco"){ echo 'selected="selected"'; } ?>>Morocco</option>
													  <option value="Mozambique" <?php if($country=="Mozambique"){ echo 'selected="selected"'; } ?>>Mozambique</option>
													  <option value="Myanmar" <?php if($country=="Myanmar"){ echo 'selected="selected"'; } ?>>Myanmar</option>
													  <option value="Namibia" <?php if($country=="Namibia"){ echo 'selected="selected"'; } ?>>Namibia</option>
													  <option value="Nauru" <?php if($country=="Nauru"){ echo 'selected="selected"'; } ?>>Nauru</option>
													  <option value="Nepal" <?php if($country=="Nepal"){ echo 'selected="selected"'; } ?>>Nepal</option>
													  <option value="Netherlands" <?php if($country=="Netherlands"){ echo 'selected="selected"'; } ?>>Netherlands</option>
													  <option value="Netherlands Antilles" <?php if($country=="Netherlands Antilles"){ echo 'selected="selected"'; } ?>>Netherlands Antilles</option>
													  <option value="New Caledonia" <?php if($country=="New Caledonia"){ echo 'selected="selected"'; } ?>>New Caledonia</option>
													  <option value="New Zealand" <?php if($country=="New Zealand"){ echo 'selected="selected"'; } ?>>New Zealand</option>
													  <option value="Nicaragua" <?php if($country=="Nicaragua"){ echo 'selected="selected"'; } ?>>Nicaragua</option>
													  <option value="Niger" <?php if($country=="Niger"){ echo 'selected="selected"'; } ?>>Niger</option>
													  <option value="Nigeria" <?php if($country=="Nigeria"){ echo 'selected="selected"'; } ?>>Nigeria</option>
													  <option value="Niue" <?php if($country=="Niue"){ echo 'selected="selected"'; } ?>>Niue</option>
													  <option value="Norfolk Island" <?php if($country=="Norfolk Island"){ echo 'selected="selected"'; } ?>>Norfolk Island</option>
													  <option value="Northern Mariana Islands" <?php if($country=="Northern Mariana Islands"){ echo 'selected="selected"'; } ?>>Northern Mariana Islands</option>
													  <option value="Norway" <?php if($country=="Norway"){ echo 'selected="selected"'; } ?>>Norway</option>
													  <option value="Oman" <?php if($country=="Oman"){ echo 'selected="selected"'; } ?>>Oman</option>
													  <option value="Pakistan" <?php if($country=="Pakistan"){ echo 'selected="selected"'; } ?>>Pakistan</option>
													  <option value="Palau" <?php if($country=="Palau"){ echo 'selected="selected"'; } ?>>Palau</option>
													  <option value="Panama" <?php if($country=="Panama"){ echo 'selected="selected"'; } ?>>Panama</option>
													  <option value="Papua New Guinea" <?php if($country=="Papua New Guinea"){ echo 'selected="selected"'; } ?>>Papua New Guinea</option>
													  <option value="Paraguay" <?php if($country=="Paraguay"){ echo 'selected="selected"'; } ?>>Paraguay</option>
													  <option value="Peru" <?php if($country=="Peru"){ echo 'selected="selected"'; } ?>>Peru</option>
													  <option value="Philippines" <?php if($country=="Philippines"){ echo 'selected="selected"'; } ?>>Philippines</option>
													  <option value="Pitcairn" <?php if($country=="Pitcairn"){ echo 'selected="selected"'; } ?>>Pitcairn</option>
													  <option value="Poland" <?php if($country=="Poland"){ echo 'selected="selected"'; } ?>>Poland</option>
													  <option value="Portugal" <?php if($country=="Portugal"){ echo 'selected="selected"'; } ?>>Portugal</option>
													  <option value="Puerto Rico" <?php if($country=="Puerto Rico"){ echo 'selected="selected"'; } ?>>Puerto Rico</option>
													  <option value="Qatar" <?php if($country=="Puerto Rico"){ echo 'selected="selected"'; } ?>>Qatar</option>
													  <option value="Reunion" <?php if($country=="Puerto Rico"){ echo 'selected="selected"'; } ?>>Reunion</option>
													  <option value="Romania" <?php if($country=="Romania"){ echo 'selected="selected"'; } ?>>Romania</option>
													  <option value="Russia" <?php if($country=="Russia"){ echo 'selected="selected"'; } ?>>Russian Federation</option>
													  <option value="Saint Kitts and Nevis" <?php if($country=="Saint Kitts and Nevis"){ echo 'selected="selected"'; } ?>>Saint Kitts and Nevis</option> 
													  <option value="Saint LUCIA" <?php if($country=="Saint LUCIA"){ echo 'selected="selected"'; } ?>>Saint LUCIA</option>
													  <option value="Saint Vincent" <?php if($country=="Saint Vincent"){ echo 'selected="selected"'; } ?>>Saint Vincent and the Grenadines</option>
													  <option value="Samoa" <?php if($country=="Samoa"){ echo 'selected="selected"'; } ?>>Samoa</option>
													  <option value="San Marino" <?php if($country=="San Marino"){ echo 'selected="selected"'; } ?>>San Marino</option>
													  <option value="Sao Tome and Principe" <?php if($country=="Sao Tome and Principe"){ echo 'selected="selected"'; } ?>>Sao Tome and Principe</option> 
													  <option value="Saudi Arabia" <?php if($country=="Saudi Arabia"){ echo 'selected="selected"'; } ?>>Saudi Arabia</option>
													  <option value="Senegal" <?php if($country=="Senegal"){ echo 'selected="selected"'; } ?>>Senegal</option>
													  <option value="Seychelles" <?php if($country=="Seychelles"){ echo 'selected="selected"'; } ?>>Seychelles</option>
													  <option value="Sierra" <?php if($country=="Sierra"){ echo 'selected="selected"'; } ?>>Sierra Leone</option>
													  <option value="Singapore" <?php if($country=="Singapore"){ echo 'selected="selected"'; } ?>>Singapore</option>
													  <option value="Slovakia" <?php if($country=="Slovakia"){ echo 'selected="selected"'; } ?>>Slovakia (Slovak Republic)</option>
													  <option value="Slovenia" <?php if($country=="Slovenia"){ echo 'selected="selected"'; } ?>>Slovenia</option>
													  <option value="Solomon Islands" <?php if($country=="Solomon Islands"){ echo 'selected="selected"'; } ?>>Solomon Islands</option>
													  <option value="Somalia" <?php if($country=="Somalia"){ echo 'selected="selected"'; } ?>>Somalia</option>
													  <option value="South Africa" <?php if($country=="South Africa"){ echo 'selected="selected"'; } ?>>South Africa</option>
													  <option value="South Georgia" <?php if($country=="South Georgia"){ echo 'selected="selected"'; } ?>>South Georgia and the South Sandwich Islands</option>
													  <option value="Span" <?php if($country=="Span"){ echo 'selected="selected"'; } ?>>Spain</option>
													  <option value="SriLanka" <?php if($country=="SriLanka"){ echo 'selected="selected"'; } ?>>Sri Lanka</option>
													  <option value="St. Helena" <?php if($country=="St. Helena"){ echo 'selected="selected"'; } ?>>St. Helena</option>
													  <option value="St. Pierre and Miguelon" <?php if($country=="St. Pierre and Miguelon"){ echo 'selected="selected"'; } ?>>St. Pierre and Miquelon</option>
													  <option value="Sudan" <?php if($country=="Sudan"){ echo 'selected="selected"'; } ?>>Sudan</option>
													  <option value="Suriname" <?php if($country=="Suriname"){ echo 'selected="selected"'; } ?>>Suriname</option>
													  <option value="Svalbard" <?php if($country=="Svalbard"){ echo 'selected="selected"'; } ?>>Svalbard and Jan Mayen Islands</option>
													  <option value="Swaziland" <?php if($country=="Swaziland"){ echo 'selected="selected"'; } ?>>Swaziland</option>
													  <option value="Sweden" <?php if($country=="Sweden"){ echo 'selected="selected"'; } ?>>Sweden</option>
													  <option value="Switzerland" <?php if($country=="Switzerland"){ echo 'selected="selected"'; } ?>>Switzerland</option>
													  <option value="Syria" <?php if($country=="Syria"){ echo 'selected="selected"'; } ?>>Syrian Arab Republic</option>
													  <option value="Taiwan" <?php if($country=="Taiwan"){ echo 'selected="selected"'; } ?>>Taiwan, Province of China</option>
													  <option value="Tajikistan" <?php if($country=="Tajikistan"){ echo 'selected="selected"'; } ?>>Tajikistan</option>
													  <option value="Tanzania" <?php if($country=="Tanzania"){ echo 'selected="selected"'; } ?>>Tanzania, United Republic of</option>
													  <option value="Thailand" <?php if($country=="Thailand"){ echo 'selected="selected"'; } ?>>Thailand</option>
													  <option value="Togo" <?php if($country=="Togo"){ echo 'selected="selected"'; } ?>>Togo</option>
													  <option value="Tokelau" <?php if($country=="Tokelau"){ echo 'selected="selected"'; } ?>>Tokelau</option>
													  <option value="Tonga" <?php if($country=="Tonga"){ echo 'selected="selected"'; } ?>>Tonga</option>
													  <option value="Trinidad and Tobago" <?php if($country=="Trinidad and Tobago"){ echo 'selected="selected"'; } ?>>Trinidad and Tobago</option>
													  <option value="Tunisia" <?php if($country=="Tunisia"){ echo 'selected="selected"'; } ?>>Tunisia</option>
													  <option value="Turkey" <?php if($country=="Turkey"){ echo 'selected="selected"'; } ?>>Turkey</option>
													  <option value="Turkmenistan" <?php if($country=="Turkmenistan"){ echo 'selected="selected"'; } ?>>Turkmenistan</option>
													  <option value="Turks and Caicos" <?php if($country=="Turks and Caicos"){ echo 'selected="selected"'; } ?>>Turks and Caicos Islands</option>
													  <option value="Tuvalu" <?php if($country=="Tuvalu"){ echo 'selected="selected"'; } ?>>Tuvalu</option>
													  <option value="Uganda" <?php if($country=="Uganda"){ echo 'selected="selected"'; } ?>>Uganda</option>
													  <option value="Ukraine" <?php if($country=="Ukraine"){ echo 'selected="selected"'; } ?>>Ukraine</option>
													  <option value="United Arab Emirates" <?php if($country=="United Arab Emirates"){ echo 'selected="selected"'; } ?>>United Arab Emirates</option>
													  <option value="United Kingdom" <?php if($country=="United Kingdom"){ echo 'selected="selected"'; } ?>>United Kingdom</option>
													  <option value="United States" <?php if($country=="United States"){ echo 'selected="selected"'; } ?>>United States</option>
													  <option value="United States Minor Outlying Islands" <?php if($country=="United Minor Outlying Islands"){ echo 'selected="selected"'; } ?>>United States Minor Outlying Islands</option>
													  <option value="Uruguay" <?php if($country=="Uruguay"){ echo 'selected="selected"'; } ?>>Uruguay</option>
													  <option value="Uzbekistan" <?php if($country=="Uzbekistan"){ echo 'selected="selected"'; } ?>>Uzbekistan</option>
													  <option value="Vanuatu" <?php if($country=="Vanuatu"){ echo 'selected="selected"'; } ?>>Vanuatu</option>
													  <option value="Venezuela" <?php if($country=="Venezuela"){ echo 'selected="selected"'; } ?>>Venezuela</option>
													  <option value="Vietnam" <?php if($country=="Vietnam"){ echo 'selected="selected"'; } ?>>Viet Nam</option>
													  <option value="Virgin Islands (British)" <?php if($country=="Virgin Islands (British)"){ echo 'selected="selected"'; } ?>>Virgin Islands (British)</option>
													  <option value="Virgin Islands (U.S)" <?php if($country=="Virgin Islands (U.S)"){ echo 'selected="selected"'; } ?>>Virgin Islands (U.S.)</option>
													  <option value="Wallis and Futana Islands" <?php if($country=="Wallis and Futana Islands"){ echo 'selected="selected"'; } ?>>Wallis and Futuna Islands</option>
													  <option value="Western Sahara" <?php if($country=="Western Sahara"){ echo 'selected="selected"'; } ?>>Western Sahara</option>
													  <option value="Yemen" <?php if($country=="Yemen"){ echo 'selected="selected"'; } ?>>Yemen</option>
													  <option value="Serbia" <?php if($country=="Serbia"){ echo 'selected="selected"'; } ?>>Serbia</option>
													  <option value="Zambia" <?php if($country=="Zambia"){ echo 'selected="selected"'; } ?>>Zambia</option>
													  <option value="Zimbabwe" <?php if($country=="Zimbabwe"){ echo 'selected="selected"'; } ?>>Zimbabwe</option>
                                                </select>
                                            </div>
										</div>
										
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <input type="text" class="form-control" name="cityValue" id="cityValue" value="<?php echo $city; ?>">
                                            </div>
									    </div>
										<?php } ?>	
										</div>
								</div>
										
										<div class="form-row">
                                                    <label class="sr-only" for="val-currency">Currency
                                                        <span class="text-danger">*</span>
														
                                                    </label>
                                                    <div class="col-auto my-1">
														<input type="text" class="form-control" name="estimated_value" id="estimated_value" value="<?php echo $estimated_value; ?>" required />
                                                    </div>
													<div class="col-auto my-1">
														<input type="text" class="form-control" name="asset_source" id="asset_source" value="<?php echo $asset_source; ?>" required />
                                                    </div>
                                        </div>
										
										<div class="form-row">
											<div class="form-group col-md-3" required>
												<label>Is Joint Asset: <span class="text-danger">*</span></label>
												<label class="radio-inline" id="jointyes">
													<input type="radio" value="y" name="jointopt" id="jointyes" <?php if($joint_asset == 'y' || $joint_asset == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline" id="jointno">
                                                <input type="radio" value="n" name="jointopt" <?php if($joint_asset == 'n' || $joint_asset == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="percentage_of_shares" style="display:none;">
                                                <label>Percentage of shares <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="percentage_of_shares_val" name="percentage_of_shares" value="<?php echo $percentage_of_shares; ?>">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Bought Asset <span class="text-danger">*</span></label>
												<label class="radio-inline">
													<input type="radio" name="boughtopt" value="y" id="boughtyes" <?php if($is_bought == 'y' || $is_bought == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="boughtopt" value="n" id="boughtno" <?php if($is_bought == 'n' || $is_bought == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="bought_seller" style="display:none;">
                                                <label>Seller name <span class="text-danger">*</span></label>
                                                <input type="text" id="seller_name" name="seller_name" class="form-control" value="<?php echo $seller_name; ?>">
                                            </div>
											<div class="form-group col-md-2" id="bought_amount" for="val-digits" style="display:none;">
                                                <label>Amount <span class="text-danger">*</span></label>
                                                <input type="text" id="buying_price" name="buying_price" class="form-control" value="<?php echo $buying_price; ?>">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Loan Asset: </label>
												<label class="radio-inline">
													<input type="radio" name="loanopt" id="loanyes" value="y" <?php if($by_loan == 'y' || $by_loan == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="loanopt" id="loanno" value="n" <?php if($by_loan == 'n' || $by_loan == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="loan_bank" style="display:none;">
                                                <label>Bank Name</label>
                                                <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $bank_name; ?>">
                                            </div>
											<div class="form-group col-md-2" id="installmentDiv" style="display:none;">
                                                <label>Installment</label>
                                                <input type="text" name="installment" id="installment" class="form-control" value="<?php echo $installment; ?>">
                                            </div>
											<div class="form-group col-md-2" id="loanAmountDiv" style="display:none;">
                                                <label>Loan Amount</label>
                                                <input type="text" name="loan_amount" id="loan_amount" class="form-control" value="<?php echo $loan_amount; ?>">
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date" style="display:none;">
												<label>Date to clear loan</label>
												<input type="text" name="expected_loan_clear_date" class="form-control" value="<?php echo $expected_loan_clear_date; ?>" id="mdate">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Rent Asset: </label>
												<label class="radio-inline">
													<input type="radio" name="is_rent" value="y" id="is_rent_yes" <?php if($is_rent == 'y' || $is_rent == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline">
													<input type="radio" name="is_rent" value="n" id="is_rent_no" <?php if($is_rent == 'n' || $is_rent == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="monthly_pay" style="display:none;">
                                                <label>Monthly pay</label>
                                                <input type="text" name="monthly_pay" id="monthly_pay_amt" class="form-control" value="<?php echo $monthly_pay; ?>">
                                            </div>
										</div>
										
										<input type="hidden" name="immovable_asset_declaration_id" value="<?php echo $immovable_asset_declaration_id; ?>" />
										<input type="hidden" name="immovable_asset_id" value="<?php echo $immovable_asset_id; ?>" />
                                        <button type="submit" name="btnEdit"  class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			
            
        <script type="text/javascript">
		
		function getDetails(){
			var getSelectedValueJoint = document.querySelector( 'input[name="jointopt"]:checked');
			//var getSelectedValueJointValue = document.querySelector('input[name="jointopt"]:checked').value;
			var getSelectedValueBought = document.querySelector( 'input[name="boughtopt"]:checked');
			var getSelectedValueLoan = document.querySelector( 'input[name="loanopt"]:checked');
			var getSelectedValueRent = document.querySelector( 'input[name="is_rent"]:checked');
			let x = document.forms["rsForm"]["jointopt"].value;
			let jointShare = document.forms["rsForm"]["percentage_of_shares"].value;
			let bought = document.forms["rsForm"]["boughtopt"].value;
			let seller = document.forms["rsForm"]["seller_name"].value;
			let price = document.forms["rsForm"]["buying_price"].value;
			let loan = document.forms["rsForm"]["loanopt"].value;
			let bank = document.forms["rsForm"]["bank_name"].value;
			let installment = document.forms["rsForm"]["installment"].value;
			let clearDate = document.forms["rsForm"]["expected_loan_clear_date"].value;
			let rent = document.forms["rsForm"]["is_rent"].value;
			let monthlyPay = document.forms["rsForm"]["monthly_pay"].value;
			<!--Locations validation-->
			let locationValue = document.forms["rsForm"]["location"].value;
			let countryValue = document.forms["rsForm"]["countryValue"].value;
			let cityValue = document.forms["rsForm"]["cityValue"].value;
			let villageValue = document.forms["rsForm"]["village"].value;
			
			if(locationValue == '2'){
				if(countryValue == ""){
					alert("Please enter Country from abroad");
					return false;
				}
				else if(cityValue == ""){
					alert("Please enter City of this Country");
					return false;
				}
			}
			else if(locationValue == '1'){
				if(villageValue == ""){
					alert("Please select location of Rwanda up to village");
					return false;
				}
			}
			
			if(x == 'y' && jointShare == ""){
				alert("Please enter shares percentage");
				return false;
			}
			if(bought == 'y'){
				if(seller == ""){
					alert("Please enter seller name");
					return false;
				}
				else if(price == ""){
					alert("Please enter Bought price");
					return false;
				}
			}
			
			if(loan == 'y'){
				if(bank == ""){
					alert("Please enter Bank name");
					return false;
				}
				else if(installment == ""){
					alert("Please enter Installment for Loan");
					return false;
				}else if(clearDate == ""){
					alert("Please select clear date");
					return false;
				}
			}
			
			if(rent == 'y'){
				if(monthlyPay == ""){
					alert("Please enter monthly pay");
					return false;
				}
			}
			
			
			
			if (document.forms[0]['asset_owner'].value == 0) {
				alert("Please Select Owner Asset");
				return false;
			}
			if (document.forms[0]['location'].value == 0) {
				alert("Please select location");
				return false;
			}
			
			
			if(getSelectedValueJoint == null){
				alert("Please Select Joint YES or NO");
				return false;
			}
			if(getSelectedValueBought == null){
				alert("Please Select Bought YES or NO");
				return false;
			}
			if(getSelectedValueLoan == null){
				alert("Please Select Loan YES or NO");
				return false;
			}
			if(getSelectedValueRent == null){
				alert("Please Select Rent YES or NO");
				return false;
			}
		}
		
		
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
		
		</script>