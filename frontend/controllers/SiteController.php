<?php

namespace frontend\controllers;


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

    public function beforeAction($action)
    {

        $this->enableCsrfValidation = false;

        $this->registered = false;
        $this->language = isset($_COOKIE['language']) ? $_COOKIE['language'] : "BA";
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
                    'employee' => $type == 3
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

    public function actionKontaktProdaja()
    {
        return $this->render('kontakt-prodaja/' . $this->language . '-kontakt-prodaja');
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

            if ($user && User::getUserTypeByUsername($user->username) == 2) {

                return $this->render('poslodavac-profil/' . $this->language . '-poslodavac-profil', [
                    'model' => $user
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

    public function actionCjenovnikUsluge()
    {
        return $this->render('cjenovnik-usluge/' . $this->language . '-cjenovnik-usluge');
    }

    public function actionUsloviKoristenja()
    {
        return $this->render('uslovi-koristenja/' . $this->language . '-uslovi-koristenja');
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

        $noMoneyMessage = 'Nemate dovoljno novca na Vašem računu';

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
            ->setSubject("Vaš oglas - Ihre Stellenanzeige - Your job posting")
            ->send();
    }

    public function actionObjavaOglasa()
    {
        $model = new Advert();
        $images = new AdvertImage();
        
        if (!Yii::$app->user->isGuest) {
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

            $noMoneyMessage = 'Nemate dovoljno novca na Vašem računu';

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
                        if (!$model->save()) {
                            $user->money += $toPay;
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
                    'isEmployer'        => $user->getUserType() == 2,
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
            'employee' => $type == 3
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
            'employee' => $type == 3
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

        if ($type != 2) {
            return $this->redirect("index");
        }

        $searchModel = new AdvertEmployerSearch();
        $searchModel->user_id = $user->id;

        $type = Yii::$app->request->get('type');

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);

        return $this->render('objavljeni-poslovi/' . $this->language . '-objavljeni-poslovi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employee' => $type == 3
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

        if ($type != 3) {
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

        if ($id && $type == 3) {
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
            if ($user = $model->signup()) {

                $mail = new EmailConfirmation();

                $mail->sendEmail($user);

                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect("index");
                }
            }
        }

        $model = new RegisterForm();
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


}
