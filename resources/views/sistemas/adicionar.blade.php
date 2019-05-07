@extends('adminlte::page')

@section('content')
    <section class="content">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastro de Sistema</h3>
                    </div>
                    <!-- /.box-header -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                @endif
                <!-- form start -->
                    <form role="form" method="post" action="{{action('SistemaController@store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nome do Sistema</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="name" placeholder="Ajuri">
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="time">Descrição</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="far fa-list-alt"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="description" placeholder="Sistema comercial ajuri">
                                    </div>
                                </div>
                            <div class="form-group">
                                <label>IP da Aplicação</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fas fa-server"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="app_ip" placeholder="10.2.1.11">
                                </div>
                            </div>
                                <div class="form-group">
                                    <label>Usuário da Aplicação</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="app_user" placeholder="user_app">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Senha Aplicação</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-key"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="app_pass" placeholder="q1w2e3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="time">IP do Banco</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-database"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="db_ip" placeholder="10.2.1.11">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Usuário do Banco</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="db_user" placeholder="user_db">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Senha do Banco</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-key"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" name="db_pass" placeholder="q1w2e3">
                                    </div>
                                </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
@endsection()




