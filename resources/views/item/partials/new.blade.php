 <div class="modal fade" id="create-item-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add Items</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="title">IMEI/SN</label>
                <input type="text" name="item_label" class="form-control" data-error="Please enter item IMEI." required />
                <div class="error"></div>
            </div>
            <ul class="temp-list list-group" style="margin-bottom: 10px;">
                <li class="list-group-item">EMEI: <span id="temp-emei"></span><button type="button" onClick="clearTempEmei(this)" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>
                <li class="list-group-item">SN: <span id="temp-sn"></span><button type="button" onClick="clearTempSn(this)" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>
            </ul>
            <hr>
            <ul class="unsaved-list list-group" style="margin-bottom: 10px;">
            </ul>
            <span class="message"></span>
            <!-- <div class="form-group">
                <button type="button" class="btn btn-success save-list-btn" onClick="saveList()"><span class="spinner-border spinner-border-sm" style="display: none;" role="status" aria-hidden="true"></span> Submit</button>
            </div> -->
        </div>
    </div>
    </div>
</div>

<script>
// $(document).ready(function () {
//     $(".li-remove").on("click", function(e) {
        
//     })
// });

$("input[name='item_label']").on('keyup', function (e) {
    
    if (e.keyCode == 13) {
        var validation = isValidInput(e.currentTarget.value);
        if(validation == 1) {
            $(".error").text("");
            // addToList(e.currentTarget.value, 1);
            addToTempList(e.currentTarget.value, 1);
            e.currentTarget.value = "";
        } else if(validation == 2) {
            $(".error").text("");
            // addToList(e.currentTarget.value, 2);
            addToTempList(e.currentTarget.value, 2);
            e.currentTarget.value = "";
        } else {
            e.currentTarget.value = "";
            $(".error").text("Invalid input.");
            $(e.currentTarget).trigger("focus");
        }
        
        addToList();
    }
});

function isValidInput(text) {
    if(!isNaN(text) && text.length == 15) {
        // 1 represents that text is valid imei
        return 1;
    } else if(text.startsWith("SVT") && text.length == 11) {
        // 1 represents that text is valid sn
        return 2;
    }
    // 0 represents that text is invalid input
    return 0;
}

function addToTempList(text, type) {
    var tempListEl = $(".temp-list");
    var emeiEl = $("#temp-emei", tempListEl);
    var snEl = $("#temp-sn", tempListEl);

    if(text.length > 0) {
        if(type == 1) {
            $(emeiEl).text(text);
        } else if(type == 2) {
            $(snEl).text(text);
        }
    }
}

function clearTempEmei(el) {
    var liEl = $(el).closest("li");
    $("#temp-emei", liEl).text("");
}

function clearTempSn(el) {
    var liEl = $(el).closest("li");
    $("#temp-sn", liEl).text("");;
}

function clearTempList() {
    var tempListEl = $(".temp-list");
    var emeiEl = $("#temp-emei", tempListEl);
    var snEl = $("#temp-sn", tempListEl);
    $(emeiEl).text("");
    $(snEl).text("");
}

function addToList(text) {
    var modalEl = $("#create-item-modal");
    var tempListEl = $(".temp-list");
    var emeiEl = $("#temp-emei", tempListEl);
    var snEl = $("#temp-sn", tempListEl);

    if($(emeiEl).text().length < 1) {
        //if emei value is not picked then it is not pushed to list
        return false;
    }

    if($(snEl).text().length < 1) {
        //if sn value is not picked then it is not pushed to list
        return false;
    }

    // var unsavedListEl = $(".unsaved-list");
    // var liEl = $("<li>").addClass("list-group-item").appendTo(unsavedListEl);
    // var spanEmeiEl = $("<span>").addClass("li-emei").text($(emeiEl).text()).appendTo(liEl);
    // var spanEmeiEl = $("<span>").text("  -  ").appendTo(liEl);
    // var spanSnEl = $("<span>").addClass("li-sn").text($(snEl).text()).appendTo(liEl);
    // $('<button type="button" onClick="removeLiEl(this)" class="close li-remove" aria-label="Close"><span aria-hidden="true">&times;</span></button>').appendTo(liEl);

    addItem(modalEl, $(emeiEl).text(), $(snEl).text());
}


function removeLiEl(el) {
    $(el).closest("li").remove();
}

// function saveList() {
//     var dummyList = [];
//     var unsavedListEl = $(".unsaved-list");
//     var modalEl = $("#create-item-modal");
//     var liEls = unsavedListEl.children();
    
//     if(liEls.length > 0) {
//         console.log("Saving List");
//         liEls.each(function(index, liEl) {
//             dummyList.push($('.li-value', liEl).text());
//         });

//         addItems(modalEl, dummyList);
//     }
// }
</script>