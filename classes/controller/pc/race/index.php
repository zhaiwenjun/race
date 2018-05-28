<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pc_Race_Index extends Stourweb_Controller
{

    public function before()
    {
        parent::before();

    }

    //二维码页面
    public function action_qr()
    {
        $url = $GLOBALS['cfg_basehost'].'/phone/race/';
        $this->assign('url',$url);
        $this->display('race/qr');
    }

    //抢答页面
    public function action_index()
    {
        $this->display('race/index');
    }

    //点击抢答
    public function action_ajax_race()
    {
        $current_time = microtime(true);

        $ret = array(
            'status'=>0,
            'msg'=>''
        );
        $name_exists = false;
        $qd_logs = explode("\n",file_get_contents(RACEROOT.'data/qdlog.db'));
        //遍历抢答日志
        foreach ($qd_logs as $line)
        {
            $row = explode("\t",$line);
            if (count($row) == 2 && $row[1] == $_POST['name'])
            {
                $name_exists = true;
                break;
            }
        }
        //如果没有进行过抢答
        if(!$name_exists)
        {
            $qd_info = json_decode(file_get_contents(RACEROOT.'data/qdinfo.json'),true);
            if ($current_time <= $qd_info['StartTime'] + $qd_info['Delay'] + $qd_info['TimeOut'])
            {
                if ($current_time <= $qd_info['StartTime'] + $qd_info['Delay'])
                {
                    $ret['msg'] = '提前抢答，本次弃权！';
                }
                else
                {
                    $ret['status'] = 1;
                }


                //提前抢答也要写入log
                $file = fopen(RACEROOT.'data/qdlog.db','a+');
                $content = $current_time . "\t" . $_POST['name'] . "\n";
                fwrite($file,$content);
                fclose($file);
            }
            else
            {
                $ret['msg'] = '本次抢答已结束';
            }

        }
        else
        {
            $ret['msg'] = '重复抢答';
        }

        echo json_encode($ret);

    }

    //ping 测试
    public function action_ajax_ping()
    {
        echo json_encode(array());
    }


}