import Vue from 'vue';

import methods from './methods/index'

Vue.mixin({
  methods, // Will be used for validations, middlewares, policies, logics
});
