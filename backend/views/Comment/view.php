<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '评论管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            //'status',
            ['label'=>'状态',
                'value'=>$model->status0->name,
            ],

            //'create_time:datetime',
            ['attribute'=>'create_time',
                'value'=>date('Y-m-d h:i:s',$model->create_time),
            ],
            //'userid',
            ['label'=>'用户',
                'value'=>$model->user->username,
            ],

            'email:email',
            'url:url',
            //'post_id',
            ['label'=>'文章标题',
                'value'=>$model->post->title,
            ],
            'remind',
        ],
    ]) ?>

</div>
