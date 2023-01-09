<?php
require './header.php';
?>

<div id="contact-container">
    <div class="d-flex justify-content-center container">
        <div class="bg-light p-4 w-md-50 mt-4 rounded shadow">
            <h2 class="text-center">Contact us</h2>
            <form action="#" method="post">
                <div class="mt-3">
                    <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="mt-3">
                    <input type="text" class="form-control" placeholder="Email">
                </div>
                <div class="mt-3">
                    <textarea name="message" cols="30" rows="5" placeholder="Message" class="form-control"></textarea>
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require './footer.php';
?>