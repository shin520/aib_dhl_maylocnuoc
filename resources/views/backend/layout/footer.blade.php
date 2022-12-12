 <!-- Main Footer -->
 <footer class="main-footer">
  <!-- To the right -->
  <div class="pull-right hidden-xs">
    CMS V1.0
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="https://vnlar.vn">VNLAR.vn</a>.</strong> All rights reserved.
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane active" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:;">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
              <p>Will be 23 on April 24th</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->
      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:;">
            <h4 class="control-sidebar-subheading">
              Custom Template Design
              <span class="pull-right-container">
                <span class="label label-danger pull-right">70%</span>
              </span>
            </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->
    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
            <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED JS SCRIPTS -->
  <!-- jQuery 3.4.1 -->
  <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>
  {{-- <script type="text/javascript" src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
  <!-- Bootstrap 3.3.7 -->
  <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/backend/bower_components/bootstrap-validate/dist/bootstrap-validate.js"></script>
  <script src="/backend/bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
  <!-- Select2 -->
  <script src="/backend/bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="/backend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="/backend/bower_components/datatables.net/js/dataTables.responsive.js"></script>
  <!-- bootstrap datepicker -->
  <script src="/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- SlimScroll -->
  <script src="/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="/backend/plugins/iCheck/icheck.min.js"></script>
  <!-- FastClick -->
  <script src="/backend/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- Sparkline -->
  
  <!-- jvectormap  -->
  <script src="/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- ChartJS -->
  <script src="/backend/bower_components/chart.js/Chart.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  {{-- <script src="/backend/dist/js/pages/dashboard2.js"></script> --}}
  <!-- AdminLTE App -->
  <script src="/backend/dist/js/adminlte.min.js"></script>
  <script src="/backend/plugins/jQueryfiler/js/jquery.filer.min.js"></script>
  <script src="/backend/plugins/jQueryfiler/examples/dragdrop/js/custom.js" type="text/javascript"></script>
  {{-- <script src="/backend/assets/js/jquery.pjax.js"></script> --}}
  <script src="/backend/assets/js/pace.min.js"></script>

  <script src="/frontend/assets/js/plyr.js"></script>
  {{-- <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.js"></script> --}}
  
  <script type="text/javascript" src="/backend/assets/js/script.js"></script>
  {{-- <script type="text/javascript">
    $(document).ready(function () {
        $("#accordion").accordion({
            'collapsible': true,
            'active': null,
            'heightStyle': 'content'
        });
        $('.jquery').each(function () {
            eval($(this).html());
        });
        $('.button').button();
    });
</script> --}}
  <script>
    const player = new Plyr('#player');
  </script>


    <script src="https://www.google.com/recaptcha/api.js?render={{ $setting->site_key }}"></script>
    <script>
      var id_recaptcha = document.getElementById("recaptcha");
    if(id_recaptcha){
        grecaptcha.ready(function() {
        grecaptcha.execute('{{ $setting->captcha_sitekey }}', {action: 'contact'}).then(function(token) {
            if (token) {
              document.getElementById('recaptcha').value = token;
            }
        });
    });
    }
  </script>

  
  <script src="{{asset('/backend/plugins/ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('/backend/plugins/ckfinder/ckfinder.js')}}"></script> 
  {{-- <script>
    $(document).ready(function(){
      $(document).pjax('a', '#pjax-container')
        // does current browser support PJAX
        if ($.support.pjax) {
          $.pjax.defaults.timeout = 1000; // time in milliseconds
        }
        
    });
  </script> --}}
  {{-- <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    // CKEDITOR.replace( 'editor1' );
  </script> --}}
  
  <!-- page script -->
  {{-- <script>
    $(function() {
      $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
        $.ajax({
          // headers: {
          //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          // }
          type: "GET",
          dataType: "json",
          // url: '{{ route('backend.user.editstatus') }}',
          url: '/administrator/users/editStatus',
          data: {'status': status, 'user_id': user_id},
          success: function(data){
            console.log(data.success)
          }
        });
      })
    })
  </script> --}}
  <script>
    $(function () {
      $('#orders').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,8] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#articles').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,2,7] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
    $(function () {
      $('#videos').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,2,7] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
    $(function () {
      tableData = $('#products').DataTable({
      'order'       : [1], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,3,4,6,7,8,9] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
      // Apply the search
      tableData.columns().every(function () {
          let that = this;
          $('select', this.header()).change(function (e) {
              if (that.search() !== this.value) {
                  that.search(this.value).draw();
              }
          });
      });
    })
    $(function () {
      $('#domainprices').DataTable({
      'order'       : [0], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,6] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#blogs').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,2,6] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#domains').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,2,6] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#posts').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,7] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#servis').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,6] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#feeships').DataTable({
      'order'       : [0], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,3,5] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#supports').DataTable({
      'order'       : [0], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,2,6] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#sliders').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,5] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
    $(function () {
      $('#socials').DataTable({
      'order'       : [0], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,5] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#partners').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,2,6] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    })
  </script>
  <script>
    $(function () {
      $('#categories').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,2,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
    $(function () {
      $('#procatones').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
    $(function () {
     tableData = $('#procattwos').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,2,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
      // Apply the search
      tableData.columns().every(function () {
        let that = this;
        $('select', this.header()).change(function (e) {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
      });
    })
    $(function () {
      tableData = $('#procatthrees').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,2,3,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
      // Apply the search
      tableData.columns().every(function () {
          let that = this;
          $('select', this.header()).change(function (e) {
              if (that.search() !== this.value) {
                  that.search(this.value).draw();
              }
          });
      });
    })
  </script>
  <script>
    $(function () {
      $('#coupons').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#svcategories').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,2,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    // $(function () {
    //   $('#svservices').DataTable({
    //     'order'       : [0],
    //     'responsive'  : true,
    //     'paging'      : true,
    //     'lengthChange': true,
    //     'searching'   : true,
    //     'ordering'    : true,
    //     'info'        : true,
    //     'autoWidth'   : true,
    //     'columnDefs': [
    //     { 'orderable': false, 'targets': [0,2,7] }
    //     ],
    //     'language': {
    //       "sProcessing":   "Đang xử lý...",
    //       "sLengthMenu":   "Xem _MENU_ mục",
    //       "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
    //       "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
    //       "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
    //       "sInfoFiltered": "(được lọc từ _MAX_ mục)",
    //       "sInfoPostFix":  "",
    //       "sSearch":       "Tìm:",
    //       "sUrl":          "",
    //       "oPaginate": {
    //         "sFirst":    "Đầu",
    //         "sPrevious": "Trước",
    //         "sNext":     "Tiếp",
    //         "sLast":     "Cuối"
    //       }
    //     }
    //   })
    // })
    $(function () {
      $('#customers').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,2,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
    $(function () {
      $('#whys').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,2,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#policies').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,2,5] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#webs').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,2,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#newcategories').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,2,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#contactforms').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,6,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
    $(function () {
      $('#prices').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,6,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#carts').DataTable({
        'order'       : [3],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#payments').DataTable({
        'order'       : [3],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#tags').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,7] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#pages').DataTable({
        'order'       : [2],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,2,8] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('#users').DataTable({
        'order'       : [0],
        'responsive'  : true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'columnDefs': [
        { 'orderable': false, 'targets': [0,1,6] }
        ],
        'language': {
          "sProcessing":   "Đang xử lý...",
          "sLengthMenu":   "Xem _MENU_ mục",
          "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
          "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
          "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
          "sInfoFiltered": "(được lọc từ _MAX_ mục)",
          "sInfoPostFix":  "",
          "sSearch":       "Tìm:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
          }
        }
      })
    })
  </script>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>


  <script>
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })
</script>
{{-- custom datepicker --}}
<script>
  var date = new Date();
  var seconds = date.getSeconds();
  var minutes = date.getMinutes();
  var hour = date.getHours();
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd '+hour+':'+minutes+':'+seconds,
    startDate: date
  })
</script>
{{-- end custom datepicker --}}
{{-- custom datepicker --}}
<script>
  var date = new Date();
  var seconds = date.getSeconds();
  var minutes = date.getMinutes();
  var hour = date.getHours();
  $('#datepicker2').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd '+hour+':'+minutes+':'+seconds,
    startDate: date
  })
</script>
{{-- end custom datepicker --}}
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <script type="text/javascript">
      jQuery(function($) {
        $('body').on('click', '#selectall', function() {
          $('.singlechkbox').prop('checked', this.checked);
        });

        $('body').on('click', '.singlechkbox', function() {
          if($(".singlechkbox").length == $(".singlechkbox:checked").length) {
            $("#selectall").prop("checked", "checked");
          } else {
            $("#selectall").removeAttr("checked");
          }
        });
      });
    </script>
    <script>
      $("#name").on("keyup",function(event){
        checkTextAreaMaxLength(this,event);
      });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLength(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeys(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeys(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
<script>
  $("#title").on("keyup",function(event){
    checkTextAreaMaxLengthTitle(this,event);
  });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLengthTitle(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeysTitle(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter-title").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeysTitle(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
<script>
  $("#keywords").on("keyup",function(event){
    checkTextAreaMaxLengthKeywords(this,event);
  });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLengthKeywords(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeysKeywords(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter-keywords").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeysKeywords(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
<script>
  $("#description").on("keyup",function(event){
    checkTextAreaMaxLengthDescription(this,event);
  });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLengthDescription(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeysDescription(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter-description").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeysDescription(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
<script>
  $("#slug").on("keyup",function(event){
    checkTextAreaMaxLengthSlug(this,event);
  });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLengthSlug(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeysSlug(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter-slug").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeysSlug(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
<script>
  $("#descriptions").on("keyup",function(event){
    checkTextAreaMaxLengthDescriptions(this,event);
  });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLengthDescriptions(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeysDescriptions(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter-descriptions").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeysDescriptions(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
<script>
  $("#nameindex").on("keyup",function(event){
    checkTextAreaMaxLengthNameindex(this,event);
  });
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:  textBox = textarea dom element
          e = textarea event
                  length = Max length of characters
                  */
                  function checkTextAreaMaxLengthNameindex(textBox, e) { 

                    var maxLength = parseInt($(textBox).data("length"));


                    if (!checkSpecialKeysNameindex(e)) { 
                      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
                    } 
                    $("#charcounter-index").html('(' + '<span class="counter">' + (maxLength - textBox.value.length) + '</span>' + ' kí tự còn lại)');

                      return true; 
                    } 
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:  e = e.keyCode object for the key pressed
  */
  function checkSpecialKeysNameindex(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
</script>
{{-- <script>
  $('#name').change(function(e) {
    $.get('{{ route('backend.article.checkslug') }}', 
      { 'name': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
      );
  });
</script> --}}

{{-- <script>
  $('#title').change(function(e) {
    $.get('{{ route('pages.check_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script> --}}

<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name', function() {
      var title1 = ($(this).val());
      $('div#title1').text(title1);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'textarea#descriptions', function() {
      var descriptions = ($(this).val());
      $('div#descriptions1').text(descriptions);
    });
  });
</script>
{{-- <script>
  $('document').ready(function () {

    $(document).on('change', 'input#name', function() {
      var slug1 = createslug($(this).val());
      $('div#slug1').text('{{ route('frontend.home.index')}}/'+slug1+'.html');
    });
  });
  function createslug(text)
  {
    return text.toString().toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
      .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
        .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
          .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
              .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
                .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
                  .replace(/đ/gi, 'd')
                    .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
                      .replace(/\-\-\-\-\-/gi, '-')
                        .replace(/\-\-\-\-/gi, '-')
                          .replace(/\-\-\-/gi, '-')
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, ''); // Trim - from end of text
  }
</script> --}}
<script>
  function AutoSlug()
  {
      var name, slug;
      //Lấy text từ thẻ input name 
      name = document.getElementById("name").value;
      //Đổi chữ hoa thành chữ thường
      slug = name.toLowerCase();
      //Đổi ký tự có dấu thành không dấu
      slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
      slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
      slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
      slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
      slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
      slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
      slug = slug.replace(/đ/gi, 'd');
      //Xóa các ký tự đặt biệt
      slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
      //Đổi khoảng trắng thành ký tự gạch ngang
      slug = slug.replace(/ /gi, "-");
      //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
      //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
      slug = slug.replace(/\-\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-/gi, '-');
      slug = slug.replace(/\-\-/gi, '-');
      //Xóa các ký tự gạch ngang ở đầu và cuối
      slug = '@' + slug + '@';
      slug = slug.replace(/\@\-|\-\@|\@/gi, '');
      //In slug ra textbox có id “slug”
      document.getElementById('slug').value = slug;
  }
</script>
{{-- <script>
  function AutoSlug()
  {
      var name, slug;
      //Lấy text từ thẻ input name 
      name = document.getElementById("name").value;   
      // Chuyển hết sang chữ thường
      slug = name.toLowerCase();     
      // xóa dấu
      slug = slug.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
      slug = slug.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
      slug = slug.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
      slug = slug.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
      slug = slug.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
      slug = slug.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
      slug = slug.replace(/(đ)/g, 'd');
   
      // Xóa ký tự đặc biệt
      slug = slug.replace(/([^0-9a-z-\s])/g, '');
   
      // Xóa khoảng trắng thay bằng ký tự -
      slug = slug.replace(/(\s+)/g, '-');
   
      // xóa phần dự - ở đầu
      slug = slug.replace(/^-+/g, '');
   
      // xóa phần dư - ở cuối
      slug = slug.replace(/-+$/g, '');
      //In slug ra textbox có id “slug”
      document.getElementById('slug').value = slug;
   
      // return
      // return str;
    }
</script> --}}
@stack('script')
</body>
</html>