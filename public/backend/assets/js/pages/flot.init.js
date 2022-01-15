!(function (n) {
    "use strict";
    function t() {
        (this.$body = n("body")), (this.$realData = []);
    }


        (t.prototype.createDonutGraph = function (t, a, o, e) {
            var r = [
                    { label: a[0], data: o[0] },
                    { label: a[1], data: o[1] },
                    { label: a[2], data: o[2] },
                    { label: a[3], data: o[3] },
                    { label: a[4], data: o[4] },
                ],
                l = {
                    series: { pie: { show: !0, innerRadius: 0.7 } },
                    legend: {
                        show: !0,
                        backgroundColor: "transparent",
                        labelFormatter: function (t, a) {
                            return '<div style="font-size:12px;">&nbsp;' + t + "</div>";
                        },
                        labelBoxBorderColor: null,
                        margin: 50,
                        width: 20,
                        padding: 1,
                    },
                    grid: { hoverable: !0, clickable: !0 },
                    colors: e,
                    tooltip: !0,
                    tooltipOpts: { content: "%s, %p.0%" },
                };
            n.plot(n(t), r, l);
        }),
        (t.prototype.init = function () {


            this.createDonutGraph("#donut-chart #donut-chart-container", ["Desktops", "Laptops", "Tablets"], [29, 20, 18], ["#f0f1f4", "#556ee6", "#34c38f"]);
        }),
        (n.FlotChart = new t()),
        (n.FlotChart.Constructor = t);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.FlotChart.init();
    })();
