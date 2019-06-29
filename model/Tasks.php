<?php
require_once 'model/Controller.php';

class Tasks extends Controller
{
    public function add($text, $login, $email)
    {
        $this->pdo->query('INSERT INTO '.DB_PREFIX.'tasks (text, login, email) VALUES ("' . $text . '", "' . $login . '","' . $email . '")');
    }

    public function edit($text, $login, $email, $status, $task_id)
    {
        $this->pdo->query("UPDATE ".DB_PREFIX."tasks SET text='$text', login='$login', email='$email', status=$status WHERE task_id=$task_id");
    }

    public function delete($task_id)
    {

    }
    public function getTasks($sort_by = '', $page=1)
    {
        if ($sort_by != '')
        {
            $sort_by = " WHERE ".$sort_by;
        }
        $offset = ($page-1)*CNT_ONE_PAGE;
		$sql = "SELECT * FROM ".DB_PREFIX."tasks ".$sort_by." LIMIT ".$offset.",".CNT_ONE_PAGE;
        $tsks = $this->pdo->query($sql);
		$arr=[];
		if($tsks){
			while ($row = $tsks->fetch())
			{
				$arr[] = $row;
			}
			if(!empty($arr)){
				return $arr;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
	public function getStatus($status){
		if($status==0) return 'Выполнено';		
		else if($status==1) return 'Не выполнено';		
		else return 'Неизвестно';		
	}
	public function getCNT($sort_by = '', $page=1){
        if ($sort_by != '')
        {
            $sort_by = " WHERE ".$sort_by;
        }
        $offset = ($page-1)*CNT_ONE_PAGE;
        $tsks = $this->pdo->query("SELECT COUNT(task_id) as cnt FROM ".DB_PREFIX."tasks ".$sort_by);
        if($tsks){
		$row = $tsks->fetch();
			if(!empty($row)){
				return $row['cnt'];
			}else{
				return false;
			}
		}
    }
	public function getPagination($page, $cnt){
		$pag = '';
		$max_pages = ceil($cnt/CNT_ONE_PAGE);
		if($page-3>0){
			$pag .= '<a data-page="1">1..</a>';
		}
		if($page-2>0){
			$pag .= '<a data-page="'.($page-2).'">'.($page-2).'</a>';
		}
		if($page-1>0){
			$pag .= '<a data-page="'.($page-1).'">'.($page-1).'</a>';
		}
		$pag .= '<a class="cur" data-page="'.$page.'">'.$page.'</a>';
		if($page+1<=$max_pages){
			$pag .= '<a data-page="'.($page+1).'">'.($page+1).'</a>';
		}
		if($page+2<=$max_pages){
			$pag .= '<a data-page="'.($page+2).'">'.($page+2).'</a>';
		}
		if($page+3<=$max_pages){
			$pag .= '<a data-page="'.$max_pages.'">..'.$max_pages.'</a>';
		}
		return $pag;
	}
}