@extends('layout.app')

@section('content-header')
    <section class="content-header">
        <h1>
            Tokenomy
            <small>Setting</small>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-gear"></i>Agreement Setting</a></li>
        </ol>
    </section>
@endsection

@section('content')
    <div>
        <div class="ck-container">
            <div class="ck-width-100">
                <h2>Agreement Text: </h2>

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

                <form class="form-horizontal ck-width-100" method="POST" action="{{ URL::to("/agreement") }}">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <textarea id="editor" name="text" required>
                            {!! $introText->text !!}
                        </textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-block btn-flat margin-top-10 pull-right" style="font-size:15px">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('add-js')
    <!-- CK EDITOR -->
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/ckeditor/samples/js/sample.js') }}"></script>

    <script>
        initSample();
    </script>
@endsection