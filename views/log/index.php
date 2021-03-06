<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'time:datetime',
                'ip:ntext',
                'userName',
                'eventName',
                'eventInfo:ntext',

                [
                    'label' => 'Откат изменений',
                    'format' => 'raw',
                    'value' => function($model) {
                        /* @var $model app\models\Log */
                        return Html::beginForm(['/log/revert'], 'post')
                            . Html::hiddenInput('eventId', $model->id)
                            . Html::submitButton(
                                'Откатить сюда',
                                [
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'return confirm("Вы действительно хотите отменить все изменения после этого?")'
                                ]
                            )
                            . Html::endForm();
                    }
                ]
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
