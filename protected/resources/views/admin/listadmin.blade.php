@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>List Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i>List Admin</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Admin</h3>
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i>  Add Admin</a>
                </div>

                <!-- addmodal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-element" method="POST" action="{{ URL::to("/addadmin") }}">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 control-label">Name</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 control-label">Email</label>

                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-4 control-label">Password</label>

                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-4 control-label">Re-type Password</label>

                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="role" class="col-sm-4 control-label">Role</label>

                                            <div class="col-sm-8">
                                                <select class="form-control" name="role">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            @php
                                $id = $admin['id'];
                            @endphp
                            <tr>
                                <td>{{ $admin['name'] }}</td>
                                <td>{{ $admin['email'] }}</td>
                                <td>{{ $admin['role'] }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#myModal-{{ $admin['id'] }}" style="font-size:12px;">edit</a>  <a href="{{ URL::to("/deleteadmin/$id") }}" style="font-size:12px;">delete</a></td>
                            </tr>
                            <!-- modal -->
                            <div id="myModal-{{ $admin['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Edit Admin</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal form-element" method="POST" action="{{ URL::to("/editadmin") }}">
                                                {{ csrf_field() }}
                                                <div class="box-body">
                                                    <input type="text" name="id" value="{{ $admin['id'] }}" hidden>
                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-2 control-label">Name</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="name" value="{{ $admin['name'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-2 control-label">Email</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="email" value="{{ $admin['email'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="role" class="col-sm-2 control-label">Role</label>

                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="role">
                                                                @foreach($roles as $role)
                                                                    @if($admin['role_id'] == $role->id)
                                                                        <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                                                    @else
                                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
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
                            <th>Name</th>
                            <th>Email</th>
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