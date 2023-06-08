<?php require('partials/head.php'); ?>

<form action="/login" method="POST">
    <div class="imgcontainer">
        <img src="https://via.placeholder.com/50" alt="Avatar" class="avatar" >
    </div>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required >

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
    </div>

</form>

<?php require('partials/footer.php'); ?>
