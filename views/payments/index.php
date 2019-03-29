<?php

/* @var $this yii\web\View */
/* @var $searchModel cinghie\paypal\models\PaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('paypal', 'Payments');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="payments-index">

	<?php if(Yii::$app->getModule('articles')->showTitles): ?>
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
	<?php endif ?>

	<?= GridView::widget([
		'dataProvider'=> $dataProvider,
		'filterModel' => $searchModel,
		'containerOptions' => [
			'class' => 'articles-items-pjax-container'
		],
		'pjax' => true,
		'pjaxSettings'=>[
			'neverTimeout' => true,
		],
        'columns' => [
	        [
		        'class' => CheckboxColumn::class
	        ],
            [
	            'attribute' => 'transaction_id',
            ],
	        [
		        'attribute' => 'payment_id',
	        ],
	        [
		        'attribute' => 'payment_method',
            ],
	        [
		        'attribute' => 'created_by',
		        'filterType' => GridView::FILTER_SELECT2,
		        'filter' => $searchModel->getUsersSelect2(),
		        'filterWidgetOptions' => [
			        'pluginOptions' => ['allowClear' => true],
		        ],
		        'filterInputOptions' => ['placeholder' => ''],
		        'format' => 'raw',
		        'hAlign' => 'center',
		        'width' => '8%',
		        'value' => function ($model) {
			        /** @var $model cinghie\articles\models\Items */
			        return $model->getCreatedByGridView();
		        }
	        ],
	        [
		        'attribute' => 'created',
		        'hAlign' => 'center',
	        ],
            //'client_token',
            //'currency',
            //'total_paid',
            //'payment_state',
            //'method',
            //'description',
            //'created_by',
            //'created',
        ],
		'responsive' => true,
		'responsiveWrap' => true,
		'hover' => true,
		'panel' => [
			'heading' => '<h3 class="panel-title"><i class="fa fa-paypal"></i></h3>',
			'type' => 'success',
		],
    ]) ?>

</div>
