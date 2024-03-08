<?php

use common\models\Image;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\ImageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Изображения';
$this->params['breadcrumbs'][] = $this->title;

$domainScheme = Yii::$app->request->getHostInfo();
?>
<div class="image-index">

    <p>
        <?= FileInput::widget([
            'name' => 'images[]',
            'options' => ['multiple' => true, 'id' => 'images-upload'],
            'pluginOptions' => [
                'language' => 'ru',
                'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                'previewFileType' => 'image',
                'showUpload' => false,
                'showRemove' => false,
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                "uploadUrl" => Url::to(['image/upload']),
                'msgUploadBegin' => 'Подождите, идет загрузка файлов',
                'msgUploadThreshold' => 'Подождите, идет загрузка файлов',
                'msgUploadEnd' => 'Выполнено',
                'dropZoneClickTitle'=>'',
                "uploadAsync" => false,
                "browseOnZoneClick"=>true,
                'fileActionSettings' => [
                    'showZoom' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ],
                'maxFileCount' => 5,
                'maxFileSize' => 10000,
                'msgPlaceholder' => 'Выбор файлов',
            ],
            'pluginEvents' => [
                'filebatchselected' => 'function() {
                    $(this).fileinput("upload");
                 }',
                'filebatchuploadcomplete' => 'function() {
                    $(this).fileinput("clear");
                    $.pjax.reload({container: "#images-gridview", async: false, timeout: false});
                 }',
            ],
        ]);
        ?>
    </p>

    <?php Pjax::begin(['id'=>'images-gridview', 'timeout' => 0]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'format' => 'raw',
                'content' => function($model) use ($domainScheme){
                    return Html::a(
                        Html::img($model->path,['height' => '100px']),
                        $domainScheme.$model->path,
                        ['target' => '_blank', 'data-pjax' => 0]);
                }
            ],
            'name',
            'slug',
            'mime',
            [
                'attribute' => 'size',
                'content' => function($model){
                    return number_format($model->size,0,'.',' ');
                }
            ],
            [
                'attribute' => 'datetime',
                'filterType'          => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'convertFormat'  => false,
                    'presetDropdown' => true,
                    'pluginOptions'  => [
                        'autoclose' => true,
                    ]
                ]
            ],
            [
                'format' => 'raw',
                'content' => function($model) use ($domainScheme){
                    return Html::a(
                        Html::img('/upload/images/download.png',['height' => '50px']),
                        '/download/'.$model->id,
                        ['data-pjax' => 0]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
