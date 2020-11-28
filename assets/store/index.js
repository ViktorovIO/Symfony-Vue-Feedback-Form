import Vue from "vue";
import Vuex from "vuex";
import Feedbacks from "./feedbacks";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        feedbacks: Feedbacks
    }
});