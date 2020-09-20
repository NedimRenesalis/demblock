<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Pikpay';
?>

<div class="section">
    <div class="container">
        <div id="pik-pay-messages"> <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                                        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                                    } ?> </div>
        <code>Bestellung: <?php echo $order->order_info; ?></code>
        <div style="background-color: white; padding: 15px">
            <blockquote><?php echo $advert->description ?></blockquote>
        </div>

        <form id="pikpay-form" method="post" action="">
            <div class="row">
                <div class="col-md-6">
                    <h1>Persönliche Infos</h1>
                    <div class="form-group">
                        <label>Vor und Nachname</label>
                        <input class="form-control" type="text" name="ch_full_name" id="ch_full_name" value="<?php echo (isset($_POST['ch_full_name'])) ? $_POST['ch_full_name'] : $order->ch_full_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="ch_email" id="ch_email" value="<?php echo (isset($_POST['ch_email'])) ? $_POST['ch_email'] : $order->ch_email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <input class="form-control" type="text" name="ch_address" id="ch_address" value="<?php echo (isset($_POST['ch_address'])) ? $_POST['ch_address'] : $order->ch_address; ?>" required>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Stadt</label>
                                <input class="form-control" type="text" name="ch_city" id="ch_city" value="<?php echo (isset($_POST['ch_city'])) ? $_POST['ch_city'] : $order->ch_city; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label>Postleitzahl</label>
                                <input class="form-control" type="text" name="ch_zip" id="ch_zip" value="<?php echo (isset($_POST['ch_zip'])) ? $_POST['ch_zip'] : $order->ch_zip; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Staat</label>
                        <!-- <input class="form-control" type="text" name="ch_country" id="ch_country" value="<?php echo (isset($_POST['ch_country'])) ? $_POST['ch_country'] : $order->ch_country; ?>" required > -->
                        <select name="ch_country" class="form-control" id="ch_country">
                            <option value="Andorra">Andorra</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Albania">Albania</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="Angola">Angola</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Argentina">Argentina</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Austria">Austria</option>
                            <option value="Australia">Australia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bosnia And Herzegovina" selected>Bosnia And Herzegovina</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Benin">Benin</option>
                            <option value="Saint Barthelemy">Saint Barthelemy</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belize">Belize</option>
                            <option value="Canada">Canada</option>
                            <option value="Cocos (keeling) Islands">Cocos (keeling) Islands</option>
                            <option value="Congo, The Democratic Republic Of The">Congo, The Democratic Republic Of The</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Congo">Congo</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Cote D Ivoire">Cote D Ivoire</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Chile">Chile</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Germany">Germany</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Spain">Spain</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Finland">Finland</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Falkland Islands (malvinas)">Falkland Islands (malvinas)</option>
                            <option value="Micronesia, Federated States Of">Micronesia, Federated States Of</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Greece">Greece</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guam">Guam</option>
                            <option value="Guinea-bissau">Guinea-bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Isle Of Man">Isle Of Man</option>
                            <option value="India">India</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option>
                            <option value="Iceland">Iceland</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Japan">Japan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                            <option value="Korea Democratic Peoples Republic Of">Korea Democratic Peoples Republic Of</option>
                            <option value="Korea Republic Of">Korea Republic Of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Kazakstan">Kazakstan</option>
                            <option value="Lao Peoples Democratic Republic">Lao Peoples Democratic Republic</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Saint Martin">Saint Martin</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="North Macedonia">North Macedonia</option>
                            <option value="Mali">Mali</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Macau">Macau</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Malta">Malta</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Namibia">Namibia</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Norway">Norway</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Niue">Niue</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Oman">Oman</option>
                            <option value="Panama">Panama</option>
                            <option value="Peru">Peru</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Poland">Poland</option>
                            <option value="Saint Pierre And Miquelon">Saint Pierre And Miquelon</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Palau">Palau</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Somalia">Somalia</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Sao Tome And Principe">Sao Tome And Principe</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                            <option value="Chad">Chad</option>
                            <option value="Togo">Togo</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Timor-leste">Timor-leste</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Taiwan, Province Of China">Taiwan, Province Of China</option>
                            <option value="Tanzania, United Republic Of">Tanzania, United Republic Of</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="Uganda">Uganda</option>
                            <option value="United States">United States</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Holy See (vatican City State)">Holy See (vatican City State)</option>
                            <option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Wallis And Futuna">Wallis And Futuna</option>
                            <option value="Samoa">Samoa</option>
                            <option value="Kosovo">Kosovo</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>

                        </select>

                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" type="text" name="ch_phone" id="ch_phone" value="<?php echo (isset($_POST['ch_phone'])) ? $_POST['ch_phone'] : $order->ch_phone; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>Karte</h1>
                    <!-- <div id="card-instructions">
                                <img src="<?= Url::to('@web/css/images/card_instructions.png'); ?>" class="img-responsive">
                            </div><br> -->

                    <div class="form-group">
                        <label>Kartennummer</label>
                        <input type="text" name="pan" id="pan" class="form-control unknown-card" placeholder="XXXX XXXX XXXX XXXX" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ablaufdatum</label>
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
                                            <?php for ($x = 0; $x < 10; $x++) { ?>
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
                    <button style="font-size: 18px" type="submit" class="btn btn-success form-control">Bezahlen: 1 EUR ist 1,95583 BAM. Summe <?php echo $order->amount ?> KM</b></button>
                    <div style="text-align: center; margin-top: 15px;">


                        <img style="margin: auto;" width="50%" src="<?= Url::to('@web/css/images/pikpay_extended.png'); ?>" class="img-responsive" alt="pikpay-logo">
                        <small>PikPay - Sicher bezahlen</small>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>