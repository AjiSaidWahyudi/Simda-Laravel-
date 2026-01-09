@extends('layouts.rumah')

@section('content')
    <div class="card-custom">
        <div class="table-header mb-3">
            <h5>
                <i class="bi bi-file-earmark-text"></i>
                Cetak Laporan Inventaris
            </h5>
        </div>
        <form method="GET" action="{{ route('laporan.cetak') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label class="form-label">Jenis Barang</label>
                    <select name="kartu_ruang_id" class="form-select" required>
                        <option value="">Pilih Ruangan</option>
                        @foreach($ruangan as $r)
                            <option value="{{ $r->id }}">
                                {{ $r->nama_ruangan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 text-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </button>
                </div>
            </div>
        </form>

        @if(request()->has('jenis_barang') && isset($qr))
            <hr>

            <!-- INFO -->
            <div class="alert alert-info mt-3">
                @if($jenis_barang)
                    Scan QR berikut untuk membuka
                    <strong>laporan jenis barang: {{ $jenis_barang }}</strong>
                @else
                    Scan QR berikut untuk membuka
                    <strong>laporan seluruh data inventarisasi</strong>
                @endif
            </div>

            <!-- QR + ACTION -->
            <div class="text-center mt-3">
                <div class="qr-wrapper mb-3">
                    {!! $qr !!}
                </div>

                <a href="{{ $url }}"
                   target="_blank"
                   class="btn btn-primary">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Buka PDF
                </a>
            </div>
        @endif

    </div>
@endsection

{{-- <section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Inventarisasi</h3>
                </div>
                <div class="box-body">
                    <form method="GET" action="{{route('laporan.cetak')}}">
                        <div class="form-group">
                        <label for="jenis_barang">Pilih Jenis Barang</label>
                        <input type="text" name="jenis_barang" id="jenis_barang" class="form-control" value="{{ request('jenis_barang') }}" placeholder="Jika tidak mengetik barang, maka seluruh data akan muncul">
                        </div>
                        <button type="submit" class="btn btn-success">Cetak</button>
                    </form>

                    @if(request()->has('jenis_barang') && isset($qr))
                        <hr>

                        @if($jenis_barang)
                            <p>Scan QR di bawah untuk membuka laporan Jenis Barang:
                                <b>{{ $jenis_barang }}</b>
                            </p>
                        @else
                            <p>Scan QR di bawah untuk membuka
                                <b>laporan seluruh data inventarisasi</b>
                            </p>
                        @endif

                        <div>{!! $qr !!}</div>

                        <p>
                            <a href="{{ $url }}" target="_blank" class="btn btn-primary mt-3">Buka PDF</a>
                        </p>
                    @endif


                </div>
            </div>
        </div>
    </div>
</section> --}}