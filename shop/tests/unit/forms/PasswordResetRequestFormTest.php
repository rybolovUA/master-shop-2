<?php

namespace shop\tests\unit\forms;

use Yii;
use shop\forms\auth\PasswordResetRequestForm;
use common\fixtures\UserFixture as UserFixture;
use shop\entities\User\User;

class PasswordResetRequestFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'User' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'User.php'
            ]
        ]);
    }

    public function testWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect_not($model->validate());
    }

    public function testInactiveUser()
    {
        $user = $this->tester->grabFixture('User', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        expect_not($model->validate());
    }

    public function testSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('User', 0);

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        expect_that($model->validate());
    }
}