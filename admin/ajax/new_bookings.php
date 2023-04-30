<?php

    require('../inc/essentials.php');
    require('../inc/db_config.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {
        $query = "SELECT bo.*, bd.* FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE bo.booking_status = 'booked' AND bo.arrival = 0 ORDER BY bo.booking_id ASC";

        $res = mysqli_query($con, $query);
        $i = 1;
        $table_data = "";
        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-y", strtotime($data['datentime']));
            $checkin = date("d-m-y", strtotime($data['check_in']));
            $checkout = date("d-m-y", strtotime($data['check_out']));

            $table_data = "
                <tr>
                    <td>$i</td>
                    <td>
                        <span class='badge bg-primary'>
                            Order Id: $data[order_id]
                        </span>
                        <br/>
                        <b>Name:</b> $data[user_name]
                        <br/>
                        <b>Phone No:</b> $data[phonenum]
                        <br/>
                    </td>
                    <td>
                        <b>Room:</b> $data[room_name]
                        <br/>
                        <b>Price:</b> रु $data[price]
                        <br/>
                    </td>
                    <td>
                        <b>Check In:</b> $checkin
                        <br/>
                        <b>Check Out:</b> $checkout
                        <br/>
                        <b>Paid:</b> $data[trans_amt]
                        <br/>
                        <b>Date:</b> $date
                        <br/>
                    </td>
                    <td>
                    </td>
                </tr>
                ";
            $i++;
        }
        echo $table_data;
    }
    if(isset($_POST['remove_user']))
    {
        $frm_data = filteration($_POST);

        $res = delete("DELETE FROM `user_cred` WHERE `id`=? AND `is_verified`=?",[$frm_data['user_id'],0],'ii');

        if($res){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['search_user']))
    {
        $frm_data = filteration($_POST);
        // print_r($frm_data);

        $query = "SELECT * FROM `user_cred` WHERE `fname` LIKE ?";
        // echo $query;

        $res = select($query,["%$frm_data[fname]%"],'s');

        $i = 1;
        $path = USERS_IMG_PATH;

        $data = "";
        while($row = mysqli_fetch_assoc($res))
        {
            $del_btn = "
                <button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash'></i>
                </button>";
            $verified = "<span class='badge text-bg-warning'><i class='bi bi-x-lg'></i></span>";

            if($row['is_verified']){
                $verified = "<span class='badge text-bg-success'><i class='bi bi-check-lg'></i></span>";
                $del_btn="";
            }

            $status="
            <button onclick='toggle_status($row[id],0)' class='btn btn-success btn-sm shadow-none'>
                active
            </button>";
            if(!$row['status']){
                $status="<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>
                    inactive
                </button>";
            }

            $date = date("d-m-Y : H:m:s",strtotime($row['datentime']));
            $data.="
                <tr>
                    <td>$i</td>
                    <td>
                        <img src='$path$row[profile]' width='55px'>
                        $row[fname]
                    </td>
                    <td>$row[lname]</td>
                    <td>$row[gender]</td>

                    <td>$row[email]</td>
                    <td>$row[phonenum]</td>
                    <td>$row[city]</td>
                    <td>$row[country]</td>
                    <td>$row[pincode]</td>
                    <td>$row[dob]</td>

                    <td>$verified</td>
                    <td>$status</td>
                    <td>$date</td>
                    <td>$del_btn</td>
                </tr>
            ";
            $i++;
        }
        echo $data;
    }

?>