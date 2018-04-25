@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Configurations</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/configurations/create') }}" class="btn btn-success btn-sm" title="Add New Configuration">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/configurations', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Path</th><th>Value</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($configurations as $configuration)
                                    <tr>
                                        <td>{{ $configuration->id }}</td>
                                        <td><a href="{{ url('/admin/configurations', $configuration->id) . '/edit'}} ">{{ $configuration->path }}</a></td>
                                        <td>{{ $configuration->value }}</td>
                                        <td>
                                            <a href="{{ url('/admin/configurations/' . $configuration->id) }}" title="View Configuration">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/admin/configurations/' . $configuration->id . '/edit') }}" title="Edit Configuration">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/configurations', $configuration->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Configuration',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination"> {!! $configurations->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
