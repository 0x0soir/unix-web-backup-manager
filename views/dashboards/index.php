<?php
$this->load->view('_/header');
?>
    <body>
        <div class="full-container">
            <?php $this->load->view('_/bar'); ?>
            <?php $this->load->view('_/left'); ?>
        </div>
    </body>
<?php
$this->load->view('_/footer', array());
?>
