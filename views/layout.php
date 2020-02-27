<?php echo $header_content; ?>

<body>

    <?php echo $body_content; ?>

    <script src="<?php echo $base_url; ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url . '/' . $jsfile; ?>"></script>
</body>

</html>