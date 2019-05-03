@extends('adminlte::page')

@section('content')
    <style>

        .link {
            fill: none;
            stroke: #666;
            stroke-width: 1.5px;
        }

        #licensing {
            fill: green;
        }

        .link.licensing {
            stroke: green;
        }

        .link.resolved {
            stroke-dasharray: 0,2 1;
        }

        circle {
            fill: cornflowerblue;
            stroke: darkblue;
            stroke-width: 1.5px;
        }

        text {
            font: 18px sans-serif;
            pointer-events: none;
            text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
        }

    </style>
    <section class="content container-fluid">
        <div class="row">
                <div class="col-lg-9">
                    <svg id="teste" viewBox="700 300 800 600"></svg>
                </div>
            <div class="col-md-3" id="resposta">

            </div>
        </div>
    </section>


         <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
        <script src="//d3js.org/d3.v3.min.js"></script>
        <script>
            var links;

            jQuery(document).ready(function($)  {
                $.ajax({
                    type: "get",
                    url: "/partida/",
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    //data : $(this).serialize(),
                    data: {"id": 1, _method: 'partida'},
                    success: function (data) {
                        links = data;
                        var nodes = {};

                        // Compute the distinct nodes from the links.
                        links.forEach(function(link) {
                            link.source = nodes[link.source] || (nodes[link.source] = {name: link.source});
                            link.target = nodes[link.target] || (nodes[link.target] = {name: link.target});
                        });

                        var width = 1920,
                            height = 1080;

                        var force = d3.layout.force()
                            .nodes(d3.values(nodes))
                            .links(links)
                            .size([width, height])
                            .linkDistance(100)
                            .charge(-400)
                            .on("tick", tick)
                            .start();

                        var svg = d3.select("#teste").append("svg")
                            .attr("width", width)
                            .attr("height", height);


                        // Per-type markers, as they don't inherit styles.
                        svg.append("defs").selectAll("marker")
                            .data(["suit", "licensing", "resolved"])
                            .enter().append("marker")
                            .attr("id", function(d) { return d; })
                            .attr("viewBox", "0 -5 10 10")
                            .attr("refX", 15)
                            .attr("refY", -1.5)
                            .attr("markerWidth", 8)
                            .attr("markerHeight", 8)
                            .attr("orient", "auto")
                            .append("path")
                            .attr("d", "M0,-5L10,0L0,5");

                        var path = svg.append("g").selectAll("path")
                            .data(force.links())
                            .enter().append("path")
                            .attr("class", function(d) { return "link " + d.type; })
                            .attr("marker-end", function(d) { return "url(#" + d.type + ")"; });

                        var circle = svg.append("g").selectAll("circle")
                            .data(force.nodes())
                            .enter().append("circle")
                            .attr("r", 8)
                            .call(force.drag);

                        var text = svg.append("g").selectAll("text")
                            .data(force.nodes())
                            .enter().append("text")
                            .attr("x", 10)
                            .attr("y", 0)
                            .text(function(d) { return d.name; });

                        // Use elliptical arc path segments to doubly-encode directionality.
                        function tick() {
                            path.attr("d", linkArc);
                            circle.attr("transform", transform);
                            text.attr("transform", transform);
                        }

                        function linkArc(d) {
                            var dx = d.target.x - d.source.x,
                                dy = d.target.y - d.source.y,
                                dr = Math.sqrt(dx * dx + dy * dy);
                            return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
                        }

                        function transform(d) {
                            return "translate(" + d.x + "," + d.y + ")";
                        }

                        var teste = d3.selectAll('svg circle').on('click', function () {
                            var nome = this.__data__.name;
                            data.forEach(function(re) {
                                if (re.source.name ==  nome){
                                    document.getElementById("resposta").innerHTML = '<div class="box box-success box-solid">' +
                                        '                    <div class="box-header with-border">' +
                                        '                        <h3 class="box-title">Informações</h3>' +
                                        '                        <div class="box-tools pull-right">' +
                                        '                        </div>' +
                                        '                    </div>' +
                                        '                    <div class="box-body">' +
                                        '<ul>'+
                                        '<li>'+'Nome: '+re.source.name +'</li>'+
                                        '<li>'+'Descrição: '+re.description_s +'</li>'+
                                        '<li>'+'IP: '+re.app_ip_s +'</li>'+
                                        '<li>'+'Usuário: '+re.app_user_s +'</li>'+
                                        '<li>'+'Senha: '+re.app_pass_s +'</li>'+
                                        '</ul>'+
                                        '                    </div>' +
                                        '                </div>';
                                }
                                if (re.target.name ==  nome){
                                    document.getElementById("resposta").innerHTML = '<div class="box box-success box-solid">' +
                                        '                    <div class="box-header with-border">' +
                                        '                        <h3 class="box-title">Informações</h3>' +
                                        '                        <div class="box-tools pull-right">' +
                                        '                        </div>' +
                                        '                    </div>' +
                                        '                    <div class="box-body">' +
                                        '<ul>'+
                                        '<li>'+'Nome: '+re.target.name +'</li>'+
                                        '<li>'+'Descrição: '+re.description_t +'</li>'+
                                        '<li>'+'IP: '+re.app_ip_t +'</li>'+
                                        '<li>'+'Usuário: '+re.app_user_t +'</li>'+
                                        '<li>'+'Senha: '+re.app_pass_t +'</li>'+
                                        '</ul>'+
                                        '                    </div>' +
                                        '                </div>';
                                }
                            });
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        </script>

    </section>
@endsection()