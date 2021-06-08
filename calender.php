<?php
function Build_Calender($month, $year) {

    //$dayOfWeek = array( 'Monday', 'Teusday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $dayOfWeek = array( 'Montag', 'Dienstag', 'Mitwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag');
    // getting the first day of the month given in this function
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    
    //getting the number of days this month contains
    $numberDays = date('t', $firstDayOfMonth);
    
    //getting some information about first day as Array
    $dateComponents = getdate($firstDayOfMonth);

    //the name of this month
    $monthName = $dateComponents['month'];
    
    // getting the index value 0-6 of the first day of this month
    $dayIndexOfWeek = $dateComponents['wday'];
    if($dayIndexOfWeek == 0){
        $dayIndexOfWeek = 6;
    }else{
        $dayIndexOfWeek= $dayIndexOfWeek-1;
    }
    
    //creating HTML table
    $calender = "<table class='table table-bordered'>";
    $calender .= "<center><h2> $monthName $year</h></center><br>";
    
    $nextMonth= date('m',mktime(0,0,0,$month+1,1,$year));
    $nextYear = date('y',mktime(0,0,0,$month+1,1,$year));
    $currentYear = date('y',mktime(0,0,0,$month,1,$year));
    $preMonth = date('m',mktime(0,0,0,$month-1,1,$year));
    $preYear =  date('y',mktime(0,0,0,$month-1,1,$year));
    
    $calender .= '<center>';
        $calender .= '<a  class="topBtn btn btn-primary" href="?month='.$preMonth.'&year='.$preYear.'"><< Vorheriger Monat</a>';
        $calender .= '<a  class="topBtn btn btn-primary" href="?month='.date('m').'&year='.$currentYear.'">Aktueller Monat</a>';
        $calender .= '<a  class="topBtn btn btn-primary" href="?month='.$nextMonth.'&year='.$nextYear.'">Nächst Monat >></a>';
    $calender .= '</center>';
    
    $calender .= "<tr>";

    foreach($dayOfWeek as $day){
        $calender .= "<th class='header'>$day</th>";
    }

    $calender .= "</tr><tr>";
    // to be sure that there are just 7 columns on our table
    if ($dayIndexOfWeek > 0) {
        for ($i = 0; $i < $dayIndexOfWeek; $i++) {
            $calender .= "<td></td>";
        }
    }

    $currentDay = 1;
 
    while ($currentDay <= $numberDays) {
        //if the seventh column(sammstag) reached, start a new row
        if ($dayIndexOfWeek == 7) {
            $dayIndexOfWeek = 0;
            $calender .= "</tr><tr>";
        }
        //getting the number of current Day 
        $currenterDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currenterDayRel";
        $currentDate = date('y-m-d');
        $dayName = strtolower(date('l',strtotime($date)));
                
        if($dayName == 'saturday'|| $dayName == 'sunday'){
            $calender .= "<td ><h4>$currentDay</h4><button class ='btn btn-danger'>Wochenende</button>";
        }elseif (strtotime($date)< strtotime($currentDate)) {
            $calender .= "<td ><h4>$currentDay</h4><button class ='btn btn-danger'>N/A</button>";
        }  else {  
            $allbookedSlots = checkSlots($date);
            if ($allbookedSlots === 12){
                $calender .= "<td ><h4>$currentDay</h4><a href='#' class ='btn btn-danger'>Alle gebucht</a>";
            }else{
                $availableslots = 12 - $allbookedSlots;
                $calender .= "<td ><h4>$currentDay</h4>"
                        . "<a href='book.php?date=".$date."' class ='btn btn-success'>Buchen</a><small><i>  Av: $availableslots</i></small>";   
            }
        }
        
        //increasing the counters
        $currentDay++;
        $dayIndexOfWeek++;
    }
    //comleting the row of the last week in month, if necessary
    if ($dayIndexOfWeek != 7) {
        $remainingDays = 7 - $dayIndexOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calender .= "<td></td>";
        }
    }
    $calender .= "</tr>";
    $calender .= "</table>";
    echo $calender;
}

function checkSlots($dat){
    
        $mysqli = new mysqli ('sql308.epizy.com', 'epiz_27878131', 'dn2jTuIXpp', 'epiz_27878131_termine');
        $query = 'select * from buchung where date=? ';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $dat);
        $stmt->execute();
        $result = $stmt->get_result();
        $totalbookings =0;
        if($result->num_rows >0){
            while ($row = $result->fetch_assoc()) {
                $totalbookings++;
            }
            $stmt->close();
        }
    
      return $totalbookings;
}

