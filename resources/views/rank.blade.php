@extends('layout.masterexam')
@section('pageTitle')
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
        <h4>Rank Management</h4>
        @if(in_array("rank", $logindata['restriction']))
          <div class="row" style="padding-bottom:50px;">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div style="margin-top:10px;padding:20px;background-color: #e3f2fd;">
                    <form id="rankform">
                      <input type="hidden" name="type" value="rank" />
                      <input type="hidden" id="option" name="option" value="new" />
                      <input type="hidden" id="oldcode" name="oldcode" value="0" />
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" id="code" name="code"  value="" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="longname" name="longname"  value="" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Short Name</label>
                            <input type="text" class="form-control" id="shortname" name="shortname"  value="" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Alias</label>
                            <input type="text" class="form-control" id="alias" name="alias"  value="" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Ranking</label>
                            <input type="text" class="form-control" id="ranking" name="ranking"  value="" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <button style="width:100%;" type="button" class="btn btn-primary btn-sm" id="addrankbtn">+ Add Rank</button>
                              </div>
                              <div class="col-md-3">
                                <button style="width:100%;" type="button" class="btn btn-warning btn-sm" id="resetrankbtn">Reset Rank</button>
                              </div>
                              <div class="col-md-3">
                                <button style="display:none;width:100%;" type="button" class="btn btn-primary btn-sm" id="updaterankbtn">Update Rank</button>
                              </div>
                              <div class="col-md-3">
                                <button style="display:none;width:100%;" type="button" class="btn btn-danger btn-sm" id="deleterankbtn">Delete Rank</button>
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
                  <table id="ranktable" class="table table-striped table-hover" style="width:100%;font-size:0.9em;">
                    <thead>
                      <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Ranking</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @else
          <span style="font-weight:500;color:red;">Account Restricted.</span>
        @endif
        <hr>
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
  var rankDataTable = $('#ranktable').DataTable({
    keys: true,
    draw: true,
    info: false,
    paging: false,
    order: false,
  });
  $(document).ready(function(){});
  $('#addrankbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#rankform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              getRank();
              swal(e.msg,"success");
              resetRank();
  					}
  			},
  	})
  });
  $('#resetrankbtn').on('click',function(event){
    resetRank();
  });
  $('#updaterankbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#rankform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              getRank();
          
              swal(e.msg,"success");
              resetRank();
  					}
  			},
  	})
  });
  $('#deleterankbtn').on('click',function(event){
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
            data: {type: 'rank', option: 'delete', code: $('#oldcode').val()},
            success:function(e){
                if(e){
                  console.log(e);
                  getRank();
                  swal(e.msg,"info");
                  resetRank();
                }
            },
        });
      }
    });
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
              swal(e.msg,"success");
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
              swal(e.msg,"success");
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
  $(document).on('click','.viewrank',function(event){
    var rcode = $(this).attr('id');
    rcode = rcode.split(":");
    rcode = rcode[1];
    console.log(rcode);
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'rank', option: 'view', code: rcode},
  			success:function(e){
  					if(e){
              console.log(e);
              var det = e.msg;
              $('#option').val("update");
              $('#oldcode').val(det.code);
              $('#code').val(det.code);
              $('#longname').val(det.name);
              $('#shortname').val(det.short_name);
              $('#alias').val(det.alias);
              $('#ranking').val(det.ranking);
              $('#updaterankbtn').css('display','block');
              $('#deleterankbtn').css('display','block');
              $('#addrankbtn').css('display','none');
  					}
  			},
  	})
  });
  getRank();
  function getRank(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'rank', option: 'list'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var list = e.msg;
              var dataSetRank = [];
              for(num in list){
  							dataSetRank.push([
  								list[num].code,
  								list[num].name,
  								list[num].ranking,
                  '<button id="R:'+list[num].code+'" type="button" class="btn btn-warning btn-sm viewrank">select</button>',
                ]);
    					}
              rankDataTable.destroy();
  						rankDataTable.draw();
  						$('#ranktable').DataTable({
                "scrollY":"300px",
                keys: true,
                draw: true,
                info: false,
                paging: false,
                order: false,
  							data: dataSetRank,
  							columns: [
  								{ title: "Code" },
  								{ title: "Name" },
                  { title: "Ranking" },
                  { title: "Action" },
  							]}),
  							rankDataTable = $('#ranktable').DataTable();
  					}
  			},
  	});
  }
  function resetRank(){
    $('#option').val('new');
    $('#code').val('');
    $('#longname').val('');
    $('#shortname').val('');
    $('#alias').val('');
    $('#ranking').val('');
    $('#updaterankbtn').css('display','none');
    $('#deleterankbtn').css('display','none');
    $('#addrankbtn').css('display','block');
  }
  $(".nav-link.active").removeClass("active");
  $(".nav-link.rank").addClass("active");
</script>
@endsection
