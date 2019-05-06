@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="javascript:void(0)" style="float: right;" class="btn btn-success mb-2" onclick="newRecord()" id="create-new-items">Add Items</a>
            <table class="table table-bordered" id="item_crud">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Serial No</th>
                        <th>IMEI</th>
                        <th width="250px;">Action</th>
                    </tr>
                </thead>
                <tbody id="items-crud">
                    @foreach($items as $record)
                    <tr id="item_id_{{ $record->id }}">
                        <td>{{ $record->id  }}</td>
                        <td>{{ $record->sn }}</td>
                        <td>{{ $record->imei }}</td>
                        <td>
                            <!-- <a href="/items/{{ $record->id }}/pages" id="view-item" title="Open Item" data-id="{{ $record->id }}" class="btn btn-light"><span class="oi oi-book"></span></a> -->
                            <a href="javascript:void(0)" id="view-item" title="View Item" onclick="viewRecord({{ $record->id }})" data-id="{{ $record->id }}" class="btn btn-light text-info"><span class="oi oi-eye"></span></a>
                            <!-- <a href="javascript:void(0)" id="edit-item" title="Edit Item" onclick="editRecord({{ $record->id }})" data-id="{{ $record->id }}" class="btn btn-light text-primary"><span class="oi oi-pencil"></span></a>
                            <a href="javascript:void(0)" id="delete-item" title="Delete Item" onclick="deleteRecord({{ $record->id }})" data-id="{{ $record->id }}" class="btn btn-light delete-item text-danger"><span class="oi oi-trash"></span></a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>

@include('item.partials.new')

<script>
    $(document).ready(function () {
        $('#create-item-modal').on('shown.bs.modal', function() {
            $('input[name="item_label"]').trigger('focus');
        });
    });

    function refershPage() {
        location.reload();
    }

    function newRecord() {
        console.log("New Record");
        var modalEl = $("#create-item-modal");
        $(modalEl).trigger("reset");
        $(modalEl).modal('show');
        $(modalEl).modal();
        $(".unsaved-list", modalEl).empty();
        clearTempList();
        $('input[name="item_label"]', modalEl).val("").trigger('focus');
    }

    function addItem(modalEl, imei, sn) {
        // $(".save-list-btn", modalEl).prop('disabled', true);
        $("input[name='item_label']", modalEl).prop('disabled', true);
        // $(".spinner-border", modalEl).show();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {imei: imei, sn: sn},
            url : "{!! url('/items'); !!}" ,
            type: "POST",
            dataType: 'json',
        }).done(function (data) {
            console.log(data);
            clearTempList();
            $(".message", modalEl).text("Successfully Saved").fadeIn("slow").fadeOut("slow");
            $("input[name='item_label']", modalEl).prop('disabled', false).trigger('focus');
            // refershPage();
        }).fail(function () {
            $(".message", modalEl).text("Duplicate Found (EMEI/SN).").fadeIn().fadeOut("slow");
            $("input[name='item_label']", modalEl).prop('disabled', false).trigger('focus');
            // $(".spinner-border", modalEl).hide();
            // $(".save-list-btn", modalEl).prop('disabled', false);
            // alert('Data could not be save.');
        });
    }

</script>
@endsection
