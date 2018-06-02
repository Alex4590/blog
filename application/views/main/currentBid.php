<?php require_once "application/views/layouts/tableMenu.php"?>
            <tbody>
            <?php foreach ($tableData as $value){
                $output = '<tr id="'.$value['id'].'">';
                $output .= '<td>'.$value['id'].'</td>';
                $output .= '<td>'.$value['logistic_time'].'</td>';
                $output .= '<td class="status_td">'.$value['bid_status'].'</td>';
                $output .= '<td>'.$value['organization'].'</td>';
                $output .= '<td>'.$value['contact_person'].'</td>';
                $output .= '<td>'.$value['trip_date'].'</td>';
                $output .= '<td>'.$value['trip_description'].'</td>';
                $output .= '<td>'.$value['req_power_attorney'].'</td>';
                $output .= '<td>'.$value['address_person_name'].'</td>';
                $output .= '<td>'.$value['load_time'].'</td>';
                $output .= '<td>'.$value['address_person_load'].'</td>';
                $output .= '<td>'.$value['return_address_unload'].'</td>';
                $output .= '<td>'.$value['address_person_unload'].'</td>';
                $output .= '<td>'.$value['bid_creator'].'</td>';
                if(!empty($value['driver'])){
                    $output .= '<td class="driver_td">'.$value['driver'].'</td>';
                }else{
                    $output .= '<td class="driver_td">'.$driveOut.'</td>';
                }
                $output .= '<td id="'.$value['id'].'">'.$statusOut.'
                                        <input form="form_dispatch" type="hidden" value="'.$value['id'].'">
                                        <button form="form_dispatch" class="btn btn-primary accept btntest">Принять</button></td>';
                $output .= '<tr>';
                echo $output;
            }?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script src="public/scripts/table.js"></script>