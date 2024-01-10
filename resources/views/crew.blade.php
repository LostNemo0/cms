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

  <section>
      <div class="container">
        <h4>Crew Management</h4>
        @if(in_array("view", $logindata['restriction']))
        <div class="row" style="padding-bottom:50px;">
          @if(in_array("crew", $logindata['restriction']))
          <div class="col-md-2">
            <button class="btn btn-primary btn-sm" type="button" id="newcrewbtn" data-toggle="modal" data-target="#addCrewModal">+ Add New Crew</button>
          </div>
          @endif
          <div class="col-md-12">
              <div class="row" style="margin-top:10px;">
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" id="searchfilter" class="form-control" placeholder="Search crew here..."  value="" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <select id="rankfilter" class="form-control">
                      <option value="">-- filter by rank --</option>
                    </select>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-12">
            <table id="crewtable" class="table table-striped table-hover" style="width:100%" style="margin-top:20px;">
              <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Middle Name</th>
                  <th>Rank</th>
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
      <div class="modal fade" id="addCrewModal" role="dialog">
        <div class="modal-dialog modal-md">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">Add Crew</h4>
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body">
              <div style="margin-top:10px;padding:20px;">
                <form id="newcrewform">
                  <input type="hidden" name="type" value="crew" />
                  <input type="hidden" name="option" value="new" />
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
                      <div class="form-group">
                        <label>Birth Date</label>
                        <input type="date" class="form-control"  id="nbirthdate" name="birthdate" value="" />
                      </div>
                      <div class="form-group">
                        <label>Age</label>
                        <input type="number" class="form-control" id="nage" name="age" value="" readonly/>
                      </div>
                      <div class="form-group">
                        <label>Height (in Cm)</label>
                        <input type="text" class="form-control" id="nheight" name="height" value="" />
                      </div>
                      <div class="form-group">
                        <label>BMI: </label> <span id="nbmi" style="font-weight:600;"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middlename" value="" />
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="" />
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="" />
                      </div>
                      <div class="form-group">
                        <label>Rank</label>
                        <select class="form-control" id="nrank" name="rank">
                          <option value="">-- Select Rank --</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Weight (in Kg)</label>
                        <input type="text" class="form-control" id="nweight" name="weight" value="" />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="addcrewbtn">+ Add Crew</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <div class="modal fade" id="editCrewModal" role="dialog">
        <div class="modal-dialog modal-fullscreen">
          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">Crew Profile</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5">
                  <div style="margin-top:10px;padding:20px;background-color: #e3f2fd;">
                    <form id="updatecrewform">
                      <input type="hidden" name="type" value="crew" />
                      <input type="hidden" name="option" value="update" />
                      <input type="hidden" id="id" name="id" value="" />
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"  value="" />
                          </div>
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="" />
                          </div>
                          <div class="form-group">
                            <label>Birth Date</label>
                            <input type="date" class="form-control"  id="birthdate" name="birthdate" value="" />
                          </div>
                          <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="" />
                          </div>
                          <div class="form-group">
                            <label>Height (in Cm)</label>
                            <input type="text" class="form-control" id="height" name="height" value="" />
                          </div>
                          <div class="form-group">
                            <label>BMI: </label> <span id="bmi" style="font-weight:600;"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" value="" />
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="" />
                          </div>
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="" />
                          </div>
                          <div class="form-group">
                            <label>Rank</label>
                            <select class="form-control" id="rank" name="rank">
                              <option value="">-- Select Rank --</option>
                              <option value="1">Test</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Weight (in Kg)</label>
                            <input type="text" class="form-control" id="weight" name="weight" value="" />
                          </div>
                          @if(in_array("crew", $logindata['restriction']))
                          <div class="form-group">
                            <button type="button" class="btn btn-warning btn-sm" id="updatecrewbtn">Update Crew</button>
                            <button type="button" class="btn btn-danger btn-sm" id="deletecrewbtn">Delete Crew</button>
                          </div>
                          @endif
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
                <div class="col-md-7">
                  <div style="margin-top:10px;padding:20px;border:1px solid rgba(0,0,0,0.5);min-height:500px;">
                    @if(in_array("crew", $logindata['restriction']))
                    <button type="button" id="newdocbtn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDocModal">+ Add New Document</button>
                    @endif
                    <table id="documenttable" class="table table-striped table-hover" style="width:100%;font-size:0.9em;">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Name</th>
                          <th>Number</th>
                          <th>Issued Date</th>
                          <th>Expiry Date</th>
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

        </div>
      </div>
      <div class="modal fade" id="addDocModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">Add Document</h4>
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body">
              <div style="margin-top:10px;padding:20px;">
                <form id="newdocform">
                  <input type="hidden" name="type" value="document" />
                  <input type="hidden" name="option" value="save" />
                  <input type="hidden" id="crewid" name="crewid" value="" />
                  <input type="hidden" id="docpath" name="docpath" value="" />
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code"  value="" />
                      </div>
                      <div class="form-group">
                        <label>Document Name</label>
                        <input type="text" class="form-control" name="docname" value="" />
                      </div>
                      <div class="form-group">
                        <label>Date Expire</label>
                        <input type="date" class="form-control" name="dateexpire" value="" />
                      </div>
                      <div class="form-group">
                        <label>Uploaded By</label>
                        <input type="text" class="form-control" name="uploadedby" value="{{$logindata['fullname']}}" readonly/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Document Number</label>
                        <input type="text" class="form-control" name="docnum" value="" />
                      </div>
                      <div class="form-group">
                        <label>Date Issued</label>
                        <input type="date" class="form-control" name="dateissued" value="" />
                      </div>
                      <div class="form-group">
                        <label>Document Type</label>
                        <select class="form-control" id="doctype" name="doctype">
                          <option value="">-- Select Document Type --</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label>Document Upload</label>
                          <input type="file" class="form-control" placeholder="Choose file" id="nfile">
                            @error('file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="adddocbtn">Add Document</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <div class="modal fade" id="updateDocModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header" style="background-color: #87b048;">
              <h4 class="modal-title" style="color:white">View Document</h4>
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body">
              <div style="margin-top:10px;padding:20px;">
                <form id="updatedocform">
                  <input type="hidden" name="type" value="document" />
                  <input type="hidden" name="option" value="update" />
                  <input type="hidden" id="docid" name="docid" value="" />
                  <input type="hidden" id="ucrewid" name="crewid" value="" />
                  <input type="hidden" id="udocpath" name="docpath" value="" />
                  <input type="hidden" id="lastdocpath" value="" />
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" id="code" name="code"  value="" />
                      </div>
                      <div class="form-group">
                        <label>Doc Name</label>
                        <input type="text" class="form-control" id="docname" name="docname" value="" />
                      </div>
                      <div class="form-group">
                        <label>Date Expire</label>
                        <input type="date" class="form-control" id="dateexpire" name="dateexpire" value="" />
                      </div>
                      <div class="form-group">
                        <label>Uploaded By</label>
                        <input type="text" class="form-control" id="uploadedby" name="uploadedby" value="" readonly/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Doc Number</label>
                        <input type="text" class="form-control" id="docnum" name="docnum" value="" />
                      </div>
                      <div class="form-group">
                        <label>Date Issued</label>
                        <input type="date" class="form-control" id="dateissued" name="dateissued" value="" />
                      </div>
                      <div class="form-group">
                        <label>Document Type</label>
                        <select class="form-control" id="udoctype" name="doctype">
                          <option value="">-- Select Document Type --</option>
                        </select>
                      </div>

                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                        <label>Document Uploaded: </label>
                        <input type="text" style="width:80%;"value="" id="documentfile" name="documentfile" disabled />
                        <a href="" id="doclink" target="_blank" class="btn btn-warning btn-sm">view file</a>
                        @if(in_array("crew", $logindata['restriction']))
                        <button id="changedoc" class="btn btn-primary btn-sm">change</button>
                        @endif
                        <input type="file" style="display:none;" class="form-control" placeholder="Choose file" id="ufile">
                      </div>
                  </div>
                  <div class="col-md-12">
                    <label>Date Uploaded: </label> <span id="dateuploaded" style="color:blue;"></span><br>
                    <label>Last Date Updated: </label> <span id="dateupdated" style="color:orange;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              @if(in_array("crew", $logindata['restriction']))
              <button type="button" class="btn btn-success" id="updatedocbtn">Update Document</button>
              <button type="button" class="btn btn-danger" id="deletedocbtn">Remove Document</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
              @endif
            </div>
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
  var crewDataTable = $('#crewtable').DataTable({
    keys: true,
    draw: true,
    info: false,
    paging: false,
    dom: 'lrt',
  });
  var docDataTable = $('#documenttable').DataTable({
    keys: true,
    draw: true,
    info: false,
    paging: false,

  });
  $(document).ready(function(){});
  $('#userlistbtn').on('click',function(event){
    getUsers();
  });
  $('#addcrewbtn').on('click',function(event){
    console.log("ADD");
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#newcrewform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              swal(e.msg,"success");
              getCrews();
              window.location.href = "/crew";
  					}
  			},
  	})
  });
  $('#updatecrewbtn').on('click',function(event){

    Swal.fire({
      title: "Do you want to save the changes?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Save",
      denyButtonText: `Don't save`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
      
          $.ajax({
              url: '/api-request',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              method: 'POST',
              data: $('#updatecrewform').serialize(),
              success:function(e){
                  if(e){
                    console.log(e);
                    getCrews();
                    swal(e.msg,"success");
                    window.location.href = "/crew";
                  }
              },
          })
        
      } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
      }
    });

    // var updt = confirm("Confirm Update.");

  });
  $('#deletecrewbtn').on('click',function(event){

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
            data: {type: 'crew', option: 'delete', id: $('#id').val()},
            success:function(e){
                if(e){
                  console.log(e);
                  getCrews();
                  swal(e.msg,"info");
                  window.location.href = "/crew";
                }
            },
          })
      }
    });

    // var del = confirm("Confirm delete.");
    // if(del){
    //   $.ajax({
    // 			url: '/api-request',
    // 			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    // 			method: 'POST',
    // 			data: {type: 'crew', option: 'delete', id: $('#id').val()},
    // 			success:function(e){
    // 					if(e){
    // 						console.log(e);
    //             getCrews();
    //             swal(e.msg,"info");
    //             window.location.href = "/crew";
    // 					}
    // 			},
    // 	})
    // }
  });
  $('#adddocbtn').on('click',function(event){
    event.preventDefault();
    var code = $('#id').val();
    var dataFile = new FormData();
    dataFile.append('file', $('#nfile').get(0).files[0]);
    dataFile.append('type', 'document');
    dataFile.append('option', 'upload');
    dataFile.append('crewid', code);
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
              $('#docpath').val(e.msg);
              saveDocDetails(code);
            }
        },
        error: function(data){
          var msg = data.responseJSON;
          alert(msg.message);
        }
    })
  });
  function saveDocDetails(code){
    $.ajax({
        url: '/api-request',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        data: $('#newdocform').serialize(),
        success:function(e){
            if(e){
              console.log(e);
              getDocs(code);
              alert(e.msg);
            }
        },
    });
  }
  $('#updatedocbtn').on('click',function(event){
    var updt = confirm("Confirm Update.");
    if(updt){
      var path = $('#lastdocpath').val();
      var code = $('#ucrewid').val();
      if($('#udocpath').val() == ""){
        uploadDocFile(code,path);
      }
      else {
        updateDocDetails(code);
      }
    }
  });
  $('#deletedocbtn').on('click',function(event){
    var del = confirm("Confirm delete.");
    if(del){
      $.ajax({
    			url: '/api-request',
    			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    			method: 'POST',
    			data: {type: 'document', option: 'delete', id: $('#docid').val()},
    			success:function(e){
    					if(e){
    						console.log(e);
                $('#dateuploaded').text("");
                $('#dateupdated').text("");
                getDocs($('#id').val());
                viewDoc($('#docid').val());
                alert(e.msg);
    					}
    			},
    	})
    }


  });
  $('#changedoc').on('click',function(event){
    $('#ufile').click();
  });
  $('#ufile').change(function () {
      $('#documentfile').val(this.files[0].name);
      $('#udocpath').val('');
  });
  $('#weight').change(function () {
      if(parseFloat($('#weight').val()) > 0 && parseFloat($('#height').val()) > 0){
        $('#bmi').text(bmi($('#weight').val(),$('#height').val()));
      }
      else $('#bmi').text("");
  });
  $('#height').change(function () {
      if(parseFloat($('#weight').val()) > 0 && parseFloat($('#height').val()) > 0){
        $('#bmi').text(bmi($('#weight').val(),$('#height').val()));
      }
      else $('#bmi').text("");
  });
  $('#nweight').change(function () {
      if(parseFloat($('#nweight').val()) > 0 && parseFloat($('#nheight').val()) > 0){
        $('#nbmi').text(bmi($('#nweight').val(),$('#nheight').val()));
      }
      else $('#nbmi').text("");
  });
  $('#nheight').change(function () {
      if(parseFloat($('#nweight').val()) > 0 && parseFloat($('#nheight').val()) > 0){
        $('#nbmi').text(bmi($('#nweight').val(),$('#nheight').val()));
      }
      else $('#nbmi').text("");
  });
  function updateDocDetails(code){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#updatedocform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              viewDoc($('#docid').val());
              getDocs($('#id').val());
              alert(e.msg);
  					}
  			},
  	})
  }
  function uploadDocFile(code,path){
    event.preventDefault();
    var dataFile = new FormData();
    dataFile.append('file', $('#ufile').get(0).files[0]);
    dataFile.append('type', 'document');
    dataFile.append('option', 'upload');
    dataFile.append('crewid', code);
    dataFile.append('lastpath', path);
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
              $('#udocpath').val(e.msg);
              updateDocDetails(code);
            }
        },
        error: function(data){
          var msg = data.responseJSON;
          alert(msg.message);
        }
    })
  }
  $('#adduserbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#adduserform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              alert(e.msg);
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
              alert(e.msg);
  					}
  			},
  	})
  });
  $(document).on('click','.viewcrew',function(event){
    var empid = $(this).attr('id');
    empid = empid.split(":");
    empid = empid[1];
    console.log(empid);
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'crew', option: 'view', id: empid},
  			success:function(e){
  					if(e){
              var det = e.msg;
              $('#id').val(det.id);
              $('#crewid').val(det.id);
              $('#firstname').val(det.firstname);
              $('#lastname').val(det.lastname);
              $('#middlename').val(det.middlename);
              $('#age').val(det.age);
              $('#email').val(det.email);
              $('#address').val(det.address);
              $('#rank').val(det.rank);
              $('#weight').val(det.weight);
              $('#height').val(det.height);
              $('#birthdate').val(det.birthdate);
              $('#bmi').text(bmi(det.weight,det.height));
              getDocs(det.id);
  					}
  			},
  	})
  });
  $(document).on('click','.deletecrew',function(event){
    var isdel = confirm("confirm Delete");
    console.log(isdel);
    if(isdel == true){
      console.log(isdel);
      var empid = $(this).attr('id');
      empid = empid.split(":");
      empid = empid[1];
      $.ajax({
    			url: '/api-request',
    			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    			method: 'POST',
    			data: {crewtype: 'deletecrew', id: empid},
    			success:function(e){
    					if(e){
                var det = e.msg;
                alert(e.msg);
                getCrews();
    					}
    			},
    	});
    }

  });
  $(document).on('click','.viewdoc',function(event){
    var docid = $(this).attr('id');
    docid = docid.split(":");
    docid = docid[1];
    console.log(docid);
    viewDoc(docid);
  });
  getCrews();
  initData();
  function getCrews(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'crew', option: 'list'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var list = e.msg;
              dataSet = [];
              for(num in list){
  							dataSet.push([
  								list[num].firstname,
  								list[num].lastname,
  								list[num].middlename,
                  list[num].rank,
                  '<button id="U:'+list[num].id+'" type="button" class="btn btn-info btn-sm viewcrew" data-toggle="modal" data-target="#editCrewModal"><i class="fa fa-eye"></i></button>',
  							]);
    					}
              console.log(dataSet);
              crewDataTable.destroy();
  						crewDataTable.draw();
  						$('#crewtable').DataTable({
                keys: true,
                draw: true,
                info: false,
                paging: false,
                dom: 'lrt',
  							data: dataSet,
  							columns: [
  								{ title: "Firstname" },
  								{ title: "Lastname" },
                  { title: "Middlename" },
                  { title: "Rank" },
                  { title: "Action" },
  							]}),
  							crewDataTable = $('#crewtable').DataTable();
  					}
  			},
  	})
  }
  function getDocs(crewid){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'document', option: 'list', id: crewid},
  			success:function(e){
  					if(e){
  						console.log(e);
              var list = e.msg;
              dataSetDoc = [];
              for(num in list){
  							dataSetDoc.push([
  								list[num].code,
  								list[num].docname,
  								list[num].docnum,
                  list[num].dateissued,
                  '<div style="background-color:'+list[num].color+';">'+list[num].dateexpire+'</div>',
                  '<button id="D:'+list[num].id+'" type="button" class="btn btn-info btn-sm viewdoc" data-toggle="modal" data-target="#updateDocModal"><i class="fa fa-eye"></i></button>',
  							]);
    					}
              console.log(dataSetDoc);
              docDataTable.destroy();
  						docDataTable.draw();
  						$('#documenttable').DataTable({
                keys: true,
                draw: true,
                info: false,
                paging: false,
  							data: dataSetDoc,
  							columns: [
  								{ title: "Code" },
  								{ title: "Name" },
                  { title: "Number" },
                  { title: "Issued Date" },
                  { title: "Expiry Date" },
                  { title: "Action" },
  							]}),
  							docDataTable = $('#documenttable').DataTable();
  					}
  			},
  	})
  }
  function viewDoc(docid){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'document', option: 'view', id: docid},
  			success:function(e){
  					if(e){
              var det = e.msg;
              $('#docid').val(det.id);
              $('#ucrewid').val(det.crewid);
              $('#code').val(det.code);
              $('#udoctype').val(det.doctype);
              $('#docname').val(det.docname);
              $('#docnum').val(det.docnum);
              $('#dateexpire').val(det.dateexpire);
              $('#dateissued').val(det.dateissued);
              $('#udocpath').val(det.docpath);
              $('#lastdocpath').val(det.docpath);
              $('#documentfile').val(det.docfile);
              $('#doclink').prop('href',det.docpath);
              $('#uploadedby').val(det.uploadedby);
              $('#dateuploaded').text(det.dateuploaded);
              $('#dateupdated').text(det.dateupdated);
              $('#updated_at').val(det.updated_at);
              $('#created_at').val(det.created_at);
  						console.log(e);
              getDocs(det.crewid);
  					}
  			},
  	})
  }
  function initData(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'defaults', option: 'all'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var def = e.msg;
              var rank = def.ranks;
              var docs = def.documents;
              for(num in rank){
                $('#rankfilter').append('<option value="'+rank[num].name+'">'+rank[num].name+'</option>');
              }
              for(num in rank){
                $('#nrank').append('<option value="'+rank[num].code+'">'+rank[num].name+'</option>');
              }
              for(num in rank){
                $('#rank').append('<option value="'+rank[num].code+'">'+rank[num].name+'</option>');
              }
              for(num in docs){
                $('#doctype').append('<option value="'+docs[num].name+'">'+docs[num].name+'</option>');
              }
              for(num in docs){
                $('#udoctype').append('<option value="'+docs[num].name+'">'+docs[num].name+'</option>');
              }
  					}
  			},
  	})
  }
  function bmi(weight,height){
    var m2 = parseFloat(height) / 100;
    var bmivar = parseFloat(weight) / (m2 * m2);
    return bmivar.toFixed(2);
  }
  $('#rankfilter').on('change',function(event){
    crewDataTable.search($(this).val()).draw();
  });
  $('#searchfilter').on('keyup',function(){
    crewDataTable.search($(this).val()).draw();
  });
  $('#nbirthdate').on('change',function(event){
    $('#nage').val(getAge($(this).val()));
  });
  $('#birthdate').on('change',function(event){
    $('#age').val(getAge($(this).val()));
  });
  function getAge(birthdate){
    const date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    const date1 = new Date(birthdate);
    const date2 = new Date(year+'-'+month+'-'+day);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    const diffYears = Math.floor(diffDays / 365);
    console.log(diffYears + " years");
    return diffYears;
  }

  $(".nav-link.active").removeClass("active");
  $(".nav-link.crew").addClass("active");
</script>
@endsection
