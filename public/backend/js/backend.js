/*! For license information please see backend.js.LICENSE.txt */
(self.webpackChunk = self.webpackChunk || []).push([
    [757],
    {
        39: (t, e, n) => {
            "use strict";
            function i(t) {
                var e = t.getBoundingClientRect();
                return {
                    width: e.width,
                    height: e.height,
                    top: e.top,
                    right: e.right,
                    bottom: e.bottom,
                    left: e.left,
                    x: e.left,
                    y: e.top,
                };
            }
            function o(t) {
                if (null == t) return window;
                if ("[object Window]" !== t.toString()) {
                    var e = t.ownerDocument;
                    return (e && e.defaultView) || window;
                }
                return t;
            }
            function r(t) {
                var e = o(t);
                return { scrollLeft: e.pageXOffset, scrollTop: e.pageYOffset };
            }
            function s(t) {
                return t instanceof o(t).Element || t instanceof Element;
            }
            function a(t) {
                return (
                    t instanceof o(t).HTMLElement || t instanceof HTMLElement
                );
            }
            function l(t) {
                return (
                    "undefined" != typeof ShadowRoot &&
                    (t instanceof o(t).ShadowRoot || t instanceof ShadowRoot)
                );
            }
            function c(t) {
                return t ? (t.nodeName || "").toLowerCase() : null;
            }
            function u(t) {
                return (
                    (s(t) ? t.ownerDocument : t.document) || window.document
                ).documentElement;
            }
            function f(t) {
                return i(u(t)).left + r(t).scrollLeft;
            }
            function h(t) {
                return o(t).getComputedStyle(t);
            }
            function d(t) {
                var e = h(t),
                    n = e.overflow,
                    i = e.overflowX,
                    o = e.overflowY;
                return /auto|scroll|overlay|hidden/.test(n + o + i);
            }
            function p(t, e, n) {
                void 0 === n && (n = !1);
                var s,
                    l,
                    h = u(e),
                    p = i(t),
                    g = a(e),
                    m = { scrollLeft: 0, scrollTop: 0 },
                    v = { x: 0, y: 0 };
                return (
                    (g || (!g && !n)) &&
                        (("body" !== c(e) || d(h)) &&
                            (m =
                                (s = e) !== o(s) && a(s)
                                    ? {
                                          scrollLeft: (l = s).scrollLeft,
                                          scrollTop: l.scrollTop,
                                      }
                                    : r(s)),
                        a(e)
                            ? (((v = i(e)).x += e.clientLeft),
                              (v.y += e.clientTop))
                            : h && (v.x = f(h))),
                    {
                        x: p.left + m.scrollLeft - v.x,
                        y: p.top + m.scrollTop - v.y,
                        width: p.width,
                        height: p.height,
                    }
                );
            }
            function g(t) {
                var e = i(t),
                    n = t.offsetWidth,
                    o = t.offsetHeight;
                return (
                    Math.abs(e.width - n) <= 1 && (n = e.width),
                    Math.abs(e.height - o) <= 1 && (o = e.height),
                    { x: t.offsetLeft, y: t.offsetTop, width: n, height: o }
                );
            }
            function m(t) {
                return "html" === c(t)
                    ? t
                    : t.assignedSlot ||
                          t.parentNode ||
                          (l(t) ? t.host : null) ||
                          u(t);
            }
            function v(t) {
                return ["html", "body", "#document"].indexOf(c(t)) >= 0
                    ? t.ownerDocument.body
                    : a(t) && d(t)
                    ? t
                    : v(m(t));
            }
            function _(t, e) {
                var n;
                void 0 === e && (e = []);
                var i = v(t),
                    r = i === (null == (n = t.ownerDocument) ? void 0 : n.body),
                    s = o(i),
                    a = r
                        ? [s].concat(s.visualViewport || [], d(i) ? i : [])
                        : i,
                    l = e.concat(a);
                return r ? l : l.concat(_(m(a)));
            }
            function b(t) {
                return ["table", "td", "th"].indexOf(c(t)) >= 0;
            }
            function y(t) {
                return a(t) && "fixed" !== h(t).position
                    ? t.offsetParent
                    : null;
            }
            function w(t) {
                for (
                    var e = o(t), n = y(t);
                    n && b(n) && "static" === h(n).position;

                )
                    n = y(n);
                return n &&
                    ("html" === c(n) ||
                        ("body" === c(n) && "static" === h(n).position))
                    ? e
                    : n ||
                          (function (t) {
                              var e =
                                  -1 !==
                                  navigator.userAgent
                                      .toLowerCase()
                                      .indexOf("firefox");
                              if (
                                  -1 !==
                                      navigator.userAgent.indexOf("Trident") &&
                                  a(t) &&
                                  "fixed" === h(t).position
                              )
                                  return null;
                              for (
                                  var n = m(t);
                                  a(n) && ["html", "body"].indexOf(c(n)) < 0;

                              ) {
                                  var i = h(n);
                                  if (
                                      "none" !== i.transform ||
                                      "none" !== i.perspective ||
                                      "paint" === i.contain ||
                                      -1 !==
                                          ["transform", "perspective"].indexOf(
                                              i.willChange
                                          ) ||
                                      (e && "filter" === i.willChange) ||
                                      (e && i.filter && "none" !== i.filter)
                                  )
                                      return n;
                                  n = n.parentNode;
                              }
                              return null;
                          })(t) ||
                          e;
            }
            n.r(e),
                n.d(e, {
                    Alert: () => Ue,
                    AsyncLoad: () => Ye,
                    Button: () => Ze,
                    Carousel: () => vn,
                    ClassToggler: () => On,
                    Collapse: () => Mn,
                    Dropdown: () => li,
                    Modal: () => xi,
                    Popover: () => co,
                    Scrollspy: () => Eo,
                    Sidebar: () => Mo,
                    Tab: () => Ko,
                    Toast: () => ar,
                    Tooltip: () => Zi,
                });
            var E = "top",
                L = "bottom",
                k = "right",
                T = "left",
                C = "auto",
                O = [E, L, k, T],
                A = "start",
                S = "end",
                x = "viewport",
                D = "popper",
                N = O.reduce(function (t, e) {
                    return t.concat([e + "-" + A, e + "-" + S]);
                }, []),
                I = [].concat(O, [C]).reduce(function (t, e) {
                    return t.concat([e, e + "-" + A, e + "-" + S]);
                }, []),
                j = [
                    "beforeRead",
                    "read",
                    "afterRead",
                    "beforeMain",
                    "main",
                    "afterMain",
                    "beforeWrite",
                    "write",
                    "afterWrite",
                ];
            function R(t) {
                var e = new Map(),
                    n = new Set(),
                    i = [];
                function o(t) {
                    n.add(t.name),
                        []
                            .concat(t.requires || [], t.requiresIfExists || [])
                            .forEach(function (t) {
                                if (!n.has(t)) {
                                    var i = e.get(t);
                                    i && o(i);
                                }
                            }),
                        i.push(t);
                }
                return (
                    t.forEach(function (t) {
                        e.set(t.name, t);
                    }),
                    t.forEach(function (t) {
                        n.has(t.name) || o(t);
                    }),
                    i
                );
            }
            var P = {
                placement: "bottom",
                modifiers: [],
                strategy: "absolute",
            };
            function H() {
                for (
                    var t = arguments.length, e = new Array(t), n = 0;
                    n < t;
                    n++
                )
                    e[n] = arguments[n];
                return !e.some(function (t) {
                    return !(t && "function" == typeof t.getBoundingClientRect);
                });
            }
            function W(t) {
                void 0 === t && (t = {});
                var e = t,
                    n = e.defaultModifiers,
                    i = void 0 === n ? [] : n,
                    o = e.defaultOptions,
                    r = void 0 === o ? P : o;
                return function (t, e, n) {
                    void 0 === n && (n = r);
                    var o,
                        a,
                        l = {
                            placement: "bottom",
                            orderedModifiers: [],
                            options: Object.assign({}, P, r),
                            modifiersData: {},
                            elements: { reference: t, popper: e },
                            attributes: {},
                            styles: {},
                        },
                        c = [],
                        u = !1,
                        f = {
                            state: l,
                            setOptions: function (n) {
                                h(),
                                    (l.options = Object.assign(
                                        {},
                                        r,
                                        l.options,
                                        n
                                    )),
                                    (l.scrollParents = {
                                        reference: s(t)
                                            ? _(t)
                                            : t.contextElement
                                            ? _(t.contextElement)
                                            : [],
                                        popper: _(e),
                                    });
                                var o = (function (t) {
                                    var e = R(t);
                                    return j.reduce(function (t, n) {
                                        return t.concat(
                                            e.filter(function (t) {
                                                return t.phase === n;
                                            })
                                        );
                                    }, []);
                                })(
                                    (function (t) {
                                        var e = t.reduce(function (t, e) {
                                            var n = t[e.name];
                                            return (
                                                (t[e.name] = n
                                                    ? Object.assign({}, n, e, {
                                                          options:
                                                              Object.assign(
                                                                  {},
                                                                  n.options,
                                                                  e.options
                                                              ),
                                                          data: Object.assign(
                                                              {},
                                                              n.data,
                                                              e.data
                                                          ),
                                                      })
                                                    : e),
                                                t
                                            );
                                        }, {});
                                        return Object.keys(e).map(function (t) {
                                            return e[t];
                                        });
                                    })([].concat(i, l.options.modifiers))
                                );
                                return (
                                    (l.orderedModifiers = o.filter(function (
                                        t
                                    ) {
                                        return t.enabled;
                                    })),
                                    l.orderedModifiers.forEach(function (t) {
                                        var e = t.name,
                                            n = t.options,
                                            i = void 0 === n ? {} : n,
                                            o = t.effect;
                                        if ("function" == typeof o) {
                                            var r = o({
                                                    state: l,
                                                    name: e,
                                                    instance: f,
                                                    options: i,
                                                }),
                                                s = function () {};
                                            c.push(r || s);
                                        }
                                    }),
                                    f.update()
                                );
                            },
                            forceUpdate: function () {
                                if (!u) {
                                    var t = l.elements,
                                        e = t.reference,
                                        n = t.popper;
                                    if (H(e, n)) {
                                        (l.rects = {
                                            reference: p(
                                                e,
                                                w(n),
                                                "fixed" === l.options.strategy
                                            ),
                                            popper: g(n),
                                        }),
                                            (l.reset = !1),
                                            (l.placement = l.options.placement),
                                            l.orderedModifiers.forEach(
                                                function (t) {
                                                    return (l.modifiersData[
                                                        t.name
                                                    ] = Object.assign(
                                                        {},
                                                        t.data
                                                    ));
                                                }
                                            );
                                        for (
                                            var i = 0;
                                            i < l.orderedModifiers.length;
                                            i++
                                        )
                                            if (!0 !== l.reset) {
                                                var o = l.orderedModifiers[i],
                                                    r = o.fn,
                                                    s = o.options,
                                                    a = void 0 === s ? {} : s,
                                                    c = o.name;
                                                "function" == typeof r &&
                                                    (l =
                                                        r({
                                                            state: l,
                                                            options: a,
                                                            name: c,
                                                            instance: f,
                                                        }) || l);
                                            } else (l.reset = !1), (i = -1);
                                    }
                                }
                            },
                            update:
                                ((o = function () {
                                    return new Promise(function (t) {
                                        f.forceUpdate(), t(l);
                                    });
                                }),
                                function () {
                                    return (
                                        a ||
                                            (a = new Promise(function (t) {
                                                Promise.resolve().then(
                                                    function () {
                                                        (a = void 0), t(o());
                                                    }
                                                );
                                            })),
                                        a
                                    );
                                }),
                            destroy: function () {
                                h(), (u = !0);
                            },
                        };
                    if (!H(t, e)) return f;
                    function h() {
                        c.forEach(function (t) {
                            return t();
                        }),
                            (c = []);
                    }
                    return (
                        f.setOptions(n).then(function (t) {
                            !u && n.onFirstUpdate && n.onFirstUpdate(t);
                        }),
                        f
                    );
                };
            }
            var Y = { passive: !0 };
            const M = {
                name: "eventListeners",
                enabled: !0,
                phase: "write",
                fn: function () {},
                effect: function (t) {
                    var e = t.state,
                        n = t.instance,
                        i = t.options,
                        r = i.scroll,
                        s = void 0 === r || r,
                        a = i.resize,
                        l = void 0 === a || a,
                        c = o(e.elements.popper),
                        u = [].concat(
                            e.scrollParents.reference,
                            e.scrollParents.popper
                        );
                    return (
                        s &&
                            u.forEach(function (t) {
                                t.addEventListener("scroll", n.update, Y);
                            }),
                        l && c.addEventListener("resize", n.update, Y),
                        function () {
                            s &&
                                u.forEach(function (t) {
                                    t.removeEventListener(
                                        "scroll",
                                        n.update,
                                        Y
                                    );
                                }),
                                l &&
                                    c.removeEventListener(
                                        "resize",
                                        n.update,
                                        Y
                                    );
                        }
                    );
                },
                data: {},
            };
            function X(t) {
                return t.split("-")[0];
            }
            function B(t) {
                return t.split("-")[1];
            }
            function U(t) {
                return ["top", "bottom"].indexOf(t) >= 0 ? "x" : "y";
            }
            function q(t) {
                var e,
                    n = t.reference,
                    i = t.element,
                    o = t.placement,
                    r = o ? X(o) : null,
                    s = o ? B(o) : null,
                    a = n.x + n.width / 2 - i.width / 2,
                    l = n.y + n.height / 2 - i.height / 2;
                switch (r) {
                    case E:
                        e = { x: a, y: n.y - i.height };
                        break;
                    case L:
                        e = { x: a, y: n.y + n.height };
                        break;
                    case k:
                        e = { x: n.x + n.width, y: l };
                        break;
                    case T:
                        e = { x: n.x - i.width, y: l };
                        break;
                    default:
                        e = { x: n.x, y: n.y };
                }
                var c = r ? U(r) : null;
                if (null != c) {
                    var u = "y" === c ? "height" : "width";
                    switch (s) {
                        case A:
                            e[c] = e[c] - (n[u] / 2 - i[u] / 2);
                            break;
                        case S:
                            e[c] = e[c] + (n[u] / 2 - i[u] / 2);
                    }
                }
                return e;
            }
            const Q = {
                name: "popperOffsets",
                enabled: !0,
                phase: "read",
                fn: function (t) {
                    var e = t.state,
                        n = t.name;
                    e.modifiersData[n] = q({
                        reference: e.rects.reference,
                        element: e.rects.popper,
                        strategy: "absolute",
                        placement: e.placement,
                    });
                },
                data: {},
            };
            var V = Math.max,
                F = Math.min,
                z = Math.round,
                K = {
                    top: "auto",
                    right: "auto",
                    bottom: "auto",
                    left: "auto",
                };
            function $(t) {
                var e,
                    n = t.popper,
                    i = t.popperRect,
                    r = t.placement,
                    s = t.offsets,
                    a = t.position,
                    l = t.gpuAcceleration,
                    c = t.adaptive,
                    f = t.roundOffsets,
                    d =
                        !0 === f
                            ? (function (t) {
                                  var e = t.x,
                                      n = t.y,
                                      i = window.devicePixelRatio || 1;
                                  return {
                                      x: z(z(e * i) / i) || 0,
                                      y: z(z(n * i) / i) || 0,
                                  };
                              })(s)
                            : "function" == typeof f
                            ? f(s)
                            : s,
                    p = d.x,
                    g = void 0 === p ? 0 : p,
                    m = d.y,
                    v = void 0 === m ? 0 : m,
                    _ = s.hasOwnProperty("x"),
                    b = s.hasOwnProperty("y"),
                    y = T,
                    C = E,
                    O = window;
                if (c) {
                    var A = w(n),
                        S = "clientHeight",
                        x = "clientWidth";
                    A === o(n) &&
                        "static" !== h((A = u(n))).position &&
                        ((S = "scrollHeight"), (x = "scrollWidth")),
                        (A = A),
                        r === E &&
                            ((C = L),
                            (v -= A[S] - i.height),
                            (v *= l ? 1 : -1)),
                        r === T &&
                            ((y = k), (g -= A[x] - i.width), (g *= l ? 1 : -1));
                }
                var D,
                    N = Object.assign({ position: a }, c && K);
                return l
                    ? Object.assign(
                          {},
                          N,
                          (((D = {})[C] = b ? "0" : ""),
                          (D[y] = _ ? "0" : ""),
                          (D.transform =
                              (O.devicePixelRatio || 1) < 2
                                  ? "translate(" + g + "px, " + v + "px)"
                                  : "translate3d(" + g + "px, " + v + "px, 0)"),
                          D)
                      )
                    : Object.assign(
                          {},
                          N,
                          (((e = {})[C] = b ? v + "px" : ""),
                          (e[y] = _ ? g + "px" : ""),
                          (e.transform = ""),
                          e)
                      );
            }
            var G = {
                left: "right",
                right: "left",
                bottom: "top",
                top: "bottom",
            };
            function J(t) {
                return t.replace(/left|right|bottom|top/g, function (t) {
                    return G[t];
                });
            }
            var Z = { start: "end", end: "start" };
            function tt(t) {
                return t.replace(/start|end/g, function (t) {
                    return Z[t];
                });
            }
            function et(t, e) {
                var n = e.getRootNode && e.getRootNode();
                if (t.contains(e)) return !0;
                if (n && l(n)) {
                    var i = e;
                    do {
                        if (i && t.isSameNode(i)) return !0;
                        i = i.parentNode || i.host;
                    } while (i);
                }
                return !1;
            }
            function nt(t) {
                return Object.assign({}, t, {
                    left: t.x,
                    top: t.y,
                    right: t.x + t.width,
                    bottom: t.y + t.height,
                });
            }
            function it(t, e) {
                return e === x
                    ? nt(
                          (function (t) {
                              var e = o(t),
                                  n = u(t),
                                  i = e.visualViewport,
                                  r = n.clientWidth,
                                  s = n.clientHeight,
                                  a = 0,
                                  l = 0;
                              return (
                                  i &&
                                      ((r = i.width),
                                      (s = i.height),
                                      /^((?!chrome|android).)*safari/i.test(
                                          navigator.userAgent
                                      ) ||
                                          ((a = i.offsetLeft),
                                          (l = i.offsetTop))),
                                  { width: r, height: s, x: a + f(t), y: l }
                              );
                          })(t)
                      )
                    : a(e)
                    ? (function (t) {
                          var e = i(t);
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
                    : nt(
                          (function (t) {
                              var e,
                                  n = u(t),
                                  i = r(t),
                                  o =
                                      null == (e = t.ownerDocument)
                                          ? void 0
                                          : e.body,
                                  s = V(
                                      n.scrollWidth,
                                      n.clientWidth,
                                      o ? o.scrollWidth : 0,
                                      o ? o.clientWidth : 0
                                  ),
                                  a = V(
                                      n.scrollHeight,
                                      n.clientHeight,
                                      o ? o.scrollHeight : 0,
                                      o ? o.clientHeight : 0
                                  ),
                                  l = -i.scrollLeft + f(t),
                                  c = -i.scrollTop;
                              return (
                                  "rtl" === h(o || n).direction &&
                                      (l +=
                                          V(
                                              n.clientWidth,
                                              o ? o.clientWidth : 0
                                          ) - s),
                                  { width: s, height: a, x: l, y: c }
                              );
                          })(u(t))
                      );
            }
            function ot(t, e, n) {
                var i =
                        "clippingParents" === e
                            ? (function (t) {
                                  var e = _(m(t)),
                                      n =
                                          ["absolute", "fixed"].indexOf(
                                              h(t).position
                                          ) >= 0 && a(t)
                                              ? w(t)
                                              : t;
                                  return s(n)
                                      ? e.filter(function (t) {
                                            return (
                                                s(t) &&
                                                et(t, n) &&
                                                "body" !== c(t)
                                            );
                                        })
                                      : [];
                              })(t)
                            : [].concat(e),
                    o = [].concat(i, [n]),
                    r = o[0],
                    l = o.reduce(function (e, n) {
                        var i = it(t, n);
                        return (
                            (e.top = V(i.top, e.top)),
                            (e.right = F(i.right, e.right)),
                            (e.bottom = F(i.bottom, e.bottom)),
                            (e.left = V(i.left, e.left)),
                            e
                        );
                    }, it(t, r));
                return (
                    (l.width = l.right - l.left),
                    (l.height = l.bottom - l.top),
                    (l.x = l.left),
                    (l.y = l.top),
                    l
                );
            }
            function rt(t) {
                return Object.assign(
                    {},
                    { top: 0, right: 0, bottom: 0, left: 0 },
                    t
                );
            }
            function st(t, e) {
                return e.reduce(function (e, n) {
                    return (e[n] = t), e;
                }, {});
            }
            function at(t, e) {
                void 0 === e && (e = {});
                var n = e,
                    o = n.placement,
                    r = void 0 === o ? t.placement : o,
                    a = n.boundary,
                    l = void 0 === a ? "clippingParents" : a,
                    c = n.rootBoundary,
                    f = void 0 === c ? x : c,
                    h = n.elementContext,
                    d = void 0 === h ? D : h,
                    p = n.altBoundary,
                    g = void 0 !== p && p,
                    m = n.padding,
                    v = void 0 === m ? 0 : m,
                    _ = rt("number" != typeof v ? v : st(v, O)),
                    b = d === D ? "reference" : D,
                    y = t.elements.reference,
                    w = t.rects.popper,
                    T = t.elements[g ? b : d],
                    C = ot(
                        s(T) ? T : T.contextElement || u(t.elements.popper),
                        l,
                        f
                    ),
                    A = i(y),
                    S = q({
                        reference: A,
                        element: w,
                        strategy: "absolute",
                        placement: r,
                    }),
                    N = nt(Object.assign({}, w, S)),
                    I = d === D ? N : A,
                    j = {
                        top: C.top - I.top + _.top,
                        bottom: I.bottom - C.bottom + _.bottom,
                        left: C.left - I.left + _.left,
                        right: I.right - C.right + _.right,
                    },
                    R = t.modifiersData.offset;
                if (d === D && R) {
                    var P = R[r];
                    Object.keys(j).forEach(function (t) {
                        var e = [k, L].indexOf(t) >= 0 ? 1 : -1,
                            n = [E, L].indexOf(t) >= 0 ? "y" : "x";
                        j[t] += P[n] * e;
                    });
                }
                return j;
            }
            function lt(t, e, n) {
                return V(t, F(e, n));
            }
            function ct(t, e, n) {
                return (
                    void 0 === n && (n = { x: 0, y: 0 }),
                    {
                        top: t.top - e.height - n.y,
                        right: t.right - e.width + n.x,
                        bottom: t.bottom - e.height + n.y,
                        left: t.left - e.width - n.x,
                    }
                );
            }
            function ut(t) {
                return [E, k, L, T].some(function (e) {
                    return t[e] >= 0;
                });
            }
            var ft = W({
                defaultModifiers: [
                    M,
                    Q,
                    {
                        name: "computeStyles",
                        enabled: !0,
                        phase: "beforeWrite",
                        fn: function (t) {
                            var e = t.state,
                                n = t.options,
                                i = n.gpuAcceleration,
                                o = void 0 === i || i,
                                r = n.adaptive,
                                s = void 0 === r || r,
                                a = n.roundOffsets,
                                l = void 0 === a || a,
                                c = {
                                    placement: X(e.placement),
                                    popper: e.elements.popper,
                                    popperRect: e.rects.popper,
                                    gpuAcceleration: o,
                                };
                            null != e.modifiersData.popperOffsets &&
                                (e.styles.popper = Object.assign(
                                    {},
                                    e.styles.popper,
                                    $(
                                        Object.assign({}, c, {
                                            offsets:
                                                e.modifiersData.popperOffsets,
                                            position: e.options.strategy,
                                            adaptive: s,
                                            roundOffsets: l,
                                        })
                                    )
                                )),
                                null != e.modifiersData.arrow &&
                                    (e.styles.arrow = Object.assign(
                                        {},
                                        e.styles.arrow,
                                        $(
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
                    {
                        name: "applyStyles",
                        enabled: !0,
                        phase: "write",
                        fn: function (t) {
                            var e = t.state;
                            Object.keys(e.elements).forEach(function (t) {
                                var n = e.styles[t] || {},
                                    i = e.attributes[t] || {},
                                    o = e.elements[t];
                                a(o) &&
                                    c(o) &&
                                    (Object.assign(o.style, n),
                                    Object.keys(i).forEach(function (t) {
                                        var e = i[t];
                                        !1 === e
                                            ? o.removeAttribute(t)
                                            : o.setAttribute(
                                                  t,
                                                  !0 === e ? "" : e
                                              );
                                    }));
                            });
                        },
                        effect: function (t) {
                            var e = t.state,
                                n = {
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
                                Object.assign(
                                    e.elements.popper.style,
                                    n.popper
                                ),
                                (e.styles = n),
                                e.elements.arrow &&
                                    Object.assign(
                                        e.elements.arrow.style,
                                        n.arrow
                                    ),
                                function () {
                                    Object.keys(e.elements).forEach(function (
                                        t
                                    ) {
                                        var i = e.elements[t],
                                            o = e.attributes[t] || {},
                                            r = Object.keys(
                                                e.styles.hasOwnProperty(t)
                                                    ? e.styles[t]
                                                    : n[t]
                                            ).reduce(function (t, e) {
                                                return (t[e] = ""), t;
                                            }, {});
                                        a(i) &&
                                            c(i) &&
                                            (Object.assign(i.style, r),
                                            Object.keys(o).forEach(function (
                                                t
                                            ) {
                                                i.removeAttribute(t);
                                            }));
                                    });
                                }
                            );
                        },
                        requires: ["computeStyles"],
                    },
                    {
                        name: "offset",
                        enabled: !0,
                        phase: "main",
                        requires: ["popperOffsets"],
                        fn: function (t) {
                            var e = t.state,
                                n = t.options,
                                i = t.name,
                                o = n.offset,
                                r = void 0 === o ? [0, 0] : o,
                                s = I.reduce(function (t, n) {
                                    return (
                                        (t[n] = (function (t, e, n) {
                                            var i = X(t),
                                                o =
                                                    [T, E].indexOf(i) >= 0
                                                        ? -1
                                                        : 1,
                                                r =
                                                    "function" == typeof n
                                                        ? n(
                                                              Object.assign(
                                                                  {},
                                                                  e,
                                                                  {
                                                                      placement:
                                                                          t,
                                                                  }
                                                              )
                                                          )
                                                        : n,
                                                s = r[0],
                                                a = r[1];
                                            return (
                                                (s = s || 0),
                                                (a = (a || 0) * o),
                                                [T, k].indexOf(i) >= 0
                                                    ? { x: a, y: s }
                                                    : { x: s, y: a }
                                            );
                                        })(n, e.rects, r)),
                                        t
                                    );
                                }, {}),
                                a = s[e.placement],
                                l = a.x,
                                c = a.y;
                            null != e.modifiersData.popperOffsets &&
                                ((e.modifiersData.popperOffsets.x += l),
                                (e.modifiersData.popperOffsets.y += c)),
                                (e.modifiersData[i] = s);
                        },
                    },
                    {
                        name: "flip",
                        enabled: !0,
                        phase: "main",
                        fn: function (t) {
                            var e = t.state,
                                n = t.options,
                                i = t.name;
                            if (!e.modifiersData[i]._skip) {
                                for (
                                    var o = n.mainAxis,
                                        r = void 0 === o || o,
                                        s = n.altAxis,
                                        a = void 0 === s || s,
                                        l = n.fallbackPlacements,
                                        c = n.padding,
                                        u = n.boundary,
                                        f = n.rootBoundary,
                                        h = n.altBoundary,
                                        d = n.flipVariations,
                                        p = void 0 === d || d,
                                        g = n.allowedAutoPlacements,
                                        m = e.options.placement,
                                        v = X(m),
                                        _ =
                                            l ||
                                            (v === m || !p
                                                ? [J(m)]
                                                : (function (t) {
                                                      if (X(t) === C) return [];
                                                      var e = J(t);
                                                      return [tt(t), e, tt(e)];
                                                  })(m)),
                                        b = [m]
                                            .concat(_)
                                            .reduce(function (t, n) {
                                                return t.concat(
                                                    X(n) === C
                                                        ? (function (t, e) {
                                                              void 0 === e &&
                                                                  (e = {});
                                                              var n = e,
                                                                  i =
                                                                      n.placement,
                                                                  o =
                                                                      n.boundary,
                                                                  r =
                                                                      n.rootBoundary,
                                                                  s = n.padding,
                                                                  a =
                                                                      n.flipVariations,
                                                                  l =
                                                                      n.allowedAutoPlacements,
                                                                  c =
                                                                      void 0 ===
                                                                      l
                                                                          ? I
                                                                          : l,
                                                                  u = B(i),
                                                                  f = u
                                                                      ? a
                                                                          ? N
                                                                          : N.filter(
                                                                                function (
                                                                                    t
                                                                                ) {
                                                                                    return (
                                                                                        B(
                                                                                            t
                                                                                        ) ===
                                                                                        u
                                                                                    );
                                                                                }
                                                                            )
                                                                      : O,
                                                                  h = f.filter(
                                                                      function (
                                                                          t
                                                                      ) {
                                                                          return (
                                                                              c.indexOf(
                                                                                  t
                                                                              ) >=
                                                                              0
                                                                          );
                                                                      }
                                                                  );
                                                              0 === h.length &&
                                                                  (h = f);
                                                              var d = h.reduce(
                                                                  function (
                                                                      e,
                                                                      n
                                                                  ) {
                                                                      return (
                                                                          (e[
                                                                              n
                                                                          ] = at(
                                                                              t,
                                                                              {
                                                                                  placement:
                                                                                      n,
                                                                                  boundary:
                                                                                      o,
                                                                                  rootBoundary:
                                                                                      r,
                                                                                  padding:
                                                                                      s,
                                                                              }
                                                                          )[
                                                                              X(
                                                                                  n
                                                                              )
                                                                          ]),
                                                                          e
                                                                      );
                                                                  },
                                                                  {}
                                                              );
                                                              return Object.keys(
                                                                  d
                                                              ).sort(function (
                                                                  t,
                                                                  e
                                                              ) {
                                                                  return (
                                                                      d[t] -
                                                                      d[e]
                                                                  );
                                                              });
                                                          })(e, {
                                                              placement: n,
                                                              boundary: u,
                                                              rootBoundary: f,
                                                              padding: c,
                                                              flipVariations: p,
                                                              allowedAutoPlacements:
                                                                  g,
                                                          })
                                                        : n
                                                );
                                            }, []),
                                        y = e.rects.reference,
                                        w = e.rects.popper,
                                        S = new Map(),
                                        x = !0,
                                        D = b[0],
                                        j = 0;
                                    j < b.length;
                                    j++
                                ) {
                                    var R = b[j],
                                        P = X(R),
                                        H = B(R) === A,
                                        W = [E, L].indexOf(P) >= 0,
                                        Y = W ? "width" : "height",
                                        M = at(e, {
                                            placement: R,
                                            boundary: u,
                                            rootBoundary: f,
                                            altBoundary: h,
                                            padding: c,
                                        }),
                                        U = W ? (H ? k : T) : H ? L : E;
                                    y[Y] > w[Y] && (U = J(U));
                                    var q = J(U),
                                        Q = [];
                                    if (
                                        (r && Q.push(M[P] <= 0),
                                        a && Q.push(M[U] <= 0, M[q] <= 0),
                                        Q.every(function (t) {
                                            return t;
                                        }))
                                    ) {
                                        (D = R), (x = !1);
                                        break;
                                    }
                                    S.set(R, Q);
                                }
                                if (x)
                                    for (
                                        var V = function (t) {
                                                var e = b.find(function (e) {
                                                    var n = S.get(e);
                                                    if (n)
                                                        return n
                                                            .slice(0, t)
                                                            .every(function (
                                                                t
                                                            ) {
                                                                return t;
                                                            });
                                                });
                                                if (e) return (D = e), "break";
                                            },
                                            F = p ? 3 : 1;
                                        F > 0;
                                        F--
                                    ) {
                                        if ("break" === V(F)) break;
                                    }
                                e.placement !== D &&
                                    ((e.modifiersData[i]._skip = !0),
                                    (e.placement = D),
                                    (e.reset = !0));
                            }
                        },
                        requiresIfExists: ["offset"],
                        data: { _skip: !1 },
                    },
                    {
                        name: "preventOverflow",
                        enabled: !0,
                        phase: "main",
                        fn: function (t) {
                            var e = t.state,
                                n = t.options,
                                i = t.name,
                                o = n.mainAxis,
                                r = void 0 === o || o,
                                s = n.altAxis,
                                a = void 0 !== s && s,
                                l = n.boundary,
                                c = n.rootBoundary,
                                u = n.altBoundary,
                                f = n.padding,
                                h = n.tether,
                                d = void 0 === h || h,
                                p = n.tetherOffset,
                                m = void 0 === p ? 0 : p,
                                v = at(e, {
                                    boundary: l,
                                    rootBoundary: c,
                                    padding: f,
                                    altBoundary: u,
                                }),
                                _ = X(e.placement),
                                b = B(e.placement),
                                y = !b,
                                C = U(_),
                                O = "x" === C ? "y" : "x",
                                S = e.modifiersData.popperOffsets,
                                x = e.rects.reference,
                                D = e.rects.popper,
                                N =
                                    "function" == typeof m
                                        ? m(
                                              Object.assign({}, e.rects, {
                                                  placement: e.placement,
                                              })
                                          )
                                        : m,
                                I = { x: 0, y: 0 };
                            if (S) {
                                if (r || a) {
                                    var j = "y" === C ? E : T,
                                        R = "y" === C ? L : k,
                                        P = "y" === C ? "height" : "width",
                                        H = S[C],
                                        W = S[C] + v[j],
                                        Y = S[C] - v[R],
                                        M = d ? -D[P] / 2 : 0,
                                        q = b === A ? x[P] : D[P],
                                        Q = b === A ? -D[P] : -x[P],
                                        z = e.elements.arrow,
                                        K =
                                            d && z
                                                ? g(z)
                                                : { width: 0, height: 0 },
                                        $ = e.modifiersData["arrow#persistent"]
                                            ? e.modifiersData[
                                                  "arrow#persistent"
                                              ].padding
                                            : {
                                                  top: 0,
                                                  right: 0,
                                                  bottom: 0,
                                                  left: 0,
                                              },
                                        G = $[j],
                                        J = $[R],
                                        Z = lt(0, x[P], K[P]),
                                        tt = y
                                            ? x[P] / 2 - M - Z - G - N
                                            : q - Z - G - N,
                                        et = y
                                            ? -x[P] / 2 + M + Z + J + N
                                            : Q + Z + J + N,
                                        nt =
                                            e.elements.arrow &&
                                            w(e.elements.arrow),
                                        it = nt
                                            ? "y" === C
                                                ? nt.clientTop || 0
                                                : nt.clientLeft || 0
                                            : 0,
                                        ot = e.modifiersData.offset
                                            ? e.modifiersData.offset[
                                                  e.placement
                                              ][C]
                                            : 0,
                                        rt = S[C] + tt - ot - it,
                                        st = S[C] + et - ot;
                                    if (r) {
                                        var ct = lt(
                                            d ? F(W, rt) : W,
                                            H,
                                            d ? V(Y, st) : Y
                                        );
                                        (S[C] = ct), (I[C] = ct - H);
                                    }
                                    if (a) {
                                        var ut = "x" === C ? E : T,
                                            ft = "x" === C ? L : k,
                                            ht = S[O],
                                            dt = ht + v[ut],
                                            pt = ht - v[ft],
                                            gt = lt(
                                                d ? F(dt, rt) : dt,
                                                ht,
                                                d ? V(pt, st) : pt
                                            );
                                        (S[O] = gt), (I[O] = gt - ht);
                                    }
                                }
                                e.modifiersData[i] = I;
                            }
                        },
                        requiresIfExists: ["offset"],
                    },
                    {
                        name: "arrow",
                        enabled: !0,
                        phase: "main",
                        fn: function (t) {
                            var e,
                                n = t.state,
                                i = t.name,
                                o = t.options,
                                r = n.elements.arrow,
                                s = n.modifiersData.popperOffsets,
                                a = X(n.placement),
                                l = U(a),
                                c = [T, k].indexOf(a) >= 0 ? "height" : "width";
                            if (r && s) {
                                var u = (function (t, e) {
                                        return rt(
                                            "number" !=
                                                typeof (t =
                                                    "function" == typeof t
                                                        ? t(
                                                              Object.assign(
                                                                  {},
                                                                  e.rects,
                                                                  {
                                                                      placement:
                                                                          e.placement,
                                                                  }
                                                              )
                                                          )
                                                        : t)
                                                ? t
                                                : st(t, O)
                                        );
                                    })(o.padding, n),
                                    f = g(r),
                                    h = "y" === l ? E : T,
                                    d = "y" === l ? L : k,
                                    p =
                                        n.rects.reference[c] +
                                        n.rects.reference[l] -
                                        s[l] -
                                        n.rects.popper[c],
                                    m = s[l] - n.rects.reference[l],
                                    v = w(r),
                                    _ = v
                                        ? "y" === l
                                            ? v.clientHeight || 0
                                            : v.clientWidth || 0
                                        : 0,
                                    b = p / 2 - m / 2,
                                    y = u[h],
                                    C = _ - f[c] - u[d],
                                    A = _ / 2 - f[c] / 2 + b,
                                    S = lt(y, A, C),
                                    x = l;
                                n.modifiersData[i] =
                                    (((e = {})[x] = S),
                                    (e.centerOffset = S - A),
                                    e);
                            }
                        },
                        effect: function (t) {
                            var e = t.state,
                                n = t.options.element,
                                i = void 0 === n ? "[data-popper-arrow]" : n;
                            null != i &&
                                ("string" != typeof i ||
                                    (i = e.elements.popper.querySelector(i))) &&
                                et(e.elements.popper, i) &&
                                (e.elements.arrow = i);
                        },
                        requires: ["popperOffsets"],
                        requiresIfExists: ["preventOverflow"],
                    },
                    {
                        name: "hide",
                        enabled: !0,
                        phase: "main",
                        requiresIfExists: ["preventOverflow"],
                        fn: function (t) {
                            var e = t.state,
                                n = t.name,
                                i = e.rects.reference,
                                o = e.rects.popper,
                                r = e.modifiersData.preventOverflow,
                                s = at(e, { elementContext: "reference" }),
                                a = at(e, { altBoundary: !0 }),
                                l = ct(s, i),
                                c = ct(a, o, r),
                                u = ut(l),
                                f = ut(c);
                            (e.modifiersData[n] = {
                                referenceClippingOffsets: l,
                                popperEscapeOffsets: c,
                                isReferenceHidden: u,
                                hasPopperEscaped: f,
                            }),
                                (e.attributes.popper = Object.assign(
                                    {},
                                    e.attributes.popper,
                                    {
                                        "data-popper-reference-hidden": u,
                                        "data-popper-escaped": f,
                                    }
                                ));
                        },
                    },
                ],
            });
            function ht(t) {
                return getComputedStyle(t);
            }
            function dt(t, e) {
                for (var n in e) {
                    var i = e[n];
                    "number" == typeof i && (i += "px"), (t.style[n] = i);
                }
                return t;
            }
            function pt(t) {
                var e = document.createElement("div");
                return (e.className = t), e;
            }
            var gt =
                "undefined" != typeof Element &&
                (Element.prototype.matches ||
                    Element.prototype.webkitMatchesSelector ||
                    Element.prototype.mozMatchesSelector ||
                    Element.prototype.msMatchesSelector);
            function mt(t, e) {
                if (!gt)
                    throw new Error("No element matching method supported");
                return gt.call(t, e);
            }
            function vt(t) {
                t.remove
                    ? t.remove()
                    : t.parentNode && t.parentNode.removeChild(t);
            }
            function _t(t, e) {
                return Array.prototype.filter.call(t.children, function (t) {
                    return mt(t, e);
                });
            }
            var bt = "ps",
                yt = "ps__rtl",
                wt = {
                    thumb: function (t) {
                        return "ps__thumb-" + t;
                    },
                    rail: function (t) {
                        return "ps__rail-" + t;
                    },
                    consuming: "ps__child--consume",
                },
                Et = {
                    focus: "ps--focus",
                    clicking: "ps--clicking",
                    active: function (t) {
                        return "ps--active-" + t;
                    },
                    scrolling: function (t) {
                        return "ps--scrolling-" + t;
                    },
                },
                Lt = { x: null, y: null };
            function kt(t, e) {
                var n = t.element.classList,
                    i = Et.scrolling(e);
                n.contains(i) ? clearTimeout(Lt[e]) : n.add(i);
            }
            function Tt(t, e) {
                Lt[e] = setTimeout(function () {
                    return (
                        t.isAlive && t.element.classList.remove(Et.scrolling(e))
                    );
                }, t.settings.scrollingThreshold);
            }
            var Ct = function (t) {
                    (this.element = t), (this.handlers = {});
                },
                Ot = { isEmpty: { configurable: !0 } };
            (Ct.prototype.bind = function (t, e) {
                void 0 === this.handlers[t] && (this.handlers[t] = []),
                    this.handlers[t].push(e),
                    this.element.addEventListener(t, e, !1);
            }),
                (Ct.prototype.unbind = function (t, e) {
                    var n = this;
                    this.handlers[t] = this.handlers[t].filter(function (i) {
                        return (
                            !(!e || i === e) ||
                            (n.element.removeEventListener(t, i, !1), !1)
                        );
                    });
                }),
                (Ct.prototype.unbindAll = function () {
                    for (var t in this.handlers) this.unbind(t);
                }),
                (Ot.isEmpty.get = function () {
                    var t = this;
                    return Object.keys(this.handlers).every(function (e) {
                        return 0 === t.handlers[e].length;
                    });
                }),
                Object.defineProperties(Ct.prototype, Ot);
            var At = function () {
                this.eventElements = [];
            };
            function St(t) {
                if ("function" == typeof window.CustomEvent)
                    return new CustomEvent(t);
                var e = document.createEvent("CustomEvent");
                return e.initCustomEvent(t, !1, !1, void 0), e;
            }
            function xt(t, e, n, i, o) {
                var r;
                if (
                    (void 0 === i && (i = !0),
                    void 0 === o && (o = !1),
                    "top" === e)
                )
                    r = [
                        "contentHeight",
                        "containerHeight",
                        "scrollTop",
                        "y",
                        "up",
                        "down",
                    ];
                else {
                    if ("left" !== e)
                        throw new Error("A proper axis should be provided");
                    r = [
                        "contentWidth",
                        "containerWidth",
                        "scrollLeft",
                        "x",
                        "left",
                        "right",
                    ];
                }
                !(function (t, e, n, i, o) {
                    var r = n[0],
                        s = n[1],
                        a = n[2],
                        l = n[3],
                        c = n[4],
                        u = n[5];
                    void 0 === i && (i = !0);
                    void 0 === o && (o = !1);
                    var f = t.element;
                    (t.reach[l] = null), f[a] < 1 && (t.reach[l] = "start");
                    f[a] > t[r] - t[s] - 1 && (t.reach[l] = "end");
                    e &&
                        (f.dispatchEvent(St("ps-scroll-" + l)),
                        e < 0
                            ? f.dispatchEvent(St("ps-scroll-" + c))
                            : e > 0 && f.dispatchEvent(St("ps-scroll-" + u)),
                        i &&
                            (function (t, e) {
                                kt(t, e), Tt(t, e);
                            })(t, l));
                    t.reach[l] &&
                        (e || o) &&
                        f.dispatchEvent(St("ps-" + l + "-reach-" + t.reach[l]));
                })(t, n, r, i, o);
            }
            function Dt(t) {
                return parseInt(t, 10) || 0;
            }
            (At.prototype.eventElement = function (t) {
                var e = this.eventElements.filter(function (e) {
                    return e.element === t;
                })[0];
                return e || ((e = new Ct(t)), this.eventElements.push(e)), e;
            }),
                (At.prototype.bind = function (t, e, n) {
                    this.eventElement(t).bind(e, n);
                }),
                (At.prototype.unbind = function (t, e, n) {
                    var i = this.eventElement(t);
                    i.unbind(e, n),
                        i.isEmpty &&
                            this.eventElements.splice(
                                this.eventElements.indexOf(i),
                                1
                            );
                }),
                (At.prototype.unbindAll = function () {
                    this.eventElements.forEach(function (t) {
                        return t.unbindAll();
                    }),
                        (this.eventElements = []);
                }),
                (At.prototype.once = function (t, e, n) {
                    var i = this.eventElement(t),
                        o = function (t) {
                            i.unbind(e, o), n(t);
                        };
                    i.bind(e, o);
                });
            var Nt = {
                isWebKit:
                    "undefined" != typeof document &&
                    "WebkitAppearance" in document.documentElement.style,
                supportsTouch:
                    "undefined" != typeof window &&
                    ("ontouchstart" in window ||
                        ("maxTouchPoints" in window.navigator &&
                            window.navigator.maxTouchPoints > 0) ||
                        (window.DocumentTouch &&
                            document instanceof window.DocumentTouch)),
                supportsIePointer:
                    "undefined" != typeof navigator &&
                    navigator.msMaxTouchPoints,
                isChrome:
                    "undefined" != typeof navigator &&
                    /Chrome/i.test(navigator && navigator.userAgent),
            };
            function It(t) {
                var e = t.element,
                    n = Math.floor(e.scrollTop),
                    i = e.getBoundingClientRect();
                (t.containerWidth = Math.ceil(i.width)),
                    (t.containerHeight = Math.ceil(i.height)),
                    (t.contentWidth = e.scrollWidth),
                    (t.contentHeight = e.scrollHeight),
                    e.contains(t.scrollbarXRail) ||
                        (_t(e, wt.rail("x")).forEach(function (t) {
                            return vt(t);
                        }),
                        e.appendChild(t.scrollbarXRail)),
                    e.contains(t.scrollbarYRail) ||
                        (_t(e, wt.rail("y")).forEach(function (t) {
                            return vt(t);
                        }),
                        e.appendChild(t.scrollbarYRail)),
                    !t.settings.suppressScrollX &&
                    t.containerWidth + t.settings.scrollXMarginOffset <
                        t.contentWidth
                        ? ((t.scrollbarXActive = !0),
                          (t.railXWidth =
                              t.containerWidth - t.railXMarginWidth),
                          (t.railXRatio = t.containerWidth / t.railXWidth),
                          (t.scrollbarXWidth = jt(
                              t,
                              Dt(
                                  (t.railXWidth * t.containerWidth) /
                                      t.contentWidth
                              )
                          )),
                          (t.scrollbarXLeft = Dt(
                              ((t.negativeScrollAdjustment + e.scrollLeft) *
                                  (t.railXWidth - t.scrollbarXWidth)) /
                                  (t.contentWidth - t.containerWidth)
                          )))
                        : (t.scrollbarXActive = !1),
                    !t.settings.suppressScrollY &&
                    t.containerHeight + t.settings.scrollYMarginOffset <
                        t.contentHeight
                        ? ((t.scrollbarYActive = !0),
                          (t.railYHeight =
                              t.containerHeight - t.railYMarginHeight),
                          (t.railYRatio = t.containerHeight / t.railYHeight),
                          (t.scrollbarYHeight = jt(
                              t,
                              Dt(
                                  (t.railYHeight * t.containerHeight) /
                                      t.contentHeight
                              )
                          )),
                          (t.scrollbarYTop = Dt(
                              (n * (t.railYHeight - t.scrollbarYHeight)) /
                                  (t.contentHeight - t.containerHeight)
                          )))
                        : (t.scrollbarYActive = !1),
                    t.scrollbarXLeft >= t.railXWidth - t.scrollbarXWidth &&
                        (t.scrollbarXLeft = t.railXWidth - t.scrollbarXWidth),
                    t.scrollbarYTop >= t.railYHeight - t.scrollbarYHeight &&
                        (t.scrollbarYTop = t.railYHeight - t.scrollbarYHeight),
                    (function (t, e) {
                        var n = { width: e.railXWidth },
                            i = Math.floor(t.scrollTop);
                        e.isRtl
                            ? (n.left =
                                  e.negativeScrollAdjustment +
                                  t.scrollLeft +
                                  e.containerWidth -
                                  e.contentWidth)
                            : (n.left = t.scrollLeft);
                        e.isScrollbarXUsingBottom
                            ? (n.bottom = e.scrollbarXBottom - i)
                            : (n.top = e.scrollbarXTop + i);
                        dt(e.scrollbarXRail, n);
                        var o = { top: i, height: e.railYHeight };
                        e.isScrollbarYUsingRight
                            ? e.isRtl
                                ? (o.right =
                                      e.contentWidth -
                                      (e.negativeScrollAdjustment +
                                          t.scrollLeft) -
                                      e.scrollbarYRight -
                                      e.scrollbarYOuterWidth -
                                      9)
                                : (o.right = e.scrollbarYRight - t.scrollLeft)
                            : e.isRtl
                            ? (o.left =
                                  e.negativeScrollAdjustment +
                                  t.scrollLeft +
                                  2 * e.containerWidth -
                                  e.contentWidth -
                                  e.scrollbarYLeft -
                                  e.scrollbarYOuterWidth)
                            : (o.left = e.scrollbarYLeft + t.scrollLeft);
                        dt(e.scrollbarYRail, o),
                            dt(e.scrollbarX, {
                                left: e.scrollbarXLeft,
                                width: e.scrollbarXWidth - e.railBorderXWidth,
                            }),
                            dt(e.scrollbarY, {
                                top: e.scrollbarYTop,
                                height: e.scrollbarYHeight - e.railBorderYWidth,
                            });
                    })(e, t),
                    t.scrollbarXActive
                        ? e.classList.add(Et.active("x"))
                        : (e.classList.remove(Et.active("x")),
                          (t.scrollbarXWidth = 0),
                          (t.scrollbarXLeft = 0),
                          (e.scrollLeft = !0 === t.isRtl ? t.contentWidth : 0)),
                    t.scrollbarYActive
                        ? e.classList.add(Et.active("y"))
                        : (e.classList.remove(Et.active("y")),
                          (t.scrollbarYHeight = 0),
                          (t.scrollbarYTop = 0),
                          (e.scrollTop = 0));
            }
            function jt(t, e) {
                return (
                    t.settings.minScrollbarLength &&
                        (e = Math.max(e, t.settings.minScrollbarLength)),
                    t.settings.maxScrollbarLength &&
                        (e = Math.min(e, t.settings.maxScrollbarLength)),
                    e
                );
            }
            function Rt(t, e) {
                var n = e[0],
                    i = e[1],
                    o = e[2],
                    r = e[3],
                    s = e[4],
                    a = e[5],
                    l = e[6],
                    c = e[7],
                    u = e[8],
                    f = t.element,
                    h = null,
                    d = null,
                    p = null;
                function g(e) {
                    e.touches && e.touches[0] && (e[o] = e.touches[0].pageY),
                        (f[l] = h + p * (e[o] - d)),
                        kt(t, c),
                        It(t),
                        e.stopPropagation(),
                        e.preventDefault();
                }
                function m() {
                    Tt(t, c),
                        t[u].classList.remove(Et.clicking),
                        t.event.unbind(t.ownerDocument, "mousemove", g);
                }
                function v(e, s) {
                    (h = f[l]),
                        s && e.touches && (e[o] = e.touches[0].pageY),
                        (d = e[o]),
                        (p = (t[i] - t[n]) / (t[r] - t[a])),
                        s
                            ? t.event.bind(t.ownerDocument, "touchmove", g)
                            : (t.event.bind(t.ownerDocument, "mousemove", g),
                              t.event.once(t.ownerDocument, "mouseup", m),
                              e.preventDefault()),
                        t[u].classList.add(Et.clicking),
                        e.stopPropagation();
                }
                t.event.bind(t[s], "mousedown", function (t) {
                    v(t);
                }),
                    t.event.bind(t[s], "touchstart", function (t) {
                        v(t, !0);
                    });
            }
            var Pt = {
                    "click-rail": function (t) {
                        t.element,
                            t.event.bind(
                                t.scrollbarY,
                                "mousedown",
                                function (t) {
                                    return t.stopPropagation();
                                }
                            ),
                            t.event.bind(
                                t.scrollbarYRail,
                                "mousedown",
                                function (e) {
                                    var n =
                                        e.pageY -
                                            window.pageYOffset -
                                            t.scrollbarYRail.getBoundingClientRect()
                                                .top >
                                        t.scrollbarYTop
                                            ? 1
                                            : -1;
                                    (t.element.scrollTop +=
                                        n * t.containerHeight),
                                        It(t),
                                        e.stopPropagation();
                                }
                            ),
                            t.event.bind(
                                t.scrollbarX,
                                "mousedown",
                                function (t) {
                                    return t.stopPropagation();
                                }
                            ),
                            t.event.bind(
                                t.scrollbarXRail,
                                "mousedown",
                                function (e) {
                                    var n =
                                        e.pageX -
                                            window.pageXOffset -
                                            t.scrollbarXRail.getBoundingClientRect()
                                                .left >
                                        t.scrollbarXLeft
                                            ? 1
                                            : -1;
                                    (t.element.scrollLeft +=
                                        n * t.containerWidth),
                                        It(t),
                                        e.stopPropagation();
                                }
                            );
                    },
                    "drag-thumb": function (t) {
                        Rt(t, [
                            "containerWidth",
                            "contentWidth",
                            "pageX",
                            "railXWidth",
                            "scrollbarX",
                            "scrollbarXWidth",
                            "scrollLeft",
                            "x",
                            "scrollbarXRail",
                        ]),
                            Rt(t, [
                                "containerHeight",
                                "contentHeight",
                                "pageY",
                                "railYHeight",
                                "scrollbarY",
                                "scrollbarYHeight",
                                "scrollTop",
                                "y",
                                "scrollbarYRail",
                            ]);
                    },
                    keyboard: function (t) {
                        var e = t.element;
                        t.event.bind(t.ownerDocument, "keydown", function (n) {
                            if (
                                !(
                                    (n.isDefaultPrevented &&
                                        n.isDefaultPrevented()) ||
                                    n.defaultPrevented
                                ) &&
                                (mt(e, ":hover") ||
                                    mt(t.scrollbarX, ":focus") ||
                                    mt(t.scrollbarY, ":focus"))
                            ) {
                                var i,
                                    o = document.activeElement
                                        ? document.activeElement
                                        : t.ownerDocument.activeElement;
                                if (o) {
                                    if ("IFRAME" === o.tagName)
                                        o = o.contentDocument.activeElement;
                                    else
                                        for (; o.shadowRoot; )
                                            o = o.shadowRoot.activeElement;
                                    if (
                                        mt(
                                            (i = o),
                                            "input,[contenteditable]"
                                        ) ||
                                        mt(i, "select,[contenteditable]") ||
                                        mt(i, "textarea,[contenteditable]") ||
                                        mt(i, "button,[contenteditable]")
                                    )
                                        return;
                                }
                                var r = 0,
                                    s = 0;
                                switch (n.which) {
                                    case 37:
                                        r = n.metaKey
                                            ? -t.contentWidth
                                            : n.altKey
                                            ? -t.containerWidth
                                            : -30;
                                        break;
                                    case 38:
                                        s = n.metaKey
                                            ? t.contentHeight
                                            : n.altKey
                                            ? t.containerHeight
                                            : 30;
                                        break;
                                    case 39:
                                        r = n.metaKey
                                            ? t.contentWidth
                                            : n.altKey
                                            ? t.containerWidth
                                            : 30;
                                        break;
                                    case 40:
                                        s = n.metaKey
                                            ? -t.contentHeight
                                            : n.altKey
                                            ? -t.containerHeight
                                            : -30;
                                        break;
                                    case 32:
                                        s = n.shiftKey
                                            ? t.containerHeight
                                            : -t.containerHeight;
                                        break;
                                    case 33:
                                        s = t.containerHeight;
                                        break;
                                    case 34:
                                        s = -t.containerHeight;
                                        break;
                                    case 36:
                                        s = t.contentHeight;
                                        break;
                                    case 35:
                                        s = -t.contentHeight;
                                        break;
                                    default:
                                        return;
                                }
                                (t.settings.suppressScrollX && 0 !== r) ||
                                    (t.settings.suppressScrollY && 0 !== s) ||
                                    ((e.scrollTop -= s),
                                    (e.scrollLeft += r),
                                    It(t),
                                    (function (n, i) {
                                        var o = Math.floor(e.scrollTop);
                                        if (0 === n) {
                                            if (!t.scrollbarYActive) return !1;
                                            if (
                                                (0 === o && i > 0) ||
                                                (o >=
                                                    t.contentHeight -
                                                        t.containerHeight &&
                                                    i < 0)
                                            )
                                                return !t.settings
                                                    .wheelPropagation;
                                        }
                                        var r = e.scrollLeft;
                                        if (0 === i) {
                                            if (!t.scrollbarXActive) return !1;
                                            if (
                                                (0 === r && n < 0) ||
                                                (r >=
                                                    t.contentWidth -
                                                        t.containerWidth &&
                                                    n > 0)
                                            )
                                                return !t.settings
                                                    .wheelPropagation;
                                        }
                                        return !0;
                                    })(r, s) && n.preventDefault());
                            }
                        });
                    },
                    wheel: function (t) {
                        var e = t.element;
                        function n(n) {
                            var i = (function (t) {
                                    var e = t.deltaX,
                                        n = -1 * t.deltaY;
                                    return (
                                        (void 0 !== e && void 0 !== n) ||
                                            ((e = (-1 * t.wheelDeltaX) / 6),
                                            (n = t.wheelDeltaY / 6)),
                                        t.deltaMode &&
                                            1 === t.deltaMode &&
                                            ((e *= 10), (n *= 10)),
                                        e != e &&
                                            n != n &&
                                            ((e = 0), (n = t.wheelDelta)),
                                        t.shiftKey ? [-n, -e] : [e, n]
                                    );
                                })(n),
                                o = i[0],
                                r = i[1];
                            if (
                                !(function (t, n, i) {
                                    if (
                                        !Nt.isWebKit &&
                                        e.querySelector("select:focus")
                                    )
                                        return !0;
                                    if (!e.contains(t)) return !1;
                                    for (var o = t; o && o !== e; ) {
                                        if (o.classList.contains(wt.consuming))
                                            return !0;
                                        var r = ht(o);
                                        if (
                                            i &&
                                            r.overflowY.match(/(scroll|auto)/)
                                        ) {
                                            var s =
                                                o.scrollHeight - o.clientHeight;
                                            if (
                                                s > 0 &&
                                                ((o.scrollTop > 0 && i < 0) ||
                                                    (o.scrollTop < s && i > 0))
                                            )
                                                return !0;
                                        }
                                        if (
                                            n &&
                                            r.overflowX.match(/(scroll|auto)/)
                                        ) {
                                            var a =
                                                o.scrollWidth - o.clientWidth;
                                            if (
                                                a > 0 &&
                                                ((o.scrollLeft > 0 && n < 0) ||
                                                    (o.scrollLeft < a && n > 0))
                                            )
                                                return !0;
                                        }
                                        o = o.parentNode;
                                    }
                                    return !1;
                                })(n.target, o, r)
                            ) {
                                var s = !1;
                                t.settings.useBothWheelAxes
                                    ? t.scrollbarYActive && !t.scrollbarXActive
                                        ? (r
                                              ? (e.scrollTop -=
                                                    r * t.settings.wheelSpeed)
                                              : (e.scrollTop +=
                                                    o * t.settings.wheelSpeed),
                                          (s = !0))
                                        : t.scrollbarXActive &&
                                          !t.scrollbarYActive &&
                                          (o
                                              ? (e.scrollLeft +=
                                                    o * t.settings.wheelSpeed)
                                              : (e.scrollLeft -=
                                                    r * t.settings.wheelSpeed),
                                          (s = !0))
                                    : ((e.scrollTop -=
                                          r * t.settings.wheelSpeed),
                                      (e.scrollLeft +=
                                          o * t.settings.wheelSpeed)),
                                    It(t),
                                    (s =
                                        s ||
                                        (function (n, i) {
                                            var o = Math.floor(e.scrollTop),
                                                r = 0 === e.scrollTop,
                                                s =
                                                    o + e.offsetHeight ===
                                                    e.scrollHeight,
                                                a = 0 === e.scrollLeft,
                                                l =
                                                    e.scrollLeft +
                                                        e.offsetWidth ===
                                                    e.scrollWidth;
                                            return (
                                                !(Math.abs(i) > Math.abs(n)
                                                    ? r || s
                                                    : a || l) ||
                                                !t.settings.wheelPropagation
                                            );
                                        })(o, r)) &&
                                        !n.ctrlKey &&
                                        (n.stopPropagation(),
                                        n.preventDefault());
                            }
                        }
                        void 0 !== window.onwheel
                            ? t.event.bind(e, "wheel", n)
                            : void 0 !== window.onmousewheel &&
                              t.event.bind(e, "mousewheel", n);
                    },
                    touch: function (t) {
                        if (Nt.supportsTouch || Nt.supportsIePointer) {
                            var e = t.element,
                                n = {},
                                i = 0,
                                o = {},
                                r = null;
                            Nt.supportsTouch
                                ? (t.event.bind(e, "touchstart", c),
                                  t.event.bind(e, "touchmove", u),
                                  t.event.bind(e, "touchend", f))
                                : Nt.supportsIePointer &&
                                  (window.PointerEvent
                                      ? (t.event.bind(e, "pointerdown", c),
                                        t.event.bind(e, "pointermove", u),
                                        t.event.bind(e, "pointerup", f))
                                      : window.MSPointerEvent &&
                                        (t.event.bind(e, "MSPointerDown", c),
                                        t.event.bind(e, "MSPointerMove", u),
                                        t.event.bind(e, "MSPointerUp", f)));
                        }
                        function s(n, i) {
                            (e.scrollTop -= i), (e.scrollLeft -= n), It(t);
                        }
                        function a(t) {
                            return t.targetTouches ? t.targetTouches[0] : t;
                        }
                        function l(t) {
                            return (
                                (!t.pointerType ||
                                    "pen" !== t.pointerType ||
                                    0 !== t.buttons) &&
                                (!(
                                    !t.targetTouches ||
                                    1 !== t.targetTouches.length
                                ) ||
                                    !(
                                        !t.pointerType ||
                                        "mouse" === t.pointerType ||
                                        t.pointerType === t.MSPOINTER_TYPE_MOUSE
                                    ))
                            );
                        }
                        function c(t) {
                            if (l(t)) {
                                var e = a(t);
                                (n.pageX = e.pageX),
                                    (n.pageY = e.pageY),
                                    (i = new Date().getTime()),
                                    null !== r && clearInterval(r);
                            }
                        }
                        function u(r) {
                            if (l(r)) {
                                var c = a(r),
                                    u = { pageX: c.pageX, pageY: c.pageY },
                                    f = u.pageX - n.pageX,
                                    h = u.pageY - n.pageY;
                                if (
                                    (function (t, n, i) {
                                        if (!e.contains(t)) return !1;
                                        for (var o = t; o && o !== e; ) {
                                            if (
                                                o.classList.contains(
                                                    wt.consuming
                                                )
                                            )
                                                return !0;
                                            var r = ht(o);
                                            if (
                                                i &&
                                                r.overflowY.match(
                                                    /(scroll|auto)/
                                                )
                                            ) {
                                                var s =
                                                    o.scrollHeight -
                                                    o.clientHeight;
                                                if (
                                                    s > 0 &&
                                                    ((o.scrollTop > 0 &&
                                                        i < 0) ||
                                                        (o.scrollTop < s &&
                                                            i > 0))
                                                )
                                                    return !0;
                                            }
                                            if (
                                                n &&
                                                r.overflowX.match(
                                                    /(scroll|auto)/
                                                )
                                            ) {
                                                var a =
                                                    o.scrollWidth -
                                                    o.clientWidth;
                                                if (
                                                    a > 0 &&
                                                    ((o.scrollLeft > 0 &&
                                                        n < 0) ||
                                                        (o.scrollLeft < a &&
                                                            n > 0))
                                                )
                                                    return !0;
                                            }
                                            o = o.parentNode;
                                        }
                                        return !1;
                                    })(r.target, f, h)
                                )
                                    return;
                                s(f, h), (n = u);
                                var d = new Date().getTime(),
                                    p = d - i;
                                p > 0 &&
                                    ((o.x = f / p), (o.y = h / p), (i = d)),
                                    (function (n, i) {
                                        var o = Math.floor(e.scrollTop),
                                            r = e.scrollLeft,
                                            s = Math.abs(n),
                                            a = Math.abs(i);
                                        if (a > s) {
                                            if (
                                                (i < 0 &&
                                                    o ===
                                                        t.contentHeight -
                                                            t.containerHeight) ||
                                                (i > 0 && 0 === o)
                                            )
                                                return (
                                                    0 === window.scrollY &&
                                                    i > 0 &&
                                                    Nt.isChrome
                                                );
                                        } else if (
                                            s > a &&
                                            ((n < 0 &&
                                                r ===
                                                    t.contentWidth -
                                                        t.containerWidth) ||
                                                (n > 0 && 0 === r))
                                        )
                                            return !0;
                                        return !0;
                                    })(f, h) && r.preventDefault();
                            }
                        }
                        function f() {
                            t.settings.swipeEasing &&
                                (clearInterval(r),
                                (r = setInterval(function () {
                                    t.isInitialized
                                        ? clearInterval(r)
                                        : o.x || o.y
                                        ? Math.abs(o.x) < 0.01 &&
                                          Math.abs(o.y) < 0.01
                                            ? clearInterval(r)
                                            : (s(30 * o.x, 30 * o.y),
                                              (o.x *= 0.8),
                                              (o.y *= 0.8))
                                        : clearInterval(r);
                                }, 10)));
                        }
                    },
                },
                Ht = function (t, e) {
                    var n = this;
                    if (
                        (void 0 === e && (e = {}),
                        "string" == typeof t && (t = document.querySelector(t)),
                        !t || !t.nodeName)
                    )
                        throw new Error(
                            "no element is specified to initialize PerfectScrollbar"
                        );
                    for (var i in ((this.element = t),
                    t.classList.add(bt),
                    (this.settings = {
                        handlers: [
                            "click-rail",
                            "drag-thumb",
                            "keyboard",
                            "wheel",
                            "touch",
                        ],
                        maxScrollbarLength: null,
                        minScrollbarLength: null,
                        scrollingThreshold: 1e3,
                        scrollXMarginOffset: 0,
                        scrollYMarginOffset: 0,
                        suppressScrollX: !1,
                        suppressScrollY: !1,
                        swipeEasing: !0,
                        useBothWheelAxes: !1,
                        wheelPropagation: !0,
                        wheelSpeed: 1,
                    }),
                    e))
                        this.settings[i] = e[i];
                    (this.containerWidth = null),
                        (this.containerHeight = null),
                        (this.contentWidth = null),
                        (this.contentHeight = null);
                    var o,
                        r,
                        s = function () {
                            return t.classList.add(Et.focus);
                        },
                        a = function () {
                            return t.classList.remove(Et.focus);
                        };
                    (this.isRtl = "rtl" === ht(t).direction),
                        !0 === this.isRtl && t.classList.add(yt),
                        (this.isNegativeScroll =
                            ((r = t.scrollLeft),
                            (t.scrollLeft = -1),
                            (o = t.scrollLeft < 0),
                            (t.scrollLeft = r),
                            o)),
                        (this.negativeScrollAdjustment = this.isNegativeScroll
                            ? t.scrollWidth - t.clientWidth
                            : 0),
                        (this.event = new At()),
                        (this.ownerDocument = t.ownerDocument || document),
                        (this.scrollbarXRail = pt(wt.rail("x"))),
                        t.appendChild(this.scrollbarXRail),
                        (this.scrollbarX = pt(wt.thumb("x"))),
                        this.scrollbarXRail.appendChild(this.scrollbarX),
                        this.scrollbarX.setAttribute("tabindex", 0),
                        this.event.bind(this.scrollbarX, "focus", s),
                        this.event.bind(this.scrollbarX, "blur", a),
                        (this.scrollbarXActive = null),
                        (this.scrollbarXWidth = null),
                        (this.scrollbarXLeft = null);
                    var l = ht(this.scrollbarXRail);
                    (this.scrollbarXBottom = parseInt(l.bottom, 10)),
                        isNaN(this.scrollbarXBottom)
                            ? ((this.isScrollbarXUsingBottom = !1),
                              (this.scrollbarXTop = Dt(l.top)))
                            : (this.isScrollbarXUsingBottom = !0),
                        (this.railBorderXWidth =
                            Dt(l.borderLeftWidth) + Dt(l.borderRightWidth)),
                        dt(this.scrollbarXRail, { display: "block" }),
                        (this.railXMarginWidth =
                            Dt(l.marginLeft) + Dt(l.marginRight)),
                        dt(this.scrollbarXRail, { display: "" }),
                        (this.railXWidth = null),
                        (this.railXRatio = null),
                        (this.scrollbarYRail = pt(wt.rail("y"))),
                        t.appendChild(this.scrollbarYRail),
                        (this.scrollbarY = pt(wt.thumb("y"))),
                        this.scrollbarYRail.appendChild(this.scrollbarY),
                        this.scrollbarY.setAttribute("tabindex", 0),
                        this.event.bind(this.scrollbarY, "focus", s),
                        this.event.bind(this.scrollbarY, "blur", a),
                        (this.scrollbarYActive = null),
                        (this.scrollbarYHeight = null),
                        (this.scrollbarYTop = null);
                    var c = ht(this.scrollbarYRail);
                    (this.scrollbarYRight = parseInt(c.right, 10)),
                        isNaN(this.scrollbarYRight)
                            ? ((this.isScrollbarYUsingRight = !1),
                              (this.scrollbarYLeft = Dt(c.left)))
                            : (this.isScrollbarYUsingRight = !0),
                        (this.scrollbarYOuterWidth = this.isRtl
                            ? (function (t) {
                                  var e = ht(t);
                                  return (
                                      Dt(e.width) +
                                      Dt(e.paddingLeft) +
                                      Dt(e.paddingRight) +
                                      Dt(e.borderLeftWidth) +
                                      Dt(e.borderRightWidth)
                                  );
                              })(this.scrollbarY)
                            : null),
                        (this.railBorderYWidth =
                            Dt(c.borderTopWidth) + Dt(c.borderBottomWidth)),
                        dt(this.scrollbarYRail, { display: "block" }),
                        (this.railYMarginHeight =
                            Dt(c.marginTop) + Dt(c.marginBottom)),
                        dt(this.scrollbarYRail, { display: "" }),
                        (this.railYHeight = null),
                        (this.railYRatio = null),
                        (this.reach = {
                            x:
                                t.scrollLeft <= 0
                                    ? "start"
                                    : t.scrollLeft >=
                                      this.contentWidth - this.containerWidth
                                    ? "end"
                                    : null,
                            y:
                                t.scrollTop <= 0
                                    ? "start"
                                    : t.scrollTop >=
                                      this.contentHeight - this.containerHeight
                                    ? "end"
                                    : null,
                        }),
                        (this.isAlive = !0),
                        this.settings.handlers.forEach(function (t) {
                            return Pt[t](n);
                        }),
                        (this.lastScrollTop = Math.floor(t.scrollTop)),
                        (this.lastScrollLeft = t.scrollLeft),
                        this.event.bind(this.element, "scroll", function (t) {
                            return n.onScroll(t);
                        }),
                        It(this);
                };
            (Ht.prototype.update = function () {
                this.isAlive &&
                    ((this.negativeScrollAdjustment = this.isNegativeScroll
                        ? this.element.scrollWidth - this.element.clientWidth
                        : 0),
                    dt(this.scrollbarXRail, { display: "block" }),
                    dt(this.scrollbarYRail, { display: "block" }),
                    (this.railXMarginWidth =
                        Dt(ht(this.scrollbarXRail).marginLeft) +
                        Dt(ht(this.scrollbarXRail).marginRight)),
                    (this.railYMarginHeight =
                        Dt(ht(this.scrollbarYRail).marginTop) +
                        Dt(ht(this.scrollbarYRail).marginBottom)),
                    dt(this.scrollbarXRail, { display: "none" }),
                    dt(this.scrollbarYRail, { display: "none" }),
                    It(this),
                    xt(this, "top", 0, !1, !0),
                    xt(this, "left", 0, !1, !0),
                    dt(this.scrollbarXRail, { display: "" }),
                    dt(this.scrollbarYRail, { display: "" }));
            }),
                (Ht.prototype.onScroll = function (t) {
                    this.isAlive &&
                        (It(this),
                        xt(
                            this,
                            "top",
                            this.element.scrollTop - this.lastScrollTop
                        ),
                        xt(
                            this,
                            "left",
                            this.element.scrollLeft - this.lastScrollLeft
                        ),
                        (this.lastScrollTop = Math.floor(
                            this.element.scrollTop
                        )),
                        (this.lastScrollLeft = this.element.scrollLeft));
                }),
                (Ht.prototype.destroy = function () {
                    this.isAlive &&
                        (this.event.unbindAll(),
                        vt(this.scrollbarX),
                        vt(this.scrollbarY),
                        vt(this.scrollbarXRail),
                        vt(this.scrollbarYRail),
                        this.removePsClasses(),
                        (this.element = null),
                        (this.scrollbarX = null),
                        (this.scrollbarY = null),
                        (this.scrollbarXRail = null),
                        (this.scrollbarYRail = null),
                        (this.isAlive = !1));
                }),
                (Ht.prototype.removePsClasses = function () {
                    this.element.className = this.element.className
                        .split(" ")
                        .filter(function (t) {
                            return !t.match(/^ps([-_].+|)$/);
                        })
                        .join(" ");
                });
            const Wt = Ht;
            function Yt(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    (i.enumerable = i.enumerable || !1),
                        (i.configurable = !0),
                        "value" in i && (i.writable = !0),
                        Object.defineProperty(t, i.key, i);
                }
            }
            function Mt(t, e, n) {
                return e && Yt(t.prototype, e), n && Yt(t, n), t;
            }
            function Xt(t, e, n) {
                return (
                    e in t
                        ? Object.defineProperty(t, e, {
                              value: n,
                              enumerable: !0,
                              configurable: !0,
                              writable: !0,
                          })
                        : (t[e] = n),
                    t
                );
            }
            function Bt(t, e) {
                var n = Object.keys(t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(t);
                    e &&
                        (i = i.filter(function (e) {
                            return Object.getOwnPropertyDescriptor(
                                t,
                                e
                            ).enumerable;
                        })),
                        n.push.apply(n, i);
                }
                return n;
            }
            function Ut(t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? Bt(Object(n), !0).forEach(function (e) {
                              Xt(t, e, n[e]);
                          })
                        : Object.getOwnPropertyDescriptors
                        ? Object.defineProperties(
                              t,
                              Object.getOwnPropertyDescriptors(n)
                          )
                        : Bt(Object(n)).forEach(function (e) {
                              Object.defineProperty(
                                  t,
                                  e,
                                  Object.getOwnPropertyDescriptor(n, e)
                              );
                          });
                }
                return t;
            }
            var qt,
                Qt,
                Vt,
                Ft,
                zt = "transitionend",
                Kt = function (t) {
                    do {
                        t += Math.floor(1e6 * Math.random());
                    } while (document.getElementById(t));
                    return t;
                },
                $t = function (t) {
                    var e = t.getAttribute("data-target");
                    if (!e || "#" === e) {
                        var n = t.getAttribute("href");
                        e = n && "#" !== n ? n.trim() : null;
                    }
                    return e;
                },
                Gt = function (t) {
                    var e = $t(t);
                    return e && document.querySelector(e) ? e : null;
                },
                Jt = function (t) {
                    var e = $t(t);
                    return e ? document.querySelector(e) : null;
                },
                Zt = function (t) {
                    if (!t) return 0;
                    var e = window.getComputedStyle(t),
                        n = e.transitionDuration,
                        i = e.transitionDelay,
                        o = parseFloat(n),
                        r = parseFloat(i);
                    return o || r
                        ? ((n = n.split(",")[0]),
                          (i = i.split(",")[0]),
                          1e3 * (parseFloat(n) + parseFloat(i)))
                        : 0;
                },
                te = function (t) {
                    t.dispatchEvent(new Event(zt));
                },
                ee = function (t) {
                    return (t[0] || t).nodeType;
                },
                ne = function (t, e) {
                    var n = !1,
                        i = e + 5;
                    t.addEventListener(zt, function e() {
                        (n = !0), t.removeEventListener(zt, e);
                    }),
                        setTimeout(function () {
                            n || te(t);
                        }, i);
                },
                ie = function (t, e, n) {
                    Object.keys(n).forEach(function (i) {
                        var o,
                            r = n[i],
                            s = e[i],
                            a =
                                s && ee(s)
                                    ? "element"
                                    : null == (o = s)
                                    ? "" + o
                                    : {}.toString
                                          .call(o)
                                          .match(/\s([a-z]+)/i)[1]
                                          .toLowerCase();
                        if (!new RegExp(r).test(a))
                            throw new Error(
                                t.toUpperCase() +
                                    ': Option "' +
                                    i +
                                    '" provided type "' +
                                    a +
                                    '" but expected type "' +
                                    r +
                                    '".'
                            );
                    });
                },
                oe = function (t) {
                    if (!t) return !1;
                    if (t.style && t.parentNode && t.parentNode.style) {
                        var e = getComputedStyle(t),
                            n = getComputedStyle(t.parentNode);
                        return (
                            "none" !== e.display &&
                            "none" !== n.display &&
                            "hidden" !== e.visibility
                        );
                    }
                    return !1;
                },
                re = function t(e) {
                    if (!document.documentElement.attachShadow) return null;
                    if ("function" == typeof e.getRootNode) {
                        var n = e.getRootNode();
                        return n instanceof ShadowRoot ? n : null;
                    }
                    return e instanceof ShadowRoot
                        ? e
                        : e.parentNode
                        ? t(e.parentNode)
                        : null;
                },
                se = function () {
                    return function () {};
                },
                ae = function (t) {
                    return t.offsetHeight;
                },
                le = function () {
                    var t = window.jQuery;
                    return t && !document.body.hasAttribute("data-no-jquery")
                        ? t
                        : null;
                },
                ce =
                    ((qt = {}),
                    (Qt = 1),
                    {
                        set: function (t, e, n) {
                            void 0 === t.key &&
                                ((t.key = { key: e, id: Qt }), Qt++),
                                (qt[t.key.id] = n);
                        },
                        get: function (t, e) {
                            if (!t || void 0 === t.key) return null;
                            var n = t.key;
                            return n.key === e ? qt[n.id] : null;
                        },
                        delete: function (t, e) {
                            if (void 0 !== t.key) {
                                var n = t.key;
                                n.key === e && (delete qt[n.id], delete t.key);
                            }
                        },
                    }),
                ue = function (t, e, n) {
                    ce.set(t, e, n);
                },
                fe = function (t, e) {
                    return ce.get(t, e);
                },
                he = function (t, e) {
                    ce.delete(t, e);
                },
                de = Element.prototype.querySelectorAll,
                pe = Element.prototype.querySelector,
                ge =
                    ((Vt = new CustomEvent("Bootstrap", { cancelable: !0 })),
                    (Ft = document.createElement("div")).addEventListener(
                        "Bootstrap",
                        function () {
                            return null;
                        }
                    ),
                    Vt.preventDefault(),
                    Ft.dispatchEvent(Vt),
                    Vt.defaultPrevented),
                me = /:scope\b/;
            (function () {
                var t = document.createElement("div");
                try {
                    t.querySelectorAll(":scope *");
                } catch (t) {
                    return !1;
                }
                return !0;
            })() ||
                ((de = function (t) {
                    if (!me.test(t)) return this.querySelectorAll(t);
                    var e = Boolean(this.id);
                    e || (this.id = Kt("scope"));
                    var n = null;
                    try {
                        (t = t.replace(me, "#" + this.id)),
                            (n = this.querySelectorAll(t));
                    } finally {
                        e || this.removeAttribute("id");
                    }
                    return n;
                }),
                (pe = function (t) {
                    if (!me.test(t)) return this.querySelector(t);
                    var e = de.call(this, t);
                    return void 0 !== e[0] ? e[0] : null;
                }));
            var ve = le(),
                _e = /[^.]*(?=\..*)\.|.*/,
                be = /\..*/,
                ye = /::\d+$/,
                we = {},
                Ee = 1,
                Le = { mouseenter: "mouseover", mouseleave: "mouseout" },
                ke = [
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
                ];
            function Te(t, e) {
                return (e && e + "::" + Ee++) || t.uidEvent || Ee++;
            }
            function Ce(t) {
                var e = Te(t);
                return (t.uidEvent = e), (we[e] = we[e] || {}), we[e];
            }
            function Oe(t, e, n) {
                void 0 === n && (n = null);
                for (var i = Object.keys(t), o = 0, r = i.length; o < r; o++) {
                    var s = t[i[o]];
                    if (s.originalHandler === e && s.delegationSelector === n)
                        return s;
                }
                return null;
            }
            function Ae(t, e, n) {
                var i = "string" == typeof e,
                    o = i ? n : e,
                    r = t.replace(be, ""),
                    s = Le[r];
                return s && (r = s), ke.indexOf(r) > -1 || (r = t), [i, o, r];
            }
            function Se(t, e, n, i, o) {
                if ("string" == typeof e && t) {
                    n || ((n = i), (i = null));
                    var r = Ae(e, n, i),
                        s = r[0],
                        a = r[1],
                        l = r[2],
                        c = Ce(t),
                        u = c[l] || (c[l] = {}),
                        f = Oe(u, a, s ? n : null);
                    if (f) f.oneOff = f.oneOff && o;
                    else {
                        var h = Te(a, e.replace(_e, "")),
                            d = s
                                ? (function (t, e, n) {
                                      return function i(o) {
                                          for (
                                              var r = t.querySelectorAll(e),
                                                  s = o.target;
                                              s && s !== this;
                                              s = s.parentNode
                                          )
                                              for (var a = r.length; a--; )
                                                  if (r[a] === s)
                                                      return (
                                                          (o.delegateTarget =
                                                              s),
                                                          i.oneOff &&
                                                              De.off(
                                                                  t,
                                                                  o.type,
                                                                  n
                                                              ),
                                                          n.apply(s, [o])
                                                      );
                                          return null;
                                      };
                                  })(t, n, i)
                                : (function (t, e) {
                                      return function n(i) {
                                          return (
                                              (i.delegateTarget = t),
                                              n.oneOff && De.off(t, i.type, e),
                                              e.apply(t, [i])
                                          );
                                      };
                                  })(t, n);
                        (d.delegationSelector = s ? n : null),
                            (d.originalHandler = a),
                            (d.oneOff = o),
                            (d.uidEvent = h),
                            (u[h] = d),
                            t.addEventListener(l, d, s);
                    }
                }
            }
            function xe(t, e, n, i, o) {
                var r = Oe(e[n], i, o);
                r &&
                    (t.removeEventListener(n, r, Boolean(o)),
                    delete e[n][r.uidEvent]);
            }
            var De = {
                    on: function (t, e, n, i) {
                        Se(t, e, n, i, !1);
                    },
                    one: function (t, e, n, i) {
                        Se(t, e, n, i, !0);
                    },
                    off: function (t, e, n, i) {
                        if ("string" == typeof e && t) {
                            var o = Ae(e, n, i),
                                r = o[0],
                                s = o[1],
                                a = o[2],
                                l = a !== e,
                                c = Ce(t),
                                u = "." === e.charAt(0);
                            if (void 0 === s) {
                                u &&
                                    Object.keys(c).forEach(function (n) {
                                        !(function (t, e, n, i) {
                                            var o = e[n] || {};
                                            Object.keys(o).forEach(function (
                                                r
                                            ) {
                                                if (r.indexOf(i) > -1) {
                                                    var s = o[r];
                                                    xe(
                                                        t,
                                                        e,
                                                        n,
                                                        s.originalHandler,
                                                        s.delegationSelector
                                                    );
                                                }
                                            });
                                        })(t, c, n, e.slice(1));
                                    });
                                var f = c[a] || {};
                                Object.keys(f).forEach(function (n) {
                                    var i = n.replace(ye, "");
                                    if (!l || e.indexOf(i) > -1) {
                                        var o = f[n];
                                        xe(
                                            t,
                                            c,
                                            a,
                                            o.originalHandler,
                                            o.delegationSelector
                                        );
                                    }
                                });
                            } else {
                                if (!c || !c[a]) return;
                                xe(t, c, a, s, r ? n : null);
                            }
                        }
                    },
                    trigger: function (t, e, n) {
                        if ("string" != typeof e || !t) return null;
                        var i,
                            o = e.replace(be, ""),
                            r = e !== o,
                            s = ke.indexOf(o) > -1,
                            a = !0,
                            l = !0,
                            c = !1,
                            u = null;
                        return (
                            r &&
                                ve &&
                                ((i = ve.Event(e, n)),
                                ve(t).trigger(i),
                                (a = !i.isPropagationStopped()),
                                (l = !i.isImmediatePropagationStopped()),
                                (c = i.isDefaultPrevented())),
                            s
                                ? (u =
                                      document.createEvent(
                                          "HTMLEvents"
                                      )).initEvent(o, a, !0)
                                : (u = new CustomEvent(e, {
                                      bubbles: a,
                                      cancelable: !0,
                                  })),
                            void 0 !== n &&
                                Object.keys(n).forEach(function (t) {
                                    Object.defineProperty(u, t, {
                                        get: function () {
                                            return n[t];
                                        },
                                    });
                                }),
                            c &&
                                (u.preventDefault(),
                                ge ||
                                    Object.defineProperty(
                                        u,
                                        "defaultPrevented",
                                        {
                                            get: function () {
                                                return !0;
                                            },
                                        }
                                    )),
                            l && t.dispatchEvent(u),
                            u.defaultPrevented &&
                                void 0 !== i &&
                                i.preventDefault(),
                            u
                        );
                    },
                },
                Ne = "asyncLoad",
                Ie = "coreui.asyncLoad",
                je = "c-active",
                Re = "c-show",
                Pe = ".c-sidebar-nav-dropdown",
                He = ".c-xhr-link, .c-sidebar-nav-link",
                We = {
                    defaultPage: "main.html",
                    errorPage: "404.html",
                    subpagesDirectory: "views/",
                },
                Ye = (function () {
                    function t(t, e) {
                        (this._config = this._getConfig(e)),
                            (this._element = t);
                        var n = location.hash.replace(/^#/, "");
                        "" !== n
                            ? this._setUpUrl(n)
                            : this._setUpUrl(this._config.defaultPage),
                            this._addEventListeners();
                    }
                    var e = t.prototype;
                    return (
                        (e._getConfig = function (t) {
                            return (t = Ut(Ut({}, We), t));
                        }),
                        (e._loadPage = function (t) {
                            var e = this,
                                n = this._element,
                                i = this._config,
                                o = function t(n, i) {
                                    void 0 === i && (i = 0);
                                    var o = document.createElement("script");
                                    (o.type = "text/javascript"),
                                        (o.src = n[i]),
                                        (o.className = "view-script"),
                                        (o.onload = o.onreadystatechange =
                                            function () {
                                                (e.readyState &&
                                                    "complete" !==
                                                        e.readyState) ||
                                                    (n.length > i + 1 &&
                                                        t(n, i + 1));
                                            }),
                                        document
                                            .getElementsByTagName("body")[0]
                                            .appendChild(o);
                                },
                                r = new XMLHttpRequest();
                            r.open("GET", i.subpagesDirectory + t);
                            var s = new CustomEvent("xhr", {
                                detail: { url: t, status: r.status },
                            });
                            n.dispatchEvent(s),
                                (r.onload = function (e) {
                                    if (200 === r.status) {
                                        (s = new CustomEvent("xhr", {
                                            detail: {
                                                url: t,
                                                status: r.status,
                                            },
                                        })),
                                            n.dispatchEvent(s);
                                        var a = document.createElement("div");
                                        a.innerHTML = e.target.response;
                                        var l = Array.from(
                                            a.querySelectorAll("script")
                                        ).map(function (t) {
                                            return t.attributes.getNamedItem(
                                                "src"
                                            ).nodeValue;
                                        });
                                        a
                                            .querySelectorAll("script")
                                            .forEach(function (t) {
                                                return t.remove(t);
                                            }),
                                            window.scrollTo(0, 0),
                                            (n.innerHTML = ""),
                                            n.appendChild(a),
                                            (c =
                                                document.querySelectorAll(
                                                    ".view-script"
                                                )).length &&
                                                c.forEach(function (t) {
                                                    t.remove();
                                                }),
                                            l.length && o(l),
                                            (window.location.hash = t);
                                    } else window.location.href = i.errorPage;
                                    var c;
                                }),
                                r.send();
                        }),
                        (e._setUpUrl = function (t) {
                            (t = t.replace(/^\//, "").split("?")[0]),
                                Array.from(
                                    document.querySelectorAll(He)
                                ).forEach(function (t) {
                                    t.classList.remove(je);
                                }),
                                Array.from(
                                    document.querySelectorAll(He)
                                ).forEach(function (t) {
                                    t.classList.remove(je);
                                }),
                                Array.from(
                                    document.querySelectorAll(Pe)
                                ).forEach(function (t) {
                                    t.classList.remove(Re);
                                }),
                                Array.from(
                                    document.querySelectorAll(Pe)
                                ).forEach(function (e) {
                                    Array.from(
                                        e.querySelectorAll(
                                            'a[href*="' + t + '"]'
                                        )
                                    ).length > 0 && e.classList.add(Re);
                                }),
                                Array.from(
                                    document.querySelectorAll(
                                        '.c-sidebar-nav-item a[href*="' +
                                            t +
                                            '"]'
                                    )
                                ).forEach(function (t) {
                                    t.classList.add(je);
                                }),
                                this._loadPage(t);
                        }),
                        (e._loadBlank = function (t) {
                            window.open(t);
                        }),
                        (e._loadTop = function (t) {
                            window.location = t;
                        }),
                        (e._update = function (t) {
                            "#" !== t.href &&
                                ((void 0 !== t.dataset.toggle &&
                                    "null" !== t.dataset.toggle) ||
                                    ("_top" === t.target
                                        ? this._loadTop(t.href)
                                        : "_blank" === t.target
                                        ? this._loadBlank(t.href)
                                        : this._setUpUrl(
                                              t.getAttribute("href")
                                          )));
                        }),
                        (e._addEventListeners = function () {
                            var t = this;
                            De.on(
                                document,
                                "click.coreui.asyncLoad.data-api",
                                He,
                                function (e) {
                                    e.preventDefault();
                                    var n = e.target;
                                    n.classList.contains(
                                        "c-sidebar-nav-link"
                                    ) || (n = n.closest(He)),
                                        n.classList.contains(
                                            "c-sidebar-nav-dropdown-toggle"
                                        ) ||
                                            "#" === n.getAttribute("href") ||
                                            t._update(n);
                                }
                            );
                        }),
                        (t._asyncLoadInterface = function (e, n) {
                            var i = fe(e, Ie);
                            if (
                                (i || (i = new t(e, "object" == typeof n && n)),
                                "string" == typeof n)
                            ) {
                                if (void 0 === i[n])
                                    throw new TypeError(
                                        'No method named "' + n + '"'
                                    );
                                i[n]();
                            }
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                t._asyncLoadInterface(this, e);
                            });
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return We;
                                },
                            },
                        ]),
                        t
                    );
                })(),
                Me = le();
            if (Me) {
                var Xe = Me.fn[Ne];
                (Me.fn[Ne] = Ye.jQueryInterface),
                    (Me.fn[Ne].Constructor = Ye),
                    (Me.fn[Ne].noConflict = function () {
                        return (Me.fn[Ne] = Xe), Ye.jQueryInterface;
                    });
            }
            var Be = "coreui.alert",
                Ue = (function () {
                    function t(t) {
                        (this._element = t), this._element && ue(t, Be, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.close = function (t) {
                            var e = t ? this._getRootElement(t) : this._element,
                                n = this._triggerCloseEvent(e);
                            null === n ||
                                n.defaultPrevented ||
                                this._removeElement(e);
                        }),
                        (e.dispose = function () {
                            he(this._element, Be), (this._element = null);
                        }),
                        (e._getRootElement = function (t) {
                            return Jt(t) || t.closest(".alert");
                        }),
                        (e._triggerCloseEvent = function (t) {
                            return De.trigger(t, "close.coreui.alert");
                        }),
                        (e._removeElement = function (t) {
                            var e = this;
                            if (
                                (t.classList.remove("show"),
                                t.classList.contains("fade"))
                            ) {
                                var n = Zt(t);
                                De.one(t, zt, function () {
                                    return e._destroyElement(t);
                                }),
                                    ne(t, n);
                            } else this._destroyElement(t);
                        }),
                        (e._destroyElement = function (t) {
                            t.parentNode && t.parentNode.removeChild(t),
                                De.trigger(t, "closed.coreui.alert");
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                var n = fe(this, Be);
                                n || (n = new t(this)),
                                    "close" === e && n[e](this);
                            });
                        }),
                        (t.handleDismiss = function (t) {
                            return function (e) {
                                e && e.preventDefault(), t.close(this);
                            };
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Be);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(
                document,
                "click.coreui.alert.data-api",
                '[data-dismiss="alert"]',
                Ue.handleDismiss(new Ue())
            );
            var qe = le();
            if (qe) {
                var Qe = qe.fn.alert;
                (qe.fn.alert = Ue.jQueryInterface),
                    (qe.fn.alert.Constructor = Ue),
                    (qe.fn.alert.noConflict = function () {
                        return (qe.fn.alert = Qe), Ue.jQueryInterface;
                    });
            }
            var Ve = {
                    matches: function (t, e) {
                        return t.matches(e);
                    },
                    find: function (t, e) {
                        var n;
                        return (
                            void 0 === e && (e = document.documentElement),
                            (n = []).concat.apply(n, de.call(e, t))
                        );
                    },
                    findOne: function (t, e) {
                        return (
                            void 0 === e && (e = document.documentElement),
                            pe.call(e, t)
                        );
                    },
                    children: function (t, e) {
                        var n,
                            i = (n = []).concat.apply(n, t.children);
                        return i.filter(function (t) {
                            return t.matches(e);
                        });
                    },
                    parents: function (t, e) {
                        for (
                            var n = [], i = t.parentNode;
                            i &&
                            i.nodeType === Node.ELEMENT_NODE &&
                            3 !== i.nodeType;

                        )
                            this.matches(i, e) && n.push(i), (i = i.parentNode);
                        return n;
                    },
                    prev: function (t, e) {
                        for (var n = t.previousElementSibling; n; ) {
                            if (n.matches(e)) return [n];
                            n = n.previousElementSibling;
                        }
                        return [];
                    },
                    next: function (t, e) {
                        for (var n = t.nextElementSibling; n; ) {
                            if (this.matches(n, e)) return [n];
                            n = n.nextElementSibling;
                        }
                        return [];
                    },
                },
                Fe = "coreui.button",
                ze = "active",
                Ke = "disabled",
                $e = "focus",
                Ge = '[data-toggle^="button"]',
                Je = ".btn",
                Ze = (function () {
                    function t(t) {
                        (this._element = t), ue(t, Fe, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.toggle = function () {
                            var t = !0,
                                e = !0,
                                n = this._element.closest(
                                    '[data-toggle="buttons"]'
                                );
                            if (n) {
                                var i = Ve.findOne(
                                    'input:not([type="hidden"])',
                                    this._element
                                );
                                if (i && "radio" === i.type) {
                                    if (
                                        i.checked &&
                                        this._element.classList.contains(ze)
                                    )
                                        t = !1;
                                    else {
                                        var o = Ve.findOne(".active", n);
                                        o && o.classList.remove(ze);
                                    }
                                    if (t) {
                                        if (
                                            i.hasAttribute("disabled") ||
                                            n.hasAttribute("disabled") ||
                                            i.classList.contains(Ke) ||
                                            n.classList.contains(Ke)
                                        )
                                            return;
                                        (i.checked =
                                            !this._element.classList.contains(
                                                ze
                                            )),
                                            De.trigger(i, "change");
                                    }
                                    i.focus(), (e = !1);
                                }
                            }
                            e &&
                                this._element.setAttribute(
                                    "aria-pressed",
                                    !this._element.classList.contains(ze)
                                ),
                                t && this._element.classList.toggle(ze);
                        }),
                        (e.dispose = function () {
                            he(this._element, Fe), (this._element = null);
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                var n = fe(this, Fe);
                                n || (n = new t(this)),
                                    "toggle" === e && n[e]();
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Fe);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(document, "click.coreui.button.data-api", Ge, function (t) {
                t.preventDefault();
                var e = t.target.closest(Je),
                    n = fe(e, Fe);
                n || (n = new Ze(e)), n.toggle();
            }),
                De.on(
                    document,
                    "focus.coreui.button.data-api",
                    Ge,
                    function (t) {
                        var e = t.target.closest(Je);
                        e && e.classList.add($e);
                    }
                ),
                De.on(
                    document,
                    "blur.coreui.button.data-api",
                    Ge,
                    function (t) {
                        var e = t.target.closest(Je);
                        e && e.classList.remove($e);
                    }
                );
            var tn = le();
            if (tn) {
                var en = tn.fn.button;
                (tn.fn.button = Ze.jQueryInterface),
                    (tn.fn.button.Constructor = Ze),
                    (tn.fn.button.noConflict = function () {
                        return (tn.fn.button = en), Ze.jQueryInterface;
                    });
            }
            function nn(t) {
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
            function on(t) {
                return t.replace(/[A-Z]/g, function (t) {
                    return "-" + t.toLowerCase();
                });
            }
            var rn = {
                    setDataAttribute: function (t, e, n) {
                        t.setAttribute("data-" + on(e), n);
                    },
                    removeDataAttribute: function (t, e) {
                        t.removeAttribute("data-" + on(e));
                    },
                    getDataAttributes: function (t) {
                        if (!t) return {};
                        var e = Ut({}, t.dataset);
                        return (
                            Object.keys(e).forEach(function (t) {
                                e[t] = nn(e[t]);
                            }),
                            e
                        );
                    },
                    getDataAttribute: function (t, e) {
                        return nn(t.getAttribute("data-" + on(e)));
                    },
                    offset: function (t) {
                        var e = t.getBoundingClientRect();
                        return {
                            top: e.top + document.body.scrollTop,
                            left: e.left + document.body.scrollLeft,
                        };
                    },
                    position: function (t) {
                        return { top: t.offsetTop, left: t.offsetLeft };
                    },
                    toggleClass: function (t, e) {
                        t &&
                            (t.classList.contains(e)
                                ? t.classList.remove(e)
                                : t.classList.add(e));
                    },
                },
                sn = "carousel",
                an = "coreui.carousel",
                ln = "." + an,
                cn = {
                    interval: 5e3,
                    keyboard: !0,
                    slide: !1,
                    pause: "hover",
                    wrap: !0,
                    touch: !0,
                },
                un = {
                    interval: "(number|boolean)",
                    keyboard: "boolean",
                    slide: "(boolean|string)",
                    pause: "(string|boolean)",
                    wrap: "boolean",
                    touch: "boolean",
                },
                fn = "next",
                hn = "prev",
                dn = "slid" + ln,
                pn = "active",
                gn = ".active.carousel-item",
                mn = { TOUCH: "touch", PEN: "pen" },
                vn = (function () {
                    function t(t, e) {
                        (this._items = null),
                            (this._interval = null),
                            (this._activeElement = null),
                            (this._isPaused = !1),
                            (this._isSliding = !1),
                            (this.touchTimeout = null),
                            (this.touchStartX = 0),
                            (this.touchDeltaX = 0),
                            (this._config = this._getConfig(e)),
                            (this._element = t),
                            (this._indicatorsElement = Ve.findOne(
                                ".carousel-indicators",
                                this._element
                            )),
                            (this._touchSupported =
                                "ontouchstart" in document.documentElement ||
                                navigator.maxTouchPoints > 0),
                            (this._pointerEvent = Boolean(
                                window.PointerEvent || window.MSPointerEvent
                            )),
                            this._addEventListeners(),
                            ue(t, an, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.next = function () {
                            this._isSliding || this._slide(fn);
                        }),
                        (e.nextWhenVisible = function () {
                            !document.hidden &&
                                oe(this._element) &&
                                this.next();
                        }),
                        (e.prev = function () {
                            this._isSliding || this._slide(hn);
                        }),
                        (e.pause = function (t) {
                            t || (this._isPaused = !0),
                                Ve.findOne(
                                    ".carousel-item-next, .carousel-item-prev",
                                    this._element
                                ) && (te(this._element), this.cycle(!0)),
                                clearInterval(this._interval),
                                (this._interval = null);
                        }),
                        (e.cycle = function (t) {
                            t || (this._isPaused = !1),
                                this._interval &&
                                    (clearInterval(this._interval),
                                    (this._interval = null)),
                                this._config &&
                                    this._config.interval &&
                                    !this._isPaused &&
                                    (this._interval = setInterval(
                                        (document.visibilityState
                                            ? this.nextWhenVisible
                                            : this.next
                                        ).bind(this),
                                        this._config.interval
                                    ));
                        }),
                        (e.to = function (t) {
                            var e = this;
                            this._activeElement = Ve.findOne(gn, this._element);
                            var n = this._getItemIndex(this._activeElement);
                            if (!(t > this._items.length - 1 || t < 0))
                                if (this._isSliding)
                                    De.one(this._element, dn, function () {
                                        return e.to(t);
                                    });
                                else {
                                    if (n === t)
                                        return this.pause(), void this.cycle();
                                    var i = t > n ? fn : hn;
                                    this._slide(i, this._items[t]);
                                }
                        }),
                        (e.dispose = function () {
                            De.off(this._element, ln),
                                he(this._element, an),
                                (this._items = null),
                                (this._config = null),
                                (this._element = null),
                                (this._interval = null),
                                (this._isPaused = null),
                                (this._isSliding = null),
                                (this._activeElement = null),
                                (this._indicatorsElement = null);
                        }),
                        (e._getConfig = function (t) {
                            return (t = Ut(Ut({}, cn), t)), ie(sn, t, un), t;
                        }),
                        (e._handleSwipe = function () {
                            var t = Math.abs(this.touchDeltaX);
                            if (!(t <= 40)) {
                                var e = t / this.touchDeltaX;
                                (this.touchDeltaX = 0),
                                    e > 0 && this.prev(),
                                    e < 0 && this.next();
                            }
                        }),
                        (e._addEventListeners = function () {
                            var t = this;
                            this._config.keyboard &&
                                De.on(
                                    this._element,
                                    "keydown.coreui.carousel",
                                    function (e) {
                                        return t._keydown(e);
                                    }
                                ),
                                "hover" === this._config.pause &&
                                    (De.on(
                                        this._element,
                                        "mouseenter.coreui.carousel",
                                        function (e) {
                                            return t.pause(e);
                                        }
                                    ),
                                    De.on(
                                        this._element,
                                        "mouseleave.coreui.carousel",
                                        function (e) {
                                            return t.cycle(e);
                                        }
                                    )),
                                this._config.touch &&
                                    this._touchSupported &&
                                    this._addTouchEventListeners();
                        }),
                        (e._addTouchEventListeners = function () {
                            var t = this,
                                e = function (e) {
                                    t._pointerEvent &&
                                    mn[e.pointerType.toUpperCase()]
                                        ? (t.touchStartX = e.clientX)
                                        : t._pointerEvent ||
                                          (t.touchStartX =
                                              e.touches[0].clientX);
                                },
                                n = function (e) {
                                    t._pointerEvent &&
                                        mn[e.pointerType.toUpperCase()] &&
                                        (t.touchDeltaX =
                                            e.clientX - t.touchStartX),
                                        t._handleSwipe(),
                                        "hover" === t._config.pause &&
                                            (t.pause(),
                                            t.touchTimeout &&
                                                clearTimeout(t.touchTimeout),
                                            (t.touchTimeout = setTimeout(
                                                function (e) {
                                                    return t.cycle(e);
                                                },
                                                500 + t._config.interval
                                            )));
                                };
                            Ve.find(
                                ".carousel-item img",
                                this._element
                            ).forEach(function (t) {
                                De.on(
                                    t,
                                    "dragstart.coreui.carousel",
                                    function (t) {
                                        return t.preventDefault();
                                    }
                                );
                            }),
                                this._pointerEvent
                                    ? (De.on(
                                          this._element,
                                          "pointerdown.coreui.carousel",
                                          function (t) {
                                              return e(t);
                                          }
                                      ),
                                      De.on(
                                          this._element,
                                          "pointerup.coreui.carousel",
                                          function (t) {
                                              return n(t);
                                          }
                                      ),
                                      this._element.classList.add(
                                          "pointer-event"
                                      ))
                                    : (De.on(
                                          this._element,
                                          "touchstart.coreui.carousel",
                                          function (t) {
                                              return e(t);
                                          }
                                      ),
                                      De.on(
                                          this._element,
                                          "touchmove.coreui.carousel",
                                          function (e) {
                                              return (function (e) {
                                                  e.touches &&
                                                  e.touches.length > 1
                                                      ? (t.touchDeltaX = 0)
                                                      : (t.touchDeltaX =
                                                            e.touches[0]
                                                                .clientX -
                                                            t.touchStartX);
                                              })(e);
                                          }
                                      ),
                                      De.on(
                                          this._element,
                                          "touchend.coreui.carousel",
                                          function (t) {
                                              return n(t);
                                          }
                                      ));
                        }),
                        (e._keydown = function (t) {
                            if (!/input|textarea/i.test(t.target.tagName))
                                switch (t.key) {
                                    case "ArrowLeft":
                                        t.preventDefault(), this.prev();
                                        break;
                                    case "ArrowRight":
                                        t.preventDefault(), this.next();
                                }
                        }),
                        (e._getItemIndex = function (t) {
                            return (
                                (this._items =
                                    t && t.parentNode
                                        ? Ve.find(
                                              ".carousel-item",
                                              t.parentNode
                                          )
                                        : []),
                                this._items.indexOf(t)
                            );
                        }),
                        (e._getItemByDirection = function (t, e) {
                            var n = t === fn,
                                i = t === hn,
                                o = this._getItemIndex(e),
                                r = this._items.length - 1;
                            if (
                                ((i && 0 === o) || (n && o === r)) &&
                                !this._config.wrap
                            )
                                return e;
                            var s =
                                (o + (t === hn ? -1 : 1)) % this._items.length;
                            return -1 === s
                                ? this._items[this._items.length - 1]
                                : this._items[s];
                        }),
                        (e._triggerSlideEvent = function (t, e) {
                            var n = this._getItemIndex(t),
                                i = this._getItemIndex(
                                    Ve.findOne(gn, this._element)
                                );
                            return De.trigger(
                                this._element,
                                "slide.coreui.carousel",
                                {
                                    relatedTarget: t,
                                    direction: e,
                                    from: i,
                                    to: n,
                                }
                            );
                        }),
                        (e._setActiveIndicatorElement = function (t) {
                            if (this._indicatorsElement) {
                                for (
                                    var e = Ve.find(
                                            ".active",
                                            this._indicatorsElement
                                        ),
                                        n = 0;
                                    n < e.length;
                                    n++
                                )
                                    e[n].classList.remove(pn);
                                var i =
                                    this._indicatorsElement.children[
                                        this._getItemIndex(t)
                                    ];
                                i && i.classList.add(pn);
                            }
                        }),
                        (e._slide = function (t, e) {
                            var n,
                                i,
                                o,
                                r = this,
                                s = Ve.findOne(gn, this._element),
                                a = this._getItemIndex(s),
                                l = e || (s && this._getItemByDirection(t, s)),
                                c = this._getItemIndex(l),
                                u = Boolean(this._interval);
                            if (
                                (t === fn
                                    ? ((n = "carousel-item-left"),
                                      (i = "carousel-item-next"),
                                      (o = "left"))
                                    : ((n = "carousel-item-right"),
                                      (i = "carousel-item-prev"),
                                      (o = "right")),
                                l && l.classList.contains(pn))
                            )
                                this._isSliding = !1;
                            else if (
                                !this._triggerSlideEvent(l, o)
                                    .defaultPrevented &&
                                s &&
                                l
                            ) {
                                if (
                                    ((this._isSliding = !0),
                                    u && this.pause(),
                                    this._setActiveIndicatorElement(l),
                                    this._element.classList.contains("slide"))
                                ) {
                                    l.classList.add(i),
                                        ae(l),
                                        s.classList.add(n),
                                        l.classList.add(n);
                                    var f = parseInt(
                                        l.getAttribute("data-interval"),
                                        10
                                    );
                                    f
                                        ? ((this._config.defaultInterval =
                                              this._config.defaultInterval ||
                                              this._config.interval),
                                          (this._config.interval = f))
                                        : (this._config.interval =
                                              this._config.defaultInterval ||
                                              this._config.interval);
                                    var h = Zt(s);
                                    De.one(s, zt, function () {
                                        l.classList.remove(n, i),
                                            l.classList.add(pn),
                                            s.classList.remove(pn, i, n),
                                            (r._isSliding = !1),
                                            setTimeout(function () {
                                                De.trigger(r._element, dn, {
                                                    relatedTarget: l,
                                                    direction: o,
                                                    from: a,
                                                    to: c,
                                                });
                                            }, 0);
                                    }),
                                        ne(s, h);
                                } else
                                    s.classList.remove(pn),
                                        l.classList.add(pn),
                                        (this._isSliding = !1),
                                        De.trigger(this._element, dn, {
                                            relatedTarget: l,
                                            direction: o,
                                            from: a,
                                            to: c,
                                        });
                                u && this.cycle();
                            }
                        }),
                        (t.carouselInterface = function (e, n) {
                            var i = fe(e, an),
                                o = Ut(Ut({}, cn), rn.getDataAttributes(e));
                            "object" == typeof n && (o = Ut(Ut({}, o), n));
                            var r = "string" == typeof n ? n : o.slide;
                            if ((i || (i = new t(e, o)), "number" == typeof n))
                                i.to(n);
                            else if ("string" == typeof r) {
                                if (void 0 === i[r])
                                    throw new TypeError(
                                        'No method named "' + r + '"'
                                    );
                                i[r]();
                            } else
                                o.interval && o.ride && (i.pause(), i.cycle());
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                t.carouselInterface(this, e);
                            });
                        }),
                        (t.dataApiClickHandler = function (e) {
                            var n = Jt(this);
                            if (n && n.classList.contains("carousel")) {
                                var i = Ut(
                                        Ut({}, rn.getDataAttributes(n)),
                                        rn.getDataAttributes(this)
                                    ),
                                    o = this.getAttribute("data-slide-to");
                                o && (i.interval = !1),
                                    t.carouselInterface(n, i),
                                    o && fe(n, an).to(o),
                                    e.preventDefault();
                            }
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, an);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return cn;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(
                document,
                "click.coreui.carousel.data-api",
                "[data-slide], [data-slide-to]",
                vn.dataApiClickHandler
            ),
                De.on(window, "load.coreui.carousel.data-api", function () {
                    for (
                        var t = Ve.find('[data-ride="carousel"]'),
                            e = 0,
                            n = t.length;
                        e < n;
                        e++
                    )
                        vn.carouselInterface(t[e], fe(t[e], an));
                });
            var _n = le();
            if (_n) {
                var bn = _n.fn[sn];
                (_n.fn[sn] = vn.jQueryInterface),
                    (_n.fn[sn].Constructor = vn),
                    (_n.fn[sn].noConflict = function () {
                        return (_n.fn[sn] = bn), vn.jQueryInterface;
                    });
            }
            var yn = "class-toggler",
                wn = "coreui.class-toggler",
                En = {
                    addClass: "(null|array|string)",
                    breakpoints: "(null|array|string)",
                    removeClass: "(null|array|string)",
                    responsive: "(null|boolean)",
                    target: "(null|string)",
                    toggleClass: "(null|array|string)",
                },
                Ln = {
                    addClass: null,
                    breakpoints: ["", "sm", "md", "lg", "xl"],
                    removeClass: null,
                    responsive: !1,
                    target: "body",
                    toggleClass: null,
                },
                kn = "classremoved",
                Tn = "classtoggle",
                Cn = ".c-class-toggler",
                On = (function () {
                    function t(t, e) {
                        (this._element = t),
                            (this._config = this._getConfig(e)),
                            ue(t, wn, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.add = function () {
                            var t = this,
                                e = this._target();
                            this._config.addClass
                                .replace(/\s/g, "")
                                .split(",")
                                .forEach(function (n) {
                                    e.classList.add(n),
                                        t._customEvent("classadded", e, !0, n);
                                });
                        }),
                        (e.remove = function () {
                            var t = this,
                                e = this._target();
                            this._config.removeClass
                                .replace(/\s/g, "")
                                .split(",")
                                .forEach(function (n) {
                                    t._config.responsive
                                        ? t
                                              ._updateResponsiveClassNames(n)
                                              .forEach(function (n) {
                                                  e.classList.remove(n),
                                                      t._customEvent(
                                                          kn,
                                                          e,
                                                          !1,
                                                          n
                                                      );
                                              })
                                        : (e.classList.remove(n),
                                          t._customEvent(kn, e, !1, n));
                                });
                        }),
                        (e.toggle = function () {
                            var t = this,
                                e = this._target(),
                                n = this._config.toggleClass
                                    .replace(/\s/g, "")
                                    .split(",");
                            this._config.responsive
                                ? n.forEach(function (n) {
                                      t
                                          ._updateResponsiveClassNames(n)
                                          .filter(function (t) {
                                              return e.classList.contains(t);
                                          }).length
                                          ? t
                                                ._updateResponsiveClassNames(n)
                                                .forEach(function (n) {
                                                    (t._config.removeClass = n),
                                                        t.remove(),
                                                        t._customEvent(
                                                            Tn,
                                                            e,
                                                            !1,
                                                            n
                                                        );
                                                })
                                          : ((t._config.addClass = n),
                                            t.add(),
                                            t._customEvent(Tn, e, !0, n));
                                  })
                                : n.forEach(function (n) {
                                      e.classList.contains(n)
                                          ? ((t._config.removeClass = n),
                                            t.remove(),
                                            t._customEvent(Tn, e, !1, n))
                                          : ((t._config.addClass = n),
                                            t.add(),
                                            t._customEvent(Tn, e, !0, n));
                                  });
                        }),
                        (e.class = function () {
                            (this._config.toggleClass = this._config.class),
                                this._element.getAttribute("responsive") &&
                                    (this._config.responsive =
                                        this._element.getAttribute(
                                            "responsive"
                                        )),
                                this.toggle();
                        }),
                        (e._target = function () {
                            return "body" === this._config.target
                                ? document.querySelector(this._config.target)
                                : "_parent" === this._config.target
                                ? this._element.parentNode
                                : document.querySelector(this._config.target);
                        }),
                        (e._customEvent = function (t, e, n, i) {
                            var o = new CustomEvent(t, {
                                detail: { target: e, add: n, className: i },
                            });
                            e.dispatchEvent(o);
                        }),
                        (e._breakpoint = function (t) {
                            return this._config.breakpoints
                                .filter(function (t) {
                                    return t.length > 0;
                                })
                                .filter(function (e) {
                                    return t.includes(e);
                                })[0];
                        }),
                        (e._breakpoints = function (t) {
                            var e = this._config.breakpoints;
                            return e.slice(
                                0,
                                e.indexOf(
                                    e
                                        .filter(function (t) {
                                            return t.length > 0;
                                        })
                                        .filter(function (e) {
                                            return t.includes(e);
                                        })[0]
                                ) + 1
                            );
                        }),
                        (e._updateResponsiveClassNames = function (t) {
                            var e = this._breakpoint(t);
                            return this._breakpoints(t).map(function (n) {
                                return n.length > 0
                                    ? t.replace(e, n)
                                    : t.replace("-" + e, n);
                            });
                        }),
                        (e._includesResponsiveClass = function (t) {
                            var e = this;
                            return this._updateResponsiveClassNames(t).filter(
                                function (t) {
                                    return e._config.target.contains(t);
                                }
                            );
                        }),
                        (e._getConfig = function (t) {
                            return (
                                (t = Ut(
                                    Ut(
                                        Ut({}, this.constructor.Default),
                                        rn.getDataAttributes(this._element)
                                    ),
                                    t
                                )),
                                ie(yn, t, this.constructor.DefaultType),
                                t
                            );
                        }),
                        (t.classTogglerInterface = function (e, n) {
                            var i = fe(e, wn);
                            if (
                                (i || (i = new t(e, "object" == typeof n && n)),
                                "string" == typeof n)
                            ) {
                                if (void 0 === i[n])
                                    throw new TypeError(
                                        'No method named "' + n + '"'
                                    );
                                i[n]();
                            }
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                t.classTogglerInterface(this, e);
                            });
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return Ln;
                                },
                            },
                            {
                                key: "DefaultType",
                                get: function () {
                                    return En;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(
                document,
                "click.coreui.class-toggler.data-api",
                Cn,
                function (t) {
                    t.preventDefault(), t.stopPropagation();
                    var e = t.target;
                    e.classList.contains("c-class-toggler") ||
                        (e = e.closest(Cn)),
                        void 0 !== e.dataset.addClass &&
                            On.classTogglerInterface(e, "add"),
                        void 0 !== e.dataset.removeClass &&
                            On.classTogglerInterface(e, "remove"),
                        void 0 !== e.dataset.toggleClass &&
                            On.classTogglerInterface(e, "toggle"),
                        void 0 !== e.dataset.class &&
                            On.classTogglerInterface(e, "class");
                }
            );
            var An = le();
            if (An) {
                var Sn = An.fn[yn];
                (An.fn[yn] = On.jQueryInterface),
                    (An.fn[yn].Constructor = On),
                    (An.fn[yn].noConflict = function () {
                        return (An.fn[yn] = Sn), On.jQueryInterface;
                    });
            }
            var xn = "collapse",
                Dn = "coreui.collapse",
                Nn = { toggle: !0, parent: "" },
                In = { toggle: "boolean", parent: "(string|element)" },
                jn = "show",
                Rn = "collapse",
                Pn = "collapsing",
                Hn = "collapsed",
                Wn = "width",
                Yn = '[data-toggle="collapse"]',
                Mn = (function () {
                    function t(t, e) {
                        (this._isTransitioning = !1),
                            (this._element = t),
                            (this._config = this._getConfig(e)),
                            (this._triggerArray = Ve.find(
                                Yn +
                                    '[href="#' +
                                    t.id +
                                    '"],[data-toggle="collapse"][data-target="#' +
                                    t.id +
                                    '"]'
                            ));
                        for (
                            var n = Ve.find(Yn), i = 0, o = n.length;
                            i < o;
                            i++
                        ) {
                            var r = n[i],
                                s = Gt(r),
                                a = Ve.find(s).filter(function (e) {
                                    return e === t;
                                });
                            null !== s &&
                                a.length &&
                                ((this._selector = s),
                                this._triggerArray.push(r));
                        }
                        (this._parent = this._config.parent
                            ? this._getParent()
                            : null),
                            this._config.parent ||
                                this._addAriaAndCollapsedClass(
                                    this._element,
                                    this._triggerArray
                                ),
                            this._config.toggle && this.toggle(),
                            ue(t, Dn, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.toggle = function () {
                            this._element.classList.contains(jn)
                                ? this.hide()
                                : this.show();
                        }),
                        (e.show = function () {
                            var e = this;
                            if (
                                !this._isTransitioning &&
                                !this._element.classList.contains(jn)
                            ) {
                                var n, i;
                                this._parent &&
                                    0 ===
                                        (n = Ve.find(
                                            ".show, .collapsing",
                                            this._parent
                                        ).filter(function (t) {
                                            return "string" ==
                                                typeof e._config.parent
                                                ? t.getAttribute(
                                                      "data-parent"
                                                  ) === e._config.parent
                                                : t.classList.contains(Rn);
                                        })).length &&
                                    (n = null);
                                var o = Ve.findOne(this._selector);
                                if (n) {
                                    var r = n.filter(function (t) {
                                        return o !== t;
                                    });
                                    if (
                                        (i = r[0] ? fe(r[0], Dn) : null) &&
                                        i._isTransitioning
                                    )
                                        return;
                                }
                                if (
                                    !De.trigger(
                                        this._element,
                                        "show.coreui.collapse"
                                    ).defaultPrevented
                                ) {
                                    n &&
                                        n.forEach(function (e) {
                                            o !== e &&
                                                t.collapseInterface(e, "hide"),
                                                i || ue(e, Dn, null);
                                        });
                                    var s = this._getDimension();
                                    this._element.classList.remove(Rn),
                                        this._element.classList.add(Pn),
                                        (this._element.style[s] = 0),
                                        this._triggerArray.length &&
                                            this._triggerArray.forEach(
                                                function (t) {
                                                    t.classList.remove(Hn),
                                                        t.setAttribute(
                                                            "aria-expanded",
                                                            !0
                                                        );
                                                }
                                            ),
                                        this.setTransitioning(!0);
                                    var a =
                                            "scroll" +
                                            (s[0].toUpperCase() + s.slice(1)),
                                        l = Zt(this._element);
                                    De.one(this._element, zt, function () {
                                        e._element.classList.remove(Pn),
                                            e._element.classList.add(Rn, jn),
                                            (e._element.style[s] = ""),
                                            e.setTransitioning(!1),
                                            De.trigger(
                                                e._element,
                                                "shown.coreui.collapse"
                                            );
                                    }),
                                        ne(this._element, l),
                                        (this._element.style[s] =
                                            this._element[a] + "px");
                                }
                            }
                        }),
                        (e.hide = function () {
                            var t = this;
                            if (
                                !this._isTransitioning &&
                                this._element.classList.contains(jn) &&
                                !De.trigger(
                                    this._element,
                                    "hide.coreui.collapse"
                                ).defaultPrevented
                            ) {
                                var e = this._getDimension();
                                (this._element.style[e] =
                                    this._element.getBoundingClientRect()[e] +
                                    "px"),
                                    ae(this._element),
                                    this._element.classList.add(Pn),
                                    this._element.classList.remove(Rn, jn);
                                var n = this._triggerArray.length;
                                if (n > 0)
                                    for (var i = 0; i < n; i++) {
                                        var o = this._triggerArray[i],
                                            r = Jt(o);
                                        r &&
                                            !r.classList.contains(jn) &&
                                            (o.classList.add(Hn),
                                            o.setAttribute(
                                                "aria-expanded",
                                                !1
                                            ));
                                    }
                                this.setTransitioning(!0);
                                this._element.style[e] = "";
                                var s = Zt(this._element);
                                De.one(this._element, zt, function () {
                                    t.setTransitioning(!1),
                                        t._element.classList.remove(Pn),
                                        t._element.classList.add(Rn),
                                        De.trigger(
                                            t._element,
                                            "hidden.coreui.collapse"
                                        );
                                }),
                                    ne(this._element, s);
                            }
                        }),
                        (e.setTransitioning = function (t) {
                            this._isTransitioning = t;
                        }),
                        (e.dispose = function () {
                            he(this._element, Dn),
                                (this._config = null),
                                (this._parent = null),
                                (this._element = null),
                                (this._triggerArray = null),
                                (this._isTransitioning = null);
                        }),
                        (e._getConfig = function (t) {
                            return (
                                ((t = Ut(Ut({}, Nn), t)).toggle = Boolean(
                                    t.toggle
                                )),
                                ie(xn, t, In),
                                t
                            );
                        }),
                        (e._getDimension = function () {
                            return this._element.classList.contains(Wn)
                                ? Wn
                                : "height";
                        }),
                        (e._getParent = function () {
                            var t = this,
                                e = this._config.parent;
                            ee(e)
                                ? (void 0 === e.jquery && void 0 === e[0]) ||
                                  (e = e[0])
                                : (e = Ve.findOne(e));
                            var n = Yn + '[data-parent="' + e + '"]';
                            return (
                                Ve.find(n, e).forEach(function (e) {
                                    var n = Jt(e);
                                    t._addAriaAndCollapsedClass(n, [e]);
                                }),
                                e
                            );
                        }),
                        (e._addAriaAndCollapsedClass = function (t, e) {
                            if (t && e.length) {
                                var n = t.classList.contains(jn);
                                e.forEach(function (t) {
                                    n
                                        ? t.classList.remove(Hn)
                                        : t.classList.add(Hn),
                                        t.setAttribute("aria-expanded", n);
                                });
                            }
                        }),
                        (t.collapseInterface = function (e, n) {
                            var i = fe(e, Dn),
                                o = Ut(
                                    Ut(Ut({}, Nn), rn.getDataAttributes(e)),
                                    "object" == typeof n && n ? n : {}
                                );
                            if (
                                (!i &&
                                    o.toggle &&
                                    "string" == typeof n &&
                                    /show|hide/.test(n) &&
                                    (o.toggle = !1),
                                i || (i = new t(e, o)),
                                "string" == typeof n)
                            ) {
                                if (void 0 === i[n])
                                    throw new TypeError(
                                        'No method named "' + n + '"'
                                    );
                                i[n]();
                            }
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                t.collapseInterface(this, e);
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Dn);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return Nn;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(document, "click.coreui.collapse.data-api", Yn, function (t) {
                "A" === t.target.tagName && t.preventDefault();
                var e = rn.getDataAttributes(this),
                    n = Gt(this);
                Ve.find(n).forEach(function (t) {
                    var n,
                        i = fe(t, Dn);
                    i
                        ? (null === i._parent &&
                              "string" == typeof e.parent &&
                              ((i._config.parent = e.parent),
                              (i._parent = i._getParent())),
                          (n = "toggle"))
                        : (n = e),
                        Mn.collapseInterface(t, n);
                });
            });
            var Xn = le();
            if (Xn) {
                var Bn = Xn.fn[xn];
                (Xn.fn[xn] = Mn.jQueryInterface),
                    (Xn.fn[xn].Constructor = Mn),
                    (Xn.fn[xn].noConflict = function () {
                        return (Xn.fn[xn] = Bn), Mn.jQueryInterface;
                    });
            }
            var Un = "dropdown",
                qn = "coreui.dropdown",
                Qn = "." + qn,
                Vn = "Escape",
                Fn = "Space",
                zn = "ArrowUp",
                Kn = "ArrowDown",
                $n = new RegExp("ArrowUp|ArrowDown|Escape"),
                Gn = "hide" + Qn,
                Jn = "hidden" + Qn,
                Zn = "click.coreui.dropdown.data-api",
                ti = "keydown.coreui.dropdown.data-api",
                ei = "disabled",
                ni = "show",
                ii = "dropdown-menu-right",
                oi = '[data-toggle="dropdown"]',
                ri = ".dropdown-menu",
                si = {
                    offset: [0, 0],
                    flip: !0,
                    boundary: "scrollParent",
                    reference: "toggle",
                    display: "dynamic",
                    popperConfig: null,
                },
                ai = {
                    offset: "(array|function)",
                    flip: "boolean",
                    boundary: "(string|element)",
                    reference: "(string|element)",
                    display: "string",
                    popperConfig: "(null|object)",
                },
                li = (function () {
                    function t(t, e) {
                        (this._element = t),
                            (this._popper = null),
                            (this._config = this._getConfig(e)),
                            (this._menu = this._getMenuElement()),
                            (this._inNavbar = this._detectNavbar()),
                            (this._inHeader = this._detectHeader()),
                            this._addEventListeners(),
                            ue(t, qn, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.toggle = function () {
                            if (
                                !this._element.disabled &&
                                !this._element.classList.contains(ei)
                            ) {
                                var e = this._menu.classList.contains(ni);
                                t.clearMenus(), e || this.show();
                            }
                        }),
                        (e.show = function () {
                            if (
                                !(
                                    this._element.disabled ||
                                    this._element.classList.contains(ei) ||
                                    this._menu.classList.contains(ni)
                                )
                            ) {
                                var e = t.getParentFromElement(this._element),
                                    n = { relatedTarget: this._element };
                                if (
                                    !De.trigger(e, "show.coreui.dropdown", n)
                                        .defaultPrevented
                                ) {
                                    if (!this._inNavbar && !this._inHeader) {
                                        if (void 0 === ft)
                                            throw new TypeError(
                                                "CoreUI's dropdowns require Popper.js (https://popper.js.org)"
                                            );
                                        var i = this._element;
                                        "parent" === this._config.reference
                                            ? (i = e)
                                            : ee(this._config.reference) &&
                                              ((i = this._config.reference),
                                              void 0 !==
                                                  this._config.reference
                                                      .jquery &&
                                                  (i =
                                                      this._config
                                                          .reference[0])),
                                            "scrollParent" !==
                                                this._config.boundary &&
                                                e.classList.add(
                                                    "position-static"
                                                ),
                                            (this._popper = ft(
                                                i,
                                                this._menu,
                                                this._getPopperConfig()
                                            ));
                                    }
                                    var o, r;
                                    if (
                                        "ontouchstart" in
                                            document.documentElement &&
                                        !e.closest(".navbar-nav")
                                    )
                                        (o = []).concat
                                            .apply(o, document.body.children)
                                            .forEach(function (t) {
                                                return De.on(
                                                    t,
                                                    "mouseover",
                                                    null,
                                                    function () {}
                                                );
                                            });
                                    if (
                                        "ontouchstart" in
                                            document.documentElement &&
                                        !e.closest(".c-header-nav")
                                    )
                                        (r = []).concat
                                            .apply(r, document.body.children)
                                            .forEach(function (t) {
                                                return De.on(
                                                    t,
                                                    "mouseover",
                                                    null,
                                                    function () {}
                                                );
                                            });
                                    this._element.focus(),
                                        this._element.setAttribute(
                                            "aria-expanded",
                                            !0
                                        ),
                                        rn.toggleClass(this._menu, ni),
                                        rn.toggleClass(e, ni),
                                        De.trigger(
                                            e,
                                            "shown.coreui.dropdown",
                                            n
                                        );
                                }
                            }
                        }),
                        (e.hide = function () {
                            if (
                                !this._element.disabled &&
                                !this._element.classList.contains(ei) &&
                                this._menu.classList.contains(ni)
                            ) {
                                var e = t.getParentFromElement(this._element),
                                    n = { relatedTarget: this._element };
                                De.trigger(e, Gn, n).defaultPrevented ||
                                    (this._popper && this._popper.destroy(),
                                    rn.toggleClass(this._menu, ni),
                                    rn.toggleClass(e, ni),
                                    De.trigger(e, Jn, n));
                            }
                        }),
                        (e.dispose = function () {
                            he(this._element, qn),
                                De.off(this._element, Qn),
                                (this._element = null),
                                (this._menu = null),
                                this._popper &&
                                    (this._popper.destroy(),
                                    (this._popper = null));
                        }),
                        (e.update = function () {
                            (this._inNavbar = this._detectNavbar()),
                                (this._inHeader = this._detectHeader()),
                                this._popper && this._popper.update();
                        }),
                        (e._addEventListeners = function () {
                            var t = this;
                            De.on(
                                this._element,
                                "click.coreui.dropdown",
                                function (e) {
                                    e.preventDefault(),
                                        e.stopPropagation(),
                                        t.toggle();
                                }
                            );
                        }),
                        (e._getConfig = function (t) {
                            return (
                                (t = Ut(
                                    Ut(
                                        Ut({}, this.constructor.Default),
                                        rn.getDataAttributes(this._element)
                                    ),
                                    t
                                )),
                                ie(Un, t, this.constructor.DefaultType),
                                t
                            );
                        }),
                        (e._getMenuElement = function () {
                            var e = t.getParentFromElement(this._element);
                            return Ve.findOne(ri, e);
                        }),
                        (e._getPlacement = function () {
                            var t = this._element.parentNode,
                                e = "bottom-start";
                            return (
                                t.classList.contains("dropup")
                                    ? ((e = "top-start"),
                                      this._menu.classList.contains(ii) &&
                                          (e = "top-end"))
                                    : t.classList.contains("dropright")
                                    ? (e = "right-start")
                                    : t.classList.contains("dropleft")
                                    ? (e = "left-start")
                                    : this._menu.classList.contains(ii) &&
                                      (e = "bottom-end"),
                                e
                            );
                        }),
                        (e._detectNavbar = function () {
                            return Boolean(this._element.closest(".navbar"));
                        }),
                        (e._detectHeader = function () {
                            return Boolean(this._element.closest(".c-header"));
                        }),
                        (e._getOffset = function () {
                            var t = this;
                            return "function" == typeof this._config.offset
                                ? function (e) {
                                      var n = e.placement,
                                          i = e.reference,
                                          o = e.popper;
                                      return t._config.offset({
                                          placement: n,
                                          reference: i,
                                          popper: o,
                                      });
                                  }
                                : this._config.offset;
                        }),
                        (e._getPopperConfig = function () {
                            var t = {
                                placement: this._getPlacement(),
                                modifiers: [
                                    {
                                        name: "offset",
                                        options: { offset: this._getOffset() },
                                    },
                                    {
                                        name: "flip",
                                        enabled: this._config.flip,
                                    },
                                    {
                                        name: "preventOverflow",
                                        options: {
                                            boundary: this._config.boundary,
                                        },
                                    },
                                ],
                            };
                            return (
                                "static" === this._config.display &&
                                    (t.modifiers = {
                                        name: "applyStyles",
                                        enabled: !1,
                                    }),
                                Ut(Ut({}, t), this._config.popperConfig)
                            );
                        }),
                        (t.dropdownInterface = function (e, n) {
                            var i = fe(e, qn);
                            if (
                                (i ||
                                    (i = new t(
                                        e,
                                        "object" == typeof n ? n : null
                                    )),
                                "string" == typeof n)
                            ) {
                                if (void 0 === i[n])
                                    throw new TypeError(
                                        'No method named "' + n + '"'
                                    );
                                i[n]();
                            }
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                t.dropdownInterface(this, e);
                            });
                        }),
                        (t.clearMenus = function (e) {
                            if (
                                !e ||
                                (2 !== e.button &&
                                    ("keyup" !== e.type || "Tab" === e.key))
                            )
                                for (
                                    var n = Ve.find(oi), i = 0, o = n.length;
                                    i < o;
                                    i++
                                ) {
                                    var r = t.getParentFromElement(n[i]),
                                        s = fe(n[i], qn),
                                        a = { relatedTarget: n[i] };
                                    if (
                                        (e &&
                                            "click" === e.type &&
                                            (a.clickEvent = e),
                                        s)
                                    ) {
                                        var l = s._menu;
                                        if (r.classList.contains(ni))
                                            if (
                                                !(
                                                    e &&
                                                    (("click" === e.type &&
                                                        /input|textarea/i.test(
                                                            e.target.tagName
                                                        )) ||
                                                        ("keyup" === e.type &&
                                                            "Tab" === e.key)) &&
                                                    r.contains(e.target)
                                                )
                                            )
                                                if (
                                                    !De.trigger(r, Gn, a)
                                                        .defaultPrevented
                                                ) {
                                                    var c;
                                                    if (
                                                        "ontouchstart" in
                                                        document.documentElement
                                                    )
                                                        (c = []).concat
                                                            .apply(
                                                                c,
                                                                document.body
                                                                    .children
                                                            )
                                                            .forEach(function (
                                                                t
                                                            ) {
                                                                return De.off(
                                                                    t,
                                                                    "mouseover",
                                                                    null,
                                                                    function () {}
                                                                );
                                                            });
                                                    n[i].setAttribute(
                                                        "aria-expanded",
                                                        "false"
                                                    ),
                                                        s._popper &&
                                                            s._popper.destroy(),
                                                        l.classList.remove(ni),
                                                        r.classList.remove(ni),
                                                        De.trigger(r, Jn, a);
                                                }
                                    }
                                }
                        }),
                        (t.getParentFromElement = function (t) {
                            return Jt(t) || t.parentNode;
                        }),
                        (t.dataApiKeydownHandler = function (e) {
                            if (
                                !(/input|textarea/i.test(e.target.tagName)
                                    ? e.key === Fn ||
                                      (e.key !== Vn &&
                                          ((e.key !== Kn && e.key !== zn) ||
                                              e.target.closest(ri)))
                                    : !$n.test(e.key)) &&
                                (e.preventDefault(),
                                e.stopPropagation(),
                                !this.disabled && !this.classList.contains(ei))
                            ) {
                                var n = t.getParentFromElement(this),
                                    i = n.classList.contains(ni);
                                if (e.key === Vn)
                                    return (
                                        (this.matches(oi)
                                            ? this
                                            : Ve.prev(this, oi)[0]
                                        ).focus(),
                                        void t.clearMenus()
                                    );
                                if (i && e.key !== Fn) {
                                    var o = Ve.find(
                                        ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
                                        n
                                    ).filter(oe);
                                    if (o.length) {
                                        var r = o.indexOf(e.target);
                                        e.key === zn && r > 0 && r--,
                                            e.key === Kn &&
                                                r < o.length - 1 &&
                                                r++,
                                            o[(r = -1 === r ? 0 : r)].focus();
                                    }
                                } else t.clearMenus();
                            }
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, qn);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return si;
                                },
                            },
                            {
                                key: "DefaultType",
                                get: function () {
                                    return ai;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(document, ti, oi, li.dataApiKeydownHandler),
                De.on(document, ti, ri, li.dataApiKeydownHandler),
                De.on(document, Zn, li.clearMenus),
                De.on(
                    document,
                    "keyup.coreui.dropdown.data-api",
                    li.clearMenus
                ),
                De.on(document, Zn, oi, function (t) {
                    t.preventDefault(),
                        t.stopPropagation(),
                        li.dropdownInterface(this, "toggle");
                }),
                De.on(document, Zn, ".dropdown form", function (t) {
                    return t.stopPropagation();
                });
            var ci = le();
            if (ci) {
                var ui = ci.fn[Un];
                (ci.fn[Un] = li.jQueryInterface),
                    (ci.fn[Un].Constructor = li),
                    (ci.fn[Un].noConflict = function () {
                        return (ci.fn[Un] = ui), li.jQueryInterface;
                    });
            }
            var fi = "modal",
                hi = "coreui.modal",
                di = "." + hi,
                pi = "Escape",
                gi = { backdrop: !0, keyboard: !0, focus: !0, show: !0 },
                mi = {
                    backdrop: "(boolean|string)",
                    keyboard: "boolean",
                    focus: "boolean",
                    show: "boolean",
                },
                vi = "hidden" + di,
                _i = "show" + di,
                bi = "focusin" + di,
                yi = "resize" + di,
                wi = "click.dismiss" + di,
                Ei = "keydown.dismiss" + di,
                Li = "mousedown.dismiss" + di,
                ki = "modal-open",
                Ti = "fade",
                Ci = "show",
                Oi = "modal-static",
                Ai = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
                Si = ".sticky-top",
                xi = (function () {
                    function t(t, e) {
                        (this._config = this._getConfig(e)),
                            (this._element = t),
                            (this._dialog = Ve.findOne(".modal-dialog", t)),
                            (this._backdrop = null),
                            (this._isShown = !1),
                            (this._isBodyOverflowing = !1),
                            (this._ignoreBackdropClick = !1),
                            (this._isTransitioning = !1),
                            (this._scrollbarWidth = 0),
                            ue(t, hi, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.toggle = function (t) {
                            return this._isShown ? this.hide() : this.show(t);
                        }),
                        (e.show = function (t) {
                            var e = this;
                            if (!this._isShown && !this._isTransitioning) {
                                this._element.classList.contains(Ti) &&
                                    (this._isTransitioning = !0);
                                var n = De.trigger(this._element, _i, {
                                    relatedTarget: t,
                                });
                                this._isShown ||
                                    n.defaultPrevented ||
                                    ((this._isShown = !0),
                                    this._checkScrollbar(),
                                    this._setScrollbar(),
                                    this._adjustDialog(),
                                    this._setEscapeEvent(),
                                    this._setResizeEvent(),
                                    De.on(
                                        this._element,
                                        wi,
                                        '[data-dismiss="modal"]',
                                        function (t) {
                                            return e.hide(t);
                                        }
                                    ),
                                    De.on(this._dialog, Li, function () {
                                        De.one(
                                            e._element,
                                            "mouseup.dismiss.coreui.modal",
                                            function (t) {
                                                t.target === e._element &&
                                                    (e._ignoreBackdropClick =
                                                        !0);
                                            }
                                        );
                                    }),
                                    this._showBackdrop(function () {
                                        return e._showElement(t);
                                    }));
                            }
                        }),
                        (e.hide = function (t) {
                            var e = this;
                            if (
                                (t && t.preventDefault(),
                                this._isShown && !this._isTransitioning) &&
                                !De.trigger(this._element, "hide.coreui.modal")
                                    .defaultPrevented
                            ) {
                                this._isShown = !1;
                                var n = this._element.classList.contains(Ti);
                                if (
                                    (n && (this._isTransitioning = !0),
                                    this._setEscapeEvent(),
                                    this._setResizeEvent(),
                                    De.off(document, bi),
                                    this._element.classList.remove(Ci),
                                    De.off(this._element, wi),
                                    De.off(this._dialog, Li),
                                    n)
                                ) {
                                    var i = Zt(this._element);
                                    De.one(this._element, zt, function (t) {
                                        return e._hideModal(t);
                                    }),
                                        ne(this._element, i);
                                } else this._hideModal();
                            }
                        }),
                        (e.dispose = function () {
                            [window, this._element, this._dialog].forEach(
                                function (t) {
                                    return De.off(t, di);
                                }
                            ),
                                De.off(document, bi),
                                he(this._element, hi),
                                (this._config = null),
                                (this._element = null),
                                (this._dialog = null),
                                (this._backdrop = null),
                                (this._isShown = null),
                                (this._isBodyOverflowing = null),
                                (this._ignoreBackdropClick = null),
                                (this._isTransitioning = null),
                                (this._scrollbarWidth = null);
                        }),
                        (e.handleUpdate = function () {
                            this._adjustDialog();
                        }),
                        (e._getConfig = function (t) {
                            return (t = Ut(Ut({}, gi), t)), ie(fi, t, mi), t;
                        }),
                        (e._showElement = function (t) {
                            var e = this,
                                n = this._element.classList.contains(Ti),
                                i = Ve.findOne(".modal-body", this._dialog);
                            (this._element.parentNode &&
                                this._element.parentNode.nodeType ===
                                    Node.ELEMENT_NODE) ||
                                document.body.appendChild(this._element),
                                (this._element.style.display = "block"),
                                this._element.removeAttribute("aria-hidden"),
                                this._element.setAttribute("aria-modal", !0),
                                this._element.setAttribute("role", "dialog"),
                                (this._element.scrollTop = 0),
                                i && (i.scrollTop = 0),
                                n && ae(this._element),
                                this._element.classList.add(Ci),
                                this._config.focus && this._enforceFocus();
                            var o = function () {
                                e._config.focus && e._element.focus(),
                                    (e._isTransitioning = !1),
                                    De.trigger(
                                        e._element,
                                        "shown.coreui.modal",
                                        { relatedTarget: t }
                                    );
                            };
                            if (n) {
                                var r = Zt(this._dialog);
                                De.one(this._dialog, zt, o),
                                    ne(this._dialog, r);
                            } else o();
                        }),
                        (e._enforceFocus = function () {
                            var t = this;
                            De.off(document, bi),
                                De.on(document, bi, function (e) {
                                    document === e.target ||
                                        t._element === e.target ||
                                        t._element.contains(e.target) ||
                                        t._element.focus();
                                });
                        }),
                        (e._setEscapeEvent = function () {
                            var t = this;
                            this._isShown
                                ? De.on(this._element, Ei, function (e) {
                                      t._config.keyboard && e.key === pi
                                          ? (e.preventDefault(), t.hide())
                                          : t._config.keyboard ||
                                            e.key !== pi ||
                                            t._triggerBackdropTransition();
                                  })
                                : De.off(this._element, Ei);
                        }),
                        (e._setResizeEvent = function () {
                            var t = this;
                            this._isShown
                                ? De.on(window, yi, function () {
                                      return t._adjustDialog();
                                  })
                                : De.off(window, yi);
                        }),
                        (e._hideModal = function () {
                            var t = this;
                            (this._element.style.display = "none"),
                                this._element.setAttribute("aria-hidden", !0),
                                this._element.removeAttribute("aria-modal"),
                                this._element.removeAttribute("role"),
                                (this._isTransitioning = !1),
                                this._showBackdrop(function () {
                                    document.body.classList.remove(ki),
                                        t._resetAdjustments(),
                                        t._resetScrollbar(),
                                        De.trigger(t._element, vi);
                                });
                        }),
                        (e._removeBackdrop = function () {
                            this._backdrop.parentNode.removeChild(
                                this._backdrop
                            ),
                                (this._backdrop = null);
                        }),
                        (e._showBackdrop = function (t) {
                            var e = this,
                                n = this._element.classList.contains(Ti)
                                    ? Ti
                                    : "";
                            if (this._isShown && this._config.backdrop) {
                                if (
                                    ((this._backdrop =
                                        document.createElement("div")),
                                    (this._backdrop.className =
                                        "modal-backdrop"),
                                    n && this._backdrop.classList.add(n),
                                    document.body.appendChild(this._backdrop),
                                    De.on(this._element, wi, function (t) {
                                        e._ignoreBackdropClick
                                            ? (e._ignoreBackdropClick = !1)
                                            : t.target === t.currentTarget &&
                                              e._triggerBackdropTransition();
                                    }),
                                    n && ae(this._backdrop),
                                    this._backdrop.classList.add(Ci),
                                    !n)
                                )
                                    return void t();
                                var i = Zt(this._backdrop);
                                De.one(this._backdrop, zt, t),
                                    ne(this._backdrop, i);
                            } else if (!this._isShown && this._backdrop) {
                                this._backdrop.classList.remove(Ci);
                                var o = function () {
                                    e._removeBackdrop(), t();
                                };
                                if (this._element.classList.contains(Ti)) {
                                    var r = Zt(this._backdrop);
                                    De.one(this._backdrop, zt, o),
                                        ne(this._backdrop, r);
                                } else o();
                            } else t();
                        }),
                        (e._triggerBackdropTransition = function () {
                            var t = this;
                            if ("static" === this._config.backdrop) {
                                if (
                                    De.trigger(
                                        this._element,
                                        "hidePrevented.coreui.modal"
                                    ).defaultPrevented
                                )
                                    return;
                                var e =
                                    this._element.scrollHeight >
                                    document.documentElement.clientHeight;
                                e || (this._element.style.overflowY = "hidden"),
                                    this._element.classList.add(Oi);
                                var n = Zt(this._dialog);
                                De.off(this._element, zt),
                                    De.one(this._element, zt, function () {
                                        t._element.classList.remove(Oi),
                                            e ||
                                                (De.one(
                                                    t._element,
                                                    zt,
                                                    function () {
                                                        t._element.style.overflowY =
                                                            "";
                                                    }
                                                ),
                                                ne(t._element, n));
                                    }),
                                    ne(this._element, n),
                                    this._element.focus();
                            } else this.hide();
                        }),
                        (e._adjustDialog = function () {
                            var t =
                                this._element.scrollHeight >
                                document.documentElement.clientHeight;
                            !this._isBodyOverflowing &&
                                t &&
                                (this._element.style.paddingLeft =
                                    this._scrollbarWidth + "px"),
                                this._isBodyOverflowing &&
                                    !t &&
                                    (this._element.style.paddingRight =
                                        this._scrollbarWidth + "px");
                        }),
                        (e._resetAdjustments = function () {
                            (this._element.style.paddingLeft = ""),
                                (this._element.style.paddingRight = "");
                        }),
                        (e._checkScrollbar = function () {
                            var t = document.body.getBoundingClientRect();
                            (this._isBodyOverflowing =
                                Math.round(t.left + t.right) <
                                window.innerWidth),
                                (this._scrollbarWidth =
                                    this._getScrollbarWidth());
                        }),
                        (e._setScrollbar = function () {
                            var t = this;
                            if (this._isBodyOverflowing) {
                                Ve.find(Ai).forEach(function (e) {
                                    var n = e.style.paddingRight,
                                        i =
                                            window.getComputedStyle(e)[
                                                "padding-right"
                                            ];
                                    rn.setDataAttribute(e, "padding-right", n),
                                        (e.style.paddingRight =
                                            parseFloat(i) +
                                            t._scrollbarWidth +
                                            "px");
                                }),
                                    Ve.find(Si).forEach(function (e) {
                                        var n = e.style.marginRight,
                                            i =
                                                window.getComputedStyle(e)[
                                                    "margin-right"
                                                ];
                                        rn.setDataAttribute(
                                            e,
                                            "margin-right",
                                            n
                                        ),
                                            (e.style.marginRight =
                                                parseFloat(i) -
                                                t._scrollbarWidth +
                                                "px");
                                    });
                                var e = document.body.style.paddingRight,
                                    n = window.getComputedStyle(document.body)[
                                        "padding-right"
                                    ];
                                rn.setDataAttribute(
                                    document.body,
                                    "padding-right",
                                    e
                                ),
                                    (document.body.style.paddingRight =
                                        parseFloat(n) +
                                        this._scrollbarWidth +
                                        "px");
                            }
                            document.body.classList.add(ki);
                        }),
                        (e._resetScrollbar = function () {
                            Ve.find(Ai).forEach(function (t) {
                                var e = rn.getDataAttribute(t, "padding-right");
                                void 0 !== e &&
                                    (rn.removeDataAttribute(t, "padding-right"),
                                    (t.style.paddingRight = e));
                            }),
                                Ve.find(".sticky-top").forEach(function (t) {
                                    var e = rn.getDataAttribute(
                                        t,
                                        "margin-right"
                                    );
                                    void 0 !== e &&
                                        (rn.removeDataAttribute(
                                            t,
                                            "margin-right"
                                        ),
                                        (t.style.marginRight = e));
                                });
                            var t = rn.getDataAttribute(
                                document.body,
                                "padding-right"
                            );
                            void 0 === t
                                ? (document.body.style.paddingRight = "")
                                : (rn.removeDataAttribute(
                                      document.body,
                                      "padding-right"
                                  ),
                                  (document.body.style.paddingRight = t));
                        }),
                        (e._getScrollbarWidth = function () {
                            var t = document.createElement("div");
                            (t.className = "modal-scrollbar-measure"),
                                document.body.appendChild(t);
                            var e =
                                t.getBoundingClientRect().width - t.clientWidth;
                            return document.body.removeChild(t), e;
                        }),
                        (t.jQueryInterface = function (e, n) {
                            return this.each(function () {
                                var i = fe(this, hi),
                                    o = Ut(
                                        Ut(
                                            Ut({}, gi),
                                            rn.getDataAttributes(this)
                                        ),
                                        "object" == typeof e && e ? e : {}
                                    );
                                if (
                                    (i || (i = new t(this, o)),
                                    "string" == typeof e)
                                ) {
                                    if (void 0 === i[e])
                                        throw new TypeError(
                                            'No method named "' + e + '"'
                                        );
                                    i[e](n);
                                } else o.show && i.show(n);
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, hi);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return gi;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(
                document,
                "click.coreui.modal.data-api",
                '[data-toggle="modal"]',
                function (t) {
                    var e = this,
                        n = Jt(this);
                    ("A" !== this.tagName && "AREA" !== this.tagName) ||
                        t.preventDefault(),
                        De.one(n, _i, function (t) {
                            t.defaultPrevented ||
                                De.one(n, vi, function () {
                                    oe(e) && e.focus();
                                });
                        });
                    var i = fe(n, hi);
                    if (!i) {
                        var o = Ut(
                            Ut({}, rn.getDataAttributes(n)),
                            rn.getDataAttributes(this)
                        );
                        i = new xi(n, o);
                    }
                    i.show(this);
                }
            );
            var Di = le();
            if (Di) {
                var Ni = Di.fn.modal;
                (Di.fn.modal = xi.jQueryInterface),
                    (Di.fn.modal.Constructor = xi),
                    (Di.fn.modal.noConflict = function () {
                        return (Di.fn.modal = Ni), xi.jQueryInterface;
                    });
            }
            var Ii = [
                    "background",
                    "cite",
                    "href",
                    "itemtype",
                    "longdesc",
                    "poster",
                    "src",
                    "xlink:href",
                ],
                ji =
                    /^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/gi,
                Ri =
                    /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i,
                Pi = {
                    "*": [
                        "class",
                        "dir",
                        "id",
                        "lang",
                        "role",
                        /^aria-[\w-]*$/i,
                    ],
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
            function Hi(t, e, n) {
                var i;
                if (!t.length) return t;
                if (n && "function" == typeof n) return n(t);
                for (
                    var o = new window.DOMParser().parseFromString(
                            t,
                            "text/html"
                        ),
                        r = Object.keys(e),
                        s = (i = []).concat.apply(
                            i,
                            o.body.querySelectorAll("*")
                        ),
                        a = function (t, n) {
                            var i,
                                o = s[t],
                                a = o.nodeName.toLowerCase();
                            if (-1 === r.indexOf(a))
                                return o.parentNode.removeChild(o), "continue";
                            var l = (i = []).concat.apply(i, o.attributes),
                                c = [].concat(e["*"] || [], e[a] || []);
                            l.forEach(function (t) {
                                (function (t, e) {
                                    var n = t.nodeName.toLowerCase();
                                    if (-1 !== e.indexOf(n))
                                        return (
                                            -1 === Ii.indexOf(n) ||
                                            Boolean(
                                                t.nodeValue.match(ji) ||
                                                    t.nodeValue.match(Ri)
                                            )
                                        );
                                    for (
                                        var i = e.filter(function (t) {
                                                return t instanceof RegExp;
                                            }),
                                            o = 0,
                                            r = i.length;
                                        o < r;
                                        o++
                                    )
                                        if (n.match(i[o])) return !0;
                                    return !1;
                                })(t, c) || o.removeAttribute(t.nodeName);
                            });
                        },
                        l = 0,
                        c = s.length;
                    l < c;
                    l++
                )
                    a(l);
                return o.body.innerHTML;
            }
            var Wi = "tooltip",
                Yi = "coreui.tooltip",
                Mi = "." + Yi,
                Xi = new RegExp("(^|\\s)bs-tooltip\\S+", "g"),
                Bi = ["sanitize", "whiteList", "sanitizeFn"],
                Ui = {
                    animation: "boolean",
                    template: "string",
                    title: "(string|element|function)",
                    trigger: "string",
                    delay: "(number|object)",
                    html: "boolean",
                    selector: "(string|boolean)",
                    placement: "(string|function)",
                    offset: "(array|function)",
                    container: "(string|element|boolean)",
                    boundary: "(string|element)",
                    sanitize: "boolean",
                    sanitizeFn: "(null|function)",
                    whiteList: "object",
                    popperConfig: "(null|object)",
                },
                qi = {
                    AUTO: "auto",
                    TOP: "top",
                    RIGHT: "right",
                    BOTTOM: "bottom",
                    LEFT: "left",
                },
                Qi = {
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
                    boundary: "scrollParent",
                    sanitize: !0,
                    sanitizeFn: null,
                    whiteList: Pi,
                    popperConfig: null,
                },
                Vi = {
                    HIDE: "hide" + Mi,
                    HIDDEN: "hidden" + Mi,
                    SHOW: "show" + Mi,
                    SHOWN: "shown" + Mi,
                    INSERTED: "inserted" + Mi,
                    CLICK: "click" + Mi,
                    FOCUSIN: "focusin" + Mi,
                    FOCUSOUT: "focusout" + Mi,
                    MOUSEENTER: "mouseenter" + Mi,
                    MOUSELEAVE: "mouseleave" + Mi,
                },
                Fi = "fade",
                zi = "show",
                Ki = "show",
                $i = "out",
                Gi = "hover",
                Ji = "focus",
                Zi = (function () {
                    function t(t, e) {
                        if (void 0 === ft)
                            throw new TypeError(
                                "CoreUI's tooltips require Popper.js (https://popper.js.org)"
                            );
                        (this._isEnabled = !0),
                            (this._timeout = 0),
                            (this._hoverState = ""),
                            (this._activeTrigger = {}),
                            (this._popper = null),
                            (this.element = t),
                            (this.config = this._getConfig(e)),
                            (this.tip = null),
                            this._setListeners(),
                            ue(t, this.constructor.DATA_KEY, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.enable = function () {
                            this._isEnabled = !0;
                        }),
                        (e.disable = function () {
                            this._isEnabled = !1;
                        }),
                        (e.toggleEnabled = function () {
                            this._isEnabled = !this._isEnabled;
                        }),
                        (e.toggle = function (t) {
                            if (this._isEnabled)
                                if (t) {
                                    var e = this.constructor.DATA_KEY,
                                        n = fe(t.delegateTarget, e);
                                    n ||
                                        ((n = new this.constructor(
                                            t.delegateTarget,
                                            this._getDelegateConfig()
                                        )),
                                        ue(t.delegateTarget, e, n)),
                                        (n._activeTrigger.click =
                                            !n._activeTrigger.click),
                                        n._isWithActiveTrigger()
                                            ? n._enter(null, n)
                                            : n._leave(null, n);
                                } else {
                                    if (
                                        this.getTipElement().classList.contains(
                                            zi
                                        )
                                    )
                                        return void this._leave(null, this);
                                    this._enter(null, this);
                                }
                        }),
                        (e.dispose = function () {
                            clearTimeout(this._timeout),
                                he(this.element, this.constructor.DATA_KEY),
                                De.off(
                                    this.element,
                                    this.constructor.EVENT_KEY
                                ),
                                De.off(
                                    this.element.closest(".modal"),
                                    "hide.coreui.modal",
                                    this._hideModalHandler
                                ),
                                this.tip &&
                                    this.tip.parentNode.removeChild(this.tip),
                                (this._isEnabled = null),
                                (this._timeout = null),
                                (this._hoverState = null),
                                (this._activeTrigger = null),
                                this._popper && this._popper.destroy(),
                                (this._popper = null),
                                (this.element = null),
                                (this.config = null),
                                (this.tip = null);
                        }),
                        (e.show = function () {
                            var t = this;
                            if ("none" === this.element.style.display)
                                throw new Error(
                                    "Please use show on visible elements"
                                );
                            if (this.isWithContent() && this._isEnabled) {
                                var e = De.trigger(
                                        this.element,
                                        this.constructor.Event.SHOW
                                    ),
                                    n = re(this.element),
                                    i =
                                        null === n
                                            ? this.element.ownerDocument.documentElement.contains(
                                                  this.element
                                              )
                                            : n.contains(this.element);
                                if (e.defaultPrevented || !i) return;
                                var o = this.getTipElement(),
                                    r = Kt(this.constructor.NAME);
                                o.setAttribute("id", r),
                                    this.element.setAttribute(
                                        "aria-describedby",
                                        r
                                    ),
                                    this.setContent(),
                                    this.config.animation &&
                                        o.classList.add(Fi);
                                var s,
                                    a =
                                        "function" ==
                                        typeof this.config.placement
                                            ? this.config.placement.call(
                                                  this,
                                                  o,
                                                  this.element
                                              )
                                            : this.config.placement,
                                    l = this._getAttachment(a),
                                    c = this._getContainer();
                                if (
                                    (ue(o, this.constructor.DATA_KEY, this),
                                    this.element.ownerDocument.documentElement.contains(
                                        this.tip
                                    ) || c.appendChild(o),
                                    De.trigger(
                                        this.element,
                                        this.constructor.Event.INSERTED
                                    ),
                                    (this._popper = ft(
                                        this.element,
                                        o,
                                        this._getPopperConfig(l)
                                    )),
                                    o.classList.add(zi),
                                    "ontouchstart" in document.documentElement)
                                )
                                    (s = []).concat
                                        .apply(s, document.body.children)
                                        .forEach(function (t) {
                                            De.on(
                                                t,
                                                "mouseover",
                                                function () {}
                                            );
                                        });
                                var u = function () {
                                    t.config.animation && t._fixTransition();
                                    var e = t._hoverState;
                                    (t._hoverState = null),
                                        De.trigger(
                                            t.element,
                                            t.constructor.Event.SHOWN
                                        ),
                                        e === $i && t._leave(null, t);
                                };
                                if (this.tip.classList.contains(Fi)) {
                                    var f = Zt(this.tip);
                                    De.one(this.tip, zt, u), ne(this.tip, f);
                                } else u();
                            }
                        }),
                        (e.hide = function () {
                            var t = this,
                                e = this.getTipElement(),
                                n = function () {
                                    t._hoverState !== Ki &&
                                        e.parentNode &&
                                        e.parentNode.removeChild(e),
                                        t._cleanTipClass(),
                                        t.element.removeAttribute(
                                            "aria-describedby"
                                        ),
                                        De.trigger(
                                            t.element,
                                            t.constructor.Event.HIDDEN
                                        ),
                                        t._popper.destroy();
                                };
                            if (
                                !De.trigger(
                                    this.element,
                                    this.constructor.Event.HIDE
                                ).defaultPrevented
                            ) {
                                var i;
                                if (
                                    (e.classList.remove(zi),
                                    "ontouchstart" in document.documentElement)
                                )
                                    (i = []).concat
                                        .apply(i, document.body.children)
                                        .forEach(function (t) {
                                            return De.off(t, "mouseover", se);
                                        });
                                if (
                                    ((this._activeTrigger.click = !1),
                                    (this._activeTrigger.focus = !1),
                                    (this._activeTrigger.hover = !1),
                                    this.tip.classList.contains(Fi))
                                ) {
                                    var o = Zt(e);
                                    De.one(e, zt, n), ne(e, o);
                                } else n();
                                this._hoverState = "";
                            }
                        }),
                        (e.update = function () {
                            null !== this._popper && this._popper.update();
                        }),
                        (e.isWithContent = function () {
                            return Boolean(this.getTitle());
                        }),
                        (e.getTipElement = function () {
                            if (this.tip) return this.tip;
                            var t = document.createElement("div");
                            return (
                                (t.innerHTML = this.config.template),
                                (this.tip = t.children[0]),
                                this.tip
                            );
                        }),
                        (e.setContent = function () {
                            var t = this.getTipElement();
                            this.setElementContent(
                                Ve.findOne(".tooltip-inner", t),
                                this.getTitle()
                            ),
                                t.classList.remove(Fi, zi);
                        }),
                        (e.setElementContent = function (t, e) {
                            if (null !== t)
                                return "object" == typeof e && ee(e)
                                    ? (e.jquery && (e = e[0]),
                                      void (this.config.html
                                          ? e.parentNode !== t &&
                                            ((t.innerHTML = ""),
                                            t.appendChild(e))
                                          : (t.textContent = e.textContent)))
                                    : void (this.config.html
                                          ? (this.config.sanitize &&
                                                (e = Hi(
                                                    e,
                                                    this.config.whiteList,
                                                    this.config.sanitizeFn
                                                )),
                                            (t.innerHTML = e))
                                          : (t.textContent = e));
                        }),
                        (e.getTitle = function () {
                            var t = this.element.getAttribute(
                                "data-original-title"
                            );
                            return (
                                t ||
                                    (t =
                                        "function" == typeof this.config.title
                                            ? this.config.title.call(
                                                  this.element
                                              )
                                            : this.config.title),
                                t
                            );
                        }),
                        (e._getPopperConfig = function (t) {
                            var e = this;
                            return Ut(
                                Ut(
                                    {},
                                    {
                                        placement: t,
                                        modifiers: [
                                            {
                                                name: "offset",
                                                options: {
                                                    offset: this._getOffset(),
                                                },
                                            },
                                            {
                                                name: "arrow",
                                                options: {
                                                    element:
                                                        "." +
                                                        this.constructor.NAME +
                                                        "-arrow",
                                                },
                                            },
                                            {
                                                name: "preventOverflow",
                                                options: {
                                                    boundary:
                                                        this.config.boundary,
                                                },
                                            },
                                        ],
                                        onFirstUpdate: function (t) {
                                            t.originalPlacement !==
                                                t.placement &&
                                                e._popper.update();
                                        },
                                    }
                                ),
                                this.config.popperConfig
                            );
                        }),
                        (e._getOffset = function () {
                            var t = this;
                            return "function" == typeof this.config.offset
                                ? function (e) {
                                      var n = e.placement,
                                          i = e.reference,
                                          o = e.popper;
                                      return t.config.offset({
                                          placement: n,
                                          reference: i,
                                          popper: o,
                                      });
                                  }
                                : this.config.offset;
                        }),
                        (e._getContainer = function () {
                            return !1 === this.config.container
                                ? document.body
                                : ee(this.config.container)
                                ? this.config.container
                                : Ve.findOne(this.config.container);
                        }),
                        (e._getAttachment = function (t) {
                            return qi[t.toUpperCase()];
                        }),
                        (e._setListeners = function () {
                            var t = this;
                            this.config.trigger
                                .split(" ")
                                .forEach(function (e) {
                                    if ("click" === e)
                                        De.on(
                                            t.element,
                                            t.constructor.Event.CLICK,
                                            t.config.selector,
                                            function (e) {
                                                return t.toggle(e);
                                            }
                                        );
                                    else if ("manual" !== e) {
                                        var n =
                                                e === Gi
                                                    ? t.constructor.Event
                                                          .MOUSEENTER
                                                    : t.constructor.Event
                                                          .FOCUSIN,
                                            i =
                                                e === Gi
                                                    ? t.constructor.Event
                                                          .MOUSELEAVE
                                                    : t.constructor.Event
                                                          .FOCUSOUT;
                                        De.on(
                                            t.element,
                                            n,
                                            t.config.selector,
                                            function (e) {
                                                return t._enter(e);
                                            }
                                        ),
                                            De.on(
                                                t.element,
                                                i,
                                                t.config.selector,
                                                function (e) {
                                                    return t._leave(e);
                                                }
                                            );
                                    }
                                }),
                                (this._hideModalHandler = function () {
                                    t.element && t.hide();
                                }),
                                De.on(
                                    this.element.closest(".modal"),
                                    "hide.coreui.modal",
                                    this._hideModalHandler
                                ),
                                this.config.selector
                                    ? (this.config = Ut(
                                          Ut({}, this.config),
                                          {},
                                          { trigger: "manual", selector: "" }
                                      ))
                                    : this._fixTitle();
                        }),
                        (e._fixTitle = function () {
                            var t = typeof this.element.getAttribute(
                                "data-original-title"
                            );
                            (this.element.getAttribute("title") ||
                                "string" !== t) &&
                                (this.element.setAttribute(
                                    "data-original-title",
                                    this.element.getAttribute("title") || ""
                                ),
                                this.element.setAttribute("title", ""));
                        }),
                        (e._enter = function (t, e) {
                            var n = this.constructor.DATA_KEY;
                            (e = e || fe(t.delegateTarget, n)) ||
                                ((e = new this.constructor(
                                    t.delegateTarget,
                                    this._getDelegateConfig()
                                )),
                                ue(t.delegateTarget, n, e)),
                                t &&
                                    (e._activeTrigger[
                                        "focusin" === t.type ? Ji : Gi
                                    ] = !0),
                                e.getTipElement().classList.contains(zi) ||
                                e._hoverState === Ki
                                    ? (e._hoverState = Ki)
                                    : (clearTimeout(e._timeout),
                                      (e._hoverState = Ki),
                                      e.config.delay && e.config.delay.show
                                          ? (e._timeout = setTimeout(
                                                function () {
                                                    e._hoverState === Ki &&
                                                        e.show();
                                                },
                                                e.config.delay.show
                                            ))
                                          : e.show());
                        }),
                        (e._leave = function (t, e) {
                            var n = this.constructor.DATA_KEY;
                            (e = e || fe(t.delegateTarget, n)) ||
                                ((e = new this.constructor(
                                    t.delegateTarget,
                                    this._getDelegateConfig()
                                )),
                                ue(t.delegateTarget, n, e)),
                                t &&
                                    (e._activeTrigger[
                                        "focusout" === t.type ? Ji : Gi
                                    ] = !1),
                                e._isWithActiveTrigger() ||
                                    (clearTimeout(e._timeout),
                                    (e._hoverState = $i),
                                    e.config.delay && e.config.delay.hide
                                        ? (e._timeout = setTimeout(function () {
                                              e._hoverState === $i && e.hide();
                                          }, e.config.delay.hide))
                                        : e.hide());
                        }),
                        (e._isWithActiveTrigger = function () {
                            for (var t in this._activeTrigger)
                                if (this._activeTrigger[t]) return !0;
                            return !1;
                        }),
                        (e._getConfig = function (t) {
                            var e = rn.getDataAttributes(this.element);
                            return (
                                Object.keys(e).forEach(function (t) {
                                    -1 !== Bi.indexOf(t) && delete e[t];
                                }),
                                t &&
                                    "object" == typeof t.container &&
                                    t.container.jquery &&
                                    (t.container = t.container[0]),
                                "number" ==
                                    typeof (t = Ut(
                                        Ut(Ut({}, this.constructor.Default), e),
                                        "object" == typeof t && t ? t : {}
                                    )).delay &&
                                    (t.delay = {
                                        show: t.delay,
                                        hide: t.delay,
                                    }),
                                "number" == typeof t.title &&
                                    (t.title = t.title.toString()),
                                "number" == typeof t.content &&
                                    (t.content = t.content.toString()),
                                ie(Wi, t, this.constructor.DefaultType),
                                t.sanitize &&
                                    (t.template = Hi(
                                        t.template,
                                        t.whiteList,
                                        t.sanitizeFn
                                    )),
                                t
                            );
                        }),
                        (e._getDelegateConfig = function () {
                            var t = {};
                            if (this.config)
                                for (var e in this.config)
                                    this.constructor.Default[e] !==
                                        this.config[e] &&
                                        (t[e] = this.config[e]);
                            return t;
                        }),
                        (e._cleanTipClass = function () {
                            var t = this.getTipElement(),
                                e = t.getAttribute("class").match(Xi);
                            null !== e &&
                                e.length > 0 &&
                                e
                                    .map(function (t) {
                                        return t.trim();
                                    })
                                    .forEach(function (e) {
                                        return t.classList.remove(e);
                                    });
                        }),
                        (e._fixTransition = function () {
                            var t = this.getTipElement(),
                                e = this.config.animation;
                            null === t.getAttribute("data-popper-placement") &&
                                (t.classList.remove(Fi),
                                (this.config.animation = !1),
                                this.hide(),
                                this.show(),
                                (this.config.animation = e));
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                var n = fe(this, Yi),
                                    i = "object" == typeof e && e;
                                if (
                                    (n || !/dispose|hide/.test(e)) &&
                                    (n || (n = new t(this, i)),
                                    "string" == typeof e)
                                ) {
                                    if (void 0 === n[e])
                                        throw new TypeError(
                                            'No method named "' + e + '"'
                                        );
                                    n[e]();
                                }
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Yi);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return Qi;
                                },
                            },
                            {
                                key: "NAME",
                                get: function () {
                                    return Wi;
                                },
                            },
                            {
                                key: "DATA_KEY",
                                get: function () {
                                    return Yi;
                                },
                            },
                            {
                                key: "Event",
                                get: function () {
                                    return Vi;
                                },
                            },
                            {
                                key: "EVENT_KEY",
                                get: function () {
                                    return Mi;
                                },
                            },
                            {
                                key: "DefaultType",
                                get: function () {
                                    return Ui;
                                },
                            },
                        ]),
                        t
                    );
                })(),
                to = le();
            if (to) {
                var eo = to.fn.tooltip;
                (to.fn.tooltip = Zi.jQueryInterface),
                    (to.fn.tooltip.Constructor = Zi),
                    (to.fn.tooltip.noConflict = function () {
                        return (to.fn.tooltip = eo), Zi.jQueryInterface;
                    });
            }
            var no = "popover",
                io = "coreui.popover",
                oo = "." + io,
                ro = new RegExp("(^|\\s)bs-popover\\S+", "g"),
                so = Ut(
                    Ut({}, Zi.Default),
                    {},
                    {
                        placement: "right",
                        trigger: "click",
                        content: "",
                        template:
                            '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                    }
                ),
                ao = Ut(
                    Ut({}, Zi.DefaultType),
                    {},
                    { content: "(string|element|function)" }
                ),
                lo = {
                    HIDE: "hide" + oo,
                    HIDDEN: "hidden" + oo,
                    SHOW: "show" + oo,
                    SHOWN: "shown" + oo,
                    INSERTED: "inserted" + oo,
                    CLICK: "click" + oo,
                    FOCUSIN: "focusin" + oo,
                    FOCUSOUT: "focusout" + oo,
                    MOUSEENTER: "mouseenter" + oo,
                    MOUSELEAVE: "mouseleave" + oo,
                },
                co = (function (t) {
                    var e, n;
                    function i() {
                        return t.apply(this, arguments) || this;
                    }
                    (n = t),
                        ((e = i).prototype = Object.create(n.prototype)),
                        (e.prototype.constructor = e),
                        (e.__proto__ = n);
                    var o = i.prototype;
                    return (
                        (o.isWithContent = function () {
                            return this.getTitle() || this._getContent();
                        }),
                        (o.setContent = function () {
                            var t = this.getTipElement();
                            this.setElementContent(
                                Ve.findOne(".popover-header", t),
                                this.getTitle()
                            );
                            var e = this._getContent();
                            "function" == typeof e &&
                                (e = e.call(this.element)),
                                this.setElementContent(
                                    Ve.findOne(".popover-body", t),
                                    e
                                ),
                                t.classList.remove("fade", "show");
                        }),
                        (o._addAttachmentClass = function (t) {
                            this.getTipElement().classList.add(
                                "bs-popover-" + t
                            );
                        }),
                        (o._getContent = function () {
                            return (
                                this.element.getAttribute("data-content") ||
                                this.config.content
                            );
                        }),
                        (o._cleanTipClass = function () {
                            var t = this.getTipElement(),
                                e = t.getAttribute("class").match(ro);
                            null !== e &&
                                e.length > 0 &&
                                e
                                    .map(function (t) {
                                        return t.trim();
                                    })
                                    .forEach(function (e) {
                                        return t.classList.remove(e);
                                    });
                        }),
                        (i.jQueryInterface = function (t) {
                            return this.each(function () {
                                var e = fe(this, io),
                                    n = "object" == typeof t ? t : null;
                                if (
                                    (e || !/dispose|hide/.test(t)) &&
                                    (e ||
                                        ((e = new i(this, n)), ue(this, io, e)),
                                    "string" == typeof t)
                                ) {
                                    if (void 0 === e[t])
                                        throw new TypeError(
                                            'No method named "' + t + '"'
                                        );
                                    e[t]();
                                }
                            });
                        }),
                        (i.getInstance = function (t) {
                            return fe(t, io);
                        }),
                        Mt(i, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return so;
                                },
                            },
                            {
                                key: "NAME",
                                get: function () {
                                    return no;
                                },
                            },
                            {
                                key: "DATA_KEY",
                                get: function () {
                                    return io;
                                },
                            },
                            {
                                key: "Event",
                                get: function () {
                                    return lo;
                                },
                            },
                            {
                                key: "EVENT_KEY",
                                get: function () {
                                    return oo;
                                },
                            },
                            {
                                key: "DefaultType",
                                get: function () {
                                    return ao;
                                },
                            },
                        ]),
                        i
                    );
                })(Zi),
                uo = le();
            if (uo) {
                var fo = uo.fn.popover;
                (uo.fn.popover = co.jQueryInterface),
                    (uo.fn.popover.Constructor = co),
                    (uo.fn.popover.noConflict = function () {
                        return (uo.fn.popover = fo), co.jQueryInterface;
                    });
            }
            var ho = "scrollspy",
                po = "coreui.scrollspy",
                go = "." + po,
                mo = { offset: 10, method: "auto", target: "" },
                vo = {
                    offset: "number",
                    method: "string",
                    target: "(string|element)",
                },
                _o = "dropdown-item",
                bo = "active",
                yo = ".nav-link",
                wo = "position",
                Eo = (function () {
                    function t(t, e) {
                        var n = this;
                        (this._element = t),
                            (this._scrollElement =
                                "BODY" === t.tagName ? window : t),
                            (this._config = this._getConfig(e)),
                            (this._selector =
                                this._config.target +
                                " " +
                                ".nav-link, " +
                                this._config.target +
                                " " +
                                ".list-group-item, " +
                                this._config.target +
                                " ." +
                                _o),
                            (this._offsets = []),
                            (this._targets = []),
                            (this._activeTarget = null),
                            (this._scrollHeight = 0),
                            De.on(
                                this._scrollElement,
                                "scroll.coreui.scrollspy",
                                function (t) {
                                    return n._process(t);
                                }
                            ),
                            this.refresh(),
                            this._process(),
                            ue(t, po, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.refresh = function () {
                            var t = this,
                                e =
                                    this._scrollElement ===
                                    this._scrollElement.window
                                        ? "offset"
                                        : wo,
                                n =
                                    "auto" === this._config.method
                                        ? e
                                        : this._config.method,
                                i = n === wo ? this._getScrollTop() : 0;
                            (this._offsets = []),
                                (this._targets = []),
                                (this._scrollHeight = this._getScrollHeight()),
                                Ve.find(this._selector)
                                    .map(function (t) {
                                        var e = Gt(t),
                                            o = e ? Ve.findOne(e) : null;
                                        if (o) {
                                            var r = o.getBoundingClientRect();
                                            if (r.width || r.height)
                                                return [rn[n](o).top + i, e];
                                        }
                                        return null;
                                    })
                                    .filter(function (t) {
                                        return t;
                                    })
                                    .sort(function (t, e) {
                                        return t[0] - e[0];
                                    })
                                    .forEach(function (e) {
                                        t._offsets.push(e[0]),
                                            t._targets.push(e[1]);
                                    });
                        }),
                        (e.dispose = function () {
                            he(this._element, po),
                                De.off(this._scrollElement, go),
                                (this._element = null),
                                (this._scrollElement = null),
                                (this._config = null),
                                (this._selector = null),
                                (this._offsets = null),
                                (this._targets = null),
                                (this._activeTarget = null),
                                (this._scrollHeight = null);
                        }),
                        (e._getConfig = function (t) {
                            if (
                                "string" !=
                                    typeof (t = Ut(
                                        Ut({}, mo),
                                        "object" == typeof t && t ? t : {}
                                    )).target &&
                                ee(t.target)
                            ) {
                                var e = t.target.id;
                                e || ((e = Kt(ho)), (t.target.id = e)),
                                    (t.target = "#" + e);
                            }
                            return ie(ho, t, vo), t;
                        }),
                        (e._getScrollTop = function () {
                            return this._scrollElement === window
                                ? this._scrollElement.pageYOffset
                                : this._scrollElement.scrollTop;
                        }),
                        (e._getScrollHeight = function () {
                            return (
                                this._scrollElement.scrollHeight ||
                                Math.max(
                                    document.body.scrollHeight,
                                    document.documentElement.scrollHeight
                                )
                            );
                        }),
                        (e._getOffsetHeight = function () {
                            return this._scrollElement === window
                                ? window.innerHeight
                                : this._scrollElement.getBoundingClientRect()
                                      .height;
                        }),
                        (e._process = function () {
                            var t = this._getScrollTop() + this._config.offset,
                                e = this._getScrollHeight(),
                                n =
                                    this._config.offset +
                                    e -
                                    this._getOffsetHeight();
                            if (
                                (this._scrollHeight !== e && this.refresh(),
                                t >= n)
                            ) {
                                var i = this._targets[this._targets.length - 1];
                                this._activeTarget !== i && this._activate(i);
                            } else {
                                if (
                                    this._activeTarget &&
                                    t < this._offsets[0] &&
                                    this._offsets[0] > 0
                                )
                                    return (
                                        (this._activeTarget = null),
                                        void this._clear()
                                    );
                                for (var o = this._offsets.length; o--; ) {
                                    this._activeTarget !== this._targets[o] &&
                                        t >= this._offsets[o] &&
                                        (void 0 === this._offsets[o + 1] ||
                                            t < this._offsets[o + 1]) &&
                                        this._activate(this._targets[o]);
                                }
                            }
                        }),
                        (e._activate = function (t) {
                            (this._activeTarget = t), this._clear();
                            var e = this._selector.split(",").map(function (e) {
                                    return (
                                        e +
                                        '[data-target="' +
                                        t +
                                        '"],' +
                                        e +
                                        '[href="' +
                                        t +
                                        '"]'
                                    );
                                }),
                                n = Ve.findOne(e.join(","));
                            n.classList.contains(_o)
                                ? (Ve.findOne(
                                      ".dropdown-toggle",
                                      n.closest(".dropdown")
                                  ).classList.add(bo),
                                  n.classList.add(bo))
                                : (n.classList.add(bo),
                                  Ve.parents(n, ".nav, .list-group").forEach(
                                      function (t) {
                                          Ve.prev(
                                              t,
                                              ".nav-link, .list-group-item"
                                          ).forEach(function (t) {
                                              return t.classList.add(bo);
                                          }),
                                              Ve.prev(t, ".nav-item").forEach(
                                                  function (t) {
                                                      Ve.children(
                                                          t,
                                                          yo
                                                      ).forEach(function (t) {
                                                          return t.classList.add(
                                                              bo
                                                          );
                                                      });
                                                  }
                                              );
                                      }
                                  )),
                                De.trigger(
                                    this._scrollElement,
                                    "activate.coreui.scrollspy",
                                    { relatedTarget: t }
                                );
                        }),
                        (e._clear = function () {
                            Ve.find(this._selector)
                                .filter(function (t) {
                                    return t.classList.contains(bo);
                                })
                                .forEach(function (t) {
                                    return t.classList.remove(bo);
                                });
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                var n = fe(this, po);
                                if (
                                    (n ||
                                        (n = new t(
                                            this,
                                            "object" == typeof e && e
                                        )),
                                    "string" == typeof e)
                                ) {
                                    if (void 0 === n[e])
                                        throw new TypeError(
                                            'No method named "' + e + '"'
                                        );
                                    n[e]();
                                }
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, po);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return mo;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(window, "load.coreui.scrollspy.data-api", function () {
                Ve.find('[data-spy="scroll"]').forEach(function (t) {
                    return new Eo(t, rn.getDataAttributes(t));
                });
            });
            var Lo = le();
            if (Lo) {
                var ko = Lo.fn[ho];
                (Lo.fn[ho] = Eo.jQueryInterface),
                    (Lo.fn[ho].Constructor = Eo),
                    (Lo.fn[ho].noConflict = function () {
                        return (Lo.fn[ho] = ko), Eo.jQueryInterface;
                    });
            }
            var To = "sidebar",
                Co = "coreui.sidebar",
                Oo = {
                    activeLinksExact: !0,
                    breakpoints: {
                        xs: "c-sidebar-show",
                        sm: "c-sidebar-sm-show",
                        md: "c-sidebar-md-show",
                        lg: "c-sidebar-lg-show",
                        xl: "c-sidebar-xl-show",
                        xxl: "c-sidebar-xxl-show",
                    },
                    dropdownAccordion: !0,
                },
                Ao = {
                    activeLinksExact: "boolean",
                    breakpoints: "object",
                    dropdownAccordion: "(string|boolean)",
                },
                So = "c-active",
                xo = "c-sidebar-nav-dropdown",
                Do = "c-show",
                No = "c-sidebar-minimized",
                Io = "c-sidebar-unfoldable",
                jo = "click.coreui.sidebar.data-api",
                Ro = ".c-sidebar-nav-dropdown-toggle",
                Po = ".c-sidebar-nav-dropdown",
                Ho = ".c-sidebar-nav-link",
                Wo = ".c-sidebar-nav",
                Yo = ".c-sidebar",
                Mo = (function () {
                    function t(t, e) {
                        if (void 0 === Wt)
                            throw new TypeError(
                                "CoreUI's sidebar require Perfect Scrollbar"
                            );
                        (this._element = t),
                            (this._config = this._getConfig(e)),
                            (this._open = this._isVisible()),
                            (this._mobile = this._isMobile()),
                            (this._overlaid = this._isOverlaid()),
                            (this._minimize = this._isMinimized()),
                            (this._unfoldable = this._isUnfoldable()),
                            this._setActiveLink(),
                            (this._ps = null),
                            (this._backdrop = null),
                            this._psInit(),
                            this._addEventListeners(),
                            ue(t, Co, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.open = function (t) {
                            var e = this;
                            De.trigger(this._element, "open.coreui.sidebar"),
                                this._isMobile()
                                    ? (this._addClassName(
                                          this._firstBreakpointClassName()
                                      ),
                                      this._showBackdrop(),
                                      De.one(this._element, zt, function () {
                                          e._addClickOutListener();
                                      }))
                                    : t
                                    ? (this._addClassName(
                                          this._getBreakpointClassName(t)
                                      ),
                                      this._isOverlaid() &&
                                          De.one(
                                              this._element,
                                              zt,
                                              function () {
                                                  e._addClickOutListener();
                                              }
                                          ))
                                    : (this._addClassName(
                                          this._firstBreakpointClassName()
                                      ),
                                      this._isOverlaid() &&
                                          De.one(
                                              this._element,
                                              zt,
                                              function () {
                                                  e._addClickOutListener();
                                              }
                                          ));
                            var n = Zt(this._element);
                            De.one(this._element, zt, function () {
                                !0 === e._isVisible() &&
                                    ((e._open = !0),
                                    De.trigger(
                                        e._element,
                                        "opened.coreui.sidebar"
                                    ));
                            }),
                                ne(this._element, n);
                        }),
                        (e.close = function (t) {
                            var e = this;
                            De.trigger(this._element, "close.coreui.sidebar"),
                                this._isMobile()
                                    ? (this._element.classList.remove(
                                          this._firstBreakpointClassName()
                                      ),
                                      this._removeBackdrop(),
                                      this._removeClickOutListener())
                                    : t
                                    ? (this._element.classList.remove(
                                          this._getBreakpointClassName(t)
                                      ),
                                      this._isOverlaid() &&
                                          this._removeClickOutListener())
                                    : (this._element.classList.remove(
                                          this._firstBreakpointClassName()
                                      ),
                                      this._isOverlaid() &&
                                          this._removeClickOutListener());
                            var n = Zt(this._element);
                            De.one(this._element, zt, function () {
                                !1 === e._isVisible() &&
                                    ((e._open = !1),
                                    De.trigger(
                                        e._element,
                                        "closed.coreui.sidebar"
                                    ));
                            }),
                                ne(this._element, n);
                        }),
                        (e.toggle = function (t) {
                            this._open ? this.close(t) : this.open(t);
                        }),
                        (e.minimize = function () {
                            this._isMobile() ||
                                (this._addClassName(No),
                                (this._minimize = !0),
                                this._psDestroy());
                        }),
                        (e.unfoldable = function () {
                            this._isMobile() ||
                                (this._addClassName(Io),
                                (this._unfoldable = !0));
                        }),
                        (e.reset = function () {
                            this._element.classList.contains(No) &&
                                (this._element.classList.remove(No),
                                (this._minimize = !1),
                                De.one(this._element, zt, this._psInit())),
                                this._element.classList.contains(Io) &&
                                    (this._element.classList.remove(Io),
                                    (this._unfoldable = !1));
                        }),
                        (e._getConfig = function (t) {
                            return (
                                (t = Ut(
                                    Ut(
                                        Ut({}, this.constructor.Default),
                                        rn.getDataAttributes(this._element)
                                    ),
                                    t
                                )),
                                ie(To, t, this.constructor.DefaultType),
                                t
                            );
                        }),
                        (e._isMobile = function () {
                            return Boolean(
                                window
                                    .getComputedStyle(this._element, null)
                                    .getPropertyValue("--is-mobile")
                            );
                        }),
                        (e._isIOS = function () {
                            var t = [
                                "iPad Simulator",
                                "iPhone Simulator",
                                "iPod Simulator",
                                "iPad",
                                "iPhone",
                                "iPod",
                            ];
                            if (Boolean(navigator.platform))
                                for (; t.length; )
                                    if (navigator.platform === t.pop())
                                        return !0;
                            return !1;
                        }),
                        (e._isMinimized = function () {
                            return this._element.classList.contains(No);
                        }),
                        (e._isOverlaid = function () {
                            return this._element.classList.contains(
                                "c-sidebar-overlaid"
                            );
                        }),
                        (e._isUnfoldable = function () {
                            return this._element.classList.contains(Io);
                        }),
                        (e._isVisible = function () {
                            var t = this._element.getBoundingClientRect();
                            return (
                                t.top >= 0 &&
                                t.left >= 0 &&
                                t.bottom <=
                                    (window.innerHeight ||
                                        document.documentElement
                                            .clientHeight) &&
                                t.right <=
                                    (window.innerWidth ||
                                        document.documentElement.clientWidth)
                            );
                        }),
                        (e._addClassName = function (t) {
                            this._element.classList.add(t);
                        }),
                        (e._firstBreakpointClassName = function () {
                            return Object.keys(Oo.breakpoints).map(function (
                                t
                            ) {
                                return Oo.breakpoints[t];
                            })[0];
                        }),
                        (e._getBreakpointClassName = function (t) {
                            return Oo.breakpoints[t];
                        }),
                        (e._removeBackdrop = function () {
                            this._backdrop &&
                                (this._backdrop.parentNode.removeChild(
                                    this._backdrop
                                ),
                                (this._backdrop = null));
                        }),
                        (e._showBackdrop = function () {
                            this._backdrop ||
                                ((this._backdrop =
                                    document.createElement("div")),
                                (this._backdrop.className =
                                    "c-sidebar-backdrop"),
                                this._backdrop.classList.add("c-fade"),
                                document.body.appendChild(this._backdrop),
                                ae(this._backdrop),
                                this._backdrop.classList.add(Do));
                        }),
                        (e._clickOutListener = function (t, e) {
                            null === t.target.closest(Yo) &&
                                (t.preventDefault(),
                                t.stopPropagation(),
                                e.close());
                        }),
                        (e._addClickOutListener = function () {
                            var t = this;
                            De.on(document, jo, function (e) {
                                t._clickOutListener(e, t);
                            });
                        }),
                        (e._removeClickOutListener = function () {
                            De.off(document, jo);
                        }),
                        (e._getAllSiblings = function (t, e) {
                            var n = [];
                            t = t.parentNode.firstChild;
                            do {
                                3 !== t.nodeType &&
                                    8 !== t.nodeType &&
                                    ((e && !e(t)) || n.push(t));
                            } while ((t = t.nextSibling));
                            return n;
                        }),
                        (e._toggleDropdown = function (t, e) {
                            var n = t.target;
                            n.classList.contains(
                                "c-sidebar-nav-dropdown-toggle"
                            ) || (n = n.closest(Ro));
                            var i = n.closest(Wo).dataset;
                            void 0 !== i.dropdownAccordion &&
                                (Oo.dropdownAccordion = JSON.parse(
                                    i.dropdownAccordion
                                )),
                                !0 === Oo.dropdownAccordion &&
                                    this._getAllSiblings(
                                        n.parentElement,
                                        function (t) {
                                            return Boolean(
                                                t.classList.contains(xo)
                                            );
                                        }
                                    ).forEach(function (t) {
                                        t !== n.parentNode &&
                                            t.classList.contains(xo) &&
                                            t.classList.remove(Do);
                                    }),
                                n.parentNode.classList.toggle(Do),
                                e._psUpdate();
                        }),
                        (e._psInit = function () {
                            this._element.querySelector(Wo) &&
                                !this._isIOS() &&
                                (this._ps = new Wt(
                                    this._element.querySelector(Wo),
                                    {
                                        suppressScrollX: !0,
                                        wheelPropagation: !1,
                                    }
                                ));
                        }),
                        (e._psUpdate = function () {
                            this._ps && this._ps.update();
                        }),
                        (e._psDestroy = function () {
                            this._ps && (this._ps.destroy(), (this._ps = null));
                        }),
                        (e._getParents = function (t, e) {
                            for (
                                var n = [];
                                t && t !== document;
                                t = t.parentNode
                            )
                                e ? t.matches(e) && n.push(t) : n.push(t);
                            return n;
                        }),
                        (e._setActiveLink = function () {
                            var t = this;
                            Array.from(
                                this._element.querySelectorAll(Ho)
                            ).forEach(function (e) {
                                var n = String(window.location);
                                (/\?.*=/.test(n) || /\?./.test(n)) &&
                                    (n = n.split("?")[0]),
                                    /#./.test(n) && (n = n.split("#")[0]);
                                var i = e.closest(Wo).dataset;
                                void 0 !== i.activeLinksExact &&
                                    (Oo.activeLinksExact = JSON.parse(
                                        i.activeLinksExact
                                    )),
                                    Oo.activeLinksExact &&
                                        e.href === n &&
                                        (e.classList.add(So),
                                        Array.from(
                                            t._getParents(e, Po)
                                        ).forEach(function (t) {
                                            t.classList.add(Do);
                                        })),
                                    !Oo.activeLinksExact &&
                                        e.href.startsWith(n) &&
                                        (e.classList.add(So),
                                        Array.from(
                                            t._getParents(e, Po)
                                        ).forEach(function (t) {
                                            t.classList.add(Do);
                                        }));
                            });
                        }),
                        (e._addEventListeners = function () {
                            var t = this;
                            this._mobile &&
                                this._open &&
                                this._addClickOutListener(),
                                this._overlaid &&
                                    this._open &&
                                    this._addClickOutListener(),
                                De.on(
                                    this._element,
                                    "classtoggle",
                                    function (e) {
                                        if (
                                            (e.detail.className === No &&
                                                (t._element.classList.contains(
                                                    No
                                                )
                                                    ? t.minimize()
                                                    : t.reset()),
                                            e.detail.className === Io &&
                                                (t._element.classList.contains(
                                                    Io
                                                )
                                                    ? t.unfoldable()
                                                    : t.reset()),
                                            void 0 !==
                                                Object.keys(
                                                    Oo.breakpoints
                                                ).find(function (t) {
                                                    return (
                                                        Oo.breakpoints[t] ===
                                                        e.detail.className
                                                    );
                                                }))
                                        ) {
                                            var n = e.detail.className,
                                                i = Object.keys(
                                                    Oo.breakpoints
                                                ).find(function (t) {
                                                    return (
                                                        Oo.breakpoints[t] === n
                                                    );
                                                });
                                            e.detail.add
                                                ? t.open(i)
                                                : t.close(i);
                                        }
                                    }
                                ),
                                De.on(this._element, jo, Ro, function (e) {
                                    e.preventDefault(), t._toggleDropdown(e, t);
                                }),
                                De.on(this._element, jo, Ho, function () {
                                    t._isMobile() && t.close();
                                });
                        }),
                        (t._sidebarInterface = function (e, n) {
                            var i = fe(e, Co);
                            if (
                                (i || (i = new t(e, "object" == typeof n && n)),
                                "string" == typeof n)
                            ) {
                                if (void 0 === i[n])
                                    throw new TypeError(
                                        'No method named "' + n + '"'
                                    );
                                i[n]();
                            }
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                t._sidebarInterface(this, e);
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Co);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return Oo;
                                },
                            },
                            {
                                key: "DefaultType",
                                get: function () {
                                    return Ao;
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(window, "load.coreui.sidebar.data-api", function () {
                Array.from(document.querySelectorAll(Yo)).forEach(function (t) {
                    Mo._sidebarInterface(t);
                });
            });
            var Xo = le();
            if (Xo) {
                var Bo = Xo.fn.sidebar;
                (Xo.fn.sidebar = Mo.jQueryInterface),
                    (Xo.fn.sidebar.Constructor = Mo),
                    (Xo.fn.sidebar.noConflict = function () {
                        return (Xo.fn.sidebar = Bo), Mo.jQueryInterface;
                    });
            }
            var Uo = "coreui.tab",
                qo = "active",
                Qo = "fade",
                Vo = "show",
                Fo = ".active",
                zo = ":scope > li > .active",
                Ko = (function () {
                    function t(t) {
                        (this._element = t), ue(this._element, Uo, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.show = function () {
                            var t = this;
                            if (
                                !(
                                    (this._element.parentNode &&
                                        this._element.parentNode.nodeType ===
                                            Node.ELEMENT_NODE &&
                                        this._element.classList.contains(qo)) ||
                                    this._element.classList.contains("disabled")
                                )
                            ) {
                                var e,
                                    n = Jt(this._element),
                                    i =
                                        this._element.closest(
                                            ".nav, .list-group"
                                        );
                                if (i) {
                                    var o =
                                        "UL" === i.nodeName ||
                                        "OL" === i.nodeName
                                            ? zo
                                            : Fo;
                                    e = (e = Ve.find(o, i))[e.length - 1];
                                }
                                var r = null;
                                if (
                                    (e &&
                                        (r = De.trigger(e, "hide.coreui.tab", {
                                            relatedTarget: this._element,
                                        })),
                                    !(
                                        De.trigger(
                                            this._element,
                                            "show.coreui.tab",
                                            { relatedTarget: e }
                                        ).defaultPrevented ||
                                        (null !== r && r.defaultPrevented)
                                    ))
                                ) {
                                    this._activate(this._element, i);
                                    var s = function () {
                                        De.trigger(e, "hidden.coreui.tab", {
                                            relatedTarget: t._element,
                                        }),
                                            De.trigger(
                                                t._element,
                                                "shown.coreui.tab",
                                                { relatedTarget: e }
                                            );
                                    };
                                    n
                                        ? this._activate(n, n.parentNode, s)
                                        : s();
                                }
                            }
                        }),
                        (e.dispose = function () {
                            he(this._element, Uo), (this._element = null);
                        }),
                        (e._activate = function (t, e, n) {
                            var i = this,
                                o = (
                                    !e ||
                                    ("UL" !== e.nodeName && "OL" !== e.nodeName)
                                        ? Ve.children(e, Fo)
                                        : Ve.find(zo, e)
                                )[0],
                                r = n && o && o.classList.contains(Qo),
                                s = function () {
                                    return i._transitionComplete(t, o, n);
                                };
                            if (o && r) {
                                var a = Zt(o);
                                o.classList.remove(Vo),
                                    De.one(o, zt, s),
                                    ne(o, a);
                            } else s();
                        }),
                        (e._transitionComplete = function (t, e, n) {
                            if (e) {
                                e.classList.remove(qo);
                                var i = Ve.findOne(
                                    ":scope > .dropdown-menu .active",
                                    e.parentNode
                                );
                                i && i.classList.remove(qo),
                                    "tab" === e.getAttribute("role") &&
                                        e.setAttribute("aria-selected", !1);
                            }
                            (t.classList.add(qo),
                            "tab" === t.getAttribute("role") &&
                                t.setAttribute("aria-selected", !0),
                            ae(t),
                            t.classList.contains(Qo) && t.classList.add(Vo),
                            t.parentNode &&
                                t.parentNode.classList.contains(
                                    "dropdown-menu"
                                )) &&
                                (t.closest(".dropdown") &&
                                    Ve.find(".dropdown-toggle").forEach(
                                        function (t) {
                                            return t.classList.add(qo);
                                        }
                                    ),
                                t.setAttribute("aria-expanded", !0));
                            n && n();
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                var n = fe(this, Uo) || new t(this);
                                if ("string" == typeof e) {
                                    if (void 0 === n[e])
                                        throw new TypeError(
                                            'No method named "' + e + '"'
                                        );
                                    n[e]();
                                }
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Uo);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                        ]),
                        t
                    );
                })();
            De.on(
                document,
                "click.coreui.tab.data-api",
                '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
                function (t) {
                    t.preventDefault(), (fe(this, Uo) || new Ko(this)).show();
                }
            );
            var $o = le();
            if ($o) {
                var Go = $o.fn.tab;
                ($o.fn.tab = Ko.jQueryInterface),
                    ($o.fn.tab.Constructor = Ko),
                    ($o.fn.tab.noConflict = function () {
                        return ($o.fn.tab = Go), Ko.jQueryInterface;
                    });
            }
            var Jo = "toast",
                Zo = "coreui.toast",
                tr = "." + Zo,
                er = "click.dismiss" + tr,
                nr = "hide",
                ir = "show",
                or = "showing",
                rr = {
                    animation: "boolean",
                    autohide: "boolean",
                    delay: "number",
                },
                sr = { animation: !0, autohide: !0, delay: 5e3 },
                ar = (function () {
                    function t(t, e) {
                        (this._element = t),
                            (this._config = this._getConfig(e)),
                            (this._timeout = null),
                            this._setListeners(),
                            ue(t, Zo, this);
                    }
                    var e = t.prototype;
                    return (
                        (e.show = function () {
                            var t = this;
                            if (
                                !De.trigger(this._element, "show.coreui.toast")
                                    .defaultPrevented
                            ) {
                                this._clearTimeout(),
                                    this._config.animation &&
                                        this._element.classList.add("fade");
                                var e = function () {
                                    t._element.classList.remove(or),
                                        t._element.classList.add(ir),
                                        De.trigger(
                                            t._element,
                                            "shown.coreui.toast"
                                        ),
                                        t._config.autohide &&
                                            (t._timeout = setTimeout(
                                                function () {
                                                    t.hide();
                                                },
                                                t._config.delay
                                            ));
                                };
                                if (
                                    (this._element.classList.remove(nr),
                                    ae(this._element),
                                    this._element.classList.add(or),
                                    this._config.animation)
                                ) {
                                    var n = Zt(this._element);
                                    De.one(this._element, zt, e),
                                        ne(this._element, n);
                                } else e();
                            }
                        }),
                        (e.hide = function () {
                            var t = this;
                            if (
                                this._element.classList.contains(ir) &&
                                !De.trigger(this._element, "hide.coreui.toast")
                                    .defaultPrevented
                            ) {
                                var e = function () {
                                    t._element.classList.add(nr),
                                        De.trigger(
                                            t._element,
                                            "hidden.coreui.toast"
                                        );
                                };
                                if (
                                    (this._element.classList.remove(ir),
                                    this._config.animation)
                                ) {
                                    var n = Zt(this._element);
                                    De.one(this._element, zt, e),
                                        ne(this._element, n);
                                } else e();
                            }
                        }),
                        (e.dispose = function () {
                            this._clearTimeout(),
                                this._element.classList.contains(ir) &&
                                    this._element.classList.remove(ir),
                                De.off(this._element, er),
                                he(this._element, Zo),
                                (this._element = null),
                                (this._config = null);
                        }),
                        (e._getConfig = function (t) {
                            return (
                                (t = Ut(
                                    Ut(
                                        Ut({}, sr),
                                        rn.getDataAttributes(this._element)
                                    ),
                                    "object" == typeof t && t ? t : {}
                                )),
                                ie(Jo, t, this.constructor.DefaultType),
                                t
                            );
                        }),
                        (e._setListeners = function () {
                            var t = this;
                            De.on(
                                this._element,
                                er,
                                '[data-dismiss="toast"]',
                                function () {
                                    return t.hide();
                                }
                            );
                        }),
                        (e._clearTimeout = function () {
                            clearTimeout(this._timeout), (this._timeout = null);
                        }),
                        (t.jQueryInterface = function (e) {
                            return this.each(function () {
                                var n = fe(this, Zo);
                                if (
                                    (n ||
                                        (n = new t(
                                            this,
                                            "object" == typeof e && e
                                        )),
                                    "string" == typeof e)
                                ) {
                                    if (void 0 === n[e])
                                        throw new TypeError(
                                            'No method named "' + e + '"'
                                        );
                                    n[e](this);
                                }
                            });
                        }),
                        (t.getInstance = function (t) {
                            return fe(t, Zo);
                        }),
                        Mt(t, null, [
                            {
                                key: "VERSION",
                                get: function () {
                                    return "3.2.2";
                                },
                            },
                            {
                                key: "DefaultType",
                                get: function () {
                                    return rr;
                                },
                            },
                            {
                                key: "Default",
                                get: function () {
                                    return sr;
                                },
                            },
                        ]),
                        t
                    );
                })(),
                lr = le();
            if (lr) {
                var cr = lr.fn.toast;
                (lr.fn.toast = ar.jQueryInterface),
                    (lr.fn.toast.Constructor = ar),
                    (lr.fn.toast.noConflict = function () {
                        return (lr.fn.toast = cr), ar.jQueryInterface;
                    });
            }
        },
        565: (t, e, n) => {
            "use strict";
            n(443);
            (window.$ = window.jQuery = n(755)),
                (window.Swal = n(455)),
                n(39),
                n(870);
        },
        870: () => {
            $(function () {
                var t = $(".permission-tree :checkbox");
                function e(t) {
                    t.find('input[type="submit"]').removeAttr("disabled"),
                        t.find('button[type="submit"]').removeAttr("disabled");
                }
                t.on("click change", function () {
                    $(this).is(":checked")
                        ? $(this)
                              .siblings("ul")
                              .find('input[type="checkbox"]')
                              .attr("checked", !0)
                              .attr("disabled", !0)
                        : $(this)
                              .siblings("ul")
                              .find('input[type="checkbox"]')
                              .removeAttr("checked")
                              .removeAttr("disabled");
                }),
                    t.each(function () {
                        $(this).is(":checked") &&
                            $(this)
                                .siblings("ul")
                                .find('input[type="checkbox"]')
                                .attr("checked", !0)
                                .attr("disabled", !0);
                    }),
                    $("form").submit(function () {
                        var t;
                        return (
                            (t = $(this))
                                .find('input[type="submit"]')
                                .attr("disabled", !0),
                            t
                                .find('button[type="submit"]')
                                .attr("disabled", !0),
                            !0
                        );
                    }),
                    $("body")
                        .on("submit", "form[name=delete-item]", function (t) {
                            var n = this;
                            t.preventDefault(),
                                Swal.fire({
                                    title: "Are you sure you want to delete this item?",
                                    showCancelButton: !0,
                                    confirmButtonText: "Confirm Delete",
                                    cancelButtonText: "Cancel",
                                    icon: "warning",
                                }).then(function (t) {
                                    t.value ? n.submit() : e($(n));
                                });
                        })
                        .on("submit", "form[name=confirm-item]", function (t) {
                            var n = this;
                            t.preventDefault(),
                                Swal.fire({
                                    title: "Are you sure you want to do this?",
                                    showCancelButton: !0,
                                    confirmButtonText: "Continue",
                                    cancelButtonText: "Cancel",
                                    icon: "warning",
                                }).then(function (t) {
                                    t.value ? n.submit() : e($(n));
                                });
                        })
                        .on("click", "a[name=confirm-item]", function (t) {
                            var e = this;
                            t.preventDefault(),
                                Swal.fire({
                                    title: "Are you sure you want to do this?",
                                    showCancelButton: !0,
                                    confirmButtonText: "Continue",
                                    cancelButtonText: "Cancel",
                                    icon: "info",
                                }).then(function (t) {
                                    t.value &&
                                        window.location.assign(
                                            $(e).attr("href")
                                        );
                                });
                        }),
                    $('a[data-toggle="tab"], a[data-toggle="pill"]').on(
                        "shown.bs.tab",
                        function (t) {
                            var e = $(t.target).attr("href");
                            history.pushState
                                ? history.pushState(null, null, e)
                                : (location.hash = e);
                        }
                    );
                var n = window.location.hash;
                n && $('.nav-link[href="' + n + '"]').tab("show"),
                    $('[data-toggle="tooltip"]').tooltip();
            });
        },
    },
    (t) => {
        "use strict";
        t.O(0, [898], () => {
            return (e = 565), t((t.s = e));
            var e;
        });
        t.O();
    },
]);
