<div class="row footer-main-container">
    <div class="large-12 columns">
        <hr />
    </div>
    <div class="large-12 columns row footer-container-one" style="margin-left:0">
        <div class="large-1 columns" style="width:1%">
            &nbsp;
        </div>
        <div class="large-4 columns">
            <form>
                <div class="h5-inline">Get our weekly newsletter</div><br />
                <fieldset>
                    <input type="email" name="email-user-notifications" placeholder="Enter Email Address">
                    <button type="button" class="button expanded" style="background-color: #faa732;">Sign Up</button>
                </fieldset>
            </form>
        </div>
        <div class="large-4 columns">
            &nbsp;
        </div>

        <div class="large-3 columns social-container">
            <img src="<?= $_SESSION['page']['home_url'] ?>img/icons/facebook-32.png" />
            <img src="<?= $_SESSION['page']['home_url'] ?>img/icons/twitter-32.png" />
            <img src="<?= $_SESSION['page']['home_url'] ?>img/icons/googleplus-32.png" />
            <img src="<?= $_SESSION['page']['home_url'] ?>img/icons/pinterest-32.png" />
        </div>

    </div>

    <div class="large-12 columns" style="margin-left:0">
        <div class="span1" style="width:1%">
            &nbsp;
        </div>
        <div class="large-5 columns" style="font-size:13px" align="center">
            <h5>Samedi Gift Registry</h5>
            <a href="<?= $_SESSION['page']['home_url'] ?>services-we-offer/">Services We Offer</a><br />
            <a href="<?= $_SESSION['page']['home_url'] ?>creating-a-gift-registry/">Creating a Gift Registry</a><br />
        </div>
        <div class="large-3 columns" style="font-size:13px">
            <h5>samedi</h5>
            <a href="<?= $_SESSION['page']['home_url'] ?>terms-of-use/">Terms of Use</a><br />
            <a href="<?= $_SESSION['page']['home_url'] ?>privacy-policy/">Privacy Policy</a><br />
        </div>
        <div class="large-3 columns" style="font-size:13px">
            <h5>Customer Service</h5>
            <a href="">Blog</a><br />
            <a href="<?= $_SESSION['page']['home_url'] ?>contact-us/">Contact Us</a><br />
            <a href="<?= $_SESSION['page']['home_url'] ?>feedback/">Feedback</a><br />
        </div>
    </div>

    <div class="row footer-container-end" style="margin-left:0;">
        <div class="large-5 columns">
            <div class="large-1 columns" style="width:1%">
                &nbsp;
            </div>
            &copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
            <?php echo(date('Y')); ?>
        </div>
    </div>
</div>