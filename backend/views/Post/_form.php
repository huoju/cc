<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Poststatus;
use \common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
    <?php
    /*
     *  方式1
        $psObjs = \common\models\Poststatus::find()->all();
        $allStatus = \yii\helpers\ArrayHelper::map($psObjs,'id','name');

        //方式2
        $psArray = Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
        $allStatus = \yii\helpers\ArrayHelper::map($psArray,'id','name');

        //方式3
        $allStatus = (new yii\db\Query())
        ->select(['name','id'])
        ->from('poststatus')
        ->indexBy('id')
        ->column();
*/
    ////方式4
    $allStatus = Poststatus::find()
        ->select(['name','id'])
        ->orderBy('position')
        ->indexBy('id')
        ->column();

    /* echo "<hr><pre>";
        print_r($allStatus);
    echo "</pre>";

    exit(0);
    */

    ?>

    <?= $form->field($model, 'status')
        ->dropDownList($allStatus, ['prompt'=>'请选择状态']) ?>

    <?php // $form->field($model, 'create_time')->textInput() ?>


    <?php // $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'author_id')
        ->dropDownList(Adminuser::find()
                    ->select(['nickname','id'])
                    ->indexBy('id')
                    ->column(),
        ['prompt'=>'请选择状态'])  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
