<form action="" name="form" id="our-form">
    <div class="col-md-12">
        <div class="col-md-4">
            <input type="text" name="login" placeholder="enter login" value="<?php echo (isset($_REQUEST['login']) && $_REQUEST['login']!='') ? addslashes(trim($_REQUEST['login'])) : ''?>">
        </div>
        <div class="col-md-4">
            <input type="email" name="email" placeholder="enter email" value="<?php echo (isset($_REQUEST['email']) && $_REQUEST['email']!='') ? addslashes(trim($_REQUEST['email'])) : ''?>">
        </div>
        <!--<div class="col-md-4">
            <input type="password" name="password" placeholder="enter password" value="<?php /*echo (isset($_REQUEST['password']) && $_REQUEST['password']!='') ? addslashes(trim($_REQUEST['password'])) : ''*/?>">
        </div>-->
        <div class="col-md-4">
            <select name="status">
                <option value="-1" selected>Все статусы</option>
                <option value="0" <?php if(isset($_REQUEST['status']) && $_REQUEST['status']==0){ ?>selected<?php } ?>>Выполненные</option>
                <option value="1" <?php if(isset($_REQUEST['status']) && $_REQUEST['status']==1){ ?>selected<?php } ?>>Невыполненные</option>
            </select>
        </div>
		<input type="hidden" name="page" id="page" value="1">
		<div class="col-md-12">
			<input type="submit" value="Filter" name="filter">
		</div>
    </div>

    <div class="col-md-12 row">
        <?php
        if ($tasks && !empty($tasks))
        {
			foreach($tasks as $ts){
				?>
			<div class="col-md-4 border<?php echo $ts['status'];?>">
				<div class="name_t">Задача №<?php echo $ts['task_id'];?></div>
				<div class="name_l"><?php echo $ts['login'];?></div>
				<div class="name_e"><?php echo $ts['email'];?></div>
				<div class="name_tz"><?php echo $ts['text'];?></div>
				<div class="name_stat"><?php echo $ModelTasks->getStatus($ts['status']);?></div>
			</div>
        <?php }?>
		<?php }else{ ?>
        <h4>Еще нет созданных задач!</h4>
        <?php } ?>
    </div>
	<div class="col-md-12 pag"><?=$pagination?></div>
</form>	
<form action="">
	<div class="col-md-12">
		<input type="text" name="login" placeholder="Enter login">
	</div>
	<div class="col-md-12">
		<input type="email" name="email" placeholder="Enter email">
	</div>
	<div class="col-md-12">
		<textarea name="text" placeholder="Enter text of the task" rows="10"></textarea>
	</div>
	<div class="col-md-12">
		<input type="submit" name="create_task" value="Create task">
	</div>
	<input type="hidden" name="action" value="add">
</form>
<?php
if ($_SESSION['type'] == 'admin')
    echo 'Log out';
?>
