<?php

/**
 * Created by PhpStorm.
 * User: I7
 * Date: 30.5.2017
 * Time: 18:43
 */
$this->title = "demblock";

$countryArray = array(
    'AD' => array('name' => 'ANDORRA', 'code' => '376'),
    'AE' => array('name' => 'UNITED ARAB EMIRATES', 'code' => '971'),
    
    'AG' => array('name' => 'ANTIGUA AND BARBUDA', 'code' => '1268'),
    'AI' => array('name' => 'ANGUILLA', 'code' => '1264'),
    'AL' => array('name' => 'ALBANIA', 'code' => '355'),
    'AM' => array('name' => 'ARMENIA', 'code' => '374'),
    'AN' => array('name' => 'NETHERLANDS ANTILLES', 'code' => '599'),
    'AO' => array('name' => 'ANGOLA', 'code' => '244'),
    'AQ' => array('name' => 'ANTARCTICA', 'code' => '672'),
    'AR' => array('name' => 'ARGENTINA', 'code' => '54'),
    
    'AT' => array('name' => 'AUSTRIA', 'code' => '43'),
    'AU' => array('name' => 'AUSTRALIA', 'code' => '61'),
    'AW' => array('name' => 'ARUBA', 'code' => '297'),
    'AZ' => array('name' => 'AZERBAIJAN', 'code' => '994'),
    'BA' => array('name' => 'BOSNIA AND HERZEGOVINA', 'code' => '387'),
    'BB' => array('name' => 'BARBADOS', 'code' => '1246'),
    'BD' => array('name' => 'BANGLADESH', 'code' => '880'),
    'BE' => array('name' => 'BELGIUM', 'code' => '32'),
    'BF' => array('name' => 'BURKINA FASO', 'code' => '226'),
    'BG' => array('name' => 'BULGARIA', 'code' => '359'),
    'BH' => array('name' => 'BAHRAIN', 'code' => '973'),
    'BI' => array('name' => 'BURUNDI', 'code' => '257'),
    'BJ' => array('name' => 'BENIN', 'code' => '229'),
    'BL' => array('name' => 'SAINT BARTHELEMY', 'code' => '590'),
    'BM' => array('name' => 'BERMUDA', 'code' => '1441'),
    'BN' => array('name' => 'BRUNEI DARUSSALAM', 'code' => '673'),
    'BO' => array('name' => 'BOLIVIA', 'code' => '591'),
    'BR' => array('name' => 'BRAZIL', 'code' => '55'),
    'BS' => array('name' => 'BAHAMAS', 'code' => '1242'),
    'BT' => array('name' => 'BHUTAN', 'code' => '975'),
    'BW' => array('name' => 'BOTSWANA', 'code' => '267'),
    'BY' => array('name' => 'BELARUS', 'code' => '375'),
    'BZ' => array('name' => 'BELIZE', 'code' => '501'),
    'CA' => array('name' => 'CANADA', 'code' => '1'),
    'CC' => array('name' => 'COCOS (KEELING) ISLANDS', 'code' => '61'),
    'CD' => array('name' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'code' => '243'),
    'CF' => array('name' => 'CENTRAL AFRICAN REPUBLIC', 'code' => '236'),
    'CG' => array('name' => 'CONGO', 'code' => '242'),
    'CH' => array('name' => 'SWITZERLAND', 'code' => '41'),
    'CI' => array('name' => 'COTE D IVOIRE', 'code' => '225'),
    'CK' => array('name' => 'COOK ISLANDS', 'code' => '682'),
    'CL' => array('name' => 'CHILE', 'code' => '56'),
    'CM' => array('name' => 'CAMEROON', 'code' => '237'),
    'CN' => array('name' => 'CHINA', 'code' => '86'),
    'CO' => array('name' => 'COLOMBIA', 'code' => '57'),
    'CR' => array('name' => 'COSTA RICA', 'code' => '506'),
    
    'CV' => array('name' => 'CAPE VERDE', 'code' => '238'),
    'CX' => array('name' => 'CHRISTMAS ISLAND', 'code' => '61'),
    'CY' => array('name' => 'CYPRUS', 'code' => '357'),
    'CZ' => array('name' => 'CZECH REPUBLIC', 'code' => '420'),
    'DE' => array('name' => 'GERMANY', 'code' => '49'),
    'DJ' => array('name' => 'DJIBOUTI', 'code' => '253'),
    'DK' => array('name' => 'DENMARK', 'code' => '45'),
    'DM' => array('name' => 'DOMINICA', 'code' => '1767'),
    'DO' => array('name' => 'DOMINICAN REPUBLIC', 'code' => '1809'),
    'DZ' => array('name' => 'ALGERIA', 'code' => '213'),
    'EC' => array('name' => 'ECUADOR', 'code' => '593'),
    'EE' => array('name' => 'ESTONIA', 'code' => '372'),
    'EG' => array('name' => 'EGYPT', 'code' => '20'),
    'ER' => array('name' => 'ERITREA', 'code' => '291'),
    'ES' => array('name' => 'SPAIN', 'code' => '34'),
    'ET' => array('name' => 'ETHIOPIA', 'code' => '251'),
    'FI' => array('name' => 'FINLAND', 'code' => '358'),
    'FJ' => array('name' => 'FIJI', 'code' => '679'),
    'FK' => array('name' => 'FALKLAND ISLANDS (MALVINAS)', 'code' => '500'),
    'FM' => array('name' => 'MICRONESIA, FEDERATED STATES OF', 'code' => '691'),
    'FO' => array('name' => 'FAROE ISLANDS', 'code' => '298'),
    'FR' => array('name' => 'FRANCE', 'code' => '33'),
    'GA' => array('name' => 'GABON', 'code' => '241'),
    'GB' => array('name' => 'UNITED KINGDOM', 'code' => '44'),
    'GD' => array('name' => 'GRENADA', 'code' => '1473'),
    'GE' => array('name' => 'GEORGIA', 'code' => '995'),
    'GH' => array('name' => 'GHANA', 'code' => '233'),
    'GI' => array('name' => 'GIBRALTAR', 'code' => '350'),
    'GL' => array('name' => 'GREENLAND', 'code' => '299'),
    'GM' => array('name' => 'GAMBIA', 'code' => '220'),
    'GN' => array('name' => 'GUINEA', 'code' => '224'),
    'GQ' => array('name' => 'EQUATORIAL GUINEA', 'code' => '240'),
    'GR' => array('name' => 'GREECE', 'code' => '30'),
    'GT' => array('name' => 'GUATEMALA', 'code' => '502'),
    'GU' => array('name' => 'GUAM', 'code' => '1671'),
    'GW' => array('name' => 'GUINEA-BISSAU', 'code' => '245'),
    'GY' => array('name' => 'GUYANA', 'code' => '592'),
    'HK' => array('name' => 'HONG KONG', 'code' => '852'),
    'HN' => array('name' => 'HONDURAS', 'code' => '504'),
    'HR' => array('name' => 'CROATIA', 'code' => '385'),
    'HT' => array('name' => 'HAITI', 'code' => '509'),
    'HU' => array('name' => 'HUNGARY', 'code' => '36'),
    'ID' => array('name' => 'INDONESIA', 'code' => '62'),
    'IE' => array('name' => 'IRELAND', 'code' => '353'),
    'IL' => array('name' => 'ISRAEL', 'code' => '972'),
    'IM' => array('name' => 'ISLE OF MAN', 'code' => '44'),
    'IN' => array('name' => 'INDIA', 'code' => '91'),
    
    
    'IS' => array('name' => 'ICELAND', 'code' => '354'),
    'IT' => array('name' => 'ITALY', 'code' => '39'),
    'JM' => array('name' => 'JAMAICA', 'code' => '1876'),
    'JO' => array('name' => 'JORDAN', 'code' => '962'),
    'JP' => array('name' => 'JAPAN', 'code' => '81'),
    'KE' => array('name' => 'KENYA', 'code' => '254'),
    'KG' => array('name' => 'KYRGYZSTAN', 'code' => '996'),
    'KH' => array('name' => 'CAMBODIA', 'code' => '855'),
    'KI' => array('name' => 'KIRIBATI', 'code' => '686'),
    'KM' => array('name' => 'COMOROS', 'code' => '269'),
    'KN' => array('name' => 'SAINT KITTS AND NEVIS', 'code' => '1869'),
    
    'KR' => array('name' => 'KOREA REPUBLIC OF', 'code' => '82'),
    'KW' => array('name' => 'KUWAIT', 'code' => '965'),
    
    'KZ' => array('name' => 'KAZAKSTAN', 'code' => '7'),
    'LA' => array('name' => 'LAO PEOPLES DEMOCRATIC REPUBLIC', 'code' => '856'),
    'LB' => array('name' => 'LEBANON', 'code' => '961'),
    'LC' => array('name' => 'SAINT LUCIA', 'code' => '1758'),
    'LI' => array('name' => 'LIECHTENSTEIN', 'code' => '423'),
    'LK' => array('name' => 'SRI LANKA', 'code' => '94'),
    'LR' => array('name' => 'LIBERIA', 'code' => '231'),
    'LS' => array('name' => 'LESOTHO', 'code' => '266'),
    'LT' => array('name' => 'LITHUANIA', 'code' => '370'),
    'LU' => array('name' => 'LUXEMBOURG', 'code' => '352'),
    'LV' => array('name' => 'LATVIA', 'code' => '371'),
    'LY' => array('name' => 'LIBYAN ARAB JAMAHIRIYA', 'code' => '218'),
    'MA' => array('name' => 'MOROCCO', 'code' => '212'),
    'MC' => array('name' => 'MONACO', 'code' => '377'),
    'MD' => array('name' => 'MOLDOVA, REPUBLIC OF', 'code' => '373'),
    'ME' => array('name' => 'MONTENEGRO', 'code' => '382'),
    'MF' => array('name' => 'SAINT MARTIN', 'code' => '1599'),
    'MG' => array('name' => 'MADAGASCAR', 'code' => '261'),
    'MH' => array('name' => 'MARSHALL ISLANDS', 'code' => '692'),
    'MK' => array('name' => 'NORTH MACEDONIA', 'code' => '389'),
    'ML' => array('name' => 'MALI', 'code' => '223'),
    'MM' => array('name' => 'MYANMAR', 'code' => '95'),
    'MN' => array('name' => 'MONGOLIA', 'code' => '976'),
    'MO' => array('name' => 'MACAU', 'code' => '853'),
    'MP' => array('name' => 'NORTHERN MARIANA ISLANDS', 'code' => '1670'),
    'MR' => array('name' => 'MAURITANIA', 'code' => '222'),
    'MS' => array('name' => 'MONTSERRAT', 'code' => '1664'),
    'MT' => array('name' => 'MALTA', 'code' => '356'),
    'MU' => array('name' => 'MAURITIUS', 'code' => '230'),
    'MV' => array('name' => 'MALDIVES', 'code' => '960'),
    'MW' => array('name' => 'MALAWI', 'code' => '265'),
    'MX' => array('name' => 'MEXICO', 'code' => '52'),
    'MY' => array('name' => 'MALAYSIA', 'code' => '60'),
    'MZ' => array('name' => 'MOZAMBIQUE', 'code' => '258'),
    'NA' => array('name' => 'NAMIBIA', 'code' => '264'),
    'NC' => array('name' => 'NEW CALEDONIA', 'code' => '687'),
    'NE' => array('name' => 'NIGER', 'code' => '227'),
    'NG' => array('name' => 'NIGERIA', 'code' => '234'),
    'NI' => array('name' => 'NICARAGUA', 'code' => '505'),
    'NL' => array('name' => 'NETHERLANDS', 'code' => '31'),
    'NO' => array('name' => 'NORWAY', 'code' => '47'),
    'NP' => array('name' => 'NEPAL', 'code' => '977'),
    'NR' => array('name' => 'NAURU', 'code' => '674'),
    'NU' => array('name' => 'NIUE', 'code' => '683'),
    'NZ' => array('name' => 'NEW ZEALAND', 'code' => '64'),
    'OM' => array('name' => 'OMAN', 'code' => '968'),
    'PA' => array('name' => 'PANAMA', 'code' => '507'),
    'PE' => array('name' => 'PERU', 'code' => '51'),
    'PF' => array('name' => 'FRENCH POLYNESIA', 'code' => '689'),
    'PG' => array('name' => 'PAPUA NEW GUINEA', 'code' => '675'),
    'PH' => array('name' => 'PHILIPPINES', 'code' => '63'),
    'PK' => array('name' => 'PAKISTAN', 'code' => '92'),
    'PL' => array('name' => 'POLAND', 'code' => '48'),
    'PM' => array('name' => 'SAINT PIERRE AND MIQUELON', 'code' => '508'),
    'PN' => array('name' => 'PITCAIRN', 'code' => '870'),
    
    'PT' => array('name' => 'PORTUGAL', 'code' => '351'),
    'PW' => array('name' => 'PALAU', 'code' => '680'),
    'PY' => array('name' => 'PARAGUAY', 'code' => '595'),
    'QA' => array('name' => 'QATAR', 'code' => '974'),
    'RO' => array('name' => 'ROMANIA', 'code' => '40'),
    'RS' => array('name' => 'SERBIA', 'code' => '381'),
    'RU' => array('name' => 'RUSSIAN FEDERATION', 'code' => '7'),
    'RW' => array('name' => 'RWANDA', 'code' => '250'),
    'SA' => array('name' => 'SAUDI ARABIA', 'code' => '966'),
    'SB' => array('name' => 'SOLOMON ISLANDS', 'code' => '677'),
    'SC' => array('name' => 'SEYCHELLES', 'code' => '248'),
    'SD' => array('name' => 'SUDAN', 'code' => '249'),
    'SE' => array('name' => 'SWEDEN', 'code' => '46'),
    'SG' => array('name' => 'SINGAPORE', 'code' => '65'),
    'SH' => array('name' => 'SAINT HELENA', 'code' => '290'),
    'SI' => array('name' => 'SLOVENIA', 'code' => '386'),
    'SK' => array('name' => 'SLOVAKIA', 'code' => '421'),
    'SL' => array('name' => 'SIERRA LEONE', 'code' => '232'),
    'SM' => array('name' => 'SAN MARINO', 'code' => '378'),
    'SN' => array('name' => 'SENEGAL', 'code' => '221'),
    
    'SR' => array('name' => 'SURINAME', 'code' => '597'),
    'ST' => array('name' => 'SAO TOME AND PRINCIPE', 'code' => '239'),
    'SV' => array('name' => 'EL SALVADOR', 'code' => '503'),
    
    'SZ' => array('name' => 'SWAZILAND', 'code' => '268'),
    'TC' => array('name' => 'TURKS AND CAICOS ISLANDS', 'code' => '1649'),
    'TD' => array('name' => 'CHAD', 'code' => '235'),
    'TG' => array('name' => 'TOGO', 'code' => '228'),
    'TH' => array('name' => 'THAILAND', 'code' => '66'),
    'TJ' => array('name' => 'TAJIKISTAN', 'code' => '992'),
    'TK' => array('name' => 'TOKELAU', 'code' => '690'),
    'TL' => array('name' => 'TIMOR-LESTE', 'code' => '670'),
    'TM' => array('name' => 'TURKMENISTAN', 'code' => '993'),
    'TN' => array('name' => 'TUNISIA', 'code' => '216'),
    'TO' => array('name' => 'TONGA', 'code' => '676'),
    'TR' => array('name' => 'TURKEY', 'code' => '90'),
    'TT' => array('name' => 'TRINIDAD AND TOBAGO', 'code' => '1868'),
    'TV' => array('name' => 'TUVALU', 'code' => '688'),
    'TW' => array('name' => 'TAIWAN, PROVINCE OF CHINA', 'code' => '886'),
    'TZ' => array('name' => 'TANZANIA, UNITED REPUBLIC OF', 'code' => '255'),
    'UA' => array('name' => 'UKRAINE', 'code' => '380'),
    'UG' => array('name' => 'UGANDA', 'code' => '256'),
    
    'UY' => array('name' => 'URUGUAY', 'code' => '598'),
    'UZ' => array('name' => 'UZBEKISTAN', 'code' => '998'),
    'VA' => array('name' => 'HOLY SEE (VATICAN CITY STATE)', 'code' => '39'),
    'VC' => array('name' => 'SAINT VINCENT AND THE GRENADINES', 'code' => '1784'),
    
    'VG' => array('name' => 'VIRGIN ISLANDS, BRITISH', 'code' => '1284'),
    
    'VN' => array('name' => 'VIET NAM', 'code' => '84'),
    'VU' => array('name' => 'VANUATU', 'code' => '678'),
    'WF' => array('name' => 'WALLIS AND FUTUNA', 'code' => '681'),
    'WS' => array('name' => 'SAMOA', 'code' => '685'),
    'XK' => array('name' => 'KOSOVO', 'code' => '381'),
    
    'YT' => array('name' => 'MAYOTTE', 'code' => '262'),
    'ZA' => array('name' => 'SOUTH AFRICA', 'code' => '27'),
    'ZM' => array('name' => 'ZAMBIA', 'code' => '260'),
    'ZW' => array('name' => 'ZIMBABWE', 'code' => '263')
);

