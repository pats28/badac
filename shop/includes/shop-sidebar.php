<?php

include('config.php');
// $StoreId = $_GET['StoreId'];
$sqlCategories = "SELECT * FROM category WHERE IsDelete = 0 ORDER BY CategoryName ASC;";
$resultCategories = mysqli_query($con, $sqlCategories);
// $rowStore = mysqli_fetch_assoc($resultStore);
?>
<div class="col-md-4 col-lg-2">
    <div class="sidebar">
        <div class="sidebar-box-2">
            <h2 class="heading">Categories</h2>
            <div class="fancy-collapse-panel">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php while ($rowCategories = mysqli_fetch_assoc($resultCategories)) :
                        $CategoryId = $rowCategories['CategoryId'];
                        $CategoryName = $rowCategories['CategoryName'];?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="shop-index.php?category=<?php echo $CategoryId; ?>"><?php echo $CategoryName; ?></a>
                            </h4>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        
</div>