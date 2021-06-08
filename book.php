
<?php
    $usernameErr = $emailErr ='';
    $mysqli = new mysqli('sql308.epizy.com', 'epiz_27878131', 'dn2jTuIXpp', 'epiz_27878131_termine');
    require 'Validation.php';
    if (isset($_GET['date'])) {
        //$timeslot = $_GET['timeslot'];
        $date = $_GET['date'];
        $bookings=array();
        $query = 'select * from buchung where date=? ';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $date);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows >0){
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row['timeslot'];
            }
            $stmt->close();
        }       
    }
    
    if (isset($_POST['submit'])) {
        $valid = new Validation();
        
        $name = $valid->validateInputs($_POST['name']);
        $email = $valid->emailValidation($_POST['email']);

        if(!$name){
            $usernameErr = "Nur Buchstaben und Ziffern und Leerzeichen erlaubt!";
            exit();
        }
        if(!$email){
            $emailErr = "Nicht richtige Email-Adresse!";
            exit();
        }
        
        $timeslot = $_POST['timeslot'];
        $mysqli = new mysqli ('localhost','root', '', 'termine');
        $query = 'select * from buchung where date=? and timeslot=?';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ss',$timeslot, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows >0){
            $msg = '<div class="alert alert-danger">Es ist schon gebucht</div>';
        } else {
            $query = 'insert into buchung (name, email,timeslot, date) values(?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ssss', $name, $email, $timeslot, $date);
            if ($stmt->execute()) {
                $msg = '<div class="alert alert-success"> Buchung => Erfolgreich gebucht<div>';
                // header('location: index.php');
            }
            $bookings[]=$timeslot;
            $stmt->close();
            $mysqli->close();
        }
        
    }
    $duration = 15;
    $cleanup = 0;
    $start = '9:00';
    $end = '15:00';

    function timeslot($duration, $cleanup, $start, $end) {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('PT' . $duration . 'M');
        $cleanupInterval = new DateInterval('PT' . $duration . 'M');

        for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
            $endPeriod = clone $intStart;
            $endPeriod->add($interval);
            if ($endPeriod > $end) {
                break;
            }
            $slots[] = $intStart->format('H:iA') . '-' . $endPeriod->format('H:iA');
        }
        return $slots;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Termin Vereinbaren</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <link rel="stylesheet" href="css/style.css">


    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <h5 class="text-center"> Buchung für Datum : <?= date('d/m/Y', strtotime($date)); ?></h5>
                    <h5 class="text-center"> Wählen Sie unten einen Zeitraum aus!</h5>
                </div>
                <div class="col-md-8">
                    <h6 class="text-center"> <?= isset($msg) ? $msg : ''; ?></h6>
                </div>

                <div class="timeSlot">
                    <?php
                    $timeSlot = timeslot($duration, $cleanup, $start, $end);
                    foreach ($timeSlot as $ts) { ?>
                       
                        <div class="col-md-2">
                            <div class="form-group timeSlot">
                                <?php if(in_array($ts, $bookings)){ ?>
                                    <button  name="submit" class="btn  btn-danger" ><?= $ts ?></button>
                                <?php }else {?>
                                    <button name="submit" class="btn  btn-primary book" data-timeslot="<?= $ts ?>"><?= $ts ?></button>
                                <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <a href="index.html">Start-Seite</a>

                <!-- Modal Form to book a date-->
                
                <div class="modal fade" id="buchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Termin bestätigen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4></h4>            
                                <input id="idd" name="idd" type="hidden" value="" >   
                                <div class="col-md-12" >

                                    <form class="form" method="POST">

                                        <div class="form-group" autocomplete="off">
                                            <label for="timeslot">Zeit-Raum</label>
                                            <input type="text" id="timeslot" name="timeslot" class="form-control" readonly>
                                        </div>

                                        <div class="form-group" autocomplete="off">
                                            <label for="name">Ihr Name</label>
                                            <input type="text"  name="name" class="form-control" placeholder="Name" required>
                                             <span class="error"> <?= $usernameErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Ihre E-mail</label>
                                            <input type="email"   name="email" class="form-control" placeholder="E-mail address" required autofocus>
                                             <span class="error"> <?= $emailErr; ?></span>
                                        </div>

                                        <div class="form-group pull-right">
                                            <button type="submit" name="submit" class="btn  btn-primary  text-uppercase" >Buchen </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" ></script>       
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" ></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    

        <script>
            $('.book').click(function () {
                var timeslot = $(this).attr('data-timeslot');
                $('#slot').html(timeslot);
                $('#timeslot').val(timeslot);
                $('#buchModal').modal('show');
               
            });
        </script>

    </body>
</html>
