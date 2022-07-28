<?php

class Company{

    public function compName($con){
        $q = mysqli_query($con, "SELECT branch_name FROM branch LIMIT 1 ");
        $r = mysqli_fetch_array($q);
        $comp_name = $r['branch_name'];

        return $comp_name;
    }

    public function tPin($con){
        $q = mysqli_query($con, "SELECT tpin FROM branch LIMIT 1 ");
        $r = mysqli_fetch_array($q);
        $tpin = $r['tpin'];

        return $tpin;
    }

    public function address($con){
        $q = mysqli_query($con, "SELECT branch_address FROM branch LIMIT 1 ");
        $r = mysqli_fetch_array($q);
        $branch_address = $r['branch_address'];

        return $branch_address;
    }

    public function contact($con){
        $q = mysqli_query($con, "SELECT branch_contact FROM branch LIMIT 1 ");
        $r = mysqli_fetch_array($q);
        $branch_contact = $r['branch_contact'];

        return $branch_contact;
    }

    public function logo($con){
        $q = mysqli_query($con, "SELECT logo FROM branch LIMIT 1 ");
        $r = mysqli_fetch_array($q);
        $logo = $r['logo'];

        return $logo;
    }


}