<?php
/**
 * @var $data
 * @var Request $request
 */

?>
<?php require_once APPROOT . '/views/example/example_inc/header.php'; ?>
<?php require_once APPROOT . '/views/example/example_inc/components/topnavbar.php' ?>



    <div class="form-container">
        <p>Name: <?php echo $data['name']?></p>
        <p>Email: <?php echo $data['email']?></p>
    </div>

    <form action="" method="post" enctype = "multipart/form-data">
        <p>Upload an Image</p>
        <input type="file" name="image" id="">

        <p>Upload a file</p>
        <input type="file" name="file" id="">

        <input type="submit" value="Submit">

    </form>

    <form action="" method="post" enctype = "multipart/form-data">


    </form>

    <?php if(isset($data['filename'])): ?>
        <a href="<?php echo URLROOT . '/load-file?file=' . $data['filename'] ?>">See your uploaded file here !</a>
        <br/>
    <?php endif; ?>


    <?php if(isset($data['image'])) :?>
        <?php echo $data['image']?>
        <br/>
        <img src="<?php echo URLROOT . $data['image'] ?>" alt="Image goes here">
    <?php  endif;?>

<?php require_once APPROOT . '/views/example/example_inc/footer.php'; ?>