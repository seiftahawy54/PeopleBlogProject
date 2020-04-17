<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbtrom-fluid">
    <div class="container">
        <h1 class='display-4'><?php echo $data['title']?></h1>
        <p class="lead"><?php echo $data['description']?></p>
        <p class='lead'>App version : <span class='font-weight-bold'><?php echo APPVERSION;?></span></p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'?>