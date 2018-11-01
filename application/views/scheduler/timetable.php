<?php

    $period_times = array('8:45 - 10:45','11:30 - 13:30','14:15 - 16:45');
    /**
     * Converts date formates
     */
    function the_date($dateString){
        $myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
        $newDateString = $myDateTime->format('l, d F Y');
        return $newDateString;
    }

    /**
     * Gets the next day
     * it will skip weekends
     */
    function next_date($now_date,$skip_dates = array()){
        $increment = 1;
        $your_date = strtotime("{$increment} day", strtotime($now_date));
        $new_date_day = date("N", $your_date);

        while($new_date_day == 6 || $new_date_day == 7 || in_array($now_date,$skip_dates) ){
            $your_date = strtotime("{$increment} day", strtotime($now_date));
            $new_date_day = date("N", $your_date);
            $increment++;
        }
        $new_date = date("Y-m-d", $your_date);
        return the_date($new_date);
    }
?>
<section id="content">
    <div class="container">
        <div class="block-header">
            <!-- <h2>EXAMINATION TIMETABLE</h2> -->
        </div>
        <div class="card">
            <div class="card-header">
                <h1 class="ttable-header c-cyan">STRATHMORE UNIVERSITY</h1><br>                
                <p class="ttable-header exam text-uppercase c-teal"><?= $_session['name']?></p>
            </div>

            <div class="card-body card-padding">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr class="c-teal">
                            <th width=1%>DATE</th>
                            <th >TIME</th>
                            <th >EXAMINATION</th>
                            <th >GROUP</th>
                            <th >VENUE</th>
                            <th  width=2%>CHIEF INVIGILATOR</th>
                        </tr>
                    </thead>
                    <tbody class="f-13">
                        <?php $first_day = true; $today; $yester_day;?>
                        <?php foreach($simple_schedule['timetable'] as $d => $day): ?>
                            <tr> <!--  Day-->
                                <?php
                                    if($first_day){
                                        $today = the_date($schedule->dates->start_date); 
                                        $first_day = false;                                        
                                    }else{
                                        $today = next_date($yester_day,$schedule->dates->skip_dates);
                                    }
                                    $yester_day = $today;
                                ?>
                                <td class="c-blue" rowspan="<?= count($day)+1?>"><?= $today; ?></td>

                                <?php foreach($day as $e => $exam): ?>
                                <tr>
                                    <?php if($exam->period === 0): ?>
                                        <td class="c-white">
                                            <?= $period_times[$exam->period]; ?>
                                        </td>
                                    <?php elseif($exam->period === 1): ?>
                                        <td class="c-cyan">
                                            <?= $period_times[$exam->period]; ?>
                                        </td>
                                    <?php elseif($exam->period === 2): ?>
                                        <td class="c-teal">
                                            <?= $period_times[$exam->period]; ?>
                                        </td>
                                    <?php else: ?>
                                        <td class="c-teal">
                                                <?= $period_times[$exam->period]; ?>
                                        </td>
                                    <?php endif;?>
                                    <td>
                                        <?= $exam->code.' : '.$exam->name;?>
                                    </td>
                                    <td> <!--Groups -->
                                        <table>
                                            <?php foreach($exam->groups as $g => $grp): ?>
                                                <tr>
                                                    <td><?= $g.' ='.$grp->size; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </td>                                    
                                    <td> <!-- Rooms -->
                                        <table>
                                            <?php if(is_array($exam->room)): ?>
                                                <?php foreach($exam->room as $rm): ?>
                                                    <tr>
                                                        <td>
                                                            <?= $rm;?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php else: ?>
                                                <tr>
                                                        <td>
                                                            <?= $exam->room;?>
                                                        </td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </td>
                                    <td> <!-- Invigilator -->
                                        <?= $exam->invigilator; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

    