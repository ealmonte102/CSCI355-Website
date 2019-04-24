$(document).ready(function() {
    $(".datepicker").datepicker();
    $(".dropdown-trigger").dropdown();
    $("select").formSelect();
    $(".collapsible").collapsible();
    $("textarea").keydown(function(e) {
        if (e.keyCode === 9) {
            var start = this.selectionStart;
            var end = this.selectionEnd;
            var $this = $(this);
            var value = $this.val();
            $this.val(value.substring(0, start) +
                "\t" +
                value.substring(end));
            this.selectionStart = this.selectionEnd = start + 1;
            e.preventDefault();
        }
    });
    $("#outputFiles").change(onFilesUpdated);
    $("#inputFiles").change(onFilesUpdated);
    $("#sourceCodeFile").change(onFilesUpdated);
});

/**
 * @param {Element} tableToUpdate
 * @param {Array<File>} fileList
 */
function onFilesUpdated(event) {
    var tableToUpdate = $(`#${event.currentTarget.getAttribute("id")}TableBody`);
    var fileList = event.currentTarget.files;
    updateTable(tableToUpdate, fileList);
}

function updateTable(tableToUpdate, fileList) {
    tableToUpdate.empty();
    for(i = 0; i < fileList.length; ++i) {
        tableToUpdate.append(`<tr><td>${fileList[i].name}</td></tr>`);
    }
}