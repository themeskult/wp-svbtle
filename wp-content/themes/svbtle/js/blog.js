(function(a, b) {
    var c;
    a.rails = c = {linkClickSelector: "a[data-confirm], a[data-method], a[data-remote], a[data-disable-with]",inputChangeSelector: "select[data-remote], input[data-remote], textarea[data-remote]",formSubmitSelector: "form",formInputClickSelector: "form input[type=submit], form input[type=image], form button[type=submit], form button:not(button[type])",disableSelector: "input[data-disable-with], button[data-disable-with], textarea[data-disable-with]",enableSelector: "input[data-disable-with]:disabled, button[data-disable-with]:disabled, textarea[data-disable-with]:disabled",requiredInputSelector: "input[name][required]:not([disabled]),textarea[name][required]:not([disabled])",fileInputSelector: "input:file",linkDisableSelector: "a[data-disable-with]"/*,CSRFProtection: function(b) {
            var c = a('meta[name="csrf-token"]').attr("content");
            c && b.setRequestHeader("X-CSRF-Token", c)
        }*/,fire: function(b, c, d) {
            var e = a.Event(c);
            return b.trigger(e, d), e.result !== !1
        },confirm: function(a) {
            return confirm(a)
        },ajax: function(b) {
            return a.ajax(b)
        },href: function(a) {
            return a.attr("href")
        },handleRemote: function(d) {
            var e, f, g, h, i, j;
            if (c.fire(d, "ajax:before")) {
                h = d.data("cross-domain") || null, i = d.data("type") || a.ajaxSettings && a.ajaxSettings.dataType;
                if (d.is("form")) {
                    e = d.attr("method"), f = d.attr("action"), g = d.serializeArray();
                    var k = d.data("ujs:submit-button");
                    k && (g.push(k), d.data("ujs:submit-button", null))
                } else
                    d.is(c.inputChangeSelector) ? (e = d.data("method"), f = d.data("url"), g = d.serialize(), d.data("params") && (g = g + "&" + d.data("params"))) : (e = d.data("method"), f = c.href(d), g = d.data("params") || null);
                return j = {type: e || "GET",data: g,dataType: i,crossDomain: h,beforeSend: function(a, e) {
                        return e.dataType === b && a.setRequestHeader("accept", "*/*;q=0.5, " + e.accepts.script), c.fire(d, "ajax:beforeSend", [a, e])
                    },success: function(a, b, c) {
                        d.trigger("ajax:success", [a, b, c])
                    },complete: function(a, b) {
                        d.trigger("ajax:complete", [a, b])
                    },error: function(a, b, c) {
                        d.trigger("ajax:error", [a, b, c])
                    }}, f && (j.url = f), c.ajax(j)
            }
            return !1
        },handleMethod: function(d) {
            var e = c.href(d), f = d.data("method"), g = d.attr("target"), h = a("meta[name=csrf-token]").attr("content"), i = a("meta[name=csrf-param]").attr("content"), j = a('<form method="post" action="' + e + '"></form>'), k = '<input name="_method" value="' + f + '" type="hidden" />';
            i !== b && h !== b && (k += '<input name="' + i + '" value="' + h + '" type="hidden" />'), g && j.attr("target", g), j.hide().append(k).appendTo("body"), j.submit()
        },disableFormElements: function(b) {
            b.find(c.disableSelector).each(function() {
                var b = a(this), c = b.is("button") ? "html" : "val";
                b.data("ujs:enable-with", b[c]()), b[c](b.data("disable-with")), b.prop("disabled", !0)
            })
        },enableFormElements: function(b) {
            b.find(c.enableSelector).each(function() {
                var b = a(this), c = b.is("button") ? "html" : "val";
                b.data("ujs:enable-with") && b[c](b.data("ujs:enable-with")), b.prop("disabled", !1)
            })
        },allowAction: function(a) {
            var b = a.data("confirm"), d = !1, e;
            return b ? (c.fire(a, "confirm") && (d = c.confirm(b), e = c.fire(a, "confirm:complete", [d])), d && e) : !0
        },blankInputs: function(b, c, d) {
            var e = a(), f, g = c || "input,textarea";
            return b.find(g).each(function() {
                f = a(this);
                if (d ? f.val() : !f.val())
                    e = e.add(f)
            }), e.length ? e : !1
        },nonBlankInputs: function(a, b) {
            return c.blankInputs(a, b, !0)
        },stopEverything: function(b) {
            return a(b.target).trigger("ujs:everythingStopped"), b.stopImmediatePropagation(), !1
        },callFormSubmitBindings: function(c, d) {
            var e = c.data("events"), f = !0;
            return e !== b && e.submit !== b && a.each(e.submit, function(a, b) {
                if (typeof b.handler == "function")
                    return f = b.handler(d)
            }), f
        },disableElement: function(a) {
            a.data("ujs:enable-with", a.html()), a.html(a.data("disable-with")), a.bind("click.railsDisable", function(a) {
                return c.stopEverything(a)
            })
        },enableElement: function(a) {
            a.data("ujs:enable-with") !== b && (a.html(a.data("ujs:enable-with")), a.data("ujs:enable-with", !1)), a.unbind("click.railsDisable")
        }}, a.ajaxPrefilter(function(a, b, d) {
        a.crossDomain //|| c.CSRFProtection(d)
    }), a(document).delegate(c.linkDisableSelector, "ajax:complete", function() {
        c.enableElement(a(this))
    }), a(document).delegate(c.linkClickSelector, "click.rails", function(d) {
        var e = a(this), f = e.data("method"), g = e.data("params");
        if (!c.allowAction(e))
            return c.stopEverything(d);
        e.is(c.linkDisableSelector) && c.disableElement(e);
        if (e.data("remote") !== b)
            return (d.metaKey || d.ctrlKey) && (!f || f === "GET") && !g ? !0 : (c.handleRemote(e) === !1 && c.enableElement(e), !1);
        if (e.data("method"))
            return c.handleMethod(e), !1
    }), a(document).delegate(c.inputChangeSelector, "change.rails", function(b) {
        var d = a(this);
        return c.allowAction(d) ? (c.handleRemote(d), !1) : c.stopEverything(b)
    }), a(document).delegate(c.formSubmitSelector, "submit.rails", function(d) {
        var e = a(this), f = e.data("remote") !== b, g = c.blankInputs(e, c.requiredInputSelector), h = c.nonBlankInputs(e, c.fileInputSelector);
        if (!c.allowAction(e))
            return c.stopEverything(d);
        if (g && e.attr("novalidate") == b && c.fire(e, "ajax:aborted:required", [g]))
            return c.stopEverything(d);
        if (f)
            return h ? c.fire(e, "ajax:aborted:file", [h]) : !a.support.submitBubbles && a().jquery < "1.7" && c.callFormSubmitBindings(e, d) === !1 ? c.stopEverything(d) : (c.handleRemote(e), !1);
        setTimeout(function() {
            c.disableFormElements(e)
        }, 13)
    }), a(document).delegate(c.formInputClickSelector, "click.rails", function(b) {
        var d = a(this);
        if (!c.allowAction(d))
            return c.stopEverything(b);
        var e = d.attr("name"), f = e ? {name: e,value: d.val()} : null;
        d.closest("form").data("ujs:submit-button", f)
    }), a(document).delegate(c.formSubmitSelector, "ajax:beforeSend.rails", function(b) {
        this == b.target && c.disableFormElements(a(this))
    }), a(document).delegate(c.formSubmitSelector, "ajax:complete.rails", function(b) {
        this == b.target && c.enableFormElements(a(this))
    })
})(jQuery), function(a) {
    a.cookie = function(b, c, d) {
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(c)) || c === null || c === undefined)) {
            d = a.extend({}, d);
            if (c === null || c === undefined)
                d.expires = -1;
            if (typeof d.expires == "number") {
                var e = d.expires, f = d.expires = new Date;
                f.setDate(f.getDate() + e)
            }
            return c = String(c), document.cookie = [encodeURIComponent(b), "=", d.raw ? c : encodeURIComponent(c), d.expires ? "; expires=" + d.expires.toUTCString() : "", d.path ? "; path=" + d.path : "", d.domain ? "; domain=" + d.domain : "", d.secure ? "; secure" : ""].join("")
        }
        d = c || {};
        var g = d.raw ? function(a) {
            return a
        } : decodeURIComponent, h = document.cookie.split("; ");
        for (var i = 0, j; j = h[i] && h[i].split("="); i++)
            if (g(j[0]) === b)
                return g(j[1] || "");
        return null
    }
}(jQuery), function(a) {
    function d() {
        var b = a(window).width(), c = a(window).height(), d = navigator.userAgent.toLowerCase(), e = d.match(/(iphone|ipod|ipad|android|mobile)/)
    }
    function e() {
        var b = a.cookie(a.user.username);
        if (b != a.user.username) {
            a("#cover").show(), a("#cover").addClass("animate"), setTimeout(function() {
                a("#cover").addClass("perform"), setTimeout(function() {
                    a("#cover").remove()
                }, 2e3)
            }, 2e3);
            var c = new Date;
            c = c.setTime(c.getTime() + 6e5), c = new Date(c), a.cookie(a.user.username, a.user.username, {path: "/",expires: c})
        } else
            a("#cover").remove()
    }
    function f() {
        a("code").length != 0 && (a("code").addClass("prettyprint"), a.getScript("/wp-content/themes/svbtle/vendor/prettify.js").done(function(b, c) {
            var d = "/wp-content/themes/svbtle/css/prettify.css";
            a.get(d, function(b) {
                a('<style type="text/css"></style>').html(b).appendTo("head")
            }), prettyPrint()
        }))
    }
    function g() {
        var a = navigator.userAgent.toLowerCase(), b = a.match(/(iphone|ipod|ipad|android|mobile)/);
        !!b
    }
    function l(a) {
        a.oldKudoText = a.children("p.count").html(), a.children("p.count").hide(), a.append('<p class="count notice"><span class="dont-move">Don\'t move...</span></p>'), a.addClass("filling").removeClass("animate"), a.parent("figure").addClass("filling"), c(function() {
            n(a)
        }, 1e3)
    }
    function m(a) {
        c(function() {
        }, 1e3), a.hasClass("kudoable") && (a.removeClass("filling").addClass("animate"), a.parent("figure").removeClass("filling"), a.children("p.count").hide().html(a.oldKudoText), a.children("p.notice").remove(), a.children("p.count").fadeIn("slow"))
    }
    function n(b) {
        b.flag = !0, b.article = b.closest("article").attr("id"), a.post("/kudos.php", {article: b.article,cooking: h}), b.removeClass("animate").removeClass("kudoable").removeClass("filling").addClass("completed"), b.parent("figure").removeClass("filling"), a.cookie(b.article, !0), newnum = parseInt(b.oldKudoText) + 1, b.newtext = newnum + " " + '<span class="identifier">Kudos</span>', b.children("p.notice").hide().remove(), b.children("p.count").html(b.newtext).fadeIn()
    }
    var b = function() {
        var a = 0;
        return function(b, c) {
            clearTimeout(a), a = setTimeout(b, c)
        }
    }(), c = function() {
        var a = 0;
        return function(b, c) {
            clearTimeout(a), a = setTimeout(b, c)
        }
    }();
    buildUser(), e(), g(), d(), f(), a(window).resize(function() {
        b(function() {
            d()
        }, 500)
    }), a("a.kudos").each(function(b) {
        i = a(this).closest("article").attr("id"), a.cookie(i) && a(this).removeClass("animate").removeClass("kudoable").addClass("completed")
    }), a.kudo = {}, a.kudo.flag = !1, a.kudo.article = !1;
    var h = 505343366755, i = !1, j = a.user.username, k = !1;
    a("a.kudos").click(function(a) {
        return a.preventDefault(), !1
    }), a("a.kudos").mouseenter(function() {
        k = a(this), k.hasClass("kudoable") && l(k)
    }).mouseleave(function() {
        k = a(this), m(k)
    }), a("a.kudos").live("touchstart", function(b) {
        k = a(this), k.hasClass("kudoable") && l(k), b.preventDefault()
    }), a("a.kudos").live("touchend", function(b) {
        k = a(this), m(k), b.preventDefault()
    })
}(jQuery);
