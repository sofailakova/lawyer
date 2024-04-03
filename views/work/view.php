<?php

use app\modules\comments\widgets\CommentsWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Work */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Дела', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Действительно хотите удалить ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'insurance_id',
            'create_at',
            'done_at',
            'max_at',
        ],
    ]) ?>

    <?php echo CommentsWidget::widget([
        'model' => $model,
        'options' => [
            'upload' => false,
        ]
    ]); ?>

</div>
