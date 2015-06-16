<?php
$this->pageTitle = 'Advertise' . '|' . Yii::app()->name;
?>

<div class="min-height show-content advertise">
    <div class="row center-block intro">
        <div class="col-md-4 col-xs-12 first">
            <img class="img-responsive center-block" src="../images/lilely-tree.png"/>
        </div>
        <div class="col-md-4 col-xs-12 mid">
            <h1>Test for the Advertise with Us:</h1>
            <p>
                "Lilely is a mindful way to inspire yourself and others. Advertising with us involves sponsorship, where you can have an opportunity to thousands of thoughtful and inspired people and let them promote your product to their friends and other members of the network. Sponsorship means that you will be the sponsor of the day, and have the entire page to yourself, rather than competing for the attention of people logged on to the site. Contact us today through the form below to discuss rates and how we can help your brand create an inspired reputation."
            </p>
        </div>
        <div class="col-md-4 col-xs-12 last">
            <!--Lilely is a single place to discover, listen, and share all the messages uplifting you". It should just say "Join our network today!-->
            <ul>
                <li>Lilely reaches the thoughtful among us, and our users love quality and corporate responsibility.</li>
                <li>Lilely is multi-language and far-reaching, giving you a head start on the growing incomes of many communities.</li>
                <li>Lilely is uplifting, and will help your brand have a positive reputation</li>
                <li>Lilely has unique users who are happy to share, so your sponsorship gets shared as well</li>
            </ul>
        </div>
        <div class="col-md-12 mhline">
            <div class="hline"></div>
        </div>
    </div>
    <div class="row">
        <div class="container ad-form">
            <?php $this->renderPartial('_form', array('model' => $model, 'model_ads_relate' => $model_ads_relate)) ?>
        </div>
    </div>
</div>