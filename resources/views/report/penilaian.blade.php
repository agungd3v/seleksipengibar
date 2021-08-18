<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report Penilaian</title>
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
  <table style="width: 100%">
    <thead>
      @if ($jenis_kelamin)
        <tr style="background: #10B981; border: 0">
          <th colspan="2" style="padding: 0; border: 0">
            <div style="border: 1px solid #000; padding: 10px">
              <span style="font-size: 21px">
                {{ $jenis_kelamin == 'L' ? 'LAKI - LAKI' : 'PEREMPUAN' }}
              </span>
            </div>
          </th>
        </tr>
      @endif
      <tr>
        <th rowspan="2" style="text-align: center; background: #f0bc74; vertical-align: middle">Nama Peserta</th>
        <th rowspan="2" style="text-align: center; background: #f0bc74; vertical-align: middle; padding-right: 0">Jenis Kelamin</th>
        <th colspan="{{ count($materis) }}" style="text-align: center; background: #f0bc74; padding-left: 0">Penilaian Seleksi Peserta</th>
        <th rowspan="2" style="text-align: center; background: #f0bc74; vertical-align: middle">Jumlah</th>
        <th rowspan="2" style="text-align: center; background: #f0bc74; vertical-align: middle">Rata - Rata</th>
      </tr>
      <tr>
        @foreach ($materis as $materi)
          <th style="background: #2361ce; color: #fff">{{ $materi->nama_materi }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($newRekaps as $rekap)
        <tr style="cursor: pointer; background: {{ $rekap['rata_rata'] >= 350 ? '#10B981' : '#fff' }}">
          <td>{{ $rekap['nama_peserta'] }}</td>
          <td>{{ $rekap['jenis_kelamin'] == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td>
          @foreach ($materis as $mtr)
            @if (isset($rekap[$mtr->id]))
              <td>{{ $rekap[$mtr->id] }}</td>
            @else
              <td>0</td>
            @endif
          @endforeach
          <td>{{ $rekap['jumlah'] }}</td>
          <td>{{ $rekap['rata_rata'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @if (count($newRekaps) > 0)
    <div style="margin-top: 50px">
      <div style="display: inline-block; width: 100px; height: 30px; background: #10B981"></div>
      <div style="vertical-align: middle; height: 20px; margin-left: 10px; display: inline-block">
        <span>Lulus</span>
      </div>
    </div>
  @endif
</body>
</html>