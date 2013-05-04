<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of function_lib
 *
 * @author tejomurti
 */
class function_lib {

    /**
     * jumlah kiri atau kanan
     * @param int $networkId
     * @param string $position
     */
    public static function countNodeMember($networkId,$position)
    {
        $columnNode=($position=='L')?'network_node_left':'network_node_right';
        $total=function_lib::get_one($columnNode,'mlm_network','network_id='.  intval($networkId));
        
        return $total;
    }
    
     public static function getYoutubeVideoId($url)
    {
            $id='';
           $explode=  explode('/', $url);
           for($i=1;$i<=count($explode);$i++)
           {
               if($i==count($explode))
               {
                   $id=$explode[$i-1];
               }
           }
           
           return $id;
    }
    public static function isValidUrl($url)
    {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);

    }
      /**
     * library image moo
     */
     public static function resizeImageMoo($imageName,$directory='product_thumb')
    {
        // error_reporting(-1);
        //config size
         switch(strtolower($directory))
         {
             case 'promo_thumb':
                 $width=80;
                 $height=46;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
             break;
             case 'product_thumb':
                 $width=300;
                 $height=229;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
             break;
             case 'article_thumb':
                 
                 $width=150;
                 $height=86;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
                 
             break;
             case 'news_detail':
                 
                 $width=620;
                 $height=350;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
                 
             break;
             case 'news_category_detail':
                 
                 $width=253;
                 $height=160;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
                 
             break;
             case 'slider':
                 
                 $width=620;
                 $height=400;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
                 
             break;
             case 'side_banner':
                 
                 $width=310;
                 $height=258;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
                 
             break;
             case 'bottom_banner':
                 
                 $width=300;
                 $height=112;
                 $directorySave=YiiBase::getPathOfAlias('webroot.').'/images_cache/'.$directory.'/';
                 
             break;
         
             default:
             die('missing configuration');
             break;
         }
        
        if(!file_exists($directorySave) AND $directory!='')
        {
            mkdir($directorySave);
            chmod($directorySave, 0777);
        }
//        echo $directorySave;
//        exit;
         
        $expl=  explode('/', $imageName);
        $jml=count($expl);
        $saveName=$expl[$jml-1]; 
       
        $folder=YiiBase::getPathOfAlias('webroot.').$imageName;
        $folder_un=YiiBase::getPathOfAlias('webroot.').'/images/unavailable.jpg';
        $imgMoo=new Image_moo;
      //  echo $directorySave.$saveName;
        //exit;
        if(!file_exists($directorySave.$saveName) OR trim($imageName)=='')
        {

            if(file_exists($folder) AND trim($imageName)!='')
            {
                $thumb=$imgMoo->load($folder)
                        ->set_background_colour('#fff')
                        ->resize($width, $height,true)
                        ->save($directorySave.$saveName,true);

                $imageSrc=Yii::app()->baseUrl.'/images_cache/'.$directory.'/'.$saveName;
            }
            else
            {
                $thumb=$imgMoo->load($folder_un)
                        ->set_background_colour('#fff')
                        ->resize($width, $height,true)
                        ->save($directorySave.'unavailable.jpg',true);
               
                $imageSrc=Yii::app()->baseUrl.'/images_cache/'.$directory.'/'.'unavailable.jpg';

            }
        }
        else
        {
             $imageSrc=Yii::app()->baseUrl.'/images_cache/'.$directory.'/'.$saveName;
        }
      
       
        return $imageSrc;
    }  
      /**
     * make description an article
     */
    public static function build_description($content,$max_length='150')
    {
        
        $pure_content=  strip_tags($content);
        $results=(strlen($pure_content)>$max_length)?substr($pure_content, 0,$max_length):$pure_content;
        return $results;
    }
    
    /**
     * make keywords an article
     */
    public static function build_keywords($content)
    {
            $results='';
        
        if(trim($content)!='')
        {
            $keywords=  explode(' ', strip_tags($content));
            $jml_data=count($keywords);
            
            if($jml_data)
            {
                $no=1;
                foreach($keywords AS $row)
                {
                    if($no<100)
                    {
                        $results.=($no>1)?', '.$row:$row;
                    }
                    
                    $no++;
                }
            }
        }
        
        return $results;
    }
    
    //put your code here

    public static function seo_name($s)
    {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

        $s = strtolower(str_replace($c, '_', $s)); // Ganti spasi dengan tanda _ dan ubah hurufnya menjadi kecil semua
        return $s;
    }
    
    public static function get_area_name($areaId) {
        return Yii::app()->db->createCommand('SELECT area_name FROM ref_area WHERE area_id=' . intval($areaId))->queryScalar();
    }

    public static function site_config() {
        $row = Yii::app()->db->createCommand("SELECT * FROM site_config")->queryAll();
        if ($row) {
            return $row;
        }
        else
            return $row;
    }

    /**
     * Static Function yang akan menghandle Akses database get_one
     * @static
     * @param string $field Field table
     * @param string $table_name nama table
     * @param string $where wherenya
     */
    public static function get_one($field = "", $table_name = "", $where = "") {
        $row = YII::app()->db->createCommand("SELECT {$field} FROM {$table_name} WHERE {$where} LIMIT 1")->queryRow();
        if ($row) {
            return $row[$field];
        }
        else
            return $row;
    }

    public static function get_new_order_by($table_name, $fieldname, $condition = '') {
        $sql = "SELECT MAX(" . $fieldname . ") FROM " . $table_name;
        if ($condition != '') {
            $sql .= " WHERE " . $condition;
        }
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($result == false) {
            $result = 0;
        }
        $result++;

        return $result;
    }

    //update data with relation
    public static function update_with_relation($table_name, $pk_fieldname, $obj_data, $condition) {

        $arr_data = $obj_data->attributes;
        unset($arr_data[$pk_fieldname]);

        $sql = "UPDATE " . $table_name . " SET ";
        foreach ($arr_data as $attribute => $value) {
            $sql .= $attribute . " = '" . $value . "', ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE " . $condition;
        $result = Yii::app()->db->createCommand($sql)->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fungsi Static Buat Tahu nama bank
     * @static
     * @param int $bank_id
     */
    public static function get_bank_name($bank_id) {
        return self::get_one("bank_name", "ref_bank", "bank_id = '{$bank_id}'");
    }

    /**
     * Fungsi Static Buat Tahu network_id
     * @static
     * @param string $network_mid
     */
    public static function get_network_id($network_mid) {
        return self::get_one("network_id", "mlm_network", "network_mid = '{$network_mid}'");
    }

    //method buat ambil nama
    public static function get_member_name($network_id) {
        return self::get_one("member_name", "mlm_member", "member_network_id = '{$network_id}'");
    }

    //method buat ambil nama alias
    public static function get_member_nickname($network_id) {
        return self::get_one("member_nickname", "mlm_member", "member_network_id = '{$network_id}'");
    }

    /**
     * Method buat ambil data network_mid
     */
    public static function get_network_mid($network_id) {
        return self::get_one("network_mid", "mlm_network", "network_id = '{$network_id}'");
    }

    public static function get_member_name_by_network_mid($network_mid) {
        return self::get_one("member_name", "mlm_member RIGHT JOIN mlm_network ON member_network_id = network_id", "network_mid = '{$network_mid}'");
    }

    public static function get_member_nickname_by_network_mid($network_mid) {
        return self::get_one("member_nickname", "mlm_member RIGHT JOIN mlm_network ON member_network_id = network_id", "network_mid = '{$network_mid}'");
    }

    public static function get_network_sponsor_network_id($network_id) {
        return self::get_one("network_sponsor_network_id", "mlm_network", "network_id = '{$network_id}'");
    }

    public static function get_network_upline_network_id($network_id) {
        return self::get_one("network_upline_network_id", "mlm_network", "network_id = '{$network_id}'");
    }

    public static function get_network_level_status($network_id) {
        return self::get_one("network_level_status", "mlm_network", "network_id = '{$network_id}'");
    }

    /**
     * Method untuk konversi string ke format url
     */
    public static function url_title($str, $separator = 'dash', $lowercase = TRUE) {
        if ($separator == 'dash') {
            $search = '_';
            $replace = '-';
        } else {
            $search = '-';
            $replace = '_';
        }

        $trans = array(
            '&\#\d+?;' => '',
            '&\S+?;' => '',
            '\s+' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }

        return trim(stripslashes($str));
    }

    /**
     * Method untuk menampilkan status Yahoo! Messenger dengan icon customize
     */
    public static function ymstatus($yahooid, $img_ol_path, $img_off_path, $title) {
        $yahoo_url = "http://opi.yahoo.com/online?u={$yahooid}&m=a&t=1";
        if (ini_get('allow_url_fopen')) {
            error_reporting(0);
            $yahoo = file_get_contents($yahoo_url);
        } elseif (function_exists('curl_init')) {
            $ch = curl_init($yahoo_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $yahoo = curl_exec($ch);
            curl_close($ch);
        }

        $yahoo = trim($yahoo);
        if (empty($yahoo))
            $imgsrc = $img_off_path; /* Maybe failed connection. */
        elseif ($yahoo == "01")
            $imgsrc = $img_ol_path;
        elseif ($yahoo == "00")
            $imgsrc = $img_off_path;
        else
            $imgsrc = $img_off_path;

        echo '<a href="ymsgr:sendIM?' . $yahooid . '" title="' . $title . '">';
        echo '<img src="' . $imgsrc . '" alt="' . $title . '" border="0" />';
    }

    /**
     * Method untuk higlight string
     */
    public static function highlight($text, $words, $tag_start, $tag_end) {
        $words = trim($words);
        $arr_words = explode(' ', $words);
        foreach ($arr_words as $word) {
            if (strlen(trim($word)) != 0)
                $text = eregi_replace($word, $tag_start . '\\0' . $tag_end, $text);
        }
        return $text;
    }

    public static function uri_segment($segment) {

        $url = str_replace(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
        $url = ltrim($url, '/'); //hilangkan tanda "/" pada awal $url
        $arr_uri_segment = explode('/', $url);
        $segment--;
        if (isset($arr_uri_segment[$segment])) {
            return $arr_uri_segment[$segment];
        } else {
            return false;
        }
    }

// ------------------------------------------------------------- GET LEVEL DEPTH
    public static function get_level_depth($network_id, $sponsor_id) {

        $level = 0;
        if ($network_id != $sponsor_id) {
            do {
                $network_id = self::get_one("network_sponsor_network_id", "mlm_network", "network_id = '{$network_id}'");
                //$network_id = $db->GetOne("SELECT network_sponsor_network_id FROM mlm_network WHERE network_id = '" . $network_id . "'");
                $level++;
            } while ($network_id != $sponsor_id && $network_id != 0);
        }
        return $level;
    }

// --------------------------------------------------- GENERATE GENEOLOGY BINARY
    public static function generate_geneology_binary($top_id, $level_depth) {

        $data=array();
        $data_max = 0;
        for ($i = 0; $i <= $level_depth; $i++) {
            $data_max = $data_max + (pow(2, $i));
        }

        $upline = 0;
       
        
        for ($x = 1; $x <= $data_max; $x++) {
            if ($x % 2 == 0) {
                $position = 'L';
                $position_text = 'kiri';
                $downline_node_id = 'network_left_node_network_id';
                $upline++;
            } else {
                $position = 'R';
                $position_text = 'kanan';
                $downline_node_id = 'network_right_node_network_id';
            }
            
            if ($x == 1) {
                $network_id = $top_id;
            } elseif ($data[$upline]['member_mid'] == '') {
                $network_id = '';
            } else {
                $network_id = isset($data[$upline][$downline_node_id])?$data[$upline][$downline_node_id]:0;
            }
            
            
            if (trim($network_id) == '') {
                $data[$x] = '';
                $data[$x]['member_mid'] = '';
                $data[$x]['member_info'] = 'KOSONG';
                $data[$x]['member_node'] = '';
                $data[$x]['network_mid'] = '';
            } else {
                
                
                $sql = "SELECT * FROM mlm_network, mlm_member WHERE network_id = member_network_id AND network_id = '" . $network_id . "'";
                $row = Yii::app()->db->createCommand($sql)->queryRow();

//                if($x==3)
//                {
//                    echo '<pre>';
//                    print_r($row);
//                    exit;
//                }
                if (!empty($row)) {
                    $data[$x] = $row;

//                    if ($row['network_level_status'] == 'passive') {
//                        $data[$x]['member_mid'] = '<a href="' . Yii::app()->baseUrl . '/member/binary/geneology/' . $data[$x]['network_mid'] . '">' . $data[$x]['network_mid'] . '</a>';
//                        $data[$x]['member_node'] = '';
//                        $data[$x]['member_info'] = 'BELUM<br />AKTIF';
//                    } else {
                        if(is_file(YiiBase::getPathOfAlias('webroot') . '/files/images/member/'.$row['member_image'])) {
                            $data[$x]['member_image'] = CHtml::image(Yii::app()->baseUrl . "/files/images/member/" . $row['member_image']);
                        } else {
                            $data[$x]['member_image'] = '';
                        }
                        $data[$x]['network_mid'] = $data[$x]['network_mid'];
                        $data[$x]['member_mid'] = '<a href="' . Yii::app()->baseUrl . '/member/geneology/view_network/' . $data[$x]['network_mid'] . '">' . $data[$x]['network_mid'] . '</a>';
                        $data[$x]['member_info'] = str_replace(' ', '<br />', self::get_member_name($data[$x]['network_id']));
                        //$data[$x]['member_node'] = $data[$x]['network_total_node_left'] . ' | ' . $data[$x]['network_total_node_right'];
                        $data[$x]['member_node'] = $data[$x]['network_node_left'] . ' | ' . $data[$x]['network_node_right'];
//                        $data[$x]['member_node'] .= '<br /><br />D: ' . $data[$x]['network_node_distributor_left'] . ' | ' . $data[$x]['network_node_distributor_right'];
//                        $data[$x]['member_node'] .= '<br />W: ' . $data[$x]['network_node_warehouse_left'] . ' | ' . $data[$x]['network_node_warehouse_right'];
//                        $data[$x]['member_node'] .= '<br />F: ' . $data[$x]['network_node_factory_left'] . ' | ' . $data[$x]['network_node_factory_right'];
                    //}
                } 
                else 
                {
                    
                    $uplineData=isset($data[$upline]['network_mid'])?$data[$upline]['network_mid']:0;
                    
                    $data[$x] = '';
                    $data[$x]['member_mid'] = '';
                    $data[$x]['member_node'] = '';
                    $data[$x]['member_info'] = '';
                    $data[$x]['network_mid'] = '';
                    $data[$x]['member_info'] .= '<a href="' . Yii::app()->baseUrl . '/member/join/clone/sponsormid/' . self::get_network_mid($_SESSION['member']['network_id']) . '/uplinemid/' . $uplineData . '/pos/' . $position_text . '"><b>Kloning</b></a><br>';
                    $data[$x]['member_info'] .= '<a href="' . Yii::app()->baseUrl . '/member/join/new/sponsormid/' . self::get_network_mid($_SESSION['member']['network_id']) . '/uplinemid/' . $uplineData . '/pos/' . $position_text . '"><b>Daftar Baru</b></a><br>';
                 
                    $data[$x]['member_info'] .= '<br />KOSONG';
                }
            }
        }
        return $data;
    }
// --------------------------------------------- GENERATE GENEOLOGY BOARD BINARY
    public static function generate_geneology_board_binary($board_leader_board_network_id, $is_cycle, $level_depth = 15) {

        $data_max = 0;
        for ($i = 0; $i <= $level_depth; $i++) {
            $data_max = $data_max + (pow(2, $i));
        }
        /* wawan
         * 14 dec 2011
         * ngubah rule generate jaringan
         */
        $sql = "SELECT board_leader_board_network_id from mlm_board where board_network_group LIKE '% " . $board_leader_board_network_id . " %' AND board_is_fly = '$is_cycle'";
        $board_leader_board_network_id = Yii::app()->db->createCommand($sql)->queryScalar();


        $sql = "SELECT * FROM mlm_board WHERE board_leader_board_network_id = '" . $board_leader_board_network_id . "'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        if ($result != false) {
            $board_network = explode(" | ", $result['board_network_group']);

            $x = 1;
            foreach ($board_network as $board_network_id) {
                $data[$x]['board_network_id'] = $board_network_id;
                $data[$x]['board_network_mid'] = vo_network::get_board_network_mid($board_network_id);
                $data[$x]['network_id'] = vo_network::get_board_network_network_id($board_network_id);
                $data[$x]['member_name'] = function_lib::get_member_name($data[$x]['network_id']);
                $x++;
            }
            $network_count = count($board_network);
            for ($i = ($network_count + 1); $i <= $data_max; $i++) {
                $data[$i] = array();
                $data[$i]['board_network_id'] = '';
                $data[$i]['board_network_mid'] = '';
                $data[$i]['network_id'] = '';
                $data[$i]['member_name'] = '';
            }
        } else {
            $data = false;
        }

        return $data;
    }

// ---------------------------------------------------------- CUT CHARACTER NAME
    public static function cut_char($string, $char, $line) {
        $result = explode(' ', $string);
        $arr_result = array();
        for ($x = 0; $x < $line; $x++) {
            $arr_result[] = $result[$x];
        }
        $result = implode(' ', $arr_result);

        $result = wordwrap($result, $char, "<br />", true);
        return $result;
    }

    public static function generate_tree_binary($top_id, $depth = 6, $parentId = -1, $level = 0) {
        global $db, $tree_result;

        $level++;

        $sql_upline = "SELECT network_mid, member_name FROM mlm_network, mlm_member WHERE network_id = member_network_id AND network_id = '" . $top_id . "'";
        $rs_upline = $db->Execute($sql_upline);
        $row_upline = $rs_upline->FetchRow();

        if ($parentId == -1) {
            $member_info = "&nbsp;<strong>[" . $row_upline['network_mid'] . "] " . strtoupper($row_upline['member_name']) . "</strong>";
            $tree_result .= "d.add('" . $top_id . "', '" . $parentId . "', '" . $member_info . "', '', '', '_self', '', '');\n";
        }

        $sql_downline = "SELECT network_id, network_mid, network_position, network_upline_network_id, member_name FROM mlm_network, mlm_member WHERE member_network_id = network_id AND network_upline_network_id = '" . $top_id . "' ORDER BY network_id";
        $rs_downline = $db->Execute($sql_downline);

        while ($row_downline = $rs_downline->FetchRow()) {
            $member_info = "&nbsp;(" . $row_downline['network_position'] . ") <b>&middot;</b> " . $row_downline['network_mid'] . " <b>&middot;</b> " . strtoupper($row_downline['member_name']) . "";
            $member_link = "index.php?do=voffice.tree_network&id=" . $row_downline['network_mid'] . "";
            $tree_result .= "d.add('" . $row_downline['network_id'] . "', '" . $top_id . "', '" . $member_info . "', '" . $member_link . "', '', '_self', '', '');\n";
            if ($level <= $depth) {
                generate_tree_binary($row_downline['network_id'], $depth, $top_id, $level);
            }
        }

        return $tree_result;
    }

    public static function convert_month($month, $lang = 'eng') {
        $month = (int) $month;
        switch ($lang) {
            case 'ina':
                $arr_month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
                break;

            default:
                $arr_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                break;
        }
        $month_converted = $arr_month[$month - 1];

        return $month_converted;
    }

    public static function convert_date($date, $type = 'num', $format = '.', $lang = 'eng') {
        if ($type == 'num') {
            $date = substr($date, 0, 10);
            $date_converted = str_replace('-', $format, $date);
        } else {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $month = self::convert_month($month, $lang);
            $day = substr($date, 8, 2);

            $date_converted = $day . ' ' . $month . ' ' . $year;
        }

        return $date_converted;
    }

    public static function convert_datetime($date, $type = 'num', $formatdate = '.', $formattime = ':', $lang = 'eng') {
        if ($type == 'num') {
            $date_converted = str_replace('-', $formatdate, str_replace(':', $formattime, $date));
        } else {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $month = self::convert_month($month, $lang);
            $day = substr($date, 8, 2);
            $time = strlen($date) > 10 ? substr($date, 11, 8) : '';
            $time = str_replace(':', $formattime, $time);

            $date_converted = $day . ' ' . $month . ' ' . $year . ' ' . $time;
        }

        return $date_converted;
    }

    public static function pin_validation($user_id, $pin2validate) {
        //get pin member
        $criteria = new CDbCriteria;
        $criteria->condition = "member_network_id = '" . $user_id . "'";

        $model = mlm_member::model()->with('rel_member_to_serial')->find($criteria);
        $pin_user = $model->rel_member_to_serial->serial_pin;

        //bandingkan
        if ($pin_user == $pin2validate) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_level($sort_order, $y = 1) {
        global $y;

        $x = pow(2, $y);

        if ($x <= $sort_order) {
            $y++;
            self::get_level($sort_order, $y);
        }
        return $y;
    }

    public static function get_peringkat($network_id) {
        $sql = "SELECT leadership_level_log_name FROM mlm_leadership_level_log WHERE leadership_level_log_network_id = '$network_id' ORDER BY leadership_level_log_level DESC limit 1";
        $peringkat = Yii::app()->db->createCommand($sql)->queryScalar();
        return $peringkat;
    }

    /**
     * cek penggunaan serial
     * @param string $serial_id
     * @return array(
     *      'message'=>'String Message',
     *      'status'=>int //valid 1, otherwise false
     * )
     */
    public static function check_serial($serial) {
        $purify = new CHtmlPurifier;
        $model = new mlm_serial;
        $criteria = new CDbCriteria;
        $criteria->addCondition('serial_id="' . $purify->purify($serial) . '"');
        $count = $model->count($criteria);
        $result = array(
            'message' => 'Serial ' . $serial . ' tidak ditemukan',
            'status' => 0,
        );
        if ($count) {
            //dapatkan data
            $row = $model->find($criteria);
            $aktivasi = $row->serial_is_active;
            $digunakan = $row->serial_is_used;

            //jika telah diaktivasi dan belum digunakan
            if ($aktivasi == '1' AND $digunakan == "0") {
                $result = array(
                    'message' => 'Serial ' . $serial . ' telah diaktivasi dan belum digunakan.',
                    'status' => 1,
                );
            }

            //serial tela diaktivasi dan telah digunakan
            elseif ($aktivasi == '1' AND $digunakan == '1') {
                $result = array(
                    'message' => 'Serial ' . $serial . ' telah diaktivasi dan telah digunakan.',
                    'status' => 1,
                );
            } else {
                $result = array(
                    'message' => 'Serial ' . $serial . ' belum diaktivasi.',
                    'status' => 1,
                );
            }
        }

        return $result;
    }

    public static function detailMlmNetwork($networkId) {
        $sql = 'SELECT * FROM mlm_network WHERE mlm_network_id=' . intval($networkId);
        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    public static function get_join_member_network_by_id($id) {
        $result = false;
        $sql = 'SELECT * FROM mlm_member
              LEFT JOIN mlm_network ON network_id=member_network_id
              WHERE network_id=' . intval($id);
        $row = Yii::app()->db->createCommand($sql)->queryRow();
        if (!empty($row)) {
            $result = $row;
        }
    }

    /**
     * Fungsi buat  ngecek kaki kiri atau kanan sudah bisa qualified atau belum
     * @param String $network_mid
     */
    public static function get_qualified_upline1($position, $network_mid) {

        $member = self::detailMlmNetwork(self::get_network_id($network_mid));
        if ($member['network_node_right'] < 2 && $member['network_node_left'] == 0 && $position == 'r') {
            return true;
        } elseif ($member['network_node_right'] == 0 && $member['network_node_left'] < 2 && $position == 'l') {
            return true;
        } elseif ($member['network_node_right'] >= 2 || $member['network_node_left'] >= 2) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_qualified_upline($position, $network_mid) {

        $network_id = self::get_network_id($network_mid);
        $member = self::detailMlmNetwork($network_id);
        $member_left = self::get_qualified_member($network_id, 'l');
        $member_right = self::get_qualified_member($network_id, 'r');
        if ($member_left >= 2 || $member_right >= 2) {
            return TRUE;
        } elseif ($member_right == 0 && $member_left < 2 && $position == 'l') {
            if (($member['network_node_left'] > 0 && $member['network_node_right'] == 0 ) || $member['network_node_left'] == 0 && $member['network_node_right'] == 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } elseif ($member_right < 2 && $member_left == 0 && $position == 'r') {
            if (($member['network_node_left'] == 0 && $member['network_node_right'] > 0 ) || $member['network_node_left'] == 0 && $member['network_node_right'] == 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else
            return FALSE;
    }

    public static function get_qualified_member($network_id, $position) {
        $sql = 'SELECT COUNT(*) FROM mlm_network 
              WHERE sponsor_position="' . $position . '"
                  AND network_sponsor_network_id=' . intval($network_id);
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }

    public static function getSponsoring($networkId) {
        $sql = 'SELECT * FROM mlm_network 
              LEFT JOIN mlm_member ON network_id=member_network_id
              WHERE network_sponsor_network_id=' . intval($networkId);
        $results = Yii::app()->db->createCommand($sql)->queryAll();
        return $results;
    }

    public static function get_netgrow_bonus($network_id, $date_start, $date_end) {

        $sql = "SELECT
                    *
                FROM mlm_netgrow
              
                WHERE netgrow_network_id = '" . $network_id . "' 
                    AND netgrow_date BETWEEN '" . $date_start . "' 
                    AND '" . $date_end . "' 
                ORDER BY netgrow_date ASC";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    //report jaringan
    public static function get_wait_node_bonus($network_id, $position, $today_date) {
        $sql = "SELECT netgrow_bonus_wait_" . $position . " FROM sys_netgrow_bonus WHERE netgrow_bonus_network_id = '" . $network_id . "' AND netgrow_bonus_date < '" . $today_date . "' ORDER BY netgrow_bonus_date DESC LIMIT 1";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    //report jaringan
    public static function get_last_wait_node_bonus($network_id, $position) {
        $sql = "SELECT netgrow_wait_" . $position . " FROM mlm_netgrow WHERE netgrow_network_id = '" . $network_id . "' ORDER BY netgrow_date DESC LIMIT 1";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function path2url($file, $Protocol='http://') {
        return $Protocol . $_SERVER['HTTP_HOST'] . str_replace(array($_SERVER['DOCUMENT_ROOT']), '', $file);
    }

      /* pengecekkan satu jaringan 
      * @return bool false jika tidak ada dijaringan sendiri
      * @author Tejo Murti
      * @date 30 January 2013 12:41 AM
      */ 
      public static function checkGroupNetwork($networkIdSession, $networkIdGeneology)
      {
          $funcLib=new function_lib;
          //jika sedang di geneology sendiri
          if($networkIdSession==$networkIdGeneology)
          {
              return true;
          }
          else
          {
              do{
                $networkIdGeneology=$funcLib->get_one('network_upline_network_id','mlm_network','network_id='.  intval($networkIdGeneology));
                if($networkIdSession==$networkIdGeneology)
                {
                    return true;
                }
              }
              while($networkIdGeneology!=0);
              return false;
          }
         
      }
      
          //report jaringan
    public static function get_wait_node($network_id, $position, $today_date) {
        $sql = "SELECT netgrow_wait_" . $position . " FROM mlm_netgrow WHERE netgrow_network_id = '" . $network_id . "' AND netgrow_date < '" . $today_date . "' ORDER BY netgrow_date DESC LIMIT 1";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }
}

?>
