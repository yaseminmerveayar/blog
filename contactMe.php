<?php
if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['message'])){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $insert = $db->prepare("INSERT INTO contactMessages (name , phoneNumber , mail , message) VALUES (?,?,?,?)");    
    $insert -> execute([$name, $phone, $email, $message]);

    $errMessage = "<strong>Success!</strong> Your message has been sent to us.";
}
?>
<footer id="footer" class="bg-color-light border-0 pt-5 mt-0">
    <div class="container pb-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6" overflow-hidden>
                <div id="myDIV" class="contact-form-success alert alert-success d-none mt-4 text-center">
                    <strong>Success!</strong> Your message has been sent to us.
                </div>
                <?php
                    $q = $db -> prepare("SELECT value FROM homeContents where key = :key");
                    $q->execute(array('key'=>'contactMe'));

                    $result = $q->fetch();
                    $a =explode("','","$result[0]");
                    $b =explode(" ","$a[0]");
                ?>
                <h2 class="font-weight-normal text-color-dark text-center text-8 mb-4" data-appear-animation="maskUp" data-appear-animation-delay="200"><strong class="font-weight-extra-bold"><?= $b[0] ?></strong> <?= $b[1] ?></h2>
                <p class="text-4 opacity-8 text-center mb-4" data-appear-animation="maskUp" data-appear-animation-delay="300"><?= $a[1] ?></p>
                <form id="contactForm" class="contact-form form-style-3" method="POST" data-appear-animation="maskUp" data-appear-animation-delay="400">
                    <div class="row">
                        <div class="form-group col-md-6 pe-md-2">
                            <input type="text"  data-msg-required="Please enter your name." maxlength="100" class="form-control h-auto py-2" placeholder="Your Name..." name="name" id="name" required>
                        </div>
                        <div class="form-group col-md-6 ps-md-2">
                            <input type="text"  data-msg-required="Please enter your phone." maxlength="100" class="form-control h-auto py-2" placeholder="Your Phone..." name="phone" id="phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control h-auto py-2" placeholder="Your Email Address..." name="email" id="email" required>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <textarea maxlength="5000" data-msg-required="Please enter your message." rows="4" class="form-control" placeholder="Your Message..." name="message" id="message" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col text-center">
                            <button type="submit" class="btn btn-primary font-weight-semibold text-3 px-5 btn-py-2">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-copyright curved-border curved-border-top d-flex align-items-center">
        <div class="container py-2">
            <div class="row py-4">
                <div class="col text-center">
                    <p class="text-3">2022 © <strong class="font-weight-normal text-color-light opacity-7">YMA</strong> - Copyright. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector("#contactForm").addEventListener("submit", e => {
        e.preventDefault();
        openDiv();
        });

        function openDiv() {
        var element = document.getElementById("myDIV");
        element.classList.remove("d-none");
        }
    </script>
</footer>