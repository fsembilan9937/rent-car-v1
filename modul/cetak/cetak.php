<?php

require '../../functions/general.php';
require_once __DIR__ . '../../../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if (isset($_GET['print'])) {
  $id = $_GET['print'];
  $poo = tampilData("SELECT r.*, u.*, m.*, t.*, d.*, z.nama_brand FROM rental r JOIN detail_sewa d ON r.id_dsewa=d.id_dsewa JOIN users u ON r.id_user=u.id_user JOIN mobil m ON d.id_kendaraan=m.id_kendaraan JOIN tipe_sewa t ON d.id_tsewa=t.id_tsewa JOIN brand_mobil z ON m.id_merk=z.id_brand WHERE r.status = '1' AND r.id_rental = '$id'");
  foreach ($poo as $value) : endforeach;
}

$namafile = $value["id_rental"] . '-' . $value["customer"] . '.pdf';
$hari = date("d");
$bulan = bulanTeks(date("m"));
$tahun = date("Y");
$lama = explode(" ", $value["durasi"]);
if ($lama[1] == "bulan") {
  $tater = "Biaya operasional, seperti bahan bakar (BBM), Tambal ban dan retribusi jalan tol, parkir serta pas pelabuhan.";
} else {
  $tater = "Biaya operasional, seperti tambal ban dan retribusi jalan tol, parkir serta pas pelabuhan.";
}

$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CV ASRI</title>
  <style>
    body{
      font-family:"Times New Roman", Times, serif;
    }
  </style>
