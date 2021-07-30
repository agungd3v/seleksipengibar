<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Peserta {{ $from || $to ? "-" : "" }} {{ $from && $to ? "($from" : $from }} {{ $from && $to ? '-' : '' }} {{ $from && $to ? "$to)" : $to }}</title>
  <style>
    @font-face {
      font-family: 'Fira Sans';
      src: url('/fonts/FiraSansExtraCondensed-Regular.ttf') format("truetype");
      font-weight: 400; // use the matching font-weight here ( 100, 200, 300, 400, etc).
      font-style: normal; // use the matching font-style here
    }
    body {
      font-family: 'Fira Sans', sans-serif;
    }
    table, tr, th, td {
      text-align: left;
      border: 1px solid #000;
      border-collapse: collapse;
      padding: 10px;
    }
    table {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  @if ($from || $to)
    <h2 style="margin-bottom: 0">Periode</h2>
    <span>{{ $from ? $from : '' }} {{ $from && !$to ? '>' : '' }} {{ $from && $to ? '-' : '' }} {{ !$from && $to ? '<' : '' }} {{ $to ? $to : '' }}</span>
  @endif
  <table style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center; background: #f0bc74">No</th>
        <th style="width: 100%; background: #f0bc74">Nama Peserta</th>
        <th style="background: #f0bc74">Nomor Dada</th>
        <th style="width: 100%; background: #f0bc74">Asal Sekolah</th>
        <th style="width: 100%; background: #f0bc74">Alamat</th>
        <th style="background: #f0bc74">Tinggi</th>
        <th style="background: #f0bc74">Berat</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pesertas as $peserta)
        <tr>
          <th style="text-align: center">{{ $loop->iteration }}</th>
          <td>{{ $peserta->nama }}</td>
          <td style="text-align: center">{{ $peserta->nomor_dada }}</td>
          <td>{{ $peserta->asal_sekolah }}</td>
          <td>{{ $peserta->alamat }}</td>
          <td style="text-align: center">{{ $peserta->tinggi }}</td>
          <td style="text-align: center">{{ $peserta->berat }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>