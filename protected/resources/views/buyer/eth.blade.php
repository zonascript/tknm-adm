@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>List Buyers ETH</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i>List Buyers ETH</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Buyers ETH</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Ethereum Wallet</th>
                            <th>Ethereum Wallet Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buyers as $buyer)
                            <tr>
                                <td>{{ $buyer['name'] }}</td>
                                <td>{{ $buyer['wallet'] }}</td>
                                <td>{{ $buyer['eth_address'] }}</td>
                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $buyer['id'] }}">Details</button></td>
                            </tr>

                            <!-- modal -->
                            <div id="myModal-{{ $buyer['id'] }}" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">Buyer Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Name</p>
                                                <p class="col-md-8" style="float: left">: {{ $buyer['name'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Ethereum Wallet</p>
                                                <p class="col-md-8" style="float: left">: {{ $buyer['wallet'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Ethereum Address</p>
                                                <p class="col-md-8" style="float: left">: {{ $buyer['eth_address'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Payment Address</p>
                                                <p class="col-md-8" style="float: left">: {{ $buyer['payment_address'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Refund Address</p>
                                                <p class="col-md-8" style="float: left">: {{ $buyer['refund'] }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
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
                            <th>Name</th>
                            <th>Ethereum Wallet</th>
                            <th>Ethereum Wallet Address</th>
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