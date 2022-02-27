@extends('layout.v_template')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Ikan</h3>
            <div class="container">
                @if (count($errors) > 0)
            <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
            </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
                </div>
            @endif
            </div>
            </div>
                <div class="text-center">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah" onClick="create()">Tambah Data</button>
                <a href="/dataikan/printer_dataikan" target="_blank" class="btn btn-sm bg-maroon">Print To Printer</a>
                <a href="/dataikan/printpdf_dataikan" target="_blank" class="btn btn-sm bg-navy">Print To PDF</a>
                </div>
            <div class="box-body" id="read">
            <table class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">Nama Ikan</th>
                <th class="text-center">Jenis Ikan</th>
                <th class="text-center">Harga Ikan</th>
                <th class="text-center">Stock Ikan</th>
                <th class="text-center">Dibuat</th>
                <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $item->nama_ikan}}</td>
                        <td class="text-center">{{ $item->jenis_ikan}}</td>
                        <td class="text-center">{{ $item->harga_ikan}}</td>
                        <td class="text-center">{{ $item->stock_ikan}}</td>
                        <td class="text-center">{{ $item->created_at}}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#detail{{ $item->id}}">Detail</a>
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{ $item->id}}">Edit</a>
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $item->id}}">Delete</a>
                        </td>
                    </tr>
                </div>
                @endforeach
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title" id="exampleModalDataikan">TAMBAH DATA</h5>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group" id="page">
                                <input name="nama_ikan" id="nama_ikan" class="form-control" value="{{old('nama_ikan')}}">
                                <div class="text-danger">
                                    @error('nama_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Ikan</label>
                                <input name="jenis_ikan" id="jenis_ikan" class="form-control" value="{{old('jenis_ikan')}}">
                                <div class="text-danger">
                                    @error('jenis_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Ikan</label>
                                <input name="harga_ikan" id="harga_ikan" class="form-control" value="{{old('harga_ikan')}}">
                                <div class="text-danger">
                                    @error('harga_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group" >
                                <label>Stock Ikan</label>
                                <input name="stock_ikan" id="stock_ikan" class="form-control" value="{{old('stock_ikan')}}">
                                <div class="text-danger">
                                    @error('stock_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onClick="store()">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
