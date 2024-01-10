@extends('layout.masterexam')
@section('pageTitle')
  <title>Elite | Exam</title>
  <link rel="stylesheet" href="/theme/css/about.css">
@endsection
@section('metaCSRF')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
  <style>
    table, tr, th, td {
      padding:10px;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
  <input type="hidden" id="currentuser" value="{{$logindata['username']}}" />
  <section>
      <div class="container">
        <h4>User Management</h4>
        @if(in_array("user", $logindata['restriction']))
          <div class="row" style="padding-bottom:50px;">
            <div class="col-md-2">
              <button class="btn btn-primary btn-sm" style="width:100%;" type="button" id="newcrewbtn" data-toggle="modal" data-target="#addUserModal">+ Add New User</button>
            </div>
            @if(in_array("usertype",$logindata['restriction']))
            <div class="col-md-2">
              <button class="btn btn-success btn-sm" style="width:100%;" type="button" data-toggle="modal" data-target="#userTypeModal">User Type Management</button>
            </div>
            @endif
            <div class="col-md-12">
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" id="searchfilteruser" class="form-control" placeholder="Search user here..."  value="" />
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-12">
              <table id="usertable" class="table table-striped table-hover" style="width:100%" style="margin-top:20px;">
                <thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Middle Name</th>
                    <th>User Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        @else
          <span style="font-weight:500;color:red;">Account Restricted.</span>
        @endif
        <hr>
      </div>
      <div class="modal fade" id="addUserModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">Add User</h4>
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body" style="background-color: #e3f2fd;">
              <div style="margin-top:10px;padding:20px;">
                <form id="newuserform">
                  <input type="hidden" name="type" value="user" />
                  <input type="hidden" name="option" value="new" />
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" name="username"  value="" />
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" value="" />
                      </div>
                    </div>
                  </div>
                  <small style="color:red;"><b>Note:</b> Use string only for username maximum of 10 characters. No special characters for passwords maximum of 20 characters only.</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname"  value="" />
                      </div>
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname" value="" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middlename" value="" />
                      </div>
                      <div class="form-group">
                        <label>User Type</label>
                        <select class="form-control" id="usertype" name="usertype">
                          <option value="">-- Select User Type</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="adduserbtn">Add User</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <div class="modal fade" id="editUserModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">View User</h4>
             
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body" style="background-color: #e3f2fd;">
              <div style="margin-top:10px;padding:20px;">
                <form id="updateuserform">
                  <input type="hidden" name="type" value="user" />
                  <input type="hidden" name="option" value="update" />
                  <input type="hidden" id="uid" name="id" value="" />
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="eusername" name="username"  value="" />
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="epassword" name="password" value="" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="ecpassword" name="cpassword" value="" />
                      </div>
                    </div>
                  </div>
                  <small style="color:red;"><b>Note:</b> Use string only for username maximum of 10 characters. No special characters for passwords maximum of 20 characters only.</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="efirstname" name="firstname"  value="" />
                      </div>
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="elastname" name="lastname" value="" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" id="emiddlename" name="middlename" value="" />
                      </div>
                      <div class="form-group">
                        <label>User Type</label>
                        <input type="text" class="form-control" id="eusertype2" name="usertype" value="" readonly />
                        <select class="form-control" id="eusertype" name="usertype">
                          <option value="">-- Select User Type</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="updateuserbtn">Update User</button>
              <button type="button" class="btn btn-danger" id="deleteuserbtn">Delete User</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="userTypeModal" role="dialog">
        <div class="modal-dialog modal-fullscreen">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">User Type Management</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5">
                  <div style="margin-top:10px;padding:20px;background-color: #e3f2fd;">
                    <form id="usertypeform">
                      <input type="hidden" name="type" value="usertype" />
                      <input type="hidden" id="option" name="option" value="update" />
                      <input type="hidden" id="id" name="id" value="" />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>User Type Name</label>
                            <input type="text" class="form-control" id="typename" name="typename"  value="" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Restrictions:</label>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="viewchk" name="restriction" value="view">
                                  <label class="form-check-label" for="viewchk" >View Only</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="crewchk" name="restriction" value="crew">
                                  <label class="form-check-label" for="crewchk" >Crew Management</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="userchk" name="restriction" value="user">
                                  <label class="form-check-label" for="userchk" >User Management</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="documentchk" name="restriction" value="document">
                                  <label class="form-check-label" for="documentchk" >Documents Setup</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="usertypechk" name="restriction" value="usertype">
                                  <label class="form-check-label" for="usertypechk" >User Type Setup</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="rankchk" name="restriction" value="rank">
                                  <label class="form-check-label" for="rankchk" >Rank Setup</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <button type="button" class="btn btn-success btn-sm" id="addusertypebtn">Add User Type</button>
                              </div>
                              <div class="col-md-3">
                                <button style="display:none;" type="button" class="btn btn-primary btn-sm" id="updateusertypebtn">Update User Type</button>
                              </div>
                              <div class="col-md-3">
                                <button style="display:none;" type="button" class="btn btn-danger btn-sm" id="deleteusertypebtn">Delete User Type</button>
                              </div>
                              <div class="col-md-3">
                                <button type="button" class="btn btn-warning btn-sm" id="resetusertypebtn">Reset User Type</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-7">
                  <div style="margin-top:10px;padding:20px;border:1px solid rgba(0,0,0,0.5);min-height:500px;">
                  <table id="usertypetable" class="table table-striped table-hover" style="width:100%;font-size:0.9em;">
                    <thead>
                      <tr>
                        <th>User Type</th>
                        <th>Restrictions</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </div>

        </div>
      </div>
  </section>

@endsection
@section('js')
<!--Global JavaScript -->
<script src="/theme/js/jquery/jquery.min.js"></script>
<script src="/theme/js/popper/popper.min.js"></script>
<script src="/theme/js/bootstrap/bootstrap.min.js"></script>
<script src="/theme/js/wow/wow.min.js"></script>
<script src="/theme/js/owl-carousel/owl.carousel.min.js"></script>
<!-- Plugin JavaScript -->
<script src="/theme/js/jquery-easing/jquery.easing.min.js"></script>
<script src="/theme/js/custom.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
  var isempformopen = 0;
  var isaccformopen = 0;
  var docFilename = "";
  var dataSet = [];
  var dataSetDoc = [];
  var userDataTable = $('#usertable').DataTable({
    keys: true,
    draw: true,
    info: false,
    paging: false,
    dom: 'lrt',
  });
  var usertypeDataTable = $('#usertypetable').DataTable({
    keys: true,
    draw: true,
    info: false,
    paging: false,
    dom: 'lrt',
  });
  $(document).ready(function(){});
  $('#addusertypebtn').on('click',function(event){
    var arrchk = [];
    $("input:checkbox[name=restriction]:checked").each(function(){
      arrchk.push($(this).val());
    });
    console.log(arrchk);
    var dataFile = new FormData();
    dataFile.append('type', 'usertype');
    dataFile.append('option', 'new');
    dataFile.append('usertype', $('#typename').val());
    dataFile.append('restriction', JSON.stringify(arrchk));
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        data: dataFile,
        contentType: false,
        processData: false,
  			success:function(e){
  					if(e){
  						console.log(e);
              getUserType();
              swal(e.msg,"success");
              resetUserType();
  					}
  			},
  	})
  });
  $('#resetusertypebtn').on('click',function(event){
    resetUserType();
  });
  $('#updateusertypebtn').on('click',function(event){
    var arrchk = [];
    $("input:checkbox[name=restriction]:checked").each(function(){
      arrchk.push($(this).val());
    });
    console.log(arrchk);
    var dataFile = new FormData();
    dataFile.append('type', 'usertype');
    dataFile.append('option', 'update');
    dataFile.append('usertype', $('#typename').val());
    dataFile.append('id', $('#id').val());
    dataFile.append('restriction', JSON.stringify(arrchk));
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        data: dataFile,
        contentType: false,
        processData: false,
  			success:function(e){
  					if(e){
  						console.log(e);
              getUserType();
              alert(e.msg);
              resetUserType();
  					}
  			},
  	});
  });
  $('#deleteusertypebtn').on('click',function(event){
    var delt = confirm("Confirm Delete.");
    if(delt){
      $.ajax({
    			url: '/api-request',
    			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    			method: 'POST',
    			data: {type: 'usertype', option: 'delete', id: $('#id').val()},
    			success:function(e){
    					if(e){
    						console.log(e);
                getUserType();
                alert(e.msg);
                resetUserType();
    					}
    			},
    	});
    }
  });
  $('#adduserbtn').on('click',function(event){
    console.log("ADD");
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#newuserform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              getUsers();
              if(e.msg === "User Successfully Added"){
                swal(e.msg,"success");
              }else{
                swal(e.msg,"info");
              }
  					}
  			},
  	})
  });
  $('#updateuserbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#updateuserform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              getUsers();
              if(e.msg === "User Updated!"){
                swal(e.msg,"success");
              }else{
                swal(e.msg,"info");
              }
             
  					}
  			},
  	})
  });
  $('#deleteuserbtn').on('click',function(event){
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
    			url: '/api-request',
    			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    			method: 'POST',
    			data: {type: 'user', option: 'delete', id: $('#uid').val()},
    			success:function(e){
    					if(e){
    						console.log(e);
                getUsers();
                swal(e.msg,"info");
                window.location.href = "/user";
    					}
    			},
    	  });
      }
    });
  });
  $(document).on('click','.viewuser',function(event){
    var empid = $(this).attr('id');
    empid = empid.split(":");
    empid = empid[1];
    console.log(empid);
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'user', option: 'view', id: empid},
  			success:function(e){
  					if(e){
              console.log(e);
              var det = e.msg;
              $('#uid').val(det.id);
              $('#efirstname').val(det.firstname);
              $('#elastname').val(det.lastname);
              $('#emiddlename').val(det.middlename);
              $('#eusertype').val(det.usertype);
              $('#eusertype2').val(det.usertype);
              $('#eusername').val(det.username);
              $('#epassword').val(det.password);
              $('#ecpassword').val(det.password);
              if(det.username == $('#currentuser').val()){
                $('#deleteuserbtn').prop('disabled',true);
                $('#eusertype').css('display','none');
                $('#eusertype2').css('display','block');
              }
              else {
                $('#deleteuserbtn').prop('disabled',false);
                $('#eusertype').css('display','block');
                $('#eusertype2').css('display','none');
              }
  					}
  			},
  	})
  });
  $(document).on('click','.viewusertype',function(event){
    var utid = $(this).attr('id');
    utid = utid.split(":");
    utid = utid[1];
    console.log(utid);
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'usertype', option: 'view', id: utid},
  			success:function(e){
  					if(e){
              console.log(e);
              resetUserType();
              var det = e.msg;
              var chkArray = det.restriction;
              for(num in chkArray){
                $('#'+chkArray[num]+'chk').prop('checked',true);
              }
              $('#typename').val(det.usertype);
              $('#id').val(det.id);
              $('#addusertypebtn').css('display','none');
              $('#updateusertypebtn').css('display','block');
              $('#deleteusertypebtn').css('display','block');
  					}
  			},
  	})
  });
  getUsers();
  initData();
  getUserType();
  function getUsers(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'user', option: 'list'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var list = e.msg;
              var dataSetUser = [];
              for(num in list){
  							dataSetUser.push([
  								list[num].firstname,
  								list[num].lastname,
  								list[num].middlename,
                  list[num].usertype,
                  '<button id="U:'+list[num].id+'" type="button" class="btn btn-info btn-sm viewuser" data-toggle="modal" data-target="#editUserModal"><i class="fa fa-eye"></i></button>',
  							]);
    					}
              userDataTable.destroy();
  						userDataTable.draw();
  						$('#usertable').DataTable({
                keys: true,
                draw: true,
                info: false,
                paging: false,
                dom: 'lrt',
  							data: dataSetUser,
  							columns: [
  								{ title: "Firstname" },
  								{ title: "Lastname" },
                  { title: "Middlename" },
                  { title: "User Type" },
                  { title: "Action" },
  							]}),
  							userDataTable = $('#usertable').DataTable();
  					}
  			},
  	});
  }
  function getUserType(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'usertype', option: 'list'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var list = e.msg;
              var userTypeData = [];
              for(num in list){
  							userTypeData.push([
  								list[num].usertype,
  								list[num].restriction,
                  '<button id="UT:'+list[num].id+'" type="button" class="btn btn-warning btn-sm viewusertype">select</button>',
  							]);
    					}
              console.log(userTypeData);
              usertypeDataTable.destroy();
  						usertypeDataTable.draw();
  						$('#usertypetable').DataTable({
                keys: true,
                draw: true,
                info: false,
                paging: false,
  							data: userTypeData,
  							columns: [
  								{ title: "User Type" },
  								{ title: "Restrictions" },
                  { title: "Action" },
  							]}),
  							usertypeDataTable = $('#usertypetable').DataTable();
  					}
  			},
  	})
  }
  function initData(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'defaults', option: 'usertype'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var ut = e.msg;
              for(num in ut){
                $('#usertype').append('<option value="'+ut[num].usertype+'">'+ut[num].usertype+'</option>');
              }
              for(num in ut){
                $('#eusertype').append('<option value="'+ut[num].usertype+'">'+ut[num].usertype+'</option>');
              }
  					}
  			},
  	})
  }
  function resetUserType(){
    $('#typename').val('');
    $('#viewchk').prop('checked',false);
    $('#crewchk').prop('checked',false);
    $('#userchk').prop('checked',false);
    $('#documentchk').prop('checked',false);
    $('#rankchk').prop('checked',false);
    $('#usertypechk').prop('checked',false);
    $('#addusertypebtn').css('display','block');
    $('#updateusertypebtn').css('display','none');
    $('#deleteusertypebtn').css('display','none');
  }
  $('#searchfilteruser').on('keyup',function(){
    userDataTable.search($(this).val()).draw();
  });

  $(".nav-link.active").removeClass("active");
  $(".nav-link.users").addClass("active");
</script>
@endsection
