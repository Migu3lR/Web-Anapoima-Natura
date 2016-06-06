var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		"use strict";
		var $dialogAddLimit = $("#dialogAddLimit"),
			dialog = ($.fn.dialog !== undefined),
			validate = ($.fn.validate !== undefined),
			spinner = ($.fn.spinner !== undefined),
			datagrid = ($.fn.datagrid !== undefined);
		
		$("#content").on("click", ".limit-add", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			if ($dialogAddLimit.length > 0 && dialog) {
				$dialogAddLimit.dialog("open");
			}
			return false;
		});
		
		if ($("#grid").length > 0 && datagrid) {
			
			var $grid = $("#grid").datagrid({
				buttons: [{type: "delete", url: "index.php?controller=pjAdminLimits&action=pjActionDeleteLimit&id={:id}", align: "center"}],
				columns: [
				          {text: myLabel.room, type: "select", sortable: true, editable: true, options: myLabel.rooms, width: 260, editableWidth: 240},
				          {text: myLabel.date_from, type: "date", sortable: true, editable: false, width: 120, editableWidth: 100, 
								jqDateFormat: pjGrid.jqDateFormat, 
								renderer: $.datagrid._formatDate, 
								editableRenderer: $.datagrid._formatDate,
								dateFormat: pjGrid.jsDateFormat
				          },
				          {text: myLabel.date_to, type: "date", sortable: true, editable: false, width: 120, editableWidth: 100,
								jqDateFormat: pjGrid.jqDateFormat, 
								renderer: $.datagrid._formatDate, 
								editableRenderer: $.datagrid._formatDate,
								dateFormat: pjGrid.jsDateFormat		
				          },
				          {text: myLabel.start_on, type: "select", sortable: true, editable: true, width: 120, editableWidth: 100, options: [
                             {label: myLabel.any, value: 7},
                             {label: myLabel.mon, value: 1},
                             {label: myLabel.tue, value: 2},
                             {label: myLabel.wed, value: 3},
                             {label: myLabel.thu, value: 4},
                             {label: myLabel.fri, value: 5},
                             {label: myLabel.sat, value: 6},
                             {label: myLabel.sun, value: 0}
                           ]},
				          {text: myLabel.min_nights, type: "spinner", min: 0, max: 255, step: 1, sortable: true, editable: true, width: 110, editableWidth: 50},
				          {text: myLabel.max_nights, type: "spinner", min: 0, max: 255, step: 1, sortable: true, editable: true, width: 110, editableWidth: 50}
				          ],
				dataUrl: "index.php?controller=pjAdminLimits&action=pjActionGetLimits",
				dataType: "json",
				fields: ['room_id', 'date_from', 'date_to', 'start_on', 'min_nights', 'max_nights'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminLimits&action=pjActionDeleteLimitBulk", render: true, confirmation: myLabel.delete_confirmation}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminLimits&action=pjActionSaveLimit&id={:id}",
				select: {
					field: "id",
					name: "record[]"
				}
			});
		}
		
		if ($dialogAddLimit.length > 0 && dialog) {
			$dialogAddLimit.dialog({
				autoOpen: false,
				resizable: false,
				draggable: false,
				modal: true,
				width: 500,
				open: function () {
					$dialogAddLimit.html("");
					$.get("index.php?controller=pjAdminLimits&action=pjActionAddLimit").done(function (data) {
						$dialogAddLimit.html(data);
						$dialogAddLimit.find("input[name='min_nights'], input[name='max_nights']").spinner({
							min: 0,
							max: 255,
							step: 1
						});
						
						$dialogAddLimit.find("form").validate({
							errorPlacement: function (error, element) {
								error.insertAfter(element.parent());
							},
							onkeyup: false,
							errorClass: "err",
							wrapper: "em",
							submitHandler: function (form) {
								$.post("index.php?controller=pjAdminLimits&action=pjActionAddLimit", $dialogAddLimit.find("form").serialize()).done(function (data) {
									$(".empty-page").remove();
									$("#grid").parent().show();
									var content = $grid.datagrid("option", "content");
									$grid.datagrid("load", "index.php?controller=pjAdminLimits&action=pjActionGetLimits", "date_from", "ASC", content.page, content.rowCount);
								}).always(function () {
									$dialogAddLimit.dialog("close");
								});
								return false;
							}
						});
						
						$dialogAddLimit.dialog("option", "position", "center");
					});
				},
				buttons: {
					'Save': function () {
						$dialogAddLimit.find("form").trigger("submit");
					},
					'Cancel': function () {
						$(this).dialog("close");
					}
				}
			});
		}
		
		$(document).on("focusin", ".datepick", function (e) {
			var $this = $(this);
			$this.datepicker({
				dateFormat: $this.attr("rev"),
				firstDay: $this.attr("rel"),
				dayNames: ($this.data("day")).split(","),
			    monthNames: ($this.data("months")).split(","),
			    monthNamesShort: ($this.data("shortmonths")).split(","),
			    dayNamesMin: ($this.data("daymin")).split(",")
			});
		}).on("click", ".pj-form-field-icon-date", function (e) {
			var $dp = $(this).parent().siblings("input[type='text']");
			if ($dp.hasClass("hasDatepicker")) {
				$dp.datepicker("show");
			} else {
				$dp.trigger("focusin").datepicker("show");
			}
		});
	});
})(jQuery_1_8_2);