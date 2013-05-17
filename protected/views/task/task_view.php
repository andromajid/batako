<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table class="table table-bordered card-detail">
    <tr>
        <td>Nama Task</td>
        <td><?php echo $task['task_title'];?></td>
    </tr>
     <tr>
        <td>Deskripsi Task</td>
        <td><?php echo $task['task_description'];?></td>
    </tr>
    <tr>
        <td>Point Task</td>
        <td><?php echo $task['task_point'];?></td>
    </tr>
</table>