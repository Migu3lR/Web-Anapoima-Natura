var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		var datagrid = ($.fn.datagrid !== undefined);

		if ($("#grid").length > 0 && datagrid) {
			var $grid = $("#grid").datagrid({
				buttons: [],
				columns: [
				    {text: "File name", type: "text", sortable: true, editable: false},
				    {text: "Function", type: "text", sortable: true, editable: false},
				    {text: "Description", type: "text", sortable: true, editable: false},
				    {text: "Date/Time", type: "text", sortable: true, editable: false, width: 100}
				],
				dataUrl: "bookAdmin.php?controller=pjLog&action=pjActionGetLog",
				dataType: "json",
				fields: ['filename', 'function', 'value', 'created'],
				paginator: {
					actions: [
					   {text: "Delete selected", url: "bookAdmin.php?controller=pjLog&action=pjActionDeleteLogBulk", render: true, confirmation: "Are you sure you want to delete selected records?"}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				select: {
					field: "id",
					name: "record[]"
				}
			});
			
			$(document).on("click", ".btn-empty", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				$.post("bookAdmin.php?controller=pjLog&action=pjActionEmptyLog").done(function (data) {
					$grid.datagrid("load", "bookAdmin.php?controller=pjLog&action=pjActionGetLog");
				});
				return false;
			});
		}
	});
})(jQuery_1_8_2);