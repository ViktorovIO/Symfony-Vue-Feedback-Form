import FeedbackAPI from "../api/feedbacks";

const CREATING_FEEDBACK = "CREATING_feedback",
    CREATING_FEEDBACK_SUCCESS = "CREATING_feedback_SUCCESS",
    CREATING_FEEDBACK_ERROR = "CREATING_feedback_ERROR",
    FETCHING_FEEDBACKS = "FETCHING_FEEDBACKS",
    FETCHING_FEEDBACKS_SUCCESS = "FETCHING_FEEDBACKS_SUCCESS",
    FETCHING_FEEDBACKS_ERROR = "FETCHING_FEEDBACKS_ERROR";

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        feedbacks: []
    },
    getters: {
        isLoading(state) {
            return state.isLoading;
        },
        hasError(state) {
            return state.error !== null;
        },
        error(state) {
            return state.error;
        },
        hasfeedbacks(state) {
            return state.feedbacks.length > 0;
        },
        feedbacks(state) {
            return state.feedbacks;
        }
    },
    mutations: {
        [CREATING_FEEDBACK](state) {
            state.isLoading = true;
            state.error = null;
        },
        [CREATING_FEEDBACK_SUCCESS](state, feedback) {
            state.isLoading = false;
            state.error = null;
            state.feedbacks.unshift(feedback);
        },
        [CREATING_FEEDBACK_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
            state.feedbacks = [];
        },
        [FETCHING_FEEDBACKS](state) {
            state.isLoading = true;
            state.error = null;
            state.feedbacks = [];
        },
        [FETCHING_FEEDBACKS_SUCCESS](state, feedbacks) {
            state.isLoading = false;
            state.error = null;
            state.feedbacks = feedbacks;
        },
        [FETCHING_FEEDBACKS_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
            state.feedbacks = [];
        }
    },
    actions: {
        async getFeedbackList({ commit }) {
            commit(FETCHING_FEEDBACKS);
            try {
                let response = await FeedbackAPI.getFeedbackList();
                commit(FETCHING_FEEDBACKS_SUCCESS, response.data);
                return response.data;
            } catch (error) {
                commit(FETCHING_FEEDBACKS_ERROR, error);
                return null;
            }
        }
    }
};