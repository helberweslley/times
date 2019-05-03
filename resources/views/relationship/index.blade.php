@extends('adminlte::page')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Relacionamento
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Relacionamento</a></li>
            <li class="active">Listar</li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div><br/>
                @endif
            </div>
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Lista de Relacionamentos</h3>
                        <div class="box-tools">
                            <p class="pull-right">
                                <a href="{{action('RelationshipController@create')}}"
                                   class="btn btn-success btn-sm ad-click-event">
                                    <i class="fa fa-fw fa-plus"> </i> Novo Relacionamento
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>#</th>
                                <th>Fonte</th>
                                <th>Alvo</th>
                            </tr>

                            @foreach ($relationships as $relationship)
                                <tr>
                                    <td>{{$relationship->id}}</td>
                                    <td>{{$relationship->source->name}}</td>
                                    <td>{{$relationship->target->name}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        {!! $relationships->links() !!}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    </section>
@endsection()