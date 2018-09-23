@extends('app')

@section('header-styles')

@stop

@section('main-section')
<div class="table-responsive" id="app">
    <table class="table table-responsive table-bordered table-striped" id="users_data">
        <thead class="bg-primary text-center">
        <th data-column-id = "id" data-visible="false">ID</th>
        <th data-column-id="s_no">#</th>
        <th data-column-id="user_name">U Name</th>
        <th data-column-id="email">@</th>
        <th data-column-id="first_name">F</th>
        <th data-column-id="last_name">L</th>
        <th data-column-id="middle_name">M</th>
        <th data-column-id="gender">G</th>
        <th data-column-id="Address">A</th>
        <th data-column-id="Country">Con</th>
        <th data-column-id="state">state</th>
        <th data-column-id="city">City</th>
        <th data-column-id="contact_no">Contact</th>
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
            <td>{{$user->profile['first_name']}}</td>
            <td>{{$user->profile->last_name}}</td>
            <td>{{$user->profile->middle_name}}</td>
            <td>{{$user->profile->gender}}</td>
            <td>{{$user->profile->address}}</td>
            <td>{{$user->profile->country->name}}</td>
            <td>{{$user->profile->state->name}}</td>
            <td>{{$user->profile->city->name}}</td>
            <td>{{$user->profile->contact_no}}</td>

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
                <form id="user_form" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" name="first_name" id="first_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name:</label>
                        <input class="form-control" name="middle_name" id="middle_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input class="form-control" name="last_name" id="last_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="user_name">Gender</label><br>
                        <label for="male">Male: &nbsp;</label>
                        <input  type="radio" name="gender[]" id="male"  value="male">
                        <span>FeMale: &nbsp;</span>
                        <input type="radio" name="gender[]" id="female" value="female">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Address:</label>
                        <textarea cols="30" rows="3" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <div class="daterangepicker dropdown-menu ltr single opensright show-calendar picker_4 xdisplay"><div class="calendar left single" style="display: block;"><div class="daterangepicker_input"><input class="input-mini form-control active" type="text" name="daterangepicker_start" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th class="prev available"><i class="fa fa-chevron-left glyphicon glyphicon-chevron-left"></i></th><th colspan="5" class="month">Oct 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">25</td><td class="off available" data-title="r0c1">26</td><td class="off available" data-title="r0c2">27</td><td class="off available" data-title="r0c3">28</td><td class="off available" data-title="r0c4">29</td><td class="off available" data-title="r0c5">30</td><td class="weekend available" data-title="r0c6">1</td></tr><tr><td class="weekend available" data-title="r1c0">2</td><td class="available" data-title="r1c1">3</td><td class="available" data-title="r1c2">4</td><td class="available" data-title="r1c3">5</td><td class="available" data-title="r1c4">6</td><td class="available" data-title="r1c5">7</td><td class="weekend available" data-title="r1c6">8</td></tr><tr><td class="weekend available" data-title="r2c0">9</td><td class="available" data-title="r2c1">10</td><td class="available" data-title="r2c2">11</td><td class="available" data-title="r2c3">12</td><td class="available" data-title="r2c4">13</td><td class="available" data-title="r2c5">14</td><td class="weekend available" data-title="r2c6">15</td></tr><tr><td class="weekend available" data-title="r3c0">16</td><td class="available" data-title="r3c1">17</td><td class="today active start-date active end-date available" data-title="r3c2">18</td><td class="available" data-title="r3c3">19</td><td class="available" data-title="r3c4">20</td><td class="available" data-title="r3c5">21</td><td class="weekend available" data-title="r3c6">22</td></tr><tr><td class="weekend available" data-title="r4c0">23</td><td class="available" data-title="r4c1">24</td><td class="available" data-title="r4c2">25</td><td class="available" data-title="r4c3">26</td><td class="available" data-title="r4c4">27</td><td class="available" data-title="r4c5">28</td><td class="weekend available" data-title="r4c6">29</td></tr><tr><td class="weekend available" data-title="r5c0">30</td><td class="available" data-title="r5c1">31</td><td class="off available" data-title="r5c2">1</td><td class="off available" data-title="r5c3">2</td><td class="off available" data-title="r5c4">3</td><td class="off available" data-title="r5c5">4</td><td class="weekend off available" data-title="r5c6">5</td></tr></tbody></table></div></div><div class="calendar right" style="display: none;"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_end" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th></th><th colspan="5" class="month">Nov 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">30</td><td class="off available" data-title="r0c1">31</td><td class="available" data-title="r0c2">1</td><td class="available" data-title="r0c3">2</td><td class="available" data-title="r0c4">3</td><td class="available" data-title="r0c5">4</td><td class="weekend available" data-title="r0c6">5</td></tr><tr><td class="weekend available" data-title="r1c0">6</td><td class="available" data-title="r1c1">7</td><td class="available" data-title="r1c2">8</td><td class="available" data-title="r1c3">9</td><td class="available" data-title="r1c4">10</td><td class="available" data-title="r1c5">11</td><td class="weekend available" data-title="r1c6">12</td></tr><tr><td class="weekend available" data-title="r2c0">13</td><td class="available" data-title="r2c1">14</td><td class="available" data-title="r2c2">15</td><td class="available" data-title="r2c3">16</td><td class="available" data-title="r2c4">17</td><td class="available" data-title="r2c5">18</td><td class="weekend available" data-title="r2c6">19</td></tr><tr><td class="weekend available" data-title="r3c0">20</td><td class="available" data-title="r3c1">21</td><td class="available" data-title="r3c2">22</td><td class="available" data-title="r3c3">23</td><td class="available" data-title="r3c4">24</td><td class="available" data-title="r3c5">25</td><td class="weekend available" data-title="r3c6">26</td></tr><tr><td class="weekend available" data-title="r4c0">27</td><td class="available" data-title="r4c1">28</td><td class="available" data-title="r4c2">29</td><td class="available" data-title="r4c3">30</td><td class="off available" data-title="r4c4">1</td><td class="off available" data-title="r4c5">2</td><td class="weekend off available" data-title="r4c6">3</td></tr><tr><td class="weekend off available" data-title="r5c0">4</td><td class="off available" data-title="r5c1">5</td><td class="off available" data-title="r5c2">6</td><td class="off available" data-title="r5c3">7</td><td class="off available" data-title="r5c4">8</td><td class="off available" data-title="r5c5">9</td><td class="weekend off available" data-title="r5c6">10</td></tr></tbody></table></div></div><div class="ranges" style="display: none;"><div class="range_inputs"><button class="applyBtn btn btn-sm btn-success" type="button">Apply</button> <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button></div></div></div>


                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal4" placeholder="Date Of Birth" aria-describedby="inputSuccess2Status4" name="date_of_birth">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact No:</label>
                        <input class="form-control" name="contact_no" id="contact_no" value="">
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Select Country:</label>
                        <select class="form-control" name="country_id" id="country_id">
                            <option value="">--Select Country -- </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Select State:</label>
                        <select class="form-control" name="state_id" id="state_id">
                            <option value="">--Select State -- </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">Select City:</label>
                        <select class="form-control" name="city_id" id="city_id">
                            <option value="">--Select City -- </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Profile Image:</label>
                        <input class="form-control" type="file" name="profile_image" id="profile_image" >
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
                        "<button type=\"button\" class=\"btn btn-xs btn-default  command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash\"></span></button>";
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
                                $("#first_name").val(user.first_name);
                                $("#middle_name").val(user.middle_name);
                                $("#last_name").val(user.last_name);
                                $("#contact_no").val(user.contact_no);
                                $("#address").html(user.address);
                                var gender = user.gender;
                                if(gender === null) {
                                    $("#male").attr("checked",true);
                                } else if(gender == "female"){
                                    $("#female").attr("checked",true);
                                } else{
                                    $("#male").attr('checked',true);
                                }
                                $("#single_cal1").val(user.date_of_birth);
                                var country_id = user.country_id;
                                if(country_id != "") {
                                    $.ajax({
                                        url:"{{route('location.get_country')}}",
                                        dataType:'JSON',
                                        type:'POST',
                                        complete:function(jqXHR,textStatus) {
                                            if(jqXHR.status == 200) {
                                                var res = JSON.parse(jqXHR.responseText);
                                                if(res.hasOwnProperty('success')) {
                                                    if(res.hasOwnProperty('countries')) {
                                                        var output = "";
                                                        $.each(res.countries,function (index,country) {
                                                            if(country.id == user.country_id) {
                                                                output +="<option selected value='"+country.id+"'>"+country.name+"</option>"
                                                            } else{
                                                                output +="<option value='"+country.id+"'>"+country.name+"</option>";
                                                            }
                                                        });
                                                        $("#country_id > option~option").remove();
                                                        $("#country_id").append(output);
                                                        var d = {};
                                                        d['id'] = country_id;
                                                        $.ajax({
                                                            url:"{{route('location.get_states')}}",
                                                            data:d,
                                                            dataType:'JSON',
                                                            type:'POST',
                                                            complete:function (jqXHR,textStatus) {
                                                                if(jqXHR.status == 200) {
                                                                    var result_state = JSON.parse(jqXHR.responseText);
                                                                    if(result_state.hasOwnProperty('success')) {
                                                                        output = "";
                                                                        $.each(result_state.states,function (index,state) {
                                                                            if(user.state_id == state.id) {
                                                                                output +="<option selected value='"+state.id+"'>"+state.name+"</option>";
                                                                            } else{
                                                                                output +="<option value='"+state.id+"'>"+state.name+"</option>";
                                                                            }
                                                                        });
                                                                        $("#state_id > option ~ option").remove();
                                                                        $("#state_id").append(output);
                                                                        var state_id = user.state_id;
                                                                        if(state_id != "") {
                                                                            var city_data = {};
                                                                            city_data['id'] = state_id;
                                                                            $.ajax({
                                                                                url:"{{route('location.get_cities')}}",
                                                                                data:city_data,
                                                                                dataType:'JSON',
                                                                                type:'POST',
                                                                                complete:function(jqXHR,textStatus) {
                                                                                     if(jqXHR.status == 200) {
                                                                                        var city_result = JSON.parse(jqXHR.responseText);
                                                                                        if(city_result.hasOwnProperty('success')) {
                                                                                               output = "";
                                                                                               $.each(city_result.cities,function (index,city) {
                                                                                                   if(city.id == user.city_id) {
                                                                                                       output +="<option selected value='"+city.id+"'>"+city.name+"</option>";
                                                                                                   } else{
                                                                                                       output +="<option value='"+city.id+"'>"+city.name+"</option>";
                                                                                                   }
                                                                                                   $("#city_id > option ~option").remove();
                                                                                                   $("#city_id").append(output);
                                                                                               })
                                                                                        } else if(city_result.hasOwnProperty('error')) {
                                                                                            toastr.error(city_result.msg);
                                                                                        }
                                                                                     } else{
                                                                                         toastr.error("Contact Admin "+jqXHR.status);
                                                                                     }
                                                                                }
                                                                            });
                                                                        }
                                                                    } else if(result_state.hasOwnProperty('error')) {
                                                                        toastr.error(result_state.msg);
                                                                    }
                                                                } else{
                                                                    toastr.error("Contact Admin "+jqXHR.status);
                                                                }
                                                            }
                                                        });
                                                    } else{
                                                        toastr.error("Missing Countries ");
                                                    }
                                                } else if(res.hasOwnProperty('error')) {
                                                    toastr.error(res.msg);
                                                }
                                            } else{
                                                toastr.error("Contact Admin "+jqXHR.status);
                                            }
                                        }
                                    });
                                }

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
                var url = "{{route('user.delete',':id')}}";
                url = url.replace(":id",id);
                window.location.replace(url);

            });

        });
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
                                $("#state_id > option ~ option").remove();
                                $("#city_id > option ~option").remove();
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


