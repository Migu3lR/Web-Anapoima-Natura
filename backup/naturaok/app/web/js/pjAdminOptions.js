var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		"use strict";
		var tabs = ($.fn.tabs !== undefined),
			dialog = ($.fn.dialog !== undefined),
			$dialogExample = $("#dialogExample"),
			$mceEditor = $(".mceEditor"),
			$emailType = $("select[name='email_type']"),
			$tabs = $("#tabs");
		
		if ($tabs.length > 0 && tabs) {
			$tabs.tabs();
		}
		
		$(".field-int").spinner({
			min: 0
		});
		
		if ($mceEditor.length > 0) {
			attachTinyMce.call(null, {
				width: 970
			});
		}
		
		function reDrawCode() {
			var code = $("#hidden_code").text(),
				theme = $("select[name='theme']").find("option:selected").val();
			theme = parseInt(theme.length, 10) > 0 ? "&theme=" + theme : "";
						
			$("#install_code").text(code.replace(/&action=pjActionLoad&cid=(\d+)/g, function(match) {
	            return [match, theme].join("");
	        }).replace(/&action=pjActionLoadCss&cid=(\d+)/g, function(match) {
	            return [match, theme].join("");
	        }));
		}
		
		$("#content").on("focus", ".textarea_install", function (e) {
			var $this = $(this);
			$this.select();
			$this.mouseup(function() {
				$this.unbind("mouseup");
				return false;
			});
		}).on("change", "select[name='theme']", function(e) {
            
            reDrawCode.call(null);
            
		}).on("change", "select[name='value-enum-o_send_email']", function (e) {
			switch ($("option:selected", this).val()) {
			case 'mail|smtp::mail':
				$(".boxSmtp").hide();
				break;
			case 'mail|smtp::smtp':
				$(".boxSmtp").show();
				break;
			}
		}).on("change", "input[name='value-bool-o_allow_paypal']", function (e) {
			if ($(this).is(":checked")) {
				$(".boxPaypal").show();
			} else {
				$(".boxPaypal").hide();
			}
		}).on("change", "input[name='value-bool-o_allow_authorize']", function (e) {
			if ($(this).is(":checked")) {
				$(".boxAuthorize").show();
			} else {
				$(".boxAuthorize").hide();
			}
		}).on("change", "input[name='value-bool-o_allow_bank']", function (e) {
			if ($(this).is(":checked")) {
				$(".boxBank").show();
			} else {
				$(".boxBank").hide();
			}
		}).on("change", "select[name='email_type']", function (e) {
			$.get("bookAdmin.php?controller=pjAdminOptions&action=pjActionUpdateEmail", {
				"type": $(this).find("option:selected").val()
			}).done(function (data) {
				$("#boxEmails").html(data);
				attachTinyMce.call(null);
			});
		}).on("click", ".btn-example", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			if ($dialogExample.length > 0 && dialog) {
				$dialogExample.dialog("open");
			}
			return false;
		}).on("change", "select[name='value-enum-o_theme']", function () {
			var $this = $(this),
				value = $this.find("option:selected").val(),
				theme = value.match(/::(\d+)$/),
				$a = $this.siblings("a.pj-table-icon-eye");
			
			if ($a.length > 0 && theme !== null) {
				$a.attr("href", $a.attr("href").replace(/&theme=(\d+)/, '&theme=' + theme[1]));
			}
		});
		
		if ($dialogExample.length > 0 && dialog) {
			$dialogExample.dialog({
				modal: true,
				autoOpen: false,
				resizable: false,
				draggable: false,
				width: 600,
				open: function () {
					$.get("bookAdmin.php?controller=pjAdminOptions&action=pjActionGetExample").done(function (data) {
						$dialogExample.html(data);
						
						var editor_1 = CodeMirror.fromTextArea(document.getElementById("install-example-1"), {
							lineNumbers: true,
							readOnly: true,
						    mode: "text/html"
						});
						/*var editor_2 = CodeMirror.fromTextArea(document.getElementById("install-example-2"), {
							lineNumbers: true,
							readOnly: true,
						    mode: "text/html"
						});*/
						var editor_3 = CodeMirror.fromTextArea(document.getElementById("install-example-3"), {
							lineNumbers: true,
							readOnly: true,
						    mode: "text/html"
						});
						$dialogExample.find("#methods").tabs();
						
						$dialogExample.dialog("option", "position", "center");
					});
				},
				buttons: {
					"Close": function () {
						$dialogExample.dialog("close");
					}
				}
			});
		}
		
		function attachTinyMce(options) {
			if (window.tinymce !== undefined) {
				tinymce.EditorManager.editors = [];
				//tinymce.EditorManager.execCommand('mceRemoveEditor', true, ".mceEditor");
				//tinymce.EditorManager.execCommand('mceAddEditor', false, ".mceEditor");
				var defaults = {
					selector: "textarea.mceEditor",
					theme: "modern",
					width: 790,
					height: 500,
					plugins: [
				         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				         "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				         "save table contextmenu directionality emoticons template paste textcolor"
				    ],
				    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
				};
				
				var settings = $.extend({}, defaults, options);
				
				tinymce.init(settings);
			}
		}
		
		if ($emailType.length > 0) {
			var index = 1,
				m = window.location.search.match(/&email_type=(\w+)/);
			if (m !== null) {
				index = $emailType.find('option[value="'+ m[1] + '"]').index();
			}
			$emailType.get(0).selectedIndex = index;
			$emailType.trigger("change");
		}
	});
})(jQuery_1_8_2);