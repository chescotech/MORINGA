<?php

class InvObjects {

    function __construct() {
        
    }

    function getShopCategoryById($con, $id) {
        $query = mysqli_query($con, "SELECT * FROM shop_category_tb WHERE id = '$id'");
        $row = mysqli_fetch_array($query);
        $shopCat = $row['name'];
        return $shopCat;
    }

    function getUserDetailsById($con, $userId) {
        $query = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$userId'");
        $row = mysqli_fetch_array($query);
        $userDetails = $row['name'];
        return $userDetails;
    }

    function getCategoryById($con, $catId){
        $query = mysqli_query($con, "SELECT * FROM category WHERE cat_id = '$catId'");
        $row = mysqli_fetch_array($query);
        $categoryDetails = $row['cat_name'];
        return $categoryDetails;
    }

}
