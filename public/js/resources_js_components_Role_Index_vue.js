"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_Role_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Role/Index.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Role/Index.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      roles: [],
      form: {
        id: null,
        display_name: null,
        description: null
      },
      error: {
        display_name: null,
        description: null
      }
    };
  },
  created: function created() {
    this.get();
  },
  methods: {
    reset: function reset() {
      this.resetForm(this);
    },
    show: function show(role) {
      this.form.id = role.id;
      this.form.display_name = role.display_name;
      this.form.description = role.description;
      document.getElementById("roleModalButton").click();
    },
    save: function save() {
      var _this = this;

      if (!this.form.id) {
        this.axios.post("/role/store", this.form).then(function (res) {
          if (res.data.success) {
            _this.get();

            _this.$vs.notification({
              color: "success",
              title: res.data.title,
              text: res.data.message
            });

            document.getElementById("cancelModalButton").click();
          }
        })["catch"](function (err) {
          console.log(err);

          _this.processFormErrors(_this, err);
        });
      } else {
        this.axios.post("/role/update/".concat(this.form.id), this.form).then(function (res) {
          if (res.data.success) {
            _this.get();

            _this.$vs.notification({
              color: "success",
              title: res.data.title,
              text: res.data.message
            });

            document.getElementById("cancelModalButton").click();
          }
        })["catch"](function (err) {
          console.log(err);

          _this.processFormErrors(_this, err);
        });
      }
    },
    get: function get() {
      var _this2 = this;

      this.axios.get("/role/get").then(function (res) {
        console.log(res);

        if (res.data.success) {
          _this2.roles = res.data.roles;
        }
      })["catch"](function (err) {
        console.log(err);
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/components/Role/Index.vue":
/*!************************************************!*\
  !*** ./resources/js/components/Role/Index.vue ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_ada433f8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=ada433f8& */ "./resources/js/components/Role/Index.vue?vue&type=template&id=ada433f8&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/components/Role/Index.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_ada433f8___WEBPACK_IMPORTED_MODULE_0__.render,
  _Index_vue_vue_type_template_id_ada433f8___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Role/Index.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Role/Index.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/Role/Index.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Role/Index.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Role/Index.vue?vue&type=template&id=ada433f8&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/Role/Index.vue?vue&type=template&id=ada433f8& ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_ada433f8___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_ada433f8___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_ada433f8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=template&id=ada433f8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Role/Index.vue?vue&type=template&id=ada433f8&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Role/Index.vue?vue&type=template&id=ada433f8&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Role/Index.vue?vue&type=template&id=ada433f8& ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "container" }, [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col" }, [
        _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header" }, [_vm._v("Roles")]),
          _vm._v(" "),
          _c("div", { staticClass: "card-body" }, [
            _c("table", { staticClass: "table" }, [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "tbody",
                _vm._l(_vm.roles, function (role, index) {
                  return _c(
                    "tr",
                    {
                      key: index,
                      on: {
                        click: function ($event) {
                          return _vm.show(role)
                        },
                      },
                    },
                    [
                      _c("th", { attrs: { scope: "row" } }, [
                        _vm._v(_vm._s(index + 1)),
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(role.display_name))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(role.description))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(role.created_at))]),
                    ]
                  )
                }),
                0
              ),
            ]),
          ]),
        ]),
      ]),
    ]),
    _vm._v(" "),
    _c(
      "button",
      {
        staticClass: "btn btn-primary mt-3 float-right",
        attrs: {
          type: "button",
          "data-toggle": "modal",
          "data-target": "#roleFormModal",
          id: "roleModalButton",
        },
      },
      [_vm._v("\n    Add Role\n  ")]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: { id: "roleFormModal", "data-backdrop": "static" },
      },
      [
        _c("div", { staticClass: "modal-dialog modal-dialog-centered" }, [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c("h5", { staticClass: "modal-title" }, [
                _vm._v(_vm._s(_vm.form.id ? "Update" : "Add") + " Role"),
              ]),
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _c("div", { staticClass: "container-fluid p-0" }, [
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col" }, [
                    _c("div", { staticClass: "mb-3" }, [
                      _c(
                        "label",
                        {
                          staticClass: "form-label",
                          attrs: { for: "display_name" },
                        },
                        [_vm._v("Display Name")]
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.display_name,
                            expression: "form.display_name",
                          },
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", id: "display_name" },
                        domProps: { value: _vm.form.display_name },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "display_name",
                              $event.target.value
                            )
                          },
                        },
                      }),
                      _vm._v(" "),
                      _vm.error.display_name
                        ? _c(
                            "div",
                            { staticClass: "invalid-feedback d-block" },
                            [
                              _vm._v(
                                "\n                    " +
                                  _vm._s(_vm.error.display_name) +
                                  "\n                  "
                              ),
                            ]
                          )
                        : _vm._e(),
                    ]),
                  ]),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col" }, [
                    _c("div", { staticClass: "mb-3" }, [
                      _c(
                        "label",
                        {
                          staticClass: "form-label",
                          attrs: { for: "description" },
                        },
                        [_vm._v("Description")]
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.description,
                            expression: "form.description",
                          },
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", id: "description" },
                        domProps: { value: _vm.form.description },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "description",
                              $event.target.value
                            )
                          },
                        },
                      }),
                      _vm._v(" "),
                      _vm.error.description
                        ? _c(
                            "div",
                            { staticClass: "invalid-feedback d-block" },
                            [
                              _vm._v(
                                "\n                    " +
                                  _vm._s(_vm.error.description) +
                                  "\n                  "
                              ),
                            ]
                          )
                        : _vm._e(),
                    ]),
                  ]),
                ]),
              ]),
            ]),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "modal-footer",
                staticStyle: { display: "block !important" },
              },
              [
                _c("div", { staticClass: "d-flex" }, [
                  _c("div", { staticClass: "mr-auto p-2" }, [
                    _vm.form.id
                      ? _c(
                          "button",
                          {
                            staticClass: "btn btn-danger",
                            attrs: { type: "button" },
                          },
                          [_vm._v("\n                Delete\n              ")]
                        )
                      : _vm._e(),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "p-2" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-secondary",
                        attrs: {
                          type: "button",
                          "data-dismiss": "modal",
                          id: "cancelModalButton",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.reset()
                          },
                        },
                      },
                      [_vm._v("\n                Cancel\n              ")]
                    ),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "p-2" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-primary",
                        attrs: { type: "button" },
                        on: {
                          click: function ($event) {
                            return _vm.save()
                          },
                        },
                      },
                      [
                        _vm._v(
                          "\n                " +
                            _vm._s(_vm.form.id ? "Update" : "Save") +
                            "\n              "
                        ),
                      ]
                    ),
                  ]),
                ]),
              ]
            ),
          ]),
        ]),
      ]
    ),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("#")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Display Name")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Description")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Created at")]),
      ]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);