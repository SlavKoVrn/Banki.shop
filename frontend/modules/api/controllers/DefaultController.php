<?php

namespace frontend\modules\api\controllers;

use common\models\Image;
use yii\filters\Cors;

/**
 * Default controller for the `api` module
 */
class DefaultController extends \yii\rest\ActiveController
{
    public $modelClass = Image::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Expose-Headers' => [
                    'X-Pagination-Per-Page',
                    'X-Pagination-Total-Count',
                    'X-Pagination-Page-Count'
                ],
            ]
        ];
        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['create'],$actions['update'],$actions['delete']);
        return $actions;
    }

}
