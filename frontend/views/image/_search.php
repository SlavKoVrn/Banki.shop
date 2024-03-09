<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ImageFrontSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="image-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col col-sm-5">
            <?= $form->field($model, 'name')->label(false) ?>
        </div>
        <div class="col col-sm-5">
            <?= Html::dropDownList('sort', [
                Yii::$app->request->get('sort'),
            ], [
                '' => '',
                'name' => 'По наименованию возрастанию',
                '-name' => 'По наименованию убыванию',
                'datetime' => 'По дата и время возрастанию',
                '-datetime' => 'По дата и время убыванию',
            ],['class' => 'form-control']) ?>
        </div>
        <div class="col col-sm-2">
            <div class="form-group">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
