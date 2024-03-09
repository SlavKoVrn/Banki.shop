<?php

namespace backend\controllers;

use common\models\Image;
use common\models\ImageSearch;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /**
     * @inheritDoc
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $files = [];
        $images = UploadedFile::getInstancesByName('images');
        if ($images){
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($images as $image){
                    $imageInfo = @getimagesize($image->tempName);
                    if ($imageInfo == false) {
                        throw new \Exception('Принимаются только изображения');
                    }
                    $fileSize = filesize($image->tempName);
                    if ($fileSize > 1000000){
                        throw new \Exception('Размер файла больше 1 000 000 байт');
                    }
                    //-----------------------
                    $uploadDir = Yii::getAlias('@upload/images');
                    if (!is_dir($uploadDir)) {
                        FileHelper::createDirectory($uploadDir);
                    }
                    //-----------------------
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime  = finfo_file($finfo, $image->tempName);
                    finfo_close($finfo);
                    //-----------------------
                    $model = new Image;
                    $model->setAttributes([
                        'name' => $image->baseName,
                        'size' => $image->size,
                        'mime' => $mime,
                    ]);
                    $model->save();
                    //-----------------------
                    $fileName = $model->slug . '.' . $image->extension;
                    $filePath = $uploadDir . '/' . $fileName;
                    $image->saveAs($filePath);
                    //-----------------------
                    $model->path = '/upload/images/'.$fileName;
                    $model->save();
                    //-----------------------
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $files['error'] = $e->getMessage();
            }
        }
        return $files;
    }

    /**
     * Lists all Image models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
