<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StocknetworkmidCommand
 *
 * @author andro dan santi
 */
class StocknetworkmidCommand extends CConsoleCommand {

    public function run($args) {
        (int) $total = Yii::app()->db->createCommand()->select('COUNT(*)')->from('sys_stock_network_mid')->queryScalar();
        if ($total < 500) {
            $max_id = Yii::app()->db->createCommand("SELECT MAX(stock_network_mid) FROM sys_stock_network_mid")->queryScalar();
            for ($x = 1; $x <= 500; $x++) {
                $max_id = ++$max_id;
                Yii::app()->db->createCommand()->insert('sys_stock_network_mid', array('stock_network_mid' => $max_id));
            }
        }
    }

}
