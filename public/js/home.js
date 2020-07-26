var a2a_config = a2a_config || {};
a2a_config.vars = {
    vars: ["menu_type", "static_server", "linkmedia", "linkname", "linkurl", "linkname_escape", ["http_s", "http:" != document.location.protocol ? "s" : ""], "show_title", "onclick", "num_services", "hide_embeds", "prioritize", "exclude_services", "custom_services", ["templates", {}], "orientation", ["track_links", !1],
        ["track_links_key", ""], "tracking_callback", "track_pub", "color_main", "color_bg", "color_border", "color_link_text", "color_link_text_hover", "color_arrow", "color_arrow_hover", ["localize", "", 1],
        ["add_services", !1, 1], "locale", "delay", "icon_color", "no_3p", "show_menu", "target"
    ],
    process: function() {
        for (var e, a, t, n, o, i = a2a_config.vars.vars, l = 0, r = "a2a_", s = i.length; l < s; l++)
            if ("string" == typeof i[l] ? (e = i[l], a = window[r + e], n = !1) : (e = i[l][0], a = window[r + e], t = i[l][1], n = !0, o = i[l][2]), void 0 !== a && null != a) {
                if (a2a_config[e] = a, !o) try {
                    delete window[r + e]
                } catch (c) {
                    window[r + e] = null
                }
            } else n && !a2a_config[e] && (a2a_config[e] = t)
    }
}, a2a_config.vars.process(), a2a_config.static_server = a2a_config.static_server || "https://static.addtoany.com/menu";
var a2a = a2a || {
    static_addtoany: "https://static.addtoany.com/menu",
    total: 0,
    kit_services: [],
    icons_img_url: a2a_config.static_server + "/icons.36.png",
    head_tag: document.getElementsByTagName("head")[0],
    canonical_url: function() {
        if (!document.querySelector) return !1;
        var e, a = document.querySelector('meta[property="og:url"]');
        return a ? a.content : !!(e = document.querySelector('link[rel="canonical"]')) && e.href
    }(),
    ieo: function() {
        for (var e = -1, a = document.createElement("b"); a.innerHTML = "\x3c!--[if gt IE " + ++e + "]>1<![endif]--\x3e", +a.innerHTML;);
        return a2a.ieo = function() {
            return e
        }, e
    },
    quirks: document.compatMode && "BackCompat" == document.compatMode ? 1 : null,
    has_menter: document.documentElement && "onmouseenter" in document.documentElement,
    has_touch: "ontouchend" in window,
    has_pointer: window.PointerEvent || navigator.msPointerEnabled,
    fn_queue: [],
    dom: {
        isReady: !1,
        ready: function(e) {
            var a = function() {
                    if (!document.body) return setTimeout(a2a.dom.ready(e));
                    e(), a2a.dom.isReady = !0
                },
                t = function(e) {
                    (document.addEventListener || "load" === e.type || "complete" === document.readyState) && (n(), a())
                },
                n = function() {
                    document.addEventListener ? (document.removeEventListener("DOMContentLoaded", t, !1), window.removeEventListener("load", t, !1)) : (document.detachEvent("onreadystatechange", t), window.detachEvent("onload", t))
                };
            if ("complete" === document.readyState) a();
            else if (document.addEventListener) document.addEventListener("DOMContentLoaded", t, !1), window.addEventListener("load", t, !1);
            else {
                document.attachEvent("onreadystatechange", t), window.attachEvent("onload", t);
                var o = !1;
                try {
                    o = null == window.frameElement && document.documentElement
                } catch (i) {}
                o && o.doScroll && function l() {
                    if (!a2a.dom.isReady) {
                        try {
                            o.doScroll("left")
                        } catch (i) {
                            return setTimeout(l, 50)
                        }
                        n(), a()
                    }
                }()
            }
        }
    },
    ready: function() {
        a2a.locale || (a2a.type = "page", a2a.cbs("ready"), a2a.ready = function() {})
    },
    init: function(e, a, t) {
        var n, o, i, l, r, s, c = a2a.c,
            d = (a = a || {}, {}),
            u = null,
            p = {},
            m = location.href,
            _ = function(e, a) {
                a2a.total++, a2a.n = a2a.total, a2a["n" + a2a.n] = e;
                var t, n, o = e.node = a2a.set_this_index(e.node),
                    i = document.createElement("div"),
                    l = a2a.getData(o)["a2a-media"],
                    r = a2a.getData(o)["a2a-title"],
                    s = a2a.getData(o)["a2a-url"];
                o ? (e.linkname_escape && (n = a2a.getByClass("a2a_linkname_escape", o.parentNode)[0] || a2a.getByClass("a2a_linkname_escape", o.parentNode.parentNode)[0]) && (e.linkname = n.textContent || n.innerText), e.linkmedia = a.linkmedia = l || e.linkmedia, e.linkname = a.linkname = r || e.linkname, e.linkurl = a.linkurl = s || e.linkurl, r && (e.linkname_implicit = !1), s && (e.linkurl_implicit = !1), "textContent" in document ? i.textContent = e.linkname : i.innerText = e.linkname, (t = i.childNodes[0]) && (e.linkname = t.nodeValue), o.a2a_kit ? a2a.kit(e, a) : a2a.button(e)) : a2a.c.show_menu || a2a.total--
            };
        for (var f in a2a.make_once(e), a) c[f] = a[f];
        for (var f in c) d[f] = c[f];
        if (o = c.target)
            if ("string" == typeof o) {
                if (i = o.substr(0, 1), l = o.substr(1), "." == i) return a2a.multi_init(a2a.HTMLcollToArray(a2a.getByClass(l, document)), e, a), void(c.target = !1);
                (n = (u = a2a.gEl(l)).className).indexOf("a2a_kit") >= 0 && n.indexOf("a2a_target") < 0 && (u = null)
            } else u = c.target;
        (e = c.menu_type ? "mail" : e) && (a2a.type = e, c.vars.process()), p.type = a2a.type, p.node = u, p.linkmedia = c.linkmedia, p.linkname = c.linkname || document.title || location.href, p.linkurl = c.linkurl || location.href, p.linkname_escape = c.linkname_escape, p.linkname_implicit = !c.linkname_escape && (document.title || m) == p.linkname, p.linkurl_implicit = m == p.linkurl, p.orientation = c.orientation || !1, p.track_links = c.track_links || !1, p.track_links_key = c.track_links_key || "", p.track_pub = c.track_pub || !1, c.linkmedia = c.linkname = c.linkurl = c.linkname_escape = c.show_title = c.custom_services = c.exclude_services = c.orientation = c.track_pub = c.target = !1, "custom" == c.track_links && (c.track_links = !1, c.track_links_key = ""), a2a.last_type = a2a.type, window["a2a" + a2a.type + "_init"] = 1, a2a.locale && !t ? a2a.fn_queue.push((r = p, s = d, function() {
            _(r, s)
        })) : (_(p, d), c.menu_type = !1, a2a.init_show())
    },
    init_all: function(e) {
        !a2a.unindexed(function(a) {
            a.className.indexOf("a2a_follow") >= 0 ? a2a.init("feed") : a2a.init(e)
        }, !0) && a2a.gEl("a2a_menu_container") && a2a.init(e)
    },
    multi_init: function(e, a, t) {
        for (var n = 0, o = e.length; n < o; n++) t.target = e[n], a2a.init(a, t)
    },
    button: function(e) {
        var a = a2a.gEl,
            t = e.node,
            n = e.type,
            o = "a2a" + n,
            i = a(o + "_dropdown"),
            l = a(o + "_full"),
            r = a2a.has_menter,
            s = t.firstChild,
            c = a2a[n].onclick;
        t.getAttribute("onclick") && -1 != (t.getAttribute("onclick") + "").indexOf("a2a_") || t.getAttribute("onmouseover") && -1 != (t.getAttribute("onmouseover") + "").indexOf("a2a_") || (a2a.add_event(t, "click", function(e) {
            a2a.preventDefault(e), a2a.stopPropagation(e);
            var r = "none" !== i.style.display,
                s = document.activeElement;
            r ? a2a.toggle_dropdown("none", n) : 2 !== c && (a2a.show_menu(t), a2a[n].last_focus = s, i.focus()), (r && "none" !== a2a.getStyle(a(o + "_show_more_less"), "display") || 2 === c) && (a2a.show_full(!0), a2a[n].last_focus = s, l.focus())
        }), a2a.add_event(t, "click", a2a.stopPropagation), a2a.add_event(t, "touchstart", a2a.stopPropagation, !!a2a.evOpts() && {
            passive: !0
        }), !a2a[a2a.type].onclick && r && (a2a.c.delay ? t.onmouseenter = function() {
            a2a[a2a.type].over_delay = setTimeout(function() {
                a2a.show_menu(t)
            }, a2a.c.delay)
        } : t.onmouseenter = function() {
            a2a.show_menu(t)
        }, t.onmouseleave = function() {
            a2a.miniLeaveDelay(), a2a[a2a.type].over_delay && clearTimeout(a2a[a2a.type].over_delay)
        })), "a" == t.tagName.toLowerCase() && "page" == a2a.type && (t.href = "https://www.addtoany.com/share#url=" + encodeURIComponent(e.linkurl) + "&title=" + encodeURIComponent(e.linkname).replace(/'/g, "%27")), s && "undefined" != typeof s.srcset && /\/share_save_171_16.(?:gif|png)$/.test(s.src) && (s.srcset = "https://static.addtoany.com/buttons/share_save_342_32.png 2x")
    },
    kit: function(e, a) {
        var t, n, o, i, l, r = a2a.type,
            s = {
                behance: {
                    name: "Behance",
                    icon: "behance",
                    color: "007EFF",
                    url: "https://www.behance.net/${id}"
                },
                facebook: {
                    name: "Facebook",
                    icon: "facebook",
                    color: "3B5998",
                    url: "https://www.facebook.com/${id}"
                },
                flickr: {
                    name: "Flickr",
                    icon: "flickr",
                    color: "FF0084",
                    url: "https://www.flickr.com/photos/${id}"
                },
                foursquare: {
                    name: "Foursquare",
                    icon: "foursquare",
                    color: "F94877",
                    url: "https://foursquare.com/${id}"
                },
                github: {
                    name: "GitHub",
                    icon: "github",
                    color: "2A2A2A",
                    url: "https://github.com/${id}"
                },
                google_plus: {
                    name: "Google+",
                    icon: "google_plus",
                    color: "DD4B39",
                    url: "https://plus.google.com/${id}"
                },
                instagram: {
                    name: "Instagram",
                    icon: "instagram",
                    color: "E4405F",
                    url: "https://www.instagram.com/${id}"
                },
                linkedin: {
                    name: "LinkedIn",
                    icon: "linkedin",
                    color: "007BB5",
                    url: "https://www.linkedin.com/in/${id}"
                },
                linkedin_company: {
                    name: "LinkedIn",
                    icon: "linkedin",
                    color: "007BB5",
                    url: "https://www.linkedin.com/company/${id}"
                },
                medium: {
                    name: "Medium",
                    icon: "medium",
                    color: "2A2A2A",
                    url: "https://medium.com/@${id}"
                },
                pinterest: {
                    name: "Pinterest",
                    icon: "pinterest",
                    color: "BD081C",
                    url: "https://www.pinterest.com/${id}"
                },
                snapchat: {
                    name: "Snapchat",
                    icon: "snapchat",
                    color: "2A2A2A",
                    url: "https://www.snapchat.com/add/${id}"
                },
                tumblr: {
                    name: "Tumblr",
                    icon: "tumblr",
                    color: "35465C",
                    url: "http://${id}.tumblr.com"
                },
                twitter: {
                    name: "Twitter",
                    icon: "twitter",
                    color: "55ACEE",
                    url: "https://twitter.com/${id}"
                },
                vimeo: {
                    name: "Vimeo",
                    icon: "vimeo",
                    color: "1AB7EA",
                    url: "https://vimeo.com/${id}"
                },
                youtube: {
                    name: "YouTube",
                    icon: "youtube",
                    color: "FF0000",
                    url: "https://www.youtube.com/user/${id}"
                },
                youtube_channel: {
                    name: "YouTube Channel",
                    icon: "youtube",
                    color: "FF0000",
                    url: "https://www.youtube.com/channel/${id}"
                }
            },
            c = ["facebook_like", "twitter_tweet", "google_plusone", "google_plus_share", "pinterest_pin", "linkedin_share"],
            d = a2a.counters.avail,
            u = function(e, a) {
                if (e && !a2a.in_array(e, c))
                    for (var t = 0, n = a ? a2a[r].services : a2a.services, o = n.length; t < o; t++)
                        if (e == n[t][1]) return [n[t][0], n[t][2], n[t][3], n[t][4], n[t][5]];
                return !a && [e, e]
            },
            p = function(e, a) {
                for (var t, n = 0, o = e.attributes.length, i = a; n < o; n++)(t = e.attributes[n]).name && "data-" == t.name.substr(0, 5) && (i[t.name.substr(5)] = t.value);
                return i
            },
            m = function() {
                x = e.linkurl = a2a.getData(g)["a2a-url"] || x, C = e.linkname = a2a.getData(g)["a2a-title"] || C, E = e.linkmedia = a2a.getData(g)["a2a-media"] || E, a2a.linker(this)
            },
            _ = function(a, t, n) {
                var o = {
                        node: t,
                        service: a,
                        title: C,
                        url: x,
                        media: E,
                        mediaNode: g.a2a_mediaNode
                    },
                    i = a2a.cbs("share", o);
                void 0 !== i && (i.url && (e.linkurl = i.url, e.linkurl_implicit = !1), i.title && (e.linkname = i.title, e.linkname_implicit = !1), i.media && (e.linkmedia = i.media), a2a.linker(t), i.stop && n && a2a.preventDefault(n))
            },
            f = a2a.c.templates,
            g = e.node,
            h = a2a.getData(g),
            v = g.a2a_follow,
            y = a2a.HTMLcollToArray(g.getElementsByTagName("a")),
            k = y.length,
            w = document.createElement("div"),
            b = encodeURIComponent,
            x = e.linkurl,
            A = b(e.linkurl).replace(/'/g, "%27"),
            C = e.linkname,
            E = (b(e.linkname).replace(/'/g, "%27"), e.linkmedia),
            B = (E && b(e.linkmedia).replace(/'/g, "%27"), h["a2a-icon-color"] || a2a.c.icon_color),
            S = B ? B.split(",", 2) : B,
            F = S ? S[0] : S,
            N = S ? S[1] : S,
            T = g.className.match(/a2a_kit_size_([\w\.]+)(?:\s|$)/),
            L = T ? T[1] : "16",
            D = L + "px",
            z = "a2a_svg a2a_s__default a2a_s_",
            I = {},
            j = {},
            M = e.linkurl_implicit && a2a.canonical_url ? encodeURIComponent(a2a.canonical_url).replace(/'/g, "%27") : A,
            P = g.className.indexOf("a2a_vertical_style") >= 0;
        L && !isNaN(L) && (a2a.svg.load(), B && "unset" != B && a2a.svg.works() && (F && "unset" != F && (I.backgroundColor = F), N && "unset" != N.trim() && (N = N.trim())), g.style.lineHeight = j.height = j.lineHeight = D, j.width = 2 * L + "px", j.fontSize = "16px", P && (j.height = j.lineHeight = L / 2 + "px", j.fontSize = "10px", j.width = L + "px"), 32 != L && (I.backgroundSize = I.height = I.lineHeight = I.width = D, j.borderRadius = I.borderRadius = (.14 * L).toFixed() + "px", j.fontSize = (parseInt(j.height, 10) + (P ? 4 : 0)) / 2 + "px")), a2a.kit.facebook_like = function() {
            ce.href = x, ce.width = "90", ce.layout = "button_count", ce.ref = "addtoany", ce = p(U, ce), U.style.width = ce.width + "px";
            var e, a, t, n, o = a2a.i18n();
            for (var i in 2 == (o = o ? o.replace(/-/g, "_") : "en_US").length && (o += "_" + o.toUpperCase()), ce) se += " data-" + i + '="' + ce[i] + '"';
            window.fbAsyncInit || (window.fbAsyncInit = function() {
                FB.init({
                    appId: "0",
                    status: !1,
                    xfbml: !0,
                    version: "v2.11"
                }), FB.Event.subscribe("edge.create", function(e, a) {
                    a2a.GA.track("Facebook Like", "facebook_like", e, "pages", "AddToAny Share/Save Button"), _("Facebook Like", U)
                })
            }, (O = document.createElement("span")).id = "fb-root", document.body.insertBefore(O, document.body.firstChild)), a2a.kit.facebook_like_script || (e = document, a = "facebook-jssdk", n = e.getElementsByTagName("script")[0], e.getElementById(a) || ((t = e.createElement("script")).id = a, t.src = "https://connect.facebook.net/" + o + "/sdk.js#xfbml=1&version=v2.11", n.parentNode.insertBefore(t, n))), a2a.kit.facebook_like_script = 1, U.innerHTML = '<div class="fb-like"' + se + "></div>";
            try {
                FB.XFBML.parse(U)
            } catch (l) {}
        }, a2a.kit.twitter_tweet = function() {
            ce.url = x, ce.lang = a2a.i18n() || "en", ce.related = "AddToAny,micropat";
            var e = f.twitter,
                a = "string" == typeof e ? e.lastIndexOf("@") : null;
            a && -1 !== a && (a++, a = (a = e.substr(a).split(" ", 1))[0].replace(/:/g, "").replace(/\//g, "").replace(/-/g, "").replace(/\./g, "").replace(/,/g, "").replace(/;/g, "").replace(/!/g, ""), ce.related = a + ",AddToAny"), ce = p(U, ce);
            var t, n, o, i, l, r = document.createElement("a");
            for (var s in r.className = "twitter-share-button", ce) r.setAttribute("data-" + s, ce[s]);
            U.appendChild(r), a2a.kit.twitter_tweet_script || (t = document, n = "twitter-wjs", l = t.getElementsByTagName("script")[0], t.getElementById(n) || ((i = t.createElement("script")).id = n, i.src = "https://platform.twitter.com/widgets.js", l.parentNode.insertBefore(i, l), window.twttr = window.twttr || (o = {
                _e: [],
                ready: function(e) {
                    o._e.push(e)
                }
            }))), a2a.kit.twitter_tweet_script = 1;
            try {
                twttr.ready(function(e) {
                    a2a.twitter_bind || (e.events.bind("click", function(e) {
                        if (e && "tweet" == e.region) {
                            var a = function() {
                                var a = e.target.src.split("#")[1] || "";
                                if (a && a.indexOf("url=") > -1) {
                                    for (var t = {}, n = a.split("&"), o = n.length, i = 0; i < o; i++) {
                                        var l = n[i].split("=");
                                        t[l[0]] = l[1]
                                    }
                                    return t
                                }
                                return !1
                            }();
                            a && a.url && (a2a.GA.track("Twitter Tweet", "twitter_tweet", unescape(a.url), "pages", "AddToAny Share/Save Button"), _("Twitter Tweet", U))
                        }
                    }), a2a.twitter_bind = 1), e.widgets && e.widgets.load()
                })
            } catch (c) {}
        }, a2a.kit.pinterest_pin = function() {
            ce["pin-config"] = "beside", ce["pin-do"] = "buttonPin", ce.media = E, ce.url = x, ce = p(U, ce);
            var e, a, t, n = document.createElement("a");
            for (var o in ce) n.setAttribute("data-" + o, ce[o]);
            "beside" == ce["pin-config"] && "buttonPin" == ce["pin-do"] && (U.style.width = "76px"), n.href = "https://www.pinterest.com/pin/create/button/?url=" + ce.url + (ce.media ? "&media=" + ce.media : "") + (ce.description ? "&description=" + encodeURIComponent(ce.description).replace(/'/g, "%27") : ""), a2a.add_event(U, "click", function() {
                a2a.GA.track("Pinterest Pin", "pinterest_pin", x, "pages", "AddToAny Share/Save Button"), _("Pinterest Pin", U)
            }), U.appendChild(n), a2a.kit.pinterest_pin_script || (e = document, a = e.createElement("script"), t = e.getElementsByTagName("script")[0], a.type = "text/javascript", a.async = !0, a.src = "https://assets.pinterest.com/js/pinit.js", t.parentNode.insertBefore(a, t)), a2a.kit.pinterest_pin_script = 1
        }, a2a.kit.linkedin_share = function() {
            for (var e in ce.onsuccess = "a2a.kit.linkedin_share_event", ce.url = x, ce = p(U, ce)) se += " data-" + e + '="' + ce[e] + '"';
            var a, t, n;
            a2a.kit.linkedin_share_event = function() {
                a2a.GA.track("LinkedIn Share", "linkedin_share", x, "pages", "AddToAny Share/Save Button"), _("LinkedIn Share", U)
            }, a2a.kit.linkedin_share_script || (a = document, t = a.createElement("script"), n = a.getElementsByTagName("script")[0], t.type = "text/javascript", t.async = !0, t.src = "https://platform.linkedin.com/in.js", n.parentNode.insertBefore(t, n)), a2a.kit.linkedin_share_script = 1, U.innerHTML = '<script type="IN/Share"' + se + "><\/script>"
        }, a2a.kit.google_plus = function() {
            window.google_plus_cb_a2a = function(e) {
                e.state && "off" == e.state || (a2a.GA.track("Google +1", "google_plusone", e.href, "pages", "AddToAny Share/Save Button"), _("Google +1", U))
            }, ce.href = x, ce.size = "medium", ce.annotation = "bubble", "google_plus_share" == K && (ce.action = "share"), ce = p(U, ce);
            var e, a, t, n = a2a.i18n() || "en-US";
            for (var o in window.___gcfg = window.___gcfg || {
                lang: n
            }, ce) se += " data-" + o + '="' + ce[o] + '"';
            U.innerHTML = '<div class="g-plus' + ("share" == ce.action ? "" : "one") + '" data-callback="google_plus_cb_a2a"' + se + "></div>", a2a.kit.google_plus_script || (e = document, a = e.createElement("script"), t = e.getElementsByTagName("script")[0], a.type = "text/javascript", a.async = !0, a.src = "https://apis.google.com/js/platform.js", t.parentNode.insertBefore(a, t), a2a.kit.google_plus_script = 1)
        }, a2a.kit.google_plusone = a2a.kit.google_plus_share = a2a.kit.google_plus;
        for (var H = 0; H < k; H++) {
            var O, R, $, q, U = y[H],
                G = U.className,
                W = G.match(/a2a_button_([\w\.]+)(?:\s|$)/),
                Y = G.indexOf("a2a_dd") >= 0,
                V = G.indexOf("a2a_counter") >= 0,
                K = !!W && W[1],
                J = U.childNodes,
                X = u(K),
                Q = v && s[K] ? s[K].name : X[0],
                Z = " noopener",
                ee = "_blank",
                ae = v && s[K] ? s[K].icon : X[1],
                te = v && s[K] ? s[K].color : X[2] || "CAE0FF",
                ne = X[3] || {},
                oe = ne.type,
                ie = X[4],
                le = !1,
                re = !1,
                se = "",
                ce = {};
            if (Y ? (a.target = U, a2a.init(r, a, 1), K = "a2a", te = "0166FF", ae = "a2a", re = !!V && 1) : "feed" == K || "print" == K ? (ee = "", Z = "") : V && K && a2a.in_array(K, d) ? re = 1 : K && a2a.in_array(K, c) && (a2a.kit[K](), le = 1), K && !le) {
                if (Y || (U.target = ee, !v || !s[K] && u(K, !0) ? "feed" == K ? U.href = U.href || e.linkurl : (U.href = "/#" + K, a2a.add_event(U, "mousedown", m), a2a.add_event(U, "keydown", m), U.rel = "nofollow" + Z) : U.href = (n = K, o = void 0, void 0, l = void 0, i = p(t = U, {})["a2a-follow"], l = s[n], i && l && (o = l.url.replace("${id}", i)), o || t.href), U.a2a = {}, U.a2a.customserviceuri = ie, U.a2a.stype = oe, U.a2a.linkurl = e.linkurl, U.a2a.servicename = Q, U.a2a.safename = K, ne.src && (U.a2a.js_src = ne.src), ne.url && (U.a2a.url = ne.url), ne.pu && (U.a2a.popup = 1), ne.media && (U.a2a.media = 1), v || a2a.add_event(U, "click", function(e, a, t, n, o) {
                        return function(i) {
                            var l = screen.height,
                                s = "event=service_click&url=" + b(location.href) + "&title=" + b(document.title || "") + "&ev_service=" + b(e) + "&ev_service_type=kit&ev_menu_type=" + r + "&ev_url=" + b(t) + "&ev_title=" + b(n).replace(/'/g, "%27");
                            _(a, o, i), o.a2a.popup && !a2a.defaultPrevented(i) && "javascript:" != o.href.substr(0, 11) && (a2a.preventDefault(i), window.open(o.href, "_blank", "toolbar=0,personalbar=0,resizable,scrollbars,status,width=550,height=450,top=" + (l > 450 ? Math.round(l / 2 - 225) : 40) + ",left=" + Math.round(screen.width / 2 - 275))), a2a.util_frame_post(r, s), a2a.GA.track(a, e, t, "pages", "AddToAny Share/Save Button")
                        }
                    }(K, Q, x, C, U))), J.length) {
                    for (var de, ue = 0, pe = J.length; ue < pe; ue++)
                        if (de = J[ue].className, 1 == J[ue].nodeType && "a2a_label" != de && (q = !0, "string" == typeof de && de.indexOf("a2a_count") >= 0)) {
                            $ = !0;
                            break
                        }
                    if (!q) {
                        for (var me in (O = document.createElement("span")).className = z + ae + " a2a_img_text", te && (O.style.backgroundColor = "#" + te), "pending" !== (R = a2a.svg.get(ae, O, N)) && (O.innerHTML = R), I) O.style[me] = I[me];
                        U.insertBefore(O, J[0])
                    }
                } else {
                    for (var me in (O = document.createElement("span")).className = z + ae, te && (O.style.backgroundColor = "#" + te), "pending" !== (R = a2a.svg.get(ae, O, N)) && (O.innerHTML = R), I) O.style[me] = I[me];
                    U.appendChild(O), (O = document.createElement("span")).className = "a2a_label", O.innerHTML = Q || ("feed" == r ? a2a.c.localize.Subscribe : a2a.c.localize.Share), U.appendChild(O)
                }
                if (P && L && L < 20 && (re = !1), re && !$) {
                    for (var me in (O = document.createElement("span")).className = "a2a_count", O.a2a = {}, O.a2a.kit = g, j) O.style[me] = j[me];
                    U.appendChild(O), Y ? (O.a2a.is_a2a_dd_counter = 1, a2a.counters.get("facebook", O, M), g.a2a_dd_counter = O) : a2a.counters.get(K, O, M)
                }
                "a2a_dd" != G && a2a.kit_services.push(U)
            }
        }
        g.className.indexOf("a2a_default_style") >= 0 && (w.style.clear = "both", g.appendChild(w))
    },
    counters: {
        get: function(e, a, t, n) {
            a2a_config.counts;
            var o, i, l = decodeURIComponent(t),
                r = a2a.counters.bonus(e, l, t, a.a2a.kit),
                s = "",
                c = a2a.counters[e],
                d = c.api,
                u = (c.cb, a.a2a.is_a2a_dd_counter);
            !n && r && (s = "2", a2a.counters.get(e, a, r, !0)), "undefined" == typeof(o = c[l] = c[l] || {}).num ? (o.queued = o.queued || [], o.queued.push(a), c.n = c.n || 0, c.n++, c["cb" + c.n] = function(t) {
                var n = a2a.counters[e].cb(t, a);
                if (void 0 !== n)
                    for (var i = 0; i < o.queued.length; i++) queued_count_element = o.queued[i], o.num = n, queued_count_element.a2a.is_a2a_dd_counter ? a2a.counters.sum(queued_count_element, n, e + s) : a2a.counters.set(queued_count_element, n, e + s)
            }, 1 == o.queued.length && (i = d[0] + t + (d[1] || "&callback") + "=a2a.counters." + e + ".cb" + c.n, a2a.dom.ready(function() {
                a2a.loadExtScript(i)
            }))) : u ? a2a.counters.sum(a, o.num, e + s) : a2a.counters.set(a, o.num, e + s)
        },
        set: function(e, a, t) {
            var n = a;
            a = "undefined" != typeof e.a2a.last_count ? e.a2a.last_count + a : a, e.innerHTML = "<span>" + a2a.counters.format(a) + "</span>", "a2a" != t && (e.a2a.last_count = n, a2a.counters.sum(e, n, t))
        },
        sum: function(e, a, t) {
            var n = e.a2a.kit,
                o = n.a2a_counts_sum || 0,
                i = n.a2a_counts_summed;
            i && i.indexOf(t) > -1 || ("a2a" != t && (o = n.a2a_counts_sum = o + a, (i = n.a2a_counts_summed = i || []).push(t)), n.a2a_dd_counter && a2a.counters.set(n.a2a_dd_counter, o, "a2a"))
        },
        format: function(e) {
            return e > 999 && (e = e < 1e6 ? e > 1e4 ? (e / 1e3).toFixed() + "k" : (e += "").charAt(0) + "," + e.substring(1) : e < 1e9 ? (e / 1e6).toFixed(e % 1e6 > 94999) + "M" : "1B+"), e
        },
        bonus: function(e, a, t, n) {
            var o, i, l, r = a2a_config.counts,
                s = "%3A%2F%2F";
            return r && (r.recover_protocol && "http" === r.recover_protocol && (o = t.replace(/^https%/, "http%"), a = decodeURIComponent(o)), r.recover_domain && (o = encodeURIComponent(a.replace(/^(https?\:\/\/)(?:[^\/?#]+)([\/?#]|$)/i, "$1" + r.recover_domain + "$2")), a = decodeURIComponent(o)), r.recover && "function" == typeof r.recover && ((i = document.createElement("a")).href = a, l = {
                url: a,
                pathParts: i.pathname.split("/"),
                domain: i.hostname,
                protocol: i.protocol,
                kit: n
            }, o = encodeURIComponent(r.recover(l)))), !(!o || o === t || -1 !== ["tumblr"].indexOf(e) && o.split(s).pop() === t.split(s).pop()) && o
        },
        avail: ["facebook", "pinterest", "reddit", "tumblr"],
        facebook: {
            api: ["https://graph.facebook.com/?id=", "&callback"],
            cb: function(e, a) {
                return e && e.share && !isNaN(e.share.share_count) ? e.share.share_count : 0
            }
        },
        pinterest: {
            api: ["https://widgets.pinterest.com/v1/urls/count.json?url="],
            cb: function(e, a) {
                if (e && !isNaN(e.count)) return e.count
            }
        },
        reddit: {
            api: ["https://www.reddit.com/api/info.json?url=", "&jsonp"],
            cb: function(e, a) {
                var t = e.data;
                if (e && t && t.children) {
                    for (var n, o = 0, i = [], l = t.children; o < l.length; o++)(n = l[o].data) && !isNaN(n.ups) && i.push(n.ups);
                    return i.length > 0 ? Math.max.apply(null, i) : 0
                }
            }
        },
        tumblr: {
            api: ["https://api.tumblr.com/v2/share/stats?url="],
            cb: function(e, a) {
                if (e && e.response && !isNaN(e.response.note_count)) return e.response.note_count
            }
        },
        twitter: {
            api: ["https://cdn.api.twitter.com/1/urls/count.json?url="],
            cb: function(e, a) {
                if (e && !isNaN(e.count)) return e.count
            }
        }
    },
    overlays: function() {
        var e = a2a.c.overlays || [],
            a = !!a2a.evOpts() && {
                passive: !0
            },
            t = window,
            n = t.innerWidth,
            o = t.innerHeight,
            i = n && (n < 375 || o < 375) ? 150 : 200,
            l = 200,
            r = location.href,
            s = document.title || r;

        function c(e, a, t, n) {
            var o, c, d, u, p, m, _, f, g, h, v = (h = e).target ? 3 === h.target.nodeType ? h.target.parentNode : h.target : h.srcElement,
                y = v,
                k = 0,
                b = 0,
                x = v.longDesc;
            if (a2a.matches(v, n) && "false" !== v.getAttribute("data-a2a-overlay")) {
                if (d = v.width < i || v.height < i, u = "naturalWidth" in v && (v.naturalWidth < l || v.naturalHeight < l), d || u) return;
                c = a2a.getPos(v), a.style.display = "", p = a.clientHeight || a.offsetHeight, m = a.clientWidth || a.offsetWidth, t[0] && ("bottom" === t[0] ? b = v.height - p : "center" === t[0] && (b = w((v.height - p) / 2))), t[1] && ("right" === t[1] ? k = v.width - m : "center" === t[1] && (k = w((v.width - m) / 2))), _ = c.left + k, f = c.top + b, a.style.left = _ + "px", a.style.top = f + "px", a.setAttribute("data-a2a-media", v.src), a.a2a_mediaNode = v, v.alt ? a.setAttribute("data-a2a-title", v.alt) : a.setAttribute("data-a2a-title", s), !x || "#" !== x.substr(0, 1) && "http" !== x.substr(0, 4) ? a.setAttribute("data-a2a-url", r) : (g = "#" === x.substr(0, 1) ? r.split("#")[0] + v.longDesc : x, a.setAttribute("data-a2a-url", g))
            } else if ("none" !== a.style.display) {
                for (;
                    (o = y) && "body" !== y.tagName.toLowerCase();) {
                    if (o === a) return;
                    y = y.parentNode
                }
                a.style.display = "none"
            }
        }
        for (var d = 0, u = e.length; d < u; d++) {
            var p, m = e[d],
                _ = m.services || ["pinterest", "facebook"],
                f = "",
                g = m.html,
                h = m.position,
                v = m.style,
                y = m.size || 32,
                k = m.target,
                w = Math.round;
            if (h = h && h.length > 2 ? h.split(" ") : ["top", "left"], v = !v || "horizontal" !== v && "default" !== v ? "vertical" : "default", k = k || "img", g) document.body.insertAdjacentHTML("beforeend", g), p = document.body.lastChild;
            else {
                for (var b = 0, x = _.length; b < x; b++) {
                    f += '<a class="a2a_button_' + _[b] + '"></a>'
                }(p = document.createElement("div")).className = "a2a_kit a2a_kit_size_" + y + " a2a_overlay_style a2a_" + v + "_style", p.innerHTML = f, p.setAttribute("data-a2a-title", s), p.setAttribute("data-a2a-url", r), document.body.insertBefore(p, null)
            }
            p.style.display = "none", p.style.position = "absolute", a2a.add_event(document.body, "mouseover", function(e, a, t) {
                return function(n) {
                    c(n, e, a, t)
                }
            }(p, h, k), a)
        }
        a2a.c.overlays = []
    },
    init_show: function() {
        var e = a2a_config,
            a = a2a[a2a.type],
            t = a2a.show_menu;
        e.bookmarklet && (a.no_hide = 1, t()), e.show_menu && (a.no_hide = 1, t(!1, e.show_menu))
    },
    unindexed: function(e, a) {
        function t(a) {
            for (var t, n, o = 0, i = a.length; o < i; o++)
                if (("undefined" == typeof(t = a[o]).a2a_index || "" === t.a2a_index) && t.className.indexOf("a2a_target") < 0 && t.parentNode.className.indexOf("a2a_kit") < 0 && (n = e(t)), n) return n;
            return null
        }
        if (a) return t(a2a.getByClass("a2a_kit", document)) || t(a2a.HTMLcollToArray(document.getElementsByName("a2a_dd")).concat(a2a.getByClass("a2a_dd", document)));
        t(a2a.getByClass("a2a_kit", document).concat(a2a.getByClass("a2a_dd", document), a2a.HTMLcollToArray(document.getElementsByName("a2a_dd"))))
    },
    set_this_index: function(e) {
        var a = a2a.n;

        function t(e) {
            if (!(e.className.indexOf("a2a_kit") >= 0)) return !1;
            e.a2a_kit = 1, e.className.indexOf("a2a_follow") >= 0 && (e.a2a_follow = 1)
        }
        return e ? (e.a2a_index = a, t(e), e) : a2a.unindexed(function(e) {
            return e.a2a_index = a, t(e), e
        }, !0)
    },
    gEl: function(e) {
        return document.getElementById(e)
    },
    getByClass: function(e, a, t) {
        return document.getElementsByClassName && /\{\s*\[native code\]\s*\}/.test("" + document.getElementsByClassName) ? a2a.getByClass = function(e, a, t) {
            for (var n, o = (a = a || a2a.gEl("a2a" + a2a.type + "_dropdown")).getElementsByClassName(e), i = t ? new RegExp("\\b" + t + "\\b", "i") : null, l = [], r = 0, s = o.length; r < s; r += 1) n = o[r], i && !i.test(n.nodeName) || l.push(n);
            return l
        } : document.evaluate ? a2a.getByClass = function(e, a, t) {
            t = t || "*", a = a || a2a.gEl("a2a" + a2a.type + "_dropdown");
            for (var n, o, i = e.split(" "), l = "", r = "http://www.w3.org/1999/xhtml", s = document.documentElement.namespaceURI === r ? r : null, c = [], d = 0, u = i.length; d < u; d += 1) l += "[contains(concat(' ',@class,' '), ' " + i[d] + " ')]";
            try {
                n = document.evaluate(".//" + t + l, a, s, 0, null)
            } catch (p) {
                n = document.evaluate(".//" + t + l, a, null, 0, null)
            }
            for (; o = n.iterateNext();) c.push(o);
            return c
        } : a2a.getByClass = function(e, a, t) {
            t = t || "*", a = a || a2a.gEl("a2a" + a2a.type + "_dropdown");
            for (var n, o, i = e.split(" "), l = [], r = "*" === t && a.all ? a.all : a.getElementsByTagName(t), s = [], c = 0, d = i.length; c < d; c += 1) l.push(new RegExp("(^|\\s)" + i[c] + "(\\s|$)"));
            for (var u = 0, p = r.length; u < p; u += 1) {
                n = r[u], o = !1;
                for (var m = 0, _ = l.length; m < _ && (o = l[m].test(n.className)); m += 1);
                o && s.push(n)
            }
            return s
        }, a2a.getByClass(e, a, t)
    },
    HTMLcollToArray: function(e) {
        for (var a = [], t = e.length, n = 0; n < t; n++) a[a.length] = e[n];
        return a
    },
    matches: function(e, a) {
        var t, n = "MatchesSelector",
            o = "ms" + n,
            i = "webkit" + n;
        if (e.matches) t = "matches";
        else if (e[o]) t = o;
        else {
            if (!e[i]) return a2a.matches = function(e, a) {
                return !1
            }, !1;
            t = i
        }
        return a2a.matches = function(e, a) {
            return e[t](a)
        }, a2a.matches(e, a)
    },
    evOpts: function() {
        var e = !1;
        try {
            var a = Object.defineProperty({}, "passive", {
                get: function() {
                    e = !0
                }
            });
            window.addEventListener("test", null, a)
        } catch (t) {}
        return a2a.evOpts = function() {
            return e
        }, e
    },
    add_event: function(e, a, t, n) {
        if (e.addEventListener) {
            if ("object" == typeof n) {
                var o = !!n.useCapture;
                n = a2a.evOpts() ? n : o
            }
            return e.addEventListener(a, t, n), {
                destroy: function() {
                    e.removeEventListener(a, t, n)
                }
            }
        }
        var i = function() {
            t.call(e, window.event)
        };
        return e.attachEvent("on" + a, i), {
            destroy: function() {
                e.detachEvent("on" + a, i)
            }
        }
    },
    stopPropagation: function(e) {
        e || (e = window.event), e.cancelBubble = !0, e.stopPropagation && e.stopPropagation()
    },
    preventDefault: function(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = !1
    },
    defaultPrevented: function(e) {
        return !!(e.defaultPrevented || !1 === e.returnValue || "undefined" == typeof e.defaultPrevented && e.getPreventDefault && e.getPreventDefault())
    },
    onLoad: function(e) {
        var a = window.onload;
        "function" != typeof window.onload ? window.onload = e : window.onload = function() {
            a && a(), e()
        }
    },
    in_array: function(e, a, t, n, o) {
        if ("object" == typeof a) {
            e = e.toLowerCase();
            for (var i, l = a.length, r = 0; r < l; r++)
                if (i = n ? a[r][n] : a[r], i = o ? i[o] : i, t) {
                    if (e == i.toLowerCase()) return a[r]
                } else if (-1 != e.indexOf(i.toLowerCase()) && "" !== i) return a[r]
        }
        return !1
    },
    serialize: function(e, a) {
        var t = [];
        for (var n in e)
            if (e.hasOwnProperty(n)) {
                var o = a ? a + "[" + n + "]" : n,
                    i = e[n];
                t.push("object" == typeof i ? a2a.serialize(i, o) : encodeURIComponent(o) + "=" + encodeURIComponent(i))
            }
        return t.join("&")
    },
    miniLeaveDelay: function() {
        var e = a2a.type,
            a = "a2a" + e,
            t = a2a.gEl,
            n = a2a.getStyle;
        "none" != n(t(a + "_dropdown"), "display") && "none" == n(t(a + "_full"), "display") && (a2a[e].out_delay = setTimeout(function() {
            a2a.toggle_dropdown("none", e), a2a[e].out_delay = null
        }, 501))
    },
    miniEnterStay: function() {
        a2a[a2a.type].out_delay && clearTimeout(a2a[a2a.type].out_delay)
    },
    toggle_dropdown: function(e, a) {
        if ("none" != e || !a2a[a].no_hide) {
            var t = (0, a2a.gEl)("a2a" + a + "_dropdown"),
                n = (document.activeElement, a2a.show_menu.key_listener);
            t.style.display = e, a2a.miniEnterStay(), "none" == e && (a2a.show_menu["doc_click_listener_" + a].destroy(), delete a2a[a].doc_click_close_mini, n && n[a] && n[a].destroy())
        }
    },
    getData: function(e) {
        if (!e) return {};
        for (var a, t = 0, n = e.attributes.length, o = {}; t < n; t++)(a = e.attributes[t]).name && "data-" == a.name.substr(0, 5) && (o[a.name.substr(5)] = a.value);
        return o
    },
    getStyle: function(e, a) {
        return e.currentStyle ? e.currentStyle[a.replace(/-(\w)/gi, function(e, a) {
            return a.toUpperCase()
        })] : window.getComputedStyle(e, null).getPropertyValue(a)
    },
    getPos: function(e) {
        var a, t = Math.round;
        return "undefined" == typeof e.getBoundingClientRect ? a2a.getPosOld(e) : {
            left: t((a = e.getBoundingClientRect()).left + a2a.getScrollDocDims("w")),
            top: t(a.top + a2a.getScrollDocDims("h"))
        }
    },
    getPosOld: function(e) {
        var a = 0,
            t = 0;
        do {
            a += e.offsetLeft || 0, t += e.offsetTop || 0, e = e.offsetParent
        } while (e);
        return {
            left: a,
            top: t
        }
    },
    getDocDims: function(e) {
        var a = 0,
            t = 0;
        return "number" == typeof window.innerWidth ? (a = window.innerWidth, t = window.innerHeight) : document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight) ? (a = document.documentElement.clientWidth, t = document.documentElement.clientHeight) : document.body && (document.body.clientWidth || document.body.clientHeight) && (a = document.body.clientWidth, t = document.body.clientHeight), "w" == e ? a : t
    },
    getScrollDocDims: function(e) {
        var a = 0,
            t = 0;
        return "number" == typeof window.pageYOffset ? (a = window.pageXOffset, t = window.pageYOffset) : document.body && (document.body.scrollLeft || document.body.scrollTop) ? (a = document.body.scrollLeft, t = document.body.scrollTop) : document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop) && (a = document.documentElement.scrollLeft, t = document.documentElement.scrollTop), "w" == e ? a : t
    },
    show_more_less: function(e) {
        var a = "a2a" + a2a.type;
        (0, a2a.gEl)(a + "_show_more_less");
        a2a.show_full(!0)
    },
    focus_find: function() {
        var e = a2a.gEl("a2a" + a2a.type + "_find");
        "none" != e.parentNode.style.display && e.focus()
    },
    default_services: function(e) {
        for (var a = e || a2a.type, t = a2a[a].main_services_col_1, n = t.length, o = 0; o < n; o++) t[o].style.display = ""
    },
    do_find: function() {
        var e, a = a2a.type,
            t = a2a[a].main_services,
            n = t.length,
            o = a2a.gEl("a2a" + a + "_find").value,
            i = a2a.in_array;
        if ("" !== o) {
            e = o.split(" ");
            for (var l = 0; l < n; l++) i(t[l].a2a.serviceNameLowerCase, e, !1) ? t[l].style.display = "" : t[l].style.display = "none"
        } else a2a.default_services()
    },
    selection: function(e) {
        var a, t, n = document.getElementsByTagName("meta"),
            o = n.length;
        if (window.getSelection) a = window.getSelection() + "";
        else if (document.selection) {
            try {
                a = document.selection.createRange()
            } catch (s) {
                a = ""
            }
            a = a.text ? a.text : ""
        }
        if (a && "" !== a) return a;
        if (a2a["n" + a2a.n].linkurl === location.href && -1 === ["facebook", "twitter", "linkedin", "google_plus"].indexOf(e))
            for (var i, l, r = 0; r < o; r++)
                if (i = (i = n[r].getAttribute("name")) ? i.toLowerCase() : "", l = (l = n[r].getAttribute("property")) ? l.toLowerCase() : "", i && "description" === i || l && "og:description" === l) {
                    t = n[r].getAttribute("content");
                    break
                }
        return t ? t.substring(0, 1200) : ""
    },
    collections: function(e) {
        var a = a2a.gEl,
            t = a2a[e],
            n = "a2a" + e;
        t.main_services_col_1 = a2a.getByClass("a2a_i", a(n + "_full_services"), "a"), t.main_services = t.main_services_col_1, t.email_services = a2a.getByClass("a2a_i", a(n + "_2_col1", "a")), t.all_services = t.main_services.concat(t.email_services)
    },
    cbs: function(e, a) {
        var t = a2a.c.callbacks || [],
            n = a2a.c.tracking_callback,
            o = {};
        n && (n[e] ? t.push(n) : n[0] == e ? (o[e] = n[1], t.push(o)) : "function" == typeof n && (o[e] = n, t.push(o)), a2a.c.tracking_callback = null);
        for (var i, l = 0, r = t.length; l < r; l++)
            if ("function" == typeof(i = t[l][e]) && (returned = i(a), "ready" == e && (i = null), "undefined" != typeof returned)) return returned
    },
    linker: function(e) {
        var a, t, n = location.href,
            o = document.title || n,
            i = a2a["n" + (e.parentNode.a2a_index || a2a.n)],
            l = i.type,
            r = e.a2a.safename,
            s = i.linkurl_implicit && n != i.linkurl ? n : i.linkurl,
            c = encodeURIComponent(s).replace(/'/g, "%27"),
            d = i.linkname_implicit && o != i.linkname ? o : i.linkname,
            u = encodeURIComponent(d).replace(/'/g, "%27"),
            p = i.linkmedia,
            m = !!p && encodeURIComponent(p).replace(/'/g, "%27"),
            _ = encodeURIComponent(a2a.selection(r)).replace(/'/g, "%27"),
            f = !i.track_links || "page" != l && "mail" != l ? "" : "&linktrack=" + i.track_links + "&linktrackkey=" + encodeURIComponent(i.track_links_key),
            g = e.a2a.customserviceuri || !1,
            h = e.a2a.stype,
            v = e.a2a.js_src,
            y = e.a2a.url,
            k = e.a2a.media,
            w = a2a.c.templates,
            b = w[r],
            x = "email";

        function A(e) {
            return encodeURIComponent(e).replace(/'/g, "%27").replace("%24%7Blink%7D", "${link}").replace("%24%7Blink_noenc%7D", "${link_noenc}").replace("%24%7Blink_nohttp%7D", "${link_nohttp}").replace("%24%7Btitle%7D", "${title}").replace("%24%7Bmedia%7D", "${media}")
        }
        if (k && m);
        else if (h && "js" == h && v) e.target = "", a = "javascript:" == v.substr(0, 11) ? v.replace("${link}", s) : 'javascript:a2a.loadExtScript("' + v + '")';
        else if (y && (r != x || r == x && a2a.has_touch) && !f) {
            if (e.target = "", "object" == typeof b)
                for (var C in b) y = a2a.urlParam(y, C, A(b[C]));
            else "string" == typeof b && (y = a2a.urlParam(y, "text", A(b)));
            a = y.replace("${link}", c).replace("${media}", m).replace("${link_noenc}", s).replace("${link_nohttp}", s.replace(/^https?:\/\//, "")).replace("${title}", u)
        } else g && "undefined" != g && (a = g.replace(/A2A_LINKNAME_ENC/, u).replace(/A2A_LINKURL_ENC/, c).replace(/A2A_LINKNOTE_ENC/, _));
        return e.href = a || "http" + a2a.c.http_s + "://www.addtoany.com/add_to/" + r + "?linkurl=" + c + "&linkname=" + u + (m ? "&linkmedia=" + m : "") + f + (t = "", b ? t = "&" + a2a.serialize({
            template: b
        }) : w[x] && h && h == x && (t = "&" + a2a.serialize({
            template: w[x]
        })), t) + ("feed" == l ? "&type=feed" : "") + "&linknote=" + _, !0
    },
    show_full: function(e) {
        var a = a2a.type,
            t = "a2a" + a,
            n = a2a.gEl,
            o = a2a.getByClass,
            i = n(t + "_find"),
            l = n(t + "_overlay"),
            r = n(t + "_full"),
            s = o("a2a_full_header", r)[0],
            c = n(t + "_full_services"),
            d = o("a2a_full_footer", r)[0];
        r.classList && a2a.getStyle(l, "transition-duration") && (r.classList.add("a2a_starting"), l.classList.add("a2a_starting")), r.style.display = l.style.display = "block", r.classList && setTimeout(function() {
            r.classList.remove("a2a_starting"), l.classList.remove("a2a_starting")
        }, 1), c.style.cssText = "height:calc(10px)", c.style.height.length && (c.style.height = "calc(100% - " + (s.offsetHeight + d.offsetHeight) + "px)"), r.focus(), a2a.show_full.key_listener = a2a.add_event(document, "keydown", function(e) {
            var t = (e = e || window.event).which || e.keyCode,
                n = document.activeElement;
            27 == t && i != n ? a2a.hide_full(a) : t > 40 && t < 91 && i != n && i.focus()
        }), e && a2a.stats("full")
    },
    hide_full: function(e) {
        var a = a2a.gEl,
            t = "a2a" + e,
            n = a(t + "_full"),
            o = a(t + "_overlay");

        function i() {
            o.style.display = n.style.display = a(t + "_modal").style.display = "none", "none" !== a2a.getStyle(a(t + "_dropdown"), "display") && a(t + "_show_more_less").focus(), a2a.show_full.key_listener.destroy(), setTimeout(function() {
                delete a2a.show_full.key_listener
            }, 1), o.addEventListener && o.removeEventListener("transitionend", i, !1)
        }
        n.classList && a2a.getStyle(o, "transition-duration") ? (o.addEventListener("transitionend", i, !1), n.classList.add("a2a_starting"), o.classList.add("a2a_starting")) : i()
    },
    show_menu: function(e, a) {
        e ? a2a.n = e.a2a_index : (a2a.n = a2a.total, a2a[a2a.type].no_hide = 1);
        var t, n, o, i, l, r, s, c, d, u, p = a2a["n" + a2a.n],
            m = a2a.type = p.type,
            _ = "a2a" + m,
            f = a2a.gEl(_ + "_dropdown"),
            g = a2a.has_touch,
            h = g ? "touchstart" : "click",
            v = !(!g || !a2a.evOpts()) && {
                passive: !0
            };
        a2a.gEl(_ + "_title").value = p.linkname, a2a.toggle_dropdown("block", m), t = [f.clientWidth, f.clientHeight], n = a2a.getDocDims("w"), o = a2a.getDocDims("h"), i = a2a.getScrollDocDims("w"), l = a2a.getScrollDocDims("h"), e ? ((r = e.getElementsByTagName("img")[0]) ? (s = a2a.getPos(r), c = r.clientWidth, d = r.clientHeight) : (s = a2a.getPos(e), c = e.offsetWidth, d = e.offsetHeight), s.left - i + t[0] + c > n && (s.left = s.left - t[0] + c - 8), ("up" == p.orientation || "down" != p.orientation && s.top - l + t[1] + d > o && s.top > t[1]) && (s.top = s.top - t[1] - d), f.style.left = (s.left < 0 ? 0 : s.left) + 2 + "px", f.style.top = s.top + d + "px") : (a || (a = {}), f.style.position = a.position || "absolute", f.style.left = a.left || n / 2 - t[0] / 2 + "px", f.style.top = a.top || o / 2 - t[1] / 2 + "px"), a2a[m].doc_click_close_mini || a2a[m].no_hide || (a2a[m].doc_click_close_mini = (u = m, function(e) {
            !a2a.ieo() && "number" == typeof e.button && e.button > 0 || (a2a[m].last_focus && a2a[m].last_focus.focus(), a2a.toggle_dropdown("none", u))
        }), a2a.show_menu["doc_click_listener_" + m] = a2a.add_event(document, h, a2a[m].doc_click_close_mini, v)), a2a.show_menu.key_listener = a2a.show_menu.key_listener || {}, a2a.show_menu.key_listener[m] = a2a.add_event(document, "keydown", function(e) {
            27 != ((e = e || window.event).which || e.keyCode) || a2a.show_full.key_listener || a2a.toggle_dropdown("none", m)
        }), a2a.svg.load();
        var y = encodeURIComponent,
            k = "event=menu_show&url=" + y(location.href) + "&title=" + y(document.title || "") + "&ev_menu_type=" + m;
        a2a.util_frame_post(m, k)
    },
    bmBrowser: function(e) {
        var a = a2a.c.localize.Bookmark,
            t = a2a["n" + a2a.n];
        if (document.all ? 1 == e ? a = a2a.c.localize.AddToYourFavorites : window.external.AddFavorite(t.linkurl, t.linkname) : 1 != e && (a2a.gEl("a2apage_note_BROWSER").innerHTML = '<div class="a2a_note_note">' + a2a.c.localize.BookmarkInstructions + "</div>"), 1 == e) return a
    },
    copyLink: function(e) {
        var a = "page",
            t = "a2a" + a,
            n = a2a.gEl,
            o = (a2a.getByClass, n(t + "_overlay")),
            i = n(t + "_full"),
            l = n(t + "_modal"),
            r = n("a2a_copy_link_copied"),
            s = n("a2a_copy_link_text");
        a2a.copyLink.full_shown = "none" != a2a.getStyle(i, "display"), a2a.copyLink.clickListen || (a2a.add_event(s, "click", function(e) {
            s.setSelectionRange ? s.setSelectionRange(0, s.value.length) : s.select(), document.execCommand && document.execCommand("copy") && (r.style.display = "block", setTimeout(function() {
                l.style.display = r.style.display = "none", a2a.copyLink.full_shown ? i.style.display = "block" : a2a.hide_full(a)
            }, 700))
        }), a2a.copyLink.clickListen = 1), a2a.type = a, "none" == a2a.getStyle(o, "display") && a2a.show_full(), i.style.display = "none", s.value = e, o.style.display = l.style.display = "block", l.focus(), a2a.stats("copy")
    },
    loadExtScript: function(e, a, t) {
        var n = document.createElement("script");
        if (n.charset = "UTF-8", n.src = e, document.body.appendChild(n), "function" == typeof a) var o = setInterval(function() {
            var e = !1;
            try {
                e = a.call()
            } catch (n) {}
            e && (clearInterval(o), t.call())
        }, 100)
    },
    stats: function(e) {
        if (a2a.stats.a2a = a2a.stats.a2a || {}, !a2a.stats.a2a[e]) {
            var a = "object" == typeof window.google_prev_clients ? "&as=1" : "",
                t = new XMLHttpRequest;
            t.open("POST", "https://stats.addtoany.com/menu"), t.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), t.timeout = 3e3, t.ontimeout = function(e) {
                t.abort()
            }, t.send("view=" + e + a), a2a.stats.a2a[e] = 1
        }
    },
    track: function(e) {
        var a = new Image(1, 1);
        a.src = e, a.width = 1, a.height = 1
    },
    GA: function(e) {
        var a = window,
            t = a2a.type,
            n = function() {
                if ("function" == typeof urchinTracker) a2a.GA.track = function(e, a, t, n, o) {
                    urchinTracker("/addtoany.com/" + n), urchinTracker("/addtoany.com/" + n + "/" + (t || a2a["n" + a2a.n].linkurl)), urchinTracker("/addtoany.com/services/" + a)
                };
                else if ("object" == typeof pageTracker && "object" == typeof _gat) a2a.GA.track = function(e, a, n, o, i) {
                    "feed" != t && (_gat._anonymizeIp(), _gat._forceSSL(), pageTracker._trackSocial("AddToAny", e, n || a2a["n" + a2a.n].linkurl))
                };
                else if ("object" == typeof _gaq) a2a.GA.track = function(e, a, n, o, i) {
                    "feed" != t && (_gaq.push(["_gat._anonymizeIp"]), _gaq.push(["_gat._forceSSL"]), _gaq.push(["_trackSocial", "AddToAny", e, n || a2a["n" + a2a.n].linkurl]))
                };
                else {
                    if ("string" != typeof GoogleAnalyticsObject) return;
                    a2a.GA.track = function(e, n, o, i, l) {
                        if ("feed" != t) {
                            var r = o || a2a["n" + a2a.n].linkurl;
                            a[GoogleAnalyticsObject]("send", "social", {
                                anonymizeIp: !0,
                                forceSSL: !0,
                                socialNetwork: "AddToAny",
                                socialAction: e,
                                socialTarget: r,
                                page: r
                            })
                        }
                    }
                }
            };
        a2a.GA.track = function() {}, e || /loaded|complete/.test(document.readyState) ? n() : a2a.onLoad(n)
    },
    add_services: function() {
        var e, a = a2a.type,
            t = a2a.gEl,
            n = parseInt(a2a[a].num_services),
            o = t("a2a" + a + "_full_services"),
            i = t("a2a" + a + "_mini_services");
        if (a2a[a].custom_services) {
            var l = (d = a2a[a].custom_services).length,
                r = a2a.make_service;
            d.reverse();
            for (var s, c = 0; c < l; c++) d[c] && (1, s = r(d[c][0], d[c][0].replace(/ /g, "_"), !1, null, {}, d[c][1], d[c][2]), o.insertBefore(s, o.firstChild), s = r(d[c][0], d[c][0].replace(/ /g, "_"), !1, null, {}, d[c][1], d[c][2]), i.insertBefore(s, i.firstChild))
        }
        if ("page" == a && a2a.c.add_services) {
            l = (d = a2a.c.add_services).length, r = a2a.make_service;
            var d, u = a2a.c.http_s;
            for (c = 0; c < l; c++) d[c] && (1, u && (d[c].icon = !1), s = r(d[c].name, d[c].safe_name, !1, null, {}, !1, d[c].icon), o.insertBefore(s, o.firstChild), s = r(d[c].name, d[c].safe_name, !1, null, {}, !1, d[c].icon), i.insertBefore(s, i.firstChild))
        }
        if ((e = a2a.getByClass("a2a_i", i, "a")).length > n) {
            c = 0;
            for (var p = e.length; c < p - n; c++) i.removeChild(i.lastChild)
        }
    },
    util_frame_make: function(e) {
        var a = document.createElement("iframe"),
            t = document.createElement("div"),
            n = encodeURIComponent,
            o = document.referrer ? n(document.referrer) : "",
            i = n(location.href),
            l = (n(document.title || ""), navigator.browserLanguage || navigator.language, a2a.c.no_3p ? "&no_3p=1" : "");
        a.id = "a2a" + e + "_sm_ifr", a.width = a.height = 1, a.style.width = a.style.height = t.style.width = t.style.height = "1px", a.style.top = a.style.left = a.frameborder = a.style.border = 0, a.style.position = t.style.position = "absolute", a.style.zIndex = t.style.zIndex = 1e5, a.title = "AddToAny Utility Frame", a.setAttribute("transparency", "true"), a.setAttribute("allowTransparency", "true"), a.setAttribute("frameBorder", "0"), a.src = "https://static.addtoany.com/menu/sm.19.html#type=" + e + "&event=load&url=" + i + "&referrer=" + o + l, t.style.top = "0", t.style.visibility = "hidden", a2a.gEl("a2a" + e + "_dropdown").parentNode.insertBefore(t, null), t.insertBefore(a, null)
    },
    util_frame_listen: function(e) {
        a2a.util_frame_make(e), window.postMessage && !a2a[e].message_event && (a2a.add_event(window, "message", function(e) {
            if (".addtoany.com" === e.origin.substr(-13)) {
                var a = "string" == typeof e.data ? e.data.split("=") : [""],
                    t = a[0].substr(4),
                    n = a[1],
                    o = t.substr(0, 4);
                if (a2a.c.http_s = "s", -1 === ["page", "feed", "mail"].indexOf(o)) return;
                t == o + "_services" && (n = "" != n && n.split(","), a2a.top_services(n, o, " a2a_sss"), a2a.collections(o), a2a.default_services(o)), a2a.gEl("a2a" + o + "_sm_ifr").style.display = "none"
            }
        }), a2a[e].message_event = 1)
    },
    util_frame_post: function(e, a) {
        window.postMessage && a2a.gEl("a2a" + e + "_sm_ifr").contentWindow.postMessage(a, "*")
    },
    urlParam: function(e, a, t) {
        var n, o, i = new RegExp("[?&]" + a.replace(/[.\\+*?\[\^\]$(){}=!<>|:\-]/g, "\\$&") + "=([^&#]*)", "i"),
            l = i.exec(e);
        null === l ? o = e + (n = /\?/.test(e) ? "&" : "?") + a + "=" + t : (n = l[0].charAt(0), o = e.replace(i, n + a + "=" + t));
        return o
    },
    fix_icons: function() {
        var e = a2a.ieo();
        if (e && e < 9) {
            var a = (a = a2a.getByClass("a2a_s_a2a", document))[0],
                t = a2a.fix_icons.tryNum || 0;
            if (a && !a.a2aFixed && !a.currentStyle.backgroundImage.split('"')[1] && t < 999) return a2a.fix_icons.tryNum = t + 1, setTimeout(a2a.fix_icons, 99);
            for (var n, o, i, l, r = 0, s = a2a.getByClass("a2a_svg", document), c = s.length; r < c; r++) o = (n = (l = s[r]).currentStyle).backgroundImage.split('"')[1], !l.a2aFixed && o && ((i = new Image).style.backgroundColor = n.backgroundColor, i.style.border = 0, i.style.height = n.height, i.style.width = n.width, i.src = o, l.style.background = "none", l.insertBefore(i, l.firstChild)), l.a2aFixed = 1
        } else fix_icons = function() {}
    },
    arrange_services: function() {
        var e = a2a.type,
            a = a2a.c.prioritize;
        a && a2a.top_services(a, e), a2a.add_services()
    },
    top_services: function(e, a, t) {
        var n = a || a2a.type,
            o = a2a.in_array,
            i = a2a.make_service,
            l = parseInt(a2a[n].num_services),
            r = a2a.gEl("a2a" + n + "_full_services"),
            s = a2a.gEl("a2a" + n + "_mini_services"),
            c = a2a.getByClass("a2a_i", r, "a"),
            d = a2a.getByClass("a2a_i", s, "a"),
            u = [];
        if (e) {
            var p = e.length - 1;
            for (t = t; p > -1; p--) {
                var m = o(e[p], c, !0, "a2a", "safename");
                m && (t && (m.className = m.className + t), r.insertBefore(m, r.firstChild), u.push(m))
            }
            if (u.length > 0) {
                var _, f, g;
                for (p = 0, t = t; p < u.length; p++) g = (_ = o(u[p].a2a.safename, d, !0, "a2a", "safename")) ? _ : i((f = u[p].a2a).servicename, f.safename, f.serviceIcon, f.serviceColor, {
                    src: f.js_src,
                    url: f.url,
                    type: f.serviceType,
                    pu: f.popup,
                    media: f.media
                }), t && (g.className = g.className + t), s.insertBefore(g, s.firstChild);
                if ((d = a2a.getByClass("a2a_i", s, "a")).length > l) {
                    p = 0;
                    for (var h = d.length; p < h - l; p++) s.removeChild(s.lastChild)
                }
            }
        }
    },
    css: function() {
        var e, a, t = a2a.type,
            n = a2a.c,
            o = n.css = document.createElement("style"),
            i = n.color_main || "EEE",
            l = n.color_bg || "FFF",
            r = n.color_border || "CCC",
            s = n.color_link_text || "0166FF",
            c = n.color_link_text_hover || "2A2A2A",
            d = (n.color_link_text_hover, n.color_link_text || "2A2A2A"),
            u = (i.toLowerCase(), n.color_link_text || "2A2A2A"),
            p = n.color_border || r,
            m = ".a2a_",
            _ = "{background-position:0 ",
            f = "px!important}",
            g = m + "i_",
            h = f + g,
            v = m + "menu",
            y = "border",
            k = "background-color:",
            w = "color:",
            b = "margin:",
            x = "padding:";
        e = v + "," + v + " *{-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box;float:none;" + b + "0;" + x + "0;position:static;height:auto;width:auto}" + v + "{" + y + "-radius:6px;display:none;direction:ltr;background:#" + l + ';font:16px sans-serif-light,HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Arial,Helvetica,"Liberation Sans",sans-serif;' + w + "#000;line-height:12px;" + y + ":1px solid #" + r + ";vertical-align:baseline;outline:0;overflow:hidden}" + m + "mini{min-width:200px;position:absolute;width:300px;z-index:9999997}" + m + "overlay{display:none;background:#" + r + ';_height:expression( ((e=document.documentElement.clientHeight)?e:document.body.clientHeight)+"px" );_width:expression( ((e=document.documentElement.clientWidth)?e:document.body.clientWidth)+"px" );filter:alpha(opacity=50);opacity:.7;position:fixed;_position:absolute;top:0;right:0;left:0;bottom:0;z-index:9999998;-webkit-tap-highlight-' + w + "rgba(0,0,0,0);transition:opacity .14s}" + m + "full{background:#" + l + ';height:auto;height:calc(320px);top:15%;_top:expression(40+((e=document.documentElement.scrollTop)?e:document.body.scrollTop)+"px");left:50%;margin-left:-320px;position:fixed;_position:absolute;text-align:center;width:640px;z-index:9999999;transition:transform .14s,opacity .14s}' + m + "full_footer," + m + "full_header," + m + "full_services{" + y + ":0;" + b + "0;" + x + "12px;box-sizing:" + y + "-box}" + m + "full_header{padding-bottom:8px}" + m + "full_services{height:280px;overflow-y:scroll;" + x + "0 12px;-webkit-overflow-scrolling:touch}" + m + "full_services " + m + "i{display:inline-block;float:none;width:181px;width:calc(33.334% - 18px)}div" + m + "full_footer{font-size:12px;text-align:center;" + x + "8px 14px}div" + m + "full_footer a,div" + m + "full_footer a:visited{display:inline;font-size:12px;line-height:14px;" + x + "8px 14px}div" + m + "full_footer a:focus,div" + m + "full_footer a:hover{background:0 0;" + y + ":0;" + w + "#" + s + "}div" + m + "full_footer a span" + m + "s_a2a,div" + m + "full_footer a span" + m + "w_a2a{background-size:14px;" + y + "-radius:3px;display:inline-block;height:14px;line-height:14px;" + b + "0 3px 0 0;vertical-align:top;*vertical-align:middle;width:14px}" + m + "modal{background:#" + l + ';font:24px sans-serif-light,HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Arial,Helvetica,"Liberation Sans",sans-serif;height:auto;top:50%;_top:expression(40+((e=document.documentElement.scrollTop)?e:document.body.scrollTop)+"px");left:50%;margin-left:-320px;margin-top:-36px;position:fixed;_position:absolute;text-align:center;width:640px;z-index:9999999;transition:transform .14s,opacity .14s;-webkit-tap-highlight-' + w + "rgba(0,0,0,0)}" + m + "copy_link_container{position:relative}span" + m + "s_link#a2a_copy_link_icon,span" + m + "w_link#a2a_copy_link_icon{background-size:48px;" + y + "-radius:0;display:inline-block;height:48px;left:0;line-height:48px;" + b + "0 3px 0 0;position:absolute;vertical-align:top;*vertical-align:middle;width:48px}#a2a" + t + "_modal input#a2a_copy_link_text{" + k + "transparent;_" + k + "#" + l + ";" + y + ":0;" + w + "#" + u + ";font:inherit;height:48px;left:62px;" + x + "0;position:relative;width:564px;width:calc(100% - 76px)}#a2a_copy_link_copied{" + k + "#0166ff;background:linear-gradient(90deg,#0166ff 80%,#9cbfff);" + w + "#fff;display:none;font:inherit;font-size:16px;" + x + "6px 8px}@media print{" + m + "floating_style," + v + "," + m + "overlay{visibility:hidden}}@keyframes a2aFadeIn{from{opacity:0}to{opacity:1}}" + m + "starting{opacity:0}" + m + "starting" + m + "full{transform:scale(.8)}@media (max-width:639px){" + m + "full{" + y + "-radius:0;top:15%;left:0;margin-left:auto;width:100%}" + m + "modal{left:0;margin-left:10px;width:calc(100% - 20px)}}@media (min-width:318px) and (max-width:437px){" + m + "full " + m + "full_services " + m + "i{width:calc(50% - 18px)}}@media (max-width:317px){" + m + "full " + m + "full_services " + m + "i{width:calc(100% - 18px)}}@media (max-height:436px){" + m + "full{bottom:40px;height:auto;top:40px}}" + v + " a{" + w + "#" + s + ';text-decoration:none;font:16px sans-serif-light,HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Arial,Helvetica,"Liberation Sans",sans-serif;line-height:14px;height:auto;width:auto;outline:0;-moz-outline:none}' + v + " a:visited{" + w + "#" + s + "}" + v + " a:active," + v + " a:focus," + v + " a:hover{" + w + "#" + c + ";" + y + "-" + w + "#" + i + ";" + y + "-style:solid;" + k + "#" + i + ";text-decoration:none}" + v + " span" + m + "s_find{background-size:24px;height:24px;left:8px;position:absolute;top:7px;width:24px}" + v + " span" + m + "s_find svg{" + k + "#" + l + "}" + v + " span" + m + "s_find svg path{fill:#" + p + "}#a2a_menu_container{display:inline-block}#a2a_menu_container{_display:inline}" + v + "_find_container{" + y + ":1px solid #" + p + ";" + y + "-radius:6px;" + x + "2px 24px 2px 0;position:relative;text-align:left}" + m + "cols_container " + m + "col1{overflow-x:hidden;overflow-y:auto;-webkit-overflow-scrolling:touch}#a2a" + t + "_modal input,#a2a" + t + "_modal input[type=text]," + v + " input," + v + " input[type=text]{display:block;background-image:none;box-shadow:none;line-height:100%;" + b + "0;outline:0;overflow:hidden;" + x + "0;-moz-box-shadow:none;-webkit-box-shadow:none;-webkit-appearance:none}#a2a" + t + "_find_container input,#a2a" + t + "_find_container input[type=text]{" + k + "transparent;_" + k + "#" + l + ";" + y + ":0;" + w + "#" + u + ";font:inherit;font-size:16px;height:28px;line-height:20px;left:38px;outline:0;" + b + "0;" + x + "2px 0;position:relative;width:99%}" + ("undefined" != typeof document.body.style.maxHeight ? m + "clear{clear:both}" : m + "clear{clear:both;height:0;width:0;line-height:0;font-size:0}") + " " + m + "svg{background-repeat:no-repeat;display:block;overflow:hidden;height:32px;line-height:32px;width:32px}" + m + "svg svg{background-repeat:no-repeat;background-position:50% 50%;" + y + ":none;display:block;left:0;" + b + "0 auto;overflow:hidden;" + x + "0;position:relative;top:0;width:auto;height:auto}a" + m + "i,i" + m + "i{display:block;float:left;" + y + ":1px solid #" + l + ";line-height:24px;" + x + "6px 8px;text-align:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:132px}a" + m + "i span,a" + m + "more span{display:inline-block;overflow:hidden;vertical-align:top;*vertical-align:middle}a" + m + "i " + m + "svg{" + b + "0 6px 0 0}a" + m + "i " + m + "svg,a" + m + "more " + m + "svg{background-size:24px;height:24px;line-height:24px;width:24px}a" + m + "sss:hover{" + y + "-left:1px solid #" + r + "}a" + v + "_show_more_less{" + y + "-bottom:1px solid #" + l + ";" + y + "-left:0;" + y + "-right:0;line-height:24px;" + b + "6px 0 0;" + x + "6px;-webkit-touch-callout:none}a" + v + "_show_more_less span{display:inline-block;height:24px;" + b + "0 6px 0 0}" + m + "kit " + m + "svg{background-repeat:repeat}" + m + "default_style a{float:left;line-height:16px;" + x + "0 2px}" + m + "default_style a:hover " + m + "svg," + m + "floating_style a:hover " + m + "svg," + m + "overlay_style a:hover " + m + "svg svg{opacity:.7}" + m + "overlay_style" + m + "default_style a:hover " + m + "svg{opacity:1}" + m + "default_style " + m + "count," + m + "default_style " + m + "svg," + m + "floating_style " + m + "svg," + v + " " + m + "svg," + m + "vertical_style " + m + "count," + m + "vertical_style " + m + "svg{" + y + "-radius:4px}" + m + "default_style " + m + "counter img," + m + "default_style " + m + "dd," + m + "default_style " + m + "svg{float:left}" + m + "default_style " + m + "img_text{margin-right:4px}" + m + "default_style " + m + "divider{" + y + "-left:1px solid #000;display:inline;float:left;height:16px;line-height:16px;" + b + "0 5px}" + m + "kit a{cursor:pointer}" + m + "floating_style{" + k + "#fff;" + y + "-radius:6px;position:fixed;z-index:9999995}" + m + "floating_style," + m + "overlay_style{animation:a2aFadeIn .2s ease-in;" + x + "4px}" + m + "vertical_style a{clear:left;display:block;overflow:hidden;" + x + "4px;text-decoration:none}" + m + "floating_style" + m + "default_style{bottom:0}" + m + "floating_style" + m + "default_style a," + m + "overlay_style" + m + "default_style a{" + x + "4px}" + m + "count{" + k + "#fff;" + y + ":1px solid #ccc;box-sizing:" + y + "-box;" + w + "#2a2a2a;display:block;float:left;font:12px Arial,Helvetica,sans-serif;height:16px;margin-left:4px;position:relative;text-align:center;width:50px}" + m + "count:after," + m + "count:before{" + y + ":solid transparent;" + y + '-width:4px 4px 4px 0;content:"";height:0;left:0;line-height:0;' + b + "-4px 0 0 -4px;position:absolute;top:50%;width:0}" + m + "count:before{" + y + "-right-" + w + "#ccc}" + m + "count:after{" + y + "-right-" + w + "#fff;margin-left:-3px}" + m + "count span{animation:a2aFadeIn .14s ease-in}" + m + "vertical_style " + m + "counter img{display:block}" + m + "vertical_style " + m + "count{float:none;margin-left:0;margin-top:6px}" + m + "vertical_style " + m + "count:after," + m + "vertical_style " + m + "count:before{" + y + ":solid transparent;" + y + '-width:0 4px 4px 4px;content:"";height:0;left:50%;line-height:0;' + b + "-4px 0 0 -4px;position:absolute;top:0;width:0}" + m + "vertical_style " + m + "count:before{" + y + "-bottom-" + w + "#ccc}" + m + "vertical_style " + m + "count:after{" + y + "-bottom-" + w + "#fff;margin-top:-3px}" + m + "nowrap{white-space:nowrap}" + m + "note{" + b + "0 auto;" + x + "9px;font-size:12px;text-align:center}" + m + "note " + m + "note_note{" + b + "0;" + w + "#" + d + "}" + m + "wide a{display:block;margin-top:3px;" + y + "-top:1px solid #" + i + ";text-align:center}" + m + "label{position:absolute!important;clip:rect(1px 1px 1px 1px);clip:rect(1px,1px,1px,1px);clip-path:polygon(0 0,0 0,0 0);-webkit-clip-path:polygon(0 0,0 0,0 0);overflow:hidden;height:1px;width:1px}" + m + "kit," + v + "," + m + "modal," + m + "overlay{-ms-touch-action:manipulation;touch-action:manipulation}" + m + "dd img{" + y + ":0}" + m + 'button_facebook_like iframe{max-width:none}iframe[id^=PIN_][id$="_nag"]{display:none!important}' + g + "a2a" + _ + "0!important}" + g + "a2a_sm" + _ + "-17" + h + "agregator" + _ + "-34" + h + "amazon" + _ + "-51" + h + "aol" + _ + "-68" + h + "app_net" + _ + "-85" + h + "baidu" + _ + "-102" + h + "balatarin" + _ + "-119" + h + "behance" + _ + "-136" + h + "bibsonomy" + _ + "-153" + h + "bitty" + _ + "-170" + h + "blinklist" + _ + "-187" + h + "blogger" + _ + "-204" + h + "blogmarks" + _ + "-221" + h + "bookmark" + _ + "-238" + h + "bookmarks_fr" + _ + "-255" + h + "box" + _ + "-272" + h + "buddymarks" + _ + "-289" + h + "buffer" + _ + "-306" + h + "care2" + _ + "-323" + h + "chrome" + _ + "-340" + h + "citeulike" + _ + "-357" + h + "dailyrotation" + _ + "-374" + h + "default" + _ + "-391" + h + "delicious" + _ + "-408" + h + "designfloat" + _ + "-425" + h + "diary_ru" + _ + "-442" + h + "diaspora" + _ + "-459" + h + "digg" + _ + "-476" + h + "dihitt" + _ + "-493" + h + "diigo" + _ + "-510" + h + "dzone" + _ + "-527" + h + "email" + _ + "-544" + h + "evernote" + _ + "-561" + h + "facebook" + _ + "-578" + h + "fark" + _ + "-595" + h + "feed" + _ + "-612" + h + "feedblitz" + _ + "-629" + h + "feedbucket" + _ + "-646" + h + "feedly" + _ + "-663" + h + "feedmailer" + _ + "-680" + h + "find" + _ + "-697" + h + "firefox" + _ + "-714" + h + "flickr" + _ + "-731" + h + "flipboard" + _ + "-748" + h + "folkd" + _ + "-765" + h + "foursquare" + _ + "-782" + h + "github" + _ + "-799" + h + "gmail" + _ + "-816" + h + "google" + _ + "-833" + h + "google_classroom" + _ + "-850" + h + "google_plus" + _ + "-867" + h + "hatena" + _ + "-884" + h + "instapaper" + _ + "-901" + h + "itunes" + _ + "-918" + h + "jamespot" + _ + "-935" + h + "kakao" + _ + "-952" + h + "kik" + _ + "-969" + h + "kindle" + _ + "-986" + h + "klipfolio" + _ + "-1003" + h + "known" + _ + "-1020" + h + "line" + _ + "-1037" + h + "link" + _ + "-1054" + h + "linkedin" + _ + "-1071" + h + "livejournal" + _ + "-1088" + h + "mail_ru" + _ + "-1105" + h + "mendeley" + _ + "-1122" + h + "meneame" + _ + "-1139" + h + "miro" + _ + "-1156" + h + "mixi" + _ + "-1173" + h + "myspace" + _ + "-1190" + h + "netlog" + _ + "-1207" + h + "netvibes" + _ + "-1224" + h + "netvouz" + _ + "-1241" + h + "newsalloy" + _ + "-1258" + h + "newsisfree" + _ + "-1275" + h + "newsvine" + _ + "-1292" + h + "nujij" + _ + "-1309" + h + "odnoklassniki" + _ + "-1326" + h + "oknotizie" + _ + "-1343" + h + "oldreader" + _ + "-1360" + h + "outlook_com" + _ + "-1377" + h + "pinboard" + _ + "-1394" + h + "pinterest" + _ + "-1411" + h + "plurk" + _ + "-1428" + h + "pocket" + _ + "-1445" + h + "podnova" + _ + "-1462" + h + "print" + _ + "-1479" + h + "printfriendly" + _ + "-1496" + h + "protopage" + _ + "-1513" + h + "pusha" + _ + "-1530" + h + "qzone" + _ + "-1547" + h + "reddit" + _ + "-1564" + h + "rediff" + _ + "-1581" + h + "renren" + _ + "-1598" + h + "segnalo" + _ + "-1615" + h + "share" + _ + "-1632" + h + "sina_weibo" + _ + "-1649" + h + "sitejot" + _ + "-1666" + h + "skype" + _ + "-1683" + h + "slashdot" + _ + "-1700" + h + "sms" + _ + "-1717" + h + "snapchat" + _ + "-1734" + h + "stumbleupon" + _ + "-1751" + h + "stumpedia" + _ + "-1768" + h + "svejo" + _ + "-1785" + h + "symbaloo" + _ + "-1802" + h + "telegram" + _ + "-1819" + h + "thefreedictionary" + _ + "-1836" + h + "thefreelibrary" + _ + "-1853" + h + "tumblr" + _ + "-1870" + h + "twiddla" + _ + "-1887" + h + "twitter" + _ + "-1904" + h + "typepad" + _, e += "-1921" + h + "viadeo" + _ + "-1938" + h + "viber" + _ + "-1955" + h + "vimeo" + _ + "-1972" + h + "vk" + _ + "-1989" + h + "wanelo" + _ + "-2006" + h + "webnews" + _ + "-2023" + h + "wechat" + _ + "-2040" + h + "whatsapp" + _ + "-2057" + h + "winksite" + _ + "-2074" + h + "wordpress" + _ + "-2091" + h + "wykop" + _ + "-2108" + h + "xing" + _ + "-2125" + h + "y18" + _ + "-2142" + h + "yahoo" + _ + "-2159" + h + "yim" + _ + "-2176" + h + "yoolink" + _ + "-2193" + h + "youmob" + _ + "-2210" + h + "youtube" + _ + "-2227" + h + "yummly" + _ + "-2244" + f, o.setAttribute("type", "text/css"), a2a.head_tag.appendChild(o), o.styleSheet ? o.styleSheet.cssText = e : (a = document.createTextNode(e), o.appendChild(a))
    },
    svg_css: function() {
        a2a.init("page");
        var e = a2a.c.css.sheet || a2a.c.css.styleSheet || {},
            a = "insertRule" in e,
            t = "addRule" in e;
        all_services = a2a.services.concat([
            [0, 0, "a2a", "0166FF"]
        ]);
        for (var n, o, i = 0, l = all_services.length; i < l; i++) n = ".a2a_s_" + all_services[i][2], o = "background-color:#" + all_services[i][3] + ";", a ? e.insertRule(n + "{" + o + "}", 0) : t && e.addRule(n, o, 0);
        a2a.svg.load(!0), a2a.svg_css = function() {}
    },
    svg: {
        icons: {},
        queue: [],
        tagO: '<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">',
        tagC: "</svg>",
        fill: function(e, a) {
            return e.replace(/#FFF/gi, a)
        },
        get: function(e, a, t) {
            var n = a2a.svg,
                o = n.fill;
            return icons = n.icons, svg_tag_open = n.tagO, svg_tag_close = n.tagC, svg_src = icons[e], svg_src_default = icons.a2a, svg_src ? (svg_src = t ? o(svg_src, t) : svg_src, svg_tag_open + svg_src + svg_tag_close) : svg_src_default ? (svg_src_default = t ? o(svg_src_default, t) : svg_src_default, svg_tag_open + svg_src_default + svg_tag_close) : (a2a.svg.queue.push({
                name: e,
                node: a,
                color: t
            }), "pending")
        },
        set: function(e) {
            var a = a2a.svg,
                t = a.queue;
            if (icons = a.icons = e, svg_tag_open = a.tagO, svg_tag_close = a.tagC, icons.a2a)
                for (var n, o, i, l = 0, r = t.length; l < r; l++) o = (n = t[l]).name, color = n.color, i = icons[o] ? icons[o] : icons.a2a, i = color ? a.fill(i, color) : i, n.node.innerHTML = svg_tag_open + i + svg_tag_close
        },
        load: function(e) {
            var a = a2a.svg.works(),
                t = new window.Image;
            t.onerror = function() {
                a2a.svg.loadCSS(!1)
            }, t.onload = function() {
                var n, o = 1 === t.width && 1 === t.height;
                a && !e ? a2a.svg.loadJS(document) : a2a.svg.loadCSS(o), a2a.svg.load = (n = o, function(e) {
                    e && a2a.svg.loadCSS(n)
                })
            }, a2a.svg.load = function() {}, t.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
        },
        loadCSS: function(e) {
            var a = a2a.static_addtoany,
                t = a2a.c.static_server,
                n = a2a.fix_icons,
                o = a2a.svg.works(),
                i = window.document.createElement("link"),
                l = e && o && t != a ? t + "/" : a + "/svg/";
            i.rel = "stylesheet", i.href = l + ["icons.26.svg.css", "icons.26.png.css", "icons.26.old.css"][e && o ? 0 : e ? 1 : 2], a2a.head_tag.appendChild(i), n(), a2a.svg.loadCSS = n
        },
        loadJS: function() {
            var e = document,
                a = a2a.c.static_server,
                t = e.createElement("script"),
                n = e.getElementsByTagName("script")[0],
                o = a != a2a.static_addtoany ? a + "/" : a + "/svg/";
            t.async = !0, t.src = o + "icons.26.svg.js", n.parentNode.insertBefore(t, n), a2a.svg.loadJS = function() {}
        },
        works: function() {
            var e = document,
                a = !(!e.createElementNS || !e.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect || !e.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image", "1.1") || window.opera && -1 === navigator.userAgent.indexOf("Chrome"));
            return a2a.svg.works = function() {
                return a
            }, a
        }
    },
    make_service: function(e, a, t, n, o, i, l) {
        var r, s, c = document.createElement("a"),
            d = a2a.c,
            u = function() {
                a2a.linker(this)
            },
            p = a2a.type,
            m = (o = o || {}, "a2a_svg a2a_s__default"),
            _ = d.icon_color,
            f = _ ? _.split(",", 2) : _,
            g = f ? f[0] : f,
            h = f ? f[1] : f;
        return c.rel = "nofollow noopener", c.className = "a2a_i", c.href = "/#" + a, c.target = "_blank", c.a2a = {}, c.a2a.safename = a, c.a2a.servicename = e, c.a2a.serviceNameLowerCase = e.toLowerCase(), c.a2a.serviceIcon = t, c.a2a.serviceColor = n, c.a2a.serviceType = o.type, c.innerHTML = "<span></span>" + e + " ", r = c.firstChild, o.type && (c.a2a.stype = o.type), o.src && (c.a2a.js_src = o.src), o.url && (c.a2a.url = o.url), o.pu && (c.a2a.popup = 1), o.media && (c.a2a.media = 1), i && (c.a2a.customserviceuri = i), l ? (r.style.backgroundImage = "url(" + l + ")", r.className = m) : _ && a2a.svg.works() ? (r.className = m + " a2a_s_" + t, g && "unset" != g ? r.style.backgroundColor = g : n && (r.style.backgroundColor = "#" + n), h && (h = h.trim())) : t ? (r.className = m + " a2a_s_" + t, n && (r.style.backgroundColor = "#" + n)) : r.className = m, l || "pending" !== (s = a2a.svg.get(t, r, h)) && (r.innerHTML = s), a2a.add_event(c, "mousedown", u), a2a.add_event(c, "keydown", u), a2a.add_event(c, "click", function(a) {
            var t = a2a["n" + a2a.n],
                n = {
                    node: c,
                    service: e,
                    title: t.linkname,
                    url: t.linkurl,
                    media: t.linkmedia
                },
                o = a2a.cbs("share", n);
            void 0 !== o && (o.url && (t.linkurl = o.url, t.linkurl_implicit = !1), o.title && (t.linkname = o.title, t.linkname_implicit = !1), o.media && (t.linkmedia = o.media), a2a.linker(c), o.stop && a2a.preventDefault(a))
        }), a2a.add_event(c, "click", function(t) {
            var n = encodeURIComponent,
                o = a2a["n" + a2a.n],
                i = "page" == p ? "pages" : "subscriptions",
                l = "page" == p ? "AddToAny Share/Save Button" : "AddToAny Subscribe Button",
                r = screen.height,
                s = "event=service_click&url=" + n(location.href) + "&title=" + n(document.title || "") + "&ev_service=" + n(a) + "&ev_service_type=menu&ev_menu_type=" + p + "&ev_url=" + n(o.linkurl) + "&ev_title=" + n(o.linkname).replace(/'/g, "%27");
            c.a2a.popup && !a2a.defaultPrevented(t) && "javascript:" != c.href.substr(0, 11) && (a2a.preventDefault(t), window.open(c.href, "_blank", "toolbar=0,personalbar=0,resizable,scrollbars,status,width=550,height=450,top=" + (r > 450 ? Math.round(r / 2 - 225) : 40) + ",left=" + Math.round(screen.width / 2 - 275))), a2a.util_frame_post(p, s), a2a.GA.track(e, a, o.linkurl, i, l)
        }), c
    },
    i18n: function() {
        if (a2a.c.static_server != a2a.static_addtoany) return !1;
        var e = ["ar", "id", "ms", "bn", "bs", "bg", "ca", "ca-AD", "ca-ES", "cs", "cy", "da", "de", "dv", "el", "et", "es", "es-AR", "es-VE", "eo", "en-US", "eu", "fa", "fr", "fr-CA", "gd", "he", "hi", "hr", "is", "it", "ja", "ko", "ku", "lv", "lt", "li", "hu", "mk", "nl", "no", "pl", "pt", "pt-BR", "pt-PT", "ro", "ru", "sr", "fi", "sk", "sl", "sv", "ta", "te", "tr", "uk", "vi", "zh-CN", "zh-TW"],
            a = a2a.c.locale || (navigator.browserLanguage || navigator.language).toLowerCase(),
            t = a2a.in_array(a, e, !0);
        if (!t) {
            var n = a.indexOf("-"); - 1 != n && (t = a2a.in_array(a.substr(0, n), e, !0))
        }
        return !("en-us" == a || !t) && t
    }
};
a2a.c = a2a_config, a2a.make_once = function(e) {
    if (a2a.type = a2a.c.menu_type || e, !a2a[a2a.type] && !window["a2a" + a2a.type + "_init"]) {
        a2a[a2a.type] = {}, window.a2a_show_dropdown = a2a.show_menu, window.a2a_miniLeaveDelay = a2a.miniLeaveDelay, window.a2a_init = a2a.init, a2a["create_" + a2a.type + "_dropdown"] = function(e, a) {
            var t, n, o, i = a2a.gEl,
                l = a2a.type = e,
                r = "a2a" + l,
                s = a2a.c,
                c = a2a.ieo(),
                d = a2a.has_menter,
                u = document.createElement("i"),
                p = document.createDocumentFragment(),
                m = document.createDocumentFragment(),
                _ = (document.createElement("a"), s.icon_color),
                f = _ ? _.split(",", 2) : _,
                g = f ? f[0] : f,
                h = f ? f[1] : f,
                v = "a2a_svg a2a_s__default a2a_s_",
                y = h || "#FFF",
                k = ' style="background-color:' + (g && "unset" != g ? g : "#0166ff") + '"',
                w = '<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g fill="' + y + '"><path d="M14 7h4v18h-4z"/><path d="M7 14h18v4H7z"/></g></svg>',
                b = s.localize;
            a2a.css(), b = s.localize = {
                Share: b.Share || "Share",
                Save: b.Save || "Save",
                Subscribe: b.Subscribe || "Subscribe",
                Email: b.Email || "Email",
                Bookmark: b.Bookmark || "Bookmark",
                ShowAll: b.ShowAll || "Show all",
                ShowLess: b.ShowLess || "Show less",
                FindAnyServiceToAddTo: b.FindAnyServiceToAddTo || "Find any service",
                PoweredBy: b.PoweredBy || "By",
                AnyEmail: "Any email",
                ShareViaEmail: b.ShareViaEmail || "Share via email",
                SubscribeViaEmail: b.SubscribeViaEmail || "Subscribe via email",
                BookmarkInYourBrowser: b.BookmarkInYourBrowser || "Bookmark in your browser",
                BookmarkInstructions: b.BookmarkInstructions || "Press Ctrl+D or &#8984;+D to bookmark this page",
                AddToYourFavorites: b.AddToYourFavorites || "Add to Favorites",
                SendFromWebOrProgram: b.SendFromWebOrProgram || "Send from any other email service",
                EmailProgram: b.EmailProgram || "Email application",
                More: b.More || "More&#8230;"
            };
            var x = '<div class="a2a_overlay" id="a2a' + l + '_overlay"></div>';
            x += '<div id="a2a' + l + '_modal" class="a2a_menu a2a_modal" role="dialog" tabindex="-1" aria-label="Copy link" style="display:none">', "page" == l && (x += '<div class="a2a_copy_link_container"><span id="a2a_copy_link_icon" class="a2a_svg a2a_s_link"' + k + ' onclick="a2a.gEl(\'a2a_copy_link_text\').click()"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="' + y + '" d="M24.4 21.18c0-.36-.1-.67-.36-.92l-2.8-2.8a1.24 1.24 0 0 0-.92-.38c-.38 0-.7.14-.97.43.02.04.1.12.25.26l.3.3.2.24c.08.12.14.24.17.35.03.1.05.23.05.37 0 .36-.13.66-.38.92a1.25 1.25 0 0 1-.92.37 1.4 1.4 0 0 1-.37-.03 1.06 1.06 0 0 1-.35-.18 2.27 2.27 0 0 1-.25-.2 6.82 6.82 0 0 1-.3-.3l-.24-.25c-.3.28-.44.6-.44.98 0 .36.13.66.38.92l2.78 2.8c.24.23.54.35.9.35.37 0 .68-.12.93-.35l1.98-1.97c.26-.25.38-.55.38-.9zm-9.46-9.5c0-.37-.13-.67-.38-.92l-2.78-2.8a1.24 1.24 0 0 0-.9-.37c-.36 0-.67.1-.93.35L7.97 9.92c-.26.25-.38.55-.38.9 0 .36.1.67.37.92l2.8 2.8c.24.25.55.37.92.37.36 0 .7-.13.96-.4-.03-.04-.1-.12-.26-.26s-.24-.23-.3-.3a2.67 2.67 0 0 1-.2-.24 1.05 1.05 0 0 1-.17-.35 1.4 1.4 0 0 1-.04-.37c0-.36.1-.66.36-.9.26-.26.56-.4.92-.4.14 0 .26.03.37.06.12.03.23.1.35.17.1.1.2.16.25.2l.3.3.24.26c.3-.28.44-.6.44-.98zM27 21.17c0 1.07-.38 2-1.15 2.73l-1.98 1.98c-.74.75-1.66 1.12-2.73 1.12-1.1 0-2-.38-2.75-1.14l-2.8-2.8c-.74-.74-1.1-1.65-1.1-2.73 0-1.1.38-2.04 1.17-2.82l-1.18-1.17c-.8.8-1.72 1.18-2.82 1.18-1.08 0-2-.36-2.75-1.12l-2.8-2.8C5.38 12.8 5 11.9 5 10.82c0-1.08.38-2 1.15-2.74L8.13 6.1C8.87 5.37 9.78 5 10.86 5c1.1 0 2 .38 2.75 1.15l2.8 2.8c.74.73 1.1 1.65 1.1 2.72 0 1.1-.38 2.05-1.17 2.82l1.18 1.18c.8-.8 1.72-1.2 2.82-1.2 1.08 0 2 .4 2.75 1.14l2.8 2.8c.76.76 1.13 1.68 1.13 2.76z"/></svg></span><input id="a2a_copy_link_text" type="text" title="Copy link"/><div id="a2a_copy_link_copied">&check;</div></div>'), x += "</div>", x += '<div class="a2a_menu a2a_full" id="a2a' + l + '_full" role="dialog" tabindex="-1" aria-label="' + ("feed" == l ? b.Subscribe : b.Share) + '"><div class="a2a_full_header"><div id="a2a' + l + '_find_container" class="a2a_menu_find_container"><input id="a2a' + l + '_find" class="a2a_menu_find" type="text" onclick="a2a.focus_find()" onkeyup="a2a.do_find()" autocomplete="off" title="' + b.FindAnyServiceToAddTo + '"/><span id="a2a' + l + '_find_icon" class="a2a_svg a2a_s_find" onclick="a2a.focus_find()"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#CCC" d="M19.7 18.2l-4.5-4.5c.7-1.1 1.2-2.3 1.2-3.6 0-3.5-2.8-6.3-6.3-6.3s-6.3 2.8-6.3 6.3 2.8 6.3 6.3 6.3c1.4 0 2.6-.4 3.6-1.2l4.5 4.5c.6.6 1.3.7 1.7.2.5-.4.4-1.1-.2-1.7zm-9.6-3.6c-2.5 0-4.5-2.1-4.5-4.5 0-2.5 2.1-4.5 4.5-4.5 2.5 0 4.5 2.1 4.5 4.5s-2 4.5-4.5 4.5z"/></svg></span></div></div><div class="a2a_full_services" id="a2a' + l + '_full_services" role="presentation"></div><div class="a2a_full_footer"><a href="https://www.addtoany.com" title="Share Buttons" rel="noopener" target="_blank"><span class="' + v + 'a2a"' + k + ">" + w + '</span>AddToAny</a></div></div><div id="a2a' + l + '_dropdown" class="a2a_menu a2a_mini"' + (d ? ' onmouseenter="a2a.miniEnterStay()"' : "") + (!a2a[l].onclick && d ? ' onmouseleave="a2a.miniLeaveDelay()"' : "") + ' tabindex="-1" aria-label="' + ("feed" == l ? b.Subscribe : b.Share) + '" style="display:none"><div id="a2a' + l + '_title_container" class="a2a_menu_title_container" style="display:none"><div id="a2a' + l + '_title" class="a2a_menu_title"></div></div><div class="a2a_mini_services" id="a2a' + l + '_mini_services"></div>', x += '<div id="a2a' + l + '_cols_container" class="a2a_cols_container"><div class="a2a_col1" id="a2a' + l + '_col1"' + ("mail" == l ? ' style="display:none"' : "") + '></div><div id="a2a' + l + '_2_col1"' + ("mail" != l ? ' style="display:none"' : "") + '></div><div class="a2a_clear"></div></div>', "mail" != l && (x += '<div class="a2a' + l + '_wide a2a_wide"><a href="" id="a2a' + l + '_show_more_less" class="a2a_menu_show_more_less a2a_more" title="' + b.ShowAll + '"><span class="' + v + 'a2a"' + k + ">" + w + "</span>" + b.More + "</a></div>"), x += "</div>";
            var A = "a2a_menu_container",
                C = i(A) || document.createElement("div");
            a2a.add_event(C, "click", a2a.stopPropagation), a2a.add_event(C, "touchstart", a2a.stopPropagation, !!a2a.evOpts() && {
                passive: !0
            }), C.innerHTML = x, C.id != A && (C.style.position = "static", c && c < 9 ? document.body.insertBefore(C, document.body.firstChild) : document.body.insertBefore(C, null));
            var E = a2a.make_service;
            if ("mail" != l) {
                for (var B = 0, S = a.most, F = S.length, N = parseInt(a2a[l].num_services), T = 0, L = a2a[l].exclude_services; B < F; B++) {
                    var D = S[B];
                    L && a2a.in_array(D[1], L, !0) || p.appendChild(E(D[0], D[1], D[2], D[3], D[4])), !(T < N) || L && a2a.in_array(D[1], L, !0) || (m.appendChild(E(D[0], D[1], D[2], D[3], D[4])), T++)
                }
                i(r + "_full_services").appendChild(p), i(r + "_mini_services").appendChild(m)
            }
            t = i(r + "_full_services"), u.className = "a2a_i", n = u.cloneNode(), t.appendChild(u), t.appendChild(n);
            B = 0;
            for (var z = a.email, I = z.length; B < I; B++) {
                D = z[B];
                L && a2a.in_array(D[1], L, !0) || i(r + "_2_col1").appendChild(E(D[0], D[1], D[2], D[3], D[4]))
            }
            if ("feed" != l) {
                var j = E("Email app", "email_app", "email", null, null, "mailto:?subject=A2A_LINKNAME_ENC&body=A2A_LINKURL_ENC");
                j.className = "a2a_i a2a_emailer a2a_email_client", j.id = "a2a" + l + "_email_client", j.target = "", i(r + "_2_col1").appendChild(j)
            }
            a2a[l].services = a.most.concat(a.email), "mail" != l && (a2a.add_event(i(r + "_overlay"), "click", function(e) {
                a2a.hide_full(l)
            }), a2a.add_event(i(r + "_show_more_less"), "click", function(e) {
                a2a.preventDefault(e), a2a.show_more_less()
            })), a2a.arrange_services(), a2a.util_frame_listen(l), a2a.collections(l), a2a.default_services(), "mail" != l && ((o = i(r + "_find")).onkeydown = function(e) {
                var a = (e = e || window.event).which || e.keyCode,
                    t = a2a.type;
                if (13 == a) {
                    for (var n, i = 0, l = a2a[t].main_services, r = l.length; i < r; i++)
                        if ("none" != (n = l[i]).style.display) return n.focus(), !1
                } else 27 == a && ("" == o.value && o.blur(), o.value = "", a2a.do_find())
            })
        };
        var a = {
            page: {
                most: [
                    ["Facebook", "facebook", "facebook", "3B5998", {
                        media: 1,
                        pu: 1
                    }],
                    ["Twitter", "twitter", "twitter", "55ACEE", {
                        pu: 1
                    }],
                    ["Google+", "google_plus", "google_plus", "DD4B39", {
                        pu: 1
                    }],
                    ["Pinterest", "pinterest", "pinterest", "BD081C", {
                        type: "js",
                        src: "https://static.addtoany.com/menu/pinmarklet.js",
                        media: 1,
                        pu: 1
                    }],
                    ["Email", "email", "email", "0166FF", {
                        url: "mailto:?subject=${title}&body=${link}"
                    }],
                    ["LinkedIn", "linkedin", "linkedin", "007BB5", {
                        pu: 1
                    }],
                    ["Reddit", "reddit", "reddit", "ff4500"],
                    ["Tumblr", "tumblr", "tumblr", "35465C", {
                        pu: 1
                    }],
                    ["WordPress", "wordpress", "wordpress", "464646"],
                    ["Google Gmail", "google_gmail", "gmail", "DD5347", {
                        type: "email",
                        pu: 1
                    }],
                    ["WhatsApp", "whatsapp", "whatsapp", "12AF0A"],
                    ["StumbleUpon", "stumbleupon", "stumbleupon", "EF4E23"],
                    ["Amazon Wish List", "amazon_wish_list", "amazon", "F90"],
                    ["AOL Mail", "aol_mail", "aol", "2A2A2A", {
                        type: "email",
                        pu: 1
                    }],
                    ["Balatarin", "balatarin", "balatarin", "079948"],
                    ["BibSonomy", "bibsonomy", "bibsonomy", "2A2A2A"],
                    ["Bitty Browser", "bitty_browser", "bitty", "999"],
                    ["Blinklist", "blinklist", "blinklist", "3D3C3B"],
                    ["Blogger", "blogger", "blogger", "FDA352"],
                    ["BlogMarks", "blogmarks", "blogmarks", "535353"],
                    ["Bookmarks.fr", "bookmarks_fr", "bookmarks_fr", "96C044"],
                    ["Box.net", "box_net", "box", "1A74B0"],
                    ["Buffer", "buffer", "buffer", "2A2A2A"],
                    ["Care2 News", "care2_news", "care2", "6EB43F"],
                    ["CiteULike", "citeulike", "citeulike", "2781CD"],
                    ["Copy Link", "copy_link", "link", "0166FF", {
                        type: "js",
                        src: "javascript:a2a.copyLink('${link}')"
                    }],
                    ["Delicious", "delicious", "delicious", "39F"],
                    ["Design Float", "design_float", "designfloat", "8AC8FF"],
                    ["Diary.Ru", "diary_ru", "diary_ru", "912D31"],
                    ["Diaspora", "diaspora", "diaspora", "2E3436"],
                    ["Digg", "digg", "digg", "2A2A2A"],
                    ["Diigo", "diigo", "diigo", "4A8BCA"],
                    ["Douban", "douban", "douban", "071", {
                        pu: 1
                    }],
                    ["Draugiem", "draugiem", "draugiem", "F60", {
                        pu: 1
                    }],
                    ["DZone", "dzone", "dzone", "82C251"],
                    ["Evernote", "evernote", "evernote", "8BE056"],
                    ["Facebook Messenger", "facebook_messenger", "facebook_messenger", "0084FF", {
                        pu: 1
                    }],
                    ["Fark", "fark", "fark", "555"],
                    ["Flipboard", "flipboard", "flipboard", "C00", {
                        pu: 1
                    }],
                    ["Folkd", "folkd", "folkd", "0F70B2"],
                    ["Google Bookmarks", "google_bookmarks", "google", "4285F4"],
                    ["Google Classroom", "google_classroom", "google_classroom", "FFC112"],
                    ["Hacker News", "hacker_news", "y18", "F60"],
                    ["Hatena", "hatena", "hatena", "00A6DB"],
                    ["Houzz", "houzz", "houzz", "7AC143", {
                        type: "js",
                        src: "https://www.houzz.com/js/clipperBookmarklet.js",
                        media: 1
                    }],
                    ["Instapaper", "instapaper", "instapaper", "2A2A2A"],
                    ["Kakao", "kakao", "kakao", "FCB700", {
                        pu: 1
                    }],
                    ["Kik", "kik", "kik", "2A2A2A"],
                    ["Kindle It", "kindle_it", "kindle", "2A2A2A"],
                    ["Known", "known", "known", "2A2A2A"],
                    ["Line", "line", "line", "00C300"],
                    ["LiveJournal", "livejournal", "livejournal", "113140"],
                    ["Mail.Ru", "mail_ru", "mail_ru", "356FAC"],
                    ["Mendeley", "mendeley", "mendeley", "A70805"],
                    ["Meneame", "meneame", "meneame", "FF7D12"],
                    ["Mixi", "mixi", "mixi", "D1AD5A"],
                    ["MySpace", "myspace", "myspace", "2A2A2A"],
                    ["Netvouz", "netvouz", "netvouz", "6C3"],
                    ["Odnoklassniki", "odnoklassniki", "odnoklassniki", "F2720C"],
                    ["Oknotizie", "oknotizie", "oknotizie", "88D32D"],
                    ["Outlook.com", "outlook_com", "outlook_com", "0072C6", {
                        type: "email"
                    }],
                    ["Papaly", "papaly", "papaly", "3AC0F6", {
                        pu: 1
                    }],
                    ["Pinboard", "pinboard", "pinboard", "1341DE", {
                        pu: 1
                    }],
                    ["Plurk", "plurk", "plurk", "CF682F"],
                    ["Pocket", "pocket", "pocket", "EE4056"],
                    ["Polyvore", "polyvore", "polyvore", "2A2A2A", {
                        type: "js",
                        src: "https://static.addtoany.com/menu/polyvore.js",
                        media: 1,
                        pu: 1
                    }],
                    ["Print", "print", "print", "0166FF", {
                        type: "js",
                        src: "javascript:print()"
                    }],
                    ["PrintFriendly", "printfriendly", "printfriendly", "6D9F00"],
                    ["Protopage Bookmarks", "protopage_bookmarks", "protopage", "413FFF"],
                    ["Pusha", "pusha", "pusha", "0072B8"],
                    ["Qzone", "qzone", "qzone", "2B82D9"],
                    ["Rediff MyPage", "rediff", "rediff", "D20000"],
                    ["Refind", "refind", "refind", "1492ef"],
                    ["Renren", "renren", "renren", "005EAC", {
                        pu: 1
                    }],
                    ["Sina Weibo", "sina_weibo", "sina_weibo", "E6162D"],
                    ["SiteJot", "sitejot", "sitejot", "FFC808"],
                    ["Skype", "skype", "skype", "00AFF0"],
                    ["Slashdot", "slashdot", "slashdot", "004242"],
                    ["SMS", "sms", "sms", "6CBE45", {
                        url: "sms:?&body=${title}%20${link}"
                    }],
                    ["StockTwits", "stocktwits", "stocktwits", "40576F", {
                        pu: 1
                    }],
                    ["Svejo", "svejo", "svejo", "5BD428"],
                    ["Symbaloo Feeds", "symbaloo_feeds", "symbaloo", "6DA8F7"],
                    ["Telegram", "telegram", "telegram", "2CA5E0"],
                    ["Threema", "threema", "threema", "2A2A2A", {
                        url: "threema://compose?text=${title}%20${link}"
                    }],
                    ["Trello", "trello", "trello", "0079BF", {
                        pu: 1
                    }],
                    ["Tuenti", "tuenti", "tuenti", "0075C9"],
                    ["Twiddla", "twiddla", "twiddla", "2A2A2A"],
                    ["TypePad Post", "typepad_post", "typepad", "D2DE61"],
                    ["Viadeo", "viadeo", "viadeo", "2A2A2A", {
                        pu: 1
                    }],
                    ["Viber", "viber", "viber", "7C529E", {
                        url: "viber://forward?text=${title}%20${link}"
                    }],
                    ["VK", "vk", "vk", "587EA3", {
                        pu: 1
                    }],
                    ["Wanelo", "wanelo", "wanelo", "9cb092"],
                    ["WeChat", "wechat", "wechat", "7BB32E"],
                    ["Wykop", "wykop", "wykop", "367DA9"],
                    ["XING", "xing", "xing", "165B66", {
                        pu: 1
                    }],
                    ["Yahoo Bookmarks", "yahoo_bookmarks", "yahoo", "400090"],
                    ["Yahoo Mail", "yahoo_mail", "yahoo", "400090", {
                        type: "email"
                    }],
                    ["Yahoo Messenger", "yahoo_messenger", "yim", "400090", {
                        url: "ymsgr:sendim?+&m=${link}"
                    }],
                    ["Yoolink", "yoolink", "yoolink", "A2C538"],
                    ["Yummly", "yummly", "yummly", "E16120", {
                        type: "js",
                        src: "https://www.yummly.com/js/yumlet.js",
                        media: 1,
                        pu: 1
                    }]
                ],
                email: [
                    ["Google Gmail", "google_gmail", "gmail", "DD5347", {
                        type: "email",
                        pu: 1
                    }],
                    ["AOL Mail", "aol_mail", "aol", "2A2A2A", {
                        type: "email",
                        pu: 1
                    }],
                    ["Outlook.com", "outlook_com", "outlook_com", "0072C6", {
                        type: "email"
                    }],
                    ["Yahoo Mail", "yahoo_mail", "yahoo", "400090", {
                        type: "email"
                    }]
                ]
            },
            feed: {
                most: [
                    ["Feed", "feed", "feed", "E3702D", {
                        url: "${link_noenc}"
                    }],
                    ["Feedly", "feedly", "feedly", "2BB24C"],
                    ["My Yahoo", "my_yahoo", "yahoo", "400090"],
                    ["FeedBlitz", "feedblitz", "feedblitz", "FF8B23", {
                        type: "email"
                    }],
                    ["AOL Reader", "my_aol", "aol", "2A2A2A"],
                    ["The Old Reader", "oldreader", "oldreader", "D73F31"],
                    ["Agregator", "agregator", "agregator", "359440"],
                    ["Bitty Browser Preview", "bitty_browser_preview", "bitty", "999"],
                    ["Daily Rotation", "daily_rotation", "dailyrotation", "2A2A2A"],
                    ["Feed Mailer", "feed_mailer", "feedmailer", "78A8D1"],
                    ["FeedBucket", "feedbucket", "feedbucket", "E3702D"],
                    ["iTunes", "itunes", "itunes", "FB233A", {
                        url: "itpc://${link_nohttp}"
                    }],
                    ["Miro", "miro", "miro", "D41700"],
                    ["Netvibes", "netvibes", "netvibes", "7CA900"],
                    ["NewsAlloy", "newsalloy", "newsalloy", "8E2B3D"],
                    ["NewsIsFree", "newsisfree", "newsisfree", "316CA9"],
                    ["Outlook", "outlook", "outlook_com", "0072C6", {
                        url: "feed://${link_nohttp}"
                    }],
                    ["PodNova", "podnova", "podnova", "B50419"],
                    ["Protopage News Feeds", "protopage_news_feeds", "protopage", "413FFF"],
                    ["Symbaloo Bookmarks", "symbaloo_bookmarks", "symbaloo", "6DA8F7"],
                    ["The Free Dictionary", "the_free_dictionary", "thefreedictionary", "004B85"],
                    ["The Free Library", "the_free_library", "thefreelibrary", "004B85"],
                    ["WINKsite", "winksite", "winksite", "6FE738"]
                ],
                email: [
                    ["FeedBlitz", "feedblitz", "feedblitz", "FF8B23", {
                        type: "email"
                    }]
                ]
            }
        };
        a2a.services = a.page.most.concat(a.feed.most);
        var t = a2a.type,
            n = a2a[t],
            o = "feed" == t ? "feed" : "page",
            i = a2a.c;
        location.host.split(".").slice(-1);
        n.onclick = i.onclick || !1, n.show_title = i.show_title || !1, n.num_services = i.num_services || 8, n.exclude_services = i.exclude_services || !1, n.custom_services = i.custom_services || !1, a2a.locale = a2a.i18n(), a2a.locale && "custom" != a2a.locale ? (a2a.loadExtScript(i.static_server + "/locale/" + a2a.locale + ".js", function() {
            return "" != a2a_localize
        }, function() {
            for (i.localize = a2a_localize, a2a["create_" + a2a.type + "_dropdown"](t, a[o]); a2a.fn_queue.length > 0;) a2a.fn_queue.shift()();
            a2a.locale = null, a2a.GA(1), a2a.init_show(), a2a.ready()
        }), i.menu_type = !1) : (a2a["create_" + a2a.type + "_dropdown"](t, a[o]), a2a.GA())
    }
}, document.body && (a2a.overlays(), a2a.init_all("page"), a2a.ready()), a2a.dom.ready(function() {
    a2a.overlays(), a2a.init_all("page"), a2a.ready()
});
/**
 * @name MarkerClusterer for Google Maps v3
 * @version version 1.0.1
 * @author Luke Mahe
 * @fileoverview
 * The library creates and manages per-zoom-level clusters for large amounts of
 * markers.
 * <br/>
 * This is a v3 implementation of the
 * <a href="http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/"
 * >v2 MarkerClusterer</a>.
 */

/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * A Marker Clusterer that clusters markers.
 *
 * @param {google.maps.Map} map The Google map to attach to.
 * @param {Array.<google.maps.Marker>=} opt_markers Optional markers to add to
 *   the cluster.
 * @param {Object=} opt_options support the following options:
 *     'gridSize': (number) The grid size of a cluster in pixels.
 *     'maxZoom': (number) The maximum zoom level that a marker can be part of a
 *                cluster.
 *     'zoomOnClick': (boolean) Whether the default behaviour of clicking on a
 *                    cluster is to zoom into it.
 *     'averageCenter': (boolean) Whether the center of each cluster should be
 *                      the average of all markers in the cluster.
 *     'minimumClusterSize': (number) The minimum number of markers to be in a
 *                           cluster before the markers are hidden and a count
 *                           is shown.
 *     'styles': (object) An object that has style properties:
 *       'url': (string) The image url.
 *       'height': (number) The image height.
 *       'width': (number) The image width.
 *       'anchor': (Array) The anchor position of the label text.
 *       'textColor': (string) The text color.
 *       'textSize': (number) The text size.
 *       'backgroundPosition': (string) The position of the backgound x, y.
 * @constructor
 * @extends google.maps.OverlayView
 */
function MarkerClusterer(map, opt_markers, opt_options) {
  // MarkerClusterer implements google.maps.OverlayView interface. We use the
  // extend function to extend MarkerClusterer with google.maps.OverlayView
  // because it might not always be available when the code is defined so we
  // look for it at the last possible moment. If it doesn't exist now then
  // there is no point going ahead :)
  this.extend(MarkerClusterer, google.maps.OverlayView);
  this.map_ = map;

  /**
   * @type {Array.<google.maps.Marker>}
   * @private
   */
  this.markers_ = [];

  /**
   *  @type {Array.<Cluster>}
   */
  this.clusters_ = [];

  this.sizes = [53, 56, 66, 78, 90];

  /**
   * @private
   */
  this.styles_ = [];

  /**
   * @type {boolean}
   * @private
   */
  this.ready_ = false;

  var options = opt_options || {};

  /**
   * @type {number}
   * @private
   */
  this.gridSize_ = options['gridSize'] || 60;

  /**
   * @private
   */
  this.minClusterSize_ = options['minimumClusterSize'] || 2;


  /**
   * @type {?number}
   * @private
   */
  this.maxZoom_ = options['maxZoom'] || null;

  this.styles_ = options['styles'] || [];

  /**
   * @type {string}
   * @private
   */
  this.imagePath_ = options['imagePath'] ||
      this.MARKER_CLUSTER_IMAGE_PATH_;

  /**
   * @type {string}
   * @private
   */
  this.imageExtension_ = options['imageExtension'] ||
      this.MARKER_CLUSTER_IMAGE_EXTENSION_;

  /**
   * @type {boolean}
   * @private
   */
  this.zoomOnClick_ = true;

  if (options['zoomOnClick'] != undefined) {
    this.zoomOnClick_ = options['zoomOnClick'];
  }

  /**
   * @type {boolean}
   * @private
   */
  this.averageCenter_ = false;

  if (options['averageCenter'] != undefined) {
    this.averageCenter_ = options['averageCenter'];
  }

  this.setupStyles_();

  this.setMap(map);

  /**
   * @type {number}
   * @private
   */
  this.prevZoom_ = this.map_.getZoom();

  // Add the map event listeners
  var that = this;
  google.maps.event.addListener(this.map_, 'zoom_changed', function() {
    // Determines map type and prevent illegal zoom levels
    var zoom = that.map_.getZoom();
    var minZoom = that.map_.minZoom || 0;
    var maxZoom = Math.min(that.map_.maxZoom || 100,
                         that.map_.mapTypes[that.map_.getMapTypeId()].maxZoom);
    zoom = Math.min(Math.max(zoom,minZoom),maxZoom);

    if (that.prevZoom_ != zoom) {
      that.prevZoom_ = zoom;
      that.resetViewport();
    }
  });

  google.maps.event.addListener(this.map_, 'idle', function() {
    that.redraw();
  });

  // Finally, add the markers
  if (opt_markers && (opt_markers.length || Object.keys(opt_markers).length)) {
    this.addMarkers(opt_markers, false);
  }
}


/**
 * The marker cluster image path.
 *
 * @type {string}
 * @private
 */
MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_ = '../images/m';


/**
 * The marker cluster image path.
 *
 * @type {string}
 * @private
 */
MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_ = 'png';


/**
 * Extends a objects prototype by anothers.
 *
 * @param {Object} obj1 The object to be extended.
 * @param {Object} obj2 The object to extend with.
 * @return {Object} The new extended object.
 * @ignore
 */
MarkerClusterer.prototype.extend = function(obj1, obj2) {
  return (function(object) {
    for (var property in object.prototype) {
      this.prototype[property] = object.prototype[property];
    }
    return this;
  }).apply(obj1, [obj2]);
};


/**
 * Implementaion of the interface method.
 * @ignore
 */
MarkerClusterer.prototype.onAdd = function() {
  this.setReady_(true);
};

/**
 * Implementaion of the interface method.
 * @ignore
 */
MarkerClusterer.prototype.draw = function() {};

/**
 * Sets up the styles object.
 *
 * @private
 */
MarkerClusterer.prototype.setupStyles_ = function() {
  if (this.styles_.length) {
    return;
  }

  for (var i = 0, size; size = this.sizes[i]; i++) {
    this.styles_.push({
      url: this.imagePath_ + (i + 1) + '.' + this.imageExtension_,
      height: size,
      width: size
    });
  }
};

/**
 *  Fit the map to the bounds of the markers in the clusterer.
 */
MarkerClusterer.prototype.fitMapToMarkers = function() {
  var markers = this.getMarkers();
  var bounds = new google.maps.LatLngBounds();
  for (var i = 0, marker; marker = markers[i]; i++) {
    bounds.extend(marker.getPosition());
  }

  this.map_.fitBounds(bounds);
};


/**
 *  Sets the styles.
 *
 *  @param {Object} styles The style to set.
 */
MarkerClusterer.prototype.setStyles = function(styles) {
  this.styles_ = styles;
};


/**
 *  Gets the styles.
 *
 *  @return {Object} The styles object.
 */
MarkerClusterer.prototype.getStyles = function() {
  return this.styles_;
};


/**
 * Whether zoom on click is set.
 *
 * @return {boolean} True if zoomOnClick_ is set.
 */
MarkerClusterer.prototype.isZoomOnClick = function() {
  return this.zoomOnClick_;
};

/**
 * Whether average center is set.
 *
 * @return {boolean} True if averageCenter_ is set.
 */
MarkerClusterer.prototype.isAverageCenter = function() {
  return this.averageCenter_;
};


/**
 *  Returns the array of markers in the clusterer.
 *
 *  @return {Array.<google.maps.Marker>} The markers.
 */
MarkerClusterer.prototype.getMarkers = function() {
  return this.markers_;
};


/**
 *  Returns the number of markers in the clusterer
 *
 *  @return {Number} The number of markers.
 */
MarkerClusterer.prototype.getTotalMarkers = function() {
  return this.markers_.length;
};


/**
 *  Sets the max zoom for the clusterer.
 *
 *  @param {number} maxZoom The max zoom level.
 */
MarkerClusterer.prototype.setMaxZoom = function(maxZoom) {
  this.maxZoom_ = maxZoom;
};


/**
 *  Gets the max zoom for the clusterer.
 *
 *  @return {number} The max zoom level.
 */
MarkerClusterer.prototype.getMaxZoom = function() {
  return this.maxZoom_;
};


/**
 *  The function for calculating the cluster icon image.
 *
 *  @param {Array.<google.maps.Marker>} markers The markers in the clusterer.
 *  @param {number} numStyles The number of styles available.
 *  @return {Object} A object properties: 'text' (string) and 'index' (number).
 *  @private
 */
MarkerClusterer.prototype.calculator_ = function(markers, numStyles) {
  var index = 0;
  var count = markers.length;
  var dv = count;
  while (dv !== 0) {
    dv = parseInt(dv / 10, 10);
    index++;
  }

  index = Math.min(index, numStyles);
  return {
    text: count,
    index: index
  };
};


/**
 * Set the calculator function.
 *
 * @param {function(Array, number)} calculator The function to set as the
 *     calculator. The function should return a object properties:
 *     'text' (string) and 'index' (number).
 *
 */
MarkerClusterer.prototype.setCalculator = function(calculator) {
  this.calculator_ = calculator;
};


/**
 * Get the calculator function.
 *
 * @return {function(Array, number)} the calculator function.
 */
MarkerClusterer.prototype.getCalculator = function() {
  return this.calculator_;
};


/**
 * Add an array of markers to the clusterer.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to add.
 * @param {boolean=} opt_nodraw Whether to redraw the clusters.
 */
MarkerClusterer.prototype.addMarkers = function(markers, opt_nodraw) {
  if (markers.length) {
    for (var i = 0, marker; marker = markers[i]; i++) {
      this.pushMarkerTo_(marker);
    }
  } else if (Object.keys(markers).length) {
    for (var marker in markers) {
      this.pushMarkerTo_(markers[marker]);
    }
  }
  if (!opt_nodraw) {
    this.redraw();
  }
};


/**
 * Pushes a marker to the clusterer.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @private
 */
MarkerClusterer.prototype.pushMarkerTo_ = function(marker) {
  marker.isAdded = false;
  if (marker['draggable']) {
    // If the marker is draggable add a listener so we update the clusters on
    // the drag end.
    var that = this;
    google.maps.event.addListener(marker, 'dragend', function() {
      marker.isAdded = false;
      that.repaint();
    });
  }
  this.markers_.push(marker);
};


/**
 * Adds a marker to the clusterer and redraws if needed.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @param {boolean=} opt_nodraw Whether to redraw the clusters.
 */
MarkerClusterer.prototype.addMarker = function(marker, opt_nodraw) {
  this.pushMarkerTo_(marker);
  if (!opt_nodraw) {
    this.redraw();
  }
};


/**
 * Removes a marker and returns true if removed, false if not
 *
 * @param {google.maps.Marker} marker The marker to remove
 * @return {boolean} Whether the marker was removed or not
 * @private
 */
MarkerClusterer.prototype.removeMarker_ = function(marker) {
  var index = -1;
  if (this.markers_.indexOf) {
    index = this.markers_.indexOf(marker);
  } else {
    for (var i = 0, m; m = this.markers_[i]; i++) {
      if (m == marker) {
        index = i;
        break;
      }
    }
  }

  if (index == -1) {
    // Marker is not in our list of markers.
    return false;
  }

  marker.setMap(null);

  this.markers_.splice(index, 1);

  return true;
};


/**
 * Remove a marker from the cluster.
 *
 * @param {google.maps.Marker} marker The marker to remove.
 * @param {boolean=} opt_nodraw Optional boolean to force no redraw.
 * @return {boolean} True if the marker was removed.
 */
MarkerClusterer.prototype.removeMarker = function(marker, opt_nodraw) {
  var removed = this.removeMarker_(marker);

  if (!opt_nodraw && removed) {
    this.resetViewport();
    this.redraw();
    return true;
  } else {
   return false;
  }
};


/**
 * Removes an array of markers from the cluster.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to remove.
 * @param {boolean=} opt_nodraw Optional boolean to force no redraw.
 */
MarkerClusterer.prototype.removeMarkers = function(markers, opt_nodraw) {
  var removed = false;

  for (var i = 0, marker; marker = markers[i]; i++) {
    var r = this.removeMarker_(marker);
    removed = removed || r;
  }

  if (!opt_nodraw && removed) {
    this.resetViewport();
    this.redraw();
    return true;
  }
};


/**
 * Sets the clusterer's ready state.
 *
 * @param {boolean} ready The state.
 * @private
 */
MarkerClusterer.prototype.setReady_ = function(ready) {
  if (!this.ready_) {
    this.ready_ = ready;
    this.createClusters_();
  }
};


/**
 * Returns the number of clusters in the clusterer.
 *
 * @return {number} The number of clusters.
 */
MarkerClusterer.prototype.getTotalClusters = function() {
  return this.clusters_.length;
};


/**
 * Returns the google map that the clusterer is associated with.
 *
 * @return {google.maps.Map} The map.
 */
MarkerClusterer.prototype.getMap = function() {
  return this.map_;
};


/**
 * Sets the google map that the clusterer is associated with.
 *
 * @param {google.maps.Map} map The map.
 */
MarkerClusterer.prototype.setMap = function(map) {
  this.map_ = map;
};


/**
 * Returns the size of the grid.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getGridSize = function() {
  return this.gridSize_;
};


/**
 * Sets the size of the grid.
 *
 * @param {number} size The grid size.
 */
MarkerClusterer.prototype.setGridSize = function(size) {
  this.gridSize_ = size;
};


/**
 * Returns the min cluster size.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getMinClusterSize = function() {
  return this.minClusterSize_;
};

/**
 * Sets the min cluster size.
 *
 * @param {number} size The grid size.
 */
MarkerClusterer.prototype.setMinClusterSize = function(size) {
  this.minClusterSize_ = size;
};


/**
 * Extends a bounds object by the grid size.
 *
 * @param {google.maps.LatLngBounds} bounds The bounds to extend.
 * @return {google.maps.LatLngBounds} The extended bounds.
 */
MarkerClusterer.prototype.getExtendedBounds = function(bounds) {
  var projection = this.getProjection();

  // Turn the bounds into latlng.
  var tr = new google.maps.LatLng(bounds.getNorthEast().lat(),
      bounds.getNorthEast().lng());
  var bl = new google.maps.LatLng(bounds.getSouthWest().lat(),
      bounds.getSouthWest().lng());

  // Convert the points to pixels and the extend out by the grid size.
  var trPix = projection.fromLatLngToDivPixel(tr);
  trPix.x += this.gridSize_;
  trPix.y -= this.gridSize_;

  var blPix = projection.fromLatLngToDivPixel(bl);
  blPix.x -= this.gridSize_;
  blPix.y += this.gridSize_;

  // Convert the pixel points back to LatLng
  var ne = projection.fromDivPixelToLatLng(trPix);
  var sw = projection.fromDivPixelToLatLng(blPix);

  // Extend the bounds to contain the new bounds.
  bounds.extend(ne);
  bounds.extend(sw);

  return bounds;
};


/**
 * Determins if a marker is contained in a bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @param {google.maps.LatLngBounds} bounds The bounds to check against.
 * @return {boolean} True if the marker is in the bounds.
 * @private
 */
MarkerClusterer.prototype.isMarkerInBounds_ = function(marker, bounds) {
  return bounds.contains(marker.getPosition());
};


/**
 * Clears all clusters and markers from the clusterer.
 */
MarkerClusterer.prototype.clearMarkers = function() {
  this.resetViewport(true);

  // Set the markers a empty array.
  this.markers_ = [];
};


/**
 * Clears all existing clusters and recreates them.
 * @param {boolean} opt_hide To also hide the marker.
 */
MarkerClusterer.prototype.resetViewport = function(opt_hide) {
  // Remove all the clusters
  for (var i = 0, cluster; cluster = this.clusters_[i]; i++) {
    cluster.remove();
  }

  // Reset the markers to not be added and to be invisible.
  for (var i = 0, marker; marker = this.markers_[i]; i++) {
    marker.isAdded = false;
    if (opt_hide) {
      marker.setMap(null);
    }
  }

  this.clusters_ = [];
};

/**
 *
 */
MarkerClusterer.prototype.repaint = function() {
  var oldClusters = this.clusters_.slice();
  this.clusters_.length = 0;
  this.resetViewport();
  this.redraw();

  // Remove the old clusters.
  // Do it in a timeout so the other clusters have been drawn first.
  window.setTimeout(function() {
    for (var i = 0, cluster; cluster = oldClusters[i]; i++) {
      cluster.remove();
    }
  }, 0);
};


/**
 * Redraws the clusters.
 */
MarkerClusterer.prototype.redraw = function() {
  this.createClusters_();
};


/**
 * Calculates the distance between two latlng locations in km.
 * @see http://www.movable-type.co.uk/scripts/latlong.html
 *
 * @param {google.maps.LatLng} p1 The first lat lng point.
 * @param {google.maps.LatLng} p2 The second lat lng point.
 * @return {number} The distance between the two points in km.
 * @private
*/
MarkerClusterer.prototype.distanceBetweenPoints_ = function(p1, p2) {
  if (!p1 || !p2) {
    return 0;
  }

  var R = 6371; // Radius of the Earth in km
  var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
  var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d;
};


/**
 * Add a marker to a cluster, or creates a new cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @private
 */
MarkerClusterer.prototype.addToClosestCluster_ = function(marker) {
  var distance = 40000; // Some large number
  var clusterToAddTo = null;
  var pos = marker.getPosition();
  for (var i = 0, cluster; cluster = this.clusters_[i]; i++) {
    var center = cluster.getCenter();
    if (center) {
      var d = this.distanceBetweenPoints_(center, marker.getPosition());
      if (d < distance) {
        distance = d;
        clusterToAddTo = cluster;
      }
    }
  }

  if (clusterToAddTo && clusterToAddTo.isMarkerInClusterBounds(marker)) {
    clusterToAddTo.addMarker(marker);
  } else {
    var cluster = new Cluster(this);
    cluster.addMarker(marker);
    this.clusters_.push(cluster);
  }
};


/**
 * Creates the clusters.
 *
 * @private
 */
MarkerClusterer.prototype.createClusters_ = function() {
  if (!this.ready_) {
    return;
  }

  // Get our current map view bounds.
  // Create a new bounds object so we don't affect the map.
  var mapBounds = new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(),
      this.map_.getBounds().getNorthEast());
  var bounds = this.getExtendedBounds(mapBounds);

  for (var i = 0, marker; marker = this.markers_[i]; i++) {
    if (!marker.isAdded && this.isMarkerInBounds_(marker, bounds)) {
      this.addToClosestCluster_(marker);
    }
  }
};


/**
 * A cluster that contains markers.
 *
 * @param {MarkerClusterer} markerClusterer The markerclusterer that this
 *     cluster is associated with.
 * @constructor
 * @ignore
 */
function Cluster(markerClusterer) {
  this.markerClusterer_ = markerClusterer;
  this.map_ = markerClusterer.getMap();
  this.gridSize_ = markerClusterer.getGridSize();
  this.minClusterSize_ = markerClusterer.getMinClusterSize();
  this.averageCenter_ = markerClusterer.isAverageCenter();
  this.center_ = null;
  this.markers_ = [];
  this.bounds_ = null;
  this.clusterIcon_ = new ClusterIcon(this, markerClusterer.getStyles(),
      markerClusterer.getGridSize());
}

/**
 * Determins if a marker is already added to the cluster.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker is already added.
 */
Cluster.prototype.isMarkerAlreadyAdded = function(marker) {
  if (this.markers_.indexOf) {
    return this.markers_.indexOf(marker) != -1;
  } else {
    for (var i = 0, m; m = this.markers_[i]; i++) {
      if (m == marker) {
        return true;
      }
    }
  }
  return false;
};


/**
 * Add a marker the cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @return {boolean} True if the marker was added.
 */
Cluster.prototype.addMarker = function(marker) {
  if (this.isMarkerAlreadyAdded(marker)) {
    return false;
  }

  if (!this.center_) {
    this.center_ = marker.getPosition();
    this.calculateBounds_();
  } else {
    if (this.averageCenter_) {
      var l = this.markers_.length + 1;
      var lat = (this.center_.lat() * (l-1) + marker.getPosition().lat()) / l;
      var lng = (this.center_.lng() * (l-1) + marker.getPosition().lng()) / l;
      this.center_ = new google.maps.LatLng(lat, lng);
      this.calculateBounds_();
    }
  }

  marker.isAdded = true;
  this.markers_.push(marker);

  var len = this.markers_.length;
  if (len < this.minClusterSize_ && marker.getMap() != this.map_) {
    // Min cluster size not reached so show the marker.
    marker.setMap(this.map_);
  }

  if (len == this.minClusterSize_) {
    // Hide the markers that were showing.
    for (var i = 0; i < len; i++) {
      this.markers_[i].setMap(null);
    }
  }

  if (len >= this.minClusterSize_) {
    marker.setMap(null);
  }

  this.updateIcon();
  return true;
};


/**
 * Returns the marker clusterer that the cluster is associated with.
 *
 * @return {MarkerClusterer} The associated marker clusterer.
 */
Cluster.prototype.getMarkerClusterer = function() {
  return this.markerClusterer_;
};


/**
 * Returns the bounds of the cluster.
 *
 * @return {google.maps.LatLngBounds} the cluster bounds.
 */
Cluster.prototype.getBounds = function() {
  var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
  var markers = this.getMarkers();
  for (var i = 0, marker; marker = markers[i]; i++) {
    bounds.extend(marker.getPosition());
  }
  return bounds;
};


/**
 * Removes the cluster
 */
Cluster.prototype.remove = function() {
  this.clusterIcon_.remove();
  this.markers_.length = 0;
  delete this.markers_;
};


/**
 * Returns the center of the cluster.
 *
 * @return {number} The cluster center.
 */
Cluster.prototype.getSize = function() {
  return this.markers_.length;
};


/**
 * Returns the center of the cluster.
 *
 * @return {Array.<google.maps.Marker>} The cluster center.
 */
Cluster.prototype.getMarkers = function() {
  return this.markers_;
};


/**
 * Returns the center of the cluster.
 *
 * @return {google.maps.LatLng} The cluster center.
 */
Cluster.prototype.getCenter = function() {
  return this.center_;
};


/**
 * Calculated the extended bounds of the cluster with the grid.
 *
 * @private
 */
Cluster.prototype.calculateBounds_ = function() {
  var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
  this.bounds_ = this.markerClusterer_.getExtendedBounds(bounds);
};


/**
 * Determines if a marker lies in the clusters bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker lies in the bounds.
 */
Cluster.prototype.isMarkerInClusterBounds = function(marker) {
  return this.bounds_.contains(marker.getPosition());
};


/**
 * Returns the map that the cluster is associated with.
 *
 * @return {google.maps.Map} The map.
 */
Cluster.prototype.getMap = function() {
  return this.map_;
};


/**
 * Updates the cluster icon
 */
Cluster.prototype.updateIcon = function() {
  var zoom = this.map_.getZoom();
  var mz = this.markerClusterer_.getMaxZoom();

  if (mz && zoom > mz) {
    // The zoom is greater than our max zoom so show all the markers in cluster.
    for (var i = 0, marker; marker = this.markers_[i]; i++) {
      marker.setMap(this.map_);
    }
    return;
  }

  if (this.markers_.length < this.minClusterSize_) {
    // Min cluster size not yet reached.
    this.clusterIcon_.hide();
    return;
  }

  var numStyles = this.markerClusterer_.getStyles().length;
  var sums = this.markerClusterer_.getCalculator()(this.markers_, numStyles);
  this.clusterIcon_.setCenter(this.center_);
  this.clusterIcon_.setSums(sums);
  this.clusterIcon_.show();
};


/**
 * A cluster icon
 *
 * @param {Cluster} cluster The cluster to be associated with.
 * @param {Object} styles An object that has style properties:
 *     'url': (string) The image url.
 *     'height': (number) The image height.
 *     'width': (number) The image width.
 *     'anchor': (Array) The anchor position of the label text.
 *     'textColor': (string) The text color.
 *     'textSize': (number) The text size.
 *     'backgroundPosition: (string) The background postition x, y.
 * @param {number=} opt_padding Optional padding to apply to the cluster icon.
 * @constructor
 * @extends google.maps.OverlayView
 * @ignore
 */
function ClusterIcon(cluster, styles, opt_padding) {
  cluster.getMarkerClusterer().extend(ClusterIcon, google.maps.OverlayView);

  this.styles_ = styles;
  this.padding_ = opt_padding || 0;
  this.cluster_ = cluster;
  this.center_ = null;
  this.map_ = cluster.getMap();
  this.div_ = null;
  this.sums_ = null;
  this.visible_ = false;

  this.setMap(this.map_);
}


/**
 * Triggers the clusterclick event and zoom's if the option is set.
 */
ClusterIcon.prototype.triggerClusterClick = function() {
  var markerClusterer = this.cluster_.getMarkerClusterer();

  // Trigger the clusterclick event.
  google.maps.event.trigger(markerClusterer, 'clusterclick', this.cluster_);

  if (markerClusterer.isZoomOnClick()) {
    // Zoom into the cluster.
    this.map_.fitBounds(this.cluster_.getBounds());
  }
};


/**
 * Adding the cluster icon to the dom.
 * @ignore
 */
ClusterIcon.prototype.onAdd = function() {
  this.div_ = document.createElement('DIV');
  if (this.visible_) {
    var pos = this.getPosFromLatLng_(this.center_);
    this.div_.style.cssText = this.createCss(pos);
    this.div_.innerHTML = this.sums_.text;
  }

  var panes = this.getPanes();
  panes.overlayMouseTarget.appendChild(this.div_);

  var that = this;
  google.maps.event.addDomListener(this.div_, 'click', function() {
    that.triggerClusterClick();
  });
};


/**
 * Returns the position to place the div dending on the latlng.
 *
 * @param {google.maps.LatLng} latlng The position in latlng.
 * @return {google.maps.Point} The position in pixels.
 * @private
 */
ClusterIcon.prototype.getPosFromLatLng_ = function(latlng) {
  var pos = this.getProjection().fromLatLngToDivPixel(latlng);
  pos.x -= parseInt(this.width_ / 2, 10);
  pos.y -= parseInt(this.height_ / 2, 10);
  return pos;
};


/**
 * Draw the icon.
 * @ignore
 */
ClusterIcon.prototype.draw = function() {
  if (this.visible_) {
    var pos = this.getPosFromLatLng_(this.center_);
    this.div_.style.top = pos.y + 'px';
    this.div_.style.left = pos.x + 'px';
  }
};


/**
 * Hide the icon.
 */
ClusterIcon.prototype.hide = function() {
  if (this.div_) {
    this.div_.style.display = 'none';
  }
  this.visible_ = false;
};


/**
 * Position and show the icon.
 */
ClusterIcon.prototype.show = function() {
  if (this.div_) {
    var pos = this.getPosFromLatLng_(this.center_);
    this.div_.style.cssText = this.createCss(pos);
    this.div_.style.display = '';
  }
  this.visible_ = true;
};


/**
 * Remove the icon from the map
 */
ClusterIcon.prototype.remove = function() {
  this.setMap(null);
};


/**
 * Implementation of the onRemove interface.
 * @ignore
 */
ClusterIcon.prototype.onRemove = function() {
  if (this.div_ && this.div_.parentNode) {
    this.hide();
    this.div_.parentNode.removeChild(this.div_);
    this.div_ = null;
  }
};


/**
 * Set the sums of the icon.
 *
 * @param {Object} sums The sums containing:
 *   'text': (string) The text to display in the icon.
 *   'index': (number) The style index of the icon.
 */
ClusterIcon.prototype.setSums = function(sums) {
  this.sums_ = sums;
  this.text_ = sums.text;
  this.index_ = sums.index;
  if (this.div_) {
    this.div_.innerHTML = sums.text;
  }

  this.useStyle();
};


/**
 * Sets the icon to the the styles.
 */
ClusterIcon.prototype.useStyle = function() {
  var index = Math.max(0, this.sums_.index - 1);
  index = Math.min(this.styles_.length - 1, index);
  var style = this.styles_[index];
  this.url_ = style['url'];
  this.height_ = style['height'];
  this.width_ = style['width'];
  this.textColor_ = style['textColor'];
  this.anchor_ = style['anchor'];
  this.textSize_ = style['textSize'];
  this.backgroundPosition_ = style['backgroundPosition'];
};


/**
 * Sets the center of the icon.
 *
 * @param {google.maps.LatLng} center The latlng to set as the center.
 */
ClusterIcon.prototype.setCenter = function(center) {
  this.center_ = center;
};


/**
 * Create the css text based on the position of the icon.
 *
 * @param {google.maps.Point} pos The position.
 * @return {string} The css style text.
 */
ClusterIcon.prototype.createCss = function(pos) {
  var style = [];
  style.push('background-image:url(' + this.url_ + ');');
  var backgroundPosition = this.backgroundPosition_ ? this.backgroundPosition_ : '0 0';
  style.push('background-position:' + backgroundPosition + ';');

  if (typeof this.anchor_ === 'object') {
    if (typeof this.anchor_[0] === 'number' && this.anchor_[0] > 0 &&
        this.anchor_[0] < this.height_) {
      style.push('height:' + (this.height_ - this.anchor_[0]) +
          'px; padding-top:' + this.anchor_[0] + 'px;');
    } else {
      style.push('height:' + this.height_ + 'px; line-height:' + this.height_ +
          'px;');
    }
    if (typeof this.anchor_[1] === 'number' && this.anchor_[1] > 0 &&
        this.anchor_[1] < this.width_) {
      style.push('width:' + (this.width_ - this.anchor_[1]) +
          'px; padding-left:' + this.anchor_[1] + 'px;');
    } else {
      style.push('width:' + this.width_ + 'px; text-align:center;');
    }
  } else {
    style.push('height:' + this.height_ + 'px; line-height:' +
        this.height_ + 'px; width:' + this.width_ + 'px; text-align:center;');
  }

  var txtColor = this.textColor_ ? this.textColor_ : 'black';
  var txtSize = this.textSize_ ? this.textSize_ : 11;

  style.push('cursor:pointer; top:' + pos.y + 'px; left:' +
      pos.x + 'px; color:' + txtColor + '; position:absolute; font-size:' +
      txtSize + 'px; font-family:Arial,sans-serif; font-weight:bold');
  return style.join('');
};
