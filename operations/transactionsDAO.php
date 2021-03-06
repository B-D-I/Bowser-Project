<?php
namespace Operations;
include "../include/config.php";

class Transactions{
    /**
     * This function returns the bowser stock of specified capacities
     * @param $capacity = the capacity of bowsers in which stock is required
     * @return mixed
     */
    public static function returnBowsersStock($capacity){
        $connection = OpenConnection();
        // fetch current bowser stock amount
        $sql = "SELECT Stock From `tbl_bowser_stock` WHERE Bowser_Capacity = '$capacity'";
        $result = mysqli_query($connection, $sql);
        $rows = mysqli_fetch_array($result);
        $stock = $rows["Stock"];
        return $stock;
    }
    /**
     * This function returns data relating to stocked bowsers
     * @param $type = the column from which to retrieve data
     * @param $capacity = the capacity of bowser
     * @return mixed|void
     */
    public static function returnStockedBowsers($type, $capacity){
        $connection = OpenConnection();
        $sql1 = "SELECT * FROM `tbl_bowsers` WHERE Bowser_Capacity = '$capacity' AND Status = 'Stock' LIMIT 1";
        $results = mysqli_query($connection, $sql1);
        if ($results->num_rows > 0) {
            while ($rows = $results->fetch_assoc()) {
                $bowserRequest = $rows[$type];
            } return $bowserRequest;
        } CloseConnection($connection);
    }
}
?>
