<!DOCTYPE html>
<html lang="sk">
<?php include(app_path('template/head.inc.php')); ?>
<body>
<?php include(app_path('template/navbar.inc.php')); ?>
    <section class="section">
        <div class="container">
            <form action="/dns/create">
            <button class="button is-primary" name="type" value="<?php echo $type; ?>">Add new <?php echo $type; ?> record</button>
            </form>
            <table class="table is-striped" style="width:100%">

                <thead>
                <tr>
                    <?php foreach ($dnsRecord->bindings() as $key => $value) { ?>
                        <th class="<?php if($key == 'type') echo 'is-hidden'; ?>"><?php echo $value; ?></th>
                    <?php } ?>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($filtered); $i++) { ?>
                <tr>
                    <?php foreach($dnsRecord->bindings() as $key => $value) { ?>
                    <td class="<?php if($key == 'type') echo 'is-hidden'; ?>"><?php echo $filtered[$i][$key]; ?></td>
                    <?php } ?>
                    <td>
                        <div class="field is-grouped">
                            <form action="/dns/edit" method="get">
                                <button class="button is-primary mr-3" name="id" value="<?php echo $filtered[$i]['id']; ?>">Edit</button>
                            </form>
                            <form action="/dns/delete" method="post">
                                <input type="hidden" name="type" value="<?php echo $filtered[$i]['type']; ?>">
                                <button type="submit" name="id" class="button is-danger" value="<?php echo $filtered[$i]['id']; ?>">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>