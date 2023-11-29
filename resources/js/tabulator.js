import xlsx from "xlsx";
import { createIcons, icons } from "lucide";
import Tabulator from "tabulator-tables";

(function () {
    "use strict";
    $('#example').DataTable({
        order: [[3, 'desc']]
    });
    // Tabulator
    if ($("#tabulator").length) {
        // Setup Tabulator
        let table = new Tabulator("#tabulatorw", {
            ajaxURL: "/get-tabulator-data",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },
                {
                    title: "Name",
                    field: "name",
                    vertAlign: "middle",
                },
                {
                    title: "Gender",
                    field: "gender",
                    vertAlign: "middle",
                },
                {
                    title: "Division",
                    field: "division",
                    vertAlign: "middle",
                },
                {
                    title: "Actions",
                    formatter(cell, formatterParams) {
                        let a = $(
                            `<div class="flex lg:justify-center items-center">
                                <a class="edit flex items-center mr-3" href="javascript:;">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="delete flex items-center text-danger" href="javascript:;">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                                @can('karyawan-show', $u)
                                <a class="details flex items-center text-primary whitespace-nowrap" href="{{ route('showeuser', ['id' => $u->id_user]) }}">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Details
                                </a>
                                @endcan
                            </div>`
                        );

                        $(a)
                            .find(".edit")
                            .on("click", function () {
                                alert("EDIT");
                            });

                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                alert("DELETE");
                            });

                        return a[0];
                    },
                },
            ],
            renderComplete() {
                createIcons({
                    icons,
                    "stroke-width": 1.5,
                    nameAttr: "data-lucide",
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            createIcons({
                icons,
                "stroke-width": 1.5,
                nameAttr: "data-lucide",
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = $("#tabulator-html-filter-field").val();
            let type = $("#tabulator-html-filter-type").val();
            let value = $("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        $("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        $("#tabulator-html-filter-reset").on("click", function (event) {
            $("#tabulator-html-filter-field").val("name");
            $("#tabulator-html-filter-type").val("like");
            $("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        $("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        $("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        $("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        $("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        $("#tabulator-print").on("click", function (event) {
            table.print();
        });
    }
})();
