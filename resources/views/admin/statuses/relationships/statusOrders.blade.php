<div class="content">
    @can('order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-statusOrders">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.game') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.gampanion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.gampanion.fields.level') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.quantity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.approved_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.rejected_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.proposed_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.request_note') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $order)
                                    <tr data-entry-id="{{ $order->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $order->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->game->game_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->status->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->gampanion->level ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->gampanion->level ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->quantity ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->approved_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->rejected_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->proposed_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->request_note ?? '' }}
                                        </td>
                                        <td>
                                            @can('order_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('order_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('order_delete')
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-statusOrders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection