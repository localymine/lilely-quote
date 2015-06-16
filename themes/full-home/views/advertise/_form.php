<?php
$form = $this->beginWidget('UActiveForm', array(
    'id' => 'advertise-form',
    'action' => Yii::app()->createUrl('advertise'),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    )
        ));
?>
<fieldset>
    <!--<div class="alert alert-danger">-->
    <?php // echo $form->errorSummary($model, ''); ?>
    <!--</div>-->
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-12" for="company"><?php echo Common::t('Company', 'post') ?></label>
        <div class="col-md-12 col-xs-6">
            <?php echo $form->textField($model, 'company', array('class' => 'form-control')) ?>
            <?php echo $form->error($model, 'company', array('class' => 'hint text-danger')); ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-12" for="first_name"><?php echo Common::t('First Name', 'post') ?></label>
        <div class="col-md-12 col-xs-6">
            <?php echo $form->textField($model, 'first_name', array('class' => 'form-control')) ?>
            <?php echo $form->error($model, 'first_name', array('class' => 'hint text-danger')); ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-12" for="last_name"><?php echo Common::t('Last Name', 'post') ?></label>
        <div class="col-md-12 col-xs-6">
            <?php echo $form->textField($model, 'last_name', array('class' => 'form-control')) ?>
            <?php echo $form->error($model, 'last_name', array('class' => 'hint text-danger')); ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-12" for="email"><?php echo Common::t('Email', 'post') ?></label>
        <div class="col-md-12 col-xs-6">
            <?php echo $form->textField($model, 'email', array('class' => 'form-control')) ?>
            <?php echo $form->error($model, 'email', array('class' => 'hint text-danger')); ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-12" for="type"><?php echo Common::t('Organization Type', 'post') ?></label>
        <div class="col-md-12 col-xs-6">
            <?php echo $form->dropDownList($model, 'type', Advertise::itemAlias('type'), array('class' => 'form-control', 'empty' => Common::t('None', 'post'))) ?>
            <?php echo $form->error($model, 'type', array('class' => 'hint text-danger')); ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-12" for="interest">Are you interest in (check all that apply)</label>
        <div class="col-md-12 col-xs-6">
            <?php echo $form->checkBoxList($model_ads_relate, 'f_interest', Advertise::itemAlias('interest'), array('class' => 'hand')) ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <label class="col-md-12 col-xs-7" for="interest">Please provide any further details/ask any further questions here</label>
        <div class="col-md-12 col-xs-7">
            <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'row' => '6', 'style' => 'resize:vertical;')) ?>
        </div>
    </div>
    <div class="form-group no-margin-horizontal margin-bottom-small">
        <input type="submit" class="btn btn-default btn-go" value="<?php echo Common::t('Submit', 'post') ?>">
    </div>
</fieldset>
<?php $this->endWidget(); ?>