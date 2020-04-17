<?php require APPROOT . '/views/inc/header.php'; ?>

    <a href="<?php echo URLROOT;?>/posts/index" class="btn btn-info"><i class="fas fa-chevron-circle-left"></i> Back</a>
    <br>
    <h2 class="h1"><?php echo $data['post']->title?></h2>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
    </div>
    <p class="lead bg-light"><?php echo $data['post']->body;?></p>

    <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
        <form action="<?php echo URLROOT;?>/posts/delete/<?php echo $data['post']->id;?>" method="post" class="float-right">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    <?php  endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>