<?php

    namespace app\controllers;

    use app\models\News;
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

        public $enableCsrfValidation = false;

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

        public function actionNews($id)
        {
            $snew = new SNews();
            $news = $snew->getNews($id);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $news;
        }

        public function actionCreate()
        {
            Yii::$app->controller->enableCsrfValidation = false;
            $this->enableCsrfValidation = false;//
            $model = new  News();
            $request = Yii::$app->request;

            if ($request->isPost && $request->post("rubrics_id") != null) {
                $model->title = $request->post("title");
                $model->description = $request->post("description");

                $model->saveNews($request->post("rubrics_id"));
                return $this->asJson($model);
            } else {
                return $this->asJson(['result' => false]);
            }

        }


    }
