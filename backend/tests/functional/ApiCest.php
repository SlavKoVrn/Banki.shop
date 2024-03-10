<?php
namespace backend\tests\functional;

use common\fixtures\ImageFixture;
use backend\tests\FunctionalTester;
use Faker\Factory;

class ApiCest
{
    public function _fixtures()
    {
        return [
            'image' => [
                'class' => ImageFixture::class,
                'dataFile' => codecept_data_dir() . 'image.php',
            ],
        ];
    }

    public function seeImagesList(FunctionalTester $I)
    {
        $I->sendGET('/api');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'size' => '306156',
            'name' => '0fc0befb-7c1d-4fef-ad70-92b385872eaf',
            'slug' => '0fc0befb-7c1d-4fef-ad70-92b385872eaf',
            'mime' => 'image/jpeg',
            'path' => '/upload/images/0fc0befb-7c1d-4fef-ad70-92b385872eaf.jpg',
            'datetime' => '2024-03-08 15:52:49',
        ]);
        $I->seeHttpHeader('X-Pagination-Total-Count', '23');
    }

    public function seeImageOne(FunctionalTester $I)
    {
        $I->sendGET('/api/image/1');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'size' => '306156',
            'name' => '0fc0befb-7c1d-4fef-ad70-92b385872eaf',
            'slug' => '0fc0befb-7c1d-4fef-ad70-92b385872eaf',
            'mime' => 'image/jpeg',
            'path' => '/upload/images/0fc0befb-7c1d-4fef-ad70-92b385872eaf.jpg',
            'datetime' => '2024-03-08 15:52:49',
        ]);
    }

}