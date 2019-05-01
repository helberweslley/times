@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastro de Disciplinas</h3>
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
                <form role="form" method="get" name="FormJogos" action="{{action('JogoController@store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <select name="casa_id" id="casa_id" class="form-control">
                                <option value="" selected>Selecione o time da casa</option>
                                @foreach ($times->all() as $time)
                                    <option value={{$time->id}}>{{$time->name}}</option>
                                @endforeach
                            </select>
                            <select name="visitante_id" id="visitante_id" class="form-control">
                                <option value="" selected>Selecione o time visitante</option>
                                @foreach ($times->all() as $time)
                                    <option value={{$time->id}}>{{$time->name}}</option>
                                @endforeach
                            </select>
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

<script>
    jQuery(document).ready(function($)  {
        $("#casa_id").change(function (e) {
            var $input = $( this );
            var url_id = $input.attr("id");

            console.log("Id: " + $input.attr("id") + " Value: " + $input.val() + " url_id: " + url_id);


            e.preventDefault();
            $.ajax({
                type: "get",
                url: "/partida/" + $input.val(),
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                //data : $(this).serialize(),
                data: {"id": $input.val(), _method: 'partida'},
                success: function (data) {
                    console.log("success yes");

                    //$("#url" + url_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

    $( "#delete" ).on( "click", function() {
        $("input:checkbox:checked").each(function () {
            var $input = $( this );
            console.log("Id: " + $input.attr("id") + " Value: " + $input.val());

            var url_id = $input.attr("id");

            $.ajax({
                type: "post",
                url: '/users/albums/destroy/' + url_id,
                data: {"id": url_id , _method: 'delete'},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log("success yes");

                    //$("#url" + url_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection()