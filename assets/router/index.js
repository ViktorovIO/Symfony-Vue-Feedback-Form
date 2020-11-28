import Vue from "vue";
import VueRouter from "vue-router";
import Index from "../components/Index";
import Home from "../components/Home";
import FeedbackForm from "../components/FeedbackForm";

Vue.use(VueRouter);

let router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: Home },
        { path: "/feedback", component: FeedbackForm },
        { path: "*", redirect: "/" }
    ],
});

export default router;