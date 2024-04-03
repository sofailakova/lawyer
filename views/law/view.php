<?php

use app\modules\upload\widgets\MultiuploadWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Law */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Законы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="law-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действиетельно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number:ntext',
            'name:ntext',
            'description:ntext',
            'publicate_at',
            'create_at',
        ],
    ]) ?>

    <?php echo (new \app\modules\upload\widgets\AttachmentWidget(['model' => $model]))->run() ?>

</div>
