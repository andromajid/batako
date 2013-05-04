<?php

/**
 * Command buat ngeset member yang mendapatkan bonus reward di itung dari 
 * approval admin
 * @author arkananta
 */
class RewardCommand extends CConsoleCommand {

    /**
     * Melakukan cron untuk ngitung siapa saja yang mendapatkan bonus reward
     * cron dilaksanakan tanggal akhir suatu bulan
     */
    public function run($args) {
        $this_month = $today = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
        $unix_time = strtotime($this_month);
        $month = date('m', $unix_time);
        $year = date("Y", $unix_time);
        //ambil member yang qualified
        $reward_member = $this->getMemberReward($month, $year);
        if (is_array($reward_member)) {
            foreach ($reward_member as $row) {
                //cek member aktif atau enggak
                $cek_is_suspended = dbHelper::getOne('member_is_suspended', 'mlm_member', 'member_network_id=' . $row['reward_log_network_id']);
                if ($cek_is_suspended === '0') {
                    //masukan ke bonus log
                    $reward_log_count = $row['reward_log_count'] + 1;
                    //cek bonus log 
                    $cek = dbHelper::getOne('bonus_log_id', 'mlm_bonus_log', 'bonus_log_network_id = \'' . $row['reward_log_network_id'] . '\' AND bonus_log_date = \'' . $today . '\'');
                    if (!$cek) {
                        $data_insert = array('bonus_log_network_id' => $row['reward_log_network_id'],
                            'bonus_log_date' => $today,
                            'bonus_log_reward' => $row['reward_nominal']);
                        Yii::app()->db->createCommand()->insert('mlm_bonus_log', $data_insert);
                    } else {
                        Yii::app()->db->createCommand('UPDATE mlm_bonus_log SET bonus_log_reward = bonus_log_reward + ' . $row['reward_nominal'] . ' WHERE bonus_log_id = \'' . $cek . '\'')->execute();
                    }
                    //masukkan  ke mlm_bonus
                    Yii::app()->db->createCommand('UPDATE mlm_bonus SET bonus_reward_acc = bonus_reward_acc + ' . $row['reward_nominal'] . ' WHERE 
                                               bonus_network_id = \'' . $row['reward_log_network_id'] . '\'')->execute();
                    //update kek mlm reward_log
                    if ($reward_log_count >= 12) {
                        //update juga reward_log_is_end
                        $data_update_reward_log = array('reward_log_count' => $reward_log_count,
                            'reward_log_is_end' => '1');
                    } else {
                        $data_update_reward_log = array('reward_log_count' => $reward_log_count);
                    }
                    Yii::app()->db->createCommand()->update('mlm_reward_log', $data_update_reward_log, 'reward_log_id=:reward_log_id', array(':reward_log_id' => $row['reward_log_id']));
                }
            }
        }
    }

    /**
     * cari member yang kualifikasi untuk rewardlog dari member 
     * @param String $month bulan dari tahun ini
     * @param String $year
     */
    private function getMemberReward($month, $year) {
        return Yii::app()->db->createCommand()->from('mlm_reward_log')->leftJoin('mlm_reward', 'reward_id = reward_log_reward_id')->where("
                                                                       reward_log_is_approve = :is_approve AND reward_log_count <= :count AND
                                                                       reward_log_is_end = :is_end AND reward_is_active = :is_active", array(
                    'is_approve' => '1', ':count' => 12, ':is_end' => '0', ':is_active' => '1'))->queryAll();
    }

}

?>
