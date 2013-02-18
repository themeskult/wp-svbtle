</section><!-- #main -->

<?php $options = get_option ( 'svbtle_options' ); ?>
<script data-cfasync="false" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript" charset="utf-8">
	function getKudos() {
	    var e = new Array;
	    return $("aside.kudo").each(function(t) {
	        article = $(this).closest("article").attr("id"),
	        e.push(article)
	    }),
	    $.post("<?php echo site_url(); ?>/wp-admin/admin-ajax.php", {
	        kudosList: e,
					action:'my_special_action'
	    },
	    function(e) {
	        $.each(e,
	        function(e, t) {
	            var n = $("#" + t.external_id).find("span.num"),
	            r = n.text().replace(/,/g, ""),
	            i = t.kudos;
	            isNaN(r) && (r = 0),
	            isNaN(i) && (i = 9e6),
	            i - r >= 0 && (i = i.toString(), i = i.replace(/\B(?=(\d{3})+(?!\d))/g, ","), n.html(i))
	        })
	    }),
	    !0
	}
	function setViewport() {
	    $(window).width() < 900 && $("html,body").animate({
	        scrollLeft: 180
	    },
	    800)
	}
	function startCode() {
	    $("code").addClass("prettyprint"),
	    $.getScript("<?php echo get_bloginfo('stylesheet_directory'); ?>/js/prettify.js").done(function(e, t) {
	        var n = "<?php echo get_bloginfo('stylesheet_directory'); ?>/css/prettify.css";
	        $.get(n,
	        function(e) {
	            $('<style type="text/css"></style>').html(e).appendTo("head")
	        }),
	        prettyPrint();
	    })
	} (function(e, t) {
	    var n;
	    e.rails = n = {
	        linkClickSelector: "a[data-confirm], a[data-method], a[data-remote], a[data-disable-with]",
	        inputChangeSelector: "select[data-remote], input[data-remote], textarea[data-remote]",
	        formSubmitSelector: "form",
	        formInputClickSelector: "form input[type=submit], form input[type=image], form button[type=submit], form button:not(button[type])",
	        disableSelector: "input[data-disable-with], button[data-disable-with], textarea[data-disable-with]",
	        enableSelector: "input[data-disable-with]:disabled, button[data-disable-with]:disabled, textarea[data-disable-with]:disabled",
	        requiredInputSelector: "input[name][required]:not([disabled]),textarea[name][required]:not([disabled])",
	        fileInputSelector: "input:file",
	        linkDisableSelector: "a[data-disable-with]",
	        CSRFProtection: function(t) {
	            var n = e('meta[name="csrf-token"]').attr("content");
	            n && t.setRequestHeader("X-CSRF-Token", n)
	        },
	        fire: function(t, n, r) {
	            var i = e.Event(n);
	            return t.trigger(i, r),
	            i.result !== !1
	        },
	        confirm: function(e) {
	            return confirm(e)
	        },
	        ajax: function(t) {
	            return e.ajax(t)
	        },
	        href: function(e) {
	            return e.attr("href")
	        },
	        handleRemote: function(r) {
	            var i,
	            s,
	            o,
	            u,
	            a,
	            f;
	            if (n.fire(r, "ajax:before")) {
	                u = r.data("cross-domain") || null,
	                a = r.data("type") || e.ajaxSettings && e.ajaxSettings.dataType;
	                if (r.is("form")) {
	                    i = r.attr("method"),
	                    s = r.attr("action"),
	                    o = r.serializeArray();
	                    var l = r.data("ujs:submit-button");
	                    l && (o.push(l), r.data("ujs:submit-button", null))
	                } else r.is(n.inputChangeSelector) ? (i = r.data("method"), s = r.data("url"), o = r.serialize(), r.data("params") && (o = o + "&" + r.data("params"))) : (i = r.data("method"), s = n.href(r), o = r.data("params") || null);
	                return f = {
	                    type: i || "GET",
	                    data: o,
	                    dataType: a,
	                    crossDomain: u,
	                    beforeSend: function(e, i) {
	                        return i.dataType === t && e.setRequestHeader("accept", "*/*;q=0.5, " + i.accepts.script),
	                        n.fire(r, "ajax:beforeSend", [e, i])
	                    },
	                    success: function(e, t, n) {
	                        r.trigger("ajax:success", [e, t, n])
	                    },
	                    complete: function(e, t) {
	                        r.trigger("ajax:complete", [e, t])
	                    },
	                    error: function(e, t, n) {
	                        r.trigger("ajax:error", [e, t, n])
	                    }
	                },
	                s && (f.url = s),
	                n.ajax(f)
	            }
	            return ! 1
	        },
	        handleMethod: function(r) {
	            var i = n.href(r),
	            s = r.data("method"),
	            o = r.attr("target"),
	            u = e("meta[name=csrf-token]").attr("content"),
	            a = e("meta[name=csrf-param]").attr("content"),
	            f = e('<form method="post" action="' + i + '"></form>'),
	            l = '<input name="_method" value="' + s + '" type="hidden" />';
	            a !== t && u !== t && (l += '<input name="' + a + '" value="' + u + '" type="hidden" />'),
	            o && f.attr("target", o),
	            f.hide().append(l).appendTo("body"),
	            f.submit()
	        },
	        disableFormElements: function(t) {
	            t.find(n.disableSelector).each(function() {
	                var t = e(this),
	                n = t.is("button") ? "html": "val";
	                t.data("ujs:enable-with", t[n]()),
	                t[n](t.data("disable-with")),
	                t.prop("disabled", !0)
	            })
	        },
	        enableFormElements: function(t) {
	            t.find(n.enableSelector).each(function() {
	                var t = e(this),
	                n = t.is("button") ? "html": "val";
	                t.data("ujs:enable-with") && t[n](t.data("ujs:enable-with")),
	                t.prop("disabled", !1)
	            })
	        },
	        allowAction: function(e) {
	            var t = e.data("confirm"),
	            r = !1,
	            i;
	            return t ? (n.fire(e, "confirm") && (r = n.confirm(t), i = n.fire(e, "confirm:complete", [r])), r && i) : !0
	        },
	        blankInputs: function(t, n, r) {
	            var i = e(),
	            s,
	            o = n || "input,textarea";
	            return t.find(o).each(function() {
	                s = e(this);
	                if (r ? s.val() : !s.val()) i = i.add(s)
	            }),
	            i.length ? i: !1
	        },
	        nonBlankInputs: function(e, t) {
	            return n.blankInputs(e, t, !0)
	        },
	        stopEverything: function(t) {
	            return e(t.target).trigger("ujs:everythingStopped"),
	            t.stopImmediatePropagation(),
	            !1
	        },
	        callFormSubmitBindings: function(n, r) {
	            var i = n.data("events"),
	            s = !0;
	            return i !== t && i.submit !== t && e.each(i.submit,
	            function(e, t) {
	                if (typeof t.handler == "function") return s = t.handler(r)
	            }),
	            s
	        },
	        disableElement: function(e) {
	            e.data("ujs:enable-with", e.html()),
	            e.html(e.data("disable-with")),
	            e.bind("click.railsDisable",
	            function(e) {
	                return n.stopEverything(e)
	            })
	        },
	        enableElement: function(e) {
	            e.data("ujs:enable-with") !== t && (e.html(e.data("ujs:enable-with")), e.data("ujs:enable-with", !1)),
	            e.unbind("click.railsDisable")
	        }
	    },
	    e.ajaxPrefilter(function(e, t, r) {
	        e.crossDomain //|| n.CSRFProtection(r)
	    }),
	    e(document).delegate(n.linkDisableSelector, "ajax:complete",
	    function() {
	        n.enableElement(e(this))
	    }),
	    e(document).delegate(n.linkClickSelector, "click.rails",
	    function(r) {
	        var i = e(this),
	        s = i.data("method"),
	        o = i.data("params");
	        if (!n.allowAction(i)) return n.stopEverything(r);
	        i.is(n.linkDisableSelector) && n.disableElement(i);
	        if (i.data("remote") !== t) return (r.metaKey || r.ctrlKey) && (!s || s === "GET") && !o ? !0: (n.handleRemote(i) === !1 && n.enableElement(i), !1);
	        if (i.data("method")) return n.handleMethod(i),
	        !1
	    }),
	    e(document).delegate(n.inputChangeSelector, "change.rails",
	    function(t) {
	        var r = e(this);
	        return n.allowAction(r) ? (n.handleRemote(r), !1) : n.stopEverything(t)
	    }),
	    e(document).delegate(n.formSubmitSelector, "submit.rails",
	    function(r) {
	        var i = e(this),
	        s = i.data("remote") !== t,
	        o = n.blankInputs(i, n.requiredInputSelector),
	        u = n.nonBlankInputs(i, n.fileInputSelector);
	        if (!n.allowAction(i)) return n.stopEverything(r);
	        if (o && i.attr("novalidate") == t && n.fire(i, "ajax:aborted:required", [o])) return n.stopEverything(r);
	        if (s) return u ? n.fire(i, "ajax:aborted:file", [u]) : !e.support.submitBubbles && e().jquery < "1.7" && n.callFormSubmitBindings(i, r) === !1 ? n.stopEverything(r) : (n.handleRemote(i), !1);
	        setTimeout(function() {
	            n.disableFormElements(i)
	        },
	        13)
	    }),
	    e(document).delegate(n.formInputClickSelector, "click.rails",
	    function(t) {
	        var r = e(this);
	        if (!n.allowAction(r)) return n.stopEverything(t);
	        var i = r.attr("name"),
	        s = i ? {
	            name: i,
	            value: r.val()
	        }: null;
	        r.closest("form").data("ujs:submit-button", s)
	    }),
	    e(document).delegate(n.formSubmitSelector, "ajax:beforeSend.rails",
	    function(t) {
	        this == t.target && n.disableFormElements(e(this))
	    }),
	    e(document).delegate(n.formSubmitSelector, "ajax:complete.rails",
	    function(t) {
	        this == t.target && n.enableFormElements(e(this))
	    })
	})(jQuery),	
	function(e) {
	    function t() {
	        if (o.jStorage) try {
	            s = l("" + o.jStorage)
	        } catch(e) {
	            o.jStorage = "{}"
	        } else o.jStorage = "{}";
	        a = o.jStorage ? ("" + o.jStorage).length: 0
	    }
	    function n() {
	        try {
	            o.jStorage = f(s),
	            u && (u.setAttribute("jStorage", o.jStorage), u.save("jStorage")),
	            a = o.jStorage ? ("" + o.jStorage).length: 0
	        } catch(e) {}
	    }
	    function r(e) {
	        if (!e || "string" != typeof e && "number" != typeof e) throw new TypeError("Key name must be string or numeric");
	        if ("__jstorage_meta" == e) throw new TypeError("Reserved key name");
	        return ! 0
	    }
	    function i() {
	        var e,
	        t,
	        r,
	        o = Infinity,
	        u = !1;
	        clearTimeout(h);
	        if (s.__jstorage_meta && "object" == typeof s.__jstorage_meta.TTL) {
	            e = +(new Date),
	            r = s.__jstorage_meta.TTL;
	            for (t in r) r.hasOwnProperty(t) && (r[t] <= e ? (delete r[t], delete s[t], u = !0) : r[t] < o && (o = r[t]));
	            Infinity != o && (h = setTimeout(i, o - e)),
	            u && n()
	        }
	    }
	    if (!e || !e.toJSON && !Object.toJSON && !window.JSON) throw Error("jQuery, MooTools or Prototype needs to be loaded before jStorage!");
	    var s = {},
	    o = {
	        jStorage: "{}"
	    },
	    u = null,
	    a = 0,
	    f = e.toJSON || Object.toJSON || window.JSON && (JSON.encode || JSON.stringify),
	    l = e.evalJSON || window.JSON && (JSON.decode || JSON.parse) ||
	    function(e) {
	        return ("" + e).evalJSON()
	    },
	    c = !1,
	    h,
	    p = {
	        isXML: function(e) {
	            return (e = (e ? e.ownerDocument || e: 0).documentElement) ? "HTML" !== e.nodeName: !1
	        },
	        encode: function(e) {
	            if (!this.isXML(e)) return ! 1;
	            try {
	                return (new XMLSerializer).serializeToString(e)
	            } catch(t) {
	                try {
	                    return e.xml
	                } catch(n) {}
	            }
	            return ! 1
	        },
	        decode: function(e) {
	            var t = "DOMParser" in window && (new DOMParser).parseFromString || window.ActiveXObject &&
	            function(e) {
	                var t = new ActiveXObject("Microsoft.XMLDOM");
	                return t.async = "false",
	                t.loadXML(e),
	                t
	            };
	            return t ? (e = t.call("DOMParser" in window && new DOMParser || window, e, "text/xml"), this.isXML(e) ? e: !1) : !1
	        }
	    };
	    e.jStorage = {
	        version: "0.1.7.0",
	        set: function(e, t, i) {
	            return r(e),
	            i = i || {},
	            p.isXML(t) ? t = {
	                _is_xml: !0,
	                xml: p.encode(t)
	            }: "function" == typeof t ? t = null: t && "object" == typeof t && (t = l(f(t))),
	            s[e] = t,
	            isNaN(i.TTL) ? n() : this.setTTL(e, i.TTL),
	            t
	        },
	        get: function(e, t) {
	            return r(e),
	            e in s ? s[e] && "object" == typeof s[e] && s[e]._is_xml && s[e]._is_xml ? p.decode(s[e].xml) : s[e] : "undefined" == typeof t ? null: t
	        },
	        deleteKey: function(e) {
	            return r(e),
	            e in s ? (delete s[e], s.__jstorage_meta && "object" == typeof s.__jstorage_meta.TTL && e in s.__jstorage_meta.TTL && delete s.__jstorage_meta.TTL[e], n(), !0) : !1
	        },
	        setTTL: function(e, t) {
	            var o = +(new Date);
	            return r(e),
	            t = Number(t) || 0,
	            e in s ? (s.__jstorage_meta || (s.__jstorage_meta = {}), s.__jstorage_meta.TTL || (s.__jstorage_meta.TTL = {}), 0 < t ? s.__jstorage_meta.TTL[e] = o + t: delete s.__jstorage_meta.TTL[e], n(), i(), !0) : !1
	        },
	        flush: function() {
	            return s = {},
	            n(),
	            !0
	        },
	        storageObj: function() {
	            function e() {}
	            return e.prototype = s,
	            new e
	        },
	        index: function() {
	            var e = [],
	            t;
	            for (t in s) s.hasOwnProperty(t) && "__jstorage_meta" != t && e.push(t);
	            return e
	        },
	        storageSize: function() {
	            return a
	        },
	        currentBackend: function() {
	            return c
	        },
	        storageAvailable: function() {
	            return !! c
	        },
	        reInit: function() {
	            var e;
	            if (u && u.addBehavior) {
	                e = document.createElement("link"),
	                u.parentNode.replaceChild(e, u),
	                u = e,
	                u.style.behavior = "url(#default#userData)",
	                document.getElementsByTagName("head")[0].appendChild(u),
	                u.load("jStorage"),
	                e = "{}";
	                try {
	                    e = u.getAttribute("jStorage")
	                } catch(n) {}
	                o.jStorage = e,
	                c = "userDataBehavior"
	            }
	            t()
	        }
	    },
	    function() {
	        var e = !1;
	        if ("localStorage" in window) try {
	            window.localStorage.setItem("_tmptest", "tmpval"),
	            e = !0,
	            window.localStorage.removeItem("_tmptest")
	        } catch(n) {}
	        if (e) try {
	            window.localStorage && (o = window.localStorage, c = "localStorage")
	        } catch(r) {} else if ("globalStorage" in window) try {
	            window.globalStorage && (o = window.globalStorage[window.location.hostname], c = "globalStorage")
	        } catch(s) {} else {
	            if (u = document.createElement("link"), !u.addBehavior) {
	                u = null;
	                return
	            }
	            u.style.behavior = "url(#default#userData)",
	            document.getElementsByTagName("head")[0].appendChild(u),
	            u.load("jStorage"),
	            e = "{}";
	            try {
	                e = u.getAttribute("jStorage")
	            } catch(a) {}
	            o.jStorage = e,
	            c = "userDataBehavior"
	        }
	        t(),
	        i()
	    } ()
	} (window.$ || window.jQuery),
	$(function() {
	    function n(t) {
	        t.addClass("active"),
	        t.children(".counter").children("span.txt").html("Don&rsquo;t move"),
	        t.children(".counter").children("span.num").hide(),
	        e = setTimeout(function() {
	            clearTimeout(e),
	            s(t)
	        },
	        1e3)
	    }
	    function r(t) {
	        clearTimeout(e),
	        t.children(".counter").children("span.txt").html("Kudos"),
	        t.children(".counter").children("span.num").show(),
	        t.removeClass("active")
	    }
	    function i(e) {
	        var t = e.closest("article").attr("id");
					$.post("<?php echo site_url(); ?>/wp-admin/admin-ajax.php", {
	            article: t, action:'remove_kudos'
	        },
	        function() {
	            $.jStorage.set(t, !1)
	        });
	        var n = parseInt(e.find("span.num").text().replace(/,/g, "")) - 1;
	        e.find("span.num").text(n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")),
	        e.children(".counter").children("span.txt").html("Kudos"),
	        e.children(".counter").children("span.num").show(),
	        e.removeClass("complete deletable"),
	        e.addClass("kudoable")
	    }
	    function s(e) {
	        var t = e.closest("article").attr("id");
	        $.post("<?php echo site_url(); ?>/wp-admin/admin-ajax.php", {
	            article: t,
							action:'my_special_action',
	        },
	        function() {
	            $.jStorage.set(t, !0)
	        });
	        var n = parseInt(e.find("span.num").text().replace(/,/g, "")) + 1;
	        e.find("span.num").text(n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")),
	        e.children(".counter").children("span.txt").html("Kudos"),
	        e.children(".counter").children("span.num").show(),
	        e.addClass("complete"),
	        e.removeClass("kudoable active")
	    }
	    var e,
	    t;
	    getKudos(),
	    setViewport(),
	    $("code, pre").length > 0 && startCode(),
	    $("a.kudobject").live({
	        click: function(e) {
	            return e.preventDefault(),
	            !1
	        },
	        mouseenter: function() {
	            kudo = $(this).parent(),
	            kudo.is(".kudoable") && n(kudo)
	        },
	        mouseleave: function() {
	            clearTimeout(e),
	            kudo = $(this).parent(),
	            r(kudo),
	            kudo.is(".complete") && kudo.addClass("deletable")
	        }
	    }),
	    $("a.kudobject").live("touchstart",
	    function(e) {
	        kudo = $(this).parent(),
	        kudo.is(".kudoable") && n(kudo),
	        e.preventDefault()
	    }),
	    $("a.kudobject").live("touchend",
	    function(t) {
	        clearTimeout(e),
	        kudo = $(this).parent(),
	        r(kudo),
	        kudo.is(".complete") && kudo.addClass("deletable"),
	        t.preventDefault()
	    }),
	    $("aside.deletable a.kudobject").live("click",
	    function(e) {
	        return kudo = $(this).parent(),
	        i(kudo),
	        e.preventDefault(),
	        !1
	    }),
	    $("aside.deletable a.kudobject").live("touchend",
	    function(e) {
	        return kudo = $(this).parent(),
	        i(kudo),
	        e.preventDefault(),
	        !1
	    }),
	    $("aside.kudo").each(function(e) {
	        var t = $(this).closest("article").attr("id"),
	        n = $.jStorage.get(t);
	        n && $(this).removeClass("kudoable").addClass("complete deletable")
	    }),
	    $("#svbtle_dropdown").mouseenter(function() {
	        clearTimeout(t),
	        $("#dropdown").show()
	    }).mouseleave(function() {
	        t = setTimeout("$('#dropdown').hide();", 800)
	    }),
	    $("#svbtle_dropdown").mouseenter(function() {
	        clearTimeout(t),
	        $("#dropdown").show()
	    }).mouseleave(function() {
	        t = setTimeout("$('#dropdown').hide();", 800)
	    })
	}),	$("input.pane_input, textarea.pane_input").bind("focus", function() {
			    $("li.text_field").removeClass("active"), $(this).parent("li.text_field").addClass("active")
			}), $("input.pane_input, textarea.pane_input").bind("blur", function() {
			    $("li.text_field").removeClass("active"), $("li.text_field").first().addClass("active")
			});
</script>
		
		<?php wp_footer(); ?>
	</body>
</html>