@extends('layouts.main')
@section('title', 'Materi Seleksi')
@section('materi', 'active')
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
          <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#openMateri">Tambah Materi</button>
        </div>
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0 rounded">
            <thead class="thead-light">
              <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0">Nama Materi</th>
                <th class="border-0">Keterangan</th>
                <th class="border-0 rounded-end"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($materis as $materi)
                <tr>
                  <th style="vertical-align: middle">{{ $loop->iteration }}</th>
                  <td class="fw-bold" style="vertical-align: middle">{{ $materi->nama_materi }}</td>
                  <td class="fw-bold" style="vertical-align: middle; width: 100%">{{ $materi->keterangan ? $materi->keterangan : '-' }}</td>
                  <td style="vertical-align: middle">
                    <button class="btn btn-sm btn-info" type="button" onclick="updateData({{ $materi }})">Update</button>
                    <button class="btn btn-sm btn-danger" type="button" onclick="deleteData({{ $materi->id }})">Delete</button>
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
<div class="modal fade" id="openMateri" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Tambah Materi</h1>
          </div>
          <form action="{{ route('admin.materi.post') }}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="name">Nama Materi</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </span>
                    <input type="text" name="name" class="form-control" id="name" autofocus required>
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
<div class="modal fade" id="updateMateri" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card p-3 p-lg-4">
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h4">Form Update Materi</h1>
          </div>
          <form action="{{ route('admin.materi.update') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="materi_id" id="materi_id" value="xxx">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group mb-2">
                  <label for="name_edit">Nama Materi</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </span>
                    <input type="text" name="name_edit" class="form-control" id="name_edit" autofocus required>
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
<div class="modal fade" id="deleteMateri" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="h6 modal-title">Peringatan</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <svg class="icon icon-lg text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
          <p class="text-center mt-3">Jika kamu menekan Ya maka data materi ini akan di hapus beserta dengan penilaiannya!</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="deleteIt()">Ya, Hapus Data</button>
        <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Tidak</button>
        <form action="{{ route('admin.materi.delete') }}" method="POST" class="d-none" id="f-delete-data">
          @csrf <input type="hidden" id="delete_materi_id" name="delete_materi_id" value="xxx">
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
    const elMateriId = document.getElementById('materi_id')
    const elMateriName = document.getElementById('name_edit')
    const elKeterangan = document.getElementById('keterangan_edit')

    elMateriId.value = data.id
    elMateriName.value = data.nama_materi
    elKeterangan.value = data.keterangan

    $('#updateMateri').modal('show')
  }
  function deleteData(data) {
    const elMateri = document.getElementById('delete_materi_id')
    elMateri.value = data

    $('#deleteMateri').modal('show')
  }
  function deleteIt() {
    const form = document.getElementById('f-delete-data')
    return form.submit()
  }
</script>
@endpush
