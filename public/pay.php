<?php
        if(isset($_POST['create_order'])) {
        $money = strip_tags($_POST['money']);   
        $user = strip_tags($_POST['user']);
        $inv_desc = '���������� ����� CSGO-BEEN.RU';
        $public_key = '55f28-1132'; //���� ������ ���
        $out_summ = $money;
        $shp_item = $user;
        $encoding = "utf-8";
        echo '<script>location.replace("https://api.gdonate.ru/pay?&public_key='.$public_key.'&sum='.$out_summ.'&account='.$shp_item.'&desc='.$inv_desc.'");</script>';
        }
        ?>