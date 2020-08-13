<?php

    namespace app\controllers;

    use app\models\News;
    use app\models\Rubric;
    use app\Service\SRubrik;
    use app\Service\SNews;
    use Yii;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
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

        public function actionCreateRubric()
        {
            $request = Yii::$app->request;
            $model = new Rubric();

            if ($request->isPost) {
                $model->load($request->post());
                $model->title = $request->post('title');
                $model->save();
                return $this->asJson($model);
            }
            return true;
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

            if ($request->isPost) {
                $model->title = $request->post("title");
                $model->description = $request->post("description");
                if ($model->saveNews($request->post("rubrics_id")) == false) {
                    return $this->asJson(['result' => 'rubric not found']);
                } else {
                    return $this->asJson($model);
                }
            } else {
                return $this->asJson(['result' => false]);
            }

        }


    }
