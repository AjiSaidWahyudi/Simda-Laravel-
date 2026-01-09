@extends('layouts.rumah')

@section('content')
    <div class="card-custom mt-4">
        <h5 class="mb-3">Tambah Ruangan</h5>
        <form action="{{route('kir.store')}}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Kode Ruangan</label>
                    <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" placeholder="Masukkan Kode Ruangan" value="{{$ruangan->kode_ruangan}}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Ruangan</label>
                    <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" placeholder="Masukkan Nama Ruangan" value="{{$ruangan->nama_ruangan}}">
                </div>
                
                <div class="col-12 text-end mt-3">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

{{-- <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah KIR</h3>
                    </div>
                    <form action="{{route('kir.store')}}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="kode_ruangan">Kode Ruangan</label>
                                        <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" placeholder="Masukkan Kode Ruangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_ruangan">Nama Ruangan</label>
                                        <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" placeholder="Masukkan Nama Ruangan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>       
    </section> --}}