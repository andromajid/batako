<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rewardqualification
 *
 * @author arkananta
 */
class RewardqualificationCommand extends CConsoleCommand {
    //put your code here
    public function run($args) {
        Yii::import('application.helper.dbHelper');
        $this->getQualifiedMember();
    }
    /**
     * Method buat nyari member yang qualified
     */
    private function getQualifiedMember() {
        //ambil data reward dolo
        $reward = Yii::app()->db->createCommand()->from('mlm_reward')->where('reward_is_active=:is_active', array(':is_active' => '1'))->queryAll();
        if(is_array($reward)) {
            foreach ($reward as $row_reward) {
                //cek satu2 member yang qualified
                $reward_member = Yii::app()->db->createCommand()->from('mlm_network')->where('network_node_left >= :node_left AND network_node_right >= :node_right',
                                                                            array(':node_left' => $row_reward['reward_cond_node_left'],
                                                                                  ':node_right' => $row_reward['reward_cond_node_right']))
                                                                            ->queryAll();
                if(is_array($reward_member)) {
                    foreach($reward_member as $row_member) {
                        //cek dolo apakah sudah pernah masuk ke reward log atau belum
                        $member = dbHelper::getOne('reward_log_id', 'mlm_reward_log', 'reward_log_network_id = '.$row_member['network_id'].' AND
                                                    reward_log_reward_id = '.$row_reward['reward_id']);
                        if(!$member) {
                            //masukkan ke database
                            $data_insert = array('reward_log_network_id' => $row_member['network_id'],
                                                 'reward_log_reward_id' => $row_reward['reward_id'],
                                                'reward_log_reward_bonus' => $row_reward['reward_bonus'],
                                                'reward_log_use_datetime' => date("Y-m-d H:i:s"));
                            Yii::app()->db->createCommand()->insert('mlm_reward_log', $data_insert);
                        }
                    }
                }
            }
        }
    }
}

?>
