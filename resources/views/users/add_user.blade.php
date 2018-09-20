@extends('app')


@section('header-styles')

@stop

@section('main-section')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$page_heading}} Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="add_user_form" class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="user_name" name="user_name" class="form-control col-md-7 col-xs-12" placeholder="User Name">
                            </div>
                            <span class="help-block text-danger user_name col-md-offset-2"></span>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email :<span class="required"> *</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" placeholder="Email">
                            </div>
                            <span class="help-block text-danger email col-md-offset-2"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password : <span class="required"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" class=" form-control col-md-7 col-xs-12" name="password" type="password" placeholder="Password">
                            </div>
                            <span class="help-block text-danger password col-md-offset-2"></span>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="button" id="add_user" class="btn btn-success">Add User</button>
                                <span id="ajax_loader"></span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer-scripts')
<script>
    $(document).ready(function(e) {
      $("#add_user").click(function (e) {
          $(".help-block").html("");
        var data = $("#add_user_form").serializeArray();
        $.ajax({
            url:"{{route('user.add_user')}}",
            data:data,
            dataType:'JSON',
            type:'POST',
            beforeSend:function (xhr) {
                $("#ajax_loader").html(ajax_loader);
            },
            complete:function(jqXHR,textStatus) {
                if(jqXHR.status == 200) {
                    var result = JSON.parse(jqXHR.responseText);
                    if(result.hasOwnProperty('success')) {
                        toastr.success(result.msg);
                    } else if(result.hasOwnProperty('error')){
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
                        default :
                            toastr.error("Contact Admin "+jqXHR.status);
                    }
                }
                $("#ajax_loader").html("");
            }

        });
      })
    })
</script>
@stop
