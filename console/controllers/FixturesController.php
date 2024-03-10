<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class FixturesController extends Controller
{

    private function setFixture($model)
    {
        $modelFixture =<<<FIXTURE
<?php
namespace common\\fixtures;
use common\\models\\{$model};
use yii\\test\\ActiveFixture;

class {$model}Fixture extends ActiveFixture
{
    public \$modelClass = {$model}::class;
}
FIXTURE;
        $fileFixture = Yii::getAlias('@common').'/fixtures/'.$model.'Fixture.php';
        file_put_contents($fileFixture,$modelFixture);
    }

    private function setFixtureData($model)
    {
        $lowerModel = strtolower($model);
        $modelName = "common\\models\\".$model;
        $allModels = $modelName::find()->all();
        $modelsArray = [];
        foreach ($allModels as $currentModel){
            $modelsArray[] = $currentModel->attributes;

        }
        $fileData = Yii::getAlias('@backend').'/tests/_data/'.$lowerModel.'.php';
        $fileContent = "<?php\nreturn ".var_export($modelsArray, true).";";
        file_put_contents($fileData, $fileContent);
    }

    public function actionIndex()
    {
        $models = ['User', 'Image'];
        foreach ($models as $model){
            $this->setFixture($model);
            $this->setFixtureData($model);
            echo "$model\n";
        }
    }

}
