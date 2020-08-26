function check_all() {
    // $(".check_all").click(function() {
    //     $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    // });

    $("input[class = 'item_checkbox']:checkbox").each(function() {
        if ($("input[class = check_all]:checkbox:checked").length == 0) {
            $(this).prop("checked", false);
        } else {
            $(this).prop("checked", true);
        }
    });
}

function delete_all() {
    $(document).on("click", ".del_all", function() {
        $("#form_data").submit();
    });
    $(document).on("click", ".delBtn", function() {
        var items_checked = $("input[class = 'item_checkbox']:checkbox").filter(
            ":checked"
        ).length;
        if (items_checked > 0) {
            $(".not_empty_record").removeClass("d-none");
            $(".empty_record").addClass("d-none");
            $(".record_count").text(items_checked);
        } else {
            $(".not_empty_record").addClass("d-none");
            $(".empty_record").removeClass("d-none");
            $(".record_count").text("");
        }
        $("#mutlipleDelete").modal("show");
        // console.log(items_checked);
    });
}
