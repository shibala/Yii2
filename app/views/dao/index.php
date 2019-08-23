<?php

?>

<div class="row">
    <div class="col-md-6">
        <pre>
    <?php print_r($model->getAllUsers()); ?>
        </pre>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <pre>
    <?php print_r($model->getUsersActivities(1)); ?>
        </pre>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <pre>
    <?php print_r($model->getFirstActivity()); ?>
        </pre>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <pre>
     <?php print_r($model->countNotificatedActivities()); ?>
        </pre>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <pre>
     <?php print_r($model->getAllActivitiesOfUser(2)); ?>
        </pre>
    </div>
</div>




