<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
<?php require app_path('template/navbar.inc.php'); ?>
<form method="post" action="/dns/update">
    <section class="section">
        <div class="container">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <?php foreach($dnsRecord->bindings() as $key => $value) { ?>
            <div class="field <?php if($key == 'type') echo "is-hidden"; ?>">

                <label class="label"><?php echo $value; ?></label>
                <div class="control">
                    <input class="input" type="text" name="<?php echo $key; ?>" placeholder="" value="<?php echo $response[$key]; ?>">
                </div>
                <?php if(isset($_SESSION['errors'][$key])) { ?>
                    <p class="help is-danger"><?php echo $_SESSION['errors'][$key][0]; ?></p>
                <?php } ?>
            </div>
            <?php } ?>


            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">Update</button>
                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>