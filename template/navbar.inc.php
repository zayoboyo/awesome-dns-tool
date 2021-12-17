<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            AwesomeDNS Tool
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item">
                <div class="buttons">
                    <?php foreach(\Common\DNSRecord::availableDnsRecords() as $dns) { ?>
                    <a class="button is-primary" href="/?type=<?php echo $dns; ?>">
                        <strong><?php echo $dns; ?></strong>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php if(has_message('message')) { ?>
<div class="notification is-success">
    <?php echo session_message(); ?>
</div>
<?php } ?>