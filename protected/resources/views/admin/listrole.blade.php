@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>List Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i>List Role</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Role</h3>
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i>  Add Role</a>
                </div>

                <!-- addmodal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Role</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-element" method="POST" action="{{ URL::to("/addrole") }}">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 control-label">Role Name</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
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
                    </div>
                @endif

            <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            @php
                                $id = $role['id'];
                            @endphp
                            <tr>
                                <td>{{ $role['id'] }}</td>
                                <td>{{ $role['role'] }}</td>
                                @if($id != 1)
                                    <td><a href="#" data-toggle="modal" data-target="#myModal-{{ $role['id'] }}" style="font-size:12px;">edit</a>  <a href="{{ URL::to("/deleterole/$id") }}">delete</a></td>
                                @else
                                    <td></td>
                                @endif
                            </tr>

                            <div id="myModal-{{ $role['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Edit Role</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-element" method="POST" action="{{ URL::to("/editrole") }}">
                                                {{ csrf_field() }}
                                                <input type="text" name="id" value="{{ $role['id'] }}" hidden>
                                                <div class="box-body">
                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-3 control-label">Role Name</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="name" value="{{ $role['role'] }}" required autofocus>
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
                            <th>Id</th>
                            <th>Role</th>
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