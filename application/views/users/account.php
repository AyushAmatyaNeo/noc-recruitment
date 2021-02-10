<div class="container">
    <h2>Welcome <?php echo $user['FIRST_NAME']; ?>!</h2>
    <a href="<?php echo base_url('users/logout'); ?>" class="logout">Logout</a>
    <div class="regisFrm">
        <p><b>Name: </b><?php echo $user['FIRST_NAME'].' '.$user['LAST_NAME']; ?></p>
        <p><b>Email: </b><?php echo $user['EMAIL_ID']; ?></p>
        <p><b>Phone: </b><?php echo $user['MOBILE_NO']; ?></p>
        <p><b>Gender: </b><?php echo $user['GENDER']; ?></p>
    </div>
</div>