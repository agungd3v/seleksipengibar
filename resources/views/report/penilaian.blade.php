<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Penilaian {{ $from || $to ? "-" : "" }} {{ $from && $to ? "($from" : $from }} {{ $from && $to ? '-' : '' }} {{ $from && $to ? "$to)" : $to }}</title>
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
    th {
      font-size: 12px;
    }
  </style>
</head>
<body>
  @if ($from || $to)
    <h2 style="margin-bottom: 0">Periode</h2>
    <span>{{ $from ? $from : '' }} {{ $from && !$to ? '>' : '' }} {{ $from && $to ? '-' : '' }} {{ !$from && $to ? '<' : '' }} {{ $to ? $to : '' }}</span>
  @endif
  <table class="table table-centered table-nowrap mb-0 rounded">
    <thead class="thead-light">
      <tr>
        <th rowspan="2" colspan="2" style="vertical-align: middle; text-align: center; background: #f0bc74">NAMA PESERTA</th>
        <th colspan="2" style="text-align: center; background: #f0bc74">LARI</th>
        <th colspan="2" style="text-align: center; background: #f0bc74">B. INGGRIS</th>
        <th colspan="2" style="text-align: center; background: #f0bc74">AGAMA</th>
        <th colspan="2" style="text-align: center; background: #f0bc74">PBB</th>
        <th colspan="2" style="text-align: center; background: #f0bc74">SENI BUDAYA</th>
        <th colspan="2" style="text-align: center; background: #f0bc74">PENGETAHUAN</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center; background: #f0bc74">JUMLAH</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center; background: #f0bc74">RATA - RATA</th>
      </tr>
      <tr>
        <th style="background: #2361ce; color: #fff">TOTAL</th>
        <th style="background: #2361ce; color: #fff">METER</th>
        <th style="background: #2361ce; color: #fff">AULA</th>
        <th style="background: #2361ce; color: #fff">R. BAPAK</th>
        <th style="background: #2361ce; color: #fff">AULA</th>
        <th style="background: #2361ce; color: #fff">R. BAPAK</th>
        <th style="background: #2361ce; color: #fff">AULA</th>
        <th style="background: #2361ce; color: #fff">R. BAPAK</th>
        <th style="background: #2361ce; color: #fff">AULA</th>
        <th style="background: #2361ce; color: #fff">R. BAPAK</th>
        <th style="background: #2361ce; color: #fff">AULA</th>
        <th style="background: #2361ce; color: #fff">R. BAPAK</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($penilaians as $penilaian)
        <tr style="{{ $penilaian->rata_rata >= 400 ? 'background: #10B981' : 'background: #FBA918' }}">
          <td><b>{{ $loop->iteration }}</b></td>
          <td>{{ $penilaian->peserta->nama }}</td>
          <td>{{ $penilaian->lari_total }}</td>
          <td>{{ $penilaian->lari_meter }}</td>
          <td>{{ $penilaian->b_inggris_aula }}</td>
          <td>{{ $penilaian->b_inggris_r_bapak }}</td>
          <td>{{ $penilaian->agama_aula }}</td>
          <td>{{ $penilaian->agama_r_bapak }}</td>
          <td>{{ $penilaian->pbb_aula }}</td>
          <td>{{ $penilaian->pbb_r_bapak }}</td>
          <td>{{ $penilaian->seni_budaya_aula }}</td>
          <td>{{ $penilaian->seni_budaya_r_bapak }}</td>
          <td>{{ $penilaian->pengetahuan_aula }}</td>
          <td>{{ $penilaian->pengetahuan_r_bapak }}</td>
          <td>{{ $penilaian->jumlah }}</td>
          <td>{{ $penilaian->rata_rata }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>