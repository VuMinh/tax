<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ketquakttaitrusonnt */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\DateValidation */

$this->title = Yii::t('app', 'Create Ketquakttaitrusonnt');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ketquakttaitrusonnts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ketquakttaitrusonnt-create">

    <h2 ><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
