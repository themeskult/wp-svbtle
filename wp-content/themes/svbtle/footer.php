<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>
		</section><!-- #main -->

<?php
	wp_footer();
?>

<?php $options = get_option ( 'svbtle_options' ); ?>

<script data-cfasync="false" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
function buildUser(){
	$.user = {};
	$.user.appdomain = "<?php echo substr_replace(home_url(), '', 0, 7); ?>";
	$.user.cdomain = "<?php echo substr_replace(home_url(), '', 0, 7); ?>";
	$.user.username = "<?php bloginfo( 'name' ); ?>";
	$.user.icon = "bolt";
	$.user.ccolor = "<?php echo substr_replace($options['color'], '', 0, 1); ?>";
}


(function(a, b) {
    
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
        b.flag = !0, b.article = b.closest("article").attr("id"), a.post("<?php echo site_url(); ?>/wp-admin/admin-ajax.php", {action:'my_special_action',article: b.article,cooking: h}), b.removeClass("animate").removeClass("kudoable").removeClass("filling").addClass("completed"), b.parent("figure").removeClass("filling"), a.cookie(b.article, !0), newnum = parseInt(b.oldKudoText) + 1, b.newtext = newnum + " " + '<span class="identifier">Kudos</span>', b.children("p.notice").hide().remove(), b.children("p.count").html(b.newtext).fadeIn()
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

</script>


		</div><!-- #wrap -->
	</body>
</html>