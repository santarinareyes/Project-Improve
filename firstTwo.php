<pre>
<?php
        
        // for ($i = 0; $i < count($_POST['jag_är']); $i++) {
        //     print_r ($_POST['jag_är'][$i] . "\n");
        // }

        // foreach ($_POST['jag_är'] as $value) {
        //     echo "$value \n";
        
        // }

    // print_r ($_POST);
    
    if ($_GET['a'] == 'submit') {
        echo "Jag heter " . $_POST['namn'] . ".\n";
        echo "Jag vill bara säga " . $_POST['meddelande'] . ".\n";
        echo "Min favoritfärg är " . $_POST['color'] . " och min favoritbil är en " . $_POST['fav_bil'] . ".\n";
    }

    // for ($i = 0; $i < count($_POST['jag_är']); $i++) {
    //     if($i <= 0) {
    //         echo "Jag är bara " . ($_POST['jag_är'][$i]);
    //     } else if ($i > 0 ) { echo "MÅNGA " . ($_POST['jag_är'][$i] . "\n");
    //     }
    // }

    if ($_GET['a'] == 'submit') {
        $jagar = $_POST['jag_är'];
        for($i = 0; $i < count($jagar); $i++) {
            if (count($jagar) >= 2) {
                echo "Jag är både " . $jagar[$i] . " och ";
                array_shift($jagar);
            } else {
                echo "Jag är bara " . $jagar[$i];
                break;
            }
            for ($i = 0; $i < count($jagar); $i++) { 
                         echo $jagar[$i] . ".";
            }

        }
        // var_dump($jagar);
    }

    

    // echo $_POST['namn'];
    
    ?>

    </pre>