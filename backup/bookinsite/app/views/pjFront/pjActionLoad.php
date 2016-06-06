<div id="hbContainer_<?php echo $_GET['cid']; ?>" class="hbContainer container stivaContainer"></div>
<div style="display: none" title="<?php echo pjSanitize::html(__('front_terms', true)); ?>" id="hbTerms_<?php echo $_GET['cid']; ?>"></div>
<script type="text/javascript">
var pjQ = pjQ || {},
	HotelBooking_<?php echo $_GET['cid']; ?>;
(function () {
	"use strict";
	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor),

	isMSIE = function() {
		var ua = window.navigator.userAgent,
        	msie = ua.indexOf("MSIE ");

        if (msie !== -1) {
            return true;
        }

		return false;
	},
	
	loadCssHack = function(url, callback){
		var link = document.createElement('link');
		link.type = 'text/css';
		link.rel = 'stylesheet';
		link.href = url;

		document.getElementsByTagName('head')[0].appendChild(link);

		var img = document.createElement('img');
		img.onerror = function(){
			if (callback && typeof callback === "function") {
				callback();
			}
		};
		img.src = url;
	},
	loadRemote = function(url, type, callback) {
		if (type === "css" && isSafari) {
			loadCssHack(url, callback);
			return;
		}
		var _element, _type, _attr, scr, s, element;
		
		switch (type) {
		case 'css':
			_element = "link";
			_type = "text/css";
			_attr = "href";
			break;
		case 'js':
			_element = "script";
			_type = "text/javascript";
			_attr = "src";
			break;
		}
		
		scr = document.getElementsByTagName(_element);
		s = scr[scr.length - 1];
		element = document.createElement(_element);
		element.type = _type;
		if (type == "css") {
			element.rel = "stylesheet";
		}
		if (element.readyState) {
			element.onreadystatechange = function () {
				if (element.readyState == "loaded" || element.readyState == "complete") {
					element.onreadystatechange = null;
					if (callback && typeof callback === "function") {
						callback();
					}
				}
			};
		} else {
			element.onload = function () {
				if (callback && typeof callback === "function") {
					callback();
				}
			};
		}
		element[_attr] = url;
		s.parentNode.insertBefore(element, s.nextSibling);
	},
	loadScript = function (url, callback) {
		loadRemote(url, "js", callback);
	},
	loadCss = function (url, callback) {
		loadRemote(url, "css", callback);
	},
	options = {
		server: "<?php echo PJ_INSTALL_URL; ?>",
		folder: "<?php echo PJ_INSTALL_URL; ?>",
		cid: <?php echo $_GET['cid']; ?>,
		locale: <?php echo isset($_GET['locale']) && (int) $_GET['locale'] > 0 ? (int) $_GET['locale'] : $controller->getLocaleId(); ?>,
		theme: <?php echo isset($_GET['theme']) && strlen($_GET['theme']) > 0 ? (int) $_GET['theme'] : (int) $tpl['option_arr']['o_theme']; ?>,
		hide: <?php echo isset($_GET['hide']) && (int) $_GET['hide'] === 1 ? 1 : 0; ?>,
		price_based_on: "<?php echo $tpl['option_arr']['o_price_based_on']; ?>",
		accept_bookings: <?php echo (int) $tpl['option_arr']['o_accept_bookings']; ?>,
		week_start: <?php echo (int) $tpl['option_arr']['o_week_start']; ?>,
		date_format: "<?php echo $tpl['option_arr']['o_date_format']; ?>",
		thankyou_page: "<?php echo $tpl['option_arr']['o_thankyou_page']; ?>",
		day_names: <?php $day_names = __('day_names', true); ksort($day_names, SORT_NUMERIC); echo pjAppController::jsonEncode(array_values($day_names)); ?>,
		month_names: <?php $months = __('short_months', true); ksort($months, SORT_NUMERIC); echo pjAppController::jsonEncode(array_values($months)); ?>,
		error_msg: <?php echo pjAppController::jsonEncode(__('front_err', true)); ?>,
		is_expired: <?php echo (int) @$tpl['isTrialExpired']; ?>
	};
	loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/pjQuery.min.js", function () {
		window.pjQ.$.browser = {
			msie: isMSIE()
		};
		loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/pjQuery.validate.min.js", function () {
			loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/bootstrap/js/timepicker.js", function () {
				loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/bootstrap/js/bootstrap.min.js", function () {
					loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/pjQuery-ui.min.js", function () {
						loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/fancybox/pjQuery.fancybox-1.3.4.min.js", function () {
							loadScript("<?php echo PJ_INSTALL_URL . PJ_LIBS_PATH; ?>pjQ/pjQuery.ba-hashchange.min.js", function () {
								loadScript("<?php echo PJ_INSTALL_URL . PJ_JS_PATH; ?>pjHotelBooking.js", function () {
									HotelBooking_<?php echo $_GET['cid']; ?> = new HotelBooking(options);
								});
							});
						});
					});
				});
			});
		});
	});
})();
</script>