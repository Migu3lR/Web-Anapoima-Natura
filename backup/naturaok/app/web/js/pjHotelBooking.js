/*!
 * Hotel Booking v3.0
 * http://www.phpjabbers.com/hotels-booking-system/
 * 
 * Copyright 2013, StivaSoft Ltd.
 * http://www.phpjabbers.com/license-agreement.php
 * http://www.phpjabbers.com/licence-explained.php
 * 
 * Date: Thu Jun 27 17:26:40 2013 +0200
 */
(function (window, undefined){
	"use strict";

	pjQ.$.ajaxSetup({
		xhrFields: {
			withCredentials: true
		}
	});
	
	pjQ.$.validator.setDefaults({
	    highlight: function(element) {
	        pjQ.$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	    unhighlight: function(element) {
	    	pjQ.$(element).closest('.form-group').removeClass('has-error').addClass("has-success");
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        if(element.parent('.input-group').length || element.prop('type') === 'checkbox') {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	});
	
	var document = window.document,
		validate = (pjQ.$.fn.validate !== undefined),
		dialog = (pjQ.$.fn.dialog !== undefined),
		datepicker = (pjQ.$.fn.datepicker !== undefined),
		fancybox = (pjQ.$.fn.fancybox !== undefined),
		routes = [
	          {pattern: /^#!\/Search$/, eventName: "loadSearch"},
	          {pattern: /^#!\/Rooms\/date_from:([0-9\.\-\/]{8,10})?\/date_to:([0-9\.\-\/]{8,10})?\/adults:(\d+)?\/children:(\d+)?$/, eventName: "loadRooms"},
	          {pattern: /^#!\/Rooms$/, eventName: "loadRooms"},
	          {pattern: /^#!\/Extras$/, eventName: "loadExtras"},
	          {pattern: /^#!\/Checkout$/, eventName: "loadCheckout"},
	          {pattern: /^#!\/Preview$/, eventName: "loadPreview"},
	          {pattern: /^#!\/Booking\/([A-Z]{2}\d{10})$/, eventName: "loadBooking"}
	    ],
	    defaults = {
	    	scrollOffset: 80,
	    	scrollTop: true,
	    	scrollSpeed: 1000,
	    	scrollCounter: 0
	    };
	
	function log() {
		if (window && window.console && window.console.log) {
			window.console.log.apply(window.console, arguments);
		}
	}
	
	function assert() {
		if (window && window.console && window.console.assert) {
			window.console.assert.apply(window.console, arguments);
		}
	}
	
	function hashBang(value) {
		if (value !== undefined && value.match(/^#!\//) !== null) {
			if (window.location.hash == value) {
				return false;
			}
			window.location.hash = value;
			return true;
		}
		
		return false;
	}
	
	function onHashChange() {
		var i, iCnt, m;
		for (i = 0, iCnt = routes.length; i < iCnt; i++) {
			m = window.location.hash.match(routes[i].pattern);
			if (m !== null) {
				pjQ.$(window).trigger(routes[i].eventName, m.slice(1));
				break;
			}
		}
		if (m === null) {
			pjQ.$(window).trigger("loadInit");
		}
	}
	
	pjQ.$(window).on("hashchange", function (e) {
    	onHashChange.call(null);
    });
	
	function HotelBooking(opts) {
		if (!(this instanceof HotelBooking)) {
			return new HotelBooking(opts);
		}
		this.reset.call(this);
		this.init.call(this, opts);
		return this;
	}
	
	HotelBooking.timeToISO = function (time) {
		var dt = new Date(time),
			m = (dt.getMonth() + 1).toString(),
			d = dt.getDate().toString();
		m = m.length === 1 ? "0" + m : m;
		d = d.length === 1 ? "0" + d : d;
		
		return [dt.getFullYear(), m, d].join("-");
	};

	HotelBooking.prototype = {
		reset: function () {
			this.opts = null;
			this.$body = pjQ.$("html, body");
			this.$container = null;
			this.container = null;
			this.uuid = "";
			this.date_from = "";
			this.date_to = "";
			this.adults = 1;
			this.children = 0;
			
			return this;
		},
		init: function (opts) {
			var self = this;
			this.opts = pjQ.$.extend({}, defaults, opts);
			
			this.container = document.getElementById("hbContainer_" + this.opts.cid);
			this.$container = pjQ.$(this.container);
			
			// Event delegation
			this.$container.on("click.hb", ".hbSelectorLocale", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var locale = pjQ.$(this).data("id");
				self.opts.locale = locale;
				pjQ.$(this).addClass("hbLocaleFocus").parent().parent().find("a.hbSelectorLocale").not(this).removeClass("hbLocaleFocus");
				
				self.disableButtons.call(self);
				pjQ.$.get([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionLocale"].join(""), {
					"locale_id": locale
				}).done(function (data) {
					if (data.status === "OK" && data.opts) {
						if (data.opts.day_names) {
							self.opts.day_names = data.opts.day_names;
						}
						if (data.opts.month_names) {
							self.opts.month_names = data.opts.month_names;
						}
					}
					if (!hashBang("#!/Search")) {
						pjQ.$(window).trigger("loadSearch");
					}
				}).fail(function () {
					self.enableButtons.call(self);
				});
				return false;
			}).on("mouseenter.hb", "input.hbButtonOrange", function (e) {
				pjQ.$(this).addClass("hbButtonOrangeHover");
			}).on("mouseleave.hb", "input.hbButtonOrange", function (e) {
				pjQ.$(this).removeClass("hbButtonOrangeHover");
			}).on("mouseenter.hb", "input.hbButtonGray", function (e) {
				pjQ.$(this).addClass("hbButtonGrayHover");
			}).on("mouseleave.hb", "input.hbButtonGray", function (e) {
				pjQ.$(this).removeClass("hbButtonGrayHover");
			}).on("change.hb", ".hbSelectorRoomCnt", function () {
				var $select = pjQ.$(this),
					$item = $select.closest(".hbRoomItem"),
					room_id = $select.data("id"),
					cnt = $select.find("option:selected").val();

				self.disableButtons.call(self);
				pjQ.$.get([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionGetRoom"].join(""), {
					"cid": self.opts.cid,
					"room_id": room_id,
					"cnt": cnt,
					"adults": 1,
					"children": 0
				}).done(function (data) {
					self.enableButtons.call(self);
					$item.html(data);
					if (parseInt(cnt, 10) === 0 && fancybox) {
						$item.find("a.hbSelectorThumb").fancybox();
					}
					self.getAdultsChildren.call(self, function (resp) {
						if (resp.adults > 0 || resp.children > 0) {
							self.$container
								.find(".hbSelectorAccommodate").html(resp.text).show()
								.end()
								.find(".hbSelectorExtras").show();
						} else {
							self.$container
								.find(".hbSelectorAccommodate").hide().html("")
								.end()
								.find(".hbSelectorExtras").hide();
						}
					});
				}).fail(function () {
					self.enableButtons.call(self);
				});
			}).on("click.hb", ".hbSelectorCancelRoom", function () {
				var $this = pjQ.$(this),
					$item = $this.closest(".hbRoomItem"),
					room_id = $this.closest("form").find("input[name='room_id']").val();
				
				self.disableButtons.call(self);
				pjQ.$.get([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionGetRoom"].join(""), {
					"cid": self.opts.cid,
					"room_id": room_id,
					"cnt": 0
				}).done(function (data) {
					self.enableButtons.call(self);
					$item.html(data);
					if (fancybox) {
						$item.find("a.hbSelectorThumb").fancybox();
					}
				}).fail(function () {
					self.enableButtons.call(self);
				});
			}).on("click.hb", ".hbSelectorEditRoom", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				pjQ.$(this).siblings(".hbSelectorRoomCnt").trigger("change");
				return false;
			}).on("change.hb", ".hbSelectorPeople", function () {
				var $this = pjQ.$(this),
					$tr = $this.closest("tr");
				
				self.disableButtons.call(self);
				pjQ.$.get([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionGetPrice"].join(""), {
					"cid": self.opts.cid,
					"adults": $tr.find("select[name='adults[]']").find("option:selected").val(),
					"children": $tr.find("select[name='children[]']").find("option:selected").val(),
					"room_id": $this.closest("form").find("input[name='room_id']").val(),
					"index": $this.data("index")
				}).done(function (data) {
					self.enableButtons.call(self);
					$this.closest("form").find(".hbSelectorTotal").html(data.format_total);
					$tr.find(".hbSelectorPrice").html(data.format_room);
				}).fail(function () {
					self.enableButtons.call(self);
				});
			}).on("click.hb", ".hbSelectorBook", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var $button = pjQ.$(this),
					$item = $button.closest(".hbRoomItem"),
					$form = $button.closest("form");
				
				self.disableButtons.call(self);
				pjQ.$.post([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionSetPrice&cid=", self.opts.cid].join(""), $form.serialize()).done(function (data) {
					if (data.status == "OK") {
						pjQ.$.get([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionGetRoom"].join(""), {
							"cid": self.opts.cid,
							"room_id": $form.find("input[name='room_id']").val(),
							"cnt": 0
						}).done(function (response) {
							self.enableButtons.call(self);
							$item.html(response);
							if (fancybox) {
								$item.find("a.hbSelectorThumb").fancybox();
							}
							
							self.getAdultsChildren.call(self, function (resp) {
								if (resp.adults > 0 || resp.children > 0) {
									self.$container
										.find(".hbSelectorAccommodate").html(resp.text).show()
										.end()
										.find(".hbSelectorExtras").show();
								} else {
									self.$container
										.find(".hbSelectorAccommodate").hide().html("")
										.end()
										.find(".hbSelectorExtras").hide();
								}
							});
						}).fail(function () {
							self.enableButtons.call(self);
						});
					} else {
						self.enableButtons.call(self);
					}
				}).fail(function () {
					self.enableButtons.call(self);
				});
				return false;
			}).on("click.hb", ".hbSelectorThumb", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				var $this = pjQ.$(this),
					path = $this.data("path");
				if (path.length > 0) {
					$this.closest(".hbRoomPics").find(".hbSelectorImg").attr("src", path);
				}
				return false;
			}).on("change.hb", "select[name='payment_method']", function () {
				switch (pjQ.$(this).find("option:selected").val()) {
				case "creditcard":
					self.$container
						.find(".hbSelectorCCard").show()
						.end()
						.find(".hbSelectorBank").hide();
					break;
				case "bank":
					self.$container
						.find(".hbSelectorBank").show()
						.end()
						.find(".hbSelectorCCard").hide();
					break;
				default:
					self.$container.find(".hbSelectorCCard, .hbSelectorBank").hide();
				}
			}).on("click.hb", ".hbSelectorRooms", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.disableButtons.call(self);
				if (!hashBang(["#!/Rooms/date_from:", self.date_from, "/date_to:", self.date_to, "/adults:", self.adults, "/children:", self.children].join(""))) {
					self.enableButtons.call(self);
				}
				return false;
			}).on("click.hb", ".hbSelectorSearch", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.disableButtons.call(self);
				if (!hashBang("#!/Search")) {
					self.enableButtons.call(self);
				}
				return false;
			}).on("click.hb", ".hbSelectorExtras", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.disableButtons.call(self);
				hashBang("#!/Extras");
				return false;
			}).on("click.hb", ".hbSelectorCheckout", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.disableButtons.call(self);
				hashBang("#!/Checkout");
				return false;
			}).on("focusin.hb", ".hbSelectorDatepick", function (e) {
				if (datepicker) {
					var $this = pjQ.$(this),
						dOpts = {
						dateFormat: $this.data("dformat"),
						firstDay: $this.data("fday"),
						monthNamesShort: self.opts.month_names,
						dayNamesMin: self.opts.day_names,
						minDate: 1,
						changeMonth: true
					};
					$this.datepicker(pjQ.$.extend(dOpts, {
						beforeShow: function (input, ui) {
							var dt_from, $chain,
								name = ui.input.attr("name");
							
							if (name == "date_from") {
								ui.input.datepicker("option", "minDate", 1);
							} else if (name == "date_to") {
								$chain = ui.input.closest("form").find("input[name='date_from']");
								dt_from = $chain.datepicker(dOpts).datepicker("getDate");
								if (dt_from != null) {
									ui.input.datepicker("option", "minDate", new Date(dt_from.getTime() + 86400*1000));
								}
							}
							
							ui.dpDiv.addClass('stivaDatepicker');
						},
						onSelect: function (dateText, ui) {
							var dt_from, dt_to, $dt_to;
							
							if (ui.input.attr("name") == "date_from") {
								$dt_to = ui.input.closest("form").find("input[name='date_to']");
								dt_from = ui.input.datepicker(dOpts).datepicker("getDate");
								dt_to = $dt_to.datepicker(dOpts).datepicker("getDate");

								if (dt_from != null && dt_to != null && dt_from.getTime() > dt_to.getTime()) {
									$dt_to.datepicker("option", "minDate", new Date(dt_from.getTime() + 86400*1000));
								}
							}
						}
					}));
				}
			}).on("click.hb", ".calendar-trigger", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
			    var $dp = pjQ.$(this).siblings('.hbSelectorDatepick');
				if ($dp.hasClass("hasDatepicker")) {
					$dp.datepicker("show");
				} else {
					$dp.trigger("focusin").datepicker("show");
				}
				return false;
			}).on("change.hb", ".hbSelectorExtra", function () {
				self.disableButtons.call(self);
				self.handleExtras.call(self, this).done(function (data) {
					if (data.status == 'OK') {
						self.loadExtras.call(self);
					} else {
						self.enableButtons.call(self);
					}
				}).fail(function () {
					self.enableButtons.call(self);
				});
			}).on("click.hb", ".hbSelectorRemoveCode", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				self.disableButtons.call(self);
				pjQ.$.get([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionRemoveCode&cid=", self.opts.cid].join("")).done(function (data) {
					self.loadExtras.call(self);
				}).fail(function () {
					self.enableButtons.call(self);
				});
				return false;
			}).on("click.hb", ".hbSelectorSearchSubmit, .hbSelectorCheckoutSubmit, .hbSelectorPreviewSubmit", function (e) {
				if (e && e.preventDefault) {
					e.preventDefault();
				}
				pjQ.$(this).closest("form").trigger("submit");
				return false;
			});
			//Custom events
			pjQ.$(window).on("loadInit", this.container, function (e) {
				self.loadSearch.call(self);
			}).on("loadSearch", this.container, function (e) {
				self.loadSearch.call(self);
			}).on("loadRooms", this.container, function (e, date_from, date_to, adults, children) {
				self.date_from = date_from;
				self.date_to = date_to;
				self.adults = adults;
				self.children = children;
				self.loadRooms.call(self);
			}).on("loadExtras", this.container, function (e) {
				self.loadExtras.call(self);
			}).on("loadCheckout", this.container, function (e) {
				self.loadCheckout.call(self);
			}).on("loadPreview", this.container, function (e) {
				self.loadPreview.call(self);
			}).on("loadBooking", this.container, function (e, uuid) {
				self.uuid = uuid;
				self.loadBooking.call(self);
			});
			
			if (window.location.hash.length === 0) {
				this.loadSearch.call(this);
			} else {
				onHashChange.call(null);
			}
		},
		disableCheckboxes: function () {
			this.$container.find("input[type='checkbox']").attr("disabled", "disabled");
		},
		enableCheckboxes: function () {
			this.$container.find("input[type='checkbox']").removeAttr("disabled");
		},
		disableButtons: function () {
			var $el;
			this.$container.find(".btn").each(function (i, el) {
				$el = pjQ.$(el).prop("disabled", true);
			});
			this.disableCheckboxes.call(this);
		},
		enableButtons: function () {
			this.$container.find(".btn").prop("disabled", false);
			this.enableCheckboxes.call(this);
		},
		getAdultsChildren: function (callback) {
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionGetAdultsChildren&cid=", this.opts.cid].join("")).done(function (data) {
				if (callback !== undefined && typeof callback === "function") {
					callback.call(self, data);
				}
			});
		},
		handleExtras: function (el) {
			var $el = pjQ.$(el);
			var jqXhr = pjQ.$.post([this.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionHandleExtras&cid=", this.opts.cid].join(""), {
				extra_id: $el.val(),
				checked: $el.is(":checked") ? 1 : 0
			});
			
			return jqXhr;
		},
		loadSearch: function () {
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionSearch"].join(""), {
				"cid": this.opts.cid,
				"locale": this.opts.locale,
				"hide": this.opts.hide,
				"theme": this.opts.theme
			}).done(function (data) {
				self.$container.html(data);
				
				self.scrollTop.call(self);
				
				if (validate) {
					self.$container.find("form").validate({
						rules: {
							adults: {
								required: true,
								digits: true
							},
							date_from: "required",
							date_to: "required"
						},
						submitHandler: function (form) {
							self.disableButtons.call(self);
							var $form = pjQ.$(form);
							hashBang(["#!/Rooms/date_from:", $form.find("input[name='date_from']").val(), "/date_to:", $form.find("input[name='date_to']").val(), "/adults:", $form.find("select[name='adults']").val(), "/children:", $form.find("select[name='children']").val()].join(""));
							return false;
						}
					});
				}
			}).fail(function () {
				self.enableButtons.call(self);
			});
		},
		loadRooms: function () {
			
			if (this.opts.is_expired) {
				hashBang("#!/Search");
				return;
			}
			
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionRooms"].join(""), {
				"cid": this.opts.cid,
				"locale": this.opts.locale,
				"hide": this.opts.hide,
				"theme": this.opts.theme,
				"date_from": this.date_from,
				"date_to": this.date_to,
				"adults": this.adults,
				"children": this.children
			}).done(function (data) {
				self.$container.html(data);
				
				self.scrollTop.call(self);
				
				if (fancybox) {
					self.$container.find("a.hbSelectorThumb").fancybox();
				}
				
				self.getAdultsChildren.call(self, function (resp) {
					if (resp.adults > 0 || resp.children > 0) {
						self.$container
							.find(".hbSelectorAccommodate").html(resp.text).show()
							.end()
							.find(".hbSelectorExtras").show();
					} else {
						self.$container
							.find(".hbSelectorAccommodate").hide().html("")
							.end()
							.find(".hbSelectorExtras").hide();
					}
				});
			}).fail(function () {
				self.enableButtons.call(self);
			});
		},
		scrollTop: function () {
			if (this.opts.scrollTop && this.opts.scrollCounter > 0) {
				this.$body.animate({
					scrollTop: this.$container.offset().top - this.opts.scrollOffset
				}, this.opts.scrollSpeed);
			}
			this.opts.scrollCounter += 1;
		},
		bindValidationVoucher: function (callback) {
			var self = this;
			if (validate) {
				self.$container.find(".hbSelectorVoucherForm").on("keyup.hb", 'input[name="code"]', function (e) {
					if ( pjQ.$(this).val().length === 0 ) {
						pjQ.$(".hbSelectorVoucherError").hide();
					}
				}).validate({
					rules: {
						"code": "required"
					},
					onclick: false,
					onfocusout: false,
					onkeyup: false,
					submitHandler: function (form) {
						self.disableButtons.call(self);
						pjQ.$.post([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionApplyCode&cid=", self.opts.cid].join(""), pjQ.$(form).serialize()).done(function (data) {
							if (typeof callback === "function") {
								callback.call(self, form, data);
							}
						}).fail(function () {
							self.enableButtons.call(self);
						});
						return false;
					}
				});
			}
		},
		loadExtras: function () {
			
			if (this.opts.is_expired) {
				hashBang("#!/Search");
				return;
			}
			
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionExtras"].join(""), {
				"cid": this.opts.cid,
				"locale": this.opts.locale,
				"hide": this.opts.hide,
				"theme": this.opts.theme
			}).done(function (data) {
				self.$container.html(data);
				
				self.scrollTop.call(self);
				
				self.bindValidationVoucher.call(self, function (form, data) {
					if (data.status == "OK") {
						self.loadExtras.call(self);
					} else if (data.status == "ERR") {
						pjQ.$(form).find(".hbSelectorVoucherError").show();
						self.enableButtons.call(self);
					}
				});
			}).fail(function () {
				self.enableButtons.call(self);
			});
		},
		loadCheckout: function () {
			
			if (this.opts.is_expired) {
				hashBang("#!/Search");
				return;
			}
			
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionCheckout"].join(""), {
				"cid": this.opts.cid,
				"locale": this.opts.locale,
				"hide": this.opts.hide,
				"theme": this.opts.theme
			}).done(function (data) {
				self.$container.html(data);
				
				self.scrollTop.call(self);
				
				self.$container.find('input[name="c_arrival"]').timepicker();
				
				if (validate) {
					self.$container.find("form.hbSelectorFormCheckout").validate({
						rules: {
							cc_num: {
								creditcard: true
							},
							captcha: {
								required: true,
								minlength: 6,
								maxlength: 6,
								remote: self.opts.folder + "bookAdmin.php?controller=pjFront&action=pjActionCheckCaptcha"
							}
						},
						onkeyup: false,
						submitHandler: function (form) {
							self.disableButtons.call(self);
							pjQ.$.post([self.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionCheckout&cid=", self.opts.cid,
										"&locale=", self.opts.locale,
										"&hide=", self.opts.hide,
										"&theme=", self.opts.theme,
										].join(""), pjQ.$(form).serialize()).done(function (data) {
								hashBang("#!/Preview");
							}).fail(function () {
								self.enableButtons.call(self);
							});
							return false;
						}
					});
				}
			}).fail(function () {
				self.enableButtons.call(self);
			});
		},
		loadPreview: function () {
			
			if (this.opts.is_expired) {
				hashBang("#!/Search");
				return;
			}
			
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionPreview"].join(""), {
				"cid": this.opts.cid,
				"locale": this.opts.locale,
				"hide": this.opts.hide,
				"theme": this.opts.theme
			}).done(function (data) {
				self.$container.html(data);
				
				self.scrollTop.call(self);
				
				if (validate) {
					self.$container.find("form").validate({
						submitHandler: function (form) {
							self.disableButtons.call(self);
							pjQ.$.post([self.opts.folder, "bookAdmin.php?controller=pjFront&action=pjActionProcessOrder&cid=", self.opts.cid].join(""), pjQ.$(form).serialize()).done(function (data) {
								if (data.status == "OK") {
									hashBang(["#!/Booking/", data.invoice_uuid].join(""));
								} else if (data.status == "ERR") {
									self.$container.find(".hbSelectorError").html(data.text).show();
									self.enableButtons.call(self);
								}
							}).fail(function () {
								self.enableButtons.call(self);
							});
							return false;
						}
					});
				}
			}).fail(function () {
				self.enableButtons.call(self);
			});
		},
		loadBooking: function () {
			
			if (this.opts.is_expired) {
				hashBang("#!/Search");
				return;
			}
			
			var self = this;
			pjQ.$.get([this.opts.folder, "bookAdmin.php?controller=pjFrontPublic&action=pjActionBooking"].join(""), {
				"cid": this.opts.cid,
				"locale": this.opts.locale,
				"hide": this.opts.hide,
				"theme": this.opts.theme,
				"uuid": this.uuid
			}).done(function (data) {
				self.$container.html(data);
				
				self.scrollTop.call(self);
				
				var $paypal = self.$container.find("form[name='hbPaypal']"),
					$autorize = self.$container.find("form[name='hbAuthorize']");
				if ($paypal.length) {
					$paypal.trigger('submit');
				} else if ($autorize.length) {
					$autorize.trigger('submit');
				}
				
			}).fail(function () {
				self.enableButtons.call(self);
			});
		}
	};
	
	// expose
	window.HotelBooking = HotelBooking;
})(window);