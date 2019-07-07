<?php
//session_start();
if ($_REQUEST['come']) {
    $login = $_REQUEST['login'];
    $password = md5($_REQUEST['password']);
    define('USER_TYPE', 0);
    $query = 'SELECT * FROM bj_users WHERE login="' . $login . '" AND password="' . $password . '" AND type=0';
    $result = $ModelTasks->login($query);

    if ($result) {
        echo 'Come in. <br>';
        /*$_SESSION = array();
        session_destroy();*/
     /*   session_start();
        header("Cache-control: private");*/
        $_SESSION['type'] = 'admin';
        echo '$_SESSION["type"] = '.$_SESSION['type'];
//        header('Location: /');
        exit();
//        echo $adminca;
    } else {
        echo 'Не получилось зайти.';
    }
}
?>
<h3>Admin page</h3>
<form action="" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="login" name="login">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox"> Check me out
        </label>
    </div>
    <!--<button type="submit" class="btn btn-default" name="come">Submit</button>-->
    <input type="submit" name="come" value="come in">
</form>

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
    </div>
    <?php
    /* Если зашел то session_start()
    header: view/tasks.php*/
    /*$_SESSION['admin'] = true{
    if ($_GET['action'] == 'validate') {
    //a pokud odpovídají přihlašovací údaje
    if (($_POST['user'] == $login) && ($_POST['passwd'] == $pass)) {

    session_start();
    header("Cache-control: private"); // požadováno u některých prohlížečů

    //zaregistruje proměnou user_is_logged a nastaví ji na 1
    $_SESSION["admin"] = 1;
    //a pošlena úvodní soubor chráněné sekce
    header("Location: index.php");

    exit();
    }

    }

    }*/ ?>
</form>