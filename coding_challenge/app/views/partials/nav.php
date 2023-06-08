<div class="topnav">
    <a  href="#home">Home</a>
    <?= ( isset($_SESSION['userId'])) ?  "<a href='/posts'>Create Post</a>": ""; ?>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <?= ( isset($_SESSION['userId'])) ?  "<a class='active' href='/logout'>LOGOUT</a>": "<a class='active' href='/login'>LOGIN</a>"; ?>
</div>
