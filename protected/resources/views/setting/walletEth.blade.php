@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>List Wallet Ethereum</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-gear"></i>List Wallet Ethereum</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Wallet Ethereum</h3>
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i>  Add Wallet</a>
                </div>

                <!-- addmodal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Wallet</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-element" method="POST" action="{{ URL::to("/addwalleteth") }}">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <label for="wallet-name" class="col-sm-4 control-label">Wallet Name</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="wallet-name" value="{{ old('wallet-name') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="display-name" class="col-sm-4 control-label">Display Name</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="display-name" value="{{ old('display-name') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Add</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- addmodal end -->

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-error">
                        {{ session('fail') }}
                        @if($errors)
                            <br/>
                            <strong>{{ $errors->first() }}</strong>
                        @endif
                    </div>
            @endif

            <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Wallet Name</th>
                            <th>Display Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listWallet as $wallet)
                            @php
                                $id = $wallet->id;
                            @endphp
                            <tr>
                                <td>{{ $wallet->wallet_name }}</td>
                                <td>{{ $wallet->display_name }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#myModal-{{ $wallet->id }}" style="font-size:12px;">edit</a>  <a href="{{ URL::to("/deletewalleteth/$id") }}" style="font-size:12px;">delete</a></td>
                            </tr>
                            <!-- modal -->
                            <div id="myModal-{{ $wallet->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Edit Wallet</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal form-element" method="POST" action="{{ URL::to("/editwalleteth") }}">
                                                {{ csrf_field() }}
                                                <div class="box-body">
                                                    <input type="text" name="id" value="{{ $wallet->id }}" hidden>
                                                    <div class="form-group row">
                                                        <label for="wallet-name" class="col-sm-2 control-label">Wallet Name</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="wallet-name" value="{{ $wallet->wallet_name }}" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="display-name" class="col-sm-2 control-label">Display Name</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="display-name" value="{{ $wallet->display_name }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-info pull-right">Save</button>
                                                </div>
                                                <!-- /.box-footer -->
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Wallet Name</th>
                            <th>Display Name</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>


@endsection

@section('add-js')
    <script src="{{ asset('/assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dashboard/pages/data-table.js') }}"></script>
@endsection