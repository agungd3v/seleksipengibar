@extends('layouts.main')
@section('title', 'Penilaian')
@section('penilaian', 'active')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.rtl.min.css') }}">
@endpush

@section('report')
<form action="{{ route('admin.report.penilaian') }}" method="POST">
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
      <label for="from">Dari</label>
      <input type="date" id="from" name="from" class="form-control" min="{{ date('Y-m-d', strtotime(now())) }}">
    </div>
    <div class="form-group">
      <label for="to">Sampai</label>
      <input type="date" id="to" name="to" class="form-control" min="{{ date('Y-m-d', strtotime(now())) }}">
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
        <div class="d-flex justify-content-between align-items-center">
          <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#openPenilaian">Berikan Penilaian</button>
        </div>
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0 rounded">
            <thead class="thead-light">
              <tr>
                <th rowspan="2" class="border-0 rounded-start" style="vertical-align: middle"></th>
                <th rowspan="2" class="border-0" style="vertical-align: middle">Nama Peserta</th>
                <th colspan="2" class="border-0 text-center">Lari</th>
                <th colspan="2" class="border-0 text-center">B. Inggris</th>
                <th colspan="2" class="border-0 text-center">Agama</th>
                <th colspan="2" class="border-0 text-center">PBB</th>
                <th colspan="2" class="border-0 text-center">Seni Budaya</th>
                <th colspan="2" class="border-0 text-center">Pengetahuan</th>
                <th rowspan="2" class="border-0 text-center" style="vertical-align: middle">Jumlah</th>
                <th rowspan="2" class="border-0 text-center" style="vertical-align: middle">Rata - Rata</th>
              </tr>
              <tr>
                <th class="border-0">Total</th>
                <th class="border-0">Meter</th>
                <th class="border-0">Aula</th>
                <th class="border-0">R. Bapak</th>
                <th class="border-0">Aula</th>
                <th class="border-0">R. Bapak</th>
                <th class="border-0">Aula</th>
                <th class="border-0">R. Bapak</th>
                <th class="border-0">Aula</th>
                <th class="border-0">R. Bapak</th>
                <th class="border-0">Aula</th>
                <th class="border-0">R. Bapak</th>
              </tr>
            </thead>
            <tbody>
              @php
                $iteration = 1
              @endphp
              @foreach ($penilaians as $penilaian)
                @if ($penilaian->penilaian != null)
                  <tr style="cursor: pointer" onclick="editPenilaian({{ $penilaian }})">
                    <th>{{ $iteration++ }}</th>
                    <td class="fw-bold">{{ $penilaian->nama }}</td>
                    <td>{{ $penilaian->penilaian->lari_total }}</td>
                    <td>{{ $penilaian->penilaian->lari_meter }}</td>
                    <td>{{ $penilaian->penilaian->b_inggris_aula }}</td>
                    <td>{{ $penilaian->penilaian->b_inggris_r_bapak }}</td>
                    <td>{{ $penilaian->penilaian->agama_aula }}</td>
                    <td>{{ $penilaian->penilaian->agama_r_bapak }}</td>
                    <td>{{ $penilaian->penilaian->pbb_aula }}</td>
                    <td>{{ $penilaian->penilaian->pbb_r_bapak }}</td>
                    <td>{{ $penilaian->penilaian->seni_budaya_aula }}</td>
                    <td>{{ $penilaian->penilaian->seni_budaya_r_bapak }}</td>
                    <td>{{ $penilaian->penilaian->pengetahuan_aula }}</td>
                    <td>{{ $penilaian->penilaian->pengetahuan_r_bapak }}</td>
                    <td>{{ $penilaian->penilaian->jumlah }}</td>
                    <td>{{ $penilaian->penilaian->rata_rata }}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="openPenilaian" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Penilaian</h1>
          </div>
          <form action="{{ route('admin.penilaian.post') }}" method="POST" class="mt-4">
            @csrf
            <div class="row mb-4">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="peserta">Peserta</label>
                  <select name="peserta" id="peserta" class="form-control">
                    <option value="" selected hidden>Pilih Peserta</option>
                    @foreach ($pesertas as $peserta)
                      @if ($peserta->penilaian == null)  
                        <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">LARI</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="lari_total">Total</label>
                      <input type="number" name="lari_total" class="form-control" placeholder="0" id="lari_total" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="lari_meter">Meter</label>
                      <input type="number" name="lari_meter" class="form-control" placeholder="0" id="lari_meter" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">B. INGGRIS</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="b_inggris_aula">Aula</label>
                      <input type="number" name="b_inggris_aula" class="form-control" placeholder="0" id="b_inggris_aula" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="b_inggris_r_bapak">R. Bapak</label>
                      <input type="number" name="b_inggris_r_bapak" class="form-control" placeholder="0" id="b_inggris_r_bapak" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">AGAMA</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="agama_aula">Aula</label>
                      <input type="number" name="agama_aula" class="form-control" placeholder="0" id="agama_aula" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="agama_r_bapak">R. Bapak</label>
                      <input type="number" name="agama_r_bapak" class="form-control" placeholder="0" id="agama_r_bapak" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">PBB</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="pbb_aula">Aula</label>
                      <input type="number" name="pbb_aula" class="form-control" placeholder="0" id="pbb_aula" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="pbb_r_bapak">R. Bapak</label>
                      <input type="number" name="pbb_r_bapak" class="form-control" placeholder="0" id="pbb_r_bapak" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">SENI BUDAYA</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="senibudaya_aula">Aula</label>
                      <input type="number" name="senibudaya_aula" class="form-control" placeholder="0" id="senibudaya_aula" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="senibudaya_r_bapak">R. Bapak</label>
                      <input type="number" name="senibudaya_r_bapak" class="form-control" placeholder="0" id="senibudaya_r_bapak" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">PENGETAHUAN</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="pengetahuan_aula">Aula</label>
                      <input type="number" name="pengetahuan_aula" class="form-control" placeholder="0" id="pengetahuan_aula" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="pengetahuan_r_bapak">R. Bapak</label>
                      <input type="number" name="pengetahuan_r_bapak" class="form-control" placeholder="0" id="pengetahuan_r_bapak" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-gray-800">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="openAction" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="h6 modal-title">Action</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center" style="gap: 10px">
          <button class="btn btn-info w-100" type="button" onclick="updateData()">Update Data</button>
          <button class="btn btn-danger w-100" type="button" onclick="deleteData()">Delete Data</button>
          <form action="{{ route('admin.penilaian.delete') }}" method="POST" class="d-none" id="f-delete-data">
            @csrf <input type="hidden" id="delete_penilaian_id" name="delete_penilaian_id" value="xxx">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="updatePenilaian" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Penilaian</h1>
          </div>
          <form action="{{ route('admin.penilaian.update') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" id="penilaian_id" name="penilaian_id" value="xxx">
            <div class="row mb-4">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="peserta" id="sekolah_peserta">Peserta</label>
                  <h3 id="nama_peserta"></h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">LARI</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="lari_total_edit">Total</label>
                      <input type="number" name="lari_total_edit" class="form-control" placeholder="0" id="lari_total_edit" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="lari_meter_edit">Meter</label>
                      <input type="number" name="lari_meter_edit" class="form-control" placeholder="0" id="lari_meter_edit" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">B. INGGRIS</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="b_inggris_aula_edit">Aula</label>
                      <input type="number" name="b_inggris_aula_edit" class="form-control" placeholder="0" id="b_inggris_aula_edit" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="b_inggris_r_bapak_edit">R. Bapak</label>
                      <input type="number" name="b_inggris_r_bapak_edit" class="form-control" placeholder="0" id="b_inggris_r_bapak_edit" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">AGAMA</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="agama_aula_edit">Aula</label>
                      <input type="number" name="agama_aula_edit" class="form-control" placeholder="0" id="agama_aula_edit" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="agama_r_bapak_edit">R. Bapak</label>
                      <input type="number" name="agama_r_bapak_edit" class="form-control" placeholder="0" id="agama_r_bapak_edit" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">PBB</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="pbb_aula_edit">Aula</label>
                      <input type="number" name="pbb_aula_edit" class="form-control" placeholder="0" id="pbb_aula_edit" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="pbb_r_bapak_edit">R. Bapak</label>
                      <input type="number" name="pbb_r_bapak_edit" class="form-control" placeholder="0" id="pbb_r_bapak_edit" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">SENI BUDAYA</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="senibudaya_aula_edit">Aula</label>
                      <input type="number" name="senibudaya_aula_edit" class="form-control" placeholder="0" id="senibudaya_aula_edit" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="senibudaya_r_bapak_edit">R. Bapak</label>
                      <input type="number" name="senibudaya_r_bapak_edit" class="form-control" placeholder="0" id="senibudaya_r_bapak_edit" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="row">
                  <label class="mb-3">
                    <span class="text-lg bg-gray-600 px-3 py-1 text-white rounded">PENGETAHUAN</span>
                  </label>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                      <label for="pengetahuan_aula_edit">Aula</label>
                      <input type="number" name="pengetahuan_aula_edit" class="form-control" placeholder="0" id="pengetahuan_aula_edit" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-4">
                      <label for="pengetahuan_r_bapak_edit">R. Bapak</label>
                      <input type="number" name="pengetahuan_r_bapak_edit" class="form-control" placeholder="0" id="pengetahuan_r_bapak_edit" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-gray-800">Update Data</button>
            </div>
          </form>
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
  function editPenilaian(data) {
    $('#openAction').modal('show')
    return peserta = data
  }
  function updateData() {
    $('#openAction').modal('hide')

    const elPenilaianId = document.getElementById('penilaian_id')
    const elSekolahPeserta = document.getElementById('sekolah_peserta')
    const elNamaPeserta = document.getElementById('nama_peserta')
    const elLariTotal = document.getElementById('lari_total_edit')
    const elLariMeter = document.getElementById('lari_meter_edit')
    const elBInggrisAula = document.getElementById('b_inggris_aula_edit')
    const elBInggrisRBapak = document.getElementById('b_inggris_r_bapak_edit')
    const elAgamaAula = document.getElementById('agama_aula_edit')
    const elAgamaRBapak = document.getElementById('agama_r_bapak_edit')
    const elPBBAula = document.getElementById('pbb_aula_edit')
    const elPBBRBapak = document.getElementById('pbb_r_bapak_edit')
    const elSeniBudayaAula = document.getElementById('senibudaya_aula_edit')
    const elSeniBudayaRBapak = document.getElementById('senibudaya_r_bapak_edit')
    const elPengetahuanAula = document.getElementById('pengetahuan_aula_edit')
    const elPengetahuanRBapak = document.getElementById('pengetahuan_r_bapak_edit')

    elPenilaianId.value = peserta.penilaian.id
    elNamaPeserta.textContent = peserta.nama
    elSekolahPeserta.textContent = `Peserta | ${peserta.asal_sekolah}`
    elLariTotal.value = peserta.penilaian.lari_total
    elLariMeter.value = peserta.penilaian.lari_meter
    elBInggrisAula.value = peserta.penilaian.b_inggris_aula
    elBInggrisRBapak.value = peserta.penilaian.b_inggris_r_bapak
    elAgamaAula.value = peserta.penilaian.agama_aula
    elAgamaRBapak.value = peserta.penilaian.agama_r_bapak
    elPBBAula.value = peserta.penilaian.pbb_aula
    elPBBRBapak.value = peserta.penilaian.pbb_r_bapak
    elSeniBudayaAula.value = peserta.penilaian.seni_budaya_aula
    elSeniBudayaRBapak.value = peserta.penilaian.seni_budaya_r_bapak
    elPengetahuanAula.value = peserta.penilaian.pengetahuan_aula
    elPengetahuanRBapak.value = peserta.penilaian.pengetahuan_r_bapak

    $('#updatePenilaian').modal('show')
  }
  function deleteData() {
    const elPenilaianId = document.getElementById('delete_penilaian_id')
    const formDelete = document.getElementById('f-delete-data')
    elPenilaianId.value = peserta.penilaian.id
    return formDelete.submit()
  }
</script>
@endpush