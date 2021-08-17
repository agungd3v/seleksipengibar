@extends('layouts.main')
@section('title', 'Rekap Nilai')
@section('rekap', 'active')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.rtl.min.css') }}">
@endpush

@section('report')
<form action="{{ route('admin.report.rekap') }}" method="POST">
  @csrf
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 10px">
    <div class="form-group">
      <label for="jenis_kelamin">Jenis Kelamin</label>
      <select name="jenis_kelamin" id="jenis_kelamin" class="form-control custom-select">
        <option value="" selected hidden>Pilih Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
        <option value="L">Laki - Laki</option>
        <option value="P">Perempuan</option>
      </select>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-secondary" style="margin-top: 30px">Report</button>
    </div>
  </div>
</form>
@endsection

@section('content')
@if (session()->has('berhasil'))
<div class="row">
  <div class="col-12">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <span class="fas fa-bullhorn me-1"></span>
      <strong>Selamat!</strong> {{ session()->get('berhasil') }}.
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</div>
@endif
@if ($errors->any())
<div class="row">
  @foreach ($errors->all() as $error)
    <div class="col-12">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="fas fa-bullhorn me-1"></span>
        <strong>Gagal!</strong> {{ $error }}.
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endforeach
</div>
@endif
<div class="row">
  <div class="col-12 mb-4">
    <div class="card border-0 shadow components-section">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0 rounded">
            <thead class="thead-light">
              <tr>
                <th rowspan="2" class="border-0 bg-secondary" style="vertical-align: middle">Nama Peserta</th>
                <th rowspan="2" class="border-0 bg-secondary" style="vertical-align: middle; padding-right: 0">Jenis Kelamin</th>
                <th colspan="{{ count($materis) }}" class="border-0 text-center bg-secondary" style="padding-left: 0">Penilaian Seleksi Peserta</th>
                <th rowspan="2" class="border-0 bg-secondary text-center" style="vertical-align: middle">Jumlah</th>
                <th rowspan="2" class="border-0 bg-secondary text-center" style="vertical-align: middle">Rata - Rata</th>
              </tr>
              <tr>
                @foreach ($materis as $materi)
                  <th class="border-0 bg-secondary text-center px-0">{{ $materi->nama_materi }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($newRekaps as $rekap)
                <tr style="cursor: pointer">
                  <td class="fw-bold">{{ $rekap['nama_peserta'] }}</td>
                  <td class="fw-bold">{{ $rekap['jenis_kelamin'] }}</td>
                  @foreach ($materis as $mtr)
                    @if (isset($rekap[$mtr->id]))
                      <td class="text-center">{{ $rekap[$mtr->id] }}</td>
                    @else
                      <td class="text-center">0</td>
                    @endif
                  @endforeach
                  <td class="fw-bold text-center">{{ $rekap['jumlah'] }}</td>
                  <td class="fw-bold text-center">{{ $rekap['rata_rata'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('dist/js/select2.min.js') }}"></script>
<script>
  let peserta
  $(document).ready(function() {
    function matchCustom(params, data) {
      if ($.trim(params.term) === '') {
        return data;
      }
      if (typeof data.text === 'undefined') {
        return null;
      }
      if (data.text.indexOf(params.term) > -1) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.text += ' (matched)';
        return modifiedData;
      }
      return null;
    }
    $("#peserta").select2({
      theme: "bootstrap-5",
      dropdownParent: $("#peserta").parent(),
      matcher: matchCustom
    });
  })
</script>
@endpush