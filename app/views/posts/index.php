<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('post_message'); ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <h2 class="h1">Posts</h2>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT;?>/posts/add" class="btn btn-primary float-right">
                <i class="fas fa-pencil-alt"></i> Add Post
            </a>
        </div>
    </div>
    <?php foreach ($data['posts'] as $post) :?>
        <div class="card card-body mb-3">
            <h4 class="h3 card-title"><?php echo $post->title; ?></h4>
            <div class='bg-light p-2 mb-3'>
                written by <?php echo $post->name; ?> on <?php echo $post->createdDate; ?>
            </div>
            <p class="card-text"><?php echo $post->body;?></p>
            <a href="<?php echo URLROOT;?>/posts/show<?php echo $post->postId;?>" class="btn btn-dark">More</a>
        </div>
    <?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'?>