<?php

use common\models\Adminuser;
use common\models\Post;
use common\models\Poststatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php
     //$form->field($model, 'status')->textInput()
    ?>
    <?php
    $allStatus = Poststatus::find()
    ->select(['name','id'])
    ->orderBy('position')
    ->indexBy('id')
    ->column();
    ?>

    <?= $form->field($model, 'status')
        ->dropDownList($allStatus, ['prompt'=>'请选择状态']) ?>

    <?php

    //$form->field($model, 'create_time')->textInput()

    ?>

    <?php
    //$form->field($model, 'userid')->textInput() ?>


    <?= $form->field($model, 'userid')
        ->dropDownList(Adminuser::find()
            ->select(['username','id'])
            ->indexBy('id')
            ->column(),
            ['prompt'=>'请选择状态'])  ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php
    //$form->field($model, 'post_id')->textInput() ?>

    <?= $form->field($model, 'post_id')
        ->dropDownList(post::find()
            ->select(['title','id'])
            ->indexBy('id')
            ->column(),
            ['prompt'=>'请选择状态'])  ?>

    <?= $form->field($model, 'remind')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
