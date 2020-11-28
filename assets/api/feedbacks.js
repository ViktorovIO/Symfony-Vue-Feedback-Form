import axios from "axios";

export default {
    getFeedbackList() {
        return axios.get("/api/feedbackList");
    }
};