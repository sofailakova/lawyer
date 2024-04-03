<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<link rel="stylesheet" href="/css/imgarea/imgareaselect-animated.css" type="text/css">
<link rel="stylesheet" href="/css/awesome-avatar.css" type="text/css">

<?php echo Html::hiddenInput($self->options['name'], $self->model->{$self->attribute}, [
	'id'=> $self->options['id'],
]); ?>
<a onclick="$('#<?=$self->attribute;?>_modal').modal('show');">
	<?php echo Html::img($attachment->getTitleUrl(), [
		'id' => $self->options['img_id'],
		'alt' => isset($self->options['alt_img']) ? $self->options['alt_img'] : $self::ALT_IMG,
		'width' => $self->options['width_img'],
		'class' => 'avatar',
	]); ?>
</a>


<div class="modal fade" id="<?=$self->attribute;?>_modal" tabindex="-1" role="dialog" aria-labelledby="<?=$self->attribute;?>_modal_label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

			<?php echo Html::hiddenInput('action', $self->options['action']); ?>
			<?php echo Html::hiddenInput('model_class', \yii\helpers\StringHelper::basename(get_class($self->model))); ?>
			<?php //echo Html::hiddenInput('model_id', $self->model->id); ?>
			
			<div class="modal-header">
				<h4 class="modal-title text-center" id="<?=$self->attribute;?>_modal_label">Загрузить аватар</h4>
			</div>

			<div class="modal-body">
				<label for="<?=$self->attribute;?>">Image:</label>
				
				<div class="awesome-avatar-widget">

					<div style="display:none">
						<input id="<?=$self->attribute;?>-x1" type="hidden" name="image-x1">
						<input id="<?=$self->attribute;?>-y1" type="hidden" name="image-y1">
						<input id="<?=$self->attribute;?>-x2" type="hidden" name="image-x2">
						<input id="<?=$self->attribute;?>-y2" type="hidden" name="image-y2">
						<input id="<?=$self->attribute;?>-ratio" type="hidden" name="image-ratio">
					</div>

					<table>
						<tbody>
						<tr>
							<td>
								<div id="<?=$self->attribute;?>-preview" class="awesome-avatar-preview" style="width:100px;height:100px">
									<img width="100" height="100" src="<?php echo $attachment->getTitleUrl(); ?>">
								</div>
							</td>
							<td>
								<div id="<?=$self->attribute;?>-select-area" class="awesome-avatar-select-area" style="width:400px;height:250px">
									<img src="<?php echo $attachment->getTitleUrl(); ?>">
								</div>
								<input type="file" class="awesome-avatar-input" id="<?=$self->attribute;?>" name="files" accept="image/jpeg,image/png,image/gif">
							</td>
						</tr>
						</tbody>
					</table>
					
				</div>

			</div>

			<div class="modal-footer">
				<button id="modal-button-send" type="button" class="btn btn-primary">Сохранить</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
        </div>
    </div>
</div>