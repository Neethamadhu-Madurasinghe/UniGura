<?php

/**
 * @var $data
 * @var Request $request
 */

?>

<div class="topnav">
<?php if($request->isLoggedIn()): ?>

    <a class="active" href="#home">Home</a>
    <a><?php echo 'hello' . $request->getUserName() ?></a>
    <a href="<?php echo URLROOT?>/example/logout">logout</a>
</div>

<?php else: ?>
    <a class="active" href="#home">Home</a>
    <a href="<?php echo URLROOT?>/example/login">Login</a>
    <a href="<?php echo URLROOT?>/example/register">Register</a>
<!--    <a href="#about">Logout</a>-->
</div>

<?php endif ?>