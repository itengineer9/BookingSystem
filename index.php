
<!DOCTYPE html>
<?php  include 'calender.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Termin Vereinbarung</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2>Termin-Buchung-System</h2>
                <div class="col-md-12">
                    <?php
                        if(isset($_GET['month'])){
                            $month=$_GET['month'];
                            $year=$_GET['year'];
                        }else {
                            $month = date('m');
                            $year = date('y');
                        }     
                        Build_Calender($month, $year);
                    ?>

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
