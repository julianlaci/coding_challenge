<?php require('partials/head.php'); ?>
<div class="container">
    <form action="posts" method="POST">
        <div class="row">
            <div class="col-25">
                <label for="fname">Title</label>
            </div>
            <div class="col-75">
                <input type="text" id="title" name="title" placeholder="Blog Title">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lname">Last Name</label>
            </div>
            <div class="col-75">
                <input type="text" id="lname" name="image" placeholder="Image">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="subject">Subject</label>
            </div>
            <div class="col-75">
                <textarea id="subject" name="description" placeholder="Write something.." style="height:200px"></textarea>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>
<?php require('partials/footer.php'); ?>

