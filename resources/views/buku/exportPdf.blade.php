<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Buku</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
		table tr th{
			font-weight:bold;
			text-align:center;
			background:#f4f4f4;
		}
	</style>
	<center>
		<h4>DATA BUKU</h4>
		<p>Waktu Export : {{date('d-m-Y H:i')}}</p>
	</center>
 
	<table class='table table-bordered'>
		<thead>
		<tr>
            <th width="20px">No</th>
            <th style="text-align:center">Judul</th>
            <th style="text-align:center">Penulis</th>
            <th style="text-align:center">Penerbit</th>
            <th style="text-align:center">Tahun Terbit</th>
		</tr>
		</thead>
		<tbody>
		@php $no=1; @endphp
		@if(count($buku))
		@foreach($buku as $item)
			<tr>
                <td style="text-align:center">{{ $loop->iteration }}</td>
                <td style="text-align:center">{{ $item->judul}}</td>
                <td style="text-align:center">{{ $item->penulis}}</td>
                <td style="text-align:center">{{ $item->penerbit}}</td>
                <td style="text-align:center">{{ $item->tahunTerbit}}</td>
			</tr>
		@endforeach
		@endif
		</tbody>
	</table>
 
</body>
</html>