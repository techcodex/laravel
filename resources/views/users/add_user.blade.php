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
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="">--Select Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="help-block text-danger country_id col-md-offset-2"></span>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="">--Select State --</option>

                                </select>
                            </div>
                            <span class="help-block text-danger state_id col-md-offset-2"></span>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">City</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">--Select City --</option>
                                </select>
                            </div>
                            <span class="help-block text-danger city_id col-md-offset-2"></span>
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
                        $("#user_form").trigger("reset");
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
    });
</script>
    <script>
        $(document).ready(function (e) {
            $("#country_id").change(function (e) {
                var id = $("#country_id").val();
                var data = {};
                data['id'] = id;
                $.ajax({
                    url:"{{url('/location/get_states/')}}",
                    data:data,
                    dataType:'JSON',
                    type:'POST',
                    beforeSend:function (xhr) {
                        $(".state_id").html(ajax_loader);
                    },
                    complete:function(jqXHR,textStatus) {
                        if(jqXHR.status == 200) {
                            var result = JSON.parse(jqXHR.responseText);
                            if(result.hasOwnProperty('success')) {
                                if(result.hasOwnProperty('states')) {
                                    var states = result.states;
                                    var output = "";
                                    $.each(states,function (index,state) {
                                        output +="<option value='"+state.id+"'>"+state.name+"</option>";
                                    });
                                    $("#state_id > option").remove();
                                    $("#state_id").append(output);
                                } else{
                                    toastr.error("Missing Satates");
                                }
                            } else if(result.hasOwnProperty('error')) {
                                toastr.error(result.msg);
                            }
                        } else{
                            toastr.error("Contact Admin "+jqXHR.status);
                        }
                        $(".state_id").html("");
                    }
                });
            })
        })
    </script>
<script>
    $("#state_id").change(function (e) {
        var id = $("#state_id").val();
        var data = {};
        data['id'] = id;
       $.ajax({
           url:"{{url('/location/get_cities/')}}",
           data:data,
           dataType:'JSON',
           type:'POST',
           beforeSend:function (xhr) {
                $(".city_id").html(ajax_loader);
           },
           complete:function (jqXHR,textStatus) {
               if(jqXHR.status == 200) {
                    var result = JSON.parse(jqXHR.responseText);
                    if(result.hasOwnProperty('success')) {
                        if(result.hasOwnProperty('cities')) {
                            var cities = result.cities;
                            var output = "";
                            $.each(cities,function (index,city) {
                                output +="<option value='"+city.id+"'>"+city.name+"</option>";
                            });
                            $("#city_id > option~option").remove();
                            $("#city_id").append(output);
                        } else{
                            toastr.error("Missing Cities");
                        }
                    } else if(result.hasOwnProperty('error')) {
                        toastr.error(result.msg);
                    }
               } else{
                    toastr.error("Contact Admin "+jqXHR.status);
               }
               $(".city_id").html("");
           }
       });
    })
</script>
@stop
