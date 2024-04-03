<?php

use app\components\basic\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::$app->user->isGuest ? 'Регистрация' : 'Создание пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
