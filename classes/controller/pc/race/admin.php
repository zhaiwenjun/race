<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pc_Race_Admin extends Stourweb_Controller
{

    public function before()
    {
        parent::before();

    }

    //后台控制抢答
    public function action_board()
    {
        $this->display('race/board');
    }

    //新的抢答
    public function action_ajax_new_qd()
    {
        $qd_info = array(
            'StartTime'=>microtime(true),
            'Delay'=>intval($_POST['delay']),
            'TimeOut'=>intval($_POST['timeout'])
        );
        file_put_contents(RACEROOT.'data/qdlog.db','');
        file_put_contents(RACEROOT.'data/qdinfo.json',json_encode($qd_info));
        $ret['status'] = 1;
        echo json_encode($ret);

    }

    //抢答结果
    public function action_ajax_result()
    {
        $current_time = microtime(true);
        $ret = array(
            'status'=>0,
            'html'=>''
        );
        $qd_info = json_decode(file_get_contents(RACEROOT.'data/qdinfo.json'),true);
        $end_time = $qd_info['StartTime'] + $qd_info['Delay'] + $qd_info['TimeOut'];
        if ($current_time >= $qd_info['StartTime'] && $current_time <= $end_time)
        {
            $ret['status'] = 1;
        }

        $qd_log = explode("\n",file_get_contents(RACEROOT.'data/qdlog.db'));
        $rank = 0;
        //遍历抢答日志
        foreach ($qd_log as $line)
        {
            $row = explode("\t",$line);
            if (count($row) == 2 && $row[0] >= $qd_info['StartTime'] + $qd_info['Delay'])
            {
                $ret['html'] .= sprintf("No.%d %s %0.3fs<br />",++$rank,htmlspecialchars($row[1]),$row[0] - ($qd_info['StartTime'] + $qd_info['Delay']));
            }
        }
        echo json_encode($ret);
    }


}