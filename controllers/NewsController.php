<?php

    namespace app\controllers;

    use app\Service\SRubrik;
    use app\Service\SNews;
    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\Response;
    use yii\filters\VerbFilter;
    use app\models\LoginForm;
    use app\models\ContactForm;

    class NewsController extends Controller
    {
        /**
         * {@inheritdoc}
         */
        public function behaviors()
        {
            return [
                    'access' => [
                            'class' => AccessControl::className(),
                            'only' => ['logout'],
                            'rules' => [
                                    [
                                            'actions' => ['logout'],
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
         * {@inheritdoc}
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
         * @return string
         */
        public function actionIndex()
        {
            return $this->render('index');
        }



        public function actionRubrics()
        {
            $srubrik = new SRubrik();
            $items = $srubrik->getAll();
            return $this->asJson($items);
        }

        public function actionNews($id){


            $snew=new SNews();
            $news=$snew->getNews($id);

            return $this->asJson($news);

            return $this->render('index');
        }


    }
