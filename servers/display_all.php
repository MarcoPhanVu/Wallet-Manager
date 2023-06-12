<?php include "../components/header_server.php" ?>

<section class="display_info">
    <?php 
        $target_table = "users";
        include "./display/display_data.php";
        $target_table = "wallets";
        include "./display/display_data.php";
        $target_table = "wallet_category";
        include "./display/display_data.php";
        $target_table = "categories";
        include "./display/display_data.php";
        $target_table = "transactions";
        include "./display/display_data.php";
    ?>
</section>
    
<?php include "../components/footer_server.php" ?>