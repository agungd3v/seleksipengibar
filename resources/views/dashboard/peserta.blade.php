@extends('layouts.main')
@section('title', 'Peserta')
@section('peserta', 'active')

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
          <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#openPeserta">Tambah Peserta</button>
        </div>
        <div class="table-responsive">
          <table class="table table-centered table-nowrap mb-0 rounded">
            <thead class="thead-light">
              <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0">Nama Peserta</th>
                <th class="border-0">Nomor Dada</th>
                <th class="border-0">Asal Sekolah</th>
                <th class="border-0">Alamat</th>
                <th class="border-0">Tinggi Badan</th>
                <th class="border-0 rounded-end">Berat Badan</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pesertas as $peserta)
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <td class="fw-bold">{{ $peserta->nama }}</td>
                  <td>{{ $peserta->nomor_dada }}</td>
                  <td>{{ $peserta->asal_sekolah }}</td>
                  <td>{{ $peserta->alamat }}</td>
                  <td>{{ $peserta->tinggi }}</td>
                  <td>{{ $peserta->berat }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="7">Data Not Found</td>
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
          <form action="{{ route('admin.peserta.post') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group mb-2">
              <label for="name">Nama Lengkap</label>
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                </span>
                <input type="text" name="name" class="form-control" placeholder="Bambang Subagio" id="name" autofocus required>
              </div>  
            </div>
            <div class="form-group">
              <div class="form-group mb-2">
                <label for="nomor">Nomor Dada</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon2">
                    <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                  </span>
                  <input type="number" name="nomor" placeholder="001" class="form-control" id="nomor" required>
                </div>  
              </div>
            </div>
            <div class="form-group">
              <div class="form-group mb-2">
                <label for="sekolah">Asal Sekolah</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon2">
                    <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                  </span>
                  <input type="text" name="sekolah" placeholder="SMA N 1 Metro" class="form-control" id="sekolah" required>
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
                      <span class="input-group-text" id="basic-addon2">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                      </span>
                      <input type="number" name="tinggi" placeholder="100" class="form-control" id="tinggi" required>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <div class="form-group mb-5">
                    <label for="berat">Berat Badan</label>
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon2">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                      </span>
                      <input type="number" name="berat" placeholder="100" class="form-control" id="berat" required>
                    </div>  
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
@endsection