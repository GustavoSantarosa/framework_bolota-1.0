$(document).ready(function() {
    $("#data-table").DataTable( {
        bdestroy: true,
        paging: true,
        responsive: true,
        lengthChange: true,
        iDisplayLength: 15,
        searching: true,
        ordering: true,
        info: true,
        dom: "Bfrtip",
        buttons: [
            {
                extend: "pdfHtml5",
                download: "open",
                exportOptions: {
                    columns: ":visible"
                },
            }, 
            {
                extend: "excelHtml5",
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets["sheet1.xml"];
    
                    $("row c[r^='C']", sheet).attr( "s", "2" );
                }
            },
            {
                extend: "colvis",
                text: "Col Visiveis"
            }, 
            {
                text: "Inserir",
                action: function ( e, dt, node, config ) {
                    load_view("inserirIncidente", "");
                }
            }
        ],
        aaSorting: [[1, "asc"]],
        oLanguage:{
            sLengthMenu: "Mostrar _MENU_ registros por página",
            sZeroRecords: "Nenhum registro encontrado",
            sInfo: "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
            sInfoEmpty: "Mostrando 0 / 0 de 0 registros",
            sInfoFiltered: "(filtrado de _MAX_ registros)",
            sSearch: "Pesquisar: ",
            oPaginate: {
                sFirst: "Início",
                sPrevious: "Anterior",
                sNext: "Próximo",
                sLast: "Último"
            }
        },
        autoWidth: false,
        stateSave: true
    } );
} );
$.extend($.fn.dataTable.defaults, { responsive: true } ); 

$(function() {//AJAX FORM
    $('form[id="ajax_form"]').submit(function(event){
        event.preventDefault();
        $("#submit").html("Aguarde...");
        $("#submit").prop("disabled", true);

        var action = document.getElementById("action").value;
        CKEDITOR.instances["conteudo"].updateElement();
        var formulario = document.getElementById("ajax_form");
        var formData = new FormData(formulario);


        $.ajax({
        url: "modulos/Admin/incidentes/?controle=incidente&acao="+action,
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,  
        contentType: false,
        success: function(result){
                var url = "modulos/Admin/incidentes/?controle=incidente&acao=listarIncidente";
                $.get(url, function(dataReturn)
                {
                    $("#load_pagina").html(dataReturn);
                    $("#msg").replaceWith(result);
                    $("#msg").fadeIn("fast");
                    $("#msg").fadeOut(5000);
                });
            }
        });
    });
});


function load_view(action, in_con, modal=false, script=false)
{
    if(in_con){in_con = "&in_con="+in_con;}
    var url = "modulos/Admin/incidentes/?controle=incidente&acao="+action+in_con;
    $.get(url, function(dataReturn)
    {
        if(modal){
            $("#load_modal").html(dataReturn);
        }
        if(script){
            $("#load_script").html(dataReturn);
        }
        if((!modal) && (!script)){
            $("#load_pagina").html(dataReturn);
        }
    });
}

function RemoveTableRow(item){
    var tr = $(item).closest('tr');
    tr.fadeOut(400, function(){
        tr.remove();  
    });

    return false;
}

function soma_quantidade() {
    var total = 0;
    $('input[name="quantidade_receitaprocesso[]"]').each(function(){
        total = total + Number($(this).val());  
    });
    $('#total_quantidade').val(total);
}

function AddTableRow(){
    var newRow = $('<tr>');
    var cols = '';
    
    cols += "<td class='btnrem_prod'>";
    cols += "<center><button class='btn btn-default btn-xs' onclick='RemoveTableRow(this)' type='button'><i class='glyphicon glyphicon-trash'></i></button></center>";
    cols += "</td>";
    
    cols += "<td><input type='text' class='form-control' name='etapa_receitaprocesso[]' id='etapa_receitaprocesso' maxlength='40'  required></td>";
    cols += "<td><input type='text' class='form-control' name='titulo_receitaprocesso[]' id='titulo_receitaprocesso' maxlength='40'  required></td>";
    cols += "<td><input type='text' class='form-control' name='descricao_receitaprocesso[]' id='descricao_receitaprocesso' maxlength='255'></td>";
    cols += "<td><div class='input-group'><span class='input-group-addon'>%</span>";
    cols += "<input type='number' class='form-control' name='quantidade_receitaprocesso[]' step='0.0001' onblur='soma_quantidade()'>";
    cols += "</div></td>";
    cols += "<td><input type='number' class='form-control' name='ordem_receitaprocesso[]' id='ordem_receitaprocesso' maxlength='10'  required></td>";

    newRow.append(cols);
    $("#table").append(newRow);
    $(document).ready(function() { $(".select2").select2();});
    
    return false;
}	