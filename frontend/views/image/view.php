<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Image $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Изображения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="image-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
                        ['target' => '_blank']);
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
