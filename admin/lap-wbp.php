<?php
ob_start();

date_default_timezone_set('Asia/Jakarta');
$now = new DateTime();
$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$formattedDate = $formatter->format($now);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_lapas_cipinang"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            wbp.nama_wbp,
            wbp.blok,
            wbp.tipe_blok,
            COUNT(kunjungan.id_kunjungan) AS total_kunjungan
        FROM 
            kunjungan
        JOIN 
            wbp ON kunjungan.id_wbp = wbp.id_wbp
        GROUP BY
            kunjungan.id_wbp";

$result = $conn->query($sql);

$pengunjungData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pengunjungData[] = $row;
    }
} else {
    echo "0 results";
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan WBP Terkunjungi</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
            color: #333;
        }
        .header h3, .header h4, .header p {
            text-align: center;
            margin: 0px;
        }
        .line {
            border-top: 3px solid #000;
            margin: 10px auto;
            width: 100%;
        }
        .content h4{
            text-align: center;
        }
        .pengunjung-table {
            border-collapse: collapse;
            margin-top: 15px;
        }
        .pengunjung-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .pengunjung-table td {
            background-color: #fafafa;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .pengunjung-table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        .signature {
            text-align: right;
        }
        .signature .date-section {
            margin-top: 20px;
            margin-right: 25px;
        }
        .signature .name {
            margin-top: 100px;
        }
        .signature .job{
            margin-right: 25px;
        }
        .signature p{
            margin: 0px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    <img src="assets/img/logo_lapas.png" width="100" height="120">
                </td>
                <td>
                    <h3>KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA</h3>
                    <h4>REPUBLIK INDONESIA</h4>
                    <h4>KANTOR WILAYAH DKI JAKARTA</h4>
                    <h4>LEMBAGA PEMASYARAKATAN KELAS I CIPINANG</h4>        
                    <p>Jl. H.Darip No.170 Jakarta Timur, 13410</p>
                    <p>Telp (021) 8191012 Fax (021) 8192214</p>
                    <p>Laman: lapascipinang.kemenkumham.go.id, Pos-el: lp.cipinang@kemenkumham.go.id</p>
                </td>
            </tr>   
        </table>
        <div class="line"></div>
    </div>

    <div class="content">
        <h4>DATA WARGA BINAAN PEMASYARAKATAN</h4>
        <table class="pengunjung-table">
            <thead>
                <tr>
                    <th>Nama WBP</th>
                    <th>Blok</th>
                    <th>Tipe Blok</th>
                    <th>Jumlah Kunjungan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengunjungData as $data): ?>
                    <tr>
                        <td style="width: 200px;"><?= htmlspecialchars($data['nama_wbp']); ?></td>
                        <td style="width: 50px;"><?= htmlspecialchars($data['blok']); ?></td>
                        <td style="width: 70px;"><?= htmlspecialchars($data['tipe_blok']); ?></td>
                        <td style="width: 150px;"><?= htmlspecialchars($data['total_kunjungan']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="signature">
        <p style=" margin-top: 20px; margin-right: 25px;">Jakarta, <?php echo $formattedDate; ?></p>
        <p style="margin-top: 100px;"><strong>Lis Susanti, A.Md.I.P., S.Sos., S.Si.</strong></p>
        <p style="margin-right: 25px;">Kepala Bagian Tata Usaha</p>
    </div>

    <div class="footer">
        <p>© Lapas Cipinang 2024 - Semua Hak Dilindungi</p>
    </div>
</body>
</html>

<?php
    $html = ob_get_contents();
    ob_end_clean();

    require __DIR__ . '/../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

    $html2pdf = new HTML2PDF('P', 'A4', 'id', true, 'UTF-8', [20, 20, 20]);
    $html2pdf->writeHTML($html);
    $html2pdf->Output("Laporan Kunjungan WBP.pdf");
?>