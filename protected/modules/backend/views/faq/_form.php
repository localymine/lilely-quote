<?php
/* @var $this TermsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = ($update == 0) ? ("Add FAQ" . ' | ' . Yii::app()->name) : ("Update FAQ" . ' | ' . Yii::app()->name);

?>

<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>FAQ<br /><small>...</small>
        </h1>
    </div>
</div>

<div class="row">

    <div class="col-md-8">
        <div class="block">
            <div class="block-title">
                <h2><?php echo $form_title; ?></h2>
                <?php if($update == 1): ?>
                <div class="block-options pull-right"><a href="<?php echo Yii::app()->createUrl('backend/faq/create') ?>" class="btn btn-sm btn-primary">Add New</a></div>
                <?php endif; ?>
            </div>

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'faq-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal form-bordered'
                ),
            ));
            ?>

            <div class="form-group">
                <div class="col-md-12">
                    <?php echo $form->errorSummary($model); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Question</label>
                <div class="col-md-10">
                    <?php echo $form->textField($model, 'post_title', array('class' => 'form-control')) ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-offset-1">Answer</label>
                <div class="col-md-12">
                    <?php
                    $this->widget('application.extensions.ckeditor.CKEditor', array(
                        'model' => $model,
                        'attribute' => 'post_content',
                        'language' => 'en',
                        'editorTemplate' => 'advanced',
                        'toolbar'=> array( 
                            array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Undo', 'Redo', '-','Find','Replace','-','SelectAll','RemoveFormat'),
                            array('Styles','Format','Font','FontSize', '-', 'TextColor','BGColor', '-', 'Maximize','ShowBlocks')
                            ),
                    ));
                    ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>

    <div class="col-md-4">
        
        <div class="block clearfix">
            <div class="block-title clearfix">
                <!--<h2>&nbsp;</h2>-->
                <div class="block-options pull-left"><a href="#tab_faq" data-toggle="tab" class="btn btn-sm btn-success">FAQ</a></div>
            </div>

            <div class="form-group">
                <div class="lst_category">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_major">
                            <div class="well well-sm alert-success themed-color-night"><strong>FAQ Category</strong>
                            <?php $this->widget('TreeCategory', array(
                                'submit_form' => 'faq-form',
                                'submit_name' => 'Page[category][]',
                                'select' => $select_categories,
                                'taxonomy' => 'category',
                                'show_in' => 'faq',
                            )) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-title">
                <?php if (!$model->isNewRecord): ?><div class="block-options pull-right">Last Modified: <?php echo $model->post_modified ?></div><?php endif; ?>
                <h2>Publish</h2>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-offset-4 col-xs-offset-4">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add New' : 'Update', array('class' => 'btn btn-sm btn-primary', 'form' => 'faq-form')); ?>
                <button class="btn btn-sm btn-warning" type="reset" form="faq-form"><i class="fa fa-repeat"></i> Reset</button>
                </div>
            </div>
        </div>

    </div>
</div>