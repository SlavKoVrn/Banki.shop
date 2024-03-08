<?php

use common\models\Image;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\ImageFrontSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Изображения';
$this->params['breadcrumbs'][] = $this->title;
$css=<<<CSS
.pagination > li > a {
    padding:5px;
}
.pagination > li.active > a {
    color:white;
    background-color:#1c84c6;
    padding:5px;
}
CSS;
$this->registerCss($css);
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['timeout' => 0]); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_card',['model'=>$model]);
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
