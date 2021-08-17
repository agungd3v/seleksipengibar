@extends('layouts.main')
@section('title', 'Penilai')
@section('penilai', 'active')
@section('collapse', 'show')

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
          <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#openPenilai">Tambah Penilai</button>
        </div>
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0 rounded">
            <thead class="thead-light">
              <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0">Nama Penilai</th>
                <th class="border-0">Asal Instansi</th>
                <th class="border-0">Jabatan</th>
                <th class="border-0">Keterangan</th>
                <th class="border-0 rounded-end"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($penilais as $penilai)
                <tr>
                  <th style="vertical-align: middle">{{ $loop->iteration }}</th>
                  <td class="fw-bold" style="vertical-align: middle">{{ $penilai->nama_penilai }}</td>
                  <td class="fw-bold" style="vertical-align: middle">{{ $penilai->asal_instansi }}</td>
                  <td class="fw-bold" style="vertical-align: middle">{{ $penilai->jabatan }}</td>
                  <td class="fw-bold" style="vertical-align: middle; width: 100%">{{ $penilai->keterangan ? $penilai->keterangan : '-' }}</td>
                  <td style="vertical-align: middle">
                    <button class="btn btn-sm btn-info" type="button" onclick="updateData({{ $penilai }})">Update</button>
                    <button class="btn btn-sm btn-danger" type="button" onclick="deleteData({{ $penilai->id }})">Delete</button>
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
<div class="modal fade" id="openPenilai" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Tambah Penilai</h1>
          </div>
          <form action="{{ route('admin.penilai.post') }}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="name">Nama Penilai</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input type="text" name="name" class="form-control" id="name" autofocus required>
                  </div>  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="asal_instansi">Asal Instansi</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </span>
                    <input type="text" name="asal_instansi" class="form-control" id="asal_instansi" autofocus required>
                  </div>  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="jabatan">Jabatan</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </span>
                    <input type="text" name="jabatan" class="form-control" id="jabatan" autofocus required>
                  </div>  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-5">
                    <label for="keterangan">Keterangan <span class="text-secondary">(*jika ada)</span></label>
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3"></textarea>
                  </div>
                </div>
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
<div class="modal fade" id="updatePenilai" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Update Penilai</h1>
          </div>
          <form action="{{ route('admin.penilai.update') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="penilai_id" id="penilai_id" value="xxx">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="name_edit">Nama Penilai</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input type="text" name="name_edit" class="form-control" id="name_edit" autofocus required>
                  </div>  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="asal_instansi_edit">Asal Instansi</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </span>
                    <input type="text" name="asal_instansi_edit" class="form-control" id="asal_instansi_edit" autofocus required>
                  </div>  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="jabatan_edit">Jabatan</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </span>
                    <input type="text" name="jabatan_edit" class="form-control" id="jabatan_edit" autofocus required>
                  </div>  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-5">
                    <label for="keterangan_edit">Keterangan <span class="text-secondary">(*jika ada)</span></label>
                    <textarea name="keterangan_edit" id="keterangan_edit" class="form-control" cols="30" rows="3"></textarea>
                  </div>
                </div>
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
<div class="modal fade" id="deletePenilai" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="h6 modal-title">Peringatan</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <svg class="icon icon-lg text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
          <p class="text-center mt-3">Jika kamu menekan Ya maka data penilai ini akan di hapus beserta dengan penilaiannya!</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="deleteIt()">Ya, Hapus Data</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Tidak</button>
        <form action="{{ route('admin.penilai.delete') }}" method="POST" class="d-none" id="f-delete-data">
          @csrf <input type="hidden" id="delete_penilai_id" name="delete_penilai_id" value="xxx">
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
    const elPenilaiId = document.getElementById('penilai_id')
    const elPenilaiName = document.getElementById('name_edit')
    const elInstansi = document.getElementById('asal_instansi_edit')
    const elJabatan = document.getElementById('jabatan_edit')
    const elKeterangan = document.getElementById('keterangan_edit')

    elPenilaiId.value = data.id
    elPenilaiName.value = data.nama_penilai
    elInstansi.value = data.asal_instansi
    elJabatan.value = data.jabatan
    elKeterangan.value = data.keterangan

    $('#updatePenilai').modal('show')
  }
  function deleteData(data) {
    const elPenilai = document.getElementById('delete_penilai_id')
    elPenilai.value = data

    $('#deletePenilai').modal('show')
  }
  function deleteIt() {
    const form = document.getElementById('f-delete-data')
    return form.submit()
  }
</script>
@endpush