</head>
<body>
  <h3 align="center"><u>PERJANJIAN SEWA KONTRAK KENDARAAN BERMOTOR</u></h3>
  <br>
  <p>Pada hari ini ' . $hari . ' ' . $bulan . ' ' . $tahun . ' yang bertanda tangan di bawah ini:</p>
  <ol type="I">
    <li>
     CV. ASRI <br>
     Dalam hal ini disebut sebagai <b>PIHAK KESATU</b> <br>
     Berkedudukan di Jl.Sulawesi No.22 Surabaya. <br>
    </li>
    <br>
    <li>
     ' . strtoupper($value["customer"]) . ' <br>
     Dalam hal ini disebut sebagai <b>PIHAK KEDUA</b> <br>
     Berkedudukan di ' . ucfirst($value["alamat"]) . '. <br>
    </li>
  </ol>

  <p>Dengan ini para pihak menerangkan terlebih dahulu:</p>
  <ol type="a">
    <li align="justify">Bahwa <b>PIHAK KESATU</b> menyatakan dan sanggup untuk menyediakan kendaraan roda empat ' . ucfirst($value["nama_brand"]) . ' ' . ucfirst($value["nama_kendaraan"]) . ', sesuai dengan kebutuhan <b>PIHAK KEDUA.</b></li> <br>
    <li align="justify">Bahwa <b>PIHAK KEDUA</b> ' . strtoupper($value["customer"]) . ' membutuhkan kendaraan roda empat jenis ' . ucfirst($value["nama_brand"]) . ' ' . ucfirst($value["nama_kendaraan"]) . ' untuk kelancaran transportasi dan operasional.</li> <br>
  </ol>
  <p align="justify">Maka para pihak bersepakat untuk mengadakan Perjanjian Pinjam Pakai Kendaraan Bermotor, selanjutnya disebut dengan perjanjian, dengan syarat-syarat dan ketentuan-ketentuan sebagai berikut:</p>
  <ol>
    <li align="justify">
      <b>PIHAK KEDUA</b> membutuhkan peminjaman atas 1 (satu) unit kendaraan bermotor roda empat jenis station sesuai peruntukannya dan <b>PIHAK KESATU</b> sanggup menyediakan untuk dipakai atas 1 (satu) unit kendaraan sesuai kebutuhan <b>PIHAK KEDUA,</b> dengan spesifikasi kendaraan sebagai berikut: <br><br>
      <table border="0">      
        <tr>
          <td>- Merk/Type</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>' . ucfirst($value["nama_brand"]) . ' ' . ucfirst($value["nama_kendaraan"]) . '</td>
        </tr>
        <tr>
          <td>- No.Polisi</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>' . $value["nopol"] . '</td>
        </tr>
        <tr>
          <td>- Nama Pemilik</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>CV. ASRI</td>
        </tr>
        <tr>
          <td>- Tahun/Warna</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>' . $value["tahun"] . ' / ' . ucfirst($value["warna"]) . '</td>
        </tr>
        <tr>
          <td>- No.Rangka</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>' . $value["no_rangka"] . '</td>
        </tr>
        <tr>
          <td>- No.Mesin</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>' . $value["no_mesin"] . '</td>
        </tr>
        <tr>
          <td>- Kondisi</td>
          <td>:&nbsp;&nbsp;&nbsp;</td>
          <td>' . $value["kondisi"] . '</td>
        </tr>
      </table>      
    </li> <br>
    <li align="justify">
      Perjanjian ini berlaku mulai ' . date('d-m-Y', strtotime($value["tgl_pinjam"])) . ' s/d ' . date('d-m-Y', strtotime($value["tgl_kembali"])) . ' ' . $value["durasi"] . ' (' . terbilang($lama[0]) . ' ' . $lama[1] . ') dengan biaya sewa ' . rupiah($value["biaya"]) . ' (' . terbilang($value["biaya"]) . ' rupiah) dan apabila ditengah-tengah sewa <b>PIHAK KESATU</b> menghentikan sewa secara sepihak maka akan dikenakan denda sebesar 6 kali dari harga sewa. Dan dapat diperpanjang sesuai kebutuhan dan kesepakatan para pihak.
    </li> <br>
    <li align="justify">
      Besar biaya pinjam pakai sebagaimana tersebut di atas adalah sebesar ' . rupiah($value["biaya"]) . '/' . $lama[1] . '. Pembayaran dilaksanakan sebagaimana mestinya, sebelum berakhirnya masa periode sewa dan di transfer ke rekening BCA <br>
      <b>
        No.Rekening 4890270307 <br>
        Atas nama: H. Haryo Aswitjahyono / B. Niniek Aswinarti.
      </b>
    </li>
    
    <br>

    <p>Dan biaya tersebut sudah termasuk:</p>
    <ul style="list-style-type:none">
      <li>- Service, perbaikan / penggantian sparepart, termasuk minyak Pelumas (oli).</li>
      <li>- Penggantian ban pecah, kerusakan ban.</li>
      <li>- Biaya perpanjangan STNK dan uji Kir.</li>
    </ul>
    <br>
    <p>Dan tidak termasuk:</p>
    <ol type="a">
      <li align="justify">' . $tater . '</li>
      <li align="justify">Resiko setiap terjadi kejadian yang diakibatkan kelalaian oleh <b>PIHAK KEDUA</b> menjadi tanggungan sepenuhnya oleh <b>PIHAK KEDUA</b> seperti:</li>
      <ul>
        <li align="justify">Kehilangan maka <b>PIHAK KEDUA</b> bersedia mengganti unit tersebut seperti sedia kala (unit dan tipe sama).</li>
        <li align="justify">Segala biaya kecelakaan yang ditimbulkan oleh <b>PIHAK KEDUA</b> dan melibatkan <b>PIHAK KETIGA</b> maka biaya akan ditanggung oleh <b>PIHAK KEDUA.</b></li>
        <li align="justify">Tabrakan yang menyebabkan unit mobil yang disewa rusak maka <b>PIHAK KEDUA</b> harus mengganti biaya perbaikan unit mobil tersebut dibengkel yang ditunjuk oleh <b>PIHAK KESATU.</b></li>
      </ul>
    </ol>

     <br>

    <li align="justify">
      Pool kendaraan disepakati digarasi <b>PIHAK KEDUA,</b> dan menjaga keamanan kendaraan. Bilamana kendaraan obyek pinjam pakai mengalami kerusakan, baik dijalan atau dilingkungan kerja <b>PIHAK KEDUA,</b> maka <b>PIHAK KESATU</b> diwajibkan secara serta merta untuk menyediakan pengganti yang setara atau diganti unit mobil ' . ucfirst($value["nama_kendaraan"]) . '.
    </li> <br>
    <li align="justify">
      Hal-hal yang belum diatur dan / atau memerlukan perubahan dalam perjanjian ini, akan diatur kemudian dalam Addendum dan / atau Amandemen yang disepakati oleh para pihak dan merupakan bagian yang tidak terpisahkan dari perjanjian ini.
    </li> <br>
    <li align="justify">
      Kendaraan yang disewa atau penggantinya tidak dapat disewa atau dipindah tangankan atau dipertaruhkan sebagai jaminan <b>PIHAK KETIGA</b> atau siapapun dan juga dalam keadaan apapun oleh <b>PIHAK KEDUA</b> dan <b>PIHAK KEDUA</b> tidak diperkenan merubah, mengganti dan / atau menambah peralatan dan sistem mekanik kendaran tanpa persetujuan <b>PIHAK KESATU.</b>
    </li> <br>
    <li align="justify">
      Perjanjian ini dibuat dan ditandatangani dalam rangkap 2 (dua), masing-masing untuk para pihak yang mempunyai kekuatan pembuktian yang sama.
    </li>
  </ol>

    <br>

  <p> Surabaya, .................................
  <br>
  <table border="0">
    <tr>
      <th>PIHAK KESATU</th>
      <th colspan="5">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </th>
      <th>PIHAK KEDUA</th>
    </tr>
    <tr>
      <th>CV. ASRI</th>
      <th colspan="5">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </th>
      <th>PT. INDO DWI SENTOSA</th>
    </tr>
    <tr rowspan="4">
      <td>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></td>
      <td colspan="5">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
      <td>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></td>
    </tr>
    <tr>
      <th>(B. Niniek Aswinarti, SE)</th>
      <th colspan="5">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </th>
      <th>(............................................)</th>
    </tr>
  </table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output($namafile, 'I');
