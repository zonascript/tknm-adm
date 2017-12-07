@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>List Permission</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i>List Permission</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Role</h3>
                </div>

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

                <div class="col-md-3" style="margin:auto">
                    <p class="col-md-12 text-center" style="margin:0px"><b>Role:</b></p>
                    <select class="form-control col-md-12" name="role" onchange="myFunction()" id="role-selected">
                        @foreach($roles as $role)
                            @if($role->id != 1)
                                @if($role_id == $role->id)
                                    <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- /.box-header -->
                <div class="box-body col-md-5" style="margin: auto">
                    <table id="example1" class="table table-bordered table-responsive permission-table">
                        <thead>
                        <tr>
                            <th class="text-center">Level 1</th>
                            <th class="text-center">Level 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            @php
                                $menu_id = $menu['id'];
                                $childCount = count($menu['child']);
                            @endphp
                            <tr>
                                @if($menu['permitted'])
                                    <td rowspan="{{ $childCount }}" style="vertical-align: middle"><a class="btn btn-primary" href="{{ URL::to("/deletepermission/$role_id/$menu_id") }}">{{ $menu['name'] }}</a></td>
                                @else
                                    <td rowspan="{{ $childCount }}" style="vertical-align: middle"><a class="btn btn-danger" href="{{ URL::to("/grantpermission/$role_id/$menu_id") }}">{{ $menu['name'] }}</a></td>
                                @endif

                                @foreach($menu['child'] as $child)
                                    <td>
                                    @php
                                        $child_id = $child['id'];
                                    @endphp
                                    @if($child['permitted'])
                                        <a class="btn btn-primary" href="{{ URL::to("/deletepermission/$role_id/$child_id") }}">{{ $child['name'] }}</a>
                                    @else
                                        <a class="btn btn-danger" href="{{ URL::to("/grantpermission/$role_id/$child_id") }}">{{ $child['name'] }}</a>
                                    @endif
                                    </td></tr><tr>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">Level 1</th>
                            <th class="text-center">Level 2</th>
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
    <script>
        function myFunction(){
            var x = document.getElementById("role-selected").value;

            window.location = "{{ URL::to("/permission") }}" + "/" + x;
        }
    </script>
@endsection