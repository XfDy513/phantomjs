<?phpif (!defined('ROOT'))    exit('Can\'t Access !');class aliyunoss_admin extends admin{    function init()    {        if (!front::get('page'))            front::$get['page'] = 1;    }    //测试上传s    function test_action()    {        $aliyunoss=new aliyunoss();        $aliyunoss->ossUpload(ROOT . "/upload/images/201304/1101.jpg", "images/".date("Ymd")."/测试图片.jpg");    }    //测试上传    function setting_action()    {        if (front::post('submit')) {            aliyunosssetting::getInstance()->rec_update(front::$post,"1=1");            front::redirect(url::modify('act/list', true));        }        $aliyunosssettingdata=aliyunosssetting::getInstance()->getrow("");        $this->view->form =aliyunosssetting::getInstance()->get_form();        $this->view->field =aliyunosssetting::getInstance()->getFields();        $this->view->data=$aliyunosssettingdata;    }    //下载    function  dowen_action()    {        $aliyunoss=new aliyunoss();        if(front::get('filename')  != '') {            if (front::get('osswhere') != '') {                front::$get['osswhere']=  str_replace('*', '/', front::$get['osswhere']);                $aliyunoss->ossDoewm(front::$get['osswhere'].front::get('filename'),   "C:/Users/Administrator/Desktop/".front::get('filename'));            }else{                $aliyunoss->ossDoewm(front::get('filename'), "C:/Users/Administrator/Desktop/".front::get('filename'));            }            front::flash(lang_admin('download_completed'));        }        front::redirect(front::$from);    }    //删除    function  delete_action()    {        $aliyunoss=new aliyunoss();        if(front::get('filename')  != ''){            if(front::get('osswhere')  != ''){                front::$get['osswhere']=  str_replace('*', '/', front::$get['osswhere']);                $aliyunoss->ossdelete( front::$get['osswhere'].front::get('filename'));            }else{                $aliyunoss->ossdelete(front::get('filename'));            }        }        front::redirect(front::$from);    }    //删除多个    function drop_action()    {        $aliyunoss=new aliyunoss();        if(front::post('select') != ''){            $filename=array();            foreach (front::post('select') as $name) {                $filename[]=$name;            }            $aliyunoss->ossdrop($filename);        }        front::redirect(front::$from);    }    //读取列表    function  list_action()    {        $aliyunoss=new aliyunoss();        if(front::$get['filewhere'] != ''){        /*    $file=$this->osswherelist(front::get('filewhere').'/',"/","images/测试图片1.jpg", config::getadmin('manage_pagesize'));*/            front::$get['filewhere']=  str_replace('*', '/', front::$get['filewhere']);            $file=$aliyunoss->osswherelist( front::$get['filewhere'].'/',"/",null, 1000);            front::$get['filewhere']=  str_replace('/', '*', front::$get['filewhere']);            $this->view->osswhere=front::$get['filewhere'].'*';        }else{            $file=$aliyunoss->osslist();        }        $file=$this->getpagedata($file,front::$get['page']);        $this->view->filedata=$file;    }    //分页    function getpagedata($data,$page){        $num=count($data['Foldername']);        $newFoldername=array();        //先取文件夹        if($page==1){            $begin=1;      //开始下标            $endnum=config::getadmin('manage_pagesize');  //结束下标            if(count($data['Foldername']) >= $begin){                $i=0;                foreach ($data['Foldername'] as $Foldername){                    if($begin>$endnum){                        continue;                    }                    if(($i+1)>=$begin){                        $newFoldername[]=$Foldername;                        $begin=$begin+1;                    }                    $i=$i+1;                }            }        }        else{            $begin=($page-1)*config::getadmin('manage_pagesize');            $endnum=$page*config::getadmin('manage_pagesize');            if(count($data['Foldername']) > $begin){                $i=0;                foreach ($data['Foldername'] as $Foldername){                    if($begin>=$endnum){                        continue;                    }                    if(($i+1)>$begin){                        $newFoldername[]=$Foldername;                        $begin=$begin+1;                    }                    $i=$i+1;                }            }        }        //然后取文件        $newfilename=array();        if($begin<=$endnum){            $j=0;            if($num>0){                foreach ($data['filename'] as $filename){                    if(($page-1)==0){                        $endpage=2;                    }else{                        $endpage=$page-1;                    }                    if($j>=(($page-1)*config::getadmin('manage_pagesize')-$num)                    && $j<($endpage*config::getadmin('manage_pagesize')-$num)+2) {                        $newfilename[] = $filename;                        $begin=$begin+1;                    }                    $j++;                }        }else{                $j=0;                if($begin==1){                    $begin=$begin-1;                }                foreach ($data['filename'] as $filename){                    if(($j+1)>$begin && ($j+1)<=$endnum) {                        $newfilename[] = $filename;                        $begin=$begin+1;                    }                    $j++;                }            }        }        return array("filename"=>$newfilename,"Foldername"=>$newFoldername,"record_count"=>$data['record_count']);    }    function end() {        $this->render();    }}