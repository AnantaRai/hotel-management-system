<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/common.css" />
    <!-- Links -->
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - BOOKINGS</title>
</head>

<body>

    <!-- Header -->
    <?php require('inc/header.php');
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }
    ?>

    <!-- Filter -->
    <div class="container">
        <div class="row">
            <!-- Main Heading -->
            <div class="col-12 my-5 mb-5 px-4">
                <h2 class="fw-bold">BOOKINGS</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
                </div>
            </div>
        </div>
    </div>
    <?php

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE ((bo.booking_status = 'booked') OR (bo.booking_status = 'cancelled') OR (bo.booking_status = 'payment failed')) AND (bo.user_id=?) ORDER BY bo.booking_id DESC";

        $result = select($query, [$_SESSION['uId']], 'i');

        while($data = mysqli_fetch_assoc($result))
        {
            $date = date("d-m-y", strtotime($data['datentime']));
            $checkin = date("d-m-y", strtotime($data['check_in']));
            $checkout = date("d-m-y", strtotime($data['check_out']));

            $status_bg = "";
            $btn = "";

            if($data['booking_status'] == "booked") {
                $status_bg = "bg-success";
                if($data['arrival'] == 1)
                {
                    $btn =  "<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a> <button type='button' class='btn btn-dark btn-sm shadow-none'>Rate & Review</button>";
                }else {
                    $btn = "<button type='button' class='btn btn-danger btn-sm shadow-none'>Cancel</button>";
                }
            }else if($data['booking_status'] == "cancelled") {
                $status_bg = "bg-danger";
                if($data['refund'] == 0) {
                    $btn = "<span class='badge bg-primary'>Refund in process!</span>";
                }else {
                    $btn =  "<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
                }
            }else {
                $status_bg = "bg-warning";
                $btn =  "<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
            }

            echo<<<bookings
                <div class='col-md-4 px-4 mb-4'>
                    <div class='bg-white p-3 rounded shadow-sm'>
                        <h5 class='fw-bold'>$data[room_name]</h5>
                        <p>रु$data[price] per night</p>
                        <p>
                            <b>Check In:</b> $checkin
                            <br/>
                            <b>Check Out:</b>  $checkout
                            <br/>
                        </p>
                        <p>
                            <b>Amount:</b> रु$data[price]
                            <br/>
                            <b>Check Out:</b>  $date
                            <br/>
                        </p>
                        <p>
                            <span class='badge $status_bg'>$data[booking_status]</span>
                        </p>
                        $btn
                    </div>
                </div>
                bookings;
        }
    ?>
    <!-- Footer -->
    <?php require('inc/footer.php'); ?>

</body>

</html>