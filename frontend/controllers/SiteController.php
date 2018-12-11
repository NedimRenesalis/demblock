<?php

namespace frontend\controllers;


use frontend\models\CompanyInformation;
use frontend\models\SourcingInformation;
use frontend\models\UserContactInformation;
use frontend\models\Categories;
use frontend\models\EmailConfirmation;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\helpers\Url;

use backend\models\BannerSearch;
use backend\models\Sponsored;
use backend\models\Subscribe;

use common\models\AdvertTypes;
use common\models\Banner;
use common\components\Pikpay;
use common\components\SecureTerminal;
use common\models\User;
use common\models\Advert;
use common\models\Order;
use common\models\LoginForm;
use common\models\Apply;

use frontend\models\AdvertImage;
use frontend\models\SubscribeForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\SignupEmployeeForm;
use frontend\models\SignupEmployerForm;
use frontend\models\ContactForm;
use frontend\models\UploadForm;
use frontend\models\AdvertSearch;
use frontend\models\AdvertEmployeeSearch;
use frontend\models\AdvertEmployerSearch;
use frontend\models\RegisterForm;

use kartik\mpdf\Pdf;
use PHPUnit\Framework\MockObject\Stub\Exception;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public $language;
    public $registered = false;
    public $isActive = false;
    public $countryArray = array(
        'AD'=>array('name'=>'ANDORRA','code'=>'376'),
        'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),
        'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),
        'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),
        'AL'=>array('name'=>'ALBANIA','code'=>'355'),
        'AM'=>array('name'=>'ARMENIA','code'=>'374'),
        'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),
        'AO'=>array('name'=>'ANGOLA','code'=>'244'),
        'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),
        'AR'=>array('name'=>'ARGENTINA','code'=>'54'),
   
        'AT'=>array('name'=>'AUSTRIA','code'=>'43'),
        'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),
        'AW'=>array('name'=>'ARUBA','code'=>'297'),
        'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),
        'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),
        'BB'=>array('name'=>'BARBADOS','code'=>'1246'),
        'BD'=>array('name'=>'BANGLADESH','code'=>'880'),
        'BE'=>array('name'=>'BELGIUM','code'=>'32'),
        'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),
        'BG'=>array('name'=>'BULGARIA','code'=>'359'),
        'BH'=>array('name'=>'BAHRAIN','code'=>'973'),
        'BI'=>array('name'=>'BURUNDI','code'=>'257'),
        'BJ'=>array('name'=>'BENIN','code'=>'229'),
        'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),
        'BM'=>array('name'=>'BERMUDA','code'=>'1441'),
        'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),
        'BO'=>array('name'=>'BOLIVIA','code'=>'591'),
        'BR'=>array('name'=>'BRAZIL','code'=>'55'),
        'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),
        'BT'=>array('name'=>'BHUTAN','code'=>'975'),
        'BW'=>array('name'=>'BOTSWANA','code'=>'267'),
        'BY'=>array('name'=>'BELARUS','code'=>'375'),
        'BZ'=>array('name'=>'BELIZE','code'=>'501'),
        'CA'=>array('name'=>'CANADA','code'=>'1'),
        'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),
        'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),
        'CG'=>array('name'=>'CONGO','code'=>'242'),
        'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),
        'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),
        'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),
        'CL'=>array('name'=>'CHILE','code'=>'56'),
        'CM'=>array('name'=>'CAMEROON','code'=>'237'),
        'CN'=>array('name'=>'CHINA','code'=>'86'),
        'CO'=>array('name'=>'COLOMBIA','code'=>'57'),
        'CR'=>array('name'=>'COSTA RICA','code'=>'506'),
       
        'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),
        'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),
        'CY'=>array('name'=>'CYPRUS','code'=>'357'),
        'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),
        'DE'=>array('name'=>'GERMANY','code'=>'49'),
        'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),
        'DK'=>array('name'=>'DENMARK','code'=>'45'),
        'DM'=>array('name'=>'DOMINICA','code'=>'1767'),
        'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),
        'DZ'=>array('name'=>'ALGERIA','code'=>'213'),
        'EC'=>array('name'=>'ECUADOR','code'=>'593'),
        'EE'=>array('name'=>'ESTONIA','code'=>'372'),
        'EG'=>array('name'=>'EGYPT','code'=>'20'),
        'ER'=>array('name'=>'ERITREA','code'=>'291'),
        'ES'=>array('name'=>'SPAIN','code'=>'34'),
        'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),
        'FI'=>array('name'=>'FINLAND','code'=>'358'),
        'FJ'=>array('name'=>'FIJI','code'=>'679'),
        'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),
        'FR'=>array('name'=>'FRANCE','code'=>'33'),
        'GA'=>array('name'=>'GABON','code'=>'241'),
        'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),
        'GD'=>array('name'=>'GRENADA','code'=>'1473'),
        'GE'=>array('name'=>'GEORGIA','code'=>'995'),
        'GH'=>array('name'=>'GHANA','code'=>'233'),
        'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),
        'GL'=>array('name'=>'GREENLAND','code'=>'299'),
        'GM'=>array('name'=>'GAMBIA','code'=>'220'),
        'GN'=>array('name'=>'GUINEA','code'=>'224'),
        'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),
        'GR'=>array('name'=>'GREECE','code'=>'30'),
        'GT'=>array('name'=>'GUATEMALA','code'=>'502'),
        'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),
        'HK'=>array('name'=>'HONG KONG','code'=>'852'),
        'HN'=>array('name'=>'HONDURAS','code'=>'504'),
        'HR'=>array('name'=>'CROATIA','code'=>'385'),
        'HT'=>array('name'=>'HAITI','code'=>'509'),
        'HU'=>array('name'=>'HUNGARY','code'=>'36'),
        'ID'=>array('name'=>'INDONESIA','code'=>'62'),
        'IE'=>array('name'=>'IRELAND','code'=>'353'),
        'IL'=>array('name'=>'ISRAEL','code'=>'972'),
        'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),
        'IN'=>array('name'=>'INDIA','code'=>'91'),
        'IS'=>array('name'=>'ICELAND','code'=>'354'),
        'IT'=>array('name'=>'ITALY','code'=>'39'),
        'JM'=>array('name'=>'JAMAICA','code'=>'1876'),
        'JO'=>array('name'=>'JORDAN','code'=>'962'),
        'JP'=>array('name'=>'JAPAN','code'=>'81'),
        'KE'=>array('name'=>'KENYA','code'=>'254'),
        'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),
        'KH'=>array('name'=>'CAMBODIA','code'=>'855'),
        'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),
       
        'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),
        'KW'=>array('name'=>'KUWAIT','code'=>'965'),
        'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),
        'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),
        'LB'=>array('name'=>'LEBANON','code'=>'961'),
        'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),
        'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),
        'LK'=>array('name'=>'SRI LANKA','code'=>'94'),
        'LS'=>array('name'=>'LESOTHO','code'=>'266'),
        'LT'=>array('name'=>'LITHUANIA','code'=>'370'),
        'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),
        'LV'=>array('name'=>'LATVIA','code'=>'371'),
        'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),
        'MA'=>array('name'=>'MOROCCO','code'=>'212'),
        'MC'=>array('name'=>'MONACO','code'=>'377'),
        'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),
        'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),
        'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),
        'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),
       
        'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),
        'ML'=>array('name'=>'MALI','code'=>'223'),
        'MM'=>array('name'=>'MYANMAR','code'=>'95'),
        'MN'=>array('name'=>'MONGOLIA','code'=>'976'),
        'MO'=>array('name'=>'MACAU','code'=>'853'),
        'MR'=>array('name'=>'MAURITANIA','code'=>'222'),
        'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),
        'MT'=>array('name'=>'MALTA','code'=>'356'),
        'MU'=>array('name'=>'MAURITIUS','code'=>'230'),
        'MV'=>array('name'=>'MALDIVES','code'=>'960'),
        'MW'=>array('name'=>'MALAWI','code'=>'265'),
        'MX'=>array('name'=>'MEXICO','code'=>'52'),
        'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
        'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),
        'NA'=>array('name'=>'NAMIBIA','code'=>'264'),
        'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),
        'NE'=>array('name'=>'NIGER','code'=>'227'),
        'NG'=>array('name'=>'NIGERIA','code'=>'234'),
        'NI'=>array('name'=>'NICARAGUA','code'=>'505'),
        'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),
        'NO'=>array('name'=>'NORWAY','code'=>'47'),
        'NP'=>array('name'=>'NEPAL','code'=>'977'),
        'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),
        'OM'=>array('name'=>'OMAN','code'=>'968'),
        'PA'=>array('name'=>'PANAMA','code'=>'507'),
        'PE'=>array('name'=>'PERU','code'=>'51'),
        'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),
        'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),
        'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),
        'PK'=>array('name'=>'PAKISTAN','code'=>'92'),
        'PL'=>array('name'=>'POLAND','code'=>'48'),
        'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),
        'PN'=>array('name'=>'PITCAIRN','code'=>'870'),
      
        'PT'=>array('name'=>'PORTUGAL','code'=>'351'),
        'PW'=>array('name'=>'PALAU','code'=>'680'),
        'PY'=>array('name'=>'PARAGUAY','code'=>'595'),
        'QA'=>array('name'=>'QATAR','code'=>'974'),
        'RO'=>array('name'=>'ROMANIA','code'=>'40'),
        'RS'=>array('name'=>'SERBIA','code'=>'381'),
        'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),
        'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),
        'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),
        'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),
        'SE'=>array('name'=>'SWEDEN','code'=>'46'),
        'SG'=>array('name'=>'SINGAPORE','code'=>'65'),
        'SI'=>array('name'=>'SLOVENIA','code'=>'386'),
        'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),
        'SM'=>array('name'=>'SAN MARINO','code'=>'378'),
        'SN'=>array('name'=>'SENEGAL','code'=>'221'),
        'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),
        'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),
        'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),
        'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),
        'TD'=>array('name'=>'CHAD','code'=>'235'),
        'TG'=>array('name'=>'TOGO','code'=>'228'),
        'TH'=>array('name'=>'THAILAND','code'=>'66'),
        'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),
        
        'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),
        'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),
        'TN'=>array('name'=>'TUNISIA','code'=>'216'),
        'TR'=>array('name'=>'TURKEY','code'=>'90'),
        'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),
        'TV'=>array('name'=>'TUVALU','code'=>'688'),
        'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),
        'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),
        'UA'=>array('name'=>'UKRAINE','code'=>'380'),
        'UG'=>array('name'=>'UGANDA','code'=>'256'),
        'UY'=>array('name'=>'URUGUAY','code'=>'598'),
        'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),
        'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),
        'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),
        'VE'=>array('name'=>'VENEZUELA','code'=>'58'),
        'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),
        'VN'=>array('name'=>'VIET NAM','code'=>'84'),
       
        'XK'=>array('name'=>'KOSOVO','code'=>'381'),
        'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),
        'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),
    );

    public function beforeAction($action)
    {

        $this->enableCsrfValidation = false;

        $this->registered = false;
        $this->language = "BA";
        if (!Yii::$app->user->isGuest) {
            $isBlocked = User::isBlocked(Yii::$app->user->identity->username);
            if ($isBlocked) {
                $this->actionLogout();
            } else {
                $lang = User::getUserLanguageByUsername(Yii::$app->user->identity->username);
                $this->registered = User::isNewUser(Yii::$app->user->identity->username);
                if ($lang != null) {
                    $this->language = $lang;
                }
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['visit', 'logout', 'signup', 'upload-logo', 'upload-cv', 'upload-banner', 'profil-poslodavac', 'profil-posloprimac', 'download-cv', 'apply',
                    'objavljeni-poslovi', 'aplicirani-poslovi', 'aplikacije', 'obnovi-oglas', 'html', 'pdf'],
                'rules' => [
                    [
                        'actions' => ['visit', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['subscribe', 'visit', 'logout', 'upload-logo', 'upload-cv', 'upload-banner', 'profil-poslodavac', 'profil-posloprimac', 'download-cv', 'apply',
                            'objavljeni-poslovi', 'aplicirani-poslovi', 'aplikacije', 'obnovi-oglas', 'html', 'pdf'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertSearch();
        if (Yii::$app->request->get()) {
            $searchModel->load(Yii::$app->request->get());

            $position = false;

            if ($searchModel->position != null) {
                $position = true;
            }
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $position);

            $type = -1;
            if (!Yii::$app->user->isGuest) {
                $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

                if ($user) {
                    $type = $user->getUserType();
                }
            }

            if (!$searchModel->position && !$searchModel->category && !$searchModel->location) {
                return $this->redirect("oglasi");
            } else {
                return $this->render('oglasi/' . $this->language . '-oglasi', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'employee' => $type == 3 || $type == 4
                ]);
            }
        }

        $sponsored = Sponsored::find()->where(["isPublished" => 1])->one();

        $platinum = Advert::find()
            ->andFilterWhere(['>=', 'end_advert', ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60])
            ->andFilterWhere(['<=', 'start_advert', ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60])
            ->andWhere(['payment_status' => 1])
            ->andWhere(['isPublished' => 1])
            ->andWhere(['type' => 1])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        $midi = Advert::find()
            ->andFilterWhere(['>=', 'end_advert', ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60])
            ->andFilterWhere(['<=', 'start_advert', ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60])
            ->andWhere(['payment_status' => 1])
            ->andWhere(['isPublished' => 1])
            ->andWhere(['type' => 2])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        if (!Yii::$app->user->isGuest){
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

            if ($user && $user->status == User::STATUS_INACTIVE) {
                return $this->render('index/inactive', ['user' => $user, 'registered' => $this->registered]);
            }
        }

        return $this->render('index/' . $this->language . '-index', [
            "sponsored" => $sponsored,
            "searchModel" => $searchModel,
            'registered' => $this->registered,
            'platinum' => $platinum,
            'subscribeModel' => new SubscribeForm(),
            'midi' => $midi
        ]);
    }

    /**
     * Action visit.
     */
    public function actionVisit($id)
    {
        $banner = Banner::find()->where(['slug' => $id])->one();

        if (!$banner->isActive()) {
            throw new GoneHttpException(t('app', 'The requested banner is not active anymore.'));
        }

        $banner->updateCounters(['visit_count' => 1]);

        return $this->redirect($banner->url);
    }

    /**
     * Action subscribe.
     */
    public function actionSubscribe()
    {
        $model = new SubscribeForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $data = new Subscribe();
                $data['email'] = strtolower($model->email);
                $data->save();
                notify()->addSuccess(t('app', 'Successfully subscribed!'));
            }   
            catch (Exception $e) {
                notify()->addError(t('app', 'Something went wrong!'));
            }
        } 
        else {
            notify()->addError(t('app', 'Something went wrong!'));
        }

        return $this->redirect("index");
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionPrijava()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();


        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (User::isInActive(Yii::$app->user->identity->username) == User::STATUS_INACTIVE && !User::isBlocked(Yii::$app->user->identity->username)){
                $this->isActive = true;
                return $this->render('index/inactive', ['user' => Yii::$app->user->identity]);
               // $this->actionLogout();
            } else {
                if (User::isBlocked(Yii::$app->user->identity->username)) {
                    $this->actionLogout();
                }
            }
            return $this->goBack();
        } else {
            return $this->render('prijava/' . $this->language . '-prijava', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmailLang($this->language)) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRegistracijaPoslodavac()
    {
        $model = new SignupEmployerForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->username = $model->email;
            $model->language = $this->language;
            $model->user_type = 2;
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect("profil-poslodavac");
                }
            }
        }
        return $this->render('registracija-poslodavac/' . $this->language . '-registracija-poslodavac', [
            'model' => $model,
        ]);
    }

    public function actionProfilPoslodavac()
    {
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 2) {
            if ($user->load(Yii::$app->request->post())) {
                $user->save();
            }
            return $this->render('profil-poslodavac/' . $this->language . '-profil-poslodavac', [
                'model' => $user,
                'registered' => $this->registered
            ]);
        } else {
            $this->goHome();
        }

    }

    public function actionRegistracijaPosloprimac()
    {
        $model = new SignupEmployeeForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->username = $model->email;
            $model->language = $this->language;
            $model->user_type = 3;
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect("index");
                }
            }
        }
        return $this->render('registracija-posloprimac/' . $this->language . '-registracija-posloprimac', [
            'model' => $model,
        ]);
    }

    public function actionProfilPosloprimac()
    {
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

        if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 3) {
            if ($user->load(Yii::$app->request->post())) {
                $user->save();
            }
            return $this->render('profil-posloprimac/' . $this->language . '-profil-posloprimac', [
                'model' => $user
            ]);
        } else {
            $this->goHome();
        }
    }

    public function actionPoslodavacProfil($id)
    {
        if ($id) {
            $user = User::find()->where(['id' => $id])->one();

            if ($user && (User::getUserTypeByUsername($user->username) == 2 || User::getUserTypeByUsername($user->username) == 4)) {

                $contactInformation = UserContactInformation::find()->where(['UserId' => $user->id])->one();
                $companyInformation = CompanyInformation::find()->where(['UserId' => $user->id])->one();
                $sourcingInformation = SourcingInformation::find()->where(['UserId' => $user->id])->one();

                return $this->render('poslodavac-profil/' . $this->language . '-poslodavac-profil', [
                    'model'       => $user,
                    'registered'  => $this->registered,
                    'contactInfo' => $contactInformation,
                    'companyInformation' => $companyInformation,
                    'sourcingInformation' => $sourcingInformation
                ]);

            }
        }

        $this->goHome();

    }

    public function actionPosloprimacProfil($id)
    {

        if ($id) {
            $user = User::find()->where(['id' => $id])->one();

            if ($user && User::getUserTypeByUsername($user->username) == 3) {

                return $this->render('posloprimac-profil/' . $this->language . '-posloprimac-profil', [
                    'model' => $user
                ]);
            }
        }

        $this->goHome();

    }

    public function actionKontaktProdaja()
    {
        return $this->render('kontakt-prodaja/' . $this->language . '-kontakt-prodaja');
    }

    public function actionCjenovnikUsluge()
    {
        return $this->render('cjenovnik-usluge/' . $this->language . '-cjenovnik-usluge');
    }

    public function actionUsloviKoristenja()
    {
        return $this->render('uslovi-koristenja/' . $this->language . '-uslovi-koristenja');
    }

    public function actionPravilaKoristenja()
    {
        return $this->render('pravila-koristenja/' . $this->language . '-pravila-koristenja');
    }

    public function actionUvjetiKoristenja()
    {
        return $this->render('uvjeti-koristenja/' . $this->language . '-uvjeti-koristenja');
    }

    public function actionPrivatnost()
    {
        return $this->render('privatnost/' . $this->language . '-privatnost');
    }

    public function actionImpressum()
    {
        return $this->render('impressum/' . $this->language . '-impressum');
    }

    public function actionONama()
    {
        return $this->render('o-nama/' . $this->language . '-o-nama');
    }

    public function actionZastoOdabratiNas()
    {
        return $this->render('zasto-odabrati-nas/' . $this->language . '-zasto-odabrati-nas');
    }

    public function actionZaboravljenaLozinka()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                return $this->redirect("zahtjev-za-novu-lozinku");
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('zaboravljena-lozinka/' . $this->language . '-zaboravljena-lozinka', [
            'model' => $model,
        ]);
    }


    public function actionObnoviOglas($id)
    {

        $modelOld = Advert::find()->where(["id" => $id])->one();
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $data = $modelOld->attributes;

        $model = new Advert();
        $model->setAttributes($data);

        $noMoneyMessage = 'Your credit is too low.';

        if ($user->language == "EN") {
            $noMoneyMessage = 'Your credit is too low.';
        } else if ($user->language == "DE") {
            $noMoneyMessage = 'Ihr Guthaben ist zu niedrig.';
        }

        if ($model && !Yii::$app->user->isGuest && $model->user_id == $user->id) {

            $nowTimestamp = $nowTimestamp = ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60;
            $timestamp = (int)Yii::$app->formatter->asTimestamp($model->start_advert);

            $model->start_advert = $timestamp < $nowTimestamp ? $nowTimestamp : $timestamp;
            $model->user_id = $user->getId();
            $model->created_at = $nowTimestamp;

            if ($model->anonymously) {

                $model->contact_person = "-";
                $model->web_address = "-";
                $model->contact_email = "-";
            }
            if ($model->number_of_positions > 1000) {
                $model->number_of_positions = 1000;
            }

            if ($model->type == 1) {
                if ($model->number_of_days > 40) {
                    $model->number_of_days = 40;
                }
            } else if ($model->number_of_days > 30) {
                $model->number_of_days = 30;
            }

            $model->end_advert = $model->start_advert + $model->number_of_days * 24 * 60 * 60;

            $model->number_of_positions = (int)$model->number_of_positions;
            $model->position = (string)$model->position;

            $toPay = $this->calculatePayment($user->language, $model->type, $model->number_of_days, $model->number_of_positions, $model->anonymously);

            switch ($model->payment) {
                case 1:

                    if ($user->money < $toPay) {
                        $model->start_advert = Yii::$app->formatter->asDatetime($model->start_advert);
                        return $this->render(
                            'obnovi-oglas/' . $this->language . '-obnovi-oglas', [
                            'model' => $model,
                            'message' => $noMoneyMessage . " - " . $toPay,
                            'isEmployer' => true
                        ]);
                    }

                    $user->money -= $toPay;
                    $user->total_money += $toPay;
                    $user->save();
                    $model->isPublished = 1;
                    $model->payment_status = 1;
                    $model->price = $toPay;

                    if (!$model->save()) {
                        $user->money += $toPay;
                        $user->total_money -= $toPay;
                        $user->save();
                        return $this->redirect("objava-oglasa");
                    }

                    $this->sendAdvertConfirmationMail($user, $model);

                    return $this->redirect("zahvala-za-placanje");
                    break;

                case 2:

                    var_dump("Paypal hasn't been integrated yet!");
                    die();

                    break;

                case 3:
                    try {
                        $model->isPublished = 0;
                        $model->payment_status = 0;
                        $model->price = $toPay;
                        $model->save();

                        $order = new Order();
                        $order->ch_full_name = $user->full_name;
                        $order->ch_email = $user->email;
                        $order->ch_address = $user->address;
                        $order->ch_zip = $user->zip_code;
                        // $order->ch_city = $user->location;
                        $order->ch_phone = $user->phone;
                        $order->order_number = Pikpay::generate_order_number('zaposljavanje');
                        $order->ip = Yii::$app->getRequest()->getUserIP();
                        $order->order_info = 'Obnova oglasa #ID ' . $model->id;
                        $order->advert_id = $model->id;
                        $order->amount = $toPay;
                        if ($user->language == "EN" || $user->language == "DE") {
                            $order->amount = round($toPay * 1.95583, 2);
                        }
                        $order->save();

                        if ($order->id) {
                            return $this->redirect(['site/pikpay-form?order_id=' . $order->id]);
                        } else {
                            return $this->redirect(['site/pikpay-error?error=Dogodila se greška prilikom kreiranja narudžbe.']);
                        }

                    } catch (Exception $e) {
                        die("Dogodila se greška. " . $e->getMessage());
                    }

                    break;

                default:
                    return $this->goHome();
                    break;
            }

        } else {
            return $this->render(
                'objava-oglasa/' . $this->language . '-objava-oglasa', [
                'model' => new Advert(),
                'message' => null,
                'isEmployer' => false
            ]);
        }


    }

    public function actionZahvalaZaPlacanje()
    {
        return $this->render('zahvala-za-placanje/' . $this->language . '-zahvala-za-placanje');
    }

    public function sendAdvertConfirmationMail($user, $advert)
    {
        Yii::$app
            ->mailer
            ->compose('predracun-html', [
                    'user' => $user,
                    'advert' => $advert
                ]
            )
            ->setFrom("no-reply@zaposljavanje.ba")
            ->setTo($user->email)
            //->setBcc('samra@renesalis-packaging.com')
            ->setSubject("Your listing")
            ->send();
    }

    public function actionObjavaOglasa()
    {
        $model = new Advert();
        $images = new AdvertImage();
        
        if (!Yii::$app->user->isGuest) {
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

            $noMoneyMessage = 'Your credit is too low.';

            if ($user->language == "EN") {
                $noMoneyMessage = 'Your credit is too low.';
            } else if ($user->language == "DE") {
                $noMoneyMessage = 'Ihr Guthaben ist zu niedrig.';
            }

            if ($user == null) {
                return $this->goHome();
            }

            if ($model->load(Yii::$app->request->post()) && $images->load(Yii::$app->request->post())) {
                // save advert
                $nowTimestamp = ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60;
                $timestamp = (int)Yii::$app->formatter->asTimestamp($model->start_advert);
                $image_form_key = $images->image_form_key;

                $model->start_advert = $timestamp < $nowTimestamp ? $nowTimestamp : $timestamp;
                $model->user_id = $user->getId();
                $model->created_at = (int)$nowTimestamp;

                if ($model->anonymously) {

                    $model->contact_person = "-";
                    $model->web_address = "-";
                    $model->contact_email = "-";
                }
                if ($model->number_of_positions > 1000) {
                    $model->number_of_positions = 1000;
                }

                if ($model->type == 1) {
                    if ($model->number_of_days > 40) {
                        $model->number_of_days = 40;
                    }
                } else if ($model->number_of_days > 30) {
                    $model->number_of_days = 30;
                }

                $model->end_advert = $model->start_advert + $model->number_of_days * 24 * 60 * 60;

                $model->number_of_positions = (int)$model->number_of_positions;
                $model->position = (string)$model->position;

                $toPay = $this->calculatePayment($user->language, $model->type, $model->number_of_days, $model->number_of_positions, $model->anonymously);


                switch ($model->payment) {
                    case 1:

                        if ($user->money < $toPay) {
                            $model->start_advert = Yii::$app->formatter->asDatetime($model->start_advert);
                            return $this->render(
                                'objava-oglasa/' . $this->language . '-objava-oglasa', [
                                'model'             => $model,
                                'message'           => $noMoneyMessage . " - " . $toPay,
                                'isEmployer'        => true,
                                'images'            => $images,
                                'action'            => 'create',
                                'uploadedImages'    => $model->images,
                                'advert_id'         => $model->getId(),
                                'image_random_key'  => substr(sha1(time()), 0, 8),
                            ]);
                        }

                        $user->money -= $toPay;
                        $user->total_money += $toPay;
                        $user->save();
                        $model->isPublished = 1;
                        $model->payment_status = 1;
                        $model->price = $toPay;
                        $model->anonymously = 0;

                        if (!$model->save()) {
                            $user->money       += $toPay;
                            $user->total_money -= $toPay;
                            $user->save();
                            return $this->redirect("objava-oglasa");
                        }

                        $images->matchListingId($model->getId(), $image_form_key);

                        try {
                            $this->sendAdvertConfirmationMail($user, $model);
                        } catch (Exception $e) {}

                        return $this->redirect("zahvala-za-placanje");
                        break;

                    case 2:
                        var_dump("Paypal hasn't been integrated yet!");
                        die();

                        break;

                    case 3:
                        try {
                            $model->isPublished = 0;
                            $model->payment_status = 0;
                            $model->price = $toPay;
                            $model->save();
                            $images->matchListingId($model->getId(), $image_form_key);

                            $order = new Order();
                            $order->ch_full_name = $user->full_name;
                            $order->ch_email = $user->email;
                            $order->ch_address = $user->address;
                            $order->ch_zip = $user->zip_code;
                            // $order->ch_city = $user->location;
                            $order->ch_phone = $user->phone;
                            $order->order_number = Pikpay::generate_order_number('zaposljavanje');
                            $order->ip = Yii::$app->getRequest()->getUserIP();
                            $order->order_info = 'Oglas #ID ' . $model->id;
                            $order->advert_id = $model->id;
                            $order->amount = $toPay;
                            if ($user->language == "EN" || $user->language == "DE") {
                                $order->amount = round($toPay * 1.95583, 2);
                            }
                            $order->save();

                            if ($order->id) {
                                return $this->redirect(['site/pikpay-form?order_id=' . $order->id]);
                            } else {
                                return $this->redirect(['site/pikpay-error?error=Dogodila se greška prilikom kreiranja narudžbe.']);
                            }

                        } catch (Exception $e) {
                            die("Dogodila se greška. " . $e->getMessage());
                        }


                        break;

                    default:
                        return $this->goHome();
                        break;
                }

            } else {
                return $this->render(
                    'objava-oglasa/' . $this->language . '-objava-oglasa', [
                    'model'             => $model,
                    'message'           => null,
                    'isEmployer'        => $user->getUserType() == 2 || $user->getUserType() == 4,
                    'images'            => $images,
                    'action'            => 'create',
                    'uploadedImages'    => $model->images,
                    'advert_id'         => $model->getId(),
                    'image_random_key'  => substr(sha1(time()), 0, 8),
                ]);
            }
        } else {
            /* fixclean */
            $UploadedImages = AdvertImage::find()
                ->where(['advert_id' => null])
                ->all();

            if(!empty($UploadedImages))
                foreach ($UploadedImages as $imag) 
                    $imag->delete();

            return $this->render(
                'objava-oglasa/' . $this->language . '-objava-oglasa', [
                'model'             => $model,
                'message'           => null,
                'isEmployer'        => false,
                'images'            => $images,
                'action'            => 'create',
                'uploadedImages'    => $model->images,
                'advert_id'         => $model->getId(),
                'image_random_key'  => substr(sha1(time()), 0, 8),
            ]);
        }

    }

    public function actionPikpayForm($order_id)
    {
        try {

            $order = Order::find()->where(['id' => $order_id])->one();

            if (!$order OR $order->status) {
                return $this->redirect(['/']);
            } else {
                if (Yii::$app->request->isPost) {

                    //test validation

                    $order_model = new Order();
                    $order_model->attributes = Yii::$app->request->post();

                    if (!$this->is_valid_luhn($_POST['pan'])) {
                        Yii::$app->session->setFlash('danger', "Broj kartice nije ispravan.");
                        return $this->render('pikpay/' . $this->language . '-form', ['order' => $order, 'advert' => Advert::find()->where(['id' => $order->advert_id])->one()]);
                    }

                    if ((int)$_POST['year'] . $_POST['month'] < (int)date("ym")) {
                        Yii::$app->session->setFlash('danger', "Datum isteka kartice je u prošlosti.");
                        return $this->render('pikpay/' . $this->language . '-form', ['order' => $order, 'advert' => Advert::find()->where(['id' => $order->advert_id])->one()]);
                    }

                    if ($order_model->validate()) {
                        $order_data = array(

                            'order_info' => $order->order_info,
                            'order_number' => $order->order_number,
                            'amount' => $order->amount
                        );

                        $buyer_data = array(

                            'ch_full_name' => $_POST['ch_full_name'],
                            'ch_address' => $_POST['ch_address'],
                            'ch_city' => $_POST['ch_city'],
                            'ch_zip' => $_POST['ch_zip'],
                            'ch_country' => $_POST['ch_country'],
                            'ch_phone' => $_POST['ch_phone'],
                            'ch_email' => $_POST['ch_email']
                        );

                        $card_data = array(

                            'pan' => $_POST['pan'],
                            'cvv' => $_POST['cvv'],
                            'expiration_date' => $_POST['year'] . $_POST['month']
                        );

                        // update order
                        $order->ch_full_name = $_POST['ch_full_name'];
                        $order->ch_address = $_POST['ch_address'];
                        $order->ch_city = $_POST['ch_city'];
                        $order->ch_zip = $_POST['ch_zip'];
                        $order->ch_country = $_POST['ch_country'];
                        $order->ch_phone = $_POST['ch_phone'];
                        $order->ch_email = $_POST['ch_email'];
                        $order->save();


                        $pikpay_response = PikPay::transaction()->order($order_data)->buyer($buyer_data)->card($card_data)->pay();

                        if ($pikpay_response !== FALSE) {
                            if (isset($pikpay_response->{'errors'})) {
                                die(var_dump($pikpay_response));
                            } else if (isset($pikpay_response->{'acs-url'})) {
                                $acs_data = array(

                                    'TermUrl' => Url::base(true) . '/site/pikpay-terminal',
                                    'MD' => $pikpay_response->{'authenticity-token'},
                                    'PaReq' => $pikpay_response->{'pareq'},
                                    'AcsUrl' => $pikpay_response->{'acs-url'},
                                );

                                return $this->render('pikpay/' . $this->language . '-3dsform', $acs_data);
                            } else {
                                $this->_save_transaction($pikpay_response);
                            }
                        } else {
                            return $this->redirect(['site/pikpay-error?error=Došlo je do greške. Molimo Vas pokušajte kasnije ili kontaktirajte administratore.']);
                        }


                    } else {
                        $validation_errors = '';
                        foreach ($order_model->errors as $error) {
                            $validation_errors .= $error[0] . '<br>';
                        }
                        Yii::$app->session->setFlash('danger', $validation_errors);
                    }
                }

                return $this->render('pikpay/' . $this->language . '-form', ['order' => $order, 'advert' => Advert::find()->where(['id' => $order->advert_id])->one()]);
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('danger', $e->getMessage());
        }

        return $this->render('pikpay/' . $this->language . '-form');
    }

    public function is_valid_luhn($number)
    {
        settype($number, 'string');
        $sumTable = array(
            array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
            array(0, 2, 4, 6, 8, 1, 3, 5, 7, 9));
        $sum = 0;
        $flip = 0;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += $sumTable[$flip++ & 0x1][$number[$i]];
        }
        return $sum % 10 === 0;
    }

    private function _save_transaction($pikpay_response)
    {
        if (isset($pikpay_response->{'response-code'})) {
            if ($pikpay_response->{'response-code'} == '0000') {

                $order = Order::find()->where(['order_number' => $pikpay_response->{'order-number'}])->one();

                if (!$order->id) {
                    return $this->redirect(["site/pikpay-error?error=Narudžba ne postoji."]);
                } else {
                    $order->status = true;
                    $order->save();

                    $advert = Advert::find()->where(['id' => $order->advert_id])->one();

                    if ($advert->id) {
                        $advert->isPublished = 1;
                        $advert->payment_status = 1;
                        $advert->save();

                        try {
                            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

                            $this->sendAdvertConfirmationMail($user, $advert);

                        } catch (Exception $e) {
                        }

                        return $this->redirect("zahvala-za-placanje");


                        // return $this->redirect(["site/pikpay-success"]);

                    } else {
                        return $this->redirect(["site/pikpay-error?error=Oglas ne može biti pronadjen."]);
                    }
                }

            } else {
                return $this->redirect(["site/pikpay-error?error=" . $pikpay_response->{'response-message'}]);
            }
        } else {
            return $this->redirect(["site/pikpay-error?error=Došlo je do greške, transakcija nije uspjela."]);
        }


    }


    public function actionPikpayTerminal()
    {

        $pikpay_response = SecureTerminal::init()->listener();

        if ($pikpay_response !== FALSE) {
            $this->_save_transaction($pikpay_response);
        } else {
            return $this->redirect(['site/pikpay-error?error=Došlo je do greške prilikom 3D secure verifikacije.']);
        }
    }

    public function actionPikpaySuccess()
    {
        return $this->render('pikpay/' . $this->language . '-success');
    }

    public function actionPikpayError($error)
    {
        return $this->render('pikpay/' . $this->language . '-error');
    }

    public
    function actionZahtjevZaNovuLozinku()
    {
        return $this->render('zahtjev-za-novu-lozinku/' . $this->language . '-zahtjev-za-novu-lozinku');
    }

    public
    function actionPromijeniLozinku($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('promijeni-lozinku/' . $this->language . '-promijeni-lozinku', [
            'model' => $model,
        ]);
    }

    public
    function actionUploadLogo()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $allowed = array('jpg', 'jpeg', 'png');
                $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                if ($user == null) {
                    return $this->goHome();
                }
                $type = $user->getUserType();
                if ($type != 2) {
                    return $this->goHome();
                }
                $extension = $model->file->extension;
                if (!in_array(strtolower($extension), $allowed)) {
                    echo '{"status":"error"}';
                    exit;
                }
                $newImage = 'uploads/logo/' . $user->getId() . '-' . time() . '.' . $extension;
                if ($user->image != null && file_exists($user->image)) {
                    unlink($user->image);
                }
                if ($model->file->size > 1024 * 1024 * 2) {
                    echo '{"status":"error"}';
                    exit;
                }
                if ($model->file->saveAs($newImage)) {
                    $user->image = $newImage;
                    $user->save();
                    return $this->redirect("profil-poslodavac");
                }
            }
        }
        return $this->render('upload-logo/' . $this->language . '-upload-logo', ['item' => $model]);
    }

    /**
     * @return array|Response
     */
    public function actionRemovePhoto()
    {
        /* allow only ajax calls */
        if (!request()->isAjax) {
            return $this->redirect(['index']);
        } 
        /* set the output to json */
        response()->format = Response::FORMAT_JSON;
        
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if ($user == null) {
            return ['result' => 'error', 'html' => t('app', 'Not permitted...')];
        }

        $imageId = request()->post('key');
        if (empty($imageId)) {
            return ['result' => 'error', 'html' => t('app', 'Something went wrong...')];
        }

        $image = AdvertImage::findOne(['image_id' => $imageId]);
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

        if (empty($image)) {
            return ['result' => 'error', 'html' => t('app', 'Something went wrong...')];
        }

        if ($image->delete()) {
            return ['result' => 'success', 'html' => $image];
        }

        return ['result' => 'error', 'html' => t('app', 'Something went wrong...')];
    }

    
    /**
     * @return array|Response
     */
    public function actionSortPhotos()
    {
        /* allow only ajax calls */
        if (!request()->isAjax) {
            return $this->redirect(['index']);
        }

        /* set the output to json */
        response()->format = Response::FORMAT_JSON;

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if ($user == null) {
            return ['result' => 'error', 'html' => t('app', 'Not permitted...')];
        }

        $images = request()->post('images');
        $images = json_decode($images);

        if (empty($images)) {
            return ['result' => 'error', 'html' => t('app', 'Something went wrong...')];
        }

        foreach ($images as $sortOrder => $image) {
            $_image = AdvertImage::findOne(['image_id' => $image->key]);
            $_image->sort_order = $sortOrder + 1;
            $_image->save();
        }

        return ['result' => 'success'];
    }

        /**
     * @return array|Response
     * @throws \Exception
     */
    public function actionUploadPhotos()
    {
        /* allow only ajax calls */
        if (!request()->isAjax) {
            return $this->redirect(['company/post']);
        }
        /* set the output to json */
        response()->format = Response::FORMAT_JSON;

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if ($user == null) {
            return ['result' => 'error', 'html' => t('app', 'Not permitted...')];
        }

        $fileId = request()->post('file_id');
        $adId = request()->post('adId');
        $action = request()->post('action');
        $image_form_key = request()->post('image_form_key');

        $UploadedImages = AdvertImage::find()
            ->select('sort_order')
            ->where(['advert_id' => $adId])
            ->orderBy('sort_order DESC')
            ->one();

        if(empty($UploadedImages))
            $UploadedImages = AdvertImage::find()
                ->select('sort_order')
                ->where(['image_form_key' => $image_form_key])
                ->orderBy('sort_order DESC')
                ->one();

        (!$UploadedImages) ? $sort = $fileId : $sort = $UploadedImages->sort_order + $fileId;

        $images = new AdvertImage();
        if(!($imagesGallery = UploadedFile::getInstances($images, 'imagesGallery'))){
            throw new \Exception(t('app', 'Please add at least your logo to your ICO advertisement post'));
        }

        return $images->uploadImageByAjax($imagesGallery, $image_form_key, $adId, $sort);
    }

    public
    function actionUploadBanner()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {

                $allowed = array('jpg', 'jpeg', 'png');

                $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

                if ($user == null) {
                    return $this->goHome();
                }

                $type = $user->getUserType();

                if ($type != 2) {
                    return $this->goHome();
                }

                $extension = $model->file->extension;

                list($width, $height, $type, $attr) = @getimagesize($model->file->tempName);


                if ($width != 930 || $height != 200) {
                    echo '{"status":"error"}';
                    exit;
                }


                if (!in_array(strtolower($extension), $allowed)) {
                    echo '{"status":"error"}';
                    exit;
                }

                $newImage = 'uploads/banner/' . $user->getId() . '-' . time() . '.' . $extension;

                if ($user->banner != null && file_exists($user->banner)) {
                    unlink($user->banner);
                }

                if ($model->file->size > 1024 * 1024 * 2) {
                    echo '{"status":"error"}';
                    exit;
                }


                if ($model->file->saveAs($newImage)) {
                    $user->banner = $newImage;
                    $user->save();
                    return $this->redirect("profil-poslodavac");
                }

            }
        }

        return $this->render('upload-banner/' . $this->language . '-upload-banner', ['item' => $model]);
    }

    public function actionUploadCv()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {

                $allowed = array('pdf', 'doc', 'docx');

                $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

                if ($user == null) {
                    return $this->goHome();
                }

                $type = $user->getUserType();

                if ($type != 3) {
                    return $this->goHome();
                }

                $extension = $model->file->extension;

                if (!in_array(strtolower($extension), $allowed)) {
                    echo '{"status":"error"}';
                    exit;
                }

                $newImage = 'uploads/cv/' . $user->getId() . '-' . time() . '.' . $extension;


                if ($user->image != null && file_exists($user->image)) {
                    unlink($user->image);
                }

                if ($model->file->size > 1024 * 1024 * 10) {
                    echo '{"status":"error"}';
                    exit;
                }

                if ($model->file->saveAs($newImage)) {
                    $user->image = $newImage;
                    $user->save();
                    return $this->redirect("profil-posloprimac");
                }

            }
        }

        return $this->render('upload-cv/' . $this->language . '-upload-cv', ['item' => $model]);
    }

    public
    function actionDownloadCv()
    {

        $id = Yii::$app->request->get('id');

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

        if ($user == null) {
            return $this->goHome();
        }

        $type = $user->getUserType();

        if ($type == 3) {
            $path = Yii::getAlias('@webroot') . '/';
            $file = $path . $user->image;

            if (file_exists($file)) {
                Yii::$app->response->sendFile($file);
            }
        } else if ($type == 2 && $id != null) {

            $employee = User::find()->where(["id" => $id])->one();

            if (!$employee || !$employee->image) {
                return $this->redirect("index");
            }

            $adverts = Advert::find()->where(["user_id" => $user->id])->all();

            if (!$adverts) {
                return $this->redirect("index");
            }

            foreach ($adverts as $advert) {

                $applications = Apply::find()->where(["advert_id" => $advert->id])->all();

                if (!$applications) {
                    continue;
                }

                foreach ($applications as $application) {

                    if ($application->user_id == $employee->id) {
                        $path = Yii::getAlias('@webroot') . '/';
                        $file = $path . $employee->image;

                        if (file_exists($file)) {
                            Yii::$app->response->sendFile($file);
                            return;
                        }
                    }
                }
            }

        } else if ($type == 1) {

            $employee = User::find()->where(["id" => $id])->one();

            if (!$employee || !$employee->image) {
                return $this->redirect("index");
            }
            $path = Yii::getAlias('@webroot') . '/';
            $file = $path . $employee->image;

            if (file_exists($file)) {
                Yii::$app->response->sendFile($file);
                return;
            }

        }

    }

    public
    function actionOglasi()
    {
        $searchModel = new AdvertSearch();
        $searchModel->load(Yii::$app->request->get());


        $position = false;

        if ($searchModel->position != null) {
            $position = true;
        }
        $type = -1;
        if (!Yii::$app->user->isGuest) {
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

            if ($user) {
                $type = $user->getUserType();
            }
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $position);

        return $this->render('oglasi/' . $this->language . '-oglasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employee' => $type == 3 || $type == 4
        ]);
    }

    public
    function actionOglas($id)
    {
        $advert = Advert::find()->where(['id' => $id])->one();

        $type = -1;
        if (!Yii::$app->user->isGuest) {
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

            if ($user) {
                $type = $user->getUserType();
            }
        }

        $imagesPreview = [];
        $UploadedImages = $advert->getImages();
        if ($UploadedImages) foreach ($UploadedImages as $key => $image) {
            $imagesPreview[] =  Url::base('') . $image->image_path;
            $imagesPreviewConfig[$key]['poster']    = url($image->image_path);
            $imagesPreviewConfig[$key]['href']      = url($image->image_path);
            $imagesPreviewConfig[$key]['title']     = $image->image_id;
        }

        return $this->render('oglas/' . $this->language . '-oglas', [
            'model' => $advert,
            'images' => $imagesPreview,
            'employee' => $type == 3 || $type == 4
        ]);
    }

    public
    function actionObjavljeniPoslovi()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect("index");
        }

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $type = $user->getUserType();

        if ($type != 2 && $type != 4) {
            return $this->redirect("index");
        }

        $searchModel = new AdvertEmployerSearch();
        $searchModel->user_id = $user->id;

        $type = Yii::$app->request->get('type');

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);

        return $this->render('objavljeni-poslovi/' . $this->language . '-objavljeni-poslovi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employee' => $type == 3 || $type == 4
        ]);
    }

    public
    function actionApliciraniPoslovi()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect("index");
        }

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $type = $user->getUserType();

        if ($type != 3 && $type != 4) {
            return $this->redirect("index");
        }

        $searchModel = new AdvertEmployeeSearch();


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $user->getId());

        return $this->render('aplicirani-poslovi/' . $this->language . '-aplicirani-poslovi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    protected function calculatePayment($userType, $type, $days, $positions, $anonymously)
    {
        $advertType = "normal";
        if ($type == 2) {
            $advertType = "premium";
        } else if ($type == 1) {
            $advertType = "platinum";
        }

        $prices = AdvertTypes::find()
            ->where(["language" => $userType])
            ->andWhere(["type" => $advertType])
            ->andWhere([">=", "days", $days])
            ->andWhere([">=", "positions", $positions])
            ->orderBy("price ASC")
            ->all();

        if ($prices) {
            $price = $prices[0];
        } else {
            $price = AdvertTypes::find()
                ->where(["language" => $userType])
                ->andWhere(["type" => $advertType])
                ->orderBy("price DESC")
                ->one();
        }

        if ($price) {
            if ($userType == "BA") {
                $totalPrice = $anonymously == 1 ? ($price->price + 93.6) : $price->price;
            } else {
                $totalPrice = $anonymously == 1 ? ($price->price + 70) : $price->price;
            }
        } else {
            $totalPrice = 1000;
        }

        return $totalPrice;
    }

    public function actionAplikacije($id)
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect("index");
        }
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $type = $user->getUserType();

        if (!$id || $type != 2) {
            return $this->redirect("index");
        }

        $advert = Advert::find()->where(["id" => $id, "user_id" => $user->id])->one();

        if (!$advert) {
            return $this->redirect("index");
        }

        $applications = Apply::find()->where(['advert_id' => $id])->all();
        $users = [];

        foreach ($applications as $application) {
            $user = User::find()->where(["id" => $application->user_id])->one();
            if ($user) {
                $users[] = $user;
            }
        }

        return $this->render('aplikacije/' . $this->language . '-aplikacije', [
            'users' => $users,
        ]);
    }

    public function actionApply($id)
    {

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        $type = $user->getUserType();

        if ($id && ($type == 3 || $type == 4)) {
            $apply = Apply::find()->where(["user_id" => $user->id, "advert_id" => $id])->one();
            if (!$apply) {
                // todo check if job is valid
                $apply = new Apply();
                $apply->user_id = $user->id;
                $apply->advert_id = (int)$id;
                if ($apply->validate()) {
                    $apply->save();
                    return 1;
                }
            }
            return 0;
        } else {
            $this->redirect("index");
        }

    }

    public function actionHtml($id)
    {

        if (!$id) {
            $this->redirect("index");
        }

        $advert = Advert::find()->where(['id' => $id])->one();
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

        if (!$advert || !$user || $advert->user_id != $user->id || $advert->isPublished != 1 || $advert->payment_status != 1) {
            $this->redirect("index");
        } else {
            return $this->renderPartial('html', [
                'user' => $user,
                'advert' => $advert
            ]);
        }
    }


    public function actionPdf($id)
    {

        if (!$id) {
            $this->redirect("index");
        }

        $advert = Advert::find()->where(['id' => $id])->one();
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

        if (!$advert || !$user || $advert->user_id != $user->id || $advert->isPublished != 1 || $advert->payment_status != 1) {
            $this->redirect("index");
        }
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('pdf', [
            'user' => $user,
            'advert' => $advert
        ]);

        define('_MPDF_TTFONTDATAPATH', Yii::getAlias('@runtime/mpdf2'));

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,

        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionGetSubcategories(){
        if(isset($_POST) && isset($_POST['selected'])){
            $selected = $_POST['selected'];
            if($selected == '') {
                return '';
            }
            $parent =  Categories::find()->where(['like','Name', $selected])->one();
            $dropDown = '';
            if($parent) {
                $pid = $parent['Id'];
                $subCategories = Categories::find()->where(['ParentId' => $pid])->orderBy(['Name' => SORT_ASC])->all();
                if(sizeof($subCategories) > 0) {
                    $dropDown = '<option value>Select subcategory</option>';

                    foreach ($subCategories as $subCategory) {
                        $dropDown .= "<option value='$subCategory->Name'>$subCategory->Name</option>";
                    }
                }
            }
            return $dropDown;
        }

    }


    /**
        Registration as Buyer or seller or both
     */

    public function actionRegistracija()
    {

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->username = $model->email;
            /*if(!$model->validate()) {
                if($model->errors){
                    $model->addErrors($model->errors);
                }
            }*/

            if ($user = $model->signup()) {
                $mail = new EmailConfirmation();

                $mail->sendEmail($user);

                $userDetails = new UserContactInformation();
                $userDetails->Email = $user->email;
                $userDetails->Phone = $user->phone;
                $userDetails->UserId = $user->id;
                $userDetails->save();

                $companyDetails = new CompanyInformation();
                $companyDetails->CompanyName = $user->company_name;
                $companyDetails->UserId = $user->id;
                $companyDetails->save();

                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect("index");
                }
            }
        }

        return $this->render('registracija/index', [
            'model' => $model,
        ]);
    }


    public function actionActivateProfile($key){
        $user = User::findOne(['auth_key' => $key]);

        if($user){

            $user->status = User::STATUS_ACTIVE;
            if($user->save()){
                Yii::$app->session->setFlash('success', 'Your profile is activated.');

                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect("index");
                }
            }
        }
    }

    public function actionRequestNewActivationKey($key){
        $mail = new EmailConfirmation();
        $user = User::findOne(['auth_key' => $key]);
        if($user) {
            if ($mail->sendEmail($user)) {
                return 1;
            }
        }

        return $this->redirect("index");
    }

    public function actionUserProfile()
    {
        if (!Yii::$app->user->isGuest){
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
            if($user) {
                $contactInformation = UserContactInformation::find()->where(['UserId' => $user->id])->one();
                $companyInformation = CompanyInformation::find()->where(['UserId' => $user->id])->one();
                $sourcingInformation = SourcingInformation::find()->where(['UserId' => $user->id])->one();

                if ($user->load(Yii::$app->request->post())) {
                    $user->save();
                }
                return $this->render('user-profile/index', [
                    'model'       => $user,
                    'registered'  => $this->registered,
                    'contactInfo' => $contactInformation,
                    'companyInformation' => $companyInformation,
                    'sourcingInformation' => $sourcingInformation
                ]);
            }
        }
        return $this->goHome();
    }

    public function actionEditUserContactDetails(){
        if (!Yii::$app->user->isGuest) {
            $user  = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
            if($user){
            $model = UserContactInformation::find()->where(['UserId' => $user->id])->one();

            if ($model->load(Yii::$app->request->post())) {
                $user->phone = $model->Phone;
                $user->save();
                $model->save();
                return $this->redirect("user-profile");
            }

            return $this->render('user-profile/user-contact', [
                'model' => $model
            ]);
        }
        }
        return $this->goHome();
    }

    public function actionEditUserMainDetails(){
        if (!Yii::$app->user->isGuest) {
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
            $item = new UploadForm();
            if($user){

                if($user->load(Yii::$app->request->post())) {
                    $user->full_name = $user->first_name . ' ' . $user->last_name;

                    foreach ($this->countryArray as $key => $val){
                        if($key == $user->location){
                            $user->location = $val['name'];
                        }
                    }

                    $user->save();
                }

                if (Yii::$app->request->isPost) {
                    $item->file = UploadedFile::getInstance($item, 'file');
                    if($item->file != null) {
                        if ($item->validate()) {
                            $allowed = array('jpg', 'jpeg', 'png');

                            $extension = $item->file->extension;
                            if (!in_array(strtolower($extension), $allowed)) {
                                echo '{"status":"error"}';
                                exit;
                            }

                            $newImage = 'uploads/logo/' . $user->getId() . '-' . time() . '.' . $extension;
                            if ($user->image != null && file_exists($user->image)) {
                                unlink($user->image);
                            }
                            if ($item->file->size > 1024 * 1024 * 2) {
                                echo '{"status":"error"}';
                                exit;
                            }
                            if ($item->file->saveAs($newImage)) {
                                $user->image = $newImage;
                                $user->save();
                                return $this->redirect("user-profile");
                            }
                        }
                    }
                    return $this->redirect("user-profile");
                }

                return $this->render('user-profile/user-main-details', [
                    'model' => $user,
                    'item' => $item
                ]);
            }
        }

        return $this->goHome();
    }

    public function actionCompanyDetails(){
        if (!Yii::$app->user->isGuest) {
            $user  = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
            if($user){
                $model = CompanyInformation::find()->where(['UserId' => $user->id])->one();

                if(!$model){
                    $model = new CompanyInformation();
                }
                $model->UserId = $user->id;
                if ($model->load(Yii::$app->request->post())) {

                    $user->company_name = $model->CompanyName;

                    $time = date("Y-m-d", strtotime($model->Year));
                    $model->Year = $time;

                    $user->save();

                    $model->save();
                    return $this->redirect("user-profile");
                }

                return $this->render('user-profile/company-information', [
                    'model' => $model
                ]);
            }
        }
        return $this->goHome();
    }

    public function actionSourcingInformation(){
        if (!Yii::$app->user->isGuest) {
            $user  = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
            if($user){
                $model = SourcingInformation::find()->where(['UserId' => $user->id])->one();

                if(!$model){
                    $model = new SourcingInformation();
                }
                $model->UserId = $user->id;
                if ($model->load(Yii::$app->request->post())) {
                    $model->save();
                    return $this->redirect("user-profile");
                }

                return $this->render('user-profile/sourcing-information', [
                    'model' => $model
                ]);
            }
        }
        return $this->goHome();
    }

}
