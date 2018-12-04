<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Pikpay';
?>

<div class="section">
    <div class="container">
        <div id="pik-pay-messages"> <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) { echo '<div class="alert alert-' . $key . '">' . $message . '</div>'; } ?>  </div>
                    <code>Order: <?php echo $order->order_info; ?></code>
                    <div style="background-color: white; padding: 15px">
                        <blockquote><?php echo $advert->description ?></blockquote>
                    </div>

                    <form id="pikpay-form" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Personal information</h1>
                                <div class="form-group">
                                    <label>Name and surname</label>
                                    <input class="form-control" type="text" name="ch_full_name" id="ch_full_name" value="<?php echo (isset($_POST['ch_full_name'])) ? $_POST['ch_full_name'] : $order->ch_full_name; ?>" required >
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="ch_email" id="ch_email" value="<?php echo (isset($_POST['ch_email'])) ? $_POST['ch_email'] : $order->ch_email; ?>" required >
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" name="ch_address" id="ch_address" value="<?php echo (isset($_POST['ch_address'])) ? $_POST['ch_address'] : $order->ch_address; ?>" required >
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <label>Town</label>
                                            <input class="form-control" type="text" name="ch_city" id="ch_city" value="<?php echo (isset($_POST['ch_city'])) ? $_POST['ch_city'] : $order->ch_city; ?>" required >
                                        </div>
                                        <div class="col-md-4">
                                            <label>ZIP</label>
                                            <input class="form-control" type="text" name="ch_zip" id="ch_zip" value="<?php echo (isset($_POST['ch_zip'])) ? $_POST['ch_zip'] : $order->ch_zip; ?>" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <!-- <input class="form-control" type="text" name="ch_country" id="ch_country" value="<?php echo (isset($_POST['ch_country'])) ? $_POST['ch_country'] : $order->ch_country; ?>" required > -->
                                    <select name="ch_country" class="form-control" id="ch_country">
                                        <option value="Afganistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                      
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antigua and Barbuda">Antigua &amp; Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bonaire">Bonaire</option>
                                        <option selected value="Bosnia and Herzegovina">Bosnia &amp; Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Canary Islands">Canary Islands</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                      
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Channel Islands">Channel Islands</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Island">Cocos Island</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote DIvoire">Cote D'Ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                      
                                        <option value="Curaco">Curacao</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Ter">French Southern Ter</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Great Britain">Great Britain</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea North">Korea North</option>
                                        <option value="Korea Sout">Korea South</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                      
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Midway Islands">Midway Islands</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Nambia">Nambia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherland Antilles">Netherland Antilles</option>
                                        <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                        <option value="Nevis">Nevis</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau Island">Palau Island</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Phillipines">Philippines</option>
                                        <option value="Pitcairn Island">Pitcairn Island</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                      
                                        <option value="Qatar">Qatar</option>
                                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                                        <option value="Republic of Serbia">Republic of Serbia</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="St Barthelemy">St Barthelemy</option>
                                        <option value="St Eustatius">St Eustatius</option>
                                        <option value="St Helena">St Helena</option>
                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                        <option value="St Lucia">St Lucia</option>
                                        <option value="St Maarten">St Maarten</option>
                                        <option value="St Pierre and Miquelon">St Pierre &amp; Miquelon</option>
                                        <option value="St Vincent and Grenadines">St Vincent &amp; Grenadines</option>
                                        <option value="Saipan">Saipan</option>
                                    
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome &amp; Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Tahiti">Tahiti</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                       
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad &amp; Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Is">Turks &amp; Caicos Is</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Erimates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                      
                                        <option value="Uraguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                     
                                        
                                        <option value="Wallis and Futana Is">Wallis &amp; Futana Is</option>
                                   
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                        </select>

                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" name="ch_phone" id="ch_phone" value="<?php echo (isset($_POST['ch_phone'])) ? $_POST['ch_phone'] : $order->ch_phone; ?>" required >
                                </div>
                            </div>
                            <div class="col-md-6">
                            <h1>Card</h1>
                            <!-- <div id="card-instructions">
                                <img src="<?= Url::to('@web/css/images/card_instructions.png'); ?>" class="img-responsive">
                            </div><br> -->

                                <div class="form-group">
                                    <label>Card number</label>
                                    <input type="text" name="pan" id="pan" class="form-control unknown-card" placeholder="XXXX XXXX XXXX XXXX" required >
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiration date</label>
                                            <div class="row">
                                                <div class="col-xs-6" style="padding-right: 5px">
                                                    <select id="month" class="form-control" name="month">
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>

                                                <div class="col-xs-6" style="padding-left: 0">
                                                    <select id="year" class="form-control" name="year">
                                                        <?php $y = date('y'); ?>
                                                        <?php for ($x = 0; $x < 10; $x++){ ?>
                                                        <option value="<?php echo $y + $x ?>"><?php echo $y + $x ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CVV</label>
                                            <input id="cvv" type="text" name="cvv" class="form-control" placeholder="XXX" required>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <button style="font-size: 18px" type="submit" class="btn btn-success form-control">Pay: 1 EUR = 1,95583 BAM. Sum <?php echo $order->amount ?> KM</b></button>
                                <div style="text-align: center; margin-top: 15px;">


                                    <img style="margin: auto;" width="50%" src="<?= Url::to('@web/css/images/pikpay_extended.png'); ?>" class="img-responsive" alt="pikpay-logo">
                                    <small>PikPay - Pay safely</small>
                                </div>
                            </div>

                        </div>

                    </form>
    </div>
</div>
