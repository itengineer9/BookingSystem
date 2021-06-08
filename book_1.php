
<?php 
    if(isset($_GET['date'])){
        $date = $_GET['date'];
    }
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        echo '$name : '.$name;
        $mysqli = new mysqli ('localhost','root', '', 'termine');
        $query = 'insert into buchung (name, email, date) values(?,?,?)';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sss', $name, $email, $date);
        if($stmt->execute()){
            $msg = '<div class="alert alert-success"> Booking Successful</div>';
            header('location: index.php');
        }
        
        $stmt->close();
        $mysqli->close();
    }
    $duration =10;
    $cleanup=0;
    $start='9:00';
    $end ='15:00';
    
    function timeslot($duration, $cleanup, $start, $end){
        $start = new DateTime($start);
        $end= new DateTime($end);
        $interval = new DateInterval('PT'.$duration. 'M');
        $cleanupInterval = new DateInterval('PT'.$duration. 'M');
        $slot = array();
        
        for($intStart = $start; $intStart < $end ; $interval->add($interval)->add($cleanupInterval)){
            $endPeriod = clone $intStart;
            $endPeriod->add($interval);
            if($endPeriod >$end){
                break;
            }
            $slots[]=$intStart->format('H:iA').'-'.$endPeriod->format('H:iA');
        }
        return $slots;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Termin Vereinbaren</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            .card{
                width: 30rem; 
                margin-top: 3rem;
                margin-left: 3rem;
            }
            input{
                margin: 1rem;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row">
        <div class="card" >
          <h5 class="text-center"> Book for Date : <?= date('d/m/Y', strtotime($date));?></h5>
          <div class="card-body">
            <h3 class="card-title text-center">Termin-Buchung</h3>
            <form class="form-signin" method="POST">
                
                <!--h4 class="text-center"> <?php echo isset($msg)? $msg:'Taucht ein Fehler auf'  ;?></h4>-->
                <div class="form-label-group" autocomplete="off">
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                <!-- <span class="error"> <?= $passwordErr;?></span> -->
                </div>
                
              <div class="form-label-group">
                <input type="email" id="email"  name="email" class="form-control" placeholder="Email address" required autofocus>
                <!-- <span class="error"> <?= $emailErr;?></span> -->
              </div>
          

              <div class="custom-control custom-checkbox mb-3">
                 <button name="submit" class="btn  btn-primary  text-uppercase" type="submit">Book Now</button>
              </div>

            </form>
        </div>
      </div>
    </div>
  </div>
        
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js" ></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" ></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    </body>
</html>
