@extends('backend.layout.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Quản lý tiêu chí
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Tiêu chí</a></li>
                <li><a href="{{ route('backend.criteria.index') }}">Quản lý tiêu chí</a></li>
                <li class="active">Tất cả</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        @if (Session::has('success'))
                            <div class="alert-custom">
                                <div class="alert alert-success">{{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="box-body">
                            <table id="criterias" class="table table-bordered table-striped set__width">
                                <a href="{{ route('backend.criteria.create') }}" class="btn btn-primary new-custom"><i
                                        class="fa fa-plus"></i> Thêm mới</a>
                                <a href="#" class="btn btn-danger delete-all new-custom"
                                    style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
                                <thead>
                                    <tr>
                                        <th>
                                            <label style="margin-bottom: 0px">
                                                <input type="checkbox" id="selectall">
                                            </label>
                                        </th>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Hiển thị</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($criterias as $k => $criteria)
                                      <tr id="tr_{{ $criteria->id }}">
                                          <td>
                                              <input type="checkbox" class="checkbox"
                                                  data-id="{{ $criteria->id }}">
                                          </td>
                                          <td>
                                              <div class="form-group">
                                                  <input type="text" data-id="{{ $criteria->id }}"
                                                      value="@if (isset($criteria->stt)) {{ old('stt', $criteria->stt) }}@else{{ old('stt') }} @endif"
                                                      class="stt" data-toggle="tooltip" data-placement="top"
                                                      title="Nhập số thứ tự"
                                                      style="max-width: 50px; text-align: center">
                                              </div>
                                          </td>
                                          <td><a href="{{ route('backend.criteria.edit', $criteria->id) }}"><img
                                                      src="/storage/uploads/{{ $criteria->img }}"
                                                      class="img-thumbnail"
                                                      style="margin-bottom: 0px; max-width: 50px"></a></td>
                                          <td><a
                                                  href="{{ route('backend.criteria.edit', $criteria->id) }}">{{ $criteria->name }}</a>
                                          </td>
                                          <td>
                                              <input data-id="{{ $criteria->id }}" class="hide_show"
                                                  type="checkbox" data-on="<i class='fa fa-check'></i>"
                                                  data-off="<i class='fa fa-times'></i>"
                                                  {{ $criteria->hide_show ? 'checked' : '' }} data-toggle="toggle"
                                                  data-onstyle="success" data-offstyle="danger" data-style="ios"
                                                  data-size="mini">
                                          </td>
                                          <td>
                                              <a class="btn btn-primary" data-toggle="tooltip"
                                                  data-placement="top" title="Sửa hình ảnh"
                                                  href="{{ route('backend.criteria.edit', $criteria->id) }}"><i
                                                      class="fa fa-edit"></i></a>
                                              <form method="POST"
                                                  action="{{ route('backend.criteria.destroy', $criteria->id) }}"
                                                  onclick="return confirm('Xác nhận Xoá ?')"
                                                  style="display: inline;">
                                                  @csrf
                                                  {{ method_field('DELETE') }}
                                                  <button class="btn btn-danger" data-toggle="tooltip"
                                                      data-placement="top" title="Xóa hình ảnh"><i
                                                          class="fa fa-trash"></i></button>
                                              </form>
                                          </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('backend.criteria.create') }}" class="btn btn-primary new-custom"><i
                                    class="fa fa-plus"></i> Thêm mới</a>
                            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i>
                                Xoá chọn</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#selectall').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".checkbox").prop('checked', true);
                } else {
                    $(".checkbox").prop('checked', false);
                }
            });
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#selectall').prop('checked', true);
                } else {
                    $('#selectall').prop('checked', false);
                }
            });
            $('.delete-all').on('click', function(e) {
                var idsArr = [];
                $(".checkbox:checked").each(function() {
                    idsArr.push($(this).attr('data-id'));
                });
                if (idsArr.length <= 0) {
                    alert("Vui lòng check chọn nội dung cần Xoá !");
                } else {
                    if (confirm("Xác nhận Xoá tất cả nội dung đã chọn ?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ route('backend.criteria.deletemultiple') }}",
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + strIds,
                            success: function(data) {
                                if (data['status'] == true) { // if true (1)
                                    setTimeout(function() { // wait for 3 secs(2)
                                        location.reload(); // then reload the page.(3)
                                    }, 3000);
                                    $(".checkbox:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['message']);
                                } else {
                                    alert('Rất tiếc, đã có lỗi xảy ra !');
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        });
    </script>

    <script>
        function switchChange() {
            $('#criterias').on('change', 'input[class="hide_show"]', function() {
                var hide_show = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('backend.criteria.hideshow') }}',
                    data: {
                        'hide_show': hide_show,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        }

        $(document).ready(function() {
            switchChange();

            $(function() {
                $('#criterias').on('change', 'input[class="stt"]', function() {
                    var stt = $(this).val();
                    var id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '{{ route('backend.criteria.changestt') }}',
                        data: {
                            'stt': stt,
                            'id': id
                        },
                        success: function(data) {
                            console.log(data.success)
                        }
                    });
                })
            })

        })
    </script>
    

@endpush
