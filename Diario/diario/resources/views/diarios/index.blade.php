@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @session('danger')
                        <div class="alert alert-danger" role="alert"> 
                            {{ $value }}
                        </div>
                    @endsession
                    @session('success')
                        <div class="alert alert-success" role="alert"> 
                            {{ $value }}
                        </div>
                    @endsession
                    @session('primary')
                        <div class="alert alert-primary" role="alert"> 
                            {{ $value }}
                        </div>
                    @endsession
                    @session('danger2')
                        <div class="alert alert-danger2" role="alert"> 
                            {{ $value }}
                        </div>
                    @endsession

                    <div id="notification">
                        
                    </div>
                
                    <div class="navbar-brand card-header text-center">Diario do Ribamar</div>
                    <div class="card-body">
                        <a href="{{ url('/diarios/create') }}" class="btn btn-success btn-sm" title="Add New Diario">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/diarios') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Dia</th><th>Texto</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
 
                                @foreach($diarios as $item)
                                    <tr>
                                        <td>{{ $item->dia }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->texto, 40, preserveWords: true) }}</td>
                                        <td>
                                            <a href="{{ url('/diarios/' . $item->id) }}" title="View Diario"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/diarios/' . $item->id . '/edit') }}" title="Edit Diario"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/diarios' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Diario" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!--
                            <div class="pagination-wrapper"> {!! $diarios->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        --> 
                        <div class="pagination-wrapper"> {!! $diarios->withQueryString()->links('pagination::bootstrap-5') !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
