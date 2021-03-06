$(document).ready(function () {
    $("body").on("click", "[data-ma-action]", function (e) {
        function launchIntoFullscreen(element) {
            element.requestFullscreen ? element.requestFullscreen() : element.mozRequestFullScreen ? element.mozRequestFullScreen() : element.webkitRequestFullscreen ? element.webkitRequestFullscreen() : element.msRequestFullscreen && element.msRequestFullscreen()
        }
        e.preventDefault();
        var $this = $(this)
            , action = $(this).data("ma-action");
        switch (action) {
            case "sidebar-open":
                var target = $this.data("ma-target")
                    , backdrop = '<div data-ma-action="sidebar-close" class="ma-backdrop" />';
                $("body").addClass("sidebar-toggled"),
                    $("#header, #header-alt, #main").append(backdrop),
                    $this.addClass("toggled"),
                    $(target).addClass("toggled");
                break;
            case "sidebar-close":
                $("body").removeClass("sidebar-toggled"),
                    $(".ma-backdrop").remove(),
                    $(".sidebar, .ma-trigger").removeClass("toggled");
                break;
            case "submenu-toggle":
                $this.next().slideToggle(200),
                    $this.parent().toggleClass("toggled");
                break;
            case "search-open":
                $("#header").addClass("search-toggled"),
                    $("#top-search-wrap input").focus();
                break;
            case "search-close":
                $("#header").removeClass("search-toggled");
                break;
            case "clear-notification":
                var x = $this.closest(".list-group")
                    , y = x.find(".list-group-item")
                    , z = y.size();
                $this.parent().fadeOut(),
                    x.find(".list-group").prepend('<i class="grid-loading hide-it"></i>'),
                    x.find(".grid-loading").fadeIn(1500);
                var w = 0;
                y.each(function () {
                    var z = $(this);
                    setTimeout(function () {
                        z.addClass("animated fadeOutRightBig").delay(1e3).queue(function () {
                            z.remove()
                        })
                    }, w += 150)
                }),
                    setTimeout(function () {
                        $("#notifications").addClass("empty")
                    }, 150 * z + 200);
                break;
            case "fullscreen":
                launchIntoFullscreen(document.documentElement);
                break;
            case "clear-localstorage":
                swal({
                    title: "Are you sure?",
                    text: "All your saved localStorage values will be removed",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: !1
                }, function () {
                    localStorage.clear(),
                        swal("Done!", "localStorage is cleared", "success")
                });
                break;
            case "print":
                window.print();
                break;
            case "login-switch":
                var loginblock = $this.data("ma-block")
                    , loginParent = $this.closest(".lc-block");
                loginParent.removeClass("toggled"),
                    setTimeout(function () {
                        $(loginblock).addClass("toggled")
                    });
                break;
            case "profile-edit":
                $this.closest(".pmb-block").toggleClass("toggled");
                break;
            case "profile-edit-cancel":
                $(this).closest(".pmb-block").removeClass("toggled");
                break;
            case "action-header-open":
                ahParent = $this.closest(".action-header").find(".ah-search"),
                    ahParent.fadeIn(300),
                    ahParent.find(".ahs-input").focus();
                break;
            case "action-header-close":
                ahParent.fadeOut(300),
                    setTimeout(function () {
                        ahParent.find(".ahs-input").val("")
                    }, 350);
                break;
            case "wall-comment-open":
                $this.closest(".wic-form").hasClass("toggled") || $this.closest(".wic-form").addClass("toggled");
                break;
            case "wall-comment-close":
                $this.closest(".wic-form").find("textarea").val(""),
                    $this.closest(".wic-form").removeClass("toggled");
                break;
            case "todo-form-open":
                $this.closest(".t-add").addClass("toggled");
                break;
            case "todo-form-close":
                $this.closest(".t-add").removeClass("toggled"),
                    $this.closest(".t-add").find("textarea").val("")
        }
    })
}),
    $(document).ready(function () {
        var data1 = [[1, 60], [2, 30], [3, 50], [4, 100], [5, 10], [6, 90], [7, 85]]
            , data2 = [[1, 20], [2, 90], [3, 60], [4, 40], [5, 100], [6, 25], [7, 65]]
            , data3 = [[1, 100], [2, 20], [3, 60], [4, 90], [5, 80], [6, 10], [7, 5]]
            , barData = [{
                label: "Tokyo",
                data: data1,
                color: "#dbdddd"
            }, {
                label: "Seoul",
                data: data2,
                color: "#636c72"
            }, {
                label: "Beijing",
                data: data3,
                color: "#3e4a51"
            }];
        $("#bar-chart")[0] && $.plot($("#bar-chart"), barData, {
            series: {
                bars: {
                    show: !0,
                    barWidth: .05,
                    order: 1,
                    fill: 1
                }
            },
            grid: {
                borderWidth: 1,
                borderColor: "#333c42",
                show: !0,
                hoverable: !0,
                clickable: !0
            },
            yaxis: {
                tickColor: "#333c42",
                tickDecimals: 0,
                font: {
                    lineHeight: 13,
                    style: "normal",
                    color: "#9f9f9f"
                },
                shadowSize: 0
            },
            xaxis: {
                tickColor: "#333c42",
                tickDecimals: 0,
                font: {
                    lineHeight: 13,
                    style: "normal",
                    color: "#9f9f9f"
                },
                shadowSize: 0
            },
            legend: {
                container: ".flc-bar",
                backgroundOpacity: .5,
                noColumns: 0,
                backgroundColor: "white",
                lineWidth: 0
            }
        }),
            $(".flot-chart")[0] && ($(".flot-chart").bind("plothover", function (event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2)
                        , y = item.datapoint[1].toFixed(2);
                    $(".flot-tooltip").html(item.series.label + " of " + x + " = " + y).css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    }).show()
                } else
                    $(".flot-tooltip").hide()
            }),
                $("<div class='flot-tooltip' class='chart-tooltip'></div>").appendTo("body"))
    }),
    $(document).ready(function () {
        for (var d1 = [], i = 0; 10 >= i; i += 1)
            d1.push([i, parseInt(30 * Math.random())]);
        for (var d2 = [], i = 0; 20 >= i; i += 1)
            d2.push([i, parseInt(30 * Math.random())]);
        for (var d3 = [], i = 0; 10 >= i; i += 1)
            d3.push([i, parseInt(30 * Math.random())]);
        var options = {
            series: {
                shadowSize: 0,
                curvedLines: {
                    apply: !0,
                    active: !0,
                    monotonicFit: !0
                },
                lines: {
                    show: !1,
                    lineWidth: 0
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 10,
                hoverable: !0,
                clickable: !0,
                mouseActiveRadius: 6
            },
            xaxis: {
                tickDecimals: 0,
                ticks: !1
            },
            yaxis: {
                tickDecimals: 0,
                ticks: !1
            },
            legend: {
                show: !1
            }
        };
        $("#curved-line-chart")[0] && $.plot($("#curved-line-chart"), [{
            data: d1,
            lines: {
                show: !0,
                fill: .98
            },
            label: "Product 1",
            stack: !0,
            color: "#1f292f"
        }, {
            data: d3,
            lines: {
                show: !0,
                fill: .98
            },
            label: "Product 2",
            stack: !0,
            color: "#dbdddd"
        }], options),
            $(".flot-chart")[0] && ($(".flot-chart").bind("plothover", function (event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2)
                        , y = item.datapoint[1].toFixed(2);
                    $(".flot-tooltip").html(item.series.label + " of " + x + " = " + y).css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    }).show()
                } else
                    $(".flot-tooltip").hide()
            }),
                $("<div class='flot-tooltip' class='chart-tooltip'></div>").appendTo("body"))
    }),
    $(document).ready(function () {
        function getRandomData() {
            for (data.length > 0 && (data = data.slice(1)); data.length < totalPoints;) {
                var prev = data.length > 0 ? data[data.length - 1] : 50
                    , y = prev + 10 * Math.random() - 5;
                0 > y ? y = 0 : y > 90 && (y = 90),
                    data.push(y)
            }
            for (var res = [], i = 0; i < data.length; ++i)
                res.push([i, data[i]]);
            return res
        }
        function update() {
            plot.setData([getRandomData()]),
                plot.draw(),
                setTimeout(update, updateInterval)
        }
        var data = []
            , totalPoints = 300
            , updateInterval = 30;
        if ($("#dynamic-chart")[0]) {
            var plot = $.plot("#dynamic-chart", [getRandomData()], {
                series: {
                    label: "Server Process Data",
                    lines: {
                        show: !0,
                        lineWidth: .2,
                        fill: .6
                    },
                    color: "#fff",
                    shadowSize: 0
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    tickColor: "#333c42",
                    font: {
                        lineHeight: 13,
                        style: "normal",
                        color: "#9f9f9f"
                    },
                    shadowSize: 0
                },
                xaxis: {
                    tickColor: "#333c42",
                    show: !0,
                    font: {
                        lineHeight: 13,
                        style: "normal",
                        color: "#9f9f9f"
                    },
                    shadowSize: 0,
                    min: 0,
                    max: 250
                },
                grid: {
                    borderWidth: 1,
                    borderColor: "#333c42",
                    labelMargin: 10,
                    hoverable: !0,
                    clickable: !0,
                    mouseActiveRadius: 6
                },
                legend: {
                    container: ".flc-dynamic",
                    backgroundOpacity: .5,
                    noColumns: 0,
                    backgroundColor: "white",
                    lineWidth: 0
                }
            });
            update()
        }
    }),
    $(document).ready(function () {
        function getRandomData() {
            for (data.length > 0 && (data = data.slice(1)); data.length < totalPoints;) {
                var prev = data.length > 0 ? data[data.length - 1] : 50
                    , y = prev + 10 * Math.random() - 5;
                0 > y ? y = 0 : y > 90 && (y = 90),
                    data.push(y)
            }
            for (var res = [], i = 0; i < data.length; ++i)
                res.push([i, data[i]]);
            return res
        }
        for (var data = [], totalPoints = 100, d1 = [], i = 0; 10 >= i; i += 1)
            d1.push([i, parseInt(30 * Math.random())]);
        for (var d2 = [], i = 0; 20 >= i; i += 1)
            d2.push([i, parseInt(30 * Math.random())]);
        for (var d3 = [], i = 0; 10 >= i; i += 1)
            d3.push([i, parseInt(30 * Math.random())]);
        var options = {
            series: {
                shadowSize: 0,
                lines: {
                    show: !1,
                    lineWidth: 0
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 10,
                hoverable: !0,
                clickable: !0,
                mouseActiveRadius: 6
            },
            xaxis: {
                tickDecimals: 0,
                ticks: !1
            },
            yaxis: {
                tickDecimals: 0,
                ticks: !1
            },
            legend: {
                show: !1
            }
        };
        $("#line-chart")[0] && $.plot($("#line-chart"), [{
            data: d1,
            lines: {
                show: !0,
                fill: .98
            },
            label: "Product 1",
            stack: !0,
            color: "#1f292f"
        }, {
            data: d3,
            lines: {
                show: !0,
                fill: .98
            },
            label: "Product 2",
            stack: !0,
            color: "#dbdddd"
        }], options),
            $("#recent-items-chart")[0] && $.plot($("#recent-items-chart"), [{
                data: getRandomData(),
                lines: {
                    show: !0,
                    fill: .1
                },
                label: "Items",
                stack: !0,
                color: "#dbdddd"
            }], options),
            $(".flot-chart")[0] && ($(".flot-chart").bind("plothover", function (event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2)
                        , y = item.datapoint[1].toFixed(2);
                    $(".flot-tooltip").html(item.series.label + " of " + x + " = " + y).css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    }).show()
                } else
                    $(".flot-tooltip").hide()
            }),
                $("<div class='flot-tooltip' class='chart-tooltip'></div>").appendTo("body"))
    }),
    $(document).ready(function () {
        var pieData = [{
            data: 1,
            color: "#dbdddd",
            label: "Toyota"
        }, {
            data: 2,
            color: "#636c72",
            label: "Nissan"
        }, {
            data: 3,
            color: "#3e4a51",
            label: "Hyundai"
        }, {
            data: 4,
            color: "#1f292f",
            label: "Scion"
        }, {
            data: 4,
            color: "#ffffff",
            label: "Daihatsu"
        }];
        $("#pie-chart")[0] && $.plot("#pie-chart", pieData, {
            series: {
                pie: {
                    show: !0,
                    stroke: {
                        width: 0
                    }
                }
            },
            legend: {
                container: ".flc-pie",
                backgroundOpacity: .5,
                noColumns: 0,
                backgroundColor: "white",
                lineWidth: 0
            },
            grid: {
                hoverable: !0,
                clickable: !0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%p.0%, %s",
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: !1,
                cssClass: "flot-tooltip"
            }
        }),
            $("#donut-chart")[0] && $.plot("#donut-chart", pieData, {
                series: {
                    pie: {
                        innerRadius: .5,
                        show: !0,
                        stroke: {
                            width: 0,
                            color: "#2b343a"
                        }
                    }
                },
                legend: {
                    container: ".flc-donut",
                    backgroundOpacity: .5,
                    noColumns: 0,
                    backgroundColor: "white",
                    lineWidth: 0
                },
                grid: {
                    hoverable: !0,
                    clickable: !0
                },
                tooltip: !0,
                tooltipOpts: {
                    content: "%p.0%, %s",
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: !1,
                    cssClass: "flot-tooltip"
                }
            })
    }),
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && $("html").addClass("ismobile"),
    $(window).load(function () {
        $(".page-loader")[0] && setTimeout(function () {
            $(".page-loader").fadeOut()
        }, 500)
    }),
    $(document).ready(function () {
        function scrollBar(selector, theme, mousewheelaxis) {
            $(selector).mCustomScrollbar({
                theme: theme,
                scrollInertia: 100,
                axis: "mousewheelaxis",
                mouseWheel: {
                    enable: !0,
                    axis: mousewheelaxis,
                    preventDefault: !0
                }
            })
        }
        if ($("html").hasClass("ismobile") || $(".c-overflow")[0] && scrollBar(".c-overflow", "minimal-dark", "y"),
            $(".dropdown")[0] && ($("body").on("click", ".dropdown.open .dropdown-menu", function (e) {
                e.stopPropagation()
            }),
                $(".dropdown").on("shown.bs.dropdown", function (e) {
                    $(this).attr("data-animation") && ($animArray = [],
                        $animation = $(this).data("animation"),
                        $animArray = $animation.split(","),
                        $animationIn = "animated " + $animArray[0],
                        $animationOut = "animated " + $animArray[1],
                        $animationDuration = "",
                        $animArray[2] ? $animationDuration = $animArray[2] : $animationDuration = 500,
                        $(this).find(".dropdown-menu").removeClass($animationOut),
                        $(this).find(".dropdown-menu").addClass($animationIn))
                }),
                $(".dropdown").on("hide.bs.dropdown", function (e) {
                    $(this).attr("data-animation") && (e.preventDefault(),
                        $this = $(this),
                        $dropdownMenu = $this.find(".dropdown-menu"),
                        $dropdownMenu.addClass($animationOut),
                        setTimeout(function () {
                            $this.removeClass("open")
                        }, $animationDuration))
                })),
            $("#calendar-widget")[0] && !function () {
                $("#calendar-widget #cw-body").fullCalendar({
                    contentHeight: "auto",
                    theme: !0,
                    header: {
                        right: "",
                        center: "prev, title, next",
                        left: ""
                    },
                    defaultDate: "2014-06-12",
                    editable: !0,
                    events: [{
                        title: "All Day",
                        start: "2014-06-01"
                    }, {
                        title: "Long Event",
                        start: "2014-06-07",
                        end: "2014-06-10"
                    }, {
                        id: 999,
                        title: "Repeat",
                        start: "2014-06-09"
                    }, {
                        id: 999,
                        title: "Repeat",
                        start: "2014-06-16"
                    }, {
                        title: "Meet",
                        start: "2014-06-12",
                        end: "2014-06-12"
                    }, {
                        title: "Lunch",
                        start: "2014-06-12"
                    }, {
                        title: "Birthday",
                        start: "2014-06-13"
                    }, {
                        title: "Google",
                        url: "http://google.com/",
                        start: "2014-06-28"
                    }]
                });
                var mYear = moment().format("YYYY")
                    , mDay = moment().format("dddd, MMM D");
                $("#calendar-widget .cwh-year").html(mYear),
                    $("#calendar-widget .cwh-day").html(mDay)
            }(),
            $("#weather-widget")[0] && $.simpleWeather({
                location: "Austin, TX",
                woeid: "",
                unit: "f",
                success: function (weather) {
                    html = '<div class="weather-status">' + weather.temp + "&deg;" + weather.units.temp + "</div>",
                        html += '<ul class="weather-info"><li>' + weather.city + ", " + weather.region + "</li>",
                        html += '<li class="currently">' + weather.currently + "</li></ul>",
                        html += '<div class="weather-icon wi-' + weather.code + '"></div>',
                        html += '<div class="dw-footer"><div class="weather-list tomorrow">',
                        html += '<span class="weather-list-icon wi-' + weather.forecast[2].code + '"></span><span>' + weather.forecast[1].high + "/" + weather.forecast[1].low + "</span><span>" + weather.forecast[1].text + "</span>",
                        html += "</div>",
                        html += '<div class="weather-list after-tomorrow">',
                        html += '<span class="weather-list-icon wi-' + weather.forecast[2].code + '"></span><span>' + weather.forecast[2].high + "/" + weather.forecast[2].low + "</span><span>" + weather.forecast[2].text + "</span>",
                        html += "</div></div>",
                        $("#weather-widget").html(html)
                },
                error: function (error) {
                    $("#weather-widget").html("<p>" + error + "</p>")
                }
            }),
            $(".auto-size")[0] && autosize($(".auto-size")),
            $(".fg-line")[0] && ($("body").on("focus", ".fg-line .form-control", function () {
                $(this).closest(".fg-line").addClass("fg-toggled")
            }),
                $("body").on("blur", ".form-control", function () {
                    var p = $(this).closest(".form-group, .input-group")
                        , i = p.find(".form-control").val();
                    p.hasClass("fg-float") ? 0 == i.length && $(this).closest(".fg-line").removeClass("fg-toggled") : $(this).closest(".fg-line").removeClass("fg-toggled")
                })),
            $(".fg-float")[0] && $(".fg-float .form-control").each(function () {
                var i = $(this).val();
                0 == !i.length && $(this).closest(".fg-line").addClass("fg-toggled")
            }),
            $("audio, video")[0] && $("video,audio").mediaelementplayer(),
            $(".chosen")[0] && $(".chosen").chosen({
                width: "100%",
                allow_single_deselect: !0
            }),
            $("#input-slider")[0]) {
            var slider = document.getElementById("input-slider");
            noUiSlider.create(slider, {
                start: [20],
                connect: "lower",
                range: {
                    min: 0,
                    max: 100
                }
            })
        }
        if ($("#input-slider-range")[0]) {
            var sliderRange = document.getElementById("input-slider-range");
            noUiSlider.create(sliderRange, {
                start: [40, 70],
                connect: !0,
                range: {
                    min: 0,
                    max: 100
                }
            })
        }
        if ($("#input-slider-value")[0]) {
            var sliderRangeValue = document.getElementById("input-slider-value");
            noUiSlider.create(sliderRangeValue, {
                start: [10, 50],
                connect: !0,
                range: {
                    min: 0,
                    max: 100
                }
            }),
                sliderRangeValue.noUiSlider.on("update", function (values, handle) {
                    document.getElementById("input-slider-value-output").innerHTML = values[handle]
                })
        }
        if ($("input-mask")[0] && $(".input-mask").mask(),
            $(".color-picker")[0] && $(".color-picker").each(function () {
                var colorOutput = $(this).closest(".cp-container").find(".cp-value");
                $(this).farbtastic(colorOutput)
            }),
            $(".html-editor")[0] && $(".html-editor").summernote({
                height: 150
            }),
            $(".html-editor-click")[0] && ($("body").on("click", ".hec-button", function () {
                $(".html-editor-click").summernote({
                    focus: !0
                }),
                    $(".hec-save").show()
            }),
                $("body").on("click", ".hec-save", function () {
                    $(".html-editor-click").code(),
                        $(".html-editor-click").destroy(),
                        $(".hec-save").hide()
                })),
            $(".html-editor-airmod")[0] && $(".html-editor-airmod").summernote({
                airMode: !0
            }),
            $(".date-time-picker")[0] && $(".date-time-picker").datetimepicker(),
            $(".time-picker")[0] && $(".time-picker").datetimepicker({
                format: "LT"
            }),
            $(".date-picker")[0] && $(".date-picker").datetimepicker({
                format: "DD/MM/YYYY"
            }),
            $(".date-picker").on("dp.hide", function () {
                $(this).closest(".dtp-container").removeClass("fg-toggled"),
                    $(this).blur()
            }),
            $(".form-wizard-basic")[0] && $(".form-wizard-basic").bootstrapWizard({
                tabClass: "fw-nav",
                nextSelector: ".next",
                previousSelector: ".previous"
            }),
            function () {
                Waves.attach(".btn:not(.btn-icon):not(.btn-float)"),
                    Waves.attach(".btn-icon, .btn-float", ["waves-circle", "waves-float"]),
                    Waves.init()
            }(),
            $(".lightbox")[0] && $(".lightbox").lightGallery({
                enableTouch: !0
            }),
            $("body").on("click", ".a-prevent", function (e) {
                e.preventDefault()
            }),
            $(".collapse")[0] && ($(".collapse").on("show.bs.collapse", function (e) {
                $(this).closest(".panel").find(".panel-heading").addClass("active")
            }),
                $(".collapse").on("hide.bs.collapse", function (e) {
                    $(this).closest(".panel").find(".panel-heading").removeClass("active")
                }),
                $(".collapse.in").each(function () {
                    $(this).closest(".panel").find(".panel-heading").addClass("active")
                })),
            $('[data-toggle="tooltip"]')[0] && $('[data-toggle="tooltip"]').tooltip(),
            $('[data-toggle="popover"]')[0] && $('[data-toggle="popover"]').popover(),
            $("html").hasClass("ie9") && $("input, textarea").placeholder({
                customClass: "ie9-placeholder"
            }),
            $(".typeahead")[0]) {
            var statesArray = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"]
                , states = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: statesArray
                });
            $(".typeahead").typeahead({
                hint: !0,
                highlight: !0,
                minLength: 1
            }, {
                    name: "states",
                    source: states
                })
        }
    });
