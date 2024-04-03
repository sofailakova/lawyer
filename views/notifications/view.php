<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userName',
            ['attribute' => 'message', 'format' => 'html'],
            ['attribute' => 'readIcon', 'format' => 'html'],
            'create_at',
        ],
    ]) ?>

</div>
