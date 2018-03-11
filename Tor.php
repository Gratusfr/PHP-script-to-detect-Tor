<?php

        //Create a session
        session_start ();


if(isset($_GET["display"])){
    if ($_GET["display"] == "full"){
        // To display all IP
        $full = true ;
    }else if($_GET["display"] == "myIP"){
        // To test the current IP only
        $myIP = true ;
    }
}else{
    $full = false;
    $myIP = false;
}

if(!isset($_SESSION["Tor"]) || $full || $myIP ){
        // We search only one time or when it's requested by the GET for performance.
        // We will consult the script https://check.torproject.org/cgi-bin/TorBulkExitList.py
        // and check if the user IP is on this list.
        $ch = curl_init();
        $ipServeur = $_SERVER['SERVER_ADDR'];
        $ipUser = $_SERVER['REMOTE_ADDR'];
    
        //Check if it's HTTP or HTTPS connexion.
        if($_SERVER['HTTPS'] == ""){
            $portServeur = 80 ; // HTTP : 80
        }else{
            $portServeur = 443 ; // HTTPS : 443
        }

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://check.torproject.org/cgi-bin/TorBulkExitList.py?ip=" . $ipServeur . "&port=" . $portServeur);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        //print()
        if(strlen($output) != 0){
            if($full){
                print(htmlentities($output)) ;
            }
            if(strpos($output, $ipUser)){
                //The user is on the list
                if($myIP){
                    print("My IP (" . $ipUser . ") is Tor Exit Node.");
                }
                $_SESSION["Tor"] = true ;
                
            }else{
                //The user is not on the list
                if($myIP){
                print("My IP (" . $ipUser . ") is NOT Tor Exit Node.");
                }
                $_SESSION["Tor"] = false ;
            }
        }else{
            trigger_error("No data can be loaded (empty variable). Maybe <a href='https://check.torproject.org/cgi-bin/TorBulkExitList.py'>https://check.torproject.org/cgi-bin/TorBulkExitList.py</a> is down.", E_USER_WARNING);
        }
        

        // close curl resource to free up system resources
        curl_close($ch); 
    }

    // After the test...
    if($_SESSION["Tor"]){
        // Your code - Tor
    }else{
        // Your code - Without Tor
    }
?>
