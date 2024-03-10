<?php
namespace backend\tests\functional;

use common\models\Image;
use common\fixtures\UserFixture;
use common\fixtures\ImageFixture;
use backend\tests\FunctionalTester;

class UploadCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
            'image' => [
                'class' => ImageFixture::class,
                'dataFile' => codecept_data_dir() . 'image.php',
            ],
        ];
    }

    public function uploadImages(FunctionalTester $I)
    {
        $I->sendGET('/admin/site/login');

        $html = $I->grabResponse();
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        $input = $doc->getElementsByTagName('input')->item(0);
        $csrfToken = '';
        if ($input && $input->getAttribute('name') === '_csrf-backend') {
            $csrfToken = $input->getAttribute('value');
        }

        $I->sendPOST('/admin/site/login',[
            '_csrf-backend' => $csrfToken,
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => '123456',
            'LoginForm[rememberMe]' => '1',
        ]);

        $html = $I->grabResponse();
        $csrfToken = '';
        if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
            $csrfToken = $matches[1];
        }

        $I->sendPOST('/admin/image/upload',[
            '_csrf-backend' => $csrfToken,
        ],[
            'images[природа]' => codecept_data_dir('природа.jpg'),
            'images[природа два]' => codecept_data_dir('природа два.jpg'),
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([]);

        $I->seeRecord('common\models\Image', [
            'name' => 'природа',
        ]);
        $I->seeRecord('common\models\Image', [
            'name' => 'природа два',
        ]);

    }

    public function uploadNotImageError(FunctionalTester $I)
    {
        $I->sendGET('/admin/site/login');

        $html = $I->grabResponse();
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        $input = $doc->getElementsByTagName('input')->item(0);
        $csrfToken = '';
        if ($input && $input->getAttribute('name') === '_csrf-backend') {
            $csrfToken = $input->getAttribute('value');
        }

        $I->sendPOST('/admin/site/login',[
            '_csrf-backend' => $csrfToken,
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => '123456',
            'LoginForm[rememberMe]' => '1',
        ]);

        $html = $I->grabResponse();
        $csrfToken = '';
        if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
            $csrfToken = $matches[1];
        }

        $I->sendPOST('/admin/image/upload',[
            '_csrf-backend' => $csrfToken,
        ],[
            'images[природа]' => codecept_data_dir('природа.jpg'),
            'images[природа два]' => codecept_data_dir('природа два.jpg'),
            'images[text1]' => codecept_data_dir('text.1.txt'),
        ]);

        $responseContent = $I->grabResponse();
        $jsonResponse = json_decode($responseContent, true);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'error' => 'Принимаются только изображения'
        ]);

    }

    public function uploadOnlyFiveFilesError(FunctionalTester $I)
    {
        $I->sendGET('/admin/site/login');

        $html = $I->grabResponse();
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        $input = $doc->getElementsByTagName('input')->item(0);
        $csrfToken = '';
        if ($input && $input->getAttribute('name') === '_csrf-backend') {
            $csrfToken = $input->getAttribute('value');
        }

        $I->sendPOST('/admin/site/login',[
            '_csrf-backend' => $csrfToken,
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => '123456',
            'LoginForm[rememberMe]' => '1',
        ]);

        $html = $I->grabResponse();
        $csrfToken = '';
        if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
            $csrfToken = $matches[1];
        }

        $I->sendPOST('/admin/image/upload',[
            '_csrf-backend' => $csrfToken,
        ],[
            'images[text1]' => codecept_data_dir('text.1.txt'),
            'images[text2]' => codecept_data_dir('text.2.txt'),
            'images[text3]' => codecept_data_dir('text.3.txt'),
            'images[text4]' => codecept_data_dir('text.4.txt'),
            'images[text5]' => codecept_data_dir('text.5.txt'),
            'images[text6]' => codecept_data_dir('text.6.txt'),
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'error' => 'Только 5 файлов'
        ]);

    }

    public function uploadImageMoreThanOneMbError(FunctionalTester $I)
    {
        $I->sendGET('/admin/site/login');

        $html = $I->grabResponse();
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        $input = $doc->getElementsByTagName('input')->item(0);
        $csrfToken = '';
        if ($input && $input->getAttribute('name') === '_csrf-backend') {
            $csrfToken = $input->getAttribute('value');
        }

        $I->sendPOST('/admin/site/login',[
            '_csrf-backend' => $csrfToken,
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => '123456',
            'LoginForm[rememberMe]' => '1',
        ]);

        $html = $I->grabResponse();
        $csrfToken = '';
        if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
            $csrfToken = $matches[1];
        }

        $I->sendPOST('/admin/image/upload',[
            '_csrf-backend' => $csrfToken,
        ],[
            'images[]' => codecept_data_dir('more.than.1.mega.jpg'),
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'error' => 'Размер файла больше 1 048 576 байт'
        ]);

    }

}