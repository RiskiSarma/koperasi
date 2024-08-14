<?php
    //Tangkap variabel
    $GetPpnPersen = !empty($_POST['GetPpnPersen']) ? $_POST['GetPpnPersen'] : 0;
    $GetSubtotal = !empty($_POST['GetSubtotal']) ? $_POST['GetSubtotal'] : 0;

    //menghilangkan tanda titik
    $GetPpnPersen = str_replace(".", "", $GetPpnPersen);
    $GetSubtotal = str_replace(".", "", $GetSubtotal);

    // konversi string ke integer untuk operasi aritmatika
    $GetPpnPersen = (float) $GetPpnPersen;
    $GetSubtotal = (float) $GetSubtotal;

    // pastikan $GetSubtotal tidak nol
    if ($GetSubtotal == 0) {
        echo "Error: Subtotal tidak boleh nol. Mohon masukkan nilai subtotal yang benar.";
    } else {
        $GetPpnRpEdit = ($GetPpnPersen / 100) * $GetSubtotal;
        $GetPpnRpEdit = number_format($GetPpnRpEdit, 0, ',', '.');
        echo "$GetPpnRpEdit";
    }
?>
