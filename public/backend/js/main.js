/*!
 * CoreUI v4.0.5 (https://coreui.io)
 * Copyright 2021 The CoreUI Team (https://github.com/orgs/coreui/people)
 * Licensed under MIT (https://coreui.io)
 */
!(function (t, e) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = e())
        : "function" == typeof define && define.amd
        ? define(e)
        : ((t =
              "undefined" != typeof globalThis
                  ? globalThis
                  : t || self).coreui = e());
})(this, function () {
    "use strict";
    const t = {
            find: (t, e = document.documentElement) =>
                [].concat(...Element.prototype.querySelectorAll.call(e, t)),
            findOne: (t, e = document.documentElement) =>
                Element.prototype.querySelector.call(e, t),
            children: (t, e) =>
                [].concat(...t.children).filter((t) => t.matches(e)),
            parents(t, e) {
                const i = [];
                let n = t.parentNode;
                for (
                    ;
                    n && n.nodeType === Node.ELEMENT_NODE && 3 !== n.nodeType;

                )
                    n.matches(e) && i.push(n), (n = n.parentNode);
                return i;
            },
            prev(t, e) {
                let i = t.previousElementSibling;
                for (; i; ) {
                    if (i.matches(e)) return [i];
                    i = i.previousElementSibling;
                }
                return [];
            },
            next(t, e) {
                let i = t.nextElementSibling;
                for (; i; ) {
                    if (i.matches(e)) return [i];
                    i = i.nextElementSibling;
                }
                return [];
            },
        },
        e = "transitionend",
        i = (t) => {
            let e = t.getAttribute("data-coreui-target");
            if (!e || "#" === e) {
                let i = t.getAttribute("href");
                if (!i || (!i.includes("#") && !i.startsWith("."))) return null;
                i.includes("#") &&
                    !i.startsWith("#") &&
                    (i = `#${i.split("#")[1]}`),
                    (e = i && "#" !== i ? i.trim() : null);
            }
            return e;
        },
        n = (t) => {
            const e = i(t);
            return e && document.querySelector(e) ? e : null;
        },
        s = (t) => {
            const e = i(t);
            return e ? document.querySelector(e) : null;
        },
        o = (t) => {
            t.dispatchEvent(new Event(e));
        },
        r = (t) =>
            !(!t || "object" != typeof t) &&
            (void 0 !== t.jquery && (t = t[0]), void 0 !== t.nodeType),
        a = (e) =>
            r(e)
                ? e.jquery
                    ? e[0]
                    : e
                : "string" == typeof e && e.length > 0
                ? t.findOne(e)
                : null,
        l = (t, e, i) => {
            Object.keys(i).forEach((n) => {
                const s = i[n],
                    o = e[n],
                    a =
                        o && r(o)
                            ? "element"
                            : null == (l = o)
                            ? `${l}`
                            : {}.toString
                                  .call(l)
                                  .match(/\s([a-z]+)/i)[1]
                                  .toLowerCase();
                var l;
                if (!new RegExp(s).test(a))
                    throw new TypeError(
                        `${t.toUpperCase()}: Option "${n}" provided type "${a}" but expected type "${s}".`
                    );
            });
        },
        c = (t) =>
            !(!r(t) || 0 === t.getClientRects().length) &&
            "visible" === getComputedStyle(t).getPropertyValue("visibility"),
        h = (t) =>
            !t ||
            t.nodeType !== Node.ELEMENT_NODE ||
            !!t.classList.contains("disabled") ||
            (void 0 !== t.disabled
                ? t.disabled
                : t.hasAttribute("disabled") &&
                  "false" !== t.getAttribute("disabled")),
        d = (t) => {
            if (!document.documentElement.attachShadow) return null;
            if ("function" == typeof t.getRootNode) {
                const e = t.getRootNode();
                return e instanceof ShadowRoot ? e : null;
            }
            return t instanceof ShadowRoot
                ? t
                : t.parentNode
                ? d(t.parentNode)
                : null;
        },
        u = () => {},
        f = (t) => t.offsetHeight,
        p = () => {
            const { jQuery: t } = window;
            return t && !document.body.hasAttribute("data-coreui-no-jquery")
                ? t
                : null;
        },
        g = [],
        m = () => "rtl" === document.documentElement.dir,
        _ = (t) => {
            var e;
            (e = () => {
                const e = p();
                if (e) {
                    const i = t.NAME,
                        n = e.fn[i];
                    (e.fn[i] = t.jQueryInterface),
                        (e.fn[i].Constructor = t),
                        (e.fn[i].noConflict = () => (
                            (e.fn[i] = n), t.jQueryInterface
                        ));
                }
            }),
                "loading" === document.readyState
                    ? (g.length ||
                          document.addEventListener("DOMContentLoaded", () => {
                              g.forEach((t) => t());
                          }),
                      g.push(e))
                    : e();
        },
        v = (t) => {
            "function" == typeof t && t();
        },
        b = (t, i, n = !0) => {
            if (!n) return void v(t);
            const s =
                ((t) => {
                    if (!t) return 0;
                    let { transitionDuration: e, transitionDelay: i } =
                        window.getComputedStyle(t);
                    const n = Number.parseFloat(e),
                        s = Number.parseFloat(i);
                    return n || s
                        ? ((e = e.split(",")[0]),
                          (i = i.split(",")[0]),
                          1e3 * (Number.parseFloat(e) + Number.parseFloat(i)))
                        : 0;
                })(i) + 5;
            let r = !1;
            const a = ({ target: n }) => {
                n === i && ((r = !0), i.removeEventListener(e, a), v(t));
            };
            i.addEventListener(e, a),
                setTimeout(() => {
                    r || o(i);
                }, s);
        },
        y = (t, e, i, n) => {
            let s = t.indexOf(e);
            if (-1 === s) return t[!i && n ? t.length - 1 : 0];
            const o = t.length;
            return (
                (s += i ? 1 : -1),
                n && (s = (s + o) % o),
                t[Math.max(0, Math.min(s, o - 1))]
            );
        },
        w = /[^.]*(?=\..*)\.|.*/,
        E = /\..*/,
        A = /::\d+$/,
        T = {};
    let L = 1;
    const O = { mouseenter: "mouseover", mouseleave: "mouseout" },
        C = /^(mouseenter|mouseleave)/i,
        k = new Set([
            "click",
            "dblclick",
            "mouseup",
            "mousedown",
            "contextmenu",
            "mousewheel",
            "DOMMouseScroll",
            "mouseover",
            "mouseout",
            "mousemove",
            "selectstart",
            "selectend",
            "keydown",
            "keypress",
            "keyup",
            "orientationchange",
            "touchstart",
            "touchmove",
            "touchend",
            "touchcancel",
            "pointerdown",
            "pointermove",
            "pointerup",
            "pointerleave",
            "pointercancel",
            "gesturestart",
            "gesturechange",
            "gestureend",
            "focus",
            "blur",
            "change",
            "reset",
            "select",
            "submit",
            "focusin",
            "focusout",
            "load",
            "unload",
            "beforeunload",
            "resize",
            "move",
            "DOMContentLoaded",
            "readystatechange",
            "error",
            "abort",
            "scroll",
        ]);
    function x(t, e) {
        return (e && `${e}::${L++}`) || t.uidEvent || L++;
    }
    function D(t) {
        const e = x(t);
        return (t.uidEvent = e), (T[e] = T[e] || {}), T[e];
    }
    function N(t, e, i = null) {
        const n = Object.keys(t);
        for (let s = 0, o = n.length; s < o; s++) {
            const o = t[n[s]];
            if (o.originalHandler === e && o.delegationSelector === i) return o;
        }
        return null;
    }
    function S(t, e, i) {
        const n = "string" == typeof e,
            s = n ? i : e;
        let o = M(t);
        return k.has(o) || (o = t), [n, s, o];
    }
    function I(t, e, i, n, s) {
        if ("string" != typeof e || !t) return;
        if ((i || ((i = n), (n = null)), C.test(e))) {
            const t = (t) =>
                function (e) {
                    if (
                        !e.relatedTarget ||
                        (e.relatedTarget !== e.delegateTarget &&
                            !e.delegateTarget.contains(e.relatedTarget))
                    )
                        return t.call(this, e);
                };
            n ? (n = t(n)) : (i = t(i));
        }
        const [o, r, a] = S(e, i, n),
            l = D(t),
            c = l[a] || (l[a] = {}),
            h = N(c, r, o ? i : null);
        if (h) return void (h.oneOff = h.oneOff && s);
        const d = x(r, e.replace(w, "")),
            u = o
                ? (function (t, e, i) {
                      return function n(s) {
                          const o = t.querySelectorAll(e);
                          for (
                              let { target: r } = s;
                              r && r !== this;
                              r = r.parentNode
                          )
                              for (let a = o.length; a--; )
                                  if (o[a] === r)
                                      return (
                                          (s.delegateTarget = r),
                                          n.oneOff && j.off(t, s.type, e, i),
                                          i.apply(r, [s])
                                      );
                          return null;
                      };
                  })(t, i, n)
                : (function (t, e) {
                      return function i(n) {
                          return (
                              (n.delegateTarget = t),
                              i.oneOff && j.off(t, n.type, e),
                              e.apply(t, [n])
                          );
                      };
                  })(t, i);
        (u.delegationSelector = o ? i : null),
            (u.originalHandler = r),
            (u.oneOff = s),
            (u.uidEvent = d),
            (c[d] = u),
            t.addEventListener(a, u, o);
    }
    function $(t, e, i, n, s) {
        const o = N(e[i], n, s);
        o && (t.removeEventListener(i, o, Boolean(s)), delete e[i][o.uidEvent]);
    }
    function M(t) {
        return (t = t.replace(E, "")), O[t] || t;
    }
    const j = {
            on(t, e, i, n) {
                I(t, e, i, n, !1);
            },
            one(t, e, i, n) {
                I(t, e, i, n, !0);
            },
            off(t, e, i, n) {
                if ("string" != typeof e || !t) return;
                const [s, o, r] = S(e, i, n),
                    a = r !== e,
                    l = D(t),
                    c = e.startsWith(".");
                if (void 0 !== o) {
                    if (!l || !l[r]) return;
                    return void $(t, l, r, o, s ? i : null);
                }
                c &&
                    Object.keys(l).forEach((i) => {
                        !(function (t, e, i, n) {
                            const s = e[i] || {};
                            Object.keys(s).forEach((o) => {
                                if (o.includes(n)) {
                                    const n = s[o];
                                    $(
                                        t,
                                        e,
                                        i,
                                        n.originalHandler,
                                        n.delegationSelector
                                    );
                                }
                            });
                        })(t, l, i, e.slice(1));
                    });
                const h = l[r] || {};
                Object.keys(h).forEach((i) => {
                    const n = i.replace(A, "");
                    if (!a || e.includes(n)) {
                        const e = h[i];
                        $(t, l, r, e.originalHandler, e.delegationSelector);
                    }
                });
            },
            trigger(t, e, i) {
                if ("string" != typeof e || !t) return null;
                const n = p(),
                    s = M(e),
                    o = e !== s,
                    r = k.has(s);
                let a,
                    l = !0,
                    c = !0,
                    h = !1,
                    d = null;
                return (
                    o &&
                        n &&
                        ((a = n.Event(e, i)),
                        n(t).trigger(a),
                        (l = !a.isPropagationStopped()),
                        (c = !a.isImmediatePropagationStopped()),
                        (h = a.isDefaultPrevented())),
                    r
                        ? ((d = document.createEvent("HTMLEvents")),
                          d.initEvent(s, l, !0))
                        : (d = new CustomEvent(e, {
                              bubbles: l,
                              cancelable: !0,
                          })),
                    void 0 !== i &&
                        Object.keys(i).forEach((t) => {
                            Object.defineProperty(d, t, { get: () => i[t] });
                        }),
                    h && d.preventDefault(),
                    c && t.dispatchEvent(d),
                    d.defaultPrevented && void 0 !== a && a.preventDefault(),
                    d
                );
            },
        },
        P = new Map();
    var H = {
        set(t, e, i) {
            P.has(t) || P.set(t, new Map());
            const n = P.get(t);
            n.has(e) || 0 === n.size
                ? n.set(e, i)
                : console.error(
                      `Bootstrap doesn't allow more than one instance per element. Bound instance: ${
                          Array.from(n.keys())[0]
                      }.`
                  );
        },
        get: (t, e) => (P.has(t) && P.get(t).get(e)) || null,
        remove(t, e) {
            if (!P.has(t)) return;
            const i = P.get(t);
            i.delete(e), 0 === i.size && P.delete(t);
        },
    };
    class B {
        constructor(t) {
            (t = a(t)) &&
                ((this._element = t),
                H.set(this._element, this.constructor.DATA_KEY, this));
        }
        dispose() {
            H.remove(this._element, this.constructor.DATA_KEY),
                j.off(this._element, this.constructor.EVENT_KEY),
                Object.getOwnPropertyNames(this).forEach((t) => {
                    this[t] = null;
                });
        }
        _queueCallback(t, e, i = !0) {
            b(t, e, i);
        }
        static getInstance(t) {
            return H.get(t, this.DATA_KEY);
        }
        static getOrCreateInstance(t, e = {}) {
            return (
                this.getInstance(t) ||
                new this(t, "object" == typeof e ? e : null)
            );
        }
        static get VERSION() {
            return "4.0.5";
        }
        static get NAME() {
            throw new Error(
                'You have to implement the static method "NAME", for each component!'
            );
        }
        static get DATA_KEY() {
            return `coreui.${this.NAME}`;
        }
        static get EVENT_KEY() {
            return `.${this.DATA_KEY}`;
        }
    }
    class R extends B {
        static get NAME() {
            return "alert";
        }
        close(t) {
            const e = t ? this._getRootElement(t) : this._element,
                i = this._triggerCloseEvent(e);
            null === i || i.defaultPrevented || this._removeElement(e);
        }
        _getRootElement(t) {
            return s(t) || t.closest(".alert");
        }
        _triggerCloseEvent(t) {
            return j.trigger(t, "close.coreui.alert");
        }
        _removeElement(t) {
            t.classList.remove("show");
            const e = t.classList.contains("fade");
            this._queueCallback(() => this._destroyElement(t), t, e);
        }
        _destroyElement(t) {
            t.remove(), j.trigger(t, "closed.coreui.alert");
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = R.getOrCreateInstance(this);
                "close" === t && e[t](this);
            });
        }
        static handleDismiss(t) {
            return function (e) {
                e && e.preventDefault(), t.close(this);
            };
        }
    }
    j.on(
        document,
        "click.coreui.alert.data-api",
        '[data-coreui-dismiss="alert"]',
        R.handleDismiss(new R())
    ),
        _(R);
    const W = '[data-coreui-toggle="button"]';
    class q extends B {
        static get NAME() {
            return "button";
        }
        toggle() {
            this._element.setAttribute(
                "aria-pressed",
                this._element.classList.toggle("active")
            );
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = q.getOrCreateInstance(this);
                "toggle" === t && e[t]();
            });
        }
    }
    function U(t) {
        return (
            "true" === t ||
            ("false" !== t &&
                (t === Number(t).toString()
                    ? Number(t)
                    : "" === t || "null" === t
                    ? null
                    : t))
        );
    }
    function z(t) {
        return t.replace(/[A-Z]/g, (t) => `-${t.toLowerCase()}`);
    }
    j.on(document, "click.coreui.button.data-api", W, (t) => {
        t.preventDefault();
        const e = t.target.closest(W);
        q.getOrCreateInstance(e).toggle();
    }),
        _(q);
    const V = {
            setDataAttribute(t, e, i) {
                t.setAttribute(`data-coreui-${z(e)}`, i);
            },
            removeDataAttribute(t, e) {
                t.removeAttribute(`data-coreui-${z(e)}`);
            },
            getDataAttributes(t) {
                if (!t) return {};
                const e = {};
                return (
                    Object.keys(t.dataset)
                        .filter((t) => t.startsWith("coreui"))
                        .forEach((i) => {
                            let n = i.replace(/^coreui/, "");
                            (n =
                                n.charAt(0).toLowerCase() +
                                n.slice(1, n.length)),
                                (e[n] = U(t.dataset[i]));
                        }),
                    e
                );
            },
            getDataAttribute: (t, e) =>
                U(t.getAttribute(`data-coreui-${z(e)}`)),
            offset(t) {
                const e = t.getBoundingClientRect();
                return {
                    top: e.top + document.body.scrollTop,
                    left: e.left + document.body.scrollLeft,
                };
            },
            position: (t) => ({ top: t.offsetTop, left: t.offsetLeft }),
        },
        F = "carousel",
        K = ".coreui.carousel",
        Y = {
            interval: 5e3,
            keyboard: !0,
            slide: !1,
            pause: "hover",
            wrap: !0,
            touch: !0,
        },
        Q = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            slide: "(boolean|string)",
            pause: "(string|boolean)",
            wrap: "boolean",
            touch: "boolean",
        },
        X = "next",
        G = "prev",
        Z = "left",
        J = "right",
        tt = { ArrowLeft: J, ArrowRight: Z },
        et = `slide${K}`,
        it = `slid${K}`,
        nt = `keydown${K}`,
        st = `mouseenter${K}`,
        ot = `mouseleave${K}`,
        rt = `touchstart${K}`,
        at = `touchmove${K}`,
        lt = `touchend${K}`,
        ct = `pointerdown${K}`,
        ht = `pointerup${K}`,
        dt = `dragstart${K}`,
        ut = `load${K}.data-api`,
        ft = `click${K}.data-api`,
        pt = "active",
        gt = ".active.carousel-item",
        mt = "touch";
    class _t extends B {
        constructor(e, i) {
            super(e),
                (this._items = null),
                (this._interval = null),
                (this._activeElement = null),
                (this._isPaused = !1),
                (this._isSliding = !1),
                (this.touchTimeout = null),
                (this.touchStartX = 0),
                (this.touchDeltaX = 0),
                (this._config = this._getConfig(i)),
                (this._indicatorsElement = t.findOne(
                    ".carousel-indicators",
                    this._element
                )),
                (this._touchSupported =
                    "ontouchstart" in document.documentElement ||
                    navigator.maxTouchPoints > 0),
                (this._pointerEvent = Boolean(window.PointerEvent)),
                this._addEventListeners();
        }
        static get Default() {
            return Y;
        }
        static get NAME() {
            return F;
        }
        next() {
            this._slide(X);
        }
        nextWhenVisible() {
            !document.hidden && c(this._element) && this.next();
        }
        prev() {
            this._slide(G);
        }
        pause(e) {
            e || (this._isPaused = !0),
                t.findOne(
                    ".carousel-item-next, .carousel-item-prev",
                    this._element
                ) && (o(this._element), this.cycle(!0)),
                clearInterval(this._interval),
                (this._interval = null);
        }
        cycle(t) {
            t || (this._isPaused = !1),
                this._interval &&
                    (clearInterval(this._interval), (this._interval = null)),
                this._config &&
                    this._config.interval &&
                    !this._isPaused &&
                    (this._updateInterval(),
                    (this._interval = setInterval(
                        (document.visibilityState
                            ? this.nextWhenVisible
                            : this.next
                        ).bind(this),
                        this._config.interval
                    )));
        }
        to(e) {
            this._activeElement = t.findOne(gt, this._element);
            const i = this._getItemIndex(this._activeElement);
            if (e > this._items.length - 1 || e < 0) return;
            if (this._isSliding)
                return void j.one(this._element, it, () => this.to(e));
            if (i === e) return this.pause(), void this.cycle();
            const n = e > i ? X : G;
            this._slide(n, this._items[e]);
        }
        _getConfig(t) {
            return (
                (t = {
                    ...Y,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t ? t : {}),
                }),
                l(F, t, Q),
                t
            );
        }
        _handleSwipe() {
            const t = Math.abs(this.touchDeltaX);
            if (t <= 40) return;
            const e = t / this.touchDeltaX;
            (this.touchDeltaX = 0), e && this._slide(e > 0 ? J : Z);
        }
        _addEventListeners() {
            this._config.keyboard &&
                j.on(this._element, nt, (t) => this._keydown(t)),
                "hover" === this._config.pause &&
                    (j.on(this._element, st, (t) => this.pause(t)),
                    j.on(this._element, ot, (t) => this.cycle(t))),
                this._config.touch &&
                    this._touchSupported &&
                    this._addTouchEventListeners();
        }
        _addTouchEventListeners() {
            const e = (t) => {
                    !this._pointerEvent ||
                    ("pen" !== t.pointerType && t.pointerType !== mt)
                        ? this._pointerEvent ||
                          (this.touchStartX = t.touches[0].clientX)
                        : (this.touchStartX = t.clientX);
                },
                i = (t) => {
                    this.touchDeltaX =
                        t.touches && t.touches.length > 1
                            ? 0
                            : t.touches[0].clientX - this.touchStartX;
                },
                n = (t) => {
                    !this._pointerEvent ||
                        ("pen" !== t.pointerType && t.pointerType !== mt) ||
                        (this.touchDeltaX = t.clientX - this.touchStartX),
                        this._handleSwipe(),
                        "hover" === this._config.pause &&
                            (this.pause(),
                            this.touchTimeout &&
                                clearTimeout(this.touchTimeout),
                            (this.touchTimeout = setTimeout(
                                (t) => this.cycle(t),
                                500 + this._config.interval
                            )));
                };
            t.find(".carousel-item img", this._element).forEach((t) => {
                j.on(t, dt, (t) => t.preventDefault());
            }),
                this._pointerEvent
                    ? (j.on(this._element, ct, (t) => e(t)),
                      j.on(this._element, ht, (t) => n(t)),
                      this._element.classList.add("pointer-event"))
                    : (j.on(this._element, rt, (t) => e(t)),
                      j.on(this._element, at, (t) => i(t)),
                      j.on(this._element, lt, (t) => n(t)));
        }
        _keydown(t) {
            if (/input|textarea/i.test(t.target.tagName)) return;
            const e = tt[t.key];
            e && (t.preventDefault(), this._slide(e));
        }
        _getItemIndex(e) {
            return (
                (this._items =
                    e && e.parentNode
                        ? t.find(".carousel-item", e.parentNode)
                        : []),
                this._items.indexOf(e)
            );
        }
        _getItemByOrder(t, e) {
            const i = t === X;
            return y(this._items, e, i, this._config.wrap);
        }
        _triggerSlideEvent(e, i) {
            const n = this._getItemIndex(e),
                s = this._getItemIndex(t.findOne(gt, this._element));
            return j.trigger(this._element, et, {
                relatedTarget: e,
                direction: i,
                from: s,
                to: n,
            });
        }
        _setActiveIndicatorElement(e) {
            if (this._indicatorsElement) {
                const i = t.findOne(".active", this._indicatorsElement);
                i.classList.remove(pt), i.removeAttribute("aria-current");
                const n = t.find(
                    "[data-coreui-target]",
                    this._indicatorsElement
                );
                for (let t = 0; t < n.length; t++)
                    if (
                        Number.parseInt(
                            n[t].getAttribute("data-coreui-slide-to"),
                            10
                        ) === this._getItemIndex(e)
                    ) {
                        n[t].classList.add(pt),
                            n[t].setAttribute("aria-current", "true");
                        break;
                    }
            }
        }
        _updateInterval() {
            const e = this._activeElement || t.findOne(gt, this._element);
            if (!e) return;
            const i = Number.parseInt(
                e.getAttribute("data-coreui-interval"),
                10
            );
            i
                ? ((this._config.defaultInterval =
                      this._config.defaultInterval || this._config.interval),
                  (this._config.interval = i))
                : (this._config.interval =
                      this._config.defaultInterval || this._config.interval);
        }
        _slide(e, i) {
            const n = this._directionToOrder(e),
                s = t.findOne(gt, this._element),
                o = this._getItemIndex(s),
                r = i || this._getItemByOrder(n, s),
                a = this._getItemIndex(r),
                l = Boolean(this._interval),
                c = n === X,
                h = c ? "carousel-item-start" : "carousel-item-end",
                d = c ? "carousel-item-next" : "carousel-item-prev",
                u = this._orderToDirection(n);
            if (r && r.classList.contains(pt))
                return void (this._isSliding = !1);
            if (this._isSliding) return;
            if (this._triggerSlideEvent(r, u).defaultPrevented) return;
            if (!s || !r) return;
            (this._isSliding = !0),
                l && this.pause(),
                this._setActiveIndicatorElement(r),
                (this._activeElement = r);
            const p = () => {
                j.trigger(this._element, it, {
                    relatedTarget: r,
                    direction: u,
                    from: o,
                    to: a,
                });
            };
            if (this._element.classList.contains("slide")) {
                r.classList.add(d),
                    f(r),
                    s.classList.add(h),
                    r.classList.add(h);
                const t = () => {
                    r.classList.remove(h, d),
                        r.classList.add(pt),
                        s.classList.remove(pt, d, h),
                        (this._isSliding = !1),
                        setTimeout(p, 0);
                };
                this._queueCallback(t, s, !0);
            } else s.classList.remove(pt), r.classList.add(pt), (this._isSliding = !1), p();
            l && this.cycle();
        }
        _directionToOrder(t) {
            return [J, Z].includes(t)
                ? m()
                    ? t === Z
                        ? G
                        : X
                    : t === Z
                    ? X
                    : G
                : t;
        }
        _orderToDirection(t) {
            return [X, G].includes(t)
                ? m()
                    ? t === G
                        ? Z
                        : J
                    : t === G
                    ? J
                    : Z
                : t;
        }
        static carouselInterface(t, e) {
            const i = _t.getOrCreateInstance(t, e);
            let { _config: n } = i;
            "object" == typeof e && (n = { ...n, ...e });
            const s = "string" == typeof e ? e : n.slide;
            if ("number" == typeof e) i.to(e);
            else if ("string" == typeof s) {
                if (void 0 === i[s])
                    throw new TypeError(`No method named "${s}"`);
                i[s]();
            } else n.interval && n.ride && (i.pause(), i.cycle());
        }
        static jQueryInterface(t) {
            return this.each(function () {
                _t.carouselInterface(this, t);
            });
        }
        static dataApiClickHandler(t) {
            const e = s(this);
            if (!e || !e.classList.contains("carousel")) return;
            const i = {
                    ...V.getDataAttributes(e),
                    ...V.getDataAttributes(this),
                },
                n = this.getAttribute("data-coreui-slide-to");
            n && (i.interval = !1),
                _t.carouselInterface(e, i),
                n && _t.getInstance(e).to(n),
                t.preventDefault();
        }
    }
    j.on(
        document,
        ft,
        "[data-coreui-slide], [data-coreui-slide-to]",
        _t.dataApiClickHandler
    ),
        j.on(window, ut, () => {
            const e = t.find('[data-coreui-ride="carousel"]');
            for (let t = 0, i = e.length; t < i; t++)
                _t.carouselInterface(e[t], _t.getInstance(e[t]));
        }),
        _(_t);
    const vt = "collapse",
        bt = "coreui.collapse",
        yt = `.${bt}`,
        wt = { toggle: !0, parent: "" },
        Et = { toggle: "boolean", parent: "(string|element)" },
        At = `show${yt}`,
        Tt = `shown${yt}`,
        Lt = `hide${yt}`,
        Ot = `hidden${yt}`,
        Ct = `click${yt}.data-api`,
        kt = "show",
        xt = "collapse",
        Dt = "collapsing",
        Nt = "collapsed",
        St = "width",
        It = '[data-coreui-toggle="collapse"]';
    class $t extends B {
        constructor(e, i) {
            super(e),
                (this._isTransitioning = !1),
                (this._config = this._getConfig(i)),
                (this._triggerArray = t.find(
                    `${It}[href="#${this._element.id}"],${It}[data-coreui-target="#${this._element.id}"]`
                ));
            const s = t.find(It);
            for (let e = 0, i = s.length; e < i; e++) {
                const i = s[e],
                    o = n(i),
                    r = t.find(o).filter((t) => t === this._element);
                null !== o &&
                    r.length &&
                    ((this._selector = o), this._triggerArray.push(i));
            }
            (this._parent = this._config.parent ? this._getParent() : null),
                this._config.parent ||
                    this._addAriaAndCollapsedClass(
                        this._element,
                        this._triggerArray
                    ),
                this._config.toggle && this.toggle();
        }
        static get Default() {
            return wt;
        }
        static get NAME() {
            return vt;
        }
        toggle() {
            this._element.classList.contains(kt) ? this.hide() : this.show();
        }
        show() {
            if (this._isTransitioning || this._element.classList.contains(kt))
                return;
            let e, i;
            this._parent &&
                ((e = t
                    .find(".show, .collapsing", this._parent)
                    .filter((t) =>
                        "string" == typeof this._config.parent
                            ? t.getAttribute("data-coreui-parent") ===
                              this._config.parent
                            : t.classList.contains(xt)
                    )),
                0 === e.length && (e = null));
            const n = t.findOne(this._selector);
            if (e) {
                const t = e.find((t) => n !== t);
                if (
                    ((i = t ? $t.getInstance(t) : null),
                    i && i._isTransitioning)
                )
                    return;
            }
            if (j.trigger(this._element, At).defaultPrevented) return;
            e &&
                e.forEach((t) => {
                    n !== t && $t.collapseInterface(t, "hide"),
                        i || H.set(t, bt, null);
                });
            const s = this._getDimension();
            this._element.classList.remove(xt),
                this._element.classList.add(Dt),
                (this._element.style[s] = 0),
                this._triggerArray.length &&
                    this._triggerArray.forEach((t) => {
                        t.classList.remove(Nt),
                            t.setAttribute("aria-expanded", !0);
                    }),
                this.setTransitioning(!0);
            const o = `scroll${s[0].toUpperCase() + s.slice(1)}`;
            this._queueCallback(
                () => {
                    this._element.classList.remove(Dt),
                        this._element.classList.add(xt, kt),
                        (this._element.style[s] = ""),
                        this.setTransitioning(!1),
                        j.trigger(this._element, Tt);
                },
                this._element,
                !0
            ),
                (this._element.style[s] = `${this._element[o]}px`);
        }
        hide() {
            if (this._isTransitioning || !this._element.classList.contains(kt))
                return;
            if (j.trigger(this._element, Lt).defaultPrevented) return;
            const t = this._getDimension();
            (this._element.style[t] = `${
                this._element.getBoundingClientRect()[t]
            }px`),
                f(this._element),
                this._element.classList.add(Dt),
                this._element.classList.remove(xt, kt);
            const e = this._triggerArray.length;
            if (e > 0)
                for (let t = 0; t < e; t++) {
                    const e = this._triggerArray[t],
                        i = s(e);
                    i &&
                        !i.classList.contains(kt) &&
                        (e.classList.add(Nt),
                        e.setAttribute("aria-expanded", !1));
                }
            this.setTransitioning(!0);
            (this._element.style[t] = ""),
                this._queueCallback(
                    () => {
                        this.setTransitioning(!1),
                            this._element.classList.remove(Dt),
                            this._element.classList.add(xt),
                            j.trigger(this._element, Ot);
                    },
                    this._element,
                    !0
                );
        }
        setTransitioning(t) {
            this._isTransitioning = t;
        }
        _getConfig(t) {
            return (
                ((t = { ...wt, ...t }).toggle = Boolean(t.toggle)),
                l(vt, t, Et),
                t
            );
        }
        _getDimension() {
            return this._element.classList.contains(St) ? St : "height";
        }
        _getParent() {
            let { parent: e } = this._config;
            e = a(e);
            const i = `${It}[data-coreui-parent="${e}"]`;
            return (
                t.find(i, e).forEach((t) => {
                    const e = s(t);
                    this._addAriaAndCollapsedClass(e, [t]);
                }),
                e
            );
        }
        _addAriaAndCollapsedClass(t, e) {
            if (!t || !e.length) return;
            const i = t.classList.contains(kt);
            e.forEach((t) => {
                i ? t.classList.remove(Nt) : t.classList.add(Nt),
                    t.setAttribute("aria-expanded", i);
            });
        }
        static collapseInterface(t, e) {
            let i = $t.getInstance(t);
            const n = {
                ...wt,
                ...V.getDataAttributes(t),
                ...("object" == typeof e && e ? e : {}),
            };
            if (
                (!i &&
                    n.toggle &&
                    "string" == typeof e &&
                    /show|hide/.test(e) &&
                    (n.toggle = !1),
                i || (i = new $t(t, n)),
                "string" == typeof e)
            ) {
                if (void 0 === i[e])
                    throw new TypeError(`No method named "${e}"`);
                i[e]();
            }
        }
        static jQueryInterface(t) {
            return this.each(function () {
                $t.collapseInterface(this, t);
            });
        }
    }
    j.on(document, Ct, It, function (e) {
        ("A" === e.target.tagName ||
            (e.delegateTarget && "A" === e.delegateTarget.tagName)) &&
            e.preventDefault();
        const i = V.getDataAttributes(this),
            s = n(this);
        t.find(s).forEach((t) => {
            const e = $t.getInstance(t);
            let n;
            e
                ? (null === e._parent &&
                      "string" == typeof i.parent &&
                      ((e._config.parent = i.parent),
                      (e._parent = e._getParent())),
                  (n = "toggle"))
                : (n = i),
                $t.collapseInterface(t, n);
        });
    }),
        _($t);
    var Mt = "top",
        jt = "bottom",
        Pt = "right",
        Ht = "left",
        Bt = "auto",
        Rt = [Mt, jt, Pt, Ht],
        Wt = "start",
        qt = "end",
        Ut = "clippingParents",
        zt = "viewport",
        Vt = "popper",
        Ft = "reference",
        Kt = Rt.reduce(function (t, e) {
            return t.concat([e + "-" + Wt, e + "-" + qt]);
        }, []),
        Yt = [].concat(Rt, [Bt]).reduce(function (t, e) {
            return t.concat([e, e + "-" + Wt, e + "-" + qt]);
        }, []),
        Qt = "beforeRead",
        Xt = "read",
        Gt = "afterRead",
        Zt = "beforeMain",
        Jt = "main",
        te = "afterMain",
        ee = "beforeWrite",
        ie = "write",
        ne = "afterWrite",
        se = [Qt, Xt, Gt, Zt, Jt, te, ee, ie, ne];
    function oe(t) {
        return t ? (t.nodeName || "").toLowerCase() : null;
    }
    function re(t) {
        if (null == t) return window;
        if ("[object Window]" !== t.toString()) {
            var e = t.ownerDocument;
            return (e && e.defaultView) || window;
        }
        return t;
    }
    function ae(t) {
        return t instanceof re(t).Element || t instanceof Element;
    }
    function le(t) {
        return t instanceof re(t).HTMLElement || t instanceof HTMLElement;
    }
    function ce(t) {
        return (
            "undefined" != typeof ShadowRoot &&
            (t instanceof re(t).ShadowRoot || t instanceof ShadowRoot)
        );
    }
    var he = {
        name: "applyStyles",
        enabled: !0,
        phase: "write",
        fn: function (t) {
            var e = t.state;
            Object.keys(e.elements).forEach(function (t) {
                var i = e.styles[t] || {},
                    n = e.attributes[t] || {},
                    s = e.elements[t];
                le(s) &&
                    oe(s) &&
                    (Object.assign(s.style, i),
                    Object.keys(n).forEach(function (t) {
                        var e = n[t];
                        !1 === e
                            ? s.removeAttribute(t)
                            : s.setAttribute(t, !0 === e ? "" : e);
                    }));
            });
        },
        effect: function (t) {
            var e = t.state,
                i = {
                    popper: {
                        position: e.options.strategy,
                        left: "0",
                        top: "0",
                        margin: "0",
                    },
                    arrow: { position: "absolute" },
                    reference: {},
                };
            return (
                Object.assign(e.elements.popper.style, i.popper),
                (e.styles = i),
                e.elements.arrow &&
                    Object.assign(e.elements.arrow.style, i.arrow),
                function () {
                    Object.keys(e.elements).forEach(function (t) {
                        var n = e.elements[t],
                            s = e.attributes[t] || {},
                            o = Object.keys(
                                e.styles.hasOwnProperty(t) ? e.styles[t] : i[t]
                            ).reduce(function (t, e) {
                                return (t[e] = ""), t;
                            }, {});
                        le(n) &&
                            oe(n) &&
                            (Object.assign(n.style, o),
                            Object.keys(s).forEach(function (t) {
                                n.removeAttribute(t);
                            }));
                    });
                }
            );
        },
        requires: ["computeStyles"],
    };
    function de(t) {
        return t.split("-")[0];
    }
    var ue = Math.round;
    function fe(t, e) {
        void 0 === e && (e = !1);
        var i = t.getBoundingClientRect(),
            n = 1,
            s = 1;
        if (le(t) && e) {
            var o = t.offsetHeight,
                r = t.offsetWidth;
            r > 0 && (n = i.width / r || 1), o > 0 && (s = i.height / o || 1);
        }
        return {
            width: ue(i.width / n),
            height: ue(i.height / s),
            top: ue(i.top / s),
            right: ue(i.right / n),
            bottom: ue(i.bottom / s),
            left: ue(i.left / n),
            x: ue(i.left / n),
            y: ue(i.top / s),
        };
    }
    function pe(t) {
        var e = fe(t),
            i = t.offsetWidth,
            n = t.offsetHeight;
        return (
            Math.abs(e.width - i) <= 1 && (i = e.width),
            Math.abs(e.height - n) <= 1 && (n = e.height),
            { x: t.offsetLeft, y: t.offsetTop, width: i, height: n }
        );
    }
    function ge(t, e) {
        var i = e.getRootNode && e.getRootNode();
        if (t.contains(e)) return !0;
        if (i && ce(i)) {
            var n = e;
            do {
                if (n && t.isSameNode(n)) return !0;
                n = n.parentNode || n.host;
            } while (n);
        }
        return !1;
    }
    function me(t) {
        return re(t).getComputedStyle(t);
    }
    function _e(t) {
        return ["table", "td", "th"].indexOf(oe(t)) >= 0;
    }
    function ve(t) {
        return (
            (ae(t) ? t.ownerDocument : t.document) || window.document
        ).documentElement;
    }
    function be(t) {
        return "html" === oe(t)
            ? t
            : t.assignedSlot ||
                  t.parentNode ||
                  (ce(t) ? t.host : null) ||
                  ve(t);
    }
    function ye(t) {
        return le(t) && "fixed" !== me(t).position ? t.offsetParent : null;
    }
    function we(t) {
        for (
            var e = re(t), i = ye(t);
            i && _e(i) && "static" === me(i).position;

        )
            i = ye(i);
        return i &&
            ("html" === oe(i) ||
                ("body" === oe(i) && "static" === me(i).position))
            ? e
            : i ||
                  (function (t) {
                      var e =
                          -1 !==
                          navigator.userAgent.toLowerCase().indexOf("firefox");
                      if (
                          -1 !== navigator.userAgent.indexOf("Trident") &&
                          le(t) &&
                          "fixed" === me(t).position
                      )
                          return null;
                      for (
                          var i = be(t);
                          le(i) && ["html", "body"].indexOf(oe(i)) < 0;

                      ) {
                          var n = me(i);
                          if (
                              "none" !== n.transform ||
                              "none" !== n.perspective ||
                              "paint" === n.contain ||
                              -1 !==
                                  ["transform", "perspective"].indexOf(
                                      n.willChange
                                  ) ||
                              (e && "filter" === n.willChange) ||
                              (e && n.filter && "none" !== n.filter)
                          )
                              return i;
                          i = i.parentNode;
                      }
                      return null;
                  })(t) ||
                  e;
    }
    function Ee(t) {
        return ["top", "bottom"].indexOf(t) >= 0 ? "x" : "y";
    }
    var Ae = Math.max,
        Te = Math.min,
        Le = Math.round;
    function Oe(t, e, i) {
        return Ae(t, Te(e, i));
    }
    function Ce(t) {
        return Object.assign({}, { top: 0, right: 0, bottom: 0, left: 0 }, t);
    }
    function ke(t, e) {
        return e.reduce(function (e, i) {
            return (e[i] = t), e;
        }, {});
    }
    var xe = {
        name: "arrow",
        enabled: !0,
        phase: "main",
        fn: function (t) {
            var e,
                i = t.state,
                n = t.name,
                s = t.options,
                o = i.elements.arrow,
                r = i.modifiersData.popperOffsets,
                a = de(i.placement),
                l = Ee(a),
                c = [Ht, Pt].indexOf(a) >= 0 ? "height" : "width";
            if (o && r) {
                var h = (function (t, e) {
                        return Ce(
                            "number" !=
                                typeof (t =
                                    "function" == typeof t
                                        ? t(
                                              Object.assign({}, e.rects, {
                                                  placement: e.placement,
                                              })
                                          )
                                        : t)
                                ? t
                                : ke(t, Rt)
                        );
                    })(s.padding, i),
                    d = pe(o),
                    u = "y" === l ? Mt : Ht,
                    f = "y" === l ? jt : Pt,
                    p =
                        i.rects.reference[c] +
                        i.rects.reference[l] -
                        r[l] -
                        i.rects.popper[c],
                    g = r[l] - i.rects.reference[l],
                    m = we(o),
                    _ = m
                        ? "y" === l
                            ? m.clientHeight || 0
                            : m.clientWidth || 0
                        : 0,
                    v = p / 2 - g / 2,
                    b = h[u],
                    y = _ - d[c] - h[f],
                    w = _ / 2 - d[c] / 2 + v,
                    E = Oe(b, w, y),
                    A = l;
                i.modifiersData[n] =
                    (((e = {})[A] = E), (e.centerOffset = E - w), e);
            }
        },
        effect: function (t) {
            var e = t.state,
                i = t.options.element,
                n = void 0 === i ? "[data-popper-arrow]" : i;
            null != n &&
                ("string" != typeof n ||
                    (n = e.elements.popper.querySelector(n))) &&
                ge(e.elements.popper, n) &&
                (e.elements.arrow = n);
        },
        requires: ["popperOffsets"],
        requiresIfExists: ["preventOverflow"],
    };
    function De(t) {
        return t.split("-")[1];
    }
    var Ne = { top: "auto", right: "auto", bottom: "auto", left: "auto" };
    function Se(t) {
        var e,
            i = t.popper,
            n = t.popperRect,
            s = t.placement,
            o = t.variation,
            r = t.offsets,
            a = t.position,
            l = t.gpuAcceleration,
            c = t.adaptive,
            h = t.roundOffsets,
            d =
                !0 === h
                    ? (function (t) {
                          var e = t.x,
                              i = t.y,
                              n = window.devicePixelRatio || 1;
                          return {
                              x: Le(Le(e * n) / n) || 0,
                              y: Le(Le(i * n) / n) || 0,
                          };
                      })(r)
                    : "function" == typeof h
                    ? h(r)
                    : r,
            u = d.x,
            f = void 0 === u ? 0 : u,
            p = d.y,
            g = void 0 === p ? 0 : p,
            m = r.hasOwnProperty("x"),
            _ = r.hasOwnProperty("y"),
            v = Ht,
            b = Mt,
            y = window;
        if (c) {
            var w = we(i),
                E = "clientHeight",
                A = "clientWidth";
            w === re(i) &&
                "static" !== me((w = ve(i))).position &&
                "absolute" === a &&
                ((E = "scrollHeight"), (A = "scrollWidth")),
                (w = w),
                (s !== Mt && ((s !== Ht && s !== Pt) || o !== qt)) ||
                    ((b = jt), (g -= w[E] - n.height), (g *= l ? 1 : -1)),
                (s !== Ht && ((s !== Mt && s !== jt) || o !== qt)) ||
                    ((v = Pt), (f -= w[A] - n.width), (f *= l ? 1 : -1));
        }
        var T,
            L = Object.assign({ position: a }, c && Ne);
        return l
            ? Object.assign(
                  {},
                  L,
                  (((T = {})[b] = _ ? "0" : ""),
                  (T[v] = m ? "0" : ""),
                  (T.transform =
                      (y.devicePixelRatio || 1) <= 1
                          ? "translate(" + f + "px, " + g + "px)"
                          : "translate3d(" + f + "px, " + g + "px, 0)"),
                  T)
              )
            : Object.assign(
                  {},
                  L,
                  (((e = {})[b] = _ ? g + "px" : ""),
                  (e[v] = m ? f + "px" : ""),
                  (e.transform = ""),
                  e)
              );
    }
    var Ie = {
            name: "computeStyles",
            enabled: !0,
            phase: "beforeWrite",
            fn: function (t) {
                var e = t.state,
                    i = t.options,
                    n = i.gpuAcceleration,
                    s = void 0 === n || n,
                    o = i.adaptive,
                    r = void 0 === o || o,
                    a = i.roundOffsets,
                    l = void 0 === a || a,
                    c = {
                        placement: de(e.placement),
                        variation: De(e.placement),
                        popper: e.elements.popper,
                        popperRect: e.rects.popper,
                        gpuAcceleration: s,
                    };
                null != e.modifiersData.popperOffsets &&
                    (e.styles.popper = Object.assign(
                        {},
                        e.styles.popper,
                        Se(
                            Object.assign({}, c, {
                                offsets: e.modifiersData.popperOffsets,
                                position: e.options.strategy,
                                adaptive: r,
                                roundOffsets: l,
                            })
                        )
                    )),
                    null != e.modifiersData.arrow &&
                        (e.styles.arrow = Object.assign(
                            {},
                            e.styles.arrow,
                            Se(
                                Object.assign({}, c, {
                                    offsets: e.modifiersData.arrow,
                                    position: "absolute",
                                    adaptive: !1,
                                    roundOffsets: l,
                                })
                            )
                        )),
                    (e.attributes.popper = Object.assign(
                        {},
                        e.attributes.popper,
                        { "data-popper-placement": e.placement }
                    ));
            },
            data: {},
        },
        $e = { passive: !0 };
    var Me = {
            name: "eventListeners",
            enabled: !0,
            phase: "write",
            fn: function () {},
            effect: function (t) {
                var e = t.state,
                    i = t.instance,
                    n = t.options,
                    s = n.scroll,
                    o = void 0 === s || s,
                    r = n.resize,
                    a = void 0 === r || r,
                    l = re(e.elements.popper),
                    c = [].concat(
                        e.scrollParents.reference,
                        e.scrollParents.popper
                    );
                return (
                    o &&
                        c.forEach(function (t) {
                            t.addEventListener("scroll", i.update, $e);
                        }),
                    a && l.addEventListener("resize", i.update, $e),
                    function () {
                        o &&
                            c.forEach(function (t) {
                                t.removeEventListener("scroll", i.update, $e);
                            }),
                            a && l.removeEventListener("resize", i.update, $e);
                    }
                );
            },
            data: {},
        },
        je = { left: "right", right: "left", bottom: "top", top: "bottom" };
    function Pe(t) {
        return t.replace(/left|right|bottom|top/g, function (t) {
            return je[t];
        });
    }
    var He = { start: "end", end: "start" };
    function Be(t) {
        return t.replace(/start|end/g, function (t) {
            return He[t];
        });
    }
    function Re(t) {
        var e = re(t);
        return { scrollLeft: e.pageXOffset, scrollTop: e.pageYOffset };
    }
    function We(t) {
        return fe(ve(t)).left + Re(t).scrollLeft;
    }
    function qe(t) {
        var e = me(t),
            i = e.overflow,
            n = e.overflowX,
            s = e.overflowY;
        return /auto|scroll|overlay|hidden/.test(i + s + n);
    }
    function Ue(t) {
        return ["html", "body", "#document"].indexOf(oe(t)) >= 0
            ? t.ownerDocument.body
            : le(t) && qe(t)
            ? t
            : Ue(be(t));
    }
    function ze(t, e) {
        var i;
        void 0 === e && (e = []);
        var n = Ue(t),
            s = n === (null == (i = t.ownerDocument) ? void 0 : i.body),
            o = re(n),
            r = s ? [o].concat(o.visualViewport || [], qe(n) ? n : []) : n,
            a = e.concat(r);
        return s ? a : a.concat(ze(be(r)));
    }
    function Ve(t) {
        return Object.assign({}, t, {
            left: t.x,
            top: t.y,
            right: t.x + t.width,
            bottom: t.y + t.height,
        });
    }
    function Fe(t, e) {
        return e === zt
            ? Ve(
                  (function (t) {
                      var e = re(t),
                          i = ve(t),
                          n = e.visualViewport,
                          s = i.clientWidth,
                          o = i.clientHeight,
                          r = 0,
                          a = 0;
                      return (
                          n &&
                              ((s = n.width),
                              (o = n.height),
                              /^((?!chrome|android).)*safari/i.test(
                                  navigator.userAgent
                              ) || ((r = n.offsetLeft), (a = n.offsetTop))),
                          { width: s, height: o, x: r + We(t), y: a }
                      );
                  })(t)
              )
            : le(e)
            ? (function (t) {
                  var e = fe(t);
                  return (
                      (e.top = e.top + t.clientTop),
                      (e.left = e.left + t.clientLeft),
                      (e.bottom = e.top + t.clientHeight),
                      (e.right = e.left + t.clientWidth),
                      (e.width = t.clientWidth),
                      (e.height = t.clientHeight),
                      (e.x = e.left),
                      (e.y = e.top),
                      e
                  );
              })(e)
            : Ve(
                  (function (t) {
                      var e,
                          i = ve(t),
                          n = Re(t),
                          s = null == (e = t.ownerDocument) ? void 0 : e.body,
                          o = Ae(
                              i.scrollWidth,
                              i.clientWidth,
                              s ? s.scrollWidth : 0,
                              s ? s.clientWidth : 0
                          ),
                          r = Ae(
                              i.scrollHeight,
                              i.clientHeight,
                              s ? s.scrollHeight : 0,
                              s ? s.clientHeight : 0
                          ),
                          a = -n.scrollLeft + We(t),
                          l = -n.scrollTop;
                      return (
                          "rtl" === me(s || i).direction &&
                              (a +=
                                  Ae(i.clientWidth, s ? s.clientWidth : 0) - o),
                          { width: o, height: r, x: a, y: l }
                      );
                  })(ve(t))
              );
    }
    function Ke(t, e, i) {
        var n =
                "clippingParents" === e
                    ? (function (t) {
                          var e = ze(be(t)),
                              i =
                                  ["absolute", "fixed"].indexOf(
                                      me(t).position
                                  ) >= 0 && le(t)
                                      ? we(t)
                                      : t;
                          return ae(i)
                              ? e.filter(function (t) {
                                    return (
                                        ae(t) && ge(t, i) && "body" !== oe(t)
                                    );
                                })
                              : [];
                      })(t)
                    : [].concat(e),
            s = [].concat(n, [i]),
            o = s[0],
            r = s.reduce(function (e, i) {
                var n = Fe(t, i);
                return (
                    (e.top = Ae(n.top, e.top)),
                    (e.right = Te(n.right, e.right)),
                    (e.bottom = Te(n.bottom, e.bottom)),
                    (e.left = Ae(n.left, e.left)),
                    e
                );
            }, Fe(t, o));
        return (
            (r.width = r.right - r.left),
            (r.height = r.bottom - r.top),
            (r.x = r.left),
            (r.y = r.top),
            r
        );
    }
    function Ye(t) {
        var e,
            i = t.reference,
            n = t.element,
            s = t.placement,
            o = s ? de(s) : null,
            r = s ? De(s) : null,
            a = i.x + i.width / 2 - n.width / 2,
            l = i.y + i.height / 2 - n.height / 2;
        switch (o) {
            case Mt:
                e = { x: a, y: i.y - n.height };
                break;
            case jt:
                e = { x: a, y: i.y + i.height };
                break;
            case Pt:
                e = { x: i.x + i.width, y: l };
                break;
            case Ht:
                e = { x: i.x - n.width, y: l };
                break;
            default:
                e = { x: i.x, y: i.y };
        }
        var c = o ? Ee(o) : null;
        if (null != c) {
            var h = "y" === c ? "height" : "width";
            switch (r) {
                case Wt:
                    e[c] = e[c] - (i[h] / 2 - n[h] / 2);
                    break;
                case qt:
                    e[c] = e[c] + (i[h] / 2 - n[h] / 2);
            }
        }
        return e;
    }
    function Qe(t, e) {
        void 0 === e && (e = {});
        var i = e,
            n = i.placement,
            s = void 0 === n ? t.placement : n,
            o = i.boundary,
            r = void 0 === o ? Ut : o,
            a = i.rootBoundary,
            l = void 0 === a ? zt : a,
            c = i.elementContext,
            h = void 0 === c ? Vt : c,
            d = i.altBoundary,
            u = void 0 !== d && d,
            f = i.padding,
            p = void 0 === f ? 0 : f,
            g = Ce("number" != typeof p ? p : ke(p, Rt)),
            m = h === Vt ? Ft : Vt,
            _ = t.rects.popper,
            v = t.elements[u ? m : h],
            b = Ke(ae(v) ? v : v.contextElement || ve(t.elements.popper), r, l),
            y = fe(t.elements.reference),
            w = Ye({
                reference: y,
                element: _,
                strategy: "absolute",
                placement: s,
            }),
            E = Ve(Object.assign({}, _, w)),
            A = h === Vt ? E : y,
            T = {
                top: b.top - A.top + g.top,
                bottom: A.bottom - b.bottom + g.bottom,
                left: b.left - A.left + g.left,
                right: A.right - b.right + g.right,
            },
            L = t.modifiersData.offset;
        if (h === Vt && L) {
            var O = L[s];
            Object.keys(T).forEach(function (t) {
                var e = [Pt, jt].indexOf(t) >= 0 ? 1 : -1,
                    i = [Mt, jt].indexOf(t) >= 0 ? "y" : "x";
                T[t] += O[i] * e;
            });
        }
        return T;
    }
    function Xe(t, e) {
        void 0 === e && (e = {});
        var i = e,
            n = i.placement,
            s = i.boundary,
            o = i.rootBoundary,
            r = i.padding,
            a = i.flipVariations,
            l = i.allowedAutoPlacements,
            c = void 0 === l ? Yt : l,
            h = De(n),
            d = h
                ? a
                    ? Kt
                    : Kt.filter(function (t) {
                          return De(t) === h;
                      })
                : Rt,
            u = d.filter(function (t) {
                return c.indexOf(t) >= 0;
            });
        0 === u.length && (u = d);
        var f = u.reduce(function (e, i) {
            return (
                (e[i] = Qe(t, {
                    placement: i,
                    boundary: s,
                    rootBoundary: o,
                    padding: r,
                })[de(i)]),
                e
            );
        }, {});
        return Object.keys(f).sort(function (t, e) {
            return f[t] - f[e];
        });
    }
    var Ge = {
        name: "flip",
        enabled: !0,
        phase: "main",
        fn: function (t) {
            var e = t.state,
                i = t.options,
                n = t.name;
            if (!e.modifiersData[n]._skip) {
                for (
                    var s = i.mainAxis,
                        o = void 0 === s || s,
                        r = i.altAxis,
                        a = void 0 === r || r,
                        l = i.fallbackPlacements,
                        c = i.padding,
                        h = i.boundary,
                        d = i.rootBoundary,
                        u = i.altBoundary,
                        f = i.flipVariations,
                        p = void 0 === f || f,
                        g = i.allowedAutoPlacements,
                        m = e.options.placement,
                        _ = de(m),
                        v =
                            l ||
                            (_ === m || !p
                                ? [Pe(m)]
                                : (function (t) {
                                      if (de(t) === Bt) return [];
                                      var e = Pe(t);
                                      return [Be(t), e, Be(e)];
                                  })(m)),
                        b = [m].concat(v).reduce(function (t, i) {
                            return t.concat(
                                de(i) === Bt
                                    ? Xe(e, {
                                          placement: i,
                                          boundary: h,
                                          rootBoundary: d,
                                          padding: c,
                                          flipVariations: p,
                                          allowedAutoPlacements: g,
                                      })
                                    : i
                            );
                        }, []),
                        y = e.rects.reference,
                        w = e.rects.popper,
                        E = new Map(),
                        A = !0,
                        T = b[0],
                        L = 0;
                    L < b.length;
                    L++
                ) {
                    var O = b[L],
                        C = de(O),
                        k = De(O) === Wt,
                        x = [Mt, jt].indexOf(C) >= 0,
                        D = x ? "width" : "height",
                        N = Qe(e, {
                            placement: O,
                            boundary: h,
                            rootBoundary: d,
                            altBoundary: u,
                            padding: c,
                        }),
                        S = x ? (k ? Pt : Ht) : k ? jt : Mt;
                    y[D] > w[D] && (S = Pe(S));
                    var I = Pe(S),
                        $ = [];
                    if (
                        (o && $.push(N[C] <= 0),
                        a && $.push(N[S] <= 0, N[I] <= 0),
                        $.every(function (t) {
                            return t;
                        }))
                    ) {
                        (T = O), (A = !1);
                        break;
                    }
                    E.set(O, $);
                }
                if (A)
                    for (
                        var M = function (t) {
                                var e = b.find(function (e) {
                                    var i = E.get(e);
                                    if (i)
                                        return i
                                            .slice(0, t)
                                            .every(function (t) {
                                                return t;
                                            });
                                });
                                if (e) return (T = e), "break";
                            },
                            j = p ? 3 : 1;
                        j > 0;
                        j--
                    ) {
                        if ("break" === M(j)) break;
                    }
                e.placement !== T &&
                    ((e.modifiersData[n]._skip = !0),
                    (e.placement = T),
                    (e.reset = !0));
            }
        },
        requiresIfExists: ["offset"],
        data: { _skip: !1 },
    };
    function Ze(t, e, i) {
        return (
            void 0 === i && (i = { x: 0, y: 0 }),
            {
                top: t.top - e.height - i.y,
                right: t.right - e.width + i.x,
                bottom: t.bottom - e.height + i.y,
                left: t.left - e.width - i.x,
            }
        );
    }
    function Je(t) {
        return [Mt, Pt, jt, Ht].some(function (e) {
            return t[e] >= 0;
        });
    }
    var ti = {
        name: "hide",
        enabled: !0,
        phase: "main",
        requiresIfExists: ["preventOverflow"],
        fn: function (t) {
            var e = t.state,
                i = t.name,
                n = e.rects.reference,
                s = e.rects.popper,
                o = e.modifiersData.preventOverflow,
                r = Qe(e, { elementContext: "reference" }),
                a = Qe(e, { altBoundary: !0 }),
                l = Ze(r, n),
                c = Ze(a, s, o),
                h = Je(l),
                d = Je(c);
            (e.modifiersData[i] = {
                referenceClippingOffsets: l,
                popperEscapeOffsets: c,
                isReferenceHidden: h,
                hasPopperEscaped: d,
            }),
                (e.attributes.popper = Object.assign({}, e.attributes.popper, {
                    "data-popper-reference-hidden": h,
                    "data-popper-escaped": d,
                }));
        },
    };
    var ei = {
        name: "offset",
        enabled: !0,
        phase: "main",
        requires: ["popperOffsets"],
        fn: function (t) {
            var e = t.state,
                i = t.options,
                n = t.name,
                s = i.offset,
                o = void 0 === s ? [0, 0] : s,
                r = Yt.reduce(function (t, i) {
                    return (
                        (t[i] = (function (t, e, i) {
                            var n = de(t),
                                s = [Ht, Mt].indexOf(n) >= 0 ? -1 : 1,
                                o =
                                    "function" == typeof i
                                        ? i(
                                              Object.assign({}, e, {
                                                  placement: t,
                                              })
                                          )
                                        : i,
                                r = o[0],
                                a = o[1];
                            return (
                                (r = r || 0),
                                (a = (a || 0) * s),
                                [Ht, Pt].indexOf(n) >= 0
                                    ? { x: a, y: r }
                                    : { x: r, y: a }
                            );
                        })(i, e.rects, o)),
                        t
                    );
                }, {}),
                a = r[e.placement],
                l = a.x,
                c = a.y;
            null != e.modifiersData.popperOffsets &&
                ((e.modifiersData.popperOffsets.x += l),
                (e.modifiersData.popperOffsets.y += c)),
                (e.modifiersData[n] = r);
        },
    };
    var ii = {
        name: "popperOffsets",
        enabled: !0,
        phase: "read",
        fn: function (t) {
            var e = t.state,
                i = t.name;
            e.modifiersData[i] = Ye({
                reference: e.rects.reference,
                element: e.rects.popper,
                strategy: "absolute",
                placement: e.placement,
            });
        },
        data: {},
    };
    var ni = {
        name: "preventOverflow",
        enabled: !0,
        phase: "main",
        fn: function (t) {
            var e = t.state,
                i = t.options,
                n = t.name,
                s = i.mainAxis,
                o = void 0 === s || s,
                r = i.altAxis,
                a = void 0 !== r && r,
                l = i.boundary,
                c = i.rootBoundary,
                h = i.altBoundary,
                d = i.padding,
                u = i.tether,
                f = void 0 === u || u,
                p = i.tetherOffset,
                g = void 0 === p ? 0 : p,
                m = Qe(e, {
                    boundary: l,
                    rootBoundary: c,
                    padding: d,
                    altBoundary: h,
                }),
                _ = de(e.placement),
                v = De(e.placement),
                b = !v,
                y = Ee(_),
                w = "x" === y ? "y" : "x",
                E = e.modifiersData.popperOffsets,
                A = e.rects.reference,
                T = e.rects.popper,
                L =
                    "function" == typeof g
                        ? g(
                              Object.assign({}, e.rects, {
                                  placement: e.placement,
                              })
                          )
                        : g,
                O = { x: 0, y: 0 };
            if (E) {
                if (o || a) {
                    var C = "y" === y ? Mt : Ht,
                        k = "y" === y ? jt : Pt,
                        x = "y" === y ? "height" : "width",
                        D = E[y],
                        N = E[y] + m[C],
                        S = E[y] - m[k],
                        I = f ? -T[x] / 2 : 0,
                        $ = v === Wt ? A[x] : T[x],
                        M = v === Wt ? -T[x] : -A[x],
                        j = e.elements.arrow,
                        P = f && j ? pe(j) : { width: 0, height: 0 },
                        H = e.modifiersData["arrow#persistent"]
                            ? e.modifiersData["arrow#persistent"].padding
                            : { top: 0, right: 0, bottom: 0, left: 0 },
                        B = H[C],
                        R = H[k],
                        W = Oe(0, A[x], P[x]),
                        q = b ? A[x] / 2 - I - W - B - L : $ - W - B - L,
                        U = b ? -A[x] / 2 + I + W + R + L : M + W + R + L,
                        z = e.elements.arrow && we(e.elements.arrow),
                        V = z
                            ? "y" === y
                                ? z.clientTop || 0
                                : z.clientLeft || 0
                            : 0,
                        F = e.modifiersData.offset
                            ? e.modifiersData.offset[e.placement][y]
                            : 0,
                        K = E[y] + q - F - V,
                        Y = E[y] + U - F;
                    if (o) {
                        var Q = Oe(f ? Te(N, K) : N, D, f ? Ae(S, Y) : S);
                        (E[y] = Q), (O[y] = Q - D);
                    }
                    if (a) {
                        var X = "x" === y ? Mt : Ht,
                            G = "x" === y ? jt : Pt,
                            Z = E[w],
                            J = Z + m[X],
                            tt = Z - m[G],
                            et = Oe(f ? Te(J, K) : J, Z, f ? Ae(tt, Y) : tt);
                        (E[w] = et), (O[w] = et - Z);
                    }
                }
                e.modifiersData[n] = O;
            }
        },
        requiresIfExists: ["offset"],
    };
    function si(t, e, i) {
        void 0 === i && (i = !1);
        var n,
            s,
            o = le(e),
            r =
                le(e) &&
                (function (t) {
                    var e = t.getBoundingClientRect(),
                        i = e.width / t.offsetWidth || 1,
                        n = e.height / t.offsetHeight || 1;
                    return 1 !== i || 1 !== n;
                })(e),
            a = ve(e),
            l = fe(t, r),
            c = { scrollLeft: 0, scrollTop: 0 },
            h = { x: 0, y: 0 };
        return (
            (o || (!o && !i)) &&
                (("body" !== oe(e) || qe(a)) &&
                    (c =
                        (n = e) !== re(n) && le(n)
                            ? {
                                  scrollLeft: (s = n).scrollLeft,
                                  scrollTop: s.scrollTop,
                              }
                            : Re(n)),
                le(e)
                    ? (((h = fe(e, !0)).x += e.clientLeft),
                      (h.y += e.clientTop))
                    : a && (h.x = We(a))),
            {
                x: l.left + c.scrollLeft - h.x,
                y: l.top + c.scrollTop - h.y,
                width: l.width,
                height: l.height,
            }
        );
    }
    function oi(t) {
        var e = new Map(),
            i = new Set(),
            n = [];
        function s(t) {
            i.add(t.name),
                []
                    .concat(t.requires || [], t.requiresIfExists || [])
                    .forEach(function (t) {
                        if (!i.has(t)) {
                            var n = e.get(t);
                            n && s(n);
                        }
                    }),
                n.push(t);
        }
        return (
            t.forEach(function (t) {
                e.set(t.name, t);
            }),
            t.forEach(function (t) {
                i.has(t.name) || s(t);
            }),
            n
        );
    }
    var ri = { placement: "bottom", modifiers: [], strategy: "absolute" };
    function ai() {
        for (var t = arguments.length, e = new Array(t), i = 0; i < t; i++)
            e[i] = arguments[i];
        return !e.some(function (t) {
            return !(t && "function" == typeof t.getBoundingClientRect);
        });
    }
    function li(t) {
        void 0 === t && (t = {});
        var e = t,
            i = e.defaultModifiers,
            n = void 0 === i ? [] : i,
            s = e.defaultOptions,
            o = void 0 === s ? ri : s;
        return function (t, e, i) {
            void 0 === i && (i = o);
            var s,
                r,
                a = {
                    placement: "bottom",
                    orderedModifiers: [],
                    options: Object.assign({}, ri, o),
                    modifiersData: {},
                    elements: { reference: t, popper: e },
                    attributes: {},
                    styles: {},
                },
                l = [],
                c = !1,
                h = {
                    state: a,
                    setOptions: function (i) {
                        var s = "function" == typeof i ? i(a.options) : i;
                        d(),
                            (a.options = Object.assign({}, o, a.options, s)),
                            (a.scrollParents = {
                                reference: ae(t)
                                    ? ze(t)
                                    : t.contextElement
                                    ? ze(t.contextElement)
                                    : [],
                                popper: ze(e),
                            });
                        var r,
                            c,
                            u = (function (t) {
                                var e = oi(t);
                                return se.reduce(function (t, i) {
                                    return t.concat(
                                        e.filter(function (t) {
                                            return t.phase === i;
                                        })
                                    );
                                }, []);
                            })(
                                ((r = [].concat(n, a.options.modifiers)),
                                (c = r.reduce(function (t, e) {
                                    var i = t[e.name];
                                    return (
                                        (t[e.name] = i
                                            ? Object.assign({}, i, e, {
                                                  options: Object.assign(
                                                      {},
                                                      i.options,
                                                      e.options
                                                  ),
                                                  data: Object.assign(
                                                      {},
                                                      i.data,
                                                      e.data
                                                  ),
                                              })
                                            : e),
                                        t
                                    );
                                }, {})),
                                Object.keys(c).map(function (t) {
                                    return c[t];
                                }))
                            );
                        return (
                            (a.orderedModifiers = u.filter(function (t) {
                                return t.enabled;
                            })),
                            a.orderedModifiers.forEach(function (t) {
                                var e = t.name,
                                    i = t.options,
                                    n = void 0 === i ? {} : i,
                                    s = t.effect;
                                if ("function" == typeof s) {
                                    var o = s({
                                            state: a,
                                            name: e,
                                            instance: h,
                                            options: n,
                                        }),
                                        r = function () {};
                                    l.push(o || r);
                                }
                            }),
                            h.update()
                        );
                    },
                    forceUpdate: function () {
                        if (!c) {
                            var t = a.elements,
                                e = t.reference,
                                i = t.popper;
                            if (ai(e, i)) {
                                (a.rects = {
                                    reference: si(
                                        e,
                                        we(i),
                                        "fixed" === a.options.strategy
                                    ),
                                    popper: pe(i),
                                }),
                                    (a.reset = !1),
                                    (a.placement = a.options.placement),
                                    a.orderedModifiers.forEach(function (t) {
                                        return (a.modifiersData[t.name] =
                                            Object.assign({}, t.data));
                                    });
                                for (
                                    var n = 0;
                                    n < a.orderedModifiers.length;
                                    n++
                                )
                                    if (!0 !== a.reset) {
                                        var s = a.orderedModifiers[n],
                                            o = s.fn,
                                            r = s.options,
                                            l = void 0 === r ? {} : r,
                                            d = s.name;
                                        "function" == typeof o &&
                                            (a =
                                                o({
                                                    state: a,
                                                    options: l,
                                                    name: d,
                                                    instance: h,
                                                }) || a);
                                    } else (a.reset = !1), (n = -1);
                            }
                        }
                    },
                    update:
                        ((s = function () {
                            return new Promise(function (t) {
                                h.forceUpdate(), t(a);
                            });
                        }),
                        function () {
                            return (
                                r ||
                                    (r = new Promise(function (t) {
                                        Promise.resolve().then(function () {
                                            (r = void 0), t(s());
                                        });
                                    })),
                                r
                            );
                        }),
                    destroy: function () {
                        d(), (c = !0);
                    },
                };
            if (!ai(t, e)) return h;
            function d() {
                l.forEach(function (t) {
                    return t();
                }),
                    (l = []);
            }
            return (
                h.setOptions(i).then(function (t) {
                    !c && i.onFirstUpdate && i.onFirstUpdate(t);
                }),
                h
            );
        };
    }
    var ci = li(),
        hi = li({ defaultModifiers: [Me, ii, Ie, he] }),
        di = li({ defaultModifiers: [Me, ii, Ie, he, ei, Ge, ni, xe, ti] }),
        ui = Object.freeze({
            __proto__: null,
            popperGenerator: li,
            detectOverflow: Qe,
            createPopperBase: ci,
            createPopper: di,
            createPopperLite: hi,
            top: Mt,
            bottom: jt,
            right: Pt,
            left: Ht,
            auto: Bt,
            basePlacements: Rt,
            start: Wt,
            end: qt,
            clippingParents: Ut,
            viewport: zt,
            popper: Vt,
            reference: Ft,
            variationPlacements: Kt,
            placements: Yt,
            beforeRead: Qt,
            read: Xt,
            afterRead: Gt,
            beforeMain: Zt,
            main: Jt,
            afterMain: te,
            beforeWrite: ee,
            write: ie,
            afterWrite: ne,
            modifierPhases: se,
            applyStyles: he,
            arrow: xe,
            computeStyles: Ie,
            eventListeners: Me,
            flip: Ge,
            hide: ti,
            offset: ei,
            popperOffsets: ii,
            preventOverflow: ni,
        });
    const fi = "dropdown",
        pi = ".coreui.dropdown",
        gi = "Escape",
        mi = "Space",
        _i = "ArrowUp",
        vi = "ArrowDown",
        bi = new RegExp("ArrowUp|ArrowDown|Escape"),
        yi = `hide${pi}`,
        wi = `hidden${pi}`,
        Ei = `show${pi}`,
        Ai = `shown${pi}`,
        Ti = `click${pi}`,
        Li = `click${pi}.data-api`,
        Oi = `keydown${pi}.data-api`,
        Ci = `keyup${pi}.data-api`,
        ki = "show",
        xi = '[data-coreui-toggle="dropdown"]',
        Di = ".dropdown-menu",
        Ni = m() ? "top-end" : "top-start",
        Si = m() ? "top-start" : "top-end",
        Ii = m() ? "bottom-end" : "bottom-start",
        $i = m() ? "bottom-start" : "bottom-end",
        Mi = m() ? "left-start" : "right-start",
        ji = m() ? "right-start" : "left-start",
        Pi = {
            offset: [0, 2],
            boundary: "clippingParents",
            reference: "toggle",
            display: "dynamic",
            popperConfig: null,
            autoClose: !0,
        },
        Hi = {
            offset: "(array|string|function)",
            boundary: "(string|element)",
            reference: "(string|element|object)",
            display: "string",
            popperConfig: "(null|object|function)",
            autoClose: "(boolean|string)",
        };
    class Bi extends B {
        constructor(t, e) {
            super(t),
                (this._popper = null),
                (this._config = this._getConfig(e)),
                (this._menu = this._getMenuElement()),
                (this._inNavbar = this._detectNavbar()),
                this._addEventListeners();
        }
        static get Default() {
            return Pi;
        }
        static get DefaultType() {
            return Hi;
        }
        static get NAME() {
            return fi;
        }
        toggle() {
            if (h(this._element)) return;
            this._element.classList.contains(ki) ? this.hide() : this.show();
        }
        show() {
            if (h(this._element) || this._menu.classList.contains(ki)) return;
            const t = Bi.getParentFromElement(this._element),
                e = { relatedTarget: this._element };
            if (!j.trigger(this._element, Ei, e).defaultPrevented) {
                if (this._inNavbar)
                    V.setDataAttribute(this._menu, "popper", "none");
                else {
                    if (void 0 === ui)
                        throw new TypeError(
                            "Bootstrap's dropdowns require Popper (https://popper.js.org)"
                        );
                    let e = this._element;
                    "parent" === this._config.reference
                        ? (e = t)
                        : r(this._config.reference)
                        ? (e = a(this._config.reference))
                        : "object" == typeof this._config.reference &&
                          (e = this._config.reference);
                    const i = this._getPopperConfig(),
                        n = i.modifiers.find(
                            (t) => "applyStyles" === t.name && !1 === t.enabled
                        );
                    (this._popper = di(e, this._menu, i)),
                        n && V.setDataAttribute(this._menu, "popper", "static");
                }
                "ontouchstart" in document.documentElement &&
                    !t.closest(".navbar-nav") &&
                    []
                        .concat(...document.body.children)
                        .forEach((t) => j.on(t, "mouseover", u)),
                    this._element.focus(),
                    this._element.setAttribute("aria-expanded", !0),
                    this._menu.classList.toggle(ki),
                    this._element.classList.toggle(ki),
                    j.trigger(this._element, Ai, e);
            }
        }
        hide() {
            if (h(this._element) || !this._menu.classList.contains(ki)) return;
            const t = { relatedTarget: this._element };
            this._completeHide(t);
        }
        dispose() {
            this._popper && this._popper.destroy(), super.dispose();
        }
        update() {
            (this._inNavbar = this._detectNavbar()),
                this._popper && this._popper.update();
        }
        _addEventListeners() {
            j.on(this._element, Ti, (t) => {
                t.preventDefault(), this.toggle();
            });
        }
        _completeHide(t) {
            j.trigger(this._element, yi, t).defaultPrevented ||
                ("ontouchstart" in document.documentElement &&
                    []
                        .concat(...document.body.children)
                        .forEach((t) => j.off(t, "mouseover", u)),
                this._popper && this._popper.destroy(),
                this._menu.classList.remove(ki),
                this._element.classList.remove(ki),
                this._element.setAttribute("aria-expanded", "false"),
                V.removeDataAttribute(this._menu, "popper"),
                j.trigger(this._element, wi, t));
        }
        _getConfig(t) {
            if (
                ((t = {
                    ...this.constructor.Default,
                    ...V.getDataAttributes(this._element),
                    ...t,
                }),
                l(fi, t, this.constructor.DefaultType),
                "object" == typeof t.reference &&
                    !r(t.reference) &&
                    "function" != typeof t.reference.getBoundingClientRect)
            )
                throw new TypeError(
                    `${fi.toUpperCase()}: Option "reference" provided type "object" without a required "getBoundingClientRect" method.`
                );
            return t;
        }
        _getMenuElement() {
            return t.next(this._element, Di)[0];
        }
        _getPlacement() {
            const t = this._element.parentNode;
            if (t.classList.contains("dropend")) return Mi;
            if (t.classList.contains("dropstart")) return ji;
            const e =
                "end" ===
                getComputedStyle(this._menu)
                    .getPropertyValue("--cui-position")
                    .trim();
            return t.classList.contains("dropup") ? (e ? Si : Ni) : e ? $i : Ii;
        }
        _detectNavbar() {
            return null !== this._element.closest(".navbar");
        }
        _getOffset() {
            const { offset: t } = this._config;
            return "string" == typeof t
                ? t.split(",").map((t) => Number.parseInt(t, 10))
                : "function" == typeof t
                ? (e) => t(e, this._element)
                : t;
        }
        _getPopperConfig() {
            const t = {
                placement: this._getPlacement(),
                modifiers: [
                    {
                        name: "preventOverflow",
                        options: { boundary: this._config.boundary },
                    },
                    { name: "offset", options: { offset: this._getOffset() } },
                ],
            };
            return (
                "static" === this._config.display &&
                    (t.modifiers = [{ name: "applyStyles", enabled: !1 }]),
                {
                    ...t,
                    ...("function" == typeof this._config.popperConfig
                        ? this._config.popperConfig(t)
                        : this._config.popperConfig),
                }
            );
        }
        _selectMenuItem({ key: e, target: i }) {
            const n = t
                .find(
                    ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
                    this._menu
                )
                .filter(c);
            n.length && y(n, i, e === vi, !n.includes(i)).focus();
        }
        static dropdownInterface(t, e) {
            const i = Bi.getOrCreateInstance(t, e);
            if ("string" == typeof e) {
                if (void 0 === i[e])
                    throw new TypeError(`No method named "${e}"`);
                i[e]();
            }
        }
        static jQueryInterface(t) {
            return this.each(function () {
                Bi.dropdownInterface(this, t);
            });
        }
        static clearMenus(e) {
            if (
                e &&
                (2 === e.button || ("keyup" === e.type && "Tab" !== e.key))
            )
                return;
            const i = t.find(xi);
            for (let t = 0, n = i.length; t < n; t++) {
                const n = Bi.getInstance(i[t]);
                if (!n || !1 === n._config.autoClose) continue;
                if (!n._element.classList.contains(ki)) continue;
                const s = { relatedTarget: n._element };
                if (e) {
                    const t = e.composedPath(),
                        i = t.includes(n._menu);
                    if (
                        t.includes(n._element) ||
                        ("inside" === n._config.autoClose && !i) ||
                        ("outside" === n._config.autoClose && i)
                    )
                        continue;
                    if (
                        n._menu.contains(e.target) &&
                        (("keyup" === e.type && "Tab" === e.key) ||
                            /input|select|option|textarea|form/i.test(
                                e.target.tagName
                            ))
                    )
                        continue;
                    "click" === e.type && (s.clickEvent = e);
                }
                n._completeHide(s);
            }
        }
        static getParentFromElement(t) {
            return s(t) || t.parentNode;
        }
        static dataApiKeydownHandler(e) {
            if (
                /input|textarea/i.test(e.target.tagName)
                    ? e.key === mi ||
                      (e.key !== gi &&
                          ((e.key !== vi && e.key !== _i) ||
                              e.target.closest(Di)))
                    : !bi.test(e.key)
            )
                return;
            const i = this.classList.contains(ki);
            if (!i && e.key === gi) return;
            if ((e.preventDefault(), e.stopPropagation(), h(this))) return;
            const n = () => (this.matches(xi) ? this : t.prev(this, xi)[0]);
            return e.key === gi
                ? (n().focus(), void Bi.clearMenus())
                : e.key === _i || e.key === vi
                ? (i || n().click(),
                  void Bi.getInstance(n())._selectMenuItem(e))
                : void ((i && e.key !== mi) || Bi.clearMenus());
        }
    }
    j.on(document, Oi, xi, Bi.dataApiKeydownHandler),
        j.on(document, Oi, Di, Bi.dataApiKeydownHandler),
        j.on(document, Li, Bi.clearMenus),
        j.on(document, Ci, Bi.clearMenus),
        j.on(document, Li, xi, function (t) {
            t.preventDefault(), Bi.dropdownInterface(this);
        }),
        _(Bi);
    const Ri = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        Wi = ".sticky-top";
    class qi {
        constructor() {
            this._element = document.body;
        }
        getWidth() {
            const t = document.documentElement.clientWidth;
            return Math.abs(window.innerWidth - t);
        }
        hide() {
            const t = this.getWidth();
            this._disableOverFlow(),
                this._setElementAttributes(
                    this._element,
                    "paddingRight",
                    (e) => e + t
                ),
                this._setElementAttributes(Ri, "paddingRight", (e) => e + t),
                this._setElementAttributes(Wi, "marginRight", (e) => e - t);
        }
        _disableOverFlow() {
            this._saveInitialAttribute(this._element, "overflow"),
                (this._element.style.overflow = "hidden");
        }
        _setElementAttributes(t, e, i) {
            const n = this.getWidth();
            this._applyManipulationCallback(t, (t) => {
                if (
                    t !== this._element &&
                    window.innerWidth > t.clientWidth + n
                )
                    return;
                this._saveInitialAttribute(t, e);
                const s = window.getComputedStyle(t)[e];
                t.style[e] = `${i(Number.parseFloat(s))}px`;
            });
        }
        reset() {
            this._resetElementAttributes(this._element, "overflow"),
                this._resetElementAttributes(this._element, "paddingRight"),
                this._resetElementAttributes(Ri, "paddingRight"),
                this._resetElementAttributes(Wi, "marginRight");
        }
        _saveInitialAttribute(t, e) {
            const i = t.style[e];
            i && V.setDataAttribute(t, e, i);
        }
        _resetElementAttributes(t, e) {
            this._applyManipulationCallback(t, (t) => {
                const i = V.getDataAttribute(t, e);
                void 0 === i
                    ? t.style.removeProperty(e)
                    : (V.removeDataAttribute(t, e), (t.style[e] = i));
            });
        }
        _applyManipulationCallback(e, i) {
            r(e) ? i(e) : t.find(e, this._element).forEach(i);
        }
        isOverflowing() {
            return this.getWidth() > 0;
        }
    }
    const Ui = {
            isVisible: !0,
            isAnimated: !1,
            rootElement: "body",
            clickCallback: null,
        },
        zi = {
            isVisible: "boolean",
            isAnimated: "boolean",
            rootElement: "(element|string)",
            clickCallback: "(function|null)",
        },
        Vi = "backdrop",
        Fi = "show",
        Ki = "mousedown.coreui.backdrop";
    class Yi {
        constructor(t) {
            (this._config = this._getConfig(t)),
                (this._isAppended = !1),
                (this._element = null);
        }
        show(t) {
            this._config.isVisible
                ? (this._append(),
                  this._config.isAnimated && f(this._getElement()),
                  this._getElement().classList.add(Fi),
                  this._emulateAnimation(() => {
                      v(t);
                  }))
                : v(t);
        }
        hide(t) {
            this._config.isVisible
                ? (this._getElement().classList.remove(Fi),
                  this._emulateAnimation(() => {
                      this.dispose(), v(t);
                  }))
                : v(t);
        }
        _getElement() {
            if (!this._element) {
                const t = document.createElement("div");
                (t.className = "modal-backdrop"),
                    this._config.isAnimated && t.classList.add("fade"),
                    (this._element = t);
            }
            return this._element;
        }
        _getConfig(t) {
            return (
                ((t = {
                    ...Ui,
                    ...("object" == typeof t ? t : {}),
                }).rootElement = a(t.rootElement)),
                l(Vi, t, zi),
                t
            );
        }
        _append() {
            this._isAppended ||
                (this._config.rootElement.appendChild(this._getElement()),
                j.on(this._getElement(), Ki, () => {
                    v(this._config.clickCallback);
                }),
                (this._isAppended = !0));
        }
        dispose() {
            this._isAppended &&
                (j.off(this._element, Ki),
                this._element.remove(),
                (this._isAppended = !1));
        }
        _emulateAnimation(t) {
            b(t, this._getElement(), this._config.isAnimated);
        }
    }
    const Qi = "modal",
        Xi = ".coreui.modal",
        Gi = "Escape",
        Zi = { backdrop: !0, keyboard: !0, focus: !0 },
        Ji = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            focus: "boolean",
        },
        tn = "hidden.coreui.modal",
        en = "show.coreui.modal",
        nn = "focusin.coreui.modal",
        sn = "resize.coreui.modal",
        on = "click.dismiss.coreui.modal",
        rn = "keydown.dismiss.coreui.modal",
        an = "mousedown.dismiss.coreui.modal",
        ln = "modal-open",
        cn = "show",
        hn = "modal-static";
    class dn extends B {
        constructor(e, i) {
            super(e),
                (this._config = this._getConfig(i)),
                (this._dialog = t.findOne(".modal-dialog", this._element)),
                (this._backdrop = this._initializeBackDrop()),
                (this._isShown = !1),
                (this._ignoreBackdropClick = !1),
                (this._isTransitioning = !1),
                (this._scrollBar = new qi());
        }
        static get Default() {
            return Zi;
        }
        static get NAME() {
            return Qi;
        }
        toggle(t) {
            return this._isShown ? this.hide() : this.show(t);
        }
        show(t) {
            if (this._isShown || this._isTransitioning) return;
            j.trigger(this._element, en, { relatedTarget: t })
                .defaultPrevented ||
                ((this._isShown = !0),
                this._isAnimated() && (this._isTransitioning = !0),
                this._scrollBar.hide(),
                document.body.classList.add(ln),
                this._adjustDialog(),
                this._setEscapeEvent(),
                this._setResizeEvent(),
                j.on(this._element, on, '[data-coreui-dismiss="modal"]', (t) =>
                    this.hide(t)
                ),
                j.on(this._dialog, an, () => {
                    j.one(
                        this._element,
                        "mouseup.dismiss.coreui.modal",
                        (t) => {
                            t.target === this._element &&
                                (this._ignoreBackdropClick = !0);
                        }
                    );
                }),
                this._showBackdrop(() => this._showElement(t)));
        }
        hide(t) {
            if (
                (t &&
                    ["A", "AREA"].includes(t.target.tagName) &&
                    t.preventDefault(),
                !this._isShown || this._isTransitioning)
            )
                return;
            if (j.trigger(this._element, "hide.coreui.modal").defaultPrevented)
                return;
            this._isShown = !1;
            const e = this._isAnimated();
            e && (this._isTransitioning = !0),
                this._setEscapeEvent(),
                this._setResizeEvent(),
                j.off(document, nn),
                this._element.classList.remove(cn),
                j.off(this._element, on),
                j.off(this._dialog, an),
                this._queueCallback(() => this._hideModal(), this._element, e);
        }
        dispose() {
            [window, this._dialog].forEach((t) => j.off(t, Xi)),
                this._backdrop.dispose(),
                super.dispose(),
                j.off(document, nn);
        }
        handleUpdate() {
            this._adjustDialog();
        }
        _initializeBackDrop() {
            return new Yi({
                isVisible: Boolean(this._config.backdrop),
                isAnimated: this._isAnimated(),
            });
        }
        _getConfig(t) {
            return (
                (t = {
                    ...Zi,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t ? t : {}),
                }),
                l(Qi, t, Ji),
                t
            );
        }
        _showElement(e) {
            const i = this._isAnimated(),
                n = t.findOne(".modal-body", this._dialog);
            (this._element.parentNode &&
                this._element.parentNode.nodeType === Node.ELEMENT_NODE) ||
                document.body.appendChild(this._element),
                (this._element.style.display = "block"),
                this._element.removeAttribute("aria-hidden"),
                this._element.setAttribute("aria-modal", !0),
                this._element.setAttribute("role", "dialog"),
                (this._element.scrollTop = 0),
                n && (n.scrollTop = 0),
                i && f(this._element),
                this._element.classList.add(cn),
                this._config.focus && this._enforceFocus();
            this._queueCallback(
                () => {
                    this._config.focus && this._element.focus(),
                        (this._isTransitioning = !1),
                        j.trigger(this._element, "shown.coreui.modal", {
                            relatedTarget: e,
                        });
                },
                this._dialog,
                i
            );
        }
        _enforceFocus() {
            j.off(document, nn),
                j.on(document, nn, (t) => {
                    document === t.target ||
                        this._element === t.target ||
                        this._element.contains(t.target) ||
                        this._element.focus();
                });
        }
        _setEscapeEvent() {
            this._isShown
                ? j.on(this._element, rn, (t) => {
                      this._config.keyboard && t.key === Gi
                          ? (t.preventDefault(), this.hide())
                          : this._config.keyboard ||
                            t.key !== Gi ||
                            this._triggerBackdropTransition();
                  })
                : j.off(this._element, rn);
        }
        _setResizeEvent() {
            this._isShown
                ? j.on(window, sn, () => this._adjustDialog())
                : j.off(window, sn);
        }
        _hideModal() {
            (this._element.style.display = "none"),
                this._element.setAttribute("aria-hidden", !0),
                this._element.removeAttribute("aria-modal"),
                this._element.removeAttribute("role"),
                (this._isTransitioning = !1),
                this._backdrop.hide(() => {
                    document.body.classList.remove(ln),
                        this._resetAdjustments(),
                        this._scrollBar.reset(),
                        j.trigger(this._element, tn);
                });
        }
        _showBackdrop(t) {
            j.on(this._element, on, (t) => {
                this._ignoreBackdropClick
                    ? (this._ignoreBackdropClick = !1)
                    : t.target === t.currentTarget &&
                      (!0 === this._config.backdrop
                          ? this.hide()
                          : "static" === this._config.backdrop &&
                            this._triggerBackdropTransition());
            }),
                this._backdrop.show(t);
        }
        _isAnimated() {
            return this._element.classList.contains("fade");
        }
        _triggerBackdropTransition() {
            if (
                j.trigger(this._element, "hidePrevented.coreui.modal")
                    .defaultPrevented
            )
                return;
            const { classList: t, scrollHeight: e, style: i } = this._element,
                n = e > document.documentElement.clientHeight;
            (!n && "hidden" === i.overflowY) ||
                t.contains(hn) ||
                (n || (i.overflowY = "hidden"),
                t.add(hn),
                this._queueCallback(() => {
                    t.remove(hn),
                        n ||
                            this._queueCallback(() => {
                                i.overflowY = "";
                            }, this._dialog);
                }, this._dialog),
                this._element.focus());
        }
        _adjustDialog() {
            const t =
                    this._element.scrollHeight >
                    document.documentElement.clientHeight,
                e = this._scrollBar.getWidth(),
                i = e > 0;
            ((!i && t && !m()) || (i && !t && m())) &&
                (this._element.style.paddingLeft = `${e}px`),
                ((i && !t && !m()) || (!i && t && m())) &&
                    (this._element.style.paddingRight = `${e}px`);
        }
        _resetAdjustments() {
            (this._element.style.paddingLeft = ""),
                (this._element.style.paddingRight = "");
        }
        static jQueryInterface(t, e) {
            return this.each(function () {
                const i = dn.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === i[t])
                        throw new TypeError(`No method named "${t}"`);
                    i[t](e);
                }
            });
        }
    }
    j.on(
        document,
        "click.coreui.modal.data-api",
        '[data-coreui-toggle="modal"]',
        function (t) {
            const e = s(this);
            ["A", "AREA"].includes(this.tagName) && t.preventDefault(),
                j.one(e, en, (t) => {
                    t.defaultPrevented ||
                        j.one(e, tn, () => {
                            c(this) && this.focus();
                        });
                });
            dn.getOrCreateInstance(e).toggle(this);
        }
    ),
        _(dn);
    const un = "navigation",
        fn = "coreui.navigation",
        pn = `.${fn}`,
        gn = { activeLinksExact: !0, groupsAutoCollapse: !0 },
        mn = {
            activeLinksExact: "boolean",
            groupsAutoCollapse: "(string|boolean)",
        },
        _n = "active",
        vn = "show",
        bn = "nav-group-toggle",
        yn = `click${pn}.data-api`,
        wn = `load${pn}.data-api`,
        En = ".nav-group",
        An = ".nav-group-items",
        Tn = ".nav-group-toggle";
    class Ln extends B {
        constructor(t, e) {
            super(t),
                (this._config = this._getConfig(e)),
                this._setActiveLink(),
                this._addEventListeners(),
                H.set(t, fn, this);
        }
        static get Default() {
            return gn;
        }
        static get DATA_KEY() {
            return fn;
        }
        static get DefaultType() {
            return mn;
        }
        static get NAME() {
            return un;
        }
        _getConfig(t) {
            return (
                (t = {
                    ...gn,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t ? t : {}),
                }),
                l(un, t, mn),
                t
            );
        }
        _setActiveLink() {
            Array.from(this._element.querySelectorAll(".nav-link")).forEach(
                (t) => {
                    if (t.classList.contains(bn)) return;
                    let e = String(window.location);
                    (/\?.*=/.test(e) || /\?./.test(e)) && (e = e.split("?")[0]),
                        /#./.test(e) && (e = e.split("#")[0]),
                        this._config.activeLinksExact &&
                            t.href === e &&
                            (t.classList.add(_n),
                            Array.from(this._getParents(t, En)).forEach((t) => {
                                t.classList.add(vn),
                                    t.setAttribute("aria-expanded", !0);
                            })),
                        !this._config.activeLinksExact &&
                            t.href.startsWith(e) &&
                            (t.classList.add(_n),
                            Array.from(this._getParents(t, En)).forEach((t) => {
                                t.classList.add(vn),
                                    t.setAttribute("aria-expanded", !0);
                            }));
                }
            );
        }
        _getParents(t, e) {
            const i = [];
            for (; t && t !== document; t = t.parentNode)
                e ? t.matches(e) && i.push(t) : i.push(t);
            return i;
        }
        _getAllSiblings(t, e) {
            const i = [];
            t = t.parentNode.firstChild;
            do {
                3 !== t.nodeType &&
                    8 !== t.nodeType &&
                    ((e && !e(t)) || i.push(t));
            } while ((t = t.nextSibling));
            return i;
        }
        _getChildren(t, e) {
            const i = [];
            for (; t; t = t.nextSibling)
                1 === t.nodeType && t !== e && i.push(t);
            return i;
        }
        _getSiblings(t, e) {
            return this._getChildren(t.parentNode.firstChild, t).filter(e);
        }
        _slideDown(t) {
            t.style.height = "auto";
            const e = t.clientHeight;
            (t.style.height = "0px"),
                setTimeout(() => {
                    t.style.height = `${e}px`;
                }, 0),
                this._queueCallback(
                    () => {
                        t.style.height = "auto";
                    },
                    t,
                    !0
                );
        }
        _slideUp(t, e) {
            const i = t.clientHeight;
            (t.style.height = `${i}px`),
                setTimeout(() => {
                    t.style.height = "0px";
                }, 0),
                this._queueCallback(
                    () => {
                        "function" == typeof e && e();
                    },
                    t,
                    !0
                );
        }
        _toggleGroupItems(e) {
            let i = e.target;
            i.classList.contains(bn) || (i = i.closest(Tn));
            const n = (t) =>
                Boolean(
                    t.classList.contains("nav-group") &&
                        t.classList.contains(vn)
                );
            !0 === this._config.groupsAutoCollapse &&
                this._getSiblings(i.parentNode, n).forEach((e) => {
                    this._slideUp(t.findOne(An, e), () => {
                        e.classList.remove(vn),
                            e.setAttribute("aria-expanded", !1);
                    });
                }),
                i.parentNode.classList.contains(vn)
                    ? this._slideUp(t.findOne(An, i.parentNode), () => {
                          i.parentNode.classList.remove(vn),
                              i.parentNode.setAttribute("aria-expanded", !1);
                      })
                    : (i.parentNode.classList.add(vn),
                      i.parentNode.setAttribute("aria-expanded", !0),
                      this._slideDown(t.findOne(An, i.parentNode)));
        }
        _addEventListeners() {
            j.on(this._element, yn, Tn, (t) => {
                t.preventDefault(), this._toggleGroupItems(t, this);
            });
        }
        static navigationInterface(t, e) {
            const i = Ln.getOrCreateInstance(t, e);
            if ("string" == typeof e) {
                if (void 0 === i[e])
                    throw new TypeError(`No method named "${e}"`);
                i[e]();
            }
        }
        static jQueryInterface(t) {
            return this.each(function () {
                Ln.navigationInterface(this, t);
            });
        }
    }
    j.on(window, wn, () => {
        Array.from(
            document.querySelectorAll('[data-coreui="navigation"]')
        ).forEach((t) => {
            Ln.navigationInterface(t);
        });
    }),
        _(Ln);
    const On = "offcanvas",
        Cn = ".coreui.offcanvas",
        kn = `load${Cn}.data-api`,
        xn = { backdrop: !0, keyboard: !0, scroll: !1 },
        Dn = { backdrop: "boolean", keyboard: "boolean", scroll: "boolean" },
        Nn = "show",
        Sn = ".offcanvas.show",
        In = `show${Cn}`,
        $n = `shown${Cn}`,
        Mn = `hide${Cn}`,
        jn = `hidden${Cn}`,
        Pn = `focusin${Cn}`,
        Hn = `click${Cn}.data-api`,
        Bn = `click.dismiss${Cn}`,
        Rn = `keydown.dismiss${Cn}`;
    class Wn extends B {
        constructor(t, e) {
            super(t),
                (this._config = this._getConfig(e)),
                (this._isShown = !1),
                (this._backdrop = this._initializeBackDrop()),
                this._addEventListeners();
        }
        static get NAME() {
            return On;
        }
        static get Default() {
            return xn;
        }
        toggle(t) {
            return this._isShown ? this.hide() : this.show(t);
        }
        show(t) {
            if (this._isShown) return;
            if (
                j.trigger(this._element, In, { relatedTarget: t })
                    .defaultPrevented
            )
                return;
            (this._isShown = !0),
                (this._element.style.visibility = "visible"),
                this._backdrop.show(),
                this._config.scroll ||
                    (new qi().hide(),
                    this._enforceFocusOnElement(this._element)),
                this._element.removeAttribute("aria-hidden"),
                this._element.setAttribute("aria-modal", !0),
                this._element.setAttribute("role", "dialog"),
                this._element.classList.add(Nn);
            this._queueCallback(
                () => {
                    j.trigger(this._element, $n, { relatedTarget: t });
                },
                this._element,
                !0
            );
        }
        hide() {
            if (!this._isShown) return;
            if (j.trigger(this._element, Mn).defaultPrevented) return;
            j.off(document, Pn),
                this._element.blur(),
                (this._isShown = !1),
                this._element.classList.remove(Nn),
                this._backdrop.hide();
            this._queueCallback(
                () => {
                    this._element.setAttribute("aria-hidden", !0),
                        this._element.removeAttribute("aria-modal"),
                        this._element.removeAttribute("role"),
                        (this._element.style.visibility = "hidden"),
                        this._config.scroll || new qi().reset(),
                        j.trigger(this._element, jn);
                },
                this._element,
                !0
            );
        }
        dispose() {
            this._backdrop.dispose(), super.dispose(), j.off(document, Pn);
        }
        _getConfig(t) {
            return (
                (t = {
                    ...xn,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t ? t : {}),
                }),
                l(On, t, Dn),
                t
            );
        }
        _initializeBackDrop() {
            return new Yi({
                isVisible: this._config.backdrop,
                isAnimated: !0,
                rootElement: this._element.parentNode,
                clickCallback: () => this.hide(),
            });
        }
        _enforceFocusOnElement(t) {
            j.off(document, Pn),
                j.on(document, Pn, (e) => {
                    document === e.target ||
                        t === e.target ||
                        t.contains(e.target) ||
                        t.focus();
                }),
                t.focus();
        }
        _addEventListeners() {
            j.on(this._element, Bn, '[data-coreui-dismiss="offcanvas"]', () =>
                this.hide()
            ),
                j.on(this._element, Rn, (t) => {
                    this._config.keyboard && "Escape" === t.key && this.hide();
                });
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Wn.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (
                        void 0 === e[t] ||
                        t.startsWith("_") ||
                        "constructor" === t
                    )
                        throw new TypeError(`No method named "${t}"`);
                    e[t](this);
                }
            });
        }
    }
    j.on(document, Hn, '[data-coreui-toggle="offcanvas"]', function (e) {
        const i = s(this);
        if (
            (["A", "AREA"].includes(this.tagName) && e.preventDefault(),
            h(this))
        )
            return;
        j.one(i, jn, () => {
            c(this) && this.focus();
        });
        const n = t.findOne(Sn);
        n && n !== i && Wn.getInstance(n).hide();
        Wn.getOrCreateInstance(i).toggle(this);
    }),
        j.on(window, kn, () =>
            t.find(Sn).forEach((t) => Wn.getOrCreateInstance(t).show())
        ),
        _(Wn);
    const qn = new Set([
            "background",
            "cite",
            "href",
            "itemtype",
            "longdesc",
            "poster",
            "src",
            "xlink:href",
        ]),
        Un = /^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/i,
        zn =
            /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i,
        Vn = (t, e) => {
            const i = t.nodeName.toLowerCase();
            if (e.includes(i))
                return (
                    !qn.has(i) ||
                    Boolean(Un.test(t.nodeValue) || zn.test(t.nodeValue))
                );
            const n = e.filter((t) => t instanceof RegExp);
            for (let t = 0, e = n.length; t < e; t++)
                if (n[t].test(i)) return !0;
            return !1;
        },
        Fn = {
            "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
            a: ["target", "href", "title", "rel"],
            area: [],
            b: [],
            br: [],
            col: [],
            code: [],
            div: [],
            em: [],
            hr: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            i: [],
            img: ["src", "srcset", "alt", "title", "width", "height"],
            li: [],
            ol: [],
            p: [],
            pre: [],
            s: [],
            small: [],
            span: [],
            sub: [],
            sup: [],
            strong: [],
            u: [],
            ul: [],
        };
    function Kn(t, e, i) {
        if (!t.length) return t;
        if (i && "function" == typeof i) return i(t);
        const n = new window.DOMParser().parseFromString(t, "text/html"),
            s = Object.keys(e),
            o = [].concat(...n.body.querySelectorAll("*"));
        for (let t = 0, i = o.length; t < i; t++) {
            const i = o[t],
                n = i.nodeName.toLowerCase();
            if (!s.includes(n)) {
                i.remove();
                continue;
            }
            const r = [].concat(...i.attributes),
                a = [].concat(e["*"] || [], e[n] || []);
            r.forEach((t) => {
                Vn(t, a) || i.removeAttribute(t.nodeName);
            });
        }
        return n.body.innerHTML;
    }
    const Yn = "tooltip",
        Qn = ".coreui.tooltip",
        Xn = new RegExp("(^|\\s)bs-tooltip\\S+", "g"),
        Gn = new Set(["sanitize", "allowList", "sanitizeFn"]),
        Zn = {
            animation: "boolean",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
            delay: "(number|object)",
            html: "boolean",
            selector: "(string|boolean)",
            placement: "(string|function)",
            offset: "(array|string|function)",
            container: "(string|element|boolean)",
            fallbackPlacements: "array",
            boundary: "(string|element)",
            customClass: "(string|function)",
            sanitize: "boolean",
            sanitizeFn: "(null|function)",
            allowList: "object",
            popperConfig: "(null|object|function)",
        },
        Jn = {
            AUTO: "auto",
            TOP: "top",
            RIGHT: m() ? "left" : "right",
            BOTTOM: "bottom",
            LEFT: m() ? "right" : "left",
        },
        ts = {
            animation: !0,
            template:
                '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            selector: !1,
            placement: "top",
            offset: [0, 0],
            container: !1,
            fallbackPlacements: ["top", "right", "bottom", "left"],
            boundary: "clippingParents",
            customClass: "",
            sanitize: !0,
            sanitizeFn: null,
            allowList: Fn,
            popperConfig: null,
        },
        es = {
            HIDE: `hide${Qn}`,
            HIDDEN: `hidden${Qn}`,
            SHOW: `show${Qn}`,
            SHOWN: `shown${Qn}`,
            INSERTED: `inserted${Qn}`,
            CLICK: `click${Qn}`,
            FOCUSIN: `focusin${Qn}`,
            FOCUSOUT: `focusout${Qn}`,
            MOUSEENTER: `mouseenter${Qn}`,
            MOUSELEAVE: `mouseleave${Qn}`,
        },
        is = "fade",
        ns = "show",
        ss = "show",
        os = "out",
        rs = "hover",
        as = "focus";
    class ls extends B {
        constructor(t, e) {
            if (void 0 === ui)
                throw new TypeError(
                    "Bootstrap's tooltips require Popper (https://popper.js.org)"
                );
            super(t),
                (this._isEnabled = !0),
                (this._timeout = 0),
                (this._hoverState = ""),
                (this._activeTrigger = {}),
                (this._popper = null),
                (this._config = this._getConfig(e)),
                (this.tip = null),
                this._setListeners();
        }
        static get Default() {
            return ts;
        }
        static get NAME() {
            return Yn;
        }
        static get Event() {
            return es;
        }
        static get DefaultType() {
            return Zn;
        }
        enable() {
            this._isEnabled = !0;
        }
        disable() {
            this._isEnabled = !1;
        }
        toggleEnabled() {
            this._isEnabled = !this._isEnabled;
        }
        toggle(t) {
            if (this._isEnabled)
                if (t) {
                    const e = this._initializeOnDelegatedTarget(t);
                    (e._activeTrigger.click = !e._activeTrigger.click),
                        e._isWithActiveTrigger()
                            ? e._enter(null, e)
                            : e._leave(null, e);
                } else {
                    if (this.getTipElement().classList.contains(ns))
                        return void this._leave(null, this);
                    this._enter(null, this);
                }
        }
        dispose() {
            clearTimeout(this._timeout),
                j.off(
                    this._element.closest(".modal"),
                    "hide.coreui.modal",
                    this._hideModalHandler
                ),
                this.tip && this.tip.remove(),
                this._popper && this._popper.destroy(),
                super.dispose();
        }
        show() {
            if ("none" === this._element.style.display)
                throw new Error("Please use show on visible elements");
            if (!this.isWithContent() || !this._isEnabled) return;
            const t = j.trigger(this._element, this.constructor.Event.SHOW),
                e = d(this._element),
                i =
                    null === e
                        ? this._element.ownerDocument.documentElement.contains(
                              this._element
                          )
                        : e.contains(this._element);
            if (t.defaultPrevented || !i) return;
            const n = this.getTipElement(),
                s = ((t) => {
                    do {
                        t += Math.floor(1e6 * Math.random());
                    } while (document.getElementById(t));
                    return t;
                })(this.constructor.NAME);
            n.setAttribute("id", s),
                this._element.setAttribute("aria-describedby", s),
                this.setContent(),
                this._config.animation && n.classList.add(is);
            const o =
                    "function" == typeof this._config.placement
                        ? this._config.placement.call(this, n, this._element)
                        : this._config.placement,
                r = this._getAttachment(o);
            this._addAttachmentClass(r);
            const { container: a } = this._config;
            H.set(n, this.constructor.DATA_KEY, this),
                this._element.ownerDocument.documentElement.contains(
                    this.tip
                ) ||
                    (a.appendChild(n),
                    j.trigger(this._element, this.constructor.Event.INSERTED)),
                this._popper
                    ? this._popper.update()
                    : (this._popper = di(
                          this._element,
                          n,
                          this._getPopperConfig(r)
                      )),
                n.classList.add(ns);
            const l =
                "function" == typeof this._config.customClass
                    ? this._config.customClass()
                    : this._config.customClass;
            l && n.classList.add(...l.split(" ")),
                "ontouchstart" in document.documentElement &&
                    [].concat(...document.body.children).forEach((t) => {
                        j.on(t, "mouseover", u);
                    });
            const c = this.tip.classList.contains(is);
            this._queueCallback(
                () => {
                    const t = this._hoverState;
                    (this._hoverState = null),
                        j.trigger(this._element, this.constructor.Event.SHOWN),
                        t === os && this._leave(null, this);
                },
                this.tip,
                c
            );
        }
        hide() {
            if (!this._popper) return;
            const t = this.getTipElement();
            if (
                j.trigger(this._element, this.constructor.Event.HIDE)
                    .defaultPrevented
            )
                return;
            t.classList.remove(ns),
                "ontouchstart" in document.documentElement &&
                    []
                        .concat(...document.body.children)
                        .forEach((t) => j.off(t, "mouseover", u)),
                (this._activeTrigger.click = !1),
                (this._activeTrigger.focus = !1),
                (this._activeTrigger.hover = !1);
            const e = this.tip.classList.contains(is);
            this._queueCallback(
                () => {
                    this._isWithActiveTrigger() ||
                        (this._hoverState !== ss && t.remove(),
                        this._cleanTipClass(),
                        this._element.removeAttribute("aria-describedby"),
                        j.trigger(this._element, this.constructor.Event.HIDDEN),
                        this._popper &&
                            (this._popper.destroy(), (this._popper = null)));
                },
                this.tip,
                e
            ),
                (this._hoverState = "");
        }
        update() {
            null !== this._popper && this._popper.update();
        }
        isWithContent() {
            return Boolean(this.getTitle());
        }
        getTipElement() {
            if (this.tip) return this.tip;
            const t = document.createElement("div");
            return (
                (t.innerHTML = this._config.template),
                (this.tip = t.children[0]),
                this.tip
            );
        }
        setContent() {
            const e = this.getTipElement();
            this.setElementContent(
                t.findOne(".tooltip-inner", e),
                this.getTitle()
            ),
                e.classList.remove(is, ns);
        }
        setElementContent(t, e) {
            if (null !== t)
                return r(e)
                    ? ((e = a(e)),
                      void (this._config.html
                          ? e.parentNode !== t &&
                            ((t.innerHTML = ""), t.appendChild(e))
                          : (t.textContent = e.textContent)))
                    : void (this._config.html
                          ? (this._config.sanitize &&
                                (e = Kn(
                                    e,
                                    this._config.allowList,
                                    this._config.sanitizeFn
                                )),
                            (t.innerHTML = e))
                          : (t.textContent = e));
        }
        getTitle() {
            let t = this._element.getAttribute("data-coreui-original-title");
            return (
                t ||
                    (t =
                        "function" == typeof this._config.title
                            ? this._config.title.call(this._element)
                            : this._config.title),
                t
            );
        }
        updateAttachment(t) {
            return "right" === t ? "end" : "left" === t ? "start" : t;
        }
        _initializeOnDelegatedTarget(t, e) {
            const i = this.constructor.DATA_KEY;
            return (
                (e = e || H.get(t.delegateTarget, i)) ||
                    ((e = new this.constructor(
                        t.delegateTarget,
                        this._getDelegateConfig()
                    )),
                    H.set(t.delegateTarget, i, e)),
                e
            );
        }
        _getOffset() {
            const { offset: t } = this._config;
            return "string" == typeof t
                ? t.split(",").map((t) => Number.parseInt(t, 10))
                : "function" == typeof t
                ? (e) => t(e, this._element)
                : t;
        }
        _getPopperConfig(t) {
            const e = {
                placement: t,
                modifiers: [
                    {
                        name: "flip",
                        options: {
                            fallbackPlacements: this._config.fallbackPlacements,
                        },
                    },
                    { name: "offset", options: { offset: this._getOffset() } },
                    {
                        name: "preventOverflow",
                        options: { boundary: this._config.boundary },
                    },
                    {
                        name: "arrow",
                        options: { element: `.${this.constructor.NAME}-arrow` },
                    },
                    {
                        name: "onChange",
                        enabled: !0,
                        phase: "afterWrite",
                        fn: (t) => this._handlePopperPlacementChange(t),
                    },
                ],
                onFirstUpdate: (t) => {
                    t.options.placement !== t.placement &&
                        this._handlePopperPlacementChange(t);
                },
            };
            return {
                ...e,
                ...("function" == typeof this._config.popperConfig
                    ? this._config.popperConfig(e)
                    : this._config.popperConfig),
            };
        }
        _addAttachmentClass(t) {
            this.getTipElement().classList.add(
                `bs-tooltip-${this.updateAttachment(t)}`
            );
        }
        _getAttachment(t) {
            return Jn[t.toUpperCase()];
        }
        _setListeners() {
            this._config.trigger.split(" ").forEach((t) => {
                if ("click" === t)
                    j.on(
                        this._element,
                        this.constructor.Event.CLICK,
                        this._config.selector,
                        (t) => this.toggle(t)
                    );
                else if ("manual" !== t) {
                    const e =
                            t === rs
                                ? this.constructor.Event.MOUSEENTER
                                : this.constructor.Event.FOCUSIN,
                        i =
                            t === rs
                                ? this.constructor.Event.MOUSELEAVE
                                : this.constructor.Event.FOCUSOUT;
                    j.on(this._element, e, this._config.selector, (t) =>
                        this._enter(t)
                    ),
                        j.on(this._element, i, this._config.selector, (t) =>
                            this._leave(t)
                        );
                }
            }),
                (this._hideModalHandler = () => {
                    this._element && this.hide();
                }),
                j.on(
                    this._element.closest(".modal"),
                    "hide.coreui.modal",
                    this._hideModalHandler
                ),
                this._config.selector
                    ? (this._config = {
                          ...this._config,
                          trigger: "manual",
                          selector: "",
                      })
                    : this._fixTitle();
        }
        _fixTitle() {
            const t = this._element.getAttribute("title"),
                e = typeof this._element.getAttribute(
                    "data-coreui-original-title"
                );
            (t || "string" !== e) &&
                (this._element.setAttribute(
                    "data-coreui-original-title",
                    t || ""
                ),
                !t ||
                    this._element.getAttribute("aria-label") ||
                    this._element.textContent ||
                    this._element.setAttribute("aria-label", t),
                this._element.setAttribute("title", ""));
        }
        _enter(t, e) {
            (e = this._initializeOnDelegatedTarget(t, e)),
                t && (e._activeTrigger["focusin" === t.type ? as : rs] = !0),
                e.getTipElement().classList.contains(ns) || e._hoverState === ss
                    ? (e._hoverState = ss)
                    : (clearTimeout(e._timeout),
                      (e._hoverState = ss),
                      e._config.delay && e._config.delay.show
                          ? (e._timeout = setTimeout(() => {
                                e._hoverState === ss && e.show();
                            }, e._config.delay.show))
                          : e.show());
        }
        _leave(t, e) {
            (e = this._initializeOnDelegatedTarget(t, e)),
                t &&
                    (e._activeTrigger["focusout" === t.type ? as : rs] =
                        e._element.contains(t.relatedTarget)),
                e._isWithActiveTrigger() ||
                    (clearTimeout(e._timeout),
                    (e._hoverState = os),
                    e._config.delay && e._config.delay.hide
                        ? (e._timeout = setTimeout(() => {
                              e._hoverState === os && e.hide();
                          }, e._config.delay.hide))
                        : e.hide());
        }
        _isWithActiveTrigger() {
            for (const t in this._activeTrigger)
                if (this._activeTrigger[t]) return !0;
            return !1;
        }
        _getConfig(t) {
            const e = V.getDataAttributes(this._element);
            return (
                Object.keys(e).forEach((t) => {
                    Gn.has(t) && delete e[t];
                }),
                ((t = {
                    ...this.constructor.Default,
                    ...e,
                    ...("object" == typeof t && t ? t : {}),
                }).container =
                    !1 === t.container ? document.body : a(t.container)),
                "number" == typeof t.delay &&
                    (t.delay = { show: t.delay, hide: t.delay }),
                "number" == typeof t.title && (t.title = t.title.toString()),
                "number" == typeof t.content &&
                    (t.content = t.content.toString()),
                l(Yn, t, this.constructor.DefaultType),
                t.sanitize &&
                    (t.template = Kn(t.template, t.allowList, t.sanitizeFn)),
                t
            );
        }
        _getDelegateConfig() {
            const t = {};
            if (this._config)
                for (const e in this._config)
                    this.constructor.Default[e] !== this._config[e] &&
                        (t[e] = this._config[e]);
            return t;
        }
        _cleanTipClass() {
            const t = this.getTipElement(),
                e = t.getAttribute("class").match(Xn);
            null !== e &&
                e.length > 0 &&
                e.map((t) => t.trim()).forEach((e) => t.classList.remove(e));
        }
        _handlePopperPlacementChange(t) {
            const { state: e } = t;
            e &&
                ((this.tip = e.elements.popper),
                this._cleanTipClass(),
                this._addAttachmentClass(this._getAttachment(e.placement)));
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = ls.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    _(ls);
    const cs = ".coreui.popover",
        hs = new RegExp("(^|\\s)bs-popover\\S+", "g"),
        ds = {
            ...ls.Default,
            placement: "right",
            offset: [0, 8],
            trigger: "click",
            content: "",
            template:
                '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        },
        us = { ...ls.DefaultType, content: "(string|element|function)" },
        fs = {
            HIDE: `hide${cs}`,
            HIDDEN: `hidden${cs}`,
            SHOW: `show${cs}`,
            SHOWN: `shown${cs}`,
            INSERTED: `inserted${cs}`,
            CLICK: `click${cs}`,
            FOCUSIN: `focusin${cs}`,
            FOCUSOUT: `focusout${cs}`,
            MOUSEENTER: `mouseenter${cs}`,
            MOUSELEAVE: `mouseleave${cs}`,
        },
        ps = ".popover-header",
        gs = ".popover-body";
    class ms extends ls {
        static get Default() {
            return ds;
        }
        static get NAME() {
            return "popover";
        }
        static get Event() {
            return fs;
        }
        static get DefaultType() {
            return us;
        }
        isWithContent() {
            return this.getTitle() || this._getContent();
        }
        getTipElement() {
            return (
                this.tip ||
                    ((this.tip = super.getTipElement()),
                    this.getTitle() || t.findOne(ps, this.tip).remove(),
                    this._getContent() || t.findOne(gs, this.tip).remove()),
                this.tip
            );
        }
        setContent() {
            const e = this.getTipElement();
            this.setElementContent(t.findOne(ps, e), this.getTitle());
            let i = this._getContent();
            "function" == typeof i && (i = i.call(this._element)),
                this.setElementContent(t.findOne(gs, e), i),
                e.classList.remove("fade", "show");
        }
        _addAttachmentClass(t) {
            this.getTipElement().classList.add(
                `bs-popover-${this.updateAttachment(t)}`
            );
        }
        _getContent() {
            return (
                this._element.getAttribute("data-coreui-content") ||
                this._config.content
            );
        }
        _cleanTipClass() {
            const t = this.getTipElement(),
                e = t.getAttribute("class").match(hs);
            null !== e &&
                e.length > 0 &&
                e.map((t) => t.trim()).forEach((e) => t.classList.remove(e));
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = ms.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    _(ms);
    const _s = "scrollspy",
        vs = ".coreui.scrollspy",
        bs = { offset: 10, method: "auto", target: "" },
        ys = { offset: "number", method: "string", target: "(string|element)" },
        ws = `activate${vs}`,
        Es = `scroll${vs}`,
        As = `load${vs}.data-api`,
        Ts = "dropdown-item",
        Ls = "active",
        Os = ".nav-link",
        Cs = ".nav-link, .list-group-item, .dropdown-item",
        ks = "position";
    class xs extends B {
        constructor(t, e) {
            super(t),
                (this._scrollElement =
                    "BODY" === this._element.tagName ? window : this._element),
                (this._config = this._getConfig(e)),
                (this._offsets = []),
                (this._targets = []),
                (this._activeTarget = null),
                (this._scrollHeight = 0),
                j.on(this._scrollElement, Es, () => this._process()),
                this.refresh(),
                this._process();
        }
        static get Default() {
            return bs;
        }
        static get NAME() {
            return _s;
        }
        refresh() {
            const e =
                    this._scrollElement === this._scrollElement.window
                        ? "offset"
                        : ks,
                i = "auto" === this._config.method ? e : this._config.method,
                s = i === ks ? this._getScrollTop() : 0;
            (this._offsets = []),
                (this._targets = []),
                (this._scrollHeight = this._getScrollHeight());
            t.find(Cs, this._config.target)
                .map((e) => {
                    const o = n(e),
                        r = o ? t.findOne(o) : null;
                    if (r) {
                        const t = r.getBoundingClientRect();
                        if (t.width || t.height) return [V[i](r).top + s, o];
                    }
                    return null;
                })
                .filter((t) => t)
                .sort((t, e) => t[0] - e[0])
                .forEach((t) => {
                    this._offsets.push(t[0]), this._targets.push(t[1]);
                });
        }
        dispose() {
            j.off(this._scrollElement, vs), super.dispose();
        }
        _getConfig(t) {
            return (
                ((t = {
                    ...bs,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t && t ? t : {}),
                }).target = a(t.target) || document.documentElement),
                l(_s, t, ys),
                t
            );
        }
        _getScrollTop() {
            return this._scrollElement === window
                ? this._scrollElement.pageYOffset
                : this._scrollElement.scrollTop;
        }
        _getScrollHeight() {
            return (
                this._scrollElement.scrollHeight ||
                Math.max(
                    document.body.scrollHeight,
                    document.documentElement.scrollHeight
                )
            );
        }
        _getOffsetHeight() {
            return this._scrollElement === window
                ? window.innerHeight
                : this._scrollElement.getBoundingClientRect().height;
        }
        _process() {
            const t = this._getScrollTop() + this._config.offset,
                e = this._getScrollHeight(),
                i = this._config.offset + e - this._getOffsetHeight();
            if ((this._scrollHeight !== e && this.refresh(), t >= i)) {
                const t = this._targets[this._targets.length - 1];
                this._activeTarget !== t && this._activate(t);
            } else {
                if (
                    this._activeTarget &&
                    t < this._offsets[0] &&
                    this._offsets[0] > 0
                )
                    return (this._activeTarget = null), void this._clear();
                for (let e = this._offsets.length; e--; ) {
                    this._activeTarget !== this._targets[e] &&
                        t >= this._offsets[e] &&
                        (void 0 === this._offsets[e + 1] ||
                            t < this._offsets[e + 1]) &&
                        this._activate(this._targets[e]);
                }
            }
        }
        _activate(e) {
            (this._activeTarget = e), this._clear();
            const i = Cs.split(",").map(
                    (t) => `${t}[data-coreui-target="${e}"],${t}[href="${e}"]`
                ),
                n = t.findOne(i.join(","), this._config.target);
            n.classList.add(Ls),
                n.classList.contains(Ts)
                    ? t
                          .findOne(".dropdown-toggle", n.closest(".dropdown"))
                          .classList.add(Ls)
                    : t.parents(n, ".nav, .list-group").forEach((e) => {
                          t
                              .prev(e, ".nav-link, .list-group-item")
                              .forEach((t) => t.classList.add(Ls)),
                              t.prev(e, ".nav-item").forEach((e) => {
                                  t.children(e, Os).forEach((t) =>
                                      t.classList.add(Ls)
                                  );
                              });
                      }),
                j.trigger(this._scrollElement, ws, { relatedTarget: e });
        }
        _clear() {
            t.find(Cs, this._config.target)
                .filter((t) => t.classList.contains(Ls))
                .forEach((t) => t.classList.remove(Ls));
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = xs.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    j.on(window, As, () => {
        t.find('[data-coreui-spy="scroll"]').forEach((t) => new xs(t));
    }),
        _(xs);
    const Ds = "sidebar",
        Ns = ".coreui.sidebar",
        Ss = {},
        Is = {},
        $s = "hide",
        Ms = "show",
        js = "sidebar-narrow",
        Ps = "sidebar-narrow-unfoldable",
        Hs = `hide${Ns}`,
        Bs = `hidden${Ns}`,
        Rs = `show${Ns}`,
        Ws = `shown${Ns}`,
        qs = `click${Ns}.data-api`,
        Us = `load${Ns}.data-api`,
        zs = ".sidebar";
    class Vs extends B {
        constructor(t, e) {
            super(t),
                (this._config = this._getConfig(e)),
                (this._show = this._isVisible()),
                (this._mobile = this._isMobile()),
                (this._overlaid = this._isOverlaid()),
                (this._narrow = this._isNarrow()),
                (this._unfoldable = this._isUnfoldable()),
                (this._backdrop = null),
                this._addEventListeners();
        }
        static get Default() {
            return Ss;
        }
        static get DefaultType() {
            return Is;
        }
        static get NAME() {
            return Ds;
        }
        show() {
            j.trigger(this._element, Rs),
                this._element.classList.contains($s) &&
                    this._element.classList.remove($s),
                this._isMobile() &&
                    (this._element.classList.add(Ms), this._showBackdrop());
            this._queueCallback(
                () => {
                    !0 === this._isVisible() &&
                        ((this._show = !0),
                        (this._isMobile() || this._isOverlaid()) &&
                            this._addClickOutListener(),
                        j.trigger(this._element, Ws));
                },
                this._element,
                !0
            );
        }
        hide() {
            j.trigger(this._element, Hs),
                this._element.classList.contains(Ms) &&
                    this._element.classList.remove(Ms),
                this._isMobile()
                    ? this._removeBackdrop()
                    : this._element.classList.add($s);
            this._queueCallback(
                () => {
                    !1 === this._isVisible() &&
                        ((this._show = !1),
                        (this._isMobile() || this._isOverlaid()) &&
                            this._removeClickOutListener(),
                        j.trigger(this._element, Bs));
                },
                this._element,
                !0
            );
        }
        toggle() {
            this._isVisible() ? this.hide() : this.show();
        }
        narrow() {
            this._isMobile() || (this._addClassName(js), (this._narrow = !0));
        }
        unfoldable() {
            this._isMobile() ||
                (this._addClassName(Ps), (this._unfoldable = !0));
        }
        reset() {
            this._isMobile() ||
                (this._narrow &&
                    (this._element.classList.remove(js), (this._narrow = !1)),
                this._unfoldable &&
                    (this._element.classList.remove(Ps),
                    (this._unfoldable = !1)));
        }
        toggleNarrow() {
            this._narrow ? this.reset() : this.narrow();
        }
        toggleUnfoldable() {
            this._unfoldable ? this.reset() : this.unfoldable();
        }
        _getConfig(t) {
            return (
                (t = {
                    ...Ss,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t ? t : {}),
                }),
                l(Ds, t, Is),
                t
            );
        }
        _isMobile() {
            return Boolean(
                window
                    .getComputedStyle(this._element, null)
                    .getPropertyValue("--cui-is-mobile")
            );
        }
        _isNarrow() {
            return this._element.classList.contains(js);
        }
        _isOverlaid() {
            return this._element.classList.contains("sidebar-overlaid");
        }
        _isUnfoldable() {
            return this._element.classList.contains(Ps);
        }
        _isVisible() {
            const t = this._element.getBoundingClientRect();
            return (
                t.top >= 0 &&
                t.left >= 0 &&
                t.bottom <=
                    (window.innerHeight ||
                        document.documentElement.clientHeight) &&
                t.right <=
                    (window.innerWidth || document.documentElement.clientWidth)
            );
        }
        _addClassName(t) {
            this._element.classList.add(t);
        }
        _removeBackdrop() {
            this._backdrop &&
                (this._backdrop.parentNode.removeChild(this._backdrop),
                (this._backdrop = null));
        }
        _showBackdrop() {
            this._backdrop ||
                ((this._backdrop = document.createElement("div")),
                (this._backdrop.className = "sidebar-backdrop"),
                this._backdrop.classList.add("fade"),
                document.body.appendChild(this._backdrop),
                f(this._backdrop),
                this._backdrop.classList.add(Ms));
        }
        _clickOutListener(t, e) {
            null === t.target.closest(zs) &&
                (t.preventDefault(), t.stopPropagation(), e.hide());
        }
        _addClickOutListener() {
            j.on(document, qs, (t) => {
                this._clickOutListener(t, this);
            });
        }
        _removeClickOutListener() {
            j.off(document, qs);
        }
        _addEventListeners() {
            this._mobile && this._show && this._addClickOutListener(),
                this._overlaid && this._show && this._addClickOutListener(),
                j.on(this._element, qs, "[data-coreui-toggle]", (t) => {
                    t.preventDefault();
                    const e = V.getDataAttribute(t.target, "toggle");
                    "narrow" === e && this.toggleNarrow(),
                        "unfoldable" === e && this.toggleUnfoldable();
                }),
                j.on(
                    this._element,
                    qs,
                    '[data-coreui-close="sidebar"]',
                    (t) => {
                        t.preventDefault(), this.hide();
                    }
                ),
                j.on(window, "resize", () => {
                    this._isMobile() && this._isVisible() && this.hide();
                });
        }
        static sidebarInterface(t, e) {
            const i = Vs.getOrCreateInstance(t, e);
            if ("string" == typeof e) {
                if (void 0 === i[e])
                    throw new TypeError(`No method named "${e}"`);
                i[e]();
            }
        }
        static jQueryInterface(t) {
            return this.each(function () {
                Vs.sidebarInterface(this, t);
            });
        }
    }
    j.on(window, Us, () => {
        Array.from(document.querySelectorAll(zs)).forEach((t) => {
            Vs.sidebarInterface(t);
        });
    }),
        _(Vs);
    const Fs = "active",
        Ks = "fade",
        Ys = "show",
        Qs = ".active",
        Xs = ":scope > li > .active";
    class Gs extends B {
        static get NAME() {
            return "tab";
        }
        show() {
            if (
                this._element.parentNode &&
                this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
                this._element.classList.contains(Fs)
            )
                return;
            let e;
            const i = s(this._element),
                n = this._element.closest(".nav, .list-group");
            if (n) {
                const i = "UL" === n.nodeName || "OL" === n.nodeName ? Xs : Qs;
                (e = t.find(i, n)), (e = e[e.length - 1]);
            }
            const o = e
                ? j.trigger(e, "hide.coreui.tab", {
                      relatedTarget: this._element,
                  })
                : null;
            if (
                j.trigger(this._element, "show.coreui.tab", {
                    relatedTarget: e,
                }).defaultPrevented ||
                (null !== o && o.defaultPrevented)
            )
                return;
            this._activate(this._element, n);
            const r = () => {
                j.trigger(e, "hidden.coreui.tab", {
                    relatedTarget: this._element,
                }),
                    j.trigger(this._element, "shown.coreui.tab", {
                        relatedTarget: e,
                    });
            };
            i ? this._activate(i, i.parentNode, r) : r();
        }
        _activate(e, i, n) {
            const s = (
                    !i || ("UL" !== i.nodeName && "OL" !== i.nodeName)
                        ? t.children(i, Qs)
                        : t.find(Xs, i)
                )[0],
                o = n && s && s.classList.contains(Ks),
                r = () => this._transitionComplete(e, s, n);
            s && o
                ? (s.classList.remove(Ys), this._queueCallback(r, e, !0))
                : r();
        }
        _transitionComplete(e, i, n) {
            if (i) {
                i.classList.remove(Fs);
                const e = t.findOne(
                    ":scope > .dropdown-menu .active",
                    i.parentNode
                );
                e && e.classList.remove(Fs),
                    "tab" === i.getAttribute("role") &&
                        i.setAttribute("aria-selected", !1);
            }
            e.classList.add(Fs),
                "tab" === e.getAttribute("role") &&
                    e.setAttribute("aria-selected", !0),
                f(e),
                e.classList.contains(Ks) && e.classList.add(Ys);
            let s = e.parentNode;
            if (
                (s && "LI" === s.nodeName && (s = s.parentNode),
                s && s.classList.contains("dropdown-menu"))
            ) {
                const i = e.closest(".dropdown");
                i &&
                    t
                        .find(".dropdown-toggle", i)
                        .forEach((t) => t.classList.add(Fs)),
                    e.setAttribute("aria-expanded", !0);
            }
            n && n();
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Gs.getOrCreateInstance(this);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    j.on(
        document,
        "click.coreui.tab.data-api",
        '[data-coreui-toggle="tab"], [data-coreui-toggle="pill"], [data-coreui-toggle="list"]',
        function (t) {
            if (
                (["A", "AREA"].includes(this.tagName) && t.preventDefault(),
                h(this))
            )
                return;
            Gs.getOrCreateInstance(this).show();
        }
    ),
        _(Gs);
    const Zs = "toast",
        Js = ".coreui.toast",
        to = `click.dismiss${Js}`,
        eo = `mouseover${Js}`,
        io = `mouseout${Js}`,
        no = `focusin${Js}`,
        so = `focusout${Js}`,
        oo = `hide${Js}`,
        ro = `hidden${Js}`,
        ao = `show${Js}`,
        lo = `shown${Js}`,
        co = "hide",
        ho = "show",
        uo = "showing",
        fo = { animation: "boolean", autohide: "boolean", delay: "number" },
        po = { animation: !0, autohide: !0, delay: 5e3 };
    class go extends B {
        constructor(t, e) {
            super(t),
                (this._config = this._getConfig(e)),
                (this._timeout = null),
                (this._hasMouseInteraction = !1),
                (this._hasKeyboardInteraction = !1),
                this._setListeners();
        }
        static get DefaultType() {
            return fo;
        }
        static get Default() {
            return po;
        }
        static get NAME() {
            return Zs;
        }
        show() {
            if (j.trigger(this._element, ao).defaultPrevented) return;
            this._clearTimeout(),
                this._config.animation && this._element.classList.add("fade");
            this._element.classList.remove(co),
                f(this._element),
                this._element.classList.add(uo),
                this._queueCallback(
                    () => {
                        this._element.classList.remove(uo),
                            this._element.classList.add(ho),
                            j.trigger(this._element, lo),
                            this._maybeScheduleHide();
                    },
                    this._element,
                    this._config.animation
                );
        }
        hide() {
            if (!this._element.classList.contains(ho)) return;
            if (j.trigger(this._element, oo).defaultPrevented) return;
            this._element.classList.remove(ho),
                this._queueCallback(
                    () => {
                        this._element.classList.add(co),
                            j.trigger(this._element, ro);
                    },
                    this._element,
                    this._config.animation
                );
        }
        dispose() {
            this._clearTimeout(),
                this._element.classList.contains(ho) &&
                    this._element.classList.remove(ho),
                super.dispose();
        }
        _getConfig(t) {
            return (
                (t = {
                    ...po,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof t && t ? t : {}),
                }),
                l(Zs, t, this.constructor.DefaultType),
                t
            );
        }
        _maybeScheduleHide() {
            this._config.autohide &&
                (this._hasMouseInteraction ||
                    this._hasKeyboardInteraction ||
                    (this._timeout = setTimeout(() => {
                        this.hide();
                    }, this._config.delay)));
        }
        _onInteraction(t, e) {
            switch (t.type) {
                case "mouseover":
                case "mouseout":
                    this._hasMouseInteraction = e;
                    break;
                case "focusin":
                case "focusout":
                    this._hasKeyboardInteraction = e;
            }
            if (e) return void this._clearTimeout();
            const i = t.relatedTarget;
            this._element === i ||
                this._element.contains(i) ||
                this._maybeScheduleHide();
        }
        _setListeners() {
            j.on(this._element, to, '[data-coreui-dismiss="toast"]', () =>
                this.hide()
            ),
                j.on(this._element, eo, (t) => this._onInteraction(t, !0)),
                j.on(this._element, io, (t) => this._onInteraction(t, !1)),
                j.on(this._element, no, (t) => this._onInteraction(t, !0)),
                j.on(this._element, so, (t) => this._onInteraction(t, !1));
        }
        _clearTimeout() {
            clearTimeout(this._timeout), (this._timeout = null);
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = go.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t](this);
                }
            });
        }
    }
    return (
        _(go),
        {
            Alert: R,
            Button: q,
            Carousel: _t,
            Collapse: $t,
            Dropdown: Bi,
            Modal: dn,
            Navigation: Ln,
            OffCanvas: Wn,
            Popover: ms,
            ScrollSpy: xs,
            Sidebar: Vs,
            Tab: Gs,
            Toast: go,
            Tooltip: ls,
        }
    );
});
//# sourceMappingURL=coreui.bundle.min.js.map
