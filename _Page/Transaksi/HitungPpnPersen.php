<?php
    //Tangkap variabel
    $GetPpnRp = !empty($_POST['GetPpnRp']) ? $_POST['GetPpnRp'] : 0;
    $GetSubtotal = !empty($_POST['GetSubtotal']) ? $_POST['GetSubtotal'] : 0;

    //menghilangkan tanda titik
    $GetPpnRp = str_replace(".", "", $GetPpnRp);
    $GetSubtotal = str_replace(".", "", $GetSubtotal);

    // pastikan $GetSubtotal tidak nol untuk menghindari DivisionByZeroError
    if ($GetSubtotal == 0) {
        echo "Error: Subtotal tidak boleh nol. Mohon masukkan nilai subtotal yang benar.";
    } else {
        $GetPpnPersenEdit = ($GetPpnRp / $GetSubtotal) * 100;
        $GetPpnPersenEdit = number_format($GetPpnPersenEdit, 0, ',', '.');
        echo "$GetPpnPersenEdit";
    }
?>
