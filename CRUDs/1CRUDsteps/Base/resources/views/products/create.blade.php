<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Product</div>
                    <div class="card-body">
                        <a href="{{ url('/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/products') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

							<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
								<label for="name" class="control-label">{{ 'Name' }}</label>
								<input class="form-control" name="name" type="text" id="name" value="" >
								{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
								<label for="price" class="control-label">{{ 'Price' }}</label>
								<input class="form-control" name="price" type="number" id="price" value="" >
								{!! $errors->first('price', '<p class="help-block">:message</p>') !!}
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" value="{{ 'Create' }}">
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

