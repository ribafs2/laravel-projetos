@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Diario #{{ $diario->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/diarios') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/diarios/' . $diario->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('diarios.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<style>
	.ck-editor__editable_inline {
		min-height: 150px;
		font-size: 18px;
		line-height: 1.0;		
	}
	</style>
    
    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('textarea'));	
            //https://medium.com/@tutsmake.com/laravel-11-integrate-and-use-ckeditor-5-tutorial-ceac8e1328ac
    </script> 
    
@endsection
