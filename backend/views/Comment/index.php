<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?php
        // Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],  序号

            //'id',
            ['attribute'=>'id',
                'contentOptions'=>['width'=>'20px'],
            ],

            //'content:ntext',
            ['attribute'=>'content',
               'label'=>'内容',
               'value'=>'beginning', //不区分大小写

//                'value'=>function($model)
//                {
//                    $tmpStr = strip_tags($model->content);
//                    $tmpLen = mb_strlen($tmpStr);
//
//                    return mb_substr($tmpStr,0,20,'utf-8').(($tmpLen>20)?'...':'');//
//
//                },
                'contentOptions'=>['width'=>'380px'],
            ],
            //'userid',
            ['attribute'=>'user.username',
                'label'=>'留言用户',
                'value'=>'user.username',
                'contentOptions'=>['width'=>'100px'],

            ],
            //'status',
            ['attribute'=>'status',
                'value'=>'status0.name',
                'contentOptions'=>['width'=>'100px'],
                'filter'=>\common\models\Commentstatus::find()
                    ->select(['name','id'])
                    ->orderBy('position')
                    ->indexBy('id')
                    ->column(),
                'contentOptions' =>
                function($model)
                {
                    return($model->status==1)?['class'=>'bg-danger']:[];
                }
            ],
            //'create_time:datetime',
            ['attribute'=>'create_time',
                'format'=>['date','php:Y-m-d H:i:s'],
                'contentOptions'=>['width'=>'260px'],
            ],


            'email:email',
            'url:url',
           // 'post_id',
            ['attribute'=>'post.title',
                'label'=>'文章标题',
                'value'=>'post.subTitle',
                'contentOptions'=>['width'=>'150px'],
            ],



            //'remind',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}  {update}  {delete}  {approve}',
                'buttons'=>['approve'=>function($url,$model,$key)
                    {
                        $options=[
                            'title'=>Yii::t('yii','审核'),
                            'aria-label'=>Yii::t('yii','审核'),
                            'data-confirm'=>Yii::t('yii','确定要通过这条评论吗?'),
                            'data-method' =>'post',
                            'data-pjax'=>'0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                    },
                ],

            ],
        ],
    ]); ?>


</div>
