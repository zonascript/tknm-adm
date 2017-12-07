@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>Config ICO</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-gear"></i>Config ICO</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Config ICO</h3>
                </div>

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
                            <th>Config Name</th>
                            <th>Display Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Token Sell</th>
                            <th>Price (Token/BTC)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listConfig as $config)
                            @php
                                $id = $config->id;
                                $startdate = date('d M Y H:i:s',$config->start_date);
                                $enddate = date('d M Y H:i:s',$config->end_date);
                                $price = floor(1 / $config->price_token);
                            @endphp
                            <tr>
                                <td>{{ $config->config_name }}</td>
                                <td>{{ $config->display_name }}</td>
                                <td>{{ $startdate }}</td>
                                <td>{{ $enddate }}</td>
                                <td>{{ $config->total_token_sell }}</td>
                                <td>{{ $price }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#myModal-{{ $config->id }}" style="font-size:12px;">edit</a></td>
                            </tr>
                            <!-- modal -->
                            <div id="myModal-{{ $config->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Edit Config</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal form-element" method="POST" action="{{ URL::to("/editconfigico") }}">
                                                {{ csrf_field() }}
                                                <div class="box-body">
                                                    <input type="text" name="id" value="{{ $config->id }}" hidden>
                                                    <div class="form-group row">
                                                        <label for="config-name" class="col-sm-4 control-label">Config Name</label>

                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="config-name" value="{{ $config->config_name }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="display-name" class="col-sm-4 control-label">Display Name</label>

                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="display-name" value="{{ $config->display_name }}" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="startdate" class="col-sm-4 control-label">Start Date</label>

                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="startdate" value="{{ $startdate }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="enddate" class="col-sm-4 control-label">End Date</label>

                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="enddate" value="{{ $enddate }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="totalsell" class="col-sm-4 control-label">Total Token Sell</label>

                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" name="totalsell" value="{{ $config->total_token_sell }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="price" class="col-sm-4 control-label">Price (Token/BTC)</label>

                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" name="price" value="{{ $price }}" required>
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
                            <th>Config Name</th>
                            <th>Display Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Token Sell</th>
                            <th>Price (BTC)</th>
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