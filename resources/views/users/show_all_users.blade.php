@extends('app')

@section('header-styles')

@stop

@section('main-section')
<div class="table-responsive" id="app">
    <table class="table table-responsive table-bordered table-striped" id="users_data">
        <thead class="bg-primary text-center">
        <th data-column-id = "id" data-visible="false">ID</th>
        <th data-column-id="s_no">S.No</th>
        <th data-column-id="user_name">User Name</th>
        <th data-column-id="email">Email</th>
        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Edit / Delete</th>
        </thead>
        <tbody id="users">
        <?php
            $i = 1;
        ?>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$i++}}</td>
            <td>{{$user->user_name}}</td>
            <td>{{$user->email}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <div class="clearfix"></div>
<div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_form">
                    <input type="hidden" id="user_id" value="">
                <div class="form-group">
                    <label for="user_name">User Name:*</label>
                    <input class="form-control" name="user_name" id="user_name" value="">
                    <span class="help-block user_name text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="user_name">Email:*</label>
                    <input class="form-control" name="email" id="email" value="">
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_save">Save changes</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer-scripts')
<script>
    $(document).ready(function () {
        var grid = $("#users_data").bootgrid({
            formatters: {
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-xs btn-default col-md-offset-4 command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> "+
                        "<button type=\"button\" class=\"btn btn-xs btn-default  command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash\"></span></button>";
                },
            }
        }).on("loaded.rs.jquery.bootgrid", function()
        {
            /* Executes after data is loaded and rendered */
            grid.find(".command-edit").on("click", function(e)
            {
                var id = $(this).data("row-id");
                var route = "{{route('user.get_user',':id')}}";
                route = route.replace(":id",id);
                $.ajax({
                   url:route,
                   dataType:'JSON',
                   type:'GET',
                    complete:function (jqXHR,textStatus) {
                        if(jqXHR.status == 200) {
                            var result = JSON.parse(jqXHR.responseText);

                            if(result.hasOwnProperty('success')) {
                                var user = result.user;
                                $("#user_name").val(user.user_name);
                                $("#email").val(user.email);
                                $("#user_id").val(user.id);
                                $("#user_modal").modal();

                            } else if(result.hasOwnProperty('error')){
                                toastr.error(result.msg);
                            }
                        } else{
                            toastr.error("Contact Admin "+jqXHR.status);
                        }
                    }
                });
                $("#btn_save").click(function (jqXHR,textStatus) {
                    $(".help-block").html("");
                    var data = $("#user_form").serializeArray();
                    var route = "{{route('user.update_user',':id')}}";
                    var user_id = $("#user_id").val();
                    route = route.replace(":id",user_id);
                    $.ajax({
                        url:route,
                        data:data,
                        dataType:'JSON',
                        type:'POST',
                        complete:function (jqXHR,textStatus) {
                            if(jqXHR.status == 200) {
                                var result = JSON.parse(jqXHR.responseText);
                                if(result.hasOwnProperty('success')) {
                                    $("#user_modal").modal('hide');
                                    toastr.success(result.msg);
                                } else if(result.hasOwnProperty('error')) {
                                    toastr.error(result.msg);
                                }
                            } else{
                                switch (jqXHR.status) {
                                    case 422:
                                        var result = JSON.parse(jqXHR.responseText);
                                        $.each(result.errors,function (key,error) {
                                           $("."+key).html(error[0]);
                                        });
                                        break;
                                    default:
                                        toastr.error("Contact Admin "+jqXHR.status);
                                }
                            }
                        }
                    });
                });

            }).end().find(".command-delete").on("click", function(e)
            {
                var id = $(this).data("row-id");

            });

        });
    });
</script>
@stop


