<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title>PRT - Pembukuan Rumah Tangga</title>
        <?php
        $this->Template->import();
        ?>
    </head>
    <body class="sidebar-wide">
        <!-- Navbar -->
        <?php
        echo $this->element("template/londium/navbar");
        ?>
        <!-- /navbar -->
        <!-- Page container -->
        <div class="page-container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <?php
                    echo $this->element("template/londium/leftnav");
                    ?>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /sidebar -->
            <!-- Page content -->
            <div class="page-content">
                <?php
                echo $this->element("template/londium/header");
                echo $this->element("template/londium/breadcrumb");
                echo $this->element("template/londium/flash-message");
                echo $this->fetch("content");
                ?>
            </div>

            <!-- /page content -->
        </div>
        <!-- /page container -->
        <?php
        echo $this->element("template/londium/elements");
        ?>
    </body>
</html>