<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $peserta->nama }}</title>
</head>
<body>
  <h1 style="text-align: center">Data Peserta</h1>
  <table style="margin-top: 80px">
    <tr>
      <td style="padding-right: 20px">
        <img src="{{ public_path($peserta->photo) }}" style="width: 250px">
      </td>
      <td style="vertical-align: top; width: 100%">
        <table style="width: 100%">
          <tr>
            <td style="vertical-align: top">Nama</td>
            <td style="padding: 0 10px 10px 5px">:</td>
            <td style="vertical-align: top">{{ $peserta->nama }}</td>
          </tr>
          <tr>
            <td style="vertical-align: top">Jenis&nbsp;Kelamin</td>
            <td style="padding: 0 10px 10px 5px">:</td>
            <td style="vertical-align: top">{{ $peserta->jenis_kelamin == "L" ? "Laki - Laki" : "Perempuan" }}</td>
          </tr>
          <tr>
            <td style="vertical-align: top">Nomor&nbsp;Dada</td>
            <td style="padding: 0 10px 10px 5px">:</td>
            <td style="vertical-align: top">{{ $peserta->nomor_dada }}</td>
          </tr>
          <tr>
            <td style="vertical-align: top">Asal Sekolah</td>
            <td style="padding: 0 10px 10px 5px">:</td>
            <td style="vertical-align: top">{{ $peserta->asal_sekolah }}</td>
          </tr>
          <tr>
            <td style="vertical-align: top">Alamat</td>
            <td style="padding: 0 10px 10px 5px; vertical-align: top">:</td>
            <td style="vertical-align: top; width: 100%">{{ $peserta->alamat }}</td>
          </tr>
          <tr>
            <td style="vertical-align: top">Tinggi</td>
            <td style="padding: 0 10px 10px 5px">:</td>
            <td style="vertical-align: top">{{ $peserta->tinggi }} cm</td>
          </tr>
          <tr>
            <td style="vertical-align: top">Berat</td>
            <td style="padding: 0 10px 10px 5px">:</td>
            <td style="vertical-align: top">{{ $peserta->berat }} kg</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>