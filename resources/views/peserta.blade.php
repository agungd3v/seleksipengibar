<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.rtl.min.css') }}">
    <title>Seleksi pengibar bendera</title>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <main class="bg-white">
        <section class="section-header overflow-hidden pt-7 pt-lg-8 pb-9 pb-lg-12 bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center h-50">
                        <div class="bootstrap-big-icon d-none d-lg-block">
                            <img src="{{ asset('img/content-bg.jpg') }}">
                        </div>
                        <h1 class="fw-bolder position-relative" style="z-index: 1">Seleksi Pengibar Bendera</h1>
                        <h2 class="lead fw-normal text-muted mb-5 position-relative" style="z-index: 1">Penilaian peserta seleksi 2021</h2>
                        <div class="d-flex align-items-center justify-content-center mb-5 position-relative" style="z-index: 1">
                            <a href="{{ route('index') }}" class="btn btn-secondary d-inline-flex align-items-center me-4">
                                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                                Halaman Awal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <figure class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n2"><svg class="home-pattern" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3000 185.4"><path d="M3000,0v185.4H0V0c496.4,115.6,996.4,173.4,1500,173.4S2503.6,115.6,3000,0z"></path></svg></figure>
        </section>
        <section class="section section-lg bg-white pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12"></div>
                    <div class="col-md-6 col-sm-12 mb-3 mt-5">
                        <div class="d-flex align-items-center" style="gap: 10px">
                            <div class="form-group" style="flex: 1">
                                <select name="peserta" id="peserta" class="form-control" onchange="selectedPeserta(this)">
                                    <option value="" selected hidden>Select Peserta</option>
                                    @foreach ($penilaians as $peserta)
                                        @if ($peserta->penilaian != null)
                                            <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0 rounded" id="table_penilaian">
                                <thead class="thead-light">
                                    <tr>
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
                                <tbody id="item_default">
                                    @foreach ($penilaians as $penilaian)
                                        @if ($penilaian->penilaian != null)
                                            <tr style="cursor: pointer">
                                                <td class="fw-bold">
                                                    {{ $penilaian->nama }}
                                                    <b class="text-secondary">( {{ $penilaian->asal_sekolah }} )</b>
                                                </td>
                                                <td class="text-center">{{ $penilaian->penilaian->lari_total }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->lari_meter }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->b_inggris_aula }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->b_inggris_r_bapak }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->agama_aula }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->agama_r_bapak }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->pbb_aula }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->pbb_r_bapak }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->seni_budaya_aula }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->seni_budaya_r_bapak }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->pengetahuan_aula }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->pengetahuan_r_bapak }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->jumlah }}</td>
                                                <td class="text-center">{{ $penilaian->penilaian->rata_rata }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="{{ asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('js/volt.js') }}"></script>

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
            $("select").select2({
                theme: "bootstrap-5",
                dropdownParent: $("select").parent(),
                matcher: matchCustom
            });
        })
        function selectedPeserta(data) {
            const tablePenilaian = document.getElementById('table_penilaian')
            const tbodyDefault = document.getElementById('item_default')

            if (tablePenilaian.querySelector('#item_result')) {
                tablePenilaian.querySelector('#item_result').remove()
            }

            if (data.value != '') {
                fetch('/api/select_peserta', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: data.value })
                }).then(res => res.json()).then(data => {
                    if (data.status) {
                        const peserta = data.message
                        tbodyDefault.classList.add('d-none')

                        tablePenilaian.innerHTML += `
                            <tbody id="item_result">
                                <tr style="cursor: pointer">
                                    <td class="fw-bold">
                                        ${peserta.nama}
                                        <b class="text-secondary">( ${peserta.asal_sekolah} )</b>
                                    </td>
                                    <td class="text-center">${peserta.penilaian.lari_total}</td>
                                    <td class="text-center">${peserta.penilaian.lari_meter}</td>
                                    <td class="text-center">${peserta.penilaian.b_inggris_aula}</td>
                                    <td class="text-center">${peserta.penilaian.b_inggris_r_bapak}</td>
                                    <td class="text-center">${peserta.penilaian.agama_aula}</td>
                                    <td class="text-center">${peserta.penilaian.agama_r_bapak}</td>
                                    <td class="text-center">${peserta.penilaian.pbb_aula}</td>
                                    <td class="text-center">${peserta.penilaian.pbb_r_bapak}</td>
                                    <td class="text-center">${peserta.penilaian.seni_budaya_aula}</td>
                                    <td class="text-center">${peserta.penilaian.seni_budaya_r_bapak}</td>
                                    <td class="text-center">${peserta.penilaian.pengetahuan_aula}</td>
                                    <td class="text-center">${peserta.penilaian.pengetahuan_r_bapak}</td>
                                    <td class="text-center">${peserta.penilaian.jumlah}</td>
                                    <td class="text-center">${peserta.penilaian.rata_rata}</td>
                                </tr>
                            </tbody>
                        `
                    }
                }).catch(err => {
                    console.error(err)
                })
            } else {
                tbodyDefault.classList.remove('d-none')
            }
        }
    </script>
</body>
</html>