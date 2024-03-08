<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h3><?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id],[
            'style' => 'text-decoration:none;'
        ]) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'format'=>'raw',
                'label'=>'Изображение',
                'value'=>function($model){
                    return Html::a(
                        Html::img($model->path,['height' => '222px']),
                        Yii::$app->getRequest()->getHostInfo().$model->path,
                        ['target' => '_blank', 'data-pjax' => 0]);
                }
            ],
            'name',
            'slug',
            'mime',
            [
                'attribute' => 'size',
                'value' => function($model){
                    return number_format($model->size,0,'.',' ');
                }
            ],
            'datetime',
        ],
    ]) ?>

</div>
