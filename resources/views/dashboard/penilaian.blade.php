@extends('layouts.main')
@section('title', 'Form Penilaian')
@section('penilaian', 'active')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.rtl.min.css') }}">
@endpush

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
        <form action="{{ route('admin.penilaian.post') }}" method="POST">
          @csrf
          <div class="form-group mb-3">
            <label for="peserta">Peserta</label>
            <select name="peserta" id="peserta" class="form-control" onchange="">
              <option value="" selected hidden>Select Peserta</option>
              @foreach ($pesertas as $peserta)
                <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="materi">Materi</label>
            <select name="materi" id="materi" class="form-control" onchange="">
              <option value="" selected hidden>Select Materi</option>
              @foreach ($materis as $materi)
                <option value="{{ $materi->id }}">{{ $materi->nama_materi }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="ruang">Ruangan</label>
            <select name="ruang" id="ruang" class="form-control" onchange="">
              <option value="" selected hidden>Select Ruangan</option>
              @foreach ($ruangs as $ruang)
                <option value="{{ $ruang->id }}">{{ $ruang->nama_lokasi }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="penilai">Penilai</label>
            <select name="penilai" id="penilai" class="form-control" onchange="">
              <option value="" selected hidden>Select Penilai</option>
              @foreach ($penilais as $penilai)
                <option value="{{ $penilai->id }}">{{ $penilai->nama_penilai }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group mb-5">
            <label for="nilai">Nilai</label>
            <input type="number" class="form-control" name="nilai" id="nilai" required>
          </div>
          <div class="form-group">
            <button class="btn btn-secondary">Submit Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- <div class="modal fade" id="openMateri" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
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
                      <svg class="icon icon-xs text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
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
</div> --}}
@endsection

@push('js')
<script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('dist/js/select2.min.js') }}"></script>
<script>
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
    $("#materi").select2({
      theme: "bootstrap-5",
      dropdownParent: $("#materi").parent(),
      matcher: matchCustom
    });
    $("#ruang").select2({
      theme: "bootstrap-5",
      dropdownParent: $("#ruang").parent(),
      matcher: matchCustom
    });
    $("#penilai").select2({
      theme: "bootstrap-5",
      dropdownParent: $("#penilai").parent(),
      matcher: matchCustom
    });
  })
</script>
{{-- <script>
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
</script> --}}
@endpush
