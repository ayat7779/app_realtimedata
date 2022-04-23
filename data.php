<?php

function rp($angka)
{
	$rupiah = number_format($angka, 2, ',', '.');
	return $rupiah;
}

function tgl_indo($tanggal)
{
	$bulan = array(1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

include "db.php";

$query1 = "SELECT keterangan, nilai from 
(SELECT SUM(SPP) AS SPP, 
		SUM(SPM) AS SPM, 
		SUM(SP2DBLMSAH) AS SP2D_KASUBBID, 
		SUM(SP2DSDHSAH) AS SP2D_KABID
 FROM View_KonKeluarBUD) a
UNPIVOT (nilai FOR keterangan IN (SPP, SPM, SP2D_KASUBBID, SP2D_KABID )) b";
$tampil = sqlsrv_query($conn2, $query1);
$keterangan = array();
$nilai = array();
while ($r = sqlsrv_fetch_array($tampil)) {
	array_push($keterangan, $r["keterangan"]);
	array_push($nilai, $r["nilai"]);
}
?>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php
					foreach ($keterangan as $value) {
						echo "'" . $value . "',";
					}
					?>],
			datasets: [{
				label: 'Rupiah',
				data: [<?php
						foreach ($nilai as $value) {
							echo $value . ",";
						}
						?>],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)'
				],
				borderWidth: 1
			}]
		},
		options : {
			tooltips: {
				callbacks: {
					label: function(t, d) {
					var xLabel = d.datasets[t.datasetIndex].label;
					var yLabel = t.yLabel >= 1000 ? 'Rp' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : 'Rp' + t.yLabel;
					return xLabel + ': ' + yLabel;
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
					callback: function(value, index, values) {
						if (parseInt(value) >= 1000) {
							return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
						} else {
							return 'Rp' + value;
						}
					}
					}
				}]
			}
		}
	});
</script>