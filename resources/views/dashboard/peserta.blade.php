@extends('layouts.main')
@section('title', 'Peserta')
@section('peserta', 'active')
@section('collapse', 'show')

@section('report')
<form action="{{ route('admin.report.peserta') }}" method="POST">
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
      <input type="date" id="from" name="from" class="form-control">
    </div>
    <div class="form-group">
      <label for="to">Sampai</label>
      <input type="date" id="to" name="to" class="form-control">
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
@if (session()->has('errorMessage'))
<div class="row">
  <div class="col-12">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <span class="fas fa-bullhorn me-1"></span>
      <strong>Gagal!</strong> {{ session()->get('errorMessage') }}.
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</div>  
@endif
<div class="row">
  <div class="col-12 mb-4">
    <div class="card border-0 shadow components-section">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#openPeserta">Tambah Peserta</button>
        </div>
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0 rounded">
            <thead class="thead-light">
              <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0">Nama Peserta</th>
                <th class="border-0">Jenis Kelamin</th>
                <th class="border-0">Nomor Dada</th>
                <th class="border-0">Asal Sekolah</th>
                <th class="border-0">Alamat</th>
                <th class="border-0">Tinggi Badan</th>
                <th class="border-0">Berat Badan</th>
                <th class="border-0 rounded-end"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pesertas as $peserta)
                <tr>
                  <th style="vertical-align: middle">{{ $loop->iteration }}</th>
                  <td class="fw-bold" style="vertical-align: middle">{{ $peserta->nama }}</td>
                  <td style="vertical-align: middle">{{ $peserta->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td>
                  <td style="vertical-align: middle">{{ $peserta->nomor_dada }}</td>
                  <td style="vertical-align: middle">{{ $peserta->asal_sekolah }}</td>
                  <td style="vertical-align: middle">{{ $peserta->alamat }}</td>
                  <td style="vertical-align: middle">{{ $peserta->tinggi }}</td>
                  <td style="vertical-align: middle">{{ $peserta->berat }}</td>
                  <td style="vertical-align: middle">
                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.report.peserta.id', $peserta->id) }}">Cetak Data Peserta</a>
                    <button class="btn btn-sm btn-info" type="button" onclick="updateData({{ $peserta }})">Update</button>
                    <button class="btn btn-sm btn-danger" type="button" onclick="deleteData({{ $peserta->id }})">Delete</button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8">Data Not Found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="openPeserta" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Tambah Peserta</h1>
          </div>
          <form action="{{ route('admin.peserta.post') }}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group mb-2">
                  <label for="name">Nama Lengkap</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Bambang Subagio" id="name" autofocus required>
                  </div>  
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group mb-2">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control custom-select">
                    <option value="" selected hidden>Pilih Jenis Kelamin</option>
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="nomor">Nomor Dada</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                      </span>
                      <input type="number" name="nomor" placeholder="001" class="form-control" id="nomor" required>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="sekolah">Asal Sekolah</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                      </span>
                      <input type="text" name="sekolah" placeholder="SMA N 1 Metro" class="form-control" id="sekolah" required>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group mb-2">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="tinggi">Tinggi Badan</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                      </span>
                      <input type="number" name="tinggi" placeholder="100" class="form-control" id="tinggi" required>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="berat">Berat Badan</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                      </span>
                      <input type="number" name="berat" placeholder="100" class="form-control" id="berat" required>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-sm-12">
                <label for="photo" class="form-label">Photo</label>
                <input class="form-control" name="photo" type="file" id="photo">
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-gray-800">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editPeserta" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Update Peserta</h1>
          </div>
          <form action="{{ route('admin.peserta.update') }}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="peserta_id" id="peserta_id" value="xxx">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group mb-2">
                  <label for="name_edit">Nama Lengkap</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input type="text" name="name_edit" class="form-control" placeholder="Bambang Subagio" id="name_edit" autofocus required>
                  </div>  
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group mb-2">
                  <label for="jenis_kelamin_edit">Jenis Kelamin</label>
                  <select name="jenis_kelamin_edit" id="jenis_kelamin_edit" class="form-control custom-select">
                    <option value="" selected hidden>Pilih Jenis Kelamin</option>
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group mb-2">
                <label for="nomor_edit">Nomor Dada</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                  </span>
                  <input type="number" name="nomor_edit" placeholder="001" class="form-control" id="nomor_edit" required>
                </div>  
              </div>
            </div>
            <div class="form-group">
              <div class="form-group mb-2">
                <label for="sekolah_edit">Asal Sekolah</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                  </span>
                  <input type="text" name="sekolah_edit" placeholder="SMA N 1 Metro" class="form-control" id="sekolah_edit" required>
                </div>  
              </div>
            </div>
            <div class="form-group">
              <div class="form-group mb-2">
                <label for="alamat_edit">Alamat</label>
                <textarea name="alamat_edit" id="alamat_edit" class="form-control" cols="30" rows="3"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="tinggi_edit">Tinggi Badan</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                      </span>
                      <input type="number" name="tinggi_edit" placeholder="100" class="form-control" id="tinggi_edit" required>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-2">
                    <label for="berat_edit">Berat Badan</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                      </span>
                      <input type="number" name="berat_edit" placeholder="100" class="form-control" id="berat_edit" required>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-sm-12">
                <label for="photo_edit" class="form-label">Photo</label>
                <input class="form-control" name="photo_edit" type="file" id="photo_edit">
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-gray-800">Update Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deletePeserta" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="h6 modal-title">Peringatan</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <svg class="icon icon-lg text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
          <p class="text-center mt-3">Jika kamu menekan Ya maka data peserta ini akan di hapus beserta dengan penilaiannya!</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="deleteIt()">Ya, Hapus Data</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Tidak</button>
        <form action="{{ route('admin.peserta.delete') }}" method="POST" class="d-none" id="f-delete-data">
          @csrf <input type="hidden" id="delete_peserta_id" name="delete_peserta_id" value="xxx">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script>
<script>
  function updateData(data) {
    const elPesertaId = document.getElementById('peserta_id')
    const elPesertaName = document.getElementById('name_edit')
    const elJenisKelamin = document.getElementById('jenis_kelamin_edit')
    const elNomor = document.getElementById('nomor_edit')
    const elSekolah = document.getElementById('sekolah_edit')
    const elAlamat = document.getElementById('alamat_edit')
    const elTinggi = document.getElementById('tinggi_edit')
    const elBerat = document.getElementById('berat_edit')

    elPesertaId.value = data.id
    elPesertaName.value = data.nama
    elJenisKelamin.value = data.jenis_kelamin
    elNomor.value = data.nomor_dada
    elSekolah.value = data.asal_sekolah
    elAlamat.value = data.alamat
    elTinggi.value = data.tinggi
    elBerat.value = data.berat

    $('#editPeserta').modal('show')
  }
  function deleteData(data) {
    const elPeserta = document.getElementById('delete_peserta_id')
    elPeserta.value = data

    $('#deletePeserta').modal('show')
  }
  function deleteIt() {
    const form = document.getElementById('f-delete-data')
    return form.submit()
  }
</script>
@endpush
