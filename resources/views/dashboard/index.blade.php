@extends('layouts.main')
@section('title', 'Dashboard')
@section('dashboard', 'active')

@section('content')
<div class="row">
  <div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border-0 shadow">
      <div class="card-body">
        <div class="row d-block d-xl-flex align-items-center">
          <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
              <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
            </div>
            <div class="d-sm-none">
              <h2 class="h5">Peserta</h2>
              <h3 class="fw-extrabold mb-1">{{ $peserta }}</h3>
            </div>
          </div>
          <div class="col-12 col-xl-7 px-xl-0">
            <div class="d-none d-sm-block">
              <h2 class="h6 text-gray-400 mb-0">Peserta</h2>
              <h3 class="fw-extrabold mb-2">{{ $peserta }}</h3>
            </div>
            <div class="small d-flex mt-1">                               
              <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg><span class="text-success fw-bolder">22%</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="row d-block d-xl-flex align-items-center">
                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <div class="d-sm-none">
                        <h2 class="fw-extrabold h5">Penilaian</h2>
                        <h3 class="mb-1">{{ $penilaian }}</h3>
                    </div>
                </div>
                <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                        <h2 class="h6 text-gray-400 mb-0">Penilaian</h2>
                        <h3 class="fw-extrabold mb-2">{{ $penilaian }}</h3>
                    </div>
                    <div class="small d-flex mt-1">                               
                        <div>Since last month <svg class="icon icon-xs text-danger" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg><span class="text-danger fw-bolder">2%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="row d-block d-xl-flex align-items-center">
                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="d-sm-none">
                        <h2 class="fw-extrabold h5">Nilai Rata - Rata</h2>
                        <h3 class="mb-1">{{ $rata_rata }}</h3>
                    </div>
                </div>
                <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                        <h2 class="h6 text-gray-400 mb-0">Nilai Rata - Rata</h2>
                        <h3 class="fw-extrabold mb-2">{{ $rata_rata }}</h3>
                    </div>
                    <div class="small d-flex mt-1">                               
                        <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg><span class="text-success fw-bolder">4%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection