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
        <h4>Document Management</h4>
        @if(in_array("document", $logindata['restriction']))
          <div class="row" style="padding-bottom:50px;">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div style="margin-top:10px;padding:20px;background-color: #e3f2fd;">
                    <form id="docform">
                      <input type="hidden" name="type" value="doctype" />
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
                            <input type="text" class="form-control" id="name" name="name"  value="" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <button style="width:100%;" type="button" class="btn btn-success btn-sm" id="adddocbtn">Add Doc Type</button>
                              </div>
                              <div class="col-md-3">
                                <button style="width:100%;" type="button" class="btn btn-warning btn-sm" id="resetdocbtn">Reset Doc Type</button>
                              </div>
                              <div class="col-md-3">
                                <button style="display:none;width:100%;" type="button" class="btn btn-primary btn-sm" id="updatedocbtn">Update Doc Type</button>
                              </div>
                              <div class="col-md-3">
                                <button style="display:none;width:100%;" type="button" class="btn btn-danger btn-sm" id="deletedocbtn">Delete Doc Type</button>
                              </div>
                            
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-6">
                  <div style="margin-top:10px;padding:20px;border:1px solid rgba(0,0,0,0.5);min-height:500px;">
                  <table id="doctable" class="table table-striped table-hover" style="width:100%;font-size:0.9em;">
                    <thead>
                      <tr>
                        <th>Code</th>
                        <th>Document Name</th>
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
  var docDataTable = $('#doctable').DataTable({
    keys: true,
    draw: true,
    info: false,
    paging: false,
    order: false,
  });
  $(document).ready(function(){});
  $('#adddocbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#docform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              getDoc();
              swal(e.msg,"success");
              resetDoc();
  					}
  			},
  	})
  });
  $('#resetdocbtn').on('click',function(event){
    resetDoc();
  });
  $('#updatedocbtn').on('click',function(event){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: $('#docform').serialize(),
  			success:function(e){
  					if(e){
  						console.log(e);
              getDoc();
              swal(e.msg,"success");
              resetDoc();
  					}
  			},
  	})
  });
  $('#deletedocbtn').on('click',function(event){
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
    			data: {type: 'doctype', option: 'delete', code: $('#oldcode').val()},
    			success:function(e){
    					if(e){
    						console.log(e);
                getDoc();
                swal(e.msg,"info");
                resetDoc();
    					}
    			},
    	  });
      }
    });
  });
  $(document).on('click','.viewdoc',function(event){
    var rcode = $(this).attr('id');
    rcode = rcode.split("|:|");
    $('#option').val("update");
    $('#oldcode').val(rcode[1]);
    $('#code').val(rcode[1]);
    $('#name').val(rcode[2]);
    $('#updatedocbtn').css('display','block');
    $('#deletedocbtn').css('display','block');
    $('#adddocbtn').css('display','none');
  });
  getDoc();
  function getDoc(){
    $.ajax({
  			url: '/api-request',
  			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  			method: 'POST',
  			data: {type: 'doctype', option: 'list'},
  			success:function(e){
  					if(e){
  						console.log(e);
              var list = e.msg;
              var dataSetDoc = [];
              for(num in list){
  							dataSetDoc.push([
  								list[num].code,
  								list[num].name,
                  '<button id="DC|:|'+list[num].code+'|:|'+list[num].name+'" type="button" class="btn btn-warning btn-sm viewdoc">select</button>',
                ]);
    					}
              docDataTable.destroy();
  						docDataTable.draw();
  						$('#doctable').DataTable({
                "scrollY":"300px",
                keys: true,
                draw: true,
                info: false,
                paging: false,
                order: false,
  							data: dataSetDoc,
  							columns: [
  								{ title: "Code" },
  								{ title: "Name" },
                  { title: "Action" },
  							]}),
  							docDataTable = $('#doctable').DataTable();
  					}
  			},
  	});
  }
  function resetDoc(){
    $('#option').val('new');
    $('#code').val('');
    $('#name').val('');
    $('#updatedocbtn').css('display','none');
    $('#deletedocbtn').css('display','none');
    $('#adddocbtn').css('display','block');
  }
  $(".nav-link.active").removeClass("active");
  $(".nav-link.docs").addClass("active");
</script>
@endsection
