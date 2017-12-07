@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>List Members</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i>List Members</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Members</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member['name'] }}</td>
                                <td>{{ $member['email'] }}</td>
                                <td>{{ $member['phone'] }}</td>
                                <td>{{ $member['address'] }}</td>
                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $member['id'] }}">Details</button></td>
                            </tr>
                            <!-- modal -->
                            <div id="myModal-{{ $member['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Member Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Name</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['name'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Email</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['email'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Phone</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['phone'] }} | {{ $member['verified_phone'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Country</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['country'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Address</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['address'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Zipcode</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['zipcode'] }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4" style="float: left">Referral Code</p>
                                                <p class="col-md-8" style="float: left">: {{ $member['referral_code'] }}</p>
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
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