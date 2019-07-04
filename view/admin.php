<h3>Admin page</h3>
<?php if (!empty($tasks)){ ?>
<form action="" method="post">
    <?php foreach ($tasks

                   as $t) { ?>
    <div class="one_t">
        <h4>Задача #<?php echo $t['id']; ?></h4>
        <input type="text" value="<?php echo $t['login']; ?>" name="login[]"><br>
        <input type="text" value="<?php echo $t['email']; ?>" name="email[]"><br>

        <textarea name="task[]"><?php echo $t['text']; ?></textarea><br> <input type="checkbox" name="complete[]"
                                                                                <?php if ($t['status'] == 0) { ?>checked<?php }
                                                                                }
                                                                                } ?>Выполнено <br>
<!--        <input type="submit" name="comein" value="comein">-->
    </div>
    <?php ?>
</form>