use yii\helpers\Url;

$user_query = Yii::$app->params['CROWDSALE_USERQUERY'];
$user_items = Yii::$app->params['CROWDSALE_ITEMINFO_URL'];
$allowed_domains = implode(",", Yii::$app->params["allowedDomains"]);

$script = <<< JS
    $(function() {
        /**
            Frame render data.
        */
        function renderData(id) {
            $('<iframe>', {
                src: "$user_items?$user_query=" + id,
                id:  'user-frame',
                width: '100%',
                height: '450',
                frameborder: 0,
                scrolling: 'no'
            }).appendTo('#user-verification-space');

            iFrameResize({checkOrigin: false, log: false}, '#user-frame')
        }
        
        if (!window.addEventListener) {
            window.attachEvent('onmessage', handleMessage);
        } else {
            window.addEventListener('message', handleMessage, false);
        }

        function handleMessage(event) {
            if ("$allowed_domains".indexOf(event.origin) >= 0) {
                if (event.data.event_id === 'zoomimage') {
                    $('#imagepreview').attr('src', event.data.data.hash); 
                    $('#imagemodal').modal('show');
                }
            }
        }

        renderData($model->id);     
    });
JS;
$this->registerJs($script);
?>

<br>
<br>
<div class="platinum-premium">

    <div class="profile-information container profile-wrapper">

        <div class="row">
            <div class="col-lg-12 employer-banner">
                <?php if ($model->banner != null) : ?>
                    <div class="form-group">
                        <div class=" text-center">
                            <img class="image-responsive" src="<?= "../" . $model->banner; ?>">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <br>


            <br>
            <hr>



            <div class="col-md-7">
                <div class="info info-user">
                    <div class="info-header">
                        <h3>
                            "<?php echo $companyInformation->CompanyName; ?>"</h3>
                    </div>
                    <div class="info-content">
                        <br>
                        <div class="logo-img">
                            <?php if ($model->image != null) : ?>
                                <img src="<?= $model->image; ?>" class="logo">
                            <?php endif; ?>
                            <?php if ($model->image == null) : ?>
                                <span class="logo-no-image"></span>
                            <?php endif; ?>
                        </div>

                        <div class="fullname">
                            <b><span class="title">CONTACT PERSON:</span></b>
                            <?php if ($model->full_name != '') {
                                echo $model->full_name;
                            }
                            ?>
                        </div>
                        <div class="user-info-line"></div>
                        <div class="table-field" style="margin-top: 18px;">
                            <?php if ($model->location != '') : ?>
                                <b> <span class="title">COUNTRY: </span> </b>

                                <?php foreach ($countryArray as $key => $val) : ?>
                                    <?php if ($val['name'] == $model->location) : ?>
                                        <img class="flag flag-<?php echo strtolower($key); ?>"> <span><?php echo $key; ?></span>
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="company-name table-field">
                            <?php if ($companyInformation != null && $companyInformation->Website != '' && $companyInformation->CompanyName != '') :  ?>
                                <b><span class="title">COMPANY NAME:</span></b><a href="<?php echo $companyInformation->Website; ?>"><?php echo $companyInformation->CompanyName; ?></a>
                            <?php elseif ($companyInformation != null && $companyInformation->CompanyName != '') : ?>
                                <b><span class="title">COMPANY NAME:</span></b><a><?php echo $companyInformation->CompanyName; ?></a>
                            <?php endif; ?>
                        </div>
                        <!--div class="table-field">

                        </div-->
                        <div class="user-info-line"></div>
                        <br>
                        <div class="main-info">

                            <?php
                            if ($model->mainProducts != null && $model->mainProducts != '') : ?>
                                <b> <span class="title">Main products:</span></b>
                                <span class="main-info-text">
                                <?php
                                echo $model->mainProducts;
                            endif; ?>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <div class="" style="width: 100%; height: 100%; padding-left: 0px; padding-right: 0px;">
                        <div class="info-header">
                            <h3>Verifications</h3>
                        </div>
                        <span class="main-info-text" style="padding-left: 0px; padding-right: 0px">
                            <div id="user-verification-space"></div>
                        </span>
                    </div>
                </div>
            </div>


            <div class="col-md-5">
                <!-- Start contact information -->
                <div class="info">
                    <div class="info-header">
                        <h3>Contact information</h3>
                    </div>
                    <div class="info-content">
                        <?php if (
                            $contactInfo->Facebook == "none"
                            && $contactInfo->Twitter == "none"
                            && $contactInfo->Instagram == "none"
                        ) echo 'none'; ?>
                        <?php if ($contactInfo->Facebook != "none" && $contactInfo->Facebook != null && $contactInfo->Facebook != '') : ?>
                            <div class="table-field"> <span class="title">Facebook: </span><?php echo $contactInfo->Facebook; ?></div>
                        <?php endif; ?>
                        <?php if ($contactInfo->Twitter != "none" && $contactInfo->Twitter != null && $contactInfo->Twitter != '') : ?>
                            <div class="table-field"> <span class="title">Twitter: </span><?php echo $contactInfo->Twitter; ?></div>
                        <?php endif; ?>
                        <?php if ($contactInfo->Instagram != "none" && $contactInfo->Instagram != null && $contactInfo->Instagram != '') : ?>
                            <div class="table-field"> <span class="title">Instagram: </span><?php echo $contactInfo->Instagram; ?></div>
                        <?php endif; ?>
                        <?php if ($contactInfo->Fax && $contactInfo->Fax != '') : ?>
                            <div class="table-field"> <span class="title">Fax:</span> <?php echo $contactInfo->Fax; ?></div>
                        <?php endif; ?>
                        <?php if ($contactInfo->Fax && $contactInfo->Phone != '') : ?>
                            <div class="table-field"><span class="title">Telephone:</span> <?php echo ($contactInfo->Phone == '') ? 'none' : $contactInfo->Phone; ?></div>
                        <?php endif; ?>
                        <?php if ($contactInfo->Fax && $contactInfo->Mobile != '') : ?>
                            <div class="table-field"><span class="title">Mobile:</span> <?php echo $contactInfo->Mobile; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- End contact information -->
                <div class="info">
                    <?php if ($companyInformation != null) : ?>

                        <div class="info-header">
                            <h3>Company Information</h3>
                        </div>

                        <div class="info-content">

                            <?php if ($companyInformation->CompanyName != '') :  ?>
                                <div class="table-field">
                                    <b><span class="title">Company name: </span></b><?php echo $companyInformation->CompanyName;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($companyInformation->Year != '') :  ?>
                                <div class="table-field">
                                    <span class="title">Year Estabilished: </span> <?php $companyInformation->Year;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($companyInformation->Website != '') : ?>
                                <div class="table-field">
                                    <span class="title">Official Website: </span><?php echo "<a href='$companyInformation->Website'>$companyInformation->Website</a>";  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($companyInformation->NumberOfEmployees != '') : ?>
                                <div class="table-field">
                                    <span class="title">Total Number of Employees: </span><?php echo  $companyInformation->NumberOfEmployees;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($companyInformation->RegisteredAddress != '') : ?>
                                <div class="table-field">
                                    <span class="title">Registered Address: </span><?php echo $companyInformation->RegisteredAddress;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($companyInformation->OperationalAddress != '') : ?>
                                <div class="table-field">
                                    <span class="title">Operational Address: </span><?php echo $companyInformation->OperationalAddress;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($companyInformation->AboutUs != '') : ?>
                                <div class="table-field">
                                    <span class="title">About Us:</span> <?php echo $companyInformation->AboutUs;  ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($sourcingInformation != null) : ?>
                    <div class="info">
                        <div class="info-header">
                            <h3>Sourcing Information</h3>
                        </div>

                        <div class="info-content">
                            <?php if ($sourcingInformation->AnnualPurchasingVolume != '') : ?>
                                <div class="table-field" style="margin-top: 20px;">
                                    <b><span class="title" style="margin-right: 18px !important;">Annual Purchasing Volume: </span></b><?php echo $sourcingInformation->AnnualPurchasingVolume;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($sourcingInformation->PrimarySourcingPurpose != '') : ?>
                                <div class="table-field">
                                    <span class="title">Primary Sourcing Purpose: </span><?php echo $sourcingInformation->PrimarySourcingPurpose;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($sourcingInformation->AverageSourcingFrequency != '') : ?>
                                <div class="table-field">
                                    <span class="title">Average Sourcing Frequency: </span><?php echo $sourcingInformation->AverageSourcingFrequency;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($sourcingInformation->PreferredSupplierQualifications != '') : ?>
                                <div class="table-field">
                                    <span class="title">Preferred Supplier Qualifications: </span><?php echo $sourcingInformation->PreferredSupplierQualifications;  ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($sourcingInformation->PreferredIndustries != '') : ?>
                                <div class="table-field">
                                    <span class="title">Preferred Industries: </span><?php echo $sourcingInformation->PreferredIndustries;  ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Image show -->
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                    </div>
                    <div class="modal-body">
                        <img src="" id="imagepreview" style="width: 100%;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>