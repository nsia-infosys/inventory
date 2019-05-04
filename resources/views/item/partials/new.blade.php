 <div class="modal fade" id="create-item-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add Items</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="title">IMEI</label>
                <input type="text" name="item_imei" class="form-control" data-error="Please enter item IMEI." required />
                <div class="error"></div>
            </div>
            <ul class="unsaved-list list-group" style="margin-bottom: 10px;">
            </ul>
            <div class="form-group">
                <button type="button" class="btn btn-success save-list-btn" onClick="saveList()"><span class="spinner-border spinner-border-sm" style="display: none;" role="status" aria-hidden="true"></span> Submit</button>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
// $(document).ready(function () {
//     $(".li-remove").on("click", function(e) {
        
//     })
// });

$("input[name='item_imei']").on('keyup', function (e) {
    if (e.keyCode == 13) {
        if(isValidInput(e.currentTarget.value)) {
            $(".error").text("");
            addToList(e.currentTarget.value);
            e.currentTarget.value = "";
        } else {
            e.currentTarget.value = "";
            $(".error").text("Invalid input.");
            $(e.currentTarget).trigger("focus");
        }
        
    }
});

function isValidInput(text) {
    if(!isNaN(text) && text.length == 15) {
        return true;
    }
    return false;
}

function addToList(text) {
    var unsavedListEl = $(".unsaved-list");
    var liEl = $("<li>").addClass("list-group-item").appendTo(unsavedListEl);
    var spanEl = $("<span>").addClass("li-value").text(text).appendTo(liEl);
    $('<button type="button" onClick="removeLiEl(this)" class="close li-remove" aria-label="Close"><span aria-hidden="true">&times;</span></button>').appendTo(liEl);

}

function removeLiEl(el) {
    $(el).closest("li").remove();
}

function saveList() {
    var dummyList = [];
    var unsavedListEl = $(".unsaved-list");
    var modalEl = $("#create-item-modal");
    var liEls = unsavedListEl.children();
    
    if(liEls.length > 0) {
        console.log("Saving List");
        liEls.each(function(index, liEl) {
            dummyList.push($('.li-value', liEl).text());
        });

        addItems(modalEl, dummyList);
    }
}
</script>