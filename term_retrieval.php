<?php

    require_once('connection.php');
    $terms_get = "SELECT * FROM term";
    $exec = mysqli_query($dbb, $terms_get);
    if($exec)
    {
        $rows_terms = mysqli_num_rows($exec);
        $term_array = array();
        for($i = 0; $i < $rows_terms; $i++)
        {
            $termdetails = mysqli_fetch_array($exec);
            $t_id = $termdetails['termid'];
            $t_name = $termdetails['termname'];
            $collect = $t_id.":".$t_name;
            array_push($term_array,$collect);
        }
        echo implode('~',$term_array);
    }
?